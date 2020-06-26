<?php

const PATH_PREFIX = '/../controllers/';
const PATH_POSTFIX = 'Controller.php';
$template = 'default';
$templateAdmin = 'admin';
$path = __DIR__ . '/../views/' . $template . '/';
$pathAdmin = __DIR__ . '/../views/' . $templateAdmin . '/';
$templates = '/' . $template . '/';
$templatesAdmin = '/' . $templateAdmin . '/';
define('TEMPLATE_PREFIX', $path);
define('TEMPLATE_ADMIN_PATH', $pathAdmin);
define('TEMPLATE_POSTFIX', '.tpl');
define('TEMPLATE_WEB_PATH', $templates);
define('TEMPLATE_WEB_ADMIN', $templatesAdmin);
define('TEMPLATE_WEB_UPLOADS', '/uploads/');








