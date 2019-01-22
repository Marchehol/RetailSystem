<?php
	
	$conn = @mysqli_connect('localhost','mch','159156');

	if(!$conn){
		exit('error('.mysqli_connect_errno().'):'.mysqli_connect_error());
	}

	if(!mysqli_select_db($conn, 'test')){
		echo 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
		mysqli_close($conn);
		die;
	}

?>
