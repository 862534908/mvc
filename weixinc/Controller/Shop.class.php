<?php 

namespace Controller;
use libs\Controller;
use Models\Product;
use Models\Coupon;

/**
* 
*/
class Shop extends controller
{
	public function index(){
		$model = new Product();
		$res = $model->exec('select * from product');
		$this->assign("res",$res);
		$this->display();
	}

	public function buy(){
		$post = $_POST;
		p($post);
		if ($post['coupon']!='on') {
			$this->coupon($post['coupon']);
		}

		print_r($post);
		
	}

	public function coupon($code){
		$model = new Coupon();
		$res = $model->where('code='.$code)->select();
		return $res[0]['money'];

	}






	 
}





 ?>