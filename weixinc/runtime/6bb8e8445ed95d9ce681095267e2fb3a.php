<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<form action="index.php?c=admin&a=add" method="POST">
	<table>
		<tr>
			<td>面值</td>
			<td><input type="text" name='money'></td>
			
		</tr>

		<tr>
	
			<td>开始时间</td>
			<td><input type="text" name='addtime'>1990-01-01</td>
			
		</tr>
			<td>结束时间</td>
			<td><input type="text" name='endtime'>1990-01-01</td>
		<tr>
			<td><button>提交</button></td>
		</tr>
	</table>
	</form>
</body>
</html>