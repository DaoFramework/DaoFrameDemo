<?php
/**
 * DaoFramework Pdo Database Base Class
 *
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-21 04:13:32
 * @version $Id$
 */
namespace Dao\Core\Database;

use Dao\Core\Error;
use Dao\Core\Common\DaoArray;

/**
 * 此数据库操作类暂未实现读写分离，分库等操作；后期会逐渐增加
 */
class PdoFactory
{
	private static $driver = 'mysql';
	private static $choose = 'local';
	private static $read = [];
	private static $write = [];
	private static $database = '';
	private static $charset = 'utf8';
	private static $collation = 'utf8_unicode_ci';
	private static $connect = null;
  private static $prefix = '';
  private static $operators = ['not','and','or','beween','like','>','<','>=','<=','!=','='];
  private static $prep = ['not','and','or'];
  private static $wheresql = '';
  private $table = '';
  private $params = [];
  private $parameter = [];
  private $sql = '';
  private $handle = '';
  private $fetchAll = [];
  private $fetch = [];

  function __construct()
  {
  	self::init();
  }

  private function init()
  {
  	//var_dump($this->dao);
  	self::$driver = $this->dao->config['db']['driver'];
  	self::$choose = $this->dao->config['db']['choose'];
  	self::$database = $this->dao->config['db']['database'];
    self::$prefix = $this->dao->config['db']['prefix'];
  	self::$read = $this->dao->config['db'][self::$choose]['read'][0];
  	self::$write = $this->dao->config['db'][self::$choose]['write'][0];

		self::initConnect();

  }

  /**
   * 初始化数据库连接 暂未对多数据库做处理
   */
  private function initConnect()
  {
  	if (self::$connect['read'] && self::$connect['write']) {
  		return true;
  	}

  	try {
      $ccc[] = "mysql:host=127.0.0.1;port=3306;dbname=17zan;charset=utf8";
      $ccc[] = "root";
      $ccc[] = "123456";

      self::$connect['read'] = new \PDO( ...(self::getConfig('read')) );
		  self::$connect['write'] = new \PDO( ...(self::getConfig('write')) );
		  //var_dump(self::$connect);
      self::$connect['read']->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      self::$connect['write']->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      //设置数据库编码

		} catch (PDOException $e) {
		  Error::msg($e->getMessage());
		}
  }

  /**
   * 获取数据库连接信息
   * @param string $rw 获取读写标示read/write
   * @return array 配置信息
   */
  private function getConfig($rw='read')
  {
      return [
        self::$driver.':host='
        .self::$$rw['host'].';port='
        .self::$$rw['port'].';dbname='
        .self::$database.';charset='
        .self::$charset,
        self::$$rw['username'],
        self::$$rw['password']
      ];
  }

  /**
   * 获取连接
   */
  private function getConnect()
  {

  }

  /**
   * 新建连接
   */
  private function newConnect()
  {

  }

  /**
   * 设置Pdo连接属性
   */
  private function setAttribute()
  {

  }

  /**
   * 查询
   */
  public function select($select='*')
  {
    !$select && $select = '*';
  	$this->sql .= ' SELECT '.$select;
  	return $this;
  }

  /**
   * 关联表
   */
  public function from($table=null){
    !$table && Error::msg('Table name is empty string');
    $this->sql .= ' FROM `'.self::$prefix.$table.'`';
    return $this;
  }

  /**
   * 插入
   *
   * @param string $table 表名
   * @param array $params 插入的数据数组 ['col'=>'data'] 可绑定数据['col'=>':col']
   */
  public function insert($table=null,$params=null)
  {
    !$table && Error::msg('Table name is empty string');
    !$params && Error::msg('Params is empty array');

    $this->sql = ' INSERT INTO `'.self::$prefix.$table
      .'` (`'.implode('`,`', array_keys($params)).'`) VALUES("'
      .implode('","',array_values($params)).'")';
    return $this;
  }

  /**
   * 批量插入
   *
   * @param string $table 表名
   * @param array $keys 数据栏位数组
   * @param array $params 插入的数据数组 []['col'=>'data'] 可绑定数据['col'=>':col']
   */
  public function insertArray($table=null,$keys,$params=null)
  {
    !$table && Error::msg('Table name is empty string');
    !$params && Error::msg('Params is empty array');

    $this->sql = ' INSERT INTO `'.self::$prefix.$table.'` (`'.implode('`,`', $keys).'`) VALUES';

    $values = '';
    foreach ($params as $key => $value) {
      if (is_array($values)) {
        $values .= ($values?',':'').'("'.implode('","',array_values($value)).'")';
      }else{
        $values .= ($values?',':'').'("'.$value.'")';
      }
    }

    $this->sql .= $values;
    return $this;
  }

  /**
   * 更新
   *
   * @param string $table 表名
   * @param array $params 更新的数据数组 ['col'=>'data'] 可绑定数据['col'=>':col']
   *
   */
  public function update($table=null,$params=null)
  {
  	!$table && Error::msg('Table name is empty string');
    !$params && Error::msg('Params is empty array');
    DaoArray::walk($params,'kvToDbValue');

    $this->sql = ' UPDATE `'.self::$prefix.$table
      .'` SET '.implode(',', array_values($params));
    return $this;
  }
  /**
   * 删除
   *
   * @param string $table 表名
   */
  public function delete($table=null)
  {
    !$table && Error::msg('Table name is empty string');
    $this->sql = 'DELETE FROM `'.self::$prefix.$table.'` ';
    return $this;
  }

