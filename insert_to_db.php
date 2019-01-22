<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>保存记录</title>
</head>

<body>
	<?php
	include("conn.php");

	$tb = $_GET['tb'];
	switch ($tb) {
		case 1:
				$eid = $_POST['eid'];
				$ename = $_POST['ename'];
				$city = $_POST['city'];
				$sql = "insert into employees values('$eid', '$ename', '$city')";
			break;

		case 2:
				$cid = $_POST['cid'];
				$cname = $_POST['cname'];
				$city = $_POST['city'];
				$visits_made = $_POST['visits_made'];
				$last_visit_time = $_POST['last_visit_time'];
				if(!$visits_made)
					$visits_made = 'null';

				if($last_visit_time)
					$last_visit_time = "'".$last_visit_time."'";
				else
					$last_visit_time = 'null';
				
				$sql = "insert into customers values('$cid', '$cname', '$city', $visits_made, $last_visit_time)";
				
			break;
		
		case 3:
				$sid = $_POST['sid'];
				$sname = $_POST['sname'];
				$city = $_POST['city'];
				$tel_no = $_POST['tel_no'];
				$sql = "insert into suppliers values('$sid', '$sname', '$city', '$tel_no')";
			break;

		case 4:
				$pid = $_POST['pid'];
				$pname = $_POST['pname'];
				$qoh = $_POST['qoh'];
				$qoh_threshold = $_POST['qoh_threshold'];
				if(!$qoh_threshold)
					$qoh_threshold = 'null';
				$original_price = $_POST['original_price'];
				if(!$original_price)
					$original_price = 'null';
				$discnt_rate = $_POST['discnt_rate'];
				if(!$discnt_rate)
					$discnt_rate = 'null';
				$sid = $_POST['sid'];
				if(!$sid)
					$sid = 'null';
				else 
					$sid = "'".$sid."'";
				$sql = "insert into products values('$pid', '$pname', $qoh, $qoh_threshold, $original_price, $discnt_rate, $sid)";
			break;

			case 5:
				$purid = $_POST['purid'];
				$cid = $_POST['cid'];
				$eid = $_POST['eid'];
				$pid = $_POST['pid'];
				$qty = $_POST['qty'];
				$ptime = $_POST['ptime'];
				$total_price = $_POST['total_price'];
				if(!$qty)
					$qty = 'null';
				if($ptime)
					$ptime = "'".$ptime."'";
				else
					$ptime = 'null';
				if(!$total_price)
					$total_price = 'null';
				$sql = "insert into purchases values('$purid', '$cid', '$eid', '$pid', $qty, $ptime, $total_price)";
			break;

		case 6:
				$logid = $_POST['logid'];
				$who = $_POST['who'];
				$time = $_POST['time'];
				$table_name = $_POST['table_name'];
				$operation = $_POST['operation'];
				$key_value = $_POST['key_value'];
				if($key_value)
					$key_value = "'".$key_value."'";
				else
					$key_value = 'null';
							
				$sql = "insert into logs values('$logid', '$who', '$time', '$table_name', '$operation', $key_value)";
			break;

		default:
			# code...
			break;
	}

	if(mysqli_query($conn, $sql)){
		echo "<script>alert('插入成功'); location.href='info.php?tb=$tb'</script>";
	}else{
		$mesg = 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
		echo '<script>alert("插入失败\n';
		echo "$mesg";
		echo '");history.back();</script>';
	}
		
	?>
	
</body>
</html>