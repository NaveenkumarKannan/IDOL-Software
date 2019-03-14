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
							<h4 class="page-title">Manage Users</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
						<?php if($sql_cunt<$company[user_limit]) { ?>	<a href="#" class="btn btn-primary rounded pull-right" onClick="get_manage_user_add('add');" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add User</a> <?php } else { ?>
							<span style="font-size:14px; text-align:center; color:#ff0;"></span>Your User Limitation is over. For More Details Contact +91 90879 24444</span> <?php } ?>
						</div>
					</div>
				<div class="row filter-row">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group">
								<label class="control-label">Employee</label>
								<select class="form-control" id="emp_id"> 
									<option value="">Select Employee</option>
									 <?php 
											$sql="select * from sale_person_creation";
											$sqlquery=mysql_query($sql);
											while ($row=mysql_fetch_array($sqlquery))
											{
											$user_id=mysql_fetch_array(mysql_query("select * from user_creation where insert_id='$row[sal_per_id]' "));
											?>
                                            <option value="<?php echo $user_id['user_id'];?>"><?php echo $row['person_name']; ?></option>
                                            <?php } ?>
								</select>
							</div>
						</div>
						
						<div class="col-sm-3 col-xs-6">  
                        <div class="form-group ">
							<button class="btn btn-primary" style="margin-top: 20px;" type="button" onClick="get_user_list(emp_id.value)">View Report</button>
                            </div>
						</div>     
                    </div>
					<div class="row">
						<div class="col-md-12">
							 <div id="get_user_list_div"> <?php include('admin_list.php') ?>
						</div>
					</div>
                </div>
				
            </div>
			
		
			
        </div>
		
    </body>

</html>
 <script>
function get_user_list(emp_id)
{alert("emp_id="+emp_id);
jQuery.ajax({
type: "POST",
url: "users/admin_list.php",
data: "emp_id="+emp_id,
success: function(data) {
jQuery("#get_user_list_div").html(data);
}
});
} 
</script>