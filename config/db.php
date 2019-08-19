<?php

/**
 * Подключение к базе данных
 */

/**
 * Подключение к базе данных
 * @return PDO | bool
 */
function connection()
{
    $config = [
        'dns' => 'mysql:host=database;dbname=shop-local;charset=utf8',
        'username' => 'shop-user',
        'password' => 'shop-user-path',
    ];
    try {
        $db = new PDO($config['dns'], $config['username'], $config['password']);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $PDOException) {
        echo $PDOException->getMessage();
    }
    return false;
}
