<?php
require ("conn.php");
//$user_name ="ulix";
$user_name = $_POST["user_id"];
$gmail = $_POST["gmail"];	
//$gmail = "ulixtechnology@gmail.com";
$sql = "SELECT * FROM sale_person_creation where person_name='$user_name'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($result);
$person_email = $row['person_email'];

if(strcmp($gmail,$person_email)==0){
	echo "correct";
}else{
	echo "wrong";
}
mysqli_close($conn); //$conn->close();

?>