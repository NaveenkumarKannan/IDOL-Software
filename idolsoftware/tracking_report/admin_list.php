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


<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td width="100%"  align="center"><a   href="javascript:sales_report_main_print('sales_report/sales_report_print_main.php?from_date=<?php echo $_POST['from_date']?>&to_date=<?php echo $_POST['to_date']?>&company_id=<?php echo $_POST['company_id']?>&customer_id=<?php echo $_POST['customer_id']?>');" style="float:right"><img  align="center" src="image/report_print.png" width="35" height="35" border="0" title="PRINT" value="Print"/></a></td>
	</tr>
</table>-->

  <?php 

function get_distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if($lat1==0) { $lat1=$lat2; $lon1=$lon2; } else { $lat1=$lat1; $lon1=$lon1; }

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);


    $totmtr= $miles * 1.609344;
    return $totmtr;
  
}

	 $current_date=date('Y-m-d');
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$emp_id=$_POST['emp_id'];


if($from_date!=""){ $from_date1 = $from_date;}else{$from_date1=$current_date;}

if($emp_id!=""){ $emp_id1="user_id='$emp_id'";}else{$emp_id1='';}
  
$sal_per_id=mysql_fetch_array(mysql_query("select * from user_creation where user_id='$emp_id' "));
$sal_per_name=mysql_fetch_array(mysql_query("select * from sale_person_creation where sal_per_id='$sal_per_id[insert_id]' "));



$lat1=0;
$lon1=0;
$act_dist=0;
//echo "select * from location_tracking where date='$from_date' and user_id='$emp_id'  order by location_tracking asc ";
 $sql=mysql_query("select * from location_tracking where date='$from_date' and user_id='$emp_id'  order by location_tracking asc ");
//echo "select * from location_tracking where date='$from_date' and user_id='$emp_id'  order by location_tracking asc ";

while ($record=mysql_fetch_array($sql))
{
$i=$i+1;
$unit="km";
$lat2=$record['lattitude'];
$lon2=$record['longitude'];
$tot_dist=get_distance($lat1, $lon1, $lat2, $lon2, $unit);
$lat1=$lat2;
$lon1=$lon2;

$net_dist=$act_dist+$tot_dist;
$act_dist=$tot_dist;
}

	
?> 
					
	<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Date : <?php echo date('d-m-Y',strtotime($from_date1)); ?></label>
										
										</div>
									</div>
										<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Staff Name : <?php echo $sal_per_name['person_name']; ?></label>
										
										</div>
									</div>
									
										<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Total Km : <?php echo number_format($net_dist,2); ?><img src="assets/img/loc.png" onClick="get_start_map('<?php echo $emp_id; ?>','<?php echo $record['lattitude']; ?>','<?php echo $record['longitude']; ?>','<?php echo $from_date1; ?>')" height="25" width="30"/></label>
										
										</div>
									</div>
	</div>
	
	
									
								
  <script>
function get_start_map(person_name,lattitude,longitutde,cur_date)
{
var url="tracking_report/checkinmap.php?person_name="+person_name+"&lattitude="+lattitude+"&longitutde="+longitutde+"&cur_date="+cur_date;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}
function get_end_map(person_name,lattitude,longitutde,cur_date)
{
var url="tracking_report/checkinmap.php?person_name="+person_name+"&lattitude="+lattitude+"&longitutde="+longitutde+"&cur_date="+cur_date;
onmouseover= window.open(url,'','height=450,width=550,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');

}

</script>
