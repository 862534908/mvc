<?php 
    define('APP_PATH',PATH_SEPARATOR==';'?str_replace("\\","/",realpath(dirname(__FILE__))):realpath(dirname(__FILE__)));
    //define('APP_PATH',realpath(dirname(__FILE__)));
    include_once './config/constant.php';  //常量库

    include_once './libs/Autoload.class.php'; //自动加载类

     if($auto = new Autoload()){
	
     $Router = libs\Router::getInstance();
	   $controller=$Router->getCon();
	   $action 	=$Router->getAc();

	   $obj = new $controller;
	   $obj->$action();

	  //$obj = new libs\Wechat;
    /*  $controller =  $auto->c(); 
    $action 	=  $auto->a();
    
     $controller = str_replace('/','\\',$controller);
    
  

     echo $controller;
    $c = new $controller;*/
    // $c->$action();

}






?>