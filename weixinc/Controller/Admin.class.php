<?php 

namespace Controller;
use libs\Controller;
use Models\Coupon;
class Admin extends Controller{

		//优惠卷生成的页面
		public function index(){
			$this->display();

		}
		public function add(){
			 $post = $_POST;
			 p($post);
			 $post['code'] = uniqid().time();
			 $post['createtime']= time();
			 $post['status'] = 1;
			 $model = new Coupon();
			 $res = $model->insert($post);
			 if ($res) {
			 	header("location:http://www.chaicong.com/w/weixinc/index.php?c=admin&a=show");
			 }else{
			 	echo 'error';
			 }

		}
		public function show(){
			 $model = new Coupon();
			 $res = $model->select();
			 $this->assign('res',$res);
			 $this->display();
		}

		public function ajax(){
			 $code = $_POST['code'];
			 $model = new Coupon();
			 $res = $model->where("code='".$code."'")->select();
			 if ($res) {
			 	$msg = [
			 			'status'=>1,
			 			'msg'	=>'你的优惠券的面值是'.$res[0]['money'],
			 			'money' =>$res[0]['money'],
			 		];
			 }else{
			 	$msg = [
			 			'status'=>0,
			 			'msg'	=>'不存在的',
			 		];
			 }

			 echo json_encode($msg);
		}
}




 ?>