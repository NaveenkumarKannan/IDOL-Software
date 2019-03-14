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
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Manage Company</h4>
						</div>
						<div class="col-xs-8 text-right m-b-20">
							<a href="#" class="btn btn-primary rounded pull-right" onClick="get_manage_company_add('add');" data-toggle="modal" data-target="#add_company"><i class="fa fa-plus"></i> Add Company</a>
							
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
$sql_cunt=mysql_num_rows(mysql_query("select * from manage_companys"));

?>
<?php  if($sql_cunt!=0) {?>
<div class="row staff-grid-row">
 <table width="100%" align="center">
                    <?php 
					$sql="select * from manage_companys ";
					
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
						//	$check_in_count=mysql_num_rows(mysql_query("select * from check_in where person_id='$record[sal_per_id]'"));
					?>

            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-12">
        
                                <tr class="profile-widget">
                            <td width="28%" align="left">
									<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_company_edit('<?php echo $record['company_id']; ?>');" data-target="#edit_company"><?php echo $record['company_name']; ?></a></h3>
								</td>
                               <td width="30%" align="left" >
							
								<div style="color:#ead8d8;"><?php echo $record['designation']; ?>&nbsp; <?php echo $status; ?></div>
                                
								</td>
								  <td width="23%" align="left" >
							
							
                                <div style="color:#ead8d8;"><?php echo $record['phone_no']; ?>&nbsp; <?php echo $record['email']; ?></div>
								</td>
                                  
								 <td width="19%" align="right">
								<!-- <button class="btn btn-primary" type="button" id="add" name="add">Assign Work</button>-->
                                <button class="btn btn-success" type="button" id="delete" name="delete" onClick="delete_comapany('<?php echo $record['company_id']; ?>');" >Delete</button>
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
									
                                   No Companies Available
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
			
            <div class="modal custom-modal fade" role="dialog" id="add_company" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
						<h4 class="modal-title">Add Company</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                
                                                       <div id="company_add_list">
                                                            <?php include("create.php");?>
                                                     
                                               
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
            <div class="modal custom-modal fade" role="dialog" id="edit_company" tabindex="" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
						<h4 class="modal-title">Edit Company</h4>
						</div>
                                        <div class="modal-body">
                                            
                                                 <div id="company_edit_list">
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

function get_manage_company_edit(edit_id)
	{
		$.ajax({
		type: "POST",
		url: "companys/edit.php?edit_id="+edit_id,
		success: function(data) {
			$("#company_edit_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	function get_manage_company_add(val)
	{alert();
		$.ajax({
		type: "POST",
		url: "companys/create.php?source="+val,
		success: function(data) {
			$("#company_add_list").html(data);				
		},
		error: function() {
			alert('error handing here');
		}
	});
	}
	</script>