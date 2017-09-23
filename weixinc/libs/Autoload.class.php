<?php 

/**
 * 自动调用类
 */
Class Autoload{



	private $controller = 'index';
	private $action 	   = 'index';
	
	private $controllerpath = 'Controller'.DS;


	 public function __construct(){
	  	 $this->fun();
	  	 spl_autoload_register(array($this,'load'));
	  }

	 public function load($classname){
	 	 $class = str_replace('\\',DS,$classname);
	 	 $class .=EXT;
	 	
 		if (file_exists($class)) {
 		  include_once APP_PATH.DS.$class;
 		 }else{
 		 	 echo '文件不存在';
 		 }

	 }

	 /**
	  * 实现加载function 
	  * 
	  */
	 
	 public function fun(){
	 	   $funfile = require APP_PATH.DS.'config/web.php';

	 	
	 	   foreach ($funfile['function'] as $key => $value) {
	 	   		require_once APP_PATH.DS.'function/'.$value.'_help.php'; 	
	 	   } 
	 }

	


}
	






 ?>

