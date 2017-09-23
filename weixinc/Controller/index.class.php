<?php 

namespace Controller;
use libs\Model;
use libs\Controller;
Class index extends Controller
{	

	private static $wechat;
	public function init(){
		self::$wechat= new \libs\Wechat();
	}
	public function index(){
		
		self::$wechat->parseMessage();
	}
	public function res(){
	
		self::$wechat->c_user_add('fes');
	}
	public function cons(){
		self::$wechat ->TagtoUserlist('101');

	}
   

}




 ?>