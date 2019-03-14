<?php
require ("conn.php");
//$user_name ="ulix";
$user_name = $_POST["user_id"];	
$sql = "SELECT * FROM sale_person_creation where person_name='$user_name'"; 

$sql0 = "SELECT user_id,company_name FROM user_creation where user_name = '$user_name'";
$result0 = mysqli_query($conn,$sql0);
$row0 = mysqli_fetch_array($result0);

$company_name = $row0['company_name'];
$user_id = $row0['user_id'];

$result = mysqli_query($conn,$sql);

$response = array();

while($row = mysqli_fetch_array($result)) 
{
	array_push($response,array(
	"person_name"=>$row['person_name'],"person_email"=>$row['person_email'],
	"phn_no"=>$row['phn_no'],"designation"=>$row['designation'],
	"shift_start"=>date('h:i:s A',strtotime($row['shift_start'])),"shift_end"=>date('h:i:s A',strtotime($row['shift_end'])),"company_name"=>$company_name));
}
echo json_encode(array("getProfile"=>$response));
mysqli_close($conn); //$conn->close();

?>