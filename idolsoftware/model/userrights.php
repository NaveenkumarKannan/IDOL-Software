<?php
require("config.inc.php"); 
require("Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

$action = $_GET['action'];
$update_id = $_GET['update_id'];
$delete_id = $_GET['delete_id'];
$table = "user_rights";
$data = $_POST;

##### 
switch ($action) {
    case "add":
	$sql = "SELECT * FROM `".$table."` WHERE user_name='$data[user_name]' and user_screen='$data[user_screen]'";
	$row = $db->query($sql); 
	
	if($db->affected_rows === 0)
	{
		$db->query_insert($table, $data);
		echo "<span class=text-success>Successfully Added</span>";
	}
	else
		echo "<span class=text-danger>Already Exit</span>";

        break;
    case "edit":
		$where = "	user_id='$update_id' ";
        $row = $db->query_update($table, $data, $where);
		echo "<span class=text-success>Successfully Updated</span>";
        break;
    case "delete":
		$where = "	user_id='$delete_id' ";
        $row = $db->query_delete($table,$where);
		echo "<span class=text-success>Successfully Deleted</span>";
        break;
}
##### 

$db->close();

?>