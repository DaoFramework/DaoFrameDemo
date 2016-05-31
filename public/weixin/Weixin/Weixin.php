<?php
namespace Weixin;

use Base\Curl;

/**
* Api Class
* @author  liaoyuan
*/
class Api
{
	/**
	 * getAccessToken 获取AccessToken
	 * @param Array $params 参数数组
	 *                      [
	 *                      	grant_type	是	获取access_token填写client_credential
	 *												appid				是	第三方用户唯一凭证
	 *												secret			是	第三方用户唯一凭证密钥，即appsecret
	 *                      ]
	 * @return  Json access_token:获取到的凭证 expires_in:凭证有效时间，单位：秒
	 *
	 */
	static public function getAccessToken($params=null){
		if ($_SESSION['access_token'] && (time()<$_SESSION['expires_in']) ) {
			static::returnData($_SESSION['access_result']);
		}
		$url = 'https://api.weixin.qq.com/cgi-bin/token';
		$result = Curl::getData($url,$params);

		static::returnData($result);
	}

	/**
	 * getCallbackIp 获取微信服务器IP地址
	 * @param  array $params 参数数组 [access_token=>access_token]
	 */
	static public function getCallbackIp($params=null){
		$url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip';
		$result = Curl::getData($url,$params);

		static::returnData($result);
	}


	function __call(){
		echo 'this is call';
	}


	/**
	 * returnData
	 */
	static public function returnData($result=null){
		return $result;
	}
}
?>
