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
    $date = new \DateTime();
    $format = $date->format('Y-m-d H:i:s');
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


/**
 * Получение всех заказов с товарами
 * @param PDO $PDO
 * @return array
 */
function getOrders(PDO $PDO)
{
    $rsArray = [];
    $sql = 'SELECT 
            orders.id as order_id, orders.status, orders.comment, orders.date_created, orders.comment, orders.status as order_status, orders.date_payment, 
            users.id as user_id, users.name as user_name, users.adress, users.email, users.phone 
            FROM orders 
            LEFT JOIN users 
            ON orders.user_id = users.id';
    $statement = $PDO->prepare($sql);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $rsChildren = getPurchesOrders($PDO, $row['order_id']);
        if ($rsChildren) {
            $row['children'] = $rsChildren;
        }
        $rsArray[] = $row;
    }
    return $rsArray;
}

/**
 * Удаление заказа
 * @param PDO $PDO
 * @param $id
 * @return bool
 */
function deleteOrder(PDO $PDO, $id)
{
    $sql = 'DELETE FROM orders WHERE id = :id';
    $statement = $PDO->prepare($sql);
    return $statement->execute(['id' => $id]);
}

/**
 * Обновление заказа
 * @param PDO $PDO
 * @param array $data
 * @return bool
 */
function updateOrder(PDO $PDO, array $data)
{
    $sql = 'UPDATE orders 
            SET orders.status            = :status, 
                orders.comment           = :comment, 
                orders.date_created      = :date_created, 
                orders.date_modyfication = :date_modyfication, 
                orders.date_payment      = :date_payment 
            WHERE id = :id';
    $statement = $PDO->prepare($sql);
    return $statement->execute([
        'status'            => $data['status'],
        'comment'           => $data['comment'],
        'date_created'      => $data['date_created'],
        'date_modyfication' => $data['date_modyfication'],
        'date_payment'      => $data['date_payment'],
        'id'                => $data['id'],
    ]);
}

/**
 * Получение заказа по его индификатору
 * @param PDO $PDO
 * @param $id
 * @return mixed
 */
function getOrderById(PDO $PDO, $id)
{
    $sql = 'SELECT * FROM orders WHERE orders.id = :id';
    $statement = $PDO->prepare($sql);
    $statement->execute(['id' => (int) $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}