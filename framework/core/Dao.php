<?php
namespace Dao\Core;

use Dao\Core\Route;

/**
* Dao Core
*/
class Dao
{

	function __construct()
	{
		# code...
	}

	public static function Run(){
		Route::monitor();
	}


}
