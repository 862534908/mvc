<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH;?>normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH;?>demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH;?>component.css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<form action="index.php?c=login&a=den" method="post">
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>欢迎你</h3>
						<form action="#" name="f" method="post">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
							</div>
						<div class="mb2"><a class="act-but submit" href="javascript:;" style="color: #FFFFFF">登录</a></div>
							
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="<?php echo JSPATH;?>TweenLite.min.js"></script>
		<script src="<?php echo JSPATH;?>EasePack.min.js"></script>
		<script src="<?php echo JSPATH;?>rAF.js"></script>
		<script src="<?php echo JSPATH;?>demo-1.js"></script>
		<div style="text-align:center;">

</div>
</form>
	</body>
</html>

<script src="./js.js"></script>
