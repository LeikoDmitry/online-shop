<?php

/**
 * Модель покупок
 */

/**
 * Сохранение покупок
 * @param PDO $PDO
 * @param $id
 * @param array $data
 * @return bool
 */
function setOrderForPurshed(PDO $PDO, $id, array $data)
{
    $sql = 'INSERT INTO purchase (order_id, product_id, price, amount) VALUES(:order_id, :product_id, :price, :amount)';
    $statement = $PDO->prepare($sql);
    foreach ($data as $val) {
        $statement->execute([
            'order_id'    => $id,
            'product_id'  => $val['id'],
            'price'       => $val['price'],
            'amount'      => $val['count'],
        ]);
    }
    if ($PDO->lastInsertId()) {
        return true;
    }
    return false;
}