<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改记录</title>
</head>

<body>
<?php
	include("conn.php");
	$tb = $_GET['tb'];
	switch ($tb) {
		case 1:
				$id = $_POST['id'];
				$eid = $_POST['eid'];
				$ename = $_POST['ename'];
				$city = $_POST['city'];
				$sql = "update employees set eid='$eid',ename='$ename',city='$city' where eid='$id'";
			break;

		case 2:
				$id = $_POST['id'];
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

				$sql = "update customers set cid='$cid',cname='$cname',city='$city',visits_made=$visits_made,last_visit_time=$last_visit_time where cid='$id'";
			break;

		case 3:
				$id = $_POST['id'];
				$sid = $_POST['sid'];
				$sname = $_POST['sname'];
				$city = $_POST['city'];
				$tel_no = $_POST['telephone_no'];
				$sql = "update suppliers set sid='$sid',sname='$sname',city='$city',telephone_no='$tel_no' where sid='$id'";
			break;

		case 4:
				$id = $_POST['id'];
				$pid = $_POST['pid'];
				$pname = $_POST['pname'];
				$qoh = $_POST['qoh'];
				$qoh_threshold = $_POST['qoh_threshold'];
				$original_price = $_POST['original_price'];
				$discnt_rate = $_POST['discnt_rate'];
				$sid = $_POST['sid'];
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
				$sql = "update products set pid='$pid', pname='$pname', qoh=$qoh, qoh_threshold=$qoh_threshold, original_price=$original_price, discnt_rate=$discnt_rate, sid=$sid where pid='$id'";
			break;

		case 5:
				$id = $_POST['id'];
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

				$sql = "update purchases set purid='$purid',cid='$cid',eid='$eid',pid='$pid',qty=$qty,ptime=$ptime,total_price=$total_price where purid='$id'";
			break;

		case 6:
				$id = $_POST['id'];
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
				
				$sql = "update logs set logid=$logid, who='$who', time='$time', table_name='$table_name', operation='$operation', key_value=$key_value where logid=$id";
			break;

		default:
			# code...
			break;
	}
	
	if(mysqli_query($conn, $sql)){
		echo "<script>alert('修改成功');location.href='info.php?tb=$tb'</script>";
	}else{
		$mesg = 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
		echo '<script>alert("修改失败\n';
		echo "$mesg";
		echo '");history.back();</script>';
	}
	
?>
	
</body>
</html>
