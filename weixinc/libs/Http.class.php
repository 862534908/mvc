<?php 
namespace libs;
class Http{
	public static function getInfoByUrl($url,$config=array()){
		$_config=[
			CURLOPT_URL => $url,
			CURLOPT_SSL_VERIFYPEER=>false,
		];
		$_config = $_config + $config;
		return self::_curl($_config);
	}

	public static function _curl($config){
		$ch = curl_init();    //初始化
		$_config = [
			CURLOPT_AUTOREFERER =>true,  //访问来源
			CURLOPT_RETURNTRANSFER => true,  //将返回的数据赋值给变量
		];
		$_config = $_config+$config;
		curl_setopt_array($ch,$_config);
		$res = curl_exec($ch);
		return $res;
	}

}

/*class Http{

	// 进行CURL操作
	public static function getInfoByUrl($url,$config=array()){
		$_config=[
			CURLOPT_URL =>$url,
		];
		$_config = $_config + $config;
		return self::_curl($_config);
	}

	public static function _curl($config){
		$ch = curl_init();
		$_config = [
			CURLOPT_AUTOREFERER =>true, 
  			CURLOPT_RETURNTRANSFER => true,
		];
		$_config = $_config + $config;
		curl_setopt_array($ch, $_config);
		$res = curl_exec($ch);
		return $res;
	}

}*/








 ?>