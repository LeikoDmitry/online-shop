<?php

/**
 * Контроллер продуктов
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';

/**
 * Экшен вывода продуктов
 * @param Smarty $smarty
 */
function indexAction(Smarty $smarty)
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $rsProduct = getProductById(connection(), $id);
    $categories = getAllCategories(connection());
    $smarty->assign('itemInCart', 0);
    if (in_array($id, $_SESSION['cart'])) {
        $smarty->assign('itemInCart', 1);
    }
    $smarty->assign([
        'pageTitle'  => 'Товар - ' . $rsProduct['name'],
        'categories' => $categories,
        'rsProduct'  => $rsProduct,
    ]);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}