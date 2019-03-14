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

   <div class="table-responsive" id="">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
                                        <th width="4%" >S.no</th>
											<th width="15%" ><div align="left">Date</div></th>
											<th width="37%"><div align="left">Employee Name</div></th>
											<th width="44%"><div align="left">Location Address</div></th>
											
											
											<!--<th class="text-right">Action</th>-->
										</tr>
									</thead>
									<tbody>
                                     <?php 
									 $current_date=date('Y-m-d');
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$emp_id=$_POST['emp_id'];


if($from_date!=""){ $from_date1 = "check_in_date>='$from_date'";}else{$from_date1="check_in_date='$current_date'";}
if($to_date!=""){ $to_date1 = "check_in_date<='$to_date'";}else{$to_date1='';}
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

	 $sql="select * from check_in where $get_query102 check_in_id!='' and assign_user_id='$ses_user_id' order by check_in_id asc";
}
else
{
	 $sql="select * from check_in where $get_query102 check_in_id!='' order by check_in_id asc";
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
											
												<?php echo date("d-m-Y",strtotime($record['check_in_date'])); ?>
											</td>
											<td><h2><?php echo $sal_per_name['person_name']; ?></h2></td>
											<td><h2><?php echo $record['location_address']; ?></h2><img src="assets/img/loc.png" onClick="get_checkin_map('<?php echo $record['place_work_name']; ?>','<?php echo $record['lattitude']; ?>','<?php echo $record['longitutde']; ?>','<?php echo "asd"; ?>')" height="25" width="30"/></td>
		 						
											
											
										</tr>
										
										
										
										<?php   
 }
										
										 ?>
										
										
									</tbody>
								</table>
							</div>
<script>
function get_checkin_map(place_nmae,lattitude,longitutde,location_address)
{
var url="checkin report/checkinmap_crct.php?place_nmae="+place_nmae+"&lattitude="+lattitude+"&longitutde="+longitutde+"&location_address="+location_address;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}

</script></body>
</html>