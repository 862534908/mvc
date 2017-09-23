<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>优惠卷展示</title>
</head>
<body>
	 <table>
	 	 	<th>ID</th>
	 	 	<th>面值</th>
	 	 	<th>验证码</th>
	 	 	<th>开始时间</th>
	 	 	<th>结束时间</th>
	 	 	<th>添加时间</th>
	 	 	<th>使用時間</th>
	 	 	<th>状态</th>
	 	 <?php foreach((array)$res as $k=>$v){ ?>
	 	 <tr>
	 	 	<td><?php echo $v['id'];?></td>
	 	 	<td><?php echo $v['money'];?></td>
	 	 	<td><?php echo $v['code'];?></td>
	 	 	<td><?php echo $v['addtime'];?></td>
	 	 	<td><?php echo $v['endtime'];?></td>
	 	
	 	 	<td><?php echo date("Y-m-d H:i:s",$v['createtime']);?></td>
	 	 	<td></td>

	 	 	<td><?php echo $v['status'];?></td>
	 	 </tr>
	 	 <?php } ?>
	 </table>
</body>
</html>