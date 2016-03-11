<?php
	/**
	* Reflection Test
	*/
	/**
	* This is Base
	*/
	class Base
	{

		function __construct()
		{
			return new ReflectionClass('Base');
		}
		function echoBase(){
			echo 'Base';
		}
	}
	/**
	 * This is Apple
	 */
	class Apple
	{
		public $var;
		public $Base;

		function __construct(Base $t)
		{
			echo 'Test';
			$this->Base = $t;
		}

		function type(){
			return 'Apple';
		}

	}
	/**
	 * This is Instance
	 */
	class Instance
	{
		public $id;
		public function __construct($id){
			$this->id = $id;
		}

		public static function of($id){
			return new static($id);
		}
	}

	$dependencies = [];
	echo '<br>Apple Export:<hr>';
	ReflectionClass::export('Apple');
	$reTest = new ReflectionClass('Apple');
	$Test = $reTest->getConstructor();
	echo '<br>Apple getConstructor:<hr>';
	var_dump($Test);
	$Params = $Test->getParameters();
	echo '<br>Apple getParameters:<hr>';
	var_dump($Params);
	echo '<br>Apple isDefaultValueAvailable:<hr>';

	foreach ($Params as $key => $value) {
		var_export($value->isDefaultValueAvailable);
		echo '<br>Apple isDefaultValueAvailable GetClass:<hr>';
		$class = $value->getClass();
		$instance = Instance::of($class===null?null:$class->getName());
		var_dump($instance);
		echo '----Id----',$instance->id,'----Id----';
		$dependencies[] = $instance;

	}
// 	var_dump($dependencies);
// 	echo '-----@-----';
// 	$bas = new Base();
// 	$app = new Apple($bas);
// var_export($app);
// 	echo $app->Base->echoBase();
// 	$newDe = $reTest->newInstanceArgs($dependencies);
// 	var_dump($newDe);


	function_exists(function_name)


 phpinfo();
?>
