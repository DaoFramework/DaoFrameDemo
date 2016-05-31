<?php
//命名空间定义
$loader->addNamespace('App\Controllers', CONTROLLER_PATH);
$loader->addNamespace('App\Models', MODEL_PATH);
$loader->addNamespace('App\Modules', MODULES_PATH);
$loader->addNamespace('App\Views', VIEWS_PATH);
$loader->addNamespace('App\Temp', TEMP_PATH);

return [
	'App\Controllers' => CONTROLLER_PATH,
	'App\Models' => MODEL_PATH,
	'App\Modules' => MODULES_PATH,
	'App\Views' => VIEWS_PATH,
	'App\Temp' => TEMP_PATH,
];
