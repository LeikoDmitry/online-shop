<?php

/**
 * контроллер корзины
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';

/**
 * Формирование страницы корзина
 * @param Smarty $smarty
 */
function indexAction(Smarty $smarty)
{
    $items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $categories = getAllCategories(connection());
    $rsProducts = getProductsFromArray(connection(), $items);
    $smarty->assign('itemInCart', 0);
    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('categories', $categories);
    $smarty->assign('products', $rsProducts);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');

}

/**
 * Добавление продукта в корзину ajax
 * @return string
 */
function addtocartAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $resData = [];
        if (isset($_SESSION['cart']) && array_search($id, $_SESSION['cart']) === false) {
            $_SESSION['cart'][] = $id;
            $resData['countItems'] = count($_SESSION['cart']);
            $resData['success'] = 1;
        } else {
            $resData['success'] = 0;
        }
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($resData);
        exit();
    }
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode([
        'error' => 'Need post request'
    ]);
    exit();
}


/**
 * Удаление продукта из корзины ajax
 * @return string
 */
function removetocartAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $resData = [];
        $key = array_search($id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            $resData['countItems'] = count($_SESSION['cart']);
            $resData['success'] = 1;
        } else {
            $resData['success'] = 0;
        }
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($resData);
        exit();
    }
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode([
        'error' => 'Need post request'
    ]);
    exit();
}

/**
 * Добавление заказа
 * @return bool
 */
function addorderAction()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /cart/');
        return true;
    }
    $items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    var_dump($items);
    exit;
}