<link media="all" type="text/css" href="assets/dashicons.css" rel="stylesheet">
<link media="all" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet">
<link rel='stylesheet' id='style-css'  href='assets/css/style.css' type='text/css' media='all' />
<script type='text/javascript' src='assets/js/jquery.js'></script>
<script type='text/javascript' src='assets/js/jquery-migrate.js'></script>

<?php /* === GOOGLE MAP JAVASCRIPT NEEDED (JQUERY) ==== */ ?>
<!--<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyDc-_6YG6XHoaWG0SUSRJSUXLPV-J9raSU"></script>-->
<script 
    src="https://maps.googleapis.com/maps/api/js?v=3.33
        &key=AIzaSyCfFgqwWUKeQzolWvu50uy59ySf5f9f13Q">
</script>
<script type='text/javascript' src='assets/js/gmaps.js'></script>
<?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
?>

    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">GPS Report</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							
							
						</div>
						
					</div>
										<?php
error_reporting(0);
ob_start();
session_start(); 
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

$ses_assign_user_id= $_SESSION['ses_assign_user_id'];
 $ses_user_type= $_SESSION['ses_user_types'];
  $sess_user_id= $_SESSION['sess_user_id'];


?>
					<div class="row filter-row">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group">
								<label class="control-label">Employee</label>
								<select class="form-control" id="emp_id"> 
									<option value="">Select Employee</option>
									 <?php 
											$sql="select * from sale_person_creation where user_company_id='$sess_user_id'";
											$sqlquery=mysql_query($sql);
											while ($row=mysql_fetch_array($sqlquery))
											{
											$user_id=mysql_fetch_array(mysql_query("select * from user_creation where insert_id='$row[sal_per_id]' and source='Manage Users'"));
											?>
                                            <option value="<?php echo $user_id['user_id'];?>"><?php echo $row['person_name']; ?></option>
                                            <?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group">
								<label class="control-label"> Date</label>
								<input type="date" class="form-control" id="from_date" value="<?php echo date("Y-m-d"); ?>"  />
							</div>
						</div>
					
						<div class="col-sm-3 col-xs-6" style="margin-top:15px;">  
                        <div class="form-group ">
							<button class="btn btn-primary" style="height:40px;" type="button" onClick="get_gps_report(emp_id.value,from_date.value)">View Report</button>
                            </div>
						</div>     
                    </div>
                   

					<div class="row">
						<div class="col-md-12">
							 <div id="gps_report_div"> <?php include('admin_list.php') ?>
						</div>
					</div>
                </div>
				
            </div>
			
		
			
        </div>
		
    </body>

</html>
    <script>
function get_gps_report(emp_id,from_date)
{
jQuery.ajax({
type: "POST",
url: "tracking_report/admin_list.php",
data: "emp_id="+emp_id+"&from_date="+from_date,
success: function(data) {
jQuery("#gps_report_div").html(data);
}
});
}
</script>