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
$sql = "SELECT * FROM attendance where user_id = '$user_id' and DATE_FORMAT(att_date, '%Y%m') = '$dt' ORDER BY att_id desc ";
 
$result = mysqli_query($conn,$sql);

$response = array();

while($row = mysqli_fetch_array($result)) 
{
	$newDate = date("d-m-Y", strtotime($row['att_date']));
	$tot_work_time = $row['tot_work_time'];
	$hours = date("H", strtotime($tot_work_time));
	$min = date("i", strtotime($tot_work_time));
	//echo $hours." hours ".$min." minutes";
	//$hours = 5;
	//$min=25;
	$duration;
	if($hours>0){
		if($min>0){
			$duration = $hours." hours ".$min." minutes";
		}else{
			$duration = $hours." hours ";
		}
	}else if($hours==0){
		if($min>0){
			$duration = $min." minutes";
		}else{
			$duration = "Not Available";
		}
	}else{
		$duration = "Not Available";
	}
	$start_time=date("h:i:s A", strtotime($row['start_time']));
	$endTime = $row['end_time'];
	$end_hours = date("H", strtotime($endTime));
	if($end_hours==0){
		$end_time="Working";
	}else{
		$end_time=date("h:i:s A", strtotime($endTime));	
	}
	array_push($response,array(
	"start_time"=>$start_time,"att_date"=>$newDate,
	"end_time"=>$end_time,"tot_work_time"=>$duration));
}
echo json_encode(array("getPastAttendance"=>$response));
mysqli_close($conn); //$conn->close();

?>