<?php

// 实现微信接口的认证
namespace libs;
class Wechat{
	const TOKEN='chaicong';
    public $header_doc = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>%s</ArticleCount>
				<Articles>";

	public $item_doc = "<item>
				<Title><![CDATA[%s]]></Title> 
				<Description><![CDATA[%s]]></Description>
				<PicUrl><![CDATA[%s]]></PicUrl>
				<Url><![CDATA[%s]]></Url>
				</item>";
	public $end_doc = "</Articles></xml>";
	public function __construct(){
		$flag = $this->signal();
		if($flag && isset($_GET['echostr'])){
			echo $_GET['echostr'];
		}else{
			echo '';
		}
	}
	public function signal(){
		if(isset($_GET['echostr'])){
		$timestamp = $_GET['timestamp']; // 时间戳
		$nonce = $_GET['nonce']; // 随机数
		$signature = $_GET['signature'];
		// 第一步生成签名
		$arr = [self::TOKEN,$timestamp,$nonce];
		sort($arr,SORT_STRING);
		$str = sha1(implode('',$arr));
		if($str == $signature){
			return true;
		}else{
			return false;
		}
		}
		return true;
	}
	// 消息解释
	public function parseMessage(){
		// 类型 MsgType 进行不同的解释
		// 接收信息
		// 第一种方式  $GLOBAL['HTTP_RAW_POST_DATA'];
		// 第二种方式 流式读取   php://input 得到原始的数据
		$data = file_get_contents("php://input");
		//echo $data;
		if($data){
			// 如何解析XML
			// 1. 使用SimpleXml
				//new SimpleXMLElement
			// 2. DOMDocument
			// 3. XMLReader  当内存小的情况，它是首选
			// 4. simplexml_load_string simplexml_load_file
			$postObj = simplexml_load_string($data);
			// 得到消息
            $type = trim($postObj->MsgType);
            $response = '';
            // 根据消息类型进行解析和响应
            switch($type){
            	case 'event':
            		
            		$response = $this->c_event($postObj);
            		break;
            	case 'text':
            	
            		$response = $this->handleText($postObj->ToUserName,$postObj->FromUserName,$postObj);
            		break;
            	
        
            	
            	
            		
            	 	break;
            	default:
            }
            echo $response;
		}
	}

	//关注处理
	 public function c_subscribe($postObj){
	 	$userInfo = $this->getUserInfoById($postObj->FromUserName);
       $msg = [
            				[
            					'title'=>'欢迎你,亲爱的'.$userInfo->nickname,
            					'description'=>'',
            					'picurl'=>'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1502522789&di=246569925dd93b304f02760213eadd16&src=http://58pic.ooopic.com/58pic/12/82/93/82y58PICIhb.jpg',
            					'url'=>'http://www.baidu.com',
            				],	
            				[
            					'title'=>'欢迎你,亲爱的'.$userInfo->nickname,
            					'description'=>'我们一起撸一撸',
            					'picurl'=>$userInfo->headimgurl,
            					'url'=>'http://www.baidu.com',
            				],	
            			];
	 	$response = $this->reponseText($postObj->ToUserName,$postObj->FromUserName,$msg);
	 	$this->c_user_add($FromUserName);
	 	return $response;

	 }

	public function c_user_add($userid){

		 $model = new  \Models\User();
		 $data  = array('username'=>$userid);
		 $model->insert($data);

		 
	}




	 public function c_event($postObj){
	 	  switch ($postObj->Event) {
	 	  	case 'subscribe':
	 	  			$response = $this->c_subscribe($postObj);
	 	  		break;
	 	  	case 'CLICK':
	 	  			$response = $this->c_onclick($postObj);
	 	  			//$response = $this->reponseText($postObj->ToUserName,$postObj->FromUserName,'4465');
	 	  		break;
	 	  	
	 	  	default:
	 	  	
	 	  		break;

	 	  }
	 	  return $response;
	 }
	 public function c_onclick($postObj){
	 		switch ($postObj->EventKey) {
	 			case 'intro':
	 				 $msg = [
            				[
            					'title'=>'欢迎查看简介',
            					'description'=>'',
            					'picurl'=>'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1502522789&di=246569925dd93b304f02760213eadd16&src=http://58pic.ooopic.com/58pic/12/82/93/82y58PICIhb.jpg',
            					'url'=>'http://www.baidu.com',
            				],
            			];
	 				$response =  $this->reponseText($postObj->ToUserName,$postObj->FromUserName,$msg);
	 				break;
	 			
	 			default:
	 				# code...
	 				break;
	 		}
	 	  // $response = $this->reponseText($postObj->ToUserName,$postObj->FromUserName,'4465');
	 	  return $response;
	 }

