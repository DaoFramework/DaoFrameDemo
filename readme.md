#DaoFramework

DaoFramework is a  web application framework.

##config
配置文件位于application\config 文件夹下
```
<?php
$config = [
    'name' => 'DaoFramework',
    'dafault' => 'index/index',
    'db' => [
        'driver' => 'mysql',
        'choose' => 'local',
        'database' => '17zan',
        'prefix' => '',
        'local' => require 'db_local.php',
        'product' => require 'db_local.php',
    ],
    'redis' => [
    ],
    'definition' => require 'definition.php',
    'route' => require 'route.php',
];
```

##controller
控制器文件存放application\controller文件夹
```
<?php
namespace App\Controllers;

use Dao\Core\Dao;
use Dao\Core\Controller;

class Index extends Controller {

  public function index()
  {
  }
}
```

>获取$config中变量的值可以这样写 `Dao::$app*(->config['name']`

##Database
数据库操作暂时没有ORM映射功能，支持链式操作，暂不支持直接SQL查
目前还缺少很多功能，会不断优化调整
```
$where = [
    'id'=>':id',
    'or'=>[
        'between'=>['id',':id2',':id3']
    ],
    'and'=>[
        '>'=>['id',10]
        '<'=>['id',100]
    ]
    'like' => ['name',':title']
];
```
支持各种无聊写法
```
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
```
##View
文件位于 application\views文件夹
目前支持原始语法 暂不支持模板语言，支持简单布局
