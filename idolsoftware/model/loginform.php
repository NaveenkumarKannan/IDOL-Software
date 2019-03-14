<?php
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
ob_start();
session_start(); 
if($_POST['action']=="Login") 
{ 
$table = "user_creation";
$data = $_POST;		
		
     $sql = "SELECT * FROM user_creation where user_name='$_POST[user]' and password='$_POST[password]' ";
	 $rs=mysql_query($sql);
	    $rscount=mysql_num_rows($rs);
		/*if(strtotime($_POST['curr_date'])>=strtotime($_POST['renewal_date']))
		{*/
	    if($rscount!=0)
		{
		while($record2=mysql_fetch_array($rs))
		{
					$_SESSION['sess_user_id'] = $record2['user_id'];
					$_SESSION['sess_user_name'] = $record2['user_name'];
					$_SESSION['ses_user_types'] = $record2['user_type'];
					$_SESSION['sess_assign_user_id'] = $record2['assign_user_id'];
					$_SESSION['ses_assign_user_type'] = $record2['assign_user_type'];
				
					
				echo "<script>window.location.href='index1.php?fopen=dashboard/admin'</script>";
					   		

		}
					
		}
		else
		{
			echo "No user found";
		}
		/*}
		else
		{
			echo "<script>window.location.href='index1.php?fopen=dashboard/expire'</script>";
		}*/
}
		

 
  

	
##### 
$db->close();

?>