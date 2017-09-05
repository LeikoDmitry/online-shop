<?php

/**
 * Модель категорий
 */

/**
 * Получение категорий для меню
 * @param PDO $PDO
 * @return array
 */
function getCategoriesByParent(PDO $PDO)
{
    $db = $PDO;
    $sql = 'SELECT id, name, parent_id FROM categories';
    $rs = $db->prepare($sql);
    $rs->execute();
    $response = $rs->fetchAll(PDO::FETCH_ASSOC);
    if (! $response) {
        return [];
    }
    return $response;
}

/**
 * Дреевидный массив
 * @param PDO $PDO
 * @param $parent int
 * @return array
 */
function getAllCategories(PDO $PDO, $parent = 0)
{
    $rows = [];
    $response = getCategoriesByParent($PDO);
    foreach ($response as $key) {
        if ($key['parent_id'] == $parent) {
            $key['children'] = getAllCategories($PDO, $key['id']);
            $rows[] = $key;
        }
    }
    return $rows;
}

/**
 * Получение категории по id
 * @param PDO $PDO
 * @param $id
 * @return mixed
 */
function getCategoryById(PDO $PDO, $id)
{
    $sql = 'SELECT id, name, parent_id FROM categories WHERE id = :id';
    $statement = $PDO->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}


/**
 * Добавление категорий
 * @param PDO $PDO
 * @param array $data
 * @return string
 */
function addCategories(PDO $PDO, array $data)
{
    $data = filter_var_array($data, [
        'name'      => FILTER_SANITIZE_STRING,
        'parent_id' => FILTER_VALIDATE_INT,
    ]);
    foreach ($data as $value) {
        if ($value === "" ) {
            return false;
        }
    }
    $sql = 'INSERT INTO categories (`name`, `parent_id`) VALUES (:name, :parent_id)';
    $statement = $PDO->prepare($sql);
    $statement->execute($data);
    return $PDO->lastInsertId();
}

function updateCategory(PDO $PDO, array $store)
{
    $sql = 'UPDATE categories SET `name` = :name, `parent_id` = :parent_id WHERE `id` = :id';
    $statement = $PDO->prepare($sql);
    return $statement->execute([
        'name' => $store['name'],
        'id' => $store['id'],
        'parent_id' => $store['parent_id'],
    ]);
}

