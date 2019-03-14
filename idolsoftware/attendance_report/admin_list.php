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

   <div class="table-responsive" id="attendance_report_div">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
                                        <th >S.no</th>
											<th >Date</th>
											<th>User Name</th>
											<th>Start Time</th>
											<th>End Time</th>
											<th>Duration</th>
											
											<!--<th class="text-right">Action</th>-->
										</tr>
									</thead>
									<tbody>
                                     <?php 
									 $current_date=date('Y-m-d');
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$emp_id=$_POST['emp_id'];


if($from_date!=""){ $from_date1 = "att_date>='$from_date'";}else{$from_date1="att_date='$current_date'";}
if($to_date!=""){ $to_date1 = "att_date<='$to_date'";}else{$to_date1='';}
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
/*if($ses_user_id!='1')
{*/

	  $sql="select * from attendance where $get_query102 att_id!=''  order by att_id asc";
/*}
else
{
echo	 $sql="select * from attendance where $get_query102 att_id!='' order by att_id asc";
}*/

									
					
						$rows = $db->fetch_all_array($sql);
						foreach($rows as $record){
						$i=$i+1;
							$sal_pr_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$record[user_id]' "));
					//echo	"select * from user_creation where user_id='$record[user_id]' ";
						$sal_per_name=mysql_fetch_array(mysql_query("select * from sale_person_creation where sal_per_id='$sal_pr_id[insert_id]' "));
						$ass_user_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$record[user_id]'"));
						
				
if($ass_user_id[assign_user_id]==$ses_user_id)
{

					?>
										<tr>
                                        <td><?php echo $i; ?></td>
											<td>
												<!--<a href="profile.html" class="avatar">J</a>-->
												<?php echo date("d-m-Y",strtotime($record['att_date'])); ?>
											</td>
											<td><h2><?php echo $sal_per_name['person_name']; ?></h2></td>
											<td><?php echo date("H:i" ,strtotime($record['start_time'])); ?><img src="assets/img/loc.png" onClick="get_start_map('<?php echo $sal_per_name['person_name']; ?>','<?php echo $record['lattitude_start']; ?>','<?php echo $record['longitude_start']; ?>','<?php echo $record['start_time']; ?>')" height="25" width="30"/></td>
											<td><?php echo date("H:i" ,strtotime($record['end_time'])); ?><img src="assets/img/loc.png" onClick="get_end_map('<?php echo $sal_per_name['person_name']; ?>','<?php echo $record['lattitude_end']; ?>','<?php echo $record['longitude_end']; ?>','<?php echo $record['end_time']; ?>')" height="25" width="30"/></td>
											<td><?php echo date("H:i" ,strtotime($record['tot_work_time'])); ?></td>
											
											
										</tr>
										
										
										
										<?php } } ?>
										
										
									</tbody>
								</table>
							</div>
  <script>
function get_start_map(person_name,lattitude,longitutde,start_time)
{
var url="attendance_report/checkinmap.php?person_name="+person_name+"&lattitude="+lattitude+"&longitutde="+longitutde+"&start_time="+start_time;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}
function get_end_map(person_name,lattitude,longitutde,end_time)
{
var url="attendance_report/checkinmap.php?person_name="+person_name+"&lattitude="+lattitude+"&longitutde="+longitutde+"&start_time="+end_time;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}

</script>
