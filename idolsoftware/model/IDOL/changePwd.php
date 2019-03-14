<?php
require ("conn.php");

	$newPwd= $_POST["newPwd"];
	$confirmPwd = $_POST["confirmPwd"];
	$user_name = $_POST["user_id"];
	
	$sql = "SELECT * FROM user_creation where user_name = '$user_name'";

	$result = mysqli_query($conn,$sql);
	
	$response = array();
	
	while($row = mysqli_fetch_array($result))
	{
		$assign_user_id = $row['assign_user_id'];
		$user_id = $row['user_id'];
		$assign_user_type = $row['assign_user_type'];
	}
	
	
	
	$mysql_qry = "update user_creation set password='$newPwd',confirm_password='$confirmPwd' where user_id='$user_id';";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Your password has changed successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	$conn->close();
?>