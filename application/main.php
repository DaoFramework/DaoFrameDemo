<?php
// DEFINE PATH
define('APPLICATION_PATH', __DIR__);
define('CONFIG_PATH', APPLICATION_PATH.'/config');

define('MODEL_PATH', APPLICATION_PATH.'/models');
define('MODULES_PATH', APPLICATION_PATH.'/modules');

require APPLICATION_PATH.'/../vendor/autoload.php';

// Log
if (!is_dir(APPLICATION_PATH.'/logs/')) {
  mkdir(APPLICATION_PATH.'/logs/', 0700);
}
$monolog = new \Monolog\Logger('system');
$monolog->pushHandler(new \Monolog\Handler\StreamHandler(APPLICATION_PATH.'/logs/app.log', \Monolog\Logger::ERROR));
var_dump($monolog);

\DaoFramework\core\Route::test();
