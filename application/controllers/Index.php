<?php
/**
 * Index Controller
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-18 17:07:18
 * @version $Id$
 */
namespace App\Controllers;

use Dao\Core\Dao;
use Dao\Core\Controller;

class Index extends Controller {

  public function index()
  {
  	$get = Dao::$app->request()->get('ddd','dd','ddddd');
  	$where = [
  		'id'=>':id',
  		'or'=>[
  			'between'=>['id',':id2',':id3']
  		],
  		'like' => ['name',':title']
  	];
  	var_dump($where);
  	$data = Dao::$app->db()
  		->select('*')
  		->from('test_tets')
  		->where($where)
  		->bind([':id'=>1,':id2'=>10,':id3'=>14,':title'=>'%50%'])
  		->limit(1,10)
  		->order('id desc')
  		->exec()
  		->asArray();

  	//Dao::$app->db()->insert('test_tets',['id'=>14,'name'=>'哈哈哈哈w'])->exec();
  	Dao::$app->db()->update('test_tets',['name'=>'哈哈哈哈www'])->where(['id'=>14])->exec();
  	Dao::$app->db()->delete('test_tets')->where('id=13')->exec();

  	$this->render('index/index',['test'=>'dddddddddd']);
  }
}
