<!DOCTYPE html>
<html>
    
<?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 

$ses_user_id= $_SESSION['sess_user_id'];
echo "sas". $ses_user_type= $_SESSION['ses_user_types'];
?>
    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper" id="user_list">
                <div class="content container-fluid">
			
<div class="row" id="get_user_list_div">
  <?php 
ob_start();
session_start(); 
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
 echo $ses_user_type=$_SESSION['ses_user_types'];

$suser_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$ses_user_id' and source='Manage Companys'"));
$company=mysql_fetch_array(mysql_query("select * from manage_companys where company_id='$suser_id[insert_id]'"));

$sql_cunt=mysql_num_rows(mysql_query("select * from sale_person_creation where user_company_id='$ses_user_id'"));

?>
						<div class="col-xs-4">
							<h4 class="page-title">Manage Users</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
						<?php if($sql_cunt<$company[user_limit]) { ?>	<a href="#" class="btn btn-primary rounded pull-right" onClick="get_manage_user_add('add');" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add User</a> <?php } else if($ses_user_type=='1') { ?>
				<span style="font-size:14px; text-align:center; color:#f43b48;"><strong>Admin Can't Add The Users</strong></span>	<?php } else { ?>		<span style="font-size:14px; text-align:center; color:#f43b48;"><strong>Your User Limitation is over. For More Details Contact +91 90879 24444</strong></span> <?php } ?>
						</div>
					</div>

<?php  if(($sql_cunt!=0)||($ses_user_type=='1')) {?>
<div class="row staff-grid-row" id="get_user_list_div">
    <?php echo $emp_id=$_POST['emp_id']; ?>
 <table width="100%" align="center">
                    <?php 
                    if($ses_user_type!='1')
                    {
					$sql="select * from sale_person_creation where user_company_id='$ses_user_id'";
                    }
                    else
                    {
                    	$sql="select * from sale_person_creation ";
                    }
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
							if($record['status']=='1')
							{
								$status="<span style='color:#85ff00'>Active</span>";
								
							}
							else
							{
								$status="<span style='color:#ef0404'>De-Active</span>";
							}
							$check_in_count=mysql_num_rows(mysql_query("select * from check_in where person_id='$record[sal_per_id]'"));
					?>

            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-12">
        
                                <tr class="profile-widget">
                            <td width="20%" align="left">
								<?php if($record['photo']!='') { ?>
                                <img src="assets/img/users/<?php echo $record['photo']; ?>" width="35" height="40"/>
                                <?php } else { ?>
                                    <img src="assets/img/users/user.png" width="35" height="40"/>

                                <?php } ?>
								</td>
                               <td width="46%" align="left" >
								<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_user_edit('<?php echo $record['sal_per_id']; ?>');" data-target="#edit_employee"><?php echo $record['person_name']; ?></a></h3>
								<div style="color:#ead8d8;"><?php echo $record['designation']; ?>&nbsp; <?php echo $status; ?></div>
                                <div style="color:#ead8d8;"><?php echo $record['phn_no']; ?>&nbsp; <?php echo $record['person_email']; ?></div>
								</td>
                                  
								 <td width="34%" align="right">
								<!-- <button class="btn btn-primary" type="button" id="add" name="add">Assign Work</button>-->
                                <button class="btn btn-success" type="button" id="delete" name="delete" onClick="delete_manage_users('<?php echo $record['sal_per_id']; ?>');" >Delete</button>
								</td>
							
                            </tr>
						</div>
         	
           
                        <?php }   ?>
						</table>
						</div>
						
						<?php } else { ?>
						<div class="row staff-grid-row">
                    <div class="col-lg-12">
							<div class="dash-widget clearfix card-box">
                           
								<div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
								</div>
                                </div>
                                
                                
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
                                   No Users Available
								</div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-lg-6">
								<div  align="left">
									
                                   
                                   
								</div>
                                </div>
							</div>
						</div>
                        </div>
			<?php } ?>
				
                </div>
				
            </div>
			
            <div class="modal custom-modal fade" role="dialog" id="add_employee" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit User</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="user_add_list">
                                                            <?php include("create.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
            <div class="modal custom-modal fade" role="dialog" id="edit_employee" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit User</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="user_update_list">
                                                            <?php include("edit.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                               </div>
                            </div>
		
		
		
    </body>

</html>
<script>


	function get_manage_user_edit(edit_id)
	{
		$.ajax({
		type: "POST",
		url: "users/edit.php?edit_id="+edit_id,
		success: function(data) {
			$("#user_update_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	function get_manage_user_add(val)
	{
		$.ajax({
		type: "POST",
		url: "users/create.php?source="+val,
		success: function(data) {
			$("#user_add_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	</script>