	//获取所有的用户的ID值
	public function getUserlist(){
		
		  $filepath = APP_PATH.DS.'public'.DS.'Userlist.php'; 
		 
		  if (file_exists($filepath) && time()-filemtime($filepath)<300) {
		  	$res = file_get_contents($filepath);
		  }else{
		  	$accessToken = $this->getAccessToken();
		  	
		  	$url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$accessToken->access_token.'&next_openid=';
		  
		  	$res = http::getInfoByUrl($url);

		  	file_put_contents($filepath,$res);
		  }
		  return json_decode($res,true);
		
	}
	/**
	 * 获取用户的详细信息
	 * @param ID $[name] [description]
	 * @return obj 
	 */
	public function getUserInfoById($openid){
      $accesstoken = $this->getAccessToken();
      $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accesstoken->access_token.'&openid='.$openid.'&lang=zh_CN';
      $res = Http::getInfoByUrl($url);
      return json_decode($res);
	}

   /**
    * 群发消息
    * 
    */
    public function sendAll(){
    	$accesstoken=$this->getAccessToken();
    	
    	
    	$userlist = $this->getUserlist();
  		
  		

		$data =  '{"touser":[';
		foreach ($userlist['data']['openid'] as $key => $value) {
    		$data.='"'.$value.'",';
    	}
    	
    	$data = rtrim($data,',');
		$data.=   '],"msgtype": "text","text":
		 { "content": "天使啊"}}';

	
		echo '<pre>';
		
