<?php
$config = [
	'name' => 'DaoFramework',
	'dafault' => 'index/index',
	'db' => [
		'driver' => 'mysql',
    'choose' => 'local',
    'database' => 'hnzzjob',
    'prefix' => '',
    'local' => require 'db_local.php',
    'product' => require 'db_local.php',
	],
	'redis' => [
	],
	'definition' => require 'definition.php',
	'route' => require 'route.php',
];
