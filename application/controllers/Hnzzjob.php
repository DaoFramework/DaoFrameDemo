<?php
/**
 * Hnzzjob Snoopy
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-04-08 23:12:00
 * @version $Id$
 */
namespace App\Controllers;
use Dao\Core\Dao;
use Dao\Core\Controller;
use Dao\Helper\Snoopy;

use App\Controllers\lib\HnzzjobSnoopy;

class Hnzzjob extends Controller
{
	public $baseUrl = 'http://www.hnzzjob.com/zpzj.aspx';
	public $baseSoure = 'http://www.hnzzjob.com/Resume.aspx?rcid=';
	public $baseReplace = 'http://www.hnzzjob.com/preview.aspx?t=p&';
	public $current = 1;
	public $lastPage = 0;

  public function index()
  {


for($i=1;$i<250;$i++){

		$this->current = $i;
		$snoopy = new Snoopy;
		$resultLinks = $snoopy->fetchlinks($this->baseUrl.'?page='.$this->current);
		$results = $resultLinks->results;

		array_walk($results,function(&$v,$k,$p){
			if ($r=strchr($v, 'rcid=')) {
				$v = $p.$r;
			}else{
				$v=null;
			}
		},$this->baseReplace);

		$nonull = array_unique($results);
		unset($nonull[0]);
		if ($nonull) {
			$id = Dao::$app->db()->insertArray('snoopyUrl',['url'],$nonull)->exec()->id();
		}

		sleep(1);
		echo $this->current.'<br>';
		unset($snoopy,$nonull);
}

  }

  public function snoopy()
  {
  	echo '-------------','<br/>';
  	$cccc = new HnzzjobSnoopy;
  	$this->render('hnzzjob/snoopy');
  }

  public function ajaxsnoopy()
  {
  	$url = Dao::$app->request()->post('snoopyurl');
  	$page = Dao::$app->request()->post('startpage');

  	$snoopy = new Snoopy;
		$resultLinks = $snoopy->fetchlinks($url.'?page='.$page);
		$results = $resultLinks->results;

		array_walk($results,function(&$v,$k,$p){
			if ($r=strchr($v, 'rcid=')) {
				$v = $p.$r;
			}else{
				$v=null;
			}
		},$this->baseReplace);

		$nonull = array_unique($results);
		unset($nonull[0]);
		foreach ($nonull as $key => $value) {
			Dao::$app->db()->insert('snoopyUrl',['url'=>$value])->exec()->id();
		}

		echo $page+1;
  }

  public function ajaxsnoopyContent()
  {
		$snoopy = new Snoopy;
		//&sti_StiWebViewer1_export=SaveHtml
		//http://www.hnzzjob.com/preview.aspx?t=p&rcid=000000170645
		$result = $snoopy->fetch('http://www.hnzzjob.com/preview.aspx?t=p&rcid=000000170645&sti_StiWebViewer1_export=SaveHtml');
		var_export($result);
  }

}
