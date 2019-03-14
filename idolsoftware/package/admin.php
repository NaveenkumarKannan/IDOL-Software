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

?>
    <body>
        <div class="main-wrapper">
            
            
            <div class="page-wrapper" id="user_list">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Package Details</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" onClick="get_package_add('add');" data-toggle="modal" data-target="#add_package"><i class="fa fa-plus"></i> Add Package</a>
							
						</div>
					</div>
					
					
                    <?php 
					ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
$sql_cunt=mysql_num_rows(mysql_query("select * from package_details "));

?>
<?php  if($sql_cunt!=0) {?>
<div class="row staff-grid-row">
 <table width="100%" align="center">
                    <?php 
					$sql="select * from package_details ";
					
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
							//$check_in_count=mysql_num_rows(mysql_query("select * from check_in where person_id='$record[sal_per_id]'"));
					?>

            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-12">
        
                                <tr class="profile-widget">
                            <td width="20%" align="left">
								
								</td>
                               <td width="46%" align="left" >
								<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_package_edit('<?php echo $record['pack_id']; ?>');" data-target="#edit_package"><?php echo $record['package_name']; ?></a></h3>
								<div style="color:#ead8d8;"><?php echo $record['package_code']; ?>&nbsp; <?php echo $status; ?></div>
                             <!--   <div style="color:#ead8d8;"><?php echo $record['phn_no']; ?>&nbsp; <?php echo $record['person_email']; ?></div>-->
								</td>
                                  
								 <td width="34%" align="right">
								<!-- <button class="btn btn-primary" type="button" id="add" name="add">Assign Work</button>-->
                                <button class="btn btn-success" type="button" id="delete" name="delete" onClick="delete_package_details('<?php echo $record['pack_id']; ?>');" >Delete</button>
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
									
                                   No Package Details are Available
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
			
            <div class="modal custom-modal fade" role="dialog" id="add_package" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Add Package</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="package_add_list">
                                                            <?php include("create.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
            <div class="modal custom-modal fade" role="dialog" id="edit_package" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Edit Package</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                        <div id="package_edit_list">
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


	function get_manage_package_edit(edit_id)
	{
		$.ajax({
		type: "POST",
		url: "package/edit.php?edit_id="+edit_id,
		success: function(data) {
			$("#package_edit_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	function get_package_add(val)
	{
		$.ajax({
		type: "POST",
		url: "package/create.php?source="+val,
		success: function(data) {
			$("#package_add_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	</script>
