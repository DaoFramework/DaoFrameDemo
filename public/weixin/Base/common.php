<?php
/**
* Curl Class
* @author  liaoyuan
*/
namespace Base;

session_start();

define('TOKEN', 'weixin');
define('APPID', 'wx789c648e8ead0536');
define('SECRET', '818f84c0da1f40178e8447a55dfba11d');

class Curl
{
	static public function getData( $url, $params=null ){
		if ($params) {
			$url .= '?'.http_build_query($params);
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

}

/**
* Common Class
* @author  liaoyuan
*/
class Common
{
	static public function volid()
	{
		if (!isset($_GET['token'])) {
			die('TOKEN is not defined!');
		}

		if ( static::checkSignature() ) {
			echo $_GET['echostr'];
		}
	}

	static public function checkSignature()
	{
		if (!defined("TOKEN")) {
      throw new \Exception('TOKEN is not defined!');
    }

		$arr = [$_GET['token'],$_GET['timestamp'],$_GET['nonce']];
		sort($arr);
		$tmpStr = implode($arr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $_GET['siginature']) {
			return true;
		}else{
			return false;
		}
	}

	static public function test(){
		echo 'Test';
	}
}

?>
