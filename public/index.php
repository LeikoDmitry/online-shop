<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

if (! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (! isset($_SESSION['errors'])) {
    $_SESSION['errors'] = [];
}


/** Инициализация настроек */
include __DIR__ . '/../config/config.php';

/** Подключение к базе */
include __DIR__ . '/../config/db.php';

/** Подключение библиотек */
include __DIR__ . '/../library/functions.php';

$params = [];

if ($routeMatch instanceof \Zend\Router\RouteMatch) {
    $params = $routeMatch->getParams();
}

/** @var  $controller - определяем с каким контроллером будем работать */
$controller = isset($params['controller']) ? ucfirst($params['controller']) : 'Index';
/** @var  $action - определяем с какой функцией будем работать */
$action     = isset($params['action']) ? $params['action'] : 'error';

if (isset($_SESSION['user'])) {
    $smarty->assign('arrayUser', $_SESSION['user']);
}

if (isset($_SESSION['cart'])) {
    $smarty->assign('cartCounts', count($_SESSION['cart']));
}

loadPage($smarty, $controller, $action);