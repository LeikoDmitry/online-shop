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
    try {
        $counts  = getCountProduct(connection());
    } catch (RuntimeException $exception) {
        $counts = [];
    }
    $paginator = [];
    $paginator['perPage'] = 3;
    $paginator['current_page'] = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $paginator['offset'] = ($paginator['current_page'] * $paginator['perPage']) - $paginator['perPage'];
    $products = getLastProduct(connection(), $paginator['offset'], $paginator['perPage']);
    $paginator['pageCount'] = (int) floor($counts / $paginator['perPage']);
    $categories = getAllCategories(connection());
    $smarty->assign('paginator', $paginator);
    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('categories', $categories);
    $smarty->assign('products', $products);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}