   		print_r(json_decode($data,true));
		$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$accesstoken->access_token;

	
		$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
		echo $res;
    }
	
	

	
	// 发送文本信息
	public function reponseText($fromUser,$toUser,$message){

 		if (is_array($message)) {
 			 $str = sprintf($this->header_doc,$toUser,$fromUser,time(),count($message));
 			 foreach ($message as $key => $row) {
 			 $str.= sprintf($this->item_doc,$row['title'],$row['description'],$row['picurl'],$row['url']);
 			 }
 			$str.=$this->end_doc;
 		
 		}else{



		$str = "<xml>
				 <ToUserName><![CDATA[%s]]></ToUserName>
				 <FromUserName><![CDATA[%s]]></FromUserName>
				 <CreateTime>%s</CreateTime>
				 <MsgType><![CDATA[text]]></MsgType>
				 <Content><![CDATA[%s]]></Content>
				 </xml>";
		$str = sprintf($str,$toUser,$fromUser,time(),$message);
		
		}   
		return  $str;
    }

	public function handleText($fromUser,$toUser,$message){

		switch($message){

			case '周国强':
				$msg = "我的php启蒙老师啊！";
				break;
			case '图片':
				$msg = [
					[
						'title'=>'风景正好',
						'description'=>'山好',
						'picurl'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1502458466675&di=e4a33920980f2a3156a7928bde894ddd&imgtype=0&src=http%3A%2F%2Fpic124.nipic.com%2Ffile%2F20170313%2F23313285_204125403000_2.jpg',
						'url'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1502458466675&di=e4a33920980f2a3156a7928bde894ddd&imgtype=0&src=http%3A%2F%2Fpic124.nipic.com%2Ffile%2F20170313%2F23313285_204125403000_2.jpg'
					],
				];
				break;
			default:
				if($msg = $this->c_substr($message));
		}
		return $this->reponseText($fromUser,$toUser,$msg);
	}

	

	/**
	 * 接口调用预先处理
	 * @param  [type] $str [description]
	 * @return [type] $str [description]
	 */
	public function c_substr($str){
		
			// 正则匹配
			$msg = '可能还有好多没做的';
			    if(preg_match("/^测八字#(.*)/", $str,$match)){
			    	// 进行接口的访问
			    	$msg = Util::getFortune($match[1]);
			    }
			    if(preg_match("/^天气#(.*)$/",$str,$match)){
			    	$city = trim($match[1]);
			    	if($city){
			    		$msg = Util::getWeather($city);
			    	}
			    }
			   
			  return $msg;

	/*		$pos = strpos($str,'天气');
			if ($pos) {
				 $str = str_replace('天气','',$str);
			}
			$url = 'http://api.k780.com/?app=weather.future&weaid='.$str.'&&appkey='.KEY.'&sign='.SIGNTURE.'&format=json';
			
			$str = Http::getInfoByUrl($url);
			$arr = json_decode($str);*/

			


	}
	

	// 发送图片信息
	public function reponseImage(){
		

	}

	//获取token值
	  public function getAccessToken(){
	  	   
	  	    $filepath = APP_PATH.DS.'public'.DS.'token.php';
	  	  
	  		if (file_exists($filepath) && (time()-filemtime($filepath))<7200) {

	  		$accessToken = file_get_contents($filepath);
	  		

	  		}else{
	  		//$accessToken = Http::getInfoByUrl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
	  		  $accessToken = Http::getInfoByUrl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
			  
			  file_put_contents($filepath,$accessToken);
	  		}

	  		return json_decode($accessToken);
	  }

	  //删除菜单
	public function deleteMenu(){
		$accesstoken = $this->getAccessToken();

		$res = Http::getInfoByUrl("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$accesstoken->access_token);
		var_dump($res);
	}
    //创建表单  $data json
	public function createMain(){
		// 第一步获取accesstoken
		$accesstoken = $this->getAccessToken();
		// 第二步进行菜单的提交操作
		//  https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$accesstoken['accesstoken']
		// post
		// 数据是一个json格式

 	$data = '{
     "button":[
     {	
          "type":"click",
          "name":"首页",
          "key": "scancode"
      },
       {	
          "type":"click",
          "name":"简介",
          "key": "intro"
       },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"我的位置",
               "url" :"http://106.15.183.189/chaicong/index.php/map/index"
            },
            {
               "type":"click",
               "name":"我的商城",
               "key":"buy"
            }]
       }]
 }';



 	//$res = Http::getInfoByUrl("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accesstoken->access_token,[CURLOPT_CUSTOMREQUEST=>"POST",CURLOPT_POSTFIELDS=>$data,CURLOPT_SSL_VERIFYPEER=>false]);
 	$res = Http::getInfoByUrl("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accesstoken->access_token,[CURLOPT_CUSTOMREQUEST=>"POST",CURLOPT_POSTFIELDS=>$data,CURLOPT_SSL_VERIFYPEER=>false]);

 	var_dump($res);
		
	}
     //创建标签
     public function createTag($name){
     	$accesstoken = $this->getAccessToken();
     	$url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$accesstoken->access_token;
		     	$data = '{
		  "tag" : {
		    "name" : "'.$name.'"
		  }
		}';
	 	$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
	 	var_dump($res);
     }
     //获取 公众号  已创建的标签
     public function getlistTag(){
     	 $accesstoken = $this->getAccessToken();
     	 $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$accesstoken->access_token;
         $res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
         var_dump($res);
     }
     //编辑标签
     public function updateTag($id,$name){
     	$accesstoken = $this->getAccessToken();
     	$url = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.$accesstoken->access_token;
     	$data = '{"tag" : {    "id" :'.$id.',    "name" : "'.$name.'"}}';
     	$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
        var_dump($res);
    }
    //删除标签
    public function deleteTag($id){
    	$accesstoken = $this->getAccessToken();
    	$url = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$accesstoken->access_token;
    	$data='{ "tag":{ "id" : '.$id.' } }';
    	$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
        var_dump($res);


    }
    //获取标签下粉丝列表
    public function TagtoUserlist($id,$openid=''){
    	$accesstoken = $this->getAccessToken();	
    	$url = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$accesstoken->access_token;
    	$data = '{"tagid" :'.$id.',"next_openid":"'.$openid.'"}';
    	$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
        var_dump($res);

    }
    // 批量为用户打标签
    public function createUseTag($tagid=''){
    	$accesstoken= $this->getAccessToken();
    	$userlist = $this->getUserlist();
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$accesstoken->access_token;
    	$data = '{
  			"openid_list" : [';

		foreach ($userlist['data']['openid'] as $key => $value) {
    		$data.='"'.$value.'",';
    	}
    		$data = rtrim($data,',');
	  		$data .='],"tagid" :'.$tagid.'}';
	  		$res = Http::getInfoByUrl($url,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data]);
        	var_dump($res);
    }



}


