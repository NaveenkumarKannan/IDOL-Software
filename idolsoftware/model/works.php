<?php
ob_start();
session_start();
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$action = $_GET['action'];
$table = "assign_work";

$create_date=date("Y-m-d");

//Invoice


##### 
switch ($action){
	case "add":
	
$emp_user_id=mysql_fetch_array(mysql_query("select * from user_creation where insert_id='$_POST[employee]' and source='Manage Users'"));
		
					$Insql=mysql_query("insert into assign_work(work_title,details,deadline,priority,assign_employee,user_login_id,user_login_type,work_type,collection_amt,ass_emp_user_id)values
			('$_POST[wrktitle]','$_POST[details]','$_POST[dedaline]','$_POST[priorval]','$_POST[employee]','$_POST[ses_user_id]','$_POST[ses_user_type]','$_POST[work_type]','$_POST[collamt]','$emp_user_id[user_id]')");
		


			echo "<span class=text-success>Successfully Added</span>";
		
	break;

	case "edit":	
		$emp_user_id=mysql_fetch_array(mysql_query("select * from user_creation where insert_id='$_POST[employee]' and source='Manage Users'"));

			$Insql=mysql_query("update assign_work set work_title='$_POST[wrktitle]',details='$_POST[details]',deadline='$_POST[dedaline]',priority='$_POST[priorval]',assign_employee='$_POST[employee]',user_login_id='$_POST[ses_user_id]',user_login_type='$_POST[ses_user_type]',work_type='$_POST[work_type]',collection_amt='$_POST[collamt]',ass_emp_user_id='$emp_user_id[user_id]' where work_id='$_GET[update_id]'");

			
			echo "<span class=text-success>Successfully Update</span>";
	
	break;

    case "delete":
		/*$where = "cust_id='$delete_id' ";
        $row = $db->query_delete($table,$where);*/
		$Insql=mysql_query("delete from assign_work  where work_id='$_GET[delete_id]'");
		echo "<span class=text-success>Successfully Deleted</span>";
	break;
}
$db->close();
?>