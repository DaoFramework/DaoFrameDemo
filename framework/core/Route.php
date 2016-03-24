<?php
namespace Dao\Core;

/**
* Route
*
*/
class Route
{

	public static $halts = false;
	public static $error_callback;

	/**
	 * Defines callback if route is not found
	 */
	public static function error($callback)
	{
		self::$error_callback = $callback;
	}

	/**
	 * 路由监听
	 * 暂时比较单一,之解析了 index/index格式
	 * 未来会逐渐添加自定义路由等功能
	 */
	public static function monitor()
	{
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$method = $_SERVER['REQUEST_METHOD'];
		$query_string  = $_SERVER['QUERY_STRING'];
		$found_route  = false;
		$matched = [];

		$segments = explode('/',$uri);
		if (!$segments[0]) {
			array_shift($segments);
			// Instanitate controller
			$contro = ucfirst($segments[0]);
			$action = ucfirst($segments[1]);

			$contro = '\App\Controllers\\'.$contro;
			$controller = new $contro;
		}else{

		}

		// Fix multi parameters
		if (!method_exists($controller, $action)) {
			echo "controller and action not found";
		} else {
			call_user_func_array(array($controller, $action), []);
			$found_route = true;
		}

		if ($found_route == false) {
			if (!self::$error_callback) {
				self::$error_callback = function () {
					header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
					echo '404';
				};
			}
			call_user_func(self::$error_callback);
		}
	}
}
