<?php

/**
 * Модель пользователей
 */

/**
 * Создание нового пользователя
 * @param array $data
 * @param $PDO PDO
 * @return bool
 */
function registerNewUser(PDO $PDO, array $data)
{
    $valide = array_map('trim', $data);
    $user = filter_var_array($valide, [
        'email'            => FILTER_VALIDATE_EMAIL,
        'name'             => FILTER_SANITIZE_STRING,
        'password'         => FILTER_SANITIZE_STRING,
        'phone'            => FILTER_SANITIZE_STRING,
        'address'           => FILTER_SANITIZE_STRING,
    ]);
    if (checkEmailUser($PDO, $user['email'])) {
        $verify_password_string = $user['password'];
        $user['password'] = isset($user['password']) ? password_hash($user['password'], PASSWORD_BCRYPT) : false;
        if (in_array(false, $user, true)) {
            $_SESSION['errors'] = $user;
            return false;
        };
        if (! hash_equals($verify_password_string, $valide['confirm_password'])) {
            $_SESSION['errors'] = ['password' => false];
            return false;
        }
        $sql = 'INSERT INTO users(email, password, name, phone, address) VALUES (:email, :password, :name, :phone, :address)';
        $statement = $PDO->prepare($sql);
        $statement->execute($user);
        $rs = $statement->rowCount();
        if ($rs) {
            return loginUser($PDO, ['email' => $user['email'], 'password' => $verify_password_string]);
        }
    }
    return false;
}

/**
 * Функция входа пользователя
 * @param PDO $PDO
 * @param array $data
 * @return bool|mixed
 */
function loginUser(PDO $PDO, array $data)
{
    $data = array_map('trim', $data);
    $user = filter_var_array($data, [
        'email'            => FILTER_VALIDATE_EMAIL,
        'password'         => FILTER_SANITIZE_STRING,
    ]);
    $sql = 'SELECT * FROM users WHERE email = :email';
    $state = $PDO->prepare($sql);
    $state->execute(['email' => $user['email']]);
    $us = $state->fetch(PDO::FETCH_ASSOC);
    if (password_verify($user['password'], $us['password'])) {
        return $us;
    }
    return false;
}

/**
 * Проверка email в базе
 * @param PDO $PDO
 * @param $email
 * @param $get
 * @return bool
 */
function checkEmailUser(PDO $PDO, $email, $get = false)
{
    $sql = 'SELECT * FROM users WHERE email = :email';
    $state = $PDO->prepare($sql);
    $state->execute(['email' => $email]);
    if ($get === true) {
        return $state->fetch(PDO::FETCH_ASSOC);
    }
    if (! $state->fetch(PDO::FETCH_ASSOC)) {
        return true;
    }
    return false;
}


/**
 * Обновление данных пользователя
 * @param PDO $PDO
 * @param array $data
 * @return bool
 */
function updateUserData(PDO $PDO, array $data)
{
    $data = array_map('trim', $data);
    $data = filter_var_array($data, [
        'name' => FILTER_SANITIZE_STRING,
        'phone' => FILTER_SANITIZE_STRING,
        'address' => FILTER_SANITIZE_STRING,
    ]);
    $data['email'] = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : false;
    $sql = 'UPDATE users SET name = :name, phone = :phone, address = :address WHERE email = :email';
    $state = $PDO->prepare($sql);
    if ($state->execute($data)) {
        return true;
    };
    return false;
}

/**
 * Получение всех заказов пользователя
 * @param PDO $PDO
 * @return array
 */
function getCurUserOrders(PDO $PDO)
{
    $smartyRs = [];
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $sql = 'SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC ';
    $statement = $PDO->prepare($sql);
    $statement->execute(['user_id' => $userId]);
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $rsChildren = getPurchesOrders($PDO, $row['id']);
        if ($rsChildren) {
            $row['children'] = $rsChildren;
        }
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

function getPurchesOrders(PDO $PDO, $orderId)
{
    $sql = "SELECT * 
            FROM purchase 
            JOIN products 
            ON purchase.product_id = products.id 
            WHERE purchase.order_id = :order_id";
    $statement = $PDO->prepare($sql);
    $statement->execute(['order_id' => $orderId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);

}
















