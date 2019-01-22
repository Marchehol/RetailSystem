<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>零售业务管理系统</title>
<link rel="stylesheet" href="css/style.css" type="text/css"></link>
<style type="text/css">
.span_pur{
	font-weight: normal;
    font-size: 16px;
    line-height: 20px;
    color: #003c4c;
    margin: 15px 0;
}
h3{
    font-weight: normal;
    font-size: 20px;
    line-height: 25px;
    color: #003c4c;
    margin: 15px 0;
}
.divcss5{
	margin:0 auto;
	width:1200px;
} 
 .divcss5 div:hover{
 	background-color: #ccffff;
 }

.div-left{
	float: left;
	padding-top: 30px;
}

</style>
</head>

<body>	
<
<?php
	include("head.php");
?>
<div style="height: 100px"></div>
<div align="center" class="divcss5">
	<?php
		include("conn.php");
		$sql = "select pname, qoh, original_price, discnt_rate, pid from products";
		$results = mysqli_query($conn, $sql);
		if($results){
			$num = mysqli_num_rows($results);
			if($num){
				for($i=0; $i<$num; $i++){
					$row = mysqli_fetch_array($results, MYSQLI_NUM);
					$pname = $row[0];
					$qoh = $row[1];
					$original_price = $row[2];
					$discnt_rate = $row[3];
					$pid = $row[4];

	?>
	
	<button style="padding:0px; border:0px; background: white;" class="md-trigger" data-modal="modal-10" onclick = "document.getElementById('pname').value='<?php echo $pname; ?>'; document.getElementById('pid').value='<?php echo $pid; ?>'; document.getElementById('img').src='images/<?php echo $pname; ?>.jpg';"> 
	<div class="div-left">
		<div style="padding-left: 20px; padding-right: 20px;">		
			<img src="images/<?php echo $pname;?>.jpg" width="250px" height="250px">	
		</div>
		<div style="padding-left: 20px">
			<span class="span_pur" style="font-size:20px;"><h3><?php echo $pname; ?></h3></span>
			<span class="span_pur">库存：<?php echo $qoh; ?> &nbsp;</span>
		</div>
		<div style="padding-left:  20px">
			<span class="span_pur">原价：<?php echo $original_price; ?> &nbsp;&nbsp;&nbsp;&nbsp;</span>
			<span class="span_pur">折扣：<?php echo $discnt_rate; ?> </span>
		</div>
	</div>
	</button>

	<?php
				}
			}
		}	
	?>	
</div>
<?php
	include("purchase.php");
?>
</body>