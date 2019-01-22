<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据管理</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
<script language="JavaScript">
	 function setSel(obj){
	    var k1=obj.value;
	    var k2=document.getElementById("id");
	    var len_k2=k2.length;
	    for(var i=1;i<len_k2;i++){
	        k2.remove(1);
	    }
	    var obj2=document.getElementsByName(k1); 
	    for(var i=0;i<obj2.length;i++){ 
	        k2.options.add(new Option(obj2[i].value,obj2[i].value));
	    }
	}
</script>
</head>

<body>	
<?php
	include("head.php");
?>
	<div style="height: 100px"></div>
<?php
	echo "<h1 align='center'>查找销售记录</h1>"."<br>";
	echo "<form width=60% align='center' method='post' action='find_purchase.php'>";
?>
<table  align="center" border="0" style="font-size:25px">
<tr align="center">
	<th align="left">选择对象：</th>
	<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
	<th>
	    <select name="type" style="font-size:22px" onchange="setSel(this)">
	    	<option disabled selected="selected">请选择</option>
	    	<option value="customers">customer</option>
	    	<option value="employees">employee</option>
	    	<option value="products">product</option>
	    </select>
	</th>
	<th>&nbsp;&nbsp;&nbsp;</th>
	<th>
		<select id="id" name="id_" style="font-size:22px" >
			<option disabled selected="selected" id="default">请选择</option>

	    </select>
	</th>   
	<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
	<th>
		<input type="submit" name="submit" value="确定" style="font-size:20px">
	</th>    
</tr>
</table>
</form>
<?php
	include("conn.php");
	mysqli_set_charset($conn, 'utf8');
	$ids = array('cid', 'eid', 'pid');
	$name = array('cname', 'ename', 'pname');
	$tbl = array('customers', 'employees', 'products');
	for($i=0; $i<3; $i++){
		$sql = "select $ids[$i], $name[$i] from $tbl[$i];";
		$results = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($results);
		if($results && $num){
			for($j=0; $j<$num; $j++){
				$row = mysqli_fetch_array($results, MYSQLI_NUM);
				echo "<input name='$tbl[$i]' type='hidden' value='$row[0]'/>";		
			}
		}
	}
?>
<table width="60%" align="center" border="1" class="gridtable">
	<tr align="center">
<?php
	if(is_array($_POST)&&count($_POST)==3)
    {
    	$type = $_POST['type'];
    	$id_ = $_POST['id_'];
    	
    	switch ($type) {
    		case 'customers':
    			$k = 0;
    			break;
    		case 'employees':
    			$k = 1;
    			break;
    		case 'products':
    			$k = 2;
    			break;
    		default:
    			# code...
    			break;
    	}

		$sql = "show columns from purchases";		
		$res = mysqli_query($conn, $sql);
		while ( $row = mysqli_fetch_array($res,MYSQLI_NUM) ) {
			echo "<th>$row[0]</th>";
		}
		echo "<th colspan='3'>action</th></tr>";

		$sql = "select * from purchases where $ids[$k]='$id_';";
		$results = mysqli_query($conn, $sql);
		if(!$results){
    		echo '<script>alert("'.'error('.mysqli_errno($conn).'):'.mysqli_error($conn).'");location.href="info.php?tb=5"</script>';
    	}
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
					echo "<td width='25px' style='padding:12px;'><a href='alter.php?tb=5&&id=$id' class='layui-btn'><span class='span'>修改</span></a></td> <td width='25px' style='padding:12px;'><a href='delete_from_db.php?tb=5&&id=$id' class='layui-btn layui-btn-danger'><span class='span'>删除</span></a></td></tr>";
				}else{
					echo "<tr align='center' class='al'>";
					for($j=0; $j<$size; $j++){
						echo "<td>$row[$j]</td>";
					}
					echo "<td width='25px' style='padding:12px;'><a href='alter.php?tb=5&&id=$id' class='layui-btn'><span class='span'>修改</span></a></td> <td width='25px' style='padding:12px;'><a href='delete_from_db.php?tb=5&&id=$id' class='layui-btn layui-btn-danger'><span class='span'>删除</span></a></td></tr>";
				}
			}
		}
	}
?>
	</table>
</body>
</html>