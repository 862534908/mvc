<?php 

// 全局配置
$db = require('database.inc.php');
$config = array(

	'weixin'=>[
		'token'=>'xqhero2',
		'appid'=>'',
		'appsecret'=>'',
	],
	'templateParseStr'=>[
		'CSSPATH'=>__STATIC__.'css'.DS,
		'JSPATH'=>__STATIC__.'js'.DS,
	],
	'enableCacheFile'=>false,
	'cacheLifeTime'=>300,
	
	'function'=>[
			'function',
	]
);
return array_merge($db,$config);


 ?>