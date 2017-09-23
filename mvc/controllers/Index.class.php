<?php

namespace controllers;
use libs\Controller;
//use models\Joke;

class  Index extends Controller {

	public function index(){
		
		// $model = new Joke();
		// $data = $model->select("select * from joke");
		$data = array(
				array('id'=>1,'username'=>'测试','age'=>18),
				array('id'=>1,'username'=>'测试','age'=>18),
				array('id'=>1,'username'=>'测试','age'=>18),
				array('id'=>1,'username'=>'测试','age'=>18),
			); 

		 $this->assign(['data'=>$data]);
		 $this->display();
		// 渲染模板引擎
	}

	public function demo(){
		echo "demo";
	}


}