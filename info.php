<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>零售业务管理系统</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
<style>

</style>
</head>

<body>	
<?php
	include("head.php");
?>
	<div style="height: 100px"></div>
<?php	
	echo "<h1 align='center'>$head</h1>"."<br>";
?>
<table width="60%" align="center" border="0" style="font-size:22px">
	<tr><th width="33%" align="left"><a href="insert.php?tb=<?php echo $tb;?>" style="text-decoration:none;color: blue;"><span>添加</span></a></th>
			<?php
				if($tb==5){
			?>
			<th width="34%" align="center"><a href="find_purchase.php" style="text-decoration:none;color: blue;"><span>查找</span></a></th>
			<th align="right"><a href="monthly_report.php" style="text-decoration:none;color: blue;"><span>月报表</span></a></th>
			<?php
				}
			?>
		</tr>
</table>

<table width="60%" align="center" border="1" class="gridtable">
	<tr align="center">
<?php
	include("conn.php");
	mysqli_set_charset($conn, 'utf8');

	$sql = "show columns from $table";
	
	$res = mysqli_query($conn, $sql);
	while ( $row = mysqli_fetch_array($res,MYSQLI_NUM) ) {
		echo "<th>$row[0]</th>";
	}
	echo "<th colspan='3' width='50px'>action</th></tr>";

	$sql = "call test.show_tuples('$table');";
	$results = mysqli_query($conn, $sql);
	if($results){
		$num = mysqli_num_rows($results);
		if($num){
			for($i=0; $i<$num; $i++){
				$row = mysqli_fetch_array($results, MYSQLI_NUM);
				$id = $row[0];
				$size = count($row);

				if($i%2==0){
					echo "<tr align='center'>";
					for($j=0; $j<$size; $j++){
						echo "<td>$row[$j]</td>";
					}
					echo "<td width='25px' style='padding:12px;'><a href='alter.php?tb=$tb&&id=$id' class='layui-btn'><span class='span'>修改</span></a></td><td width='25px' style='padding:12px;'><a href='delete_from_db.php?tb=$tb&&id=$id' class='layui-btn layui-btn-danger'><span class='span'>删除</span></a></td></tr>";
				}else{
					echo "<tr align='center' class='al'>";
					for($j=0; $j<$size; $j++){
						echo "<td>$row[$j]</td>";
					}
				
					echo "<td width='25px' style='padding:12px;'> <a href='alter.php?tb=$tb&&id=$id' class='layui-btn'><span class='span'>修改</span></a></td><td width='25px' style='padding:12px;'><a href='delete_from_db.php?tb=$tb&&id=$id' class='layui-btn layui-btn-danger'><span class='span'>删除</span></a></td></tr>";
				}
			}
		}
	}
?>
	</table>
	
</body>
</html>