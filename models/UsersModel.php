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
        $sql = 'SELECT * FROM users WHERE email = :email AND  password = :password';
        $state = $PDO->prepare($sql);
        $state->execute(['email' => $user['email'], 'password' => $user['password']]);
        $us = $state->fetch(PDO::FETCH_ASSOC);
        if (password_verify($verify_password_string, $user['password'])) {
            return $us;
        }
        return false;
    }
    return false;
}