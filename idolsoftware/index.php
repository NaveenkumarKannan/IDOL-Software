<!DOCTYPE html>
<html>
    
<!-- Mirrored from dreamguys.co.in/smarthr/orange/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Jul 2018 07:10:52 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>Task Management System</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <?php  date_default_timezone_set("Asia/Kolkata");?>
<?php
ob_start();
session_start(); 
require("model/config.inc.php"); 
require("model/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect();


if(!empty($_POST['user']) && !empty($_POST['password']))
{
	$table = "user_creation";
    $data = $_POST;		
	 $sql = "SELECT * FROM  ".$table."  where user_name='$_POST[user_name]' and password='$_POST[password]' and status='1' ";
	$rows2 = $db->fetch_all_array($sql);
	foreach($rows2 as $record2)
					{
					$_SESSION['sess_user_id'] = $record2['user_id'];
					$_SESSION['sess_user_name'] = $record2['user_name'];
					$_SESSION['ses_user_types'] = $record2['user_type'];
					$_SESSION['ses_assign_user_type'] = $record2['assign_user_type'];	
					$_SESSION['ses_assign_user_id'] = $record2['assign_user_id'];
					$_SESSION['status'] = $record2['status'];
					}

if(($_SESSION['status']!='1'))
{	
   $spanmsg	= "Wrong UserName Or PassWord."	;		
}
}
else 
{	
 $spanmsg= "please login valid details."; 				
}


?>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.html"><img src="assets/img/idol.png" alt="Focus Technologies"></a>
							</div>
							<form >
								<div class="form-group form-focus">
									<label class="control-label">Username or Email</label>
									<input class="form-control floating" type="text" name="user_name" id="user_name">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input class="form-control floating" type="password" name="password" id="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block account-btn" type="button" onClick="tms_login_form(user_name.value,password.value)">Login</button>
								</div>
								<div class="text-center">
									<a href="forgot-password.html">Forgot your password?</a>
								</div>
							</form>
						</div><div class="col-sm-12" style="padding-top:10px;"></div>
							<div class="col-sm-12">
										<div class="form-group">
						Download Idol App  <a href="idoldownload.php" target="_Blank" >	<img src="assets/img/play.png" height="28" width="90"/> </a>  <span style="font-size:12px; font-color:#eee;">
						Click Here</span>
						</div></div>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
    </body>

<!-- Mirrored from dreamguys.co.in/smarthr/orange/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Jul 2018 07:10:53 GMT -->
</html>
<script type="text/javascript">


function tms_login_form(user,password)
{
		jQuery.ajax({
		type: "POST",
		url: "model/loginform.php",
		data: "user="+user+"&password="+password+"&action=Login",
		success: function(msg){
			
			if(msg!='No user found')
			{
           window.location.href="index1.php?fopen=dashboard/admin"; 
		    }
		  else
		 {
			 alert("UserName Or Password is Incorrect");
			 }
		}
		});
}

</script>