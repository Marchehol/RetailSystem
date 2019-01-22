<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<title>Nifty Modal Window Effects</title>

	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<script src="js/modernizr.custom.js"></script>
</head>
<body>
<?php 
	include("conn.php");
	if(is_array($_POST)&&count($_POST)>0)
    {
    	$purid = $_POST['purid'];
    	$cid = $_POST['cid'];
    	$eid = $_POST['eid'];
    	$pid = $_POST['pid'];
    	$qty = $_POST['qty'];
    	$sql = "select qoh from products where pid='$pid';";
    	$results = mysqli_query($conn, $sql);
    	if(!$results){
    		echo '<script>alert("'.'error('.mysqli_errno($conn).'):'.mysqli_error($conn).'");location.href="index.php"</script>';
    	}
    	$row = mysqli_fetch_array($results, MYSQLI_NUM);
    	$old_qoh = $row[0];

		$sql = "call test.add_purchase('$purid', '$cid', '$eid', '$pid', '$qty');";
		
    	if(mysqli_query($conn, $sql)){	
			$sql = "select qoh from products where pid='$pid';";
	    	$results = mysqli_query($conn, $sql);
	    	$row = mysqli_fetch_array($results, MYSQLI_NUM);
	    	$new_qoh = $row[0];
	    	if($new_qoh==2*$old_qoh){
	    		echo "<script>alert('成功添加一条销售记录！');</script>";
	    		$msg = '库存为'.($old_qoh-$qty).'，低于阈值！\n增加'.($old_qoh+$qty).'！\n现库存为'.$new_qoh.'！';
	    		echo "<script>alert('$msg');location.href='index.php'</script>";
	    	}else{
				echo "<script>alert('成功添加一条销售记录！');location.href='index.php'</script>";

	    	}
    	}
    	else{
    		$errno = mysqli_errno($conn);
    		$error = mysqli_error($conn);
    		if($errno == '1644')
    			echo '<script>alert("'.$error.'");location.href="index.php"</script>';
    		else
    			echo '<script>alert("'.'error('.$errno.'):'.$error.'");location.href="index.php"</script>';
    	}
    }

    else{
    	$sql = "select max(purid)+1 from purchases;";
    	$results = mysqli_query($conn, $sql);
    	$row = mysqli_fetch_array($results, MYSQLI_NUM);
    	$purid = $row[0];

?>			
		
		<div class="md-modal md-effect-10" id="modal-10">
			<form align="left" method="post" action="purchase.php">
			<div class="md-content">
				<h3>提交订单</h3>
				<div style="float: left;" align="center">
					<ul style="padding:5px;"><img src="images/milk.jpg" width="200px" height="200px" id="img"></ul>
					<ul style="padding:5px;"><input type="text" id="pname" disabled="true" style="border: 0px;width: 100px; background: white;font-size: 20px; padding:0px;"></ul>
					<ul style="padding:5px;"><input type="text" id="pid" name="pid" style="border: 0px;width: 0px; background: white;font-size: 0px"></ul>
				</div>
				<div style="float: left;">
					<p>请填写订单详情：</p>
					<ul>
						<li>编号：<?php echo $purid; ?><input type="hidden" name="purid" value="<?php echo $purid; ?>"></li>
						<li>客户：
							<select style="width:120px;" name="cid" required="required"> 
							<?php
								$sql = "select cid,cname from customers;";
								$results = mysqli_query($conn, $sql);
								$num = mysqli_num_rows($results);
								if($results && $num){
									for($j=0; $j<$num; $j++){
										$row = mysqli_fetch_array($results, MYSQLI_NUM);		
										echo "<option value='$row[0]'>$row[1]</option>";
									}
								}
							?>
			                </select>  
						</li>
						<li>员工：
							<select style="width:120px;"  name="eid" required="required"> 
							<?php
								$sql = "select eid,ename from employees;";
								$results = mysqli_query($conn, $sql);
								$num = mysqli_num_rows($results);
								if($results && $num){
									for($j=0; $j<$num; $j++){
										$row = mysqli_fetch_array($results, MYSQLI_NUM);		
										echo "<option value='$row[0]'>$row[1]</option>";
									}
								}
							?>
			                </select>  
			            </li>
						<li>数量：<input type="text" name="qty" required="required" style="width:125px;"></li>
					</ul>
					<button class="md-close">确定</button>
				</div>
			</div>
		</form>
		</div>

		<div class="md-overlay"></div>

		<script src="js/classie.js"></script>
		<script src="js/modalEffects.js"></script>
<?php
	}
?>
	</body>
</html>