<?php
require ("conn.php");

$user_name = $_POST["user_id"];	
//$user_name = "ulix";	

$user_id;

$sql0 = "SELECT user_id FROM user_creation where user_name = '$user_name'";
$result0 = mysqli_query($conn,$sql0);
$row0 = mysqli_fetch_array($result0);
$user_id = $row0['user_id'];

$dt = date("Ym");
$sql = "SELECT * FROM check_in where user_id = '$user_id' and DATE_FORMAT(check_in_date, '%Y%m') = '$dt' ORDER BY check_in_id desc";

$result = mysqli_query($conn,$sql); 

$response = array();

while($row = mysqli_fetch_array($result))
{
	$newDate = date("d-m-Y", strtotime($row['check_in_date']));
	array_push($response,array(
	"place_work_name"=>$row['place_work_name'],"location_address"=>$row['location_address'],
	"check_in_time"=>$row['check_in_time'],"check_in_date"=>$newDate));
}
echo json_encode(array("getCheckIn"=>$response));
mysqli_close($conn); //$conn->close();

?>