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
$ses_user_type=$_SESSION['ses_user_types'];
$sql_cunt=mysql_num_rows(mysql_query("select * from assign_work where user_login_id='$ses_user_id'"));

?>
    <body>
        <div class="main-wrapper">
            
          	
            <div class="page-wrapper" id="work_list">
             
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Manage Works</h4>
						</div>
                        
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_work" onClick="get_manage_work_add('<?php echo "add"; ?>')"><i class="fa fa-plus"></i> Assign Work</a>
							
						</div>
					</div>
				   <?php  if(($sql_cunt!=0)||($ses_user_type=='1')) {?>  
					<div class="row staff-grid-row">
                   <table width="100%" align="center">
                             <?php 
                             if($ses_user_type=='1')
                             {
					        $sql="select * from assign_work ";
                             }
                             else
                             {
                             $sql="select * from assign_work where user_login_id='$ses_user_id'";
                             }
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
							if($record['work_status']=='1')
							{
								$status="<span style='color:#fff'><strong>Check-In</strong></span>";
							}
							else if($record['work_status']=='2')
							{
								$status="<span style='color:#85ff00'><strong>Completed</strong></span>";
							}
							else
							{
								$status="<span style='color:#ef0404'><strong>Pending</strong></span>";
							}
							$ass_emp=mysql_fetch_array(mysql_query("select * from sale_person_creation where sal_per_id='$record[assign_employee]'"));
					?>
						<div class="col-md-6 col-sm-6 col-xs-6 col-lg-12">
        
                                <tr class="profile-widget">
                           
                               <td width="86%" align="left" >
								<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_work_edit('<?php echo $record['work_id']; ?>');" data-target="#edit_work"><?php echo $record['work_title']; ?></a></h3>
								<div style="color:#ead8d8;"><?php echo $ass_emp['person_name']; ?>&nbsp; <?php echo $status; ?></div>
                                <div style="color:#ead8d8;"><?php echo date("d-m-Y",strtotime($record['deadline'])); ?>&nbsp; <?php echo ucfirst($record['priority']); ?></div>
								</td>
                                  
								 <td width="14%" align="right" >
								 
                                <button class="btn btn-success" type="button" id="delete" name="delete" onClick="delete_manage_works('<?php echo $record['work_id']; ?>');" >Delete</button>
								</td>
							
                            </tr>
						</div>
                        <?php }   ?>
						
						
						
						
						
			
				</table>
						</div>
						
						
						<?php  } else {?>
                    <div class="row staff-grid-row">
                    <div class="col-lg-12">
							<div class="dash-widget clearfix card-box">
                           
								<div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
								</div>
                                </div>
                                
                                
                                <div class="col-md-6 col-sm-6 col-lg-3">
								<div  align="left">
									
                                   No Works Available
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
		
            <div class="modal custom-modal fade" role="dialog" id="add_work" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Work</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="work_add_list">
                                                            <?php include("create.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
            <div class="modal custom-modal fade" role="dialog" id="edit_work" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Work</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="work_update_list">
                                                            <?php include("edit.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
			
			
		</div>
		
    </body>

</html>

<script>


	function get_manage_work_edit(edit_id)
	{
		$.ajax({
		type: "POST",
		url: "works/edit.php?edit_id="+edit_id,
		success: function(data) {
			$("#work_update_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	function get_manage_work_add(val)
	{
		$.ajax({
		type: "POST",
		url: "works/create.php?source="+val,
		success: function(data) {
			$("#work_add_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	</script>