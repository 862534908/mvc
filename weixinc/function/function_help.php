<?php 

function p($data){
	 echo '<pre>';
	 print_r($data);
}

function C($key=''){
	if($key){
		return libs\Configure::getConfig($key);
	}
	return libs\Configure::getConfig();
}


?>