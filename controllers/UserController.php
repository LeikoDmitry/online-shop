<?php

/**
 * Контроллер пользователей
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';
include_once __DIR__ . '/../models/UsersModel.php';


/**
 * Страница пользователя
 * @param Smarty $smarty
 * @return bool
 */
function indexAction(Smarty $smarty)
{
    if (! isset($_SESSION['user'])) {
        header('Location: /user/login/');
        return false;
    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        $categories = getAllCategories(connection());
        $smarty->assign('pageTitle', 'Страница пользователя');
        $smarty->assign('categories', $categories);
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'user');
        loadTemplate($smarty, 'footer');
        return true;
    }
    if (updateUserData(connection(), $_POST) === true) {
        $user = checkEmailUser(connection(), $_SESSION['user']['email'], true);
        unset($_SESSION['user']);
        $_SESSION['user'] = $user;
    }
    header('Location: /user/');
    return true;
}

/**
 * Регистрация пользователя
 * @param Smarty $smarty
 * @return bool
 */
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
    $_SESSION['errors'] = ['email' => false];
    header('Location: /user/register/');
    return true;
}

/**
 * Экшен входа пользователя
 * @param Smarty $smarty
 * @return bool
 */
function loginAction(Smarty $smarty)
{
    if (isset($_SESSION['errors'])) {
        $smarty->assign('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);
    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        $categories = getAllCategories(connection());
        $smarty->assign('pageTitle', 'Авторизация');
        $smarty->assign('categories', $categories);
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'login');
        loadTemplate($smarty, 'footer');
        return true;
    }
    $user = loginUser(connection(), $_POST);
    if ($user !== false) {
        $_SESSION['user'] = $user;
        header('Location: /user/');
        return true;
    }
    $_SESSION['errors'] = ['password' => false];
    header('Location: /user/login/');
    return true;
}

/**
 * Выход пользователя
 * @return $this
 */
function logoutAction()
{
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
        session_regenerate_id();
        header('Location: /');
        return true;
    }
    return false;
}