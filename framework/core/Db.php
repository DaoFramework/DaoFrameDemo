<?php
namespace Dao\Core;

use Dao\Core\Database\Model;
/**
 * Dao$app->db File
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-21 04:42:55
 * @version $Id$
 */

class Db extends Model
{
	public $dao = null;

	/**
	 * DB 构造函数，暂时不做类型强制校验
	 * @param object $dao Init类实例化
	 */
  function __construct($dao)
  {
  	echo 'db-';
  	$this->dao = $dao;
  	Parent::__construct();
  }
}
