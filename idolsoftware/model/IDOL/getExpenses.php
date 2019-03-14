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
$sql = "SELECT * FROM expense_creation where user_id = '$user_id' and DATE_FORMAT(expense_date, '%Y%m') = '$dt' ORDER BY exp_id desc"; 

$result = mysqli_query($conn,$sql);

$response = array();

while($row = mysqli_fetch_array($result))
{
	$newDate = date("d-m-Y", strtotime($row['expense_date']));
	array_push($response,array(
	"expense_name"=>$row['expense_name'],"description"=>$row['description'],
	"expense_amount"=>$row['expense_amount'],"expense_date"=>$newDate));
}
echo json_encode(array("expenses"=>$response));
mysqli_close($conn); //$conn->close();

?>