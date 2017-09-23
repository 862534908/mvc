<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<table>
		<?php foreach((array)$res as $k=>$v){ ?>
		<form action="index.php?c=shop&a=buy" method="post">
		  <input type="hidden" value="<?php echo $v['id'];?>" name='id'>
		 <tr>
		 	<td>商品名称</td>
		 	<td><?php echo $v['product'];?></td>
		 </tr>
			 <tr>
		 	<td>商品价格</td>
		 	<td><?php echo $v['money'];?></td>
		 </tr>
		 <tr>
		 	<td>商品库存</td>
		 	<td><?php echo $v['sku'];?></td>
		 </tr>
		 <tr>
		 	<td><input type="checkbox" class="check" name="coupon">使用优惠卷</td>
		 	
		 </tr>
		 <tr style="display:none">
		 	  <td><input type="text" class="blu"></td>
		 	  <td><a href="javascript:void(0)">发送邮件获取优惠码</a></td>
		 </tr>
		 <tr>
		 <td><button class="f">购买</button></td>
		 </tr>
		 </form>
		 <?php } ?>
	</table>

</body>
</html>
<script src="./js.js"></script>
<script>
	 $(".check").click(function(){
		 var status = ($(this).is(':checked'));
		 if (status) {
		 	$(this).parent().parent().next().show();
		 }else{
		 	$(this).parent().parent().next().hide();
		 }
	 })
	 $("a").click(function(){
	 	   $.ajax({
	 	   		type:'post',
	 	   		url:'index.php?c=email&a=ajax',
	 	   		data:{
	 	   			"1":1
	 	   		},

	 	   		success:function(data){
	 	   			alert(data);
	 	   		}

	 	   })
	 })
	 flag = false;
	 $(".blu").blur(function(){
	 		var	code = $(this).val();
	 		var _this=$(this);
	 		var price = _this.parent().parent().prev().prev().prev().find('td').eq(1).html();
	 		if (flag)return;
	 		$.ajax({
	 				type:"post",
	 				url:'index.php?c=admin&a=ajax',
	 				data:{
	 					code:code
	 				},
	 				dataType:'json',
	 				success:function(data){
	 					if (data.status==1) {
	 						flag=true;
	 						_this.parent().next().html(data.msg);
	 						_this.parent().parent().prev().prev().prev().find('td').eq(1).html(parseInt(price-data.money));
	 					}else{
	 						_this.parent().next().html(data.msg);
	 					}
	 				}

	 		})
	 })
</script>