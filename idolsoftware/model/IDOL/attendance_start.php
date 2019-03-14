<?php
require ("conn.php");

	
	$start_time = $_POST["start_time"];
	$lattitude_start = $_POST["lattitude_start"];
	$longitude_start = $_POST["longitude_start"];
	$location_addres_start = $_POST["location_addres_start"]; 	
	$user_name = $_POST["user_id"];	
	$att_date = date("Y-m-d");
	

	$user_type=3;
	
	$user_id;
 
	$sql = "SELECT * FROM user_creation where user_name = '$user_name'";

	$result = mysqli_query($conn,$sql);
	
	$response = array();
	
	while($row = mysqli_fetch_array($result))
	{
		$user_id = $row['user_id'];
	
	}
	
		
	$mysql_qry = "insert into attendance (user_id,user_type,att_date,start_time,lattitude_start,longitude_start,location_addres_start) 
	values ('$user_id','$user_type','$att_date','$start_time','$lattitude_start','$longitude_start','$location_addres_start');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Attendance added successful" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}

	$conn->close();
?>