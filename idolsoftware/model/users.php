<?php
error_reporting(0);
ob_start();
session_start();
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$action = $_GET['action'];
$table = "sale_person_creation";

$create_date=date("Y-m-d");
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];
$user=mysql_fetch_array(mysql_query("select b.company_id,b.company_name,a.insert_id,a.source from user_creation as a join manage_companys as b on b.company_id=a.insert_id where a.source='Manage Companys' and a.user_id='$ses_user_id' "));

//Invoice


##### 
switch ($action){
	case "add":
	$image_array=$_FILES['file_data'];
		$picturename1=$image_array['name'];
		$main_name=$image_array['tmp_name'];
if($picturename1!='') {  $new_img=$picturename1; } else {$new_img=$_POST['img']; }
		$sql = "select * from sale_person_creation where  person_name='$_POST[personname]' and
		phn_no='$_POST[mobile]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
			$Insql=mysql_query("insert into sale_person_creation(person_name,person_email,phn_no,designation,shift_start,shift_end,username,password,confirm_password,photo,status,user_company_id,user_company_type,random_no,random_sec,user_ip)values
			('$_POST[personname]','$_POST[emailid]','$_POST[mobile]','$_POST[designtion]','$_POST[starttime]','$_POST[endtime]','$_POST[username]','$_POST[passwrd]','$_POST[confirmpassword]','$new_img','$_POST[status]','$_POST[ses_user_id]','$_POST[ses_user_type]','$_POST[randomno]','$_POST[randomsec]','$_POST[user_ip]')");
		$insert_id=mysql_insert_id();
	
		$insql12=mysql_query("insert into user_creation(user_name,password,confirm_password,user_type,status,insert_id,source,assign_user_id,assign_user_type,company_name,company_id)values
			('$_POST[username]','$_POST[passwrd]','$_POST[confirmpassword]','3','$_POST[status]','$insert_id','Manage Users','$_POST[ses_user_id]','$_POST[ses_user_type]','$user[company_name]','$user[company_id]')");

$upload_file='../assets/img/users/'.$picturename1;
		
		
			copy($main_name,$upload_file);
			
			echo "<span class=text-success>Successfully Added</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";
	break;

	case "edit":	
	$image_array=$_FILES['file_data'];
		$picturename1=$image_array['name'];
		$main_name=$image_array['tmp_name'];
		if($picturename1!='') { $new_img=$picturename1; } else {$new_img=$_POST['img']; }
		 $sql = "select * from sale_person_creation where  person_name='$_POST[personname]' and
		phn_no='$_POST[mobile]' and sal_per_id!='$_GET[update_id]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
		
			$Insql=mysql_query("update sale_person_creation set person_name='$_POST[personname]',person_email='$_POST[emailid]',phn_no='$_POST[mobile]',designation='$_POST[designtion]',shift_start='$_POST[starttime]',shift_end='$_POST[endtime]',username='$_POST[username]',password='$_POST[passwrd]',confirm_password='$_POST[confirmpassword]',photo='$new_img',status='$_POST[status]',user_company_id='$_POST[ses_user_id]',user_company_type='$_POST[ses_user_type]',user_ip='$_POST[user_ip]' where sal_per_id='$_GET[update_id]'");
			$insql12=mysql_query("update user_creation set user_name='$_POST[username]',password='$_POST[passwd]',confirm_paassword='$_POST[cnfrmpasswd]',status='$_POST[status]',assign_user_id='$_POST[ses_user_id]',assign_user_type='$_POST[ses_user_type]' where insert_id='$_GET[update_id]' and source='Manage Users'");
$upload_file='../assets/img/users/'.$picturename1;
		
		
			copy($main_name,$upload_file);
			
			echo "<span class=text-success>Successfully Update</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";		
	break;

    case "delete":
		/*$where = "cust_id='$delete_id' ";
        $row = $db->query_delete($table,$where);*/
		$Insql=mysql_query("delete from sale_person_creation  where sal_per_id='$_GET[delete_id]'");
				$Insql=mysql_query("delete from user_creation  where insert_id='$_GET[delete_id]' and source='Manage Users'");

		echo "<span class=text-success>Successfully Deleted</span>";
	break;
}
$db->close();
?>