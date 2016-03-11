<?php
define('Dao_PATH', __DIR__);
require Dao_PATH.'/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
//注册Autoload
$loader->register();
//添加命名空间指向
$loader->addNamespace('Dao\Core', Dao_PATH.'/core');
$loader->addNamespace('Dao\Libary', Dao_PATH.'/library');
$loader->addNamespace('Dao\Services', Dao_PATH.'/services');
$loader->addNamespace('App', dirname(__DIR__).'/application');




use Dao\Core\Dao;
Dao::Run();
