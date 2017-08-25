<?php

/**
 * Контроллер пользователей
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';
include_once __DIR__ . '/../models/UsersModel.php';

function registerAction(Smarty $smarty)
{
    if (isset($_SESSION['errors'])) {
        $smarty->assign('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);
    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        $categories = getAllCategories(connection());
        $smarty->assign('pageTitle', 'Регистрация');
        $smarty->assign('categories', $categories);
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'register');
        loadTemplate($smarty, 'footer');
        return true;
    }
    $result = registerNewUser(connection(), $_POST);
    if ($result !== false) {
        $_SESSION['user'] = $result;
        header('Location: /user/');
        return true;
    }
    header('Location: /user/register/');
    return true;
}