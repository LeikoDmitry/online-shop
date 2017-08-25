<?php
session_start();
if (! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (! isset($_SESSION['user'])) {
    $_SESSION['user'] = [];
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

/** @var  $controller - определяем с каким контроллером будем работать */
$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
/** @var  $action - определяем с какой функцией будем работать */
$action     = isset($_GET['action']) ? $_GET['action'] : 'index';

loadPage($smarty, $controller, $action);