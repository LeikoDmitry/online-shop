<?php

/**
 * Модель заказов
 */

include __DIR__ . '/../models/UsersModel.php';

/**
 * Добавление нового заказа
 * @param PDO $PDO
 * @return mixed
 */
function makeNewOrder(PDO $PDO)
{
    $date = new DateTime();
    $format = $date->format('Y-m-d H:i:s');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO orders(user_id, date_created, date_payment, date_modyfication, status, comment, user_ip) VALUES (:user_id, :format, :date_payment, :date_modify, :status, :comment, :user_ip)" ;
    $statement = $PDO->prepare($sql);
    $statement->execute([
        'user_id' => $_SESSION['user']['id'],
        'format'  => $format,
        'date_payment' => null,
        'date_modify'  => $format,
        'status' => 0,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'comment' => null,
    ]);
    $id = $PDO->lastInsertId();
    if (! $id) {
        return false;
    }
    return $id;
}

function getOrders(PDO $PDO)
{
    $rsArray = [];
    $sql = 'SELECT * FROM orders LEFT JOIN users ON orders.user_id = users.id';
    $statement = $PDO->prepare($sql);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $rsChildren = getPurchesOrders($PDO, $row['id']);
        if ($rsChildren) {
            $row['children'] = $rsChildren;
        }
        $rsArray[] = $row;
    }
    return $rsArray;
}