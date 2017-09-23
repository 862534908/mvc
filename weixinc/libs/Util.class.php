<?php 

/**
 * 接口调用类
 */
namespace libs;
class Util
{
	 public static function getWeather($city){

	 	$url = "http://api.k780.com:88/?app=weather.future&weaid=".$city."&&appkey=".KEY."&sign=".SIGNTURE."&format=json";
		$res = Http::getInfoByUrl($url);
	 	$arr = json_decode($res,true);
	 	if ($arr['success']==1) {
	 		return $arr['result'][0]['weather'];
	 	}else{
	 		return '该功能暂时无法使用';
	 	}
	 	
	 	
	 }
}









 ?>