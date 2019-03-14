<?php
require ("conn.php");
	
	$name = $_POST["name"];
	$details = $_POST["details"];
	$collectionAmt= $_POST["collectionAmt"];
	
	$user_name = $_POST["user_id"];
	$user_id;

	$sql = "SELECT * FROM user_creation where user_name = '$user_name'";

	$result = mysqli_query($conn,$sql);
	
	$response = array();
	
	while($row = mysqli_fetch_array($result))
	{
		$user_id = $row['user_id'];
	}
	
	
	$delete_qry = "DELETE FROM assign_work WHERE work_title='$name' and details='$details' and ass_emp_user_id='$user_id' and collection_amt='$collectionAmt';";
		if(mysqli_query($conn, $delete_qry)){
			echo "assigned work updated";
		}
		else{
			echo "Error: ". mysqli_error($conn);
		}

	$conn->close();
?>