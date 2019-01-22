<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据管理</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
</head>

<body>	
<?php
	include("head.php");
?>
	<div style="height: 100px"></div>
<?php
	echo "<h1 align='center'>月 报 表</h1>"."<br>";
	echo "<form width=50% align='center' method='post' action='monthly_report.php'>";
?>

<table  align="center" border="0" style="font-size:25px">
<tr align="center">
	<th>选择产品</th>
	<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	<th>
	    <select name="pid" style="font-size:22px">
	    	<option disabled selected="selected">请选择</option>
<?php
	include("conn.php");
	$sql = "select pid, pname from products;";
	mysqli_set_charset($conn, 'utf8');
	$results = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($results);
	if($results && $num){
		for($i=0; $i<$num; $i++){
			$row = mysqli_fetch_array($results, MYSQLI_NUM);
			$size = count($row);
			echo "<option value='$row[0]'>$row[1]</option>";		
		}
	}
?>
	    </select>
	</th>   
	<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	<th>
		<input type="submit" name="submit" value="确定" style="font-size:20px">
	</th>    
</tr>
</table>
<?php
if(is_array($_POST)&&count($_POST)>0)
    {
        if(isset($_POST["pid"]))
        {
            $pid=$_POST["pid"];
?>

<table width="60%" align="center" border="1" class="gridtable">
	<tr align="center">
		<th>pid</th>
		<th>pname</th>
		<th>month</th>
		<th>total_qty</th>
		<th>total_price</th>
		<th>average_price</th>
	</tr>

<?php
	
	$sql = "call test.report_monthly_sale('$pid');";
	$results = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($results);


	if($results && $num){
		for($i=0; $i<$num; $i++){
			$row = mysqli_fetch_array($results, MYSQLI_NUM);
			$id = $row[0];
			$size = count($row);

			if($i%2==0){
				echo "<tr align='center'>";
				for($j=0; $j<$size; $j++){
					echo "<td>$row[$j]</td>";
				}
			}else{
				echo "<tr align='center' class='al'>";
				for($j=0; $j<$size; $j++){
					echo "<td>$row[$j]</td>";
				}
			}
		}
	}
?>
	</table>
<?php
		}
	}
?>

</body>
</html>