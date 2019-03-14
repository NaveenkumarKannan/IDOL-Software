

?>
<?php
error_reporting(0);
ob_start();
session_start(); 
require_once("model/config.inc.php"); 
require_once("model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
$query = "SELECT * FROM location_tracking where usser_id='3'";
$countryResult = mysql_query($query);

?>
<html>
<head>
<title>Show Path on Google Map using Javascript API</title>
<style>
body {
	font-family: Arial;
}

#map-layer {
	margin: 20px 0px;
	max-width: 600px;
	min-height: 400;
}
</style>
</head>
<body>
	<h1>Show Path on Google Map using Javascript API</h1>
	<div id="map-layer"></div>
	<script>
      	var map;
		var pathCoordinates = Array();
      	function initMap() {
        	  	var countryLength
            	var mapLayer = document.getElementById("map-layer"); 
            	var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
        		var defaultOptions = { center: centerCoordinates, zoom: 4 }
        		map = new google.maps.Map(mapLayer, defaultOptions);
        		geocoder = new google.maps.Geocoder();
        	    <?php
           
            ?>
            countryLength = <?php echo mysql_num_rows($countryResult); ?>
			
            <?php
                foreach ($countryResult as $k => $v) 
                {
            ?>  
             	geocoder.geocode( { 'address': '<?php echo $countryResult[$k]["location_address"]; ?>' }, function(LocationResult, status) {
        				if (status == google.maps.GeocoderStatus.OK) {
        					var latitude = LocationResult[0].geometry.location.lat();
        					var longitude = LocationResult[0].geometry.location.lng();
        					pathCoordinates.push({lat: latitude, lng: longitude});
        					
    						new google.maps.Marker({
                    	        position: new google.maps.LatLng(latitude, longitude),
                    	        map: map,
                    	        title: '<?php echo $countryResult[$k]["location_address"]; ?>'
                    	    });
                    	    
        					if(countryLength == pathCoordinates.length) {
            					drawPath();
        					}
        			        
        				} 
        			});
        	    <?php
                }
            
            ?>	
      	}
        	function drawPath() {
            	new google.maps.Polyline({
                  path: pathCoordinates,
                  geodesic: true,
                  strokeColor: '#FF0000',
                  strokeOpacity: 1,
                  strokeWeight: 4,
                  map: map
            });
        }
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSiq1Xf-Tl5jGQzg-9HPxNnHd736Jof2s&callback=initMap">
    </script>
</body>
</html>