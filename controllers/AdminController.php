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
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $rsCategories = getAllCategories(connection());
        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('pageTitle', 'Администраторская часть');
        loadTemplate($smarty, 'admin-header');
        loadTemplate($smarty, 'admin-index');
        loadTemplate($smarty, 'admin-footer');
        return true;
    }
    if (addCategories(connection(), $_POST)) {
        header('Location: /admin');
        return true;
    }
    header('Location: /admin');
    return false;
}

/**
 * Вывод всех категорий на страницу
 * @param Smarty $smarty
 * @return bool
 */
function categoryAction(Smarty $smarty)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $rsMainCategories = getCategoriesByParent(connection());
        $smarty->assign('rsMainCategories', $rsMainCategories);
        $smarty->assign('pageTitle', 'Управление категориями');
        loadTemplate($smarty, 'admin-header');
        loadTemplate($smarty, 'admin-category');
        loadTemplate($smarty, 'admin-footer');
        return true;
    }
    if (updateCategory(connection(), $_POST)) {
        header('Location: /admin/category/');
        return true;
    }
    return false;
}

/**
 * Страница администрирования продуктов
 * @param Smarty $smarty
 * @return bool
 */
function productsAction(Smarty $smarty)
{
    $rsAllCategories = getCategoriesByParent(connection());
    $rsProducts = getProducts(connection());
    $smarty->assign('pageTitle', 'Страница редактирования товаров');
    $smarty->assign('rsCategories', $rsAllCategories);
    $smarty->assign('rsProducts', $rsProducts);
    loadTemplate($smarty, 'admin-header');
    loadTemplate($smarty, 'admin-product');
    loadTemplate($smarty, 'admin-footer');
    return true;
}
