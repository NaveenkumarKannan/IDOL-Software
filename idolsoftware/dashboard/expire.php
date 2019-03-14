<!DOCTYPE html>
<html>
    

    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper" id="user_list">
            <?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
 $ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type=$_SESSION['ses_user_types'];
$cur_date=date("Y-m");
?>
<h1>Your Software is Expired.</h1>
</div></div></body>
</html>
