<?php
namespace Dao\Core;
/**
 * Request Class
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-20 14:04:41
 * @version $Id$
 */

class Request
{
	protected $query_string = '';
	protected $request_url = '';
	protected $request_method = '';
	protected $get = [];
	protected $post = [];
	protected $put = [];
	protected $delete = [];

	public function __construct()
	{
		$this->query_string = $_SERVER['QUERY_STRING'];
		$this->request_url = $_SERVER['REQUEST_URI'];
		$this->request_method = $_SERVER['REQUEST_METHOD'];
		$this->setParams();

	}

	/**
	 * Request Get Params
	 */
	public function get()
	{
		if (1==func_num_args()) {
			return isset($this->get[func_get_arg(0)])?$this->get[func_get_arg(0)]:'';
		}else if (1 < func_num_args()) {
			return array_intersect_key($this->get,array_flip(func_get_args()));
		}

		return $this->get;
	}

	/**
	 * Request Post Params
	 */
	public function post()
	{
		if (1==func_num_args()) {
			return isset($this->post[func_get_arg(0)])?$this->post[func_get_arg(0)]:'';
		}else if (1 < func_num_args()) {
			return array_intersect_key($this->post,array_flip(func_get_args()));
		}
		return $this->post;
	}

	/**
	 * Request Put params
	 */
	public function put()
	{

	}

	/**
	 * Request Delete Params
	 */
	public function delete()
	{

	}

	/**
	 * SetParams
	 */
	public function setParams(){
		switch ($this->request_method) {
			case 'GET':
				$this->setGetParams();
				break;

			case 'POST':
				$this->setPostParams();
				break;

			case 'PUT':
				$this->setPutParams();
				break;

			case 'DELETE':
				$this->setDeleteParams();
				break;

			default:
				$this->setGetParams();
				break;
		}
	}

	/**
	 * Set Get Params
	 */
	public function setGetParams()
	{
		unset($_GET);
		//$qs_array = explode('/', $this->query_string);
		$ru_array = explode('?', $this->request_url);
		array_shift($ru_array);

		$ru_array && array_map(function($value){
			$vv = explode('=', $value);
			$this->get[$vv[0]] = isset($vv[1])?$vv[1]:'';
		}, explode('&', $ru_array[0]));
	}

	/**
	 * Set Post Params
	 */
	public function setPostParams()
	{
		$this->post = $_POST;
	}

	/**
	 * Debug function return $_SERVE
	 */
	public function debug()
	{
		return $_SERVER;
	}

}
