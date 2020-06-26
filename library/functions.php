<?php

/**
 * Файл различных функций проекта
 */

/**
 * Формирование запрашиваемой страницы
 * @param Smarty
 * @param string $controller
 * @param string $action
 * @return void
 */
function loadPage(Smarty $smarty, $controller, $action = 'index')
{
    $file = __DIR__  . PATH_PREFIX . $controller . PATH_POSTFIX;
    if (file_exists($file)) {
        include_once $file;
        $method = $action . 'Action';
        call_user_func($method, $smarty);
    }
}

/**
 * Загрузка нужного шаблона
 * @param Smarty $smarty
 * @param $templateName
 * @return void
 * @throws Exception
 */
function loadTemplate(Smarty $smarty, $templateName)
{
    $smarty->display($templateName . TEMPLATE_POSTFIX);
}