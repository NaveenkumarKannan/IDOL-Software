<?php
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$action = $_GET['action'];
$table = "package_details";

$create_date=date("Y-m-d");

//Invoice


##### 
switch ($action){
	case "add":
	

		$sql = "select * from package_details where  package_name='$_POST[packagename]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
			$Insql=mysql_query("insert into package_details(package_name,package_amount,package_validation,user_limit,description,package_code,status,hidden_val)values
			('$_POST[packagename]','$_POST[amount]','$_POST[packvalidation]','$_POST[userlimit]','$_POST[description]','$_POST[packcode]','$_POST[status]','$_POST[hiddenval]')");
		$insert_id=mysql_insert_id();
$value=$_POST['hiddenval'];
$val=explode(",",$value);
foreach($val as $new)
{
	$cnt=$cnt+1;
	$newval=explode("@@",$new);
	$menu_id=$newval[0];
	$user_type_id=$newval[1];
	if($menu_id!='')
	{
			$Insql=mysql_query("insert into package_limit(package_id,menu_id,permission,permission_user_type,package_code,menu_val)values
			('$insert_id','$menu_id','1','$user_type_id','$_POST[packcode]','$new')");
	}
}

			echo "<span class=text-success>Successfully Added</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";
	break;

	case "edit":	
		$sql = "select * from package_details where  package_name='$_POST[packagename]' and pack_id!='$_GET[update_id]'";
		$row = $db->query($sql); 
		if($db->affected_rows === 0)
		{
			$Insql=mysql_query("update package_details set package_name='$_POST[packagename]',package_amount='$_POST[amount]',package_validation='$_POST[packvalidation]',user_limit='$_POST[userlimit]',description='$_POST[description]',package_code='$_POST[packcode]',status='$_POST[status]',hidden_val='$_POST[hiddenval]' where pack_id='$_GET[update_id]'");
$value=$_POST['hiddenval'];
$val=explode(",",$value);
foreach($val as $new)
{
	$cnt=$cnt+1;
	$newval=explode("@@",$new);
	$menu_id=$newval[0];
	$user_type_id=$newval[1];
	if($menu_id!='')
	{
	   
		$delsql=mysql_query("delete from package_limit where package_id='$_GET[update_id]'");
			$Insql=mysql_query("insert into package_limit(package_id,menu_id,permission,permission_user_type,package_code,menu_val)values
			('$_GET[update_id]','$menu_id','1','$user_type_id','$_POST[packcode]','$new')");
	echo	"insert into package_limit(package_id,menu_id,permission,permission_user_type,package_code,menu_val)values
			('$_GET[update_id]','$menu_id','1','$user_type_id','$_POST[packcode]','$new')";
	}
}
			
			echo "<span class=text-success>Successfully Update</span>";
		}
		else
			echo "<span class=text-danger>Already Exit</span>";		
	break;

    case "delete":
		/*$where = "cust_id='$delete_id' ";
        $row = $db->query_delete($table,$where);*/
		$Insql=mysql_query("delete from package_details  where pack_id='$_GET[delete_id]'");
		$Insql=mysql_query("delete from package_limit  where package_id='$_GET[delete_id]'");
		echo "<span class=text-success>Successfully Deleted</span>";
	break;
}
$db->close();
?>