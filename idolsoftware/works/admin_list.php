<?php
error_reporting(0);
ob_start();
session_start();
include("../model/config.inc.php"); 
include("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$ses_user_id= $_SESSION['sess_user_id'];
$ses_user_type= $_SESSION['ses_user_types'];
	$sql_count=mysql_num_rows(mysql_query("select * from assign_work"));
?>


<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td width="100%"  align="center"><a   href="javascript:sales_report_main_print('sales_report/sales_report_print_main.php?from_date=<?php echo $_POST['from_date']?>&to_date=<?php echo $_POST['to_date']?>&company_id=<?php echo $_POST['company_id']?>&customer_id=<?php echo $_POST['customer_id']?>');" style="float:right"><img  align="center" src="assets/img/print.png" width="35" height="35" border="0" title="PRINT" value="Print"/></a></td>
	</tr>
</table>-->
   <div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
                                        <th >S.no</th>
											<th >Date</th>
											<th>User Name</th>
											<th>Expense Name</th>
											<th>Expense Amount</th>
											<th>Description</th>
											
											<!--<th class="text-right">Action</th>-->
										</tr>
									</thead>
									<tbody>
                                    
										
										
									</tbody>
								</table>
                                
                                
							</div>
                            <div class="row staff-grid-row">
                   <table width="100%" align="center">
                             <?php 
					$sql="select * from assign_work";
					
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
                           
                               <td width="36%" align="left" >
								<h3 class="heading07" style="font-size:26px;"><a href="#" data-toggle="modal" onClick="get_manage_user_edit('<?php echo $record['sal_per_id']; ?>');" data-target="#edit_employee"><?php echo $record['work_title']; ?></a></h3>
								<div style="color:#ead8d8;"><?php echo $ass_emp['person_name']; ?>&nbsp; <?php echo $status; ?></div>
                                <div style="color:#ead8d8;"><?php echo date("d-m-Y",strtotime($record['deadline'])); ?>&nbsp; <?php echo ucfirst($record['priority']); ?></div>
								</td>
                                  
								 <td width="36%" align="right" style="padding-right:105px;">
								 
                                <button class="btn btn-success" type="button" id="delete" name="delete" onClick="delete_manage_users('<?php echo $record['sal_per_id']; ?>');" >Delete</button>
								</td>
							
                            </tr>
						</div>
                        <?php }   ?>
						
						
						
						
						
			
				</table>
						</div>
						
  