<?php

/**
 * Контроллер главной страницы
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';

/**
 * Экшен по умолчанию
 * @param $smarty
 * @return true
 */
function indexAction(Smarty $smarty)
{
    $categories = getAllCategories(connection());
    $products = getLastProduct(connection(), 16);
    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('categories', $categories);
    $smarty->assign('products', $products);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
    return true;
}