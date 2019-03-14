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

   <div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
                                        <th >S.no</th>
											<th >Date</th>
											<th>Employee Name</th>
											<th>Start Time</th>
											
											
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
											<td>
<div id="map-canvas" style="width:400px;height:400px;background:yellow"></div>


</td>
		 						
											
											
										</tr>
										
										
										
										<?php    $locations[]=array( 'name'=>$record['place_work_name'], 'lat'=>$record['lattitude'], 'lng'=>$record['longitutde'], 'lnk'=>$record['location_address'] );
 }print_r($locations);
										
										 ?>
										
										
									</tbody>
								</table>
							</div>
                             <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDSiq1Xf-Tl5jGQzg-9HPxNnHd736Jof2s"></script> 

    <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
        [
            'AMC Service',
            '<p><?php echo $locations[0]['lnk'];?></p>',
            <?php echo $locations[$i]['lat'];?>,
            <?php echo $locations[$i]['lng'];?>,
            0
        ]<?php if($j!=sizeof($locations))echo ","; }?>
    ];
	
    var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

    function initialize() {
      var mapOptions = {
        zoom: 14,
        center: origin
      };

      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        infowindow = new google.maps.InfoWindow();

        for(i=0; i<locations.length; i++) {
            var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
			
            var marker = new google.maps.Marker({
                position: position,
                map: map,
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][1]);
                    infowindow.setOptions({maxWidth: 200});
                    infowindow.open(map, marker);
                }
            }) (marker, i));
            Markers[locations[i][4]] = marker;
        }

        locate(0);

    }

    function locate(marker_id) {
        var myMarker = Markers[marker_id];
        var markerPosition = myMarker.getPosition();
        map.setCenter(markerPosition);
        google.maps.event.trigger(myMarker, 'click');
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    </script> 
ac