<?php
require ("conn.php");

	$user_name = $_POST["user_id"];	
	//$user_name = "ulix";	
	$att_date = date("Y-m-d");
	

	$user_type=3;
	
	$user_id;

	$sql0 = "SELECT user_id FROM user_creation where user_name = '$user_name'";

	$result0 = mysqli_query($conn,$sql0);
	
	while($row0 = mysqli_fetch_array($result0))
	{
		$user_id = $row0['user_id'];
	
	}

$sql = "SELECT start_time,end_time FROM attendance where att_date='$att_date' and user_id = '$user_id'";

$result = mysqli_query($conn,$sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
	$start_time=date("h:i:s A", strtotime($row['start_time']));
	$endTime = $row['end_time'];
	$end_hours = date("H", strtotime($endTime));
	if($end_hours==0){
		$end_time="00:00:00";
	}else{
		$end_time=date("h:i:s A", strtotime($endTime));	
	}
	array_push($response,array(
	"start_time"=>$start_time,"end_time"=>$end_time));
}
echo json_encode(array("getAttendance"=>$response));
mysqli_close($conn); //$conn->close();

?>