<?php
require ("conn.php");
    
//  $user_name = "ulix";
//	$start="03:34:04 PM";
//	$end_time = "15:35:42";
    $start = $_POST["start_time"];
    $user_name = $_POST["user_id"];
	$end_time = $_POST["end_time"];
	
	$start_time = date("H:i:s", strtotime($start));
	$lattitude_end = $_POST["lattitude_end"];
	$longitude_end = $_POST["longitude_end"];
	$location_address_end = $_POST["location_address_end"];	
	
	$seconds = strtotime($end_time)-strtotime($start_time);
	$hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);
    
	$tot_work_time = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
	
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
	//echo "start_time = ".$start_time." end_time = ".$end_time." tot_work_time = ".$tot_work_time;
		
	$mysql_qry = "update attendance set end_time = '$end_time',tot_work_time='$tot_work_time',lattitude_end='$lattitude_end',longitude_end='$longitude_end',
	location_address_end='$location_address_end' where user_id='$user_id' and att_date = '$att_date' and start_time='$start_time';";
	if(mysqli_query($conn, $mysql_qry)){
		echo "Attendance updated successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	/*
	
	*/
	$conn->close();
?>