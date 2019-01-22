<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>删除记录</title>
</head>

<body>
<?php
	$tb = $_GET['tb'];
	$id = $_GET['id'];
	switch ($tb) {
		case 1:
			$sql = "delete from employees where eid='$id'";
			$link = 'employees.php';
			break;
		
		case 2:
			$sql = "delete from customers where cid='$id'";
			$link = 'customers.php';
			break;

		case 3:
			$sql = "delete from suppliers where sid='$id'";
			$link = 'suppliers.php';
			break;

		case 4:
			$sql = "delete from products where pid='$id'";
			$link = 'products.php';
			break;

		case 5:
			$sql = "delete from purchases where purid='$id'";
			$link = 'purchases.php';
			break;

		case 6:
			$sql = "delete from logs where logid='$id'";
			$link = 'logs.php';
			break;

		default:
			# code...
			break;
	}
	include("conn.php");

	if(mysqli_query($conn, $sql)){
		echo "<script>alert('删除成功');location.href='info.php?tb=$tb'</script>";
	}else{
		$mesg = 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
		echo '<script>alert("删除失败\n';
		echo "$mesg";
		echo '");history.back();</script>';
	}
?>
</body>
</html>