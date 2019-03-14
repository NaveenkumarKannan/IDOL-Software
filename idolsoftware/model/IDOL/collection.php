<?php
require ("conn.php");

	$collect_company_name= $_POST["Name"];
	$collet_details= $_POST["Details"];
	$collection_date = date("Y-m-d", strtotime($_POST["Date"]));
	$collection_amount= $_POST["Amount"];	
	
	$user_name = $_POST["user_id"];
	$status = $_POST["status"];
	$user_type=3;
	
	$work_id = $_POST["work_id"];
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
	
	
	$mysql_qry = "insert into collection_details (collect_company_name,collection_date,collection_amount, collet_details,user_type,user_id,assign_user_id,assign_user_type) values 
	('$collect_company_name','$collection_date','$collection_amount','$collet_details','$user_type','$user_id','$assign_user_id','$assign_user_type');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Collection details added successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	
	if($status == "finished"){
		$delete_qry = "update assign_work set work_status=2 WHERE work_id = '$work_id' and ass_emp_user_id='$user_id';";
		if(mysqli_query($conn, $delete_qry)){
			echo " and collection completed.";
		}
		else{
			echo "Error: ". mysqli_error($conn);
		}
	}
	$conn->close();
?>