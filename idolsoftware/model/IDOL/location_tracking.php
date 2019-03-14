<?php
require ("conn.php");

	$user_name = $_POST["user_id"];
//	$user_name = "ulix";
	$lattitude = $_POST["lattitude"];
	$longitude = $_POST["longitude"];
	$location_address = $_POST["location_address"];
	$date = $_POST["date"]; 	
	
	$date = date("Y-m-d");
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i:s A');

	$user_type=3;
	
	$assign_user_id;
	$user_id;
	$assign_user_type;

	$sql = "SELECT * FROM user_creation where user_name = '$user_name'";

	$result = mysqli_query($conn,$sql);
	
	$response = array();
	
	while($row = mysqli_fetch_array($result))
	{
		$assign_user_id = $row['assign_user_id'];
		$user_id = $row['user_id'];
		$assign_user_type = $row['assign_user_type'];
	
	}
	$mysql_qry = "insert into location_tracking (user_id,lattitude,longitude,location_address,date,time,assign_user_id,assign_user_type) 
	values ('$user_id','$lattitude','$longitude','$location_address','$date','$time','$assign_user_id','$assign_user_type');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Location added successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}

	$conn->close();
?>