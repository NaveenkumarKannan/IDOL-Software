<?php
require ("conn.php");

	$phNo = $_POST["phNo"];
	$email = $_POST["email"];	
	$user_name = $_POST["user_id"];		

	$user_type=3;
	
	$user_id;

	$sql = "SELECT * FROM user_creation where user_name = '$user_name'";

	$result = mysqli_query($conn,$sql);
	
	$response = array();
	
	while($row = mysqli_fetch_array($result))
	{
		$user_id = $row['user_id'];
	
	}
	
		
	$mysql_qry = "update sale_person_creation set person_email = '$email',phn_no='$phNo'  where person_name='$user_name' ;";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Profile updated successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}

	$conn->close();
?>