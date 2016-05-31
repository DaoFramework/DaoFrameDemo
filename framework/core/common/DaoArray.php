<?php
namespace Dao\Core\Common;

/**
 * array class file
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-22 17:14:50
 * @version $Id$
 */

class DaoArray
{

	public static function walk(&$a,$funcname)
	{
		array_walk($a,'self::'.$funcname);
	}

	public static function kvToDbValue(&$v,$k)
	{
		$v = '`'.$k.'`="'.$v.'"';
	}
}
