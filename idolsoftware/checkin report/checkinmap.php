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
//$locations[]=array( 'name'=>$_GET['place_nmae'], 'lat'=>$_GET['lattitude'], 'lng'=>$_GET['longitutde'], 'lnk'=>$_GET['location_address'] );
$return_arr = array();

$fetch = mysql_query("SELECT * FROM location_tracking"); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['title'] = 'Add';
    $row_array['lattitude'] = $row['lattitude'];
    $row_array['longitude'] = $row['longitude'];
	echo $row_array['location_address'] = "Erd";

    array_push($return_arr,$row_array);
}

echo $return_vlue= json_encode($return_arr);
?> 
 
  <!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAS-cPHerbFfjbo6CMEaI6TlSeJr0ujcY">
   </script> -->
   <script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyDc-_6YG6XHoaWG0SUSRJSUXLPV-J9raSU"></script>

    <div id="dvMap" style="width: 500px; height: 500px">
    </div>
    
     <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($return_vlue);$i++){ $j=$i+1;?>
        [
            'AMC Service',
            '<p><?php echo $locations[$i]['lnk'];?></p>',
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
    
    <div id="map-canvas" style="width:550px;height:450px;background:yellow"></div>