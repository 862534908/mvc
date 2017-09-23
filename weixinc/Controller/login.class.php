<?php 
namespace Controller;
use libs\Controller;

class Login extends controller{

    /**
     * 默认为登录页面
     * @return [type] [description]
     */
	public function index(){
	 	
	 	
		 $this->display();
	}

	public function den(){
		//header('location:http://www.chaicong.com/w/weixinc/index.php?c=login&a=index');
			/*$data = $_POST;
			$model = new \Models\user();
			//$res = $model->where(['id'=>1])->delete(); 	
			$res = $model->where()->select();
		 	
		 	p($res);*/
		/*session_start();

		
	
		echo $_SESSION['favcolor']; // green
		echo $_SESSION['animal'];   // cat
		echo $_SESSION['time'];*/
			
		//echo date('Y m d H:i:s', $_SESSION['time']);

	}

	public function sign(){
		$this->display();

	}
}




?>