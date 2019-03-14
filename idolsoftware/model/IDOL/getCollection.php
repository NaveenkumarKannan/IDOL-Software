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
$sql = "SELECT * FROM collection_details where user_id = '$user_id' and DATE_FORMAT(collection_date, '%Y%m') = '$dt' ORDER BY collection_id desc ";
 
$result = mysqli_query($conn,$sql);

$response = array();

while($row = mysqli_fetch_array($result)) 
{
	$newDate = date("d-m-Y", strtotime($row['collection_date']));
	array_push($response,array(
	"collect_company_name"=>$row['collect_company_name'],"collection_date"=>$newDate,
	"collection_amount"=>$row['collection_amount'],"collet_details"=>$row['collet_details']));
}
echo json_encode(array("getCollection"=>$response));
mysqli_close($conn); //$conn->close();

?>