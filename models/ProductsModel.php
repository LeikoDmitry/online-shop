<?php

/**
 * Файл модели продуктов
 */

/**
 * Получение последних добаленных продуктов
 * @param $PDO PDO
 * @param $limit int
 * @param $offset int
 * @return array
 */
function getLastProduct(PDO $PDO, $offset = 1, $limit = 9)
{
    try {
        $rs = [];
        $sql = 'SELECT id, category_id, name, description, price, image, status FROM products ORDER BY id DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . $limit . ' OFFSET '  . $offset;
        }
        $statement = $PDO->prepare($sql);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $rs[] = $row;
        }
        return $rs;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        exit;
    }
}

/**
 * Получение количества продуктов
 * @param PDO $PDO
 * @return mixed
 */
function getCountProduct(PDO $PDO)
{
    $sqlCount = 'SELECT COUNT(products.id) AS ctn FROM products';
    $state = $PDO->prepare($sqlCount);
    $state->execute();
    return $state->fetch(PDO::FETCH_ASSOC)['ctn'];
}

/**
 * Получение продуктов по категории
 * @param PDO $PDO
 * @param $id
 * @return array
 */
function getProductsByCategory(PDO $PDO, $id)
{
    $sql = 'SELECT id, category_id, name, description, price, image, status FROM products WHERE category_id = :category_id';
    $statement = $PDO->prepare($sql);
    $statement->execute([':category_id' => $id]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Получение продукта по его id
 * @param PDO $PDO
 * @param $id
 * @return mixed
 */
function getProductById(PDO $PDO, $id)
{
    $sql = 'SELECT * FROM products WHERE id = :id';
    $statement = $PDO->prepare($sql);
    $statement->execute(['id' => (int)$id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Получаем список из массива
 * @param PDO $PDO
 * @param array $items
 * @return array
 */
function getProductsFromArray(PDO $PDO, array $items)
{
    if ($items) {
        $stringItems = implode(',', $items);
        $sql = 'SELECT * FROM products WHERE id in (' . $stringItems . ')';
        $statement = $PDO->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

/**
 * Получение всех продуктов из базы
 * @param PDO $PDO
 * @return array
 */
function getProducts(PDO $PDO)
{
    $sql = "SELECT * FROM products ORDER BY category_id";
    $statement = $PDO->prepare($sql);
    $statement->execute([]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Добавление продукта
 * @param PDO $PDO
 * @param array $data
 * @return bool
 */
function addProduct(PDO $PDO, array $data)
{
    $empty = array_map(function ($value){
        return ! empty($value) ? $value : null;
    }, $data);
    if (in_array(null, $empty, true)) {
        return false;
    }
    $pathFile = 'default.png';
    if ($_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
        $pathFile = uploadImages($_FILES);
    }
    $data['image'] = $pathFile;
    $sql = 'INSERT 
            INTO products (name , price, status, category_id, description, image) 
            VALUES (:name, :price, :status, :category_id, :description, :image)';
    $statement = $PDO->prepare($sql);
    return $statement->execute($data);
}

/**
 * Удаление продукта
 * @param PDO $PDO
 * @param $idProduct
 * @return bool
 */
function deleteProduct(PDO $PDO, $idProduct)
{
    $sql = 'DELETE FROM products WHERE id = :idProduct';
    $statement = $PDO->prepare($sql);
    return $statement->execute(['idProduct' => (int) $idProduct]);
}

function updateProduct(PDO $PDO, array $data)
{
    $empty = array_map(function ($value) {
        return ! empty($value) ? $value : null;
    }, $data);
    if (in_array(null, $empty, true)) {
        return false;
    }
    $sql = 'UPDATE products 
            SET category_id = :category_id, name = :name, description = :description, price = :price, image = :image, status = :status 
            WHERE id = :id';
    $statement = $PDO->prepare($sql);
    return $statement->execute($data);
}

/**
 * Загрузка изображения
 * @param array $data
 * @return bool|string
 */
function uploadImages(array $data)
{
    if (! is_uploaded_file($data['image']['tmp_name'])) {
        return false;
    }
    if (UPLOAD_ERR_OK != $data['image']['error']) {
        return false;
    }
    $tmp_name = $data['image']['tmp_name'];
    $unique_dir = uniqid();
    $dir = __DIR__ . '/../public/upload/' . $unique_dir;
    mkdir($dir, 0777, true);
    $name = explode('.', $data['image']['name']);
    if (! move_uploaded_file($tmp_name, $dir . '/' . $unique_dir . '.' . $name[1])) {
        return false;
    }
    return $unique_dir . '/' . $unique_dir . '.' . $name[1];
}