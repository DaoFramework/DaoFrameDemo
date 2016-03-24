<?php
namespace Dao\Core;
/**
 * Error Class
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-20 14:45:33
 * @version $Id$
 */

/**
 * Error Base
 */
class Error
{
	/**
	 * Error Echo From debug_backtrace
	 * @return null
	 */
	public static function echo()
	{
		$debug = debug_backtrace();
		self::msg('line: '.$debug[1]['line'].'<br>'.$debug[1]['file'].'<br>'.implode('|', $debug[0]['args']));
	}

	public static function log()
	{

	}

	public static function msg($msg){
		if (is_string($msg)) {
			echo '<b style="color:red">Error: ',$msg,'</b><br>';
		}else if (is_array($msg)) {
			foreach ($msg as $key => $value) {
				echo '<b style="color:red">',$key,': ',$value,'</b><br>';
			}
		}
		die();
	}

}
