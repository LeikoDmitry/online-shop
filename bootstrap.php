<?php

require __DIR__ . '/vendor/autoload.php';

session_start();

/**
 * @return void
 */
function initProject()
{
    if (! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (! isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    include __DIR__ . '/config/config.php';
    include __DIR__ . '/config/db.php';
    include __DIR__ . '/library/functions.php';
    $params = $_GET;
    $smarty = new Smarty();
    $smarty->setTemplateDir(TEMPLATE_PREFIX);
    $smarty->setCompileDir(__DIR__ . '/tmp/smarty/templates_c');
    $smarty->setCacheDir(__DIR__ . '/tmp/smarty/cache');
    $smarty->setConfigDir(__DIR__ . '/library/smarty/config');
    $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
    $smarty->assign('templateWebUploadPath', TEMPLATE_WEB_UPLOADS);
    $controller = isset($params['controller']) ? ucfirst($params['controller']) : 'Index';
    $action = isset($params['action']) ? $params['action'] : 'index';
    if (isset($_SESSION['user'])) {
        $smarty->assign('arrayUser', $_SESSION['user']);
    }
    if (isset($_SESSION['cart'])) {
        $smarty->assign('cartCounts', count($_SESSION['cart']));
    }
    loadPage($smarty, $controller, $action);
}
