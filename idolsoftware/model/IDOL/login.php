<?php 
require "conn.php";
$user_name = $_POST["uid"];
$user_pass = $_POST["passwd"];

//$user_name = "ulix";
//$user_pass = "123";

$mysql_qry = "select * from user_creation where user_name like '$user_name' and password like '$user_pass' and user_type=3;";
$result = mysqli_query($conn ,$mysql_qry);
$status;
if(mysqli_num_rows($result) > 0) {

	$response = array();
	
	$row = mysqli_fetch_array($result);
	$status = $row['login_status'];
	
	if($status == 0){
		$sql1 = "UPDATE user_creation SET login_status = 1 where user_name = '$user_name'";
		mysqli_query($conn,$sql1);
		echo "Login success !!!!! Welcome " ;
	}
	else if($status == 1){
		echo "You are already logged in other device" ;
	}else{
		echo "Error sign in" ;
	}

}
else {
echo "Error: ". $mysql_qry . " " . $conn->error ;//$conn->error (or) mysqli_error($conn)
}

?>