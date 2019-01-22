<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改记录</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
</head>

<body>

<?php
	include("head.php");
?>
	<div style="height: 100px"></div>
<?php
	echo "<h1 align='center'>$head</h1>";
	echo "<h2 align='center'>修改记录</h2>";
	
	echo "<form width=50% align='center' method='post' action='alter_db.php?tb=$tb'>";
	
?>
	    
	<table class="gridtable" width="50%" align="center" border="0">
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

		$id = $_GET['id'];		
		$sql = "select * from $table where $id_field='$id'";
		$res = mysqli_query($conn, $sql);
		$values = mysqli_fetch_array($res);

		$sql = "show columns from $table";
		$res = mysqli_query($conn, $sql);
		$i = 0;
		while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){		
			$field = $row['Field'];
			$type = $row['Type'];
			$null = $row['Null'];
			$key = $row['Key'];

			if($i%2==0)
				echo "<tr>";
			else
				echo "<tr class='al'>";

			echo "<td>$field</td><td>$type</td><td>$null</td><td>$key</td>";

			if($null=='NO')
				$required="required='required'";
			else
				$required="";
			
			$value = $values[$i];
			$i+=1;
			
			if($type=='datetime-local'){
				$value[10] = 'T';
				echo "<td ><input type='datetime-local' name='$field' size='25' value='$value' data-maxlength='20' data-type='CHAR' $required></td>";
			}
			else
				echo "<td ><input type='text' name='$field' size='25' value='$value' data-maxlength='20' data-type='CHAR' $required></td>";
		}

?>
	
     <tr class="bl">
		<td><a href="info.php?tb=<?php echo $tb;?>" style="font-size:17px; ">返回</a><td>
		<td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
		<td></td>
		<td align="right"><input type="submit" name="submit" value="确定" style="font-family: verdana,arial,sans-serif; font-size:15px; font-weight: bold; "></td>
     </tr>

	</table>
</form>
</body>
</html>