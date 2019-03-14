<?php
require ("conn.php");

	$expense_name = $_POST["expense_name"]; 
	$description = $_POST["description"];
	$expense_amount = $_POST["expense_amount"];
	$expense_date = date("Y-m-d", strtotime($_POST["expense_date"]));
	
	$user_name = $_POST["user_id"];
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
	
	
	
	$mysql_qry = "insert into expense_creation (expense_name,description,expense_amount, expense_date,user_type,user_id,assign_user_id,assign_user_type) values 
	('$expense_name','$description','$expense_amount','$expense_date','$user_type','$user_id','$assign_user_id','$assign_user_type');";
	
	if(mysqli_query($conn, $mysql_qry)){
		echo "Expenses added successfully" ;
	}
	else{
		echo "Error: ". mysqli_error($conn);
	}
	$conn->close();
?>