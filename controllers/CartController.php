<?php

/**
 * контроллер корзины
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';
include_once __DIR__ . '/../models/OrdersModel.php';
include_once __DIR__ . '/../models/PurchesModel.php';


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
function orderAction(Smarty $smarty)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /cart/');
        return false;
    }
    $items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    if (! $items) {
        header('Location: /cart/');
        return false;
    }
    $data = $_POST;
    if (isset($_SESSION['saleCart'])) {
        unset($_SESSION['saleCart']);
    }
    $products = getProductsFromArray(connection(), $items);
    foreach ($products as &$product) {
        $product['count'] = isset($data[$product['id']]) ? $data[$product['id']] : null;
        if ($product['count']) {
            $product['realPrice'] = $product['count'] * $product['price'];
        }
    }
    $_SESSION['saleCart'] = $products;
    $categories = getAllCategories(connection());
    $smarty->assign('rsProducts', $products);
    $smarty->assign('pageTitle', 'Потверждение заказа');
    $smarty->assign('categories', $categories);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
    return true;
}

/**
 * Сохранение заказа
 */
function saveorderAction()
{
    $saleCart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : [];
    if (! $saleCart) {
        header('Location: /cart/');
        return false;
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /cart/');
        return false;
    }
    if (isset($_POST['confirm']) && $_POST['confirm'] !== null) {
        $id = makeNewOrder(connection());
        if ($id === false){
            $_SESSION['errors'] = ['order' => false];
            header('Location: /cart/');
        }
        if (setOrderForPurshed(connection(), $id, $saleCart) === true) {
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            header('Location: /user/');
            return true;
        }
    }
    header('Location: /user/');
    return true;
}

/**
 * Сохранение пользователя и заказа
 */
function orderuserAction()
{

}