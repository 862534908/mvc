<?php 

/**
 * email 类的实现
 */


namespace libs;

class Emailse {

	public function sendemail(){
		/*
		jrqwwbpvureubbjc
		tjknaiqdtfgcbfbb
		*/
		header('content-type:text/html;charset=utf-8');
		include 'phpmailer.class.php';
		date_default_timezone_set("PRC");
		$mail = new PHPMailer();
		// 使用SMTP方式发送
		$mail->IsSMTP();
		// 设置邮件的字符编码
		$mail->CharSet='UTF-8';
		// 企业邮局域名
		$mail->Host = 'smtp.qq.com';
		//---------qq邮箱需要的------//设置使用ssl加密方式登录鉴权
		$mail->SMTPSecure = 'ssl';
		//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
		$mail->Port = 465;//---------qq邮箱需要的------
		// 启用SMTP验证功能
		$mail->SMTPAuth = true;
		//邮件发送人的用户名(请填写完整的email地址)
		$mail->Username = '862534908@qq.com' ;
		// 邮件发送人的 密码 （授权码）
		$mail->Password = 'tjknaiqdtfgcbfbb';  //修改为自己的授权码 
		//邮件发送者email地址
		$mail->From ='862534908@qq.com';
		//发送邮件人的标题
		$mail->FromName ='862534908@qq.com';
		//收件人的邮箱 给谁发邮件
		$email_addr = '862534908@qq.com';
		//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
		$mail->AddAddress("$email_addr", substr(  $email_addr, 0 , strpos($email_addr ,'@')));
		//回复的地
		$mail->AddReplyTo('862534908@qq.com' , "" );
		//$mail->AddAttachment("./mail.rar"); // 添加附件
		// set email format to HTML //是否使用HTML格式
		$mail->IsHTML(true);
		//邮件标题
		$mail->Subject = '1505phpc的测试邮件';
		
		//邮件内容
		$mail->Body =  "<p style='color:red'>" . '邮件测试' . '</p>';
		//附加信息，可以省略
		$mail->AltBody = '';
		// 添加附件,并指定名称//
		//$mail->AddAttachment( './error404.php' ,'php文件');
		//设置邮件中的图片//
		$mail->AddEmbeddedImage("shuai.jpg", "my-attach", "shuai.jpg");
		if( !$mail->Send() ){    
			$mail_return_arr['mark'] = false ;    
		 	$str  =  "邮件发送失败. <p>";   
		 	$str .= "错误原因: " . $mail->ErrorInfo;    
		 	$mail_return_arr['info'] = $str ;
		    }else{    
		 	$mail_return_arr['mark'] = true ;   
		 	 $str =  "邮件发送成功";    
		 	$mail_return_arr['info'] = $str ;
		     }
		     echo "<pre>";
		     print_r( $mail_return_arr); 
		
			}
		
		
		}







 ?>