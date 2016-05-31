<?php
/**
 * DaoFramework Base Class
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-19 02:21:16
 * @version $Id$
 */
namespace Dao\Core;

/**
 * Base Class
 */
class Base
{

  function __construct()
  {

  }

	/**
	 * Get
	 */
  public function get($id){
  	return new $id;
  }


}
