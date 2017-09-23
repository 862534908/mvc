<?php 
namespace Controller;
use libs\Controller;
use libs\Model;
use Models\user;
/**
* 
*/
class log extends Controller
{
	
	public function index(){
			$this->display();
	}
	public function den(){
		 $post = $_POST;
		 if ($post<2) {
		 	die('輸入有誤');
		 }
		 $SQL = "select * from user where username=".$post['username'].' or tel='.$post['username'].' or email='.$post['username'];
		 
		 $model = new user;
		 $res = $model->exec($SQL);
		
		 if (!$res)die('用戶名或密碼輸入錯誤');
		 if ($res[0]['pwd']!=$post['pwd'])die('用戶名或密碼輸入錯誤');
		 header("location:http://www.chaicong.com/w/weixinc/index.php?c=shop&a=index");
	}

}






 ?>