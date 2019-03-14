<?php
require ("conn.php");

$user_name = $_POST["user_id"];	
//$user_name = "ulix";	

$user_id;

$sql0 = "SELECT user_id,company_name,company_id FROM user_creation where user_name = '$user_name'";
$result0 = mysqli_query($conn,$sql0);
$row0 = mysqli_fetch_array($result0);

$user_id = $row0['user_id'];
$company_name = $row0['company_name'];
$company_id = $row0['company_id'];

$dt = date("Ym");
//check_in count
$sql1 = "SELECT COUNT(check_in_id) as check_in_count 
FROM check_in 
where user_id = '$user_id' and DATE_FORMAT(check_in_date, '%Y%m') = '$dt'";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

$check_in_count = $row1['check_in_count'];
// sum_of_expense_amount
$sql2 = "SELECT FORMAT(SUM(expense_amount),2)sum_of_expense_amount
FROM expense_creation 
where user_id = '$user_id' and DATE_FORMAT(expense_date, '%Y%m') = '$dt'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

$sum_of_expense_amount = $row2['sum_of_expense_amount'];

// day_present
$sql3 = "SELECT COUNT(att_id) as day_present
FROM attendance 
where user_id = '$user_id' and DATE_FORMAT(att_date, '%Y%m') = '$dt'";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_array($result3);

$day_present = $row3['day_present'];


//echo "check_in_count = ".$check_in_count."<br>"."sum_of_expense_amount = ".$sum_of_expense_amount."<br>"."day_present = ".$day_present."<br>";

$sql5 = "SELECT * FROM manage_companys where company_id = '$company_id'";
$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_array($result5);

$curdate=strtotime(date("Y-m-d"));
$renewal_date=strtotime($row5['renewal_date']);

$isExpired;
if($curdate > $renewal_date)
{
    $isExpired = "true";
}else{
    $isExpired = "false";
}

$response1 = array();

array_push($response1,array(
"check_in_count"=>$check_in_count,"sum_of_expense_amount"=>$sum_of_expense_amount,
"day_present"=>$day_present,"company_name"=>$company_name,"isExpired"=>$isExpired));

//getAssignWork
$sql4 = "SELECT * FROM assign_work where ass_emp_user_id= $user_id and work_status!=2 ORDER BY work_id desc";

$result4 = mysqli_query($conn,$sql4);

$response2 = array();

while($row4 = mysqli_fetch_array($result4))
{
	$newDate = date("d-m-Y", strtotime($row4['deadline']));
	array_push($response2,array(
	"work_title"=>$row4['work_title'],"details"=>$row4['details'],
	"deadline"=>$newDate,"work_type"=>$row4['work_type'],"collection_amt"=>$row4['collection_amt'],"work_id"=>$row4['work_id']));
}
//echo json_encode(array("getAssignWork"=>$response2));
//echo json_encode(array("getCount"=>$response1));

echo json_encode(array("getAssignWork"=>$response2,"getCount"=>$response1));
mysqli_close($conn); //$conn->close();

?>