  /**
   * 参数绑定
   *
   * @param array $parameter 参数绑定数组 [':col'=>'data']
   */
  public function bind($parameter=[])
  {
    $this->parameter = array_merge($this->parameter,$parameter);
    return $this;
  }

  /**
   * 条件
   *
   * ===========================================================================
   * [
   *   and => [
   *     'col'=>data,
   *     'col1'=>':col1'
   *   ],
   *   or => [
   *     'col2' => data2,
   *     'col3' => ':col3'
   *   ],
   *   between => ['col4','a',':col4'],
   *   [
   *    'col5' => ':col5'
   *     or => [
   *       'col6' => ':col6'
   *     ]
   *   ],
   *   'col7' => ':col7',
   *   'lile' => ['col8','%:col8%']
   * ]
   * ===========================================================================
   * (col=data and col1=:col1) or (col2=data2 and col2=:col3)
   * and (cold between(a,:col4)) and (col5=:col5 or col6=:col6)
   * and (col7=:col7) and (col8 like % :col %)
   * ===========================================================================
   *
   * @param array||string $params 参数
   *
   */
  public function where($params=null)
  {
    !$params && Error::msg('Params is empty array');
    $this->sql .= ' WHERE '.self::buildWhere($params);
    return $this;
  }

  /**
   * 影响条数范围
   *
   * @param int $start 起始
   * @param int $end 终止
   */
  public function limit($start=1,$end=1)
  {
    $this->sql .= ' LIMIT '.$start.','.$end;
    return $this;
  }

  /**
   * 排序
   *
   * @param string $orderby 排序方式
   */
  public function order($orderby=null)
  {
    $this->sql .= $orderby?' ORDER BY '.$orderby:'';
    return $this;
  }

  /**
   * 执行
   *
   */
  public function exec()
  {
    try {
      $this->handle = self::$connect['read']->prepare($this->sql);
      $this->handle->execute($this->parameter);
    } catch(PDOException $e) {
      Error::msg($e->getMessage());
    } finally {
      return $this;
    }
  }

  /**
   * 数组化
   *
   */
  public function asArray()
  {
    $this->fetchAll = $this->handle->fetchAll();
    return $this->fetchAll;
  }

  /**
   * 取第一个
   *
   */
  public function one()
  {
    $this->fetch = $this->handle->fetch(PDO::FETCH_ASSOC);
    return $this->fetch;
  }

  /**
   * 获取最后插入ID
   *
   */
  public function id()
  {
    if (self::$connect['read']->lastInsertId()) {
      return self::$connect['read']->lastInsertId();
    }
    return 0;
  }

  /**
   * 获取影响记录条数
   *
   */
  public function rowCount()
  {
    if ($this->handle->rowCount()) {
      return $this->handle->rowCount();
    } else {
      return 0;
    }
  }




  /**
   * 删除连接
   *
   */
  public function delConnect()
  {

  }

  /**
   * Build Where
   *
   * @param array|string $params 参数
   */
  public static function buildWhere($params)
  {
    if (is_string($params)) {
      return $params;
    }else if (is_array($params)) {
      return ltrim(ltrim(self::buildWhereByArray($params)),'AND');
    }else{
      Error::msg('Params type is error');
    }
  }

  /**
   * 构建元素为Array的where语句
   *
   * @param array $array where构建数组
   * @param string $upkey array 键值
   *
   * @return string
   */
  public static function buildWhereByArray($array,$upkey=null)
  {
    $where = '';
    $wherearray = [];
    switch ($upkey) {
      case 'between':
        return $array['0'].' BETWEEN '.$array['1'].' AND '.$array['2'];
        break;

      case 'like':
        return $array['0']. ' LIKE '.$array['1'];
        break;

      case '>':
        return $array['0']. ' > '.$array['1'];
        break;

      case '>=':
        return $array['0']. ' >= '.$array['1'];
        break;

      case '<':
        return $array['0']. ' < '.$array['1'];
        break;

      case '<=':
        return $array['0']. ' <= '.$array['1'];
        break;

      case '!=':
        return $array['0']. ' != '.$array['1'];
        break;

      case '=':
        return $array['0']. ' = '.$array['1'];
        break;

      default:
        break;
    }

    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $where = self::buildWhereByArray($value,$key);
      }else if (is_numeric($key) || in_array($key, self::$operators)) {
        $where = $value;
      }else{
        $where = ' `'.$key.'`= '.$value;
      }

      if (in_array($key, self::$prep, TRUE)) {
        $where = ' '.strtoupper($key).' '.ltrim(ltrim($where),strtoupper($key));
      }else{
        $where = (in_array($upkey, self::$prep, TRUE)?' '.strtoupper($upkey).' ':' AND ').ltrim(ltrim($where),'AND');
      }
      $wherearray[] = $where;
    }
    return implode(' ', $wherearray);
  }



}
