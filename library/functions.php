<?php

/**
 * Файл различных функций проекта
 */

/**
 * Формирование запрашиваемой страницы
 * @param Smarty
 * @param string $controller
 * @param string $action
 * @return boolean
 */
function loadPage(Smarty $smarty, $controller, $action = 'index')
{
    $file = __DIR__  . PATH_PREFIX . $controller . PATH_POSTFIX;
    if (file_exists($file)) {
        include_once $file;
        $method = $action . 'Action';
        if ($action === 'error') {
            http_response_code(404);
        }
        call_user_func($method, $smarty);
        return true;
    }
    throw new BadFunctionCallException('Функции с таким именем не существует');
}

/**
 * Загрузка нужного шаблона
 * @param Smarty $smarty
 * @param $templateName
 * @return boolean
 */
function loadTemplate(Smarty $smarty, $templateName)
{
    $smarty->display($templateName . TEMPLATE_POSTFIX);
    return true;
}