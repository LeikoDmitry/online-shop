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
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
    /** Добавление продуктов */
    if (addProduct(connection(), $_POST) === true) {
        header('Location: /admin/products/');
        return true;
    }
    header('Location: /admin/products/');
    return false;
}

/**
 * Удаление продуктов
 * @return bool
 */
function prodeleteAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    deleteProduct(connection(), $id);
    header('Location: /admin/products/');
    return true;
}

/**
 * Обновление продукта
 * @param Smarty $smarty
 * @return bool
 */
function proupdateAction(Smarty $smarty)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $product = getProductById(connection(), $id);
        if (! $product) {
            header('Location: /admin/products/');
            return false;
        }
        $smarty->assign([
            'product'      => $product,
            'rsCategories' => getAllCategories(connection()),
            'pageTitle'    => 'Редактирование продукта'
        ]);
        loadTemplate($smarty, 'admin-header');
        loadTemplate($smarty, 'admin-updateProduct');
        loadTemplate($smarty, 'admin-footer');
        return true;
    }
    $response = updateProduct(connection(), $_POST);
    if (! $response) {
        header('Location: /admin/products/');
        return false;
    }
    header('Location: /admin/products/');
    return true;
}

/**
 * Получение
 * @param Smarty $smarty
 * @return bool
 */
function ordersAction(Smarty $smarty)
{
    $smarty->assign([
        'orders' => getOrders(connection()),
        'pageTitle' => 'Страница управления заказами'
    ]);
    loadTemplate($smarty, 'admin-header');
    loadTemplate($smarty, 'admin-orders');
    loadTemplate($smarty, 'admin-footer');
    return true;
}

/**
 * Удаление заказа
 * @return bool
 */
function updateorderAction()
{
    $idOrder = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if ($idOrder === null) {
        header('Location: /admin/orders/');
        return false;
    }
    if (updateProduct(connection(), $_POST)) {
        header('Location: /admin/orders/');
        return true;
    }
    return false;
}

/**
 * Удаление заказа
 * @return bool
 */
function deleteoderAction()
{
    $idOrder = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if ($idOrder === null) {
        header('Location: /admin/orders/');
        return false;
    }
    if (deleteOrder(connection(), $idOrder) === true) {
        header('Location: /admin/orders/');
        return true;
    }
    header('Location: /admin/');
    return false;
}


























