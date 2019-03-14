 <?php
 error_reporting(0);
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
 function get_user_id($user_name)
  {
    $sql_user="select * from user_type where user_type='$user_name' ";
	$rs_user=mysql_query($sql_user);
	  while($rsdata=mysql_fetch_object($rs_user))
			  {  

			     $user_type_id=$rsdata->user_type_id;
			  }
			  return $user_type_id;
 } 
$action = $_GET['action'];
$update_id = $_GET['update_id'];
$sub_id = $_GET['sub_id'];
$delete_id = $_GET['delete_id'];
$table1 = "user_permissions";
$table2 = "user_permission_main";
$table3 = "user_rights";
$data = $_POST;
$user_value=$_POST['user_value'];
$admin_ent=$_POST['admin_ent'];
$admin_ent_exp=explode(",",$admin_ent);
$admin_ent_split=$admin_ent_exp[0];
$master_ent=$_POST['master_ent'];
$staff_ent=$_POST['staff_ent'];
$report_ent=$_POST['report_ent'];

$user_name=$_POST['user_name'];

$user_id=get_user_id($user_name);

$create_date=date('Y-m-d');
function get_checks_permis_permis($user_name,$val)
  {
	 $sql_user="select * from user_permissions where box_name='$val' and user_type_id='$user_name'";
	$rs_user=mysql_query($sql_user);
	$rs_count=mysql_num_rows($rs_user);
	return $rs_count;
 } 
 function get_checks_permis_permis_data($user_name)
  {
    $sql_user="select * from user_permission_main where user_name='$user_name' ";
	$rs_user=mysql_query($sql_user);
	$rs_count=mysql_num_rows($rs_user);
	return $rs_count;
 }

/********************************** ADD QUERY ***************************************/
switch ($action) {
	//FOR MAINLIST
    case "Add":


$Insql=mysql_query("update user_permissions set permission='0' where user_type_id='$user_name' ");

if(($admin_ent!=''))
{ 
$admin_ent_exp=explode(",",$admin_ent);
foreach($admin_ent_exp as $val)
{
	$check=get_checks_permis_permis($user_name,$val);
	if($check=='0')
	{
      $Insql=mysql_query("insert into user_permissions(user_type_id,box_name,form_id,permission,created_date,user_id)values('$user_name','$val','1','1','$create_date','$user_id')");
	}
	else
	{
		//echo "update user_permissions set permission='1' where user_type_id='$user_name' and box_name='$val' and form_id='1'";
		$Insql=mysql_query("update user_permissions set permission='1' where user_type_id='$user_name' and box_name='$val' and form_id='1'");
		}
}
}

if(($master_ent!=''))
{
$master_ent_exp=explode(",",$master_ent);
foreach($master_ent_exp as $val)
{
	$check=get_checks_permis_permis($user_name,$val);
	if($check=='0')
	{
      $Insql=mysql_query("insert into user_permissions(user_type_id,box_name,form_id,permission,created_date,user_id)values('$user_name','$val','2','1','$create_date','$user_id')");
	}
	else{
		$Insql=mysql_query("update user_permissions set permission='1' where user_type_id='$user_name' and box_name='$val' and form_id='2'");
		}
}
}

if(($staff_ent!=''))
{
$staff_ent_exp=explode(",",$staff_ent);
foreach($staff_ent_exp as $val)
{
	 $check=get_checks_permis_permis($user_name,$val);
	if($check=='0')
	{
$Insql=mysql_query("insert into user_permissions(user_type_id,box_name,form_id,permission,created_date,user_id)values('$user_name','$val','3','1','$create_date','$user_id')");

	}else
	   {
		$Insql=mysql_query("update user_permissions set permission='1' where user_type_id='$user_name' and box_name='$val' and form_id='3'");
		}
}
}





if(($report_ent!=''))
{
$report_ent_exp=explode(",",$report_ent);
foreach($report_ent_exp as $val)
{
	 $check=get_checks_permis_permis($user_name,$val);
	if($check=='0')
	{
$Insql=mysql_query("insert into user_permissions(user_type_id,box_name,form_id,permission,created_date,user_id)values('$user_name','$val','4','1','$create_date','$user_id')");

	}else
	   {
		$Insql=mysql_query("update user_permissions set permission='1' where user_type_id='$user_name' and box_name='$val' and form_id='4'");
		}
}
}





$check_data=get_checks_permis_permis_data($user_name);
if($check_data=='0')
{
$Insql=mysql_query("insert into user_permission_main(user_name,createdate,user_id)values('$user_name','$create_date','$user_id')");
}
echo "<script>alert('Successfully Added/Updated')</script>";
break;

 case "delete":
        $where = "main_id='$delete_id' ";
        $row = $db->query_delete($table2,$where);
		$Insql=mysql_query("delete from user_permission_main where main_id='$_POST[main_id]'");
		$Insql=mysql_query("delete from user_permissions where user_id='$_GET[user_id]'");
		echo "<span class=text-success>Successfully Deleted</span>";
		
        break;
}
$db->close();
?>
