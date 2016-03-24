<?php
namespace Dao\Core;
/**
 * Dao\Core\File
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-19 17:26:52
 * @version $Id$
 */

/**
 * File Class
 */
class File
{
	/**
	 * 获取文件内容
	 * @param  string $file 文件位置
	 * @return  string
	 */
	public static function getContent($file){
		if (file_exists($file)) {
			return file_get_contents($file);
		}
		return false;
	}

	/**
	 * 获取文件修改时间
	 * @param  string $file 文件位置
	 * @return int
	 */
	public static function getFileModidyTime($file)
	{
		clearstatcache();
		if (file_exists($file)) {
			return filemtime($file);
		}
		return 0;
	}

	/**
	 * 引入文件并初始化变量
	 * @param string $file 文件地址
	 * @param array $params 传入参数
	 * @return true/false
	 */
	public static function requireFile($file,$params)
	{
		if (file_exists($file)) {
			$params && extract($params);
			require $file;
			return true;
		}
		return false;
	}

	/**
	 * 更新文件内容
	 * @param string $file 文件位置
	 * @param string $content 文件内容
	 * @return int/false
	 */
	public static function updateFileContent($file,$content)
	{
		if (is_file($file)) {
			file_put_contents($file, $content);
		}else{
			static::createDir($file);
			file_put_contents($file, $content);
		}
	}

	/**
	 * 创建根据文件文件夹 暂无递归功能
	 * @param string $file 文件位置
	 * @return null
	 */
	public static function createDir($file){
		$dirname = dirname($file);
		if (!is_dir($dirname)) {
			mkdir($dirname);
		}
	}
}
