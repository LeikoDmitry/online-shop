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
        'adress'           => FILTER_SANITIZE_STRING,
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
        $sql = 'INSERT INTO users(email, password, name, phone, adress) VALUES (:email, :password, :name, :phone, :adress)';
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
    $hash = password_hash($data['password'], PASSWORD_BCRYPT);
    $sql = 'SELECT * FROM users WHERE email = :email';
    $state = $PDO->prepare($sql);
    $state->execute(['email' => $user['email']]);
    $us = $state->fetch(PDO::FETCH_ASSOC);
    if (password_verify($data['password'], $us['password'])) {
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
        'adress' => FILTER_SANITIZE_STRING,
    ]);
    $data['email'] = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : false;
    $sql = 'UPDATE users SET name = :name, phone = :phone, adress = :adress WHERE email = :email';
    $state = $PDO->prepare($sql);
    if ($state->execute($data)) {
        return true;
    };
    return false;
}