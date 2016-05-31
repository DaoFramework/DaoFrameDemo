<?php
/**
 * Model Base Class
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-19 03:18:28
 * @version $Id$
 */
namespace Dao\Core\Database;


class Model extends PdoFactory
{

  function __construct()
  {
  	Parent::__construct();
  }
}
