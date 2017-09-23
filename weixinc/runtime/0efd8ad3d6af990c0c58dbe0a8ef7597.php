<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<table>
<tr>
	<td>ID</td>
	<td>愿望</td>
</tr>

	 	<?php foreach((array)$res as $k=>$v){ ?>
			
				<tr>
					<td><?php echo $v['id'];?></td>
					<td><?php echo $v['wish'];?></td>
				</tr>
		

	   <?php } ?>
	   <?php echo $pagestr;?>
	 
</table>
	
</body>
</html>