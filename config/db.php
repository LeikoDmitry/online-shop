<?php

/**
 * Подключение к базе данных
 */


/**
 * Подключение к базе данных
 * @return PDO
 */
function connection()
{
    $config = [
        'dns'       => 'mysql:host=127.0.0.1;dbname=shop-local;charset=utf8',
        'username'  => 'root',
        'password'  => '',
    ];
    $db = new PDO($config['dns'], $config['username'], $config['password']);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $db;
}
