<?php 

define('DS',DIRECTORY_SEPARATOR);  //自动转换斜杠

define('LIBS',APP_PATH.DS.'lib'.DS);
define('EXT','.class.php');
define('VIEWS',APP_PATH.DS.'views'.DS);
define('RUNTIME',APP_PATH.DS.'runtime'.DS);

define('FUNDIR',APP_PATH.DS.'functions'.DS);
define('__ROOT__',str_replace($_SERVER['DOCUMENT_ROOT'],'',APP_PATH).DS);
define('__STATIC__',__ROOT__.'static'.DS);
define('__PUBLIC__',__ROOT__.'public'.DS);

define('APPID','');
define('APPSECRET','');
define('KEY','');  //K780
define('SIGNTURE','');  //K780

defined('IS_GET')      		   OR define('IS_GET',strtoupper($_SERVER['REQUEST_METHOD']=='GET'?TRUE:FALSE)); 
defined('IS_POST')      	   OR define('IS_POST',strtoupper($_SERVER['REQUEST_METHOD']=='POST'?TRUE:FALSE)); 
defined('AJAX')    		  	   OR define('AJAX',strtoupper($_SERVER['REQUEST_METHOD']=='POST'?TRUE:FALSE)); 


 ?>