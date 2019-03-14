<?php
require ("conn.php");

$user_name = $_POST["user_id"];	
//$user_name = "ulix";	

$sql1 = "UPDATE user_creation SET login_status = 0 where user_name = '$user_name'";
mysqli_query($conn,$sql1);

mysqli_close($conn);

?>