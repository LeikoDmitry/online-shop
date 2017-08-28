<?php

/**
 * Файл настроек проекта
 */

/** Путь к контроллерам */
const PATH_PREFIX = '/../controllers/';
/** Окончание контроллера */
const PATH_POSTFIX = 'Controller.php';

/** @var  $template - используемый шаблон */
$template = 'default';

/** @var  $path - путь к шаблонам */
$path = __DIR__ . '/../views/' . $template . '/';
$templates = '/' . $template . '/';

// Устанока путей к файлам
define('TEMPLATE_PREFIX', $path);
define('TEMPLATE_POSTFIX', '.tpl');
define('TEMPLATE_WEB_PATH', $templates);

include_once __DIR__ . '/../library/smarty/libs/Smarty.class.php';

/** @var  $smarty - установка шаблонизатора */
$smarty = new Smarty();
$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir(__DIR__ . '/../tmp/smarty/templates_c');
$smarty->setCacheDir(__DIR__ . '/../tmp/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/../library/smarty/config');
$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);








