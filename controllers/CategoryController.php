<?php

/**
 * Контроллер категорий
 */

/** Подключение модели */
include_once __DIR__ . '/../models/CategoryModel.php';
include_once __DIR__ . '/../models/ProductsModel.php';

/**
 * Страница категорий
 * @param Smarty $smarty
 * @return bool
 */
function indexAction(Smarty $smarty)
{
    $rsProducts = null;
    $rsChildCategory = null;
    $id =  isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        $rsCategory = getCategoryById(connection(), $id);
        if ($rsCategory['parent_id'] == 0) {
            $rsChildCategory = getAllCategories(connection(), $id);
        } else {
            $rsProducts = getProductsByCategory(connection(), $id);
        }
        $categories = getAllCategories(connection());
        $smarty->assign('pageTitle', 'Товары категории - ' . $rsCategory['name']);
        $smarty->assign('rsCategory', $rsCategory);
        $smarty->assign('rsChildCats', $rsChildCategory);
        $smarty->assign('rsProducts', $rsProducts);
        $smarty->assign('categories', $categories);
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'category');
        loadTemplate($smarty, 'footer');
        return true;
    }
}