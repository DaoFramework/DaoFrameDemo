<?php
/**
 * Core Controller
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-18 17:12:07
 * @version $Id$
 */
namespace Dao\Core;

/**
 * Base Controller
 */
class Controller extends Init
{
	public static $view = null;
	public $layout = 'main';

	public function __construct()
	{
		self::$view = new View();
		if ($this->layout) {
			self::$view->layout = $this->layout;
		} else {
			self::$view->layout = '';
		}
	}

	/**
	 * view funtion
	 * @param string $file view file path
	 * @param array $params view file params array
	 * @return null
	 */
	public function render($file=null,$params=[]){
		!$file && die('View File Is Must Exist');
		$this->getView()->load($file,$params);
	}

	/**
	 * Get View
	 * @return object
	 */
	public function getView(){
		return self::$view;
	}

}
