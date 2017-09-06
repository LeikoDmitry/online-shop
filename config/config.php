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

/** @var  $templateAdmin - шаблон админки */
$templateAdmin = 'admin';


/** @var  $path - путь к шаблонам */
$path = __DIR__ . '/../views/' . $template . '/';

 /** @var  $pathAdmin - путь к шпблонам админки */
$pathAdmin = __DIR__ . '/../views/' . $templateAdmin . '/';


/** @var  $templates - шаблоны по дефолту в веб пространстве */
$templates = '/' . $template . '/';

/** @var  $templates - шаблоны админки в веб пространстве */
$templatesAdmin = '/' . $templateAdmin . '/';


// Устанока путей к файлам
define('TEMPLATE_PREFIX', $path);
define('TEMPLATE_ADMIN_PATH', $pathAdmin);
define('TEMPLATE_POSTFIX', '.tpl');
define('TEMPLATE_WEB_PATH', $templates);
define('TEMPLATE_WEB_ADMIN', $templatesAdmin);

include_once __DIR__ . '/../library/smarty/libs/Smarty.class.php';

/** @var  $smarty - установка шаблонизатора */
$smarty = new Smarty();
$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir(__DIR__ . '/../tmp/smarty/templates_c');
$smarty->setCacheDir(__DIR__ . '/../tmp/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/../library/smarty/config');
$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);








