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

class Hnzzjobajax extends Controller
{
	public $baseUrl = 'http://www.hnzzjob.com/zpzj.aspx';
	public $baseSoure = 'http://www.hnzzjob.com/Resume.aspx?rcid=';
	public $baseReplace = 'http://www.hnzzjob.com/preview.aspx?t=p&';
	public $current = 1;
	public $lastPage = 0;

  public function snoopyContent()
  {
		$snoopy = new Snoopy;
		//&sti_StiWebViewer1_export=SaveHtml
		//http://www.hnzzjob.com/Resume.aspx?rcid=
		//http://www.hnzzjob.com/preview.aspx?t=p&rcid=000000170645
		$result = $snoopy->fetch('http://www.hnzzjob.com/Resume.aspx?rcid=000000170645');
		var_export($result);
		// $result = $snoopy->fetch('http://www.hnzzjob.com/preview.aspx?t=p&rcid=000000170645&sti_StiWebViewer1_export=SaveHtml');
		// var_export($result);
  }

}
