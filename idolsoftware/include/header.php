<!DOCTYPE html>
<html>
    

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <title>TMS</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/plugins/morris/morris.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/responsive.bootstrap.min.css">
    </head>
	<?php  
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect();
$sess_user_name= $_SESSION['sess_user_name'];

$ses_user_type= $_SESSION['ses_user_types'];
$ses_user_id= $_SESSION['sess_user_id'];
$content = $_GET['fopen'];
function get_permission($pack_code,$menu_id)
{
    $sql=mysql_fetch_array(mysql_query("select * from package_limit where package_code='$pack_code' and menu_id='$menu_id'"));
    $permission=$sql['permission'];
    return $permission;
}
$sal_pr_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$ses_user_id' and source='Manage Companys'"));
$company=mysql_fetch_array(mysql_query("select * from manage_companys where company_id='$sal_pr_id[insert_id]'"));
$pack_valid=mysql_fetch_array(mysql_query("select * from package_details where package_code='$company[package]'"));
 $com_dat=date("Y-m-d",strtotime($company[cr_date]));
 $valid=date('Y-m-d', strtotime($com_dat. ' +' .$pack_valid[package_validation] .'days'));
 $current_date=date("Y-m-d");

	 ?>
	 
    <body>
      
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index1.php?fopen=dashboard/admin" class="account-logo">
						<img src="assets/img/idol.png" alt="">
					</a>
                </div>
                <div class="page-title-box pull-left">
					<h3></h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					
					<li class="dropdown">
						<a href="profile.html" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span class="user-img"><img class="img-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
							<span><?php echo ucfirst($sess_user_name); ?></span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							
							<li><a href="index.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				
            </div>
              <?php if(($current_date<=$valid)||($ses_user_type=='1'))
	 { ?>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li > 
								<a href="index1.php?fopen=dashboard/admin">Dashboard</a>
							</li>
							
								<?php if($ses_user_type=='1') { ?><li><a href="index1.php?fopen=companys/admin">Manage Companys</a></li><?php } ?>
					<?php  $permi=get_permission($company[package],'1');  if(($ses_user_type=='1')||($permi=='1')) { ?>	<li><a href="index1.php?fopen=users/admin">Manage Users</a></li><?php } ?>
									
						<?php  $permi=get_permission($company[package],'3');  if(($ses_user_type=='1')||($permi=='1')) { ?>	<li> 
								<a href="index1.php?fopen=works/admin">Manage Works</a>
							</li><?php } ?>
						<?php $permi=get_permission($company[package],'4'); if(($ses_user_type=='1')||($permi=='1')) { ?>	<li> 
								<a href="index1.php?fopen=manage_checkins/admin">Manage Check-ins</a>
							</li><?php } ?>
                            	
							
						<?php if(($ses_user_type=='1')||($ses_user_type=='2')) { ?>		<!--<li class="submenu">
								<a href="#"><span> Reports </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="index1.php?fopen=expense_report/admin"> Expense Report </a></li>
									<li><a href="index1.php?fopen=checkin report/admin"> Check-In Report </a></li>
                                    <li><a href="index1.php?fopen=collection_report/admin"> Collection Report </a></li>
									<li><a href="index1.php?fopen=attendance_report/admin"> Attendance Report </a></li>
                                    <li><a href="index1.php?fopen=tracking_report/admin"> GPS Report </a></li>
								</ul>
							</li>-->
							<li class="dropdown">
						<a  class="dropdown-toggle user-link" data-toggle="dropdown" >
							<span>Reports</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
						 <?php $permi=get_permission($company[package],'7'); if(($ses_user_type=='1')||($permi=='1')) { ?>	
						 <li><a href="index1.php?fopen=expense_report/admin"> Expense Report </a></li>
						 <?php } ?>
							<?php $permi=get_permission($company[package],'6'); if(($ses_user_type=='1')||($permi=='1')) { ?>	
								<li><a href="index1.php?fopen=checkin report/admin"> Check-In Report </a></li>
								<?php } ?>
                                <?php $permi=get_permission($company[package],'16'); if(($ses_user_type=='1')||($permi=='1')) { ?>	
                                <li><a href="index1.php?fopen=collection_report/admin"> Collection Report </a></li>
                                <?php } ?>
								 <?php $permi=get_permission($company[package],'9'); if(($ses_user_type=='1')||($permi=='1')) { ?>	
								 <li><a href="index1.php?fopen=attendance_report/admin"> Attendance Report </a></li>
								 <?php } ?>
                                   <?php $permi=get_permission($company[package],'8'); if(($ses_user_type=='1')||($permi=='1')) { ?>
                                   <li><a href="index1.php?fopen=tracking_report/admin"> GPS Report </a></li>
                                   <?php } ?>
						</ul>
					</li>
							<?php } ?>
						<?php if($ses_user_type=='1') { ?>	<li> 
								<a href="index1.php?fopen=package/admin">Packages</a>
							</li><?php } ?>
                            
						</ul>
					</div>
                </div>
            </div><?php } ?>
            
        </div>
        
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="assets/plugins/raphael/raphael-min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-migrate.js"></script>
        
  <!------------------------------------------Other JS----------------------------------------------------->
<script src="bootstrap/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/dataTables.bootstrap.min.js"></script>
<script src="bootstrap/js/dataTables.responsive.min.js"></script>
<script src="bootstrap/js/responsive.bootstrap.min.js"></script>
<script src="bootstrap/js/enter_event_ajax.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery/jquery-ui.js"></script>
<script src="js/shortcut.js"  	></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="bootstrap/js/jquery-ui.js"></script>
 

       
                

    </body>


</html>