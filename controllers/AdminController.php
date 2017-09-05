<?php

/**
 * Админ Контроллер
 *  url /admin
 */

/** Подключение моделей */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';
include_once __DIR__ . '/../models/OrdersModel.php';
include_once __DIR__ . '/../models/PurchesModel.php';

/** Переименование переменных к путям шаблонов */
$smarty->setTemplateDir(TEMPLATE_ADMIN_PATH);
$smarty->assign('templateWebPath', TEMPLATE_WEB_ADMIN);

/**
 * Главная страница админки
 * @param Smarty $smarty
 * @return bool
 */
function indexAction(Smarty $smarty)
{
    $smarty->assign('pageTitle', 'Администраторская часть');
    loadTemplate($smarty, 'admin-header');
    loadTemplate($smarty, 'admin-index');
    loadTemplate($smarty, 'admin-footer');
    return true;
}