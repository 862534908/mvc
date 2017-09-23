<?php 
/**
 * 封装上传类
 * 
 */

namespace libs;
class Upload
{
	
	public $path=__PUBLIC__.'img';
	public $size='';
	public $type ='jpeg,png,jpg,gif';
	public $file='';

	function __construct()
	{
		$this->file=$_FILES;

	}

	public function path(){
		 $path = $this->path.date('Y-m-d');
		 is_dir($path) || mkdir($path,0777,true);
		 return true;

	}

	public function type(){

	}

	public function file(){

	}

	public function savePath($path){
		 $this->path = $path;
		 return $this;
	}
	public function size(){

	}


}








 ?>