<?php
/**
 * View Base Class
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-03-19 03:19:41
 * @version $Id$
 */
namespace Dao\Core;

use Dao\Core\File;

class View extends Init
{

	public $path = '';
	public $file = '';
	public $view = '';
	public $params = array();
	public $layout = 'main';
	public $extend = '.php';
	public $layoutFile = '';
	public $tempFile = '';
	public $viewFile = '';

	/**
	 * 加载file
	 * @param string $file file namw
	 * @param array $params
	 */
	public function load($view,$params)
	{
		$this->view = $view;
		$this->params = $params;

		$this->setTemplate();
		$this->getContent();
	}

	protected function setFileDir()
	{
		if (count($files = explode('/', $this->view)) == 2) {
			$this->path = $files[0];
			$this->file = $files[1];
		}else{
			$this->file = $files[0];
		}
		$this->tempFile = TEMP_PATH.'/'.($this->path?$this->path.'/':'').$this->file.$this->extend;
		$this->viewFile = VIEWS_PATH.'/'.($this->path?$this->path.'/':'').$this->file.$this->extend;

	}

	protected function setTemplate()
	{
		if ($this->checkTempFile()) {
			return true;
		}
		$this->setFileDir();
		$this->getLayoutPath();
		$this->updateTempFile();
	}

	protected function getLayoutPath(){
		if ($this->layout) {
			$this->layoutFile = VIEWS_PATH.'/layout/'.$this->layout.$this->extend;
		}
	}

	protected function updateTempFile()
	{
		$mainContent = File::getContent($this->viewFile);
		if ($this->layoutFile) {
			$layoutContent = File::getContent($this->layoutFile);
			$layoutContent = str_ireplace('<?=$content?>',$mainContent,$layoutContent);
			$layoutContent = str_ireplace('<?=require ','<?php require VIEWS_PATH."/layout/".',$layoutContent);
			$mainContent = $layoutContent;
			unset($layoutContent);
		}

		File::updateFileContent($this->tempFile,$mainContent);
	}

	protected function checkTempFile()
	{
		if ($this->checkModifyTime()) {
			return true;
		}
		return false;
	}

	protected function checkModifyTime()
	{
		if (File::getFileModidyTime($this->tempFile) < File::getFileModidyTime($this->viewFile) ) {
			return true;
		}
		return false;
	}

	protected function getContent(){
		File::requireFile($this->tempFile,$this->params);
	}

}
