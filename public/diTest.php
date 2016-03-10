<?php
/***********常规写法*************/
//定义邮件发送接口
	interface EmailSenderInterface
	{
		public function send();
	}
//定义GoogleEmail发送
	/**
	* Google Email Sender
	*/
	class GoogleSender implements EmailSenderInterface
	{
		public static $sender;
		//获取GoogleSender实例化
		public static function getInstance(){
			return self::$sender?self::$sender:new self();
		}

		public function send(){
			//....实现发送
			echo 'Send Success In ormal';
		}
	}
//定义评论类
	/**
	* CommentClass
	*/
	class Comment
	{
		public $emailSender;
		function __construct()
		{
			$this->emailSender = GoogleSender::getInstance();
		}

		function comment(){
			//....实现评论
			$this->emailSender->send();
		}
	}

//常规调用
 $comment = new Comment();
 $comment->comment();

?>
