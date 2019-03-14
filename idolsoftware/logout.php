<?php   
session_start(); 
$employee_id=$_SESSION['employee_id'];//to ensure you are using same session
session_destroy(); //destroy the session
header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>
