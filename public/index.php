<?php
use Dao\Core\Dao;

//PUBLC PATH
define('PUBLIC_PATH', __DIR__);

require PUBLIC_PATH.'/../framework/autoload.php';
require PUBLIC_PATH.'/../application/main.php';

Dao::Run($config);
