<?php 

namespace Controller;
use libs\Model;
use libs\Controller;
Class map extends Controller
{	

	private static $wechat;
	public function init(){
		self::$wechat= new \libs\Wechat();
	}
	public function index(){
		$this->display();
		//self::$wechat->parseMessage();
	}

	public function cons(){
		self::$wechat ->TagtoUserlist('101');

	}
   

}