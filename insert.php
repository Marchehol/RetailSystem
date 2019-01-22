<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>新建记录</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
</head>


<body>
<?php
	include("head.php");
?>
	<div style="height: 100px"></div>
<?php
	echo "<h1 align='center'>$head</h1>";
	echo "<h2 align='center'>新建记录</h2>";
	
	echo "<form width=50% align='center' method='post' action='insert_to_db.php?tb=$tb'>";
?>

	<table class="gridtable" width="60%" align="center" border="0">
	<tr>
		<th width="15%">FIELD</th>
		<th width="20%">TYPE</th>
		<th width="20%">NULL</th>
		<th width="20%">KEY</th>
		<th width="25%">VALUE</th>
	</tr>

<?php
	include("conn.php");
	mysqli_set_charset($conn, 'utf8');

	$sql = "show columns from $table";
	$res = mysqli_query($conn, $sql);
	$i = 0;
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
		if($i%2==0)
			echo "<tr>";
		else
			echo "<tr class='al'>";
		$field = $row['Field'];
		$type = $row['Type'];
		$null = $row['Null'];
		$key = $row['Key'];
		echo "<td>$field</td><td>$type</td><td>$null</td><td>$key</td>";
		if($type=='datetime')
			$type = 'datetime-local';
		if($null=='NO')
			$required="required='required'";
		else
			$required="";
		echo "<td ><input type='$type' name='$field' size='25' data-maxlength='20' data-type='CHAR' $required></td>";
		echo "</tr>";
	}

?>
	
     <tr class="bl">
     	<td><a href="info.php?tb=<?php echo $tb; ?>" style="font-size:16px">返回</a><td><td><td><td align="right"><input type="submit" name="submit" value="确定" style="font-family: verdana,arial,sans-serif; font-size:15px; font-weight: bold; "></td>
     </tr>

	
	</table>
</form>

</body>
</html>