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

?>
<script>$(document).ready(function() {
    $('#example').DataTable();
} );</script>

<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td width="100%"  align="center"><a   href="javascript:sales_report_main_print('sales_report/sales_report_print_main.php?from_date=<?php echo $_POST['from_date']?>&to_date=<?php echo $_POST['to_date']?>&company_id=<?php echo $_POST['company_id']?>&customer_id=<?php echo $_POST['customer_id']?>');" style="float:right"><img  align="center" src="image/report_print.png" width="35" height="35" border="0" title="PRINT" value="Print"/></a></td>
	</tr>
</table>-->

   <div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
                                        <th width="5%" ><div align="left">S.no</div></th>
											<th width="24%" ><div align="left">Date</div></th>
											<th width="28%"><div align="left">Employee Name</div></th>
											<th width="25%"><div align="left">Company Name</div></th>
											<th width="18%" align="right"><div align="right">Collect.Amount</div></th>
										 <!--	<th width="20%"><div align="left">Details</div></th>
											
										 <th class="text-right">Action</th>-->
										</tr>
									</thead>
									<tbody>
                                     <?php 
									 $current_date=date('Y-m-d');
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$emp_id=$_POST['emp_id'];


if($from_date!=""){ $from_date1 = "collection_date>='$from_date'";}else{$from_date1="collection_date='$current_date'";}
if($to_date!=""){ $to_date1 = "collection_date<='$to_date'";}else{$to_date1='';}
if($emp_id!=""){ $emp_id1="user_id='$emp_id'";}else{$emp_id1='';}


$all_value102 = $from_date1.",".$to_date1.",".$emp_id1;
$all_array102 = explode(',',$all_value102);
foreach($all_array102 as $value102)
{ 
	if($value102!='')
	{
		$get_query102 .= $value102." AND ";
	}
}		
if($ses_user_id!='1')
{
	
	$sql="select * from collection_details where $get_query102 collection_id!='' and assign_user_id='$ses_user_id' order by collection_id asc";
}
else
{
	$sql="select * from collection_details where $get_query102 collection_id!='' order by collection_id asc";
}
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
						$i=$i+1;
							$sal_pr_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$record[user_id]' "));
						
						$sal_per_name=mysql_fetch_array(mysql_query("select * from sale_person_creation where sal_per_id='$sal_pr_id[insert_id]' "));

					?>
										<tr>
                                        <td><?php echo $i; ?></td>
											<td>
												<!--<a href="profile.html" class="avatar">J</a>-->
												<?php echo date("d-m-Y",strtotime($record['collection_date'])); ?>
											</td>
											<td><h2><?php echo $sal_per_name['person_name']; ?></h2></td>
											<td><?php echo $record['collect_company_name']; ?></td>
											<td align="right"><?php echo number_format($record['collection_amount'],2); ?></td>
											<!--<td><?php echo $record['collet_details']; ?></td>
											
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>-->
										</tr>

										
										
										
										<?php } ?>
										
										
									</tbody>
								</table>
							</div>
  