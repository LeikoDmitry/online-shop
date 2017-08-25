<?php

/**
 * Файл модели продуктов
 */

/**
 * Получение последних добаленных продуктов
 * @param $PDO PDO
 * @param $limit int
 * @return array
 */
function getLastProduct(PDO $PDO, $limit = null)
{
    try {
        $sql = 'SELECT id, category_id, name, description, price, image, status FROM products ORDER BY id DESC';
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        $statement = $PDO->prepare($sql);
        $statement->execute();
        $rs = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (! $rs) {
            return [];
        }
        return $rs;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        exit;
    }
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



