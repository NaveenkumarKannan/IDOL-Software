<?php
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$action = $_GET['action'];
$table = "manage_companys";

$create_date=date("Y-m-d");

//Invoice


##### 
switch ($action){
	case "add":
	

		$sql = "select * from manage_companys where  company_name='$_POST[companyname]' and
		email='$_POST[emailid]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
			$package_valid=mysql_fetch_array(mysql_query("select * from package_details where package_code='$_POST[packageval]'"));
			$renewal_date= date('Y-m-d', strtotime($date. ' + '.$package_valid[package_validation] .'days'));
			$total_amt=$_POST['userlimit']*$_POST['amtperuser'];

			$Insql=mysql_query("insert into manage_companys(user_name,password,confirm_paassword,company_name,email,phone_no,address,designation,contact_person,package,status,renewal_date,user_limit,amt_per_user,total_amt)values
			('$_POST[username]','$_POST[passwrd]','$_POST[cnfrmpasswrd]','$_POST[companyname]','$_POST[emailid]','$_POST[phno]','$_POST[address]','$_POST[designat]','$_POST[contactper]','$_POST[packageval]','$_POST[status]','$renewal_date','$_POST[userlimit]','$_POST[amtperuser]','$total_amt')");
			$insert_id=mysql_insert_id();
		$insql12=mysql_query("insert into user_creation(user_name,password,confirm_password,user_type,status,insert_id,source)values
			('$_POST[username]','$_POST[passwrd]','$_POST[cnfrmpasswrd]','2','$_POST[status]','$insert_id','Manage Companys')");


			echo "<span class=text-success>Successfully Added</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";
	break;

	case "edit":	
		$sql = "select * from manage_companys where  company_name='$_POST[companyname]' and
		email='$_POST[email]' and company_id!='$_GET[update_id]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
			$package_valid=mysql_fetch_array(mysql_query("select * from package_details where package_code='$_POST[package]'"));
			$renewal_date= date('Y-m-d', strtotime($date. ' + '.$package_valid[package_validation] .'days'));
				$total_amt=$_POST['userlimit']*$_POST['amtperuser'];

			$Insql=mysql_query("update manage_companys set user_name='$_POST[username]',password='$_POST[passwrd]',confirm_paassword='$_POST[cnfrmpasswrd]',company_name='$_POST[companyname]',email='$_POST[emailid]',phone_no='$_POST[phno]',address='$_POST[address]',designation='$_POST[designat]',contact_person='$_POST[contactper]',package='$_POST[packageval]',status='$_POST[status]',renewal_date='$renewal_date',user_limit='$_POST[userlimit]',amt_per_user='$_POST[amtperuser]',total_amt='$total_amt' where company_id='$_GET[update_id]'");
			$insql12=mysql_query("update user_creation set user_name='$_POST[username]',password='$_POST[passwrd]',confirm_paassword='$_POST[cnfrmpasswrd]',status='$_POST[status]' where insert_id='$_GET[update_id]' and source='Manage Companys'");

			
			echo "<span class=text-success>Successfully Update</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";		
	break;

    case "delete":
		/*$where = "cust_id='$delete_id' ";
        $row = $db->query_delete($table,$where);*/
		$Insql=mysql_query("delete from manage_companys  where company_id='$_GET[delete_id]'");
		$Insql=mysql_query("delete from user_creation  where insert_id='$_GET[delete_id]' and source='Manage Companys'");
		echo "<span class=text-success>Successfully Deleted</span>";
	break;
}
$db->close();
?>