<?php
require ("conn.php");
	
	/*

	$lattitude = 123;
	$longitutde = 21;
	$place_work_name = "Name";
	$location_address = "addr";
	$photo = "photo";	
	
	*/
	$lattitude = $_POST["lattitude"];
	$longitutde = $_POST["longitutde"];
	$place_work_name = $_POST["place_work_name"];
	$location_address = $_POST["location_address"];
	$photo = $_POST["photo"];	
	$check_in_details = $_POST["details"];
	$check_in_work_status = $_POST["status"];
	$batteryPercentage = $_POST["batteryPercentage"];
			
	$check_in_status = 1;
	$dt = date("Y-m-d");
	date_default_timezone_set('Asia/Kolkata');
	$check_in_time = date('h:i:s A');
	
	$user_name = $_POST["user_id"];
	$work_id = $_POST["work_id"];
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
	
		
	$mysql_qry = "insert into check_in (lattitude,longitutde,place_work_name, location_address, photo,check_in_status,check_in_date,check_in_time,user_type,user_id,assign_user_id,assign_user_type,check_in_details,check_in_work_status,batteryPercentage) values 
	('$lattitude','$longitutde','$place_work_name','$location_address',
	'$photo','$check_in_status','$dt','$check_in_time','$user_type','$user_id','$assign_user_id',
	'$assign_user_type','$check_in_details','$check_in_work_status','$batteryPercentage');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Check In successful" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
		
	
	if($check_in_work_status == "finished"){
	
		$delete_qry = "update assign_work set work_status=2 WHERE work_id = '$work_id'  and ass_emp_user_id='$user_id';"; 
		if(mysqli_query($conn, $delete_qry)){
			echo " and work completed";
		}
		else{
			echo "Error: ". mysqli_error($conn);
		}
	}else if($check_in_work_status == "pending"){
	
		$delete_qry = "update assign_work set work_status=1 WHERE work_id = '$work_id' and ass_emp_user_id='$user_id';"; 
		if(mysqli_query($conn, $delete_qry)){
			echo " and work pending";
		}
		else{
			echo "Error: ". mysqli_error($conn);
		}
	}

	$conn->close();
?>