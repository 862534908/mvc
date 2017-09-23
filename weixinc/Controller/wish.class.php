<?php 

namespace Controller;
use libs\Controller;
use libs\Page;

use libs\Upload;


/**
* 许愿墙
*/
class wish extends Controller
{
	 
	 private static $model;
	 public function init(){
	 		self::$model = new \Models\Wish();
	 }
	 public function index(){

	 	if (IS_POST) {
	 	 	
		 	$res = self::$model->insert($_POST);
		 	if ($res) {
		 		$this->wishlist();
		 		exit;
		 	}
	 	}
	 	   $this->display();
	 }

	 public function wishlist(){
	    $wish = new \Models\wish;
	    $res = $wish->select();
	    $page = new Page(count($res),3);
	    $data = $wish->limit($page->pageSize,$page->limit())->select();
	    $pageStr = $page->show();
	    

	 	$this->assign(['res'=>$data,'pagestr'=>$pageStr]);
	 	$this->display();
	   
	 }

	 public function wishfile(){
	 	if (IS_POST) {
	 		$upload = new Upload;
	 		p($_FILES);
	 		
	 		exit;

	 	}
	 	 $this->display();
	 }
}





 ?>