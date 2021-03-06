<?php
namespace Dao\Core;
/**
 * DaoFramework Init File
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-19 00:40:36
 * @version $Id$
 */

class Init extends Base
{
	public $db = array();
	public $config = array();
	public $callArgs = null;
	public static $app = null;


	/**
	 * Init
	 * @param array $config 系统配置数组
	 * @return null
	 */
	public function initializa($config)
	{
		//$this->db = $config['db'];
		//unset($config['db']);
		$this->config = $config;
		self::$app = $this;
	}

	/**
	 * __Call
	 * @param string $func 预调用方法名
	 * @param array $arg 参数
	 * @return object new $func
	 */
	public function __call($func, $args)
	{
		$this->callArgs = $args;
		$func = __namespace__.'\\'.ucfirst($func);
		if (class_exists($func)) {
			 return new $func($this);
		}
		//错误处理
		//var_dump(debug_backtrace());trigger_error
		Error::echo('__Call '.$func.' Error');
	}




}
