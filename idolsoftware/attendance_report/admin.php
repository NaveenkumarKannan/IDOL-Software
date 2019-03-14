

    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Attendance Report</h4>
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
								<label class="control-label">From Date</label>
								<input type="date" class="form-control" id="from_date" value="<?php echo date("Y-m-d"); ?>"  />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6"> 
							<div class="form-group ">
								<label class="control-label">To Date</label>
								<input type="date" class="form-control" id="to_date" value="<?php echo date("Y-m-d"); ?>" />
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
                        <div class="form-group ">
							<button class="btn btn-primary" style="margin-top:20px;" type="button" onClick="get_attendance_report(emp_id.value,from_date.value,to_date.value)">View Report</button>
                            </div>
						</div>     
                    </div>
                   

					<div class="row">
						<div class="col-md-12">
							 <div id="attendance_report_div"> <?php include('admin_list.php') ?>
						</div>
					</div>
                </div>
				
            </div>
			
		
			
        </div>
		
    </body>

</html>
    <script>
function get_attendance_report(emp_id,from_date,to_date)
{
jQuery.ajax({
type: "POST",
url: "attendance_report/admin_list.php",
data: "emp_id="+emp_id+"&from_date="+from_date+"&to_date="+to_date,
success: function(data) {
jQuery("#attendance_report_div").html(data);
}
});
}
</script>