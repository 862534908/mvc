<?php 

  	define('APP_PATH',realpath(dirname(__FILE__)));
    include_once './config/constant.php';  //常量库

    include_once './libs/Autoload.class.php'; //自动加载类
    if($auto = new Autoload()){
	
	if($auto = new Autoload()){
    		$Router = libs\Router::getInstance();
			$controller=$Router->getCon();
			$action    =$Router->getAc();
		
			$obj = new $controller;
			$obj->$action();
	}



 ?>