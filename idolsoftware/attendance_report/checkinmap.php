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
$url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$_GET['lattitude'].",".$_GET['longitutde']."&sensor=false";
  $json = @file_get_contents($url);
  $data = json_decode($json);
  $status = $data->status;
  $address = '';
  if($status == "OK")
  {
	 $address = $data->results[0]->formatted_address;
  }
  $locations[]=array( 'name'=>$_GET['person_name'], 'lat'=>$_GET['lattitude'], 'lng'=>$_GET['longitutde'], 'lnk'=>$_GET['start_time']."@".$address );

  // convert from degrees to radians
$degrees = rad2deg(acos((sin(deg2rad(11.342423))*sin(deg2rad(11.664325))) + (cos(deg2rad(11.342423))*cos(deg2rad(11.664325))*cos(deg2rad(77.693253-78.146011)))));
$unit="km";
 
	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)‎
	}
//	echo $distance;
?> 
 
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyDc-_6YG6XHoaWG0SUSRJSUXLPV-J9raSU"></script>
   </script> 

    <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
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
        zoom: 15,
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
    
    
    
    
    
