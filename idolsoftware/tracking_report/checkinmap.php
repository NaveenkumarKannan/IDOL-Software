<?php
error_reporting(0);
ob_start();
session_start(); 
require_once("../model/config.inc.php"); 
require_once("../model/Database.class.php"); 
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db->connect(); 
?><html>

<head>

<title>Multiple Location Marker in One Google Map</title>
<!-- Mobile viewport optimized -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link media="all" type="text/css" href="assets/dashicons.css" rel="stylesheet">
<link media="all" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet">
<link rel='stylesheet' id='style-css'  href='../assets/css/style.css' type='text/css' media='all' />
<script type='text/javascript' src='../assets/js/jquery.js'></script>
<script type='text/javascript' src='../assets/js/jquery-migrate.js'></script>

<?php /* === GOOGLE MAP JAVASCRIPT NEEDED (JQUERY) ==== */ ?>
<!--<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>-->
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyDc-_6YG6XHoaWG0SUSRJSUXLPV-J9raSU"></script>
<!--<script 
    src="https://maps.googleapis.com/maps/api/js?v=3.33
        &key=AIzaSyCfFgqwWUKeQzolWvu50uy59ySf5f9f13Q">
</script>-->
<script type='text/javascript' src='../assets/js/gmaps.js'></script>

</head>

<body>
	<div id="container">

		<article class="entry">

		

			<div class="entry-content">

				<?php /* === THIS IS WHERE WE WILL ADD OUR MAP USING JS ==== */ ?>
				<div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map">
					<div id="google-map" class="google-map">
					</div><!-- #google-map -->
				</div>

				<?php /* === MAP DATA === */ ?>
			
 <?php /* === MAP DATA === */
                    $locations = array();

					$sql = "SELECT * FROM location_tracking where user_id='$_GET[person_name]' and date='$_GET[cur_date]'  order by location_tracking ASC";
					$rows = $db->fetch_all_array($sql);
					foreach($rows as $record)
					{
						
						$locations[] = array(
							'google_map' => array(
								'lat' => "$record[lattitude]",
								'lng' => "$record[longitude]",
							),
							
							
							'location_address'    => "$record[location_address]",
							'location_name'    => 'Loc C',
						);
					}
					/* === PRINT THE JAVASCRIPT === */
					/* Set Default Map Area Using First Location */
					$map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
					$map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
					?>

				<?php /* === PRINT THE JAVASCRIPT === */ ?>

				<?php
				/* Set Default Map Area Using First Location */
				$map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
				$map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
				?>

				<script>
				jQuery( document ).ready( function($) {

					/* Do not drag on mobile. */
					var is_touch_device = 'ontouchstart' in document.documentElement;

					var map = new GMaps({
						el: '#google-map',
						lat: '<?php echo $map_area_lat; ?>',
						lng: '<?php echo $map_area_lng; ?>',
						scrollwheel: false,
						draggable: ! is_touch_device
					});

					/* Map Bound */
					var bounds = [];

					<?php /* For Each Location Create a Marker. */
					foreach( $locations as $location ){
						$name = $location['location_name'];
						$addr = $location['location_address'];
						$map_lat = $location['google_map']['lat'];
						$map_lng = $location['google_map']['lng'];
						?>
						/* Set Bound Marker */
						var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
						bounds.push(latlng);
						/* Add Marker */
						map.addMarker({
							lat: <?php echo $map_lat; ?>,
							lng: <?php echo $map_lng; ?>,
							title: '<?php echo $name; ?>',
							infoWindow: {
								content: '<p><?php echo $name; ?></p>'
							}
						});
					<?php } //end foreach locations ?>

					/* Fit All Marker to map */
					map.fitLatLngBounds(bounds);

					/* Make Map Responsive */
					var $window = $(window);
					function mapWidth() {
						var size = $('.google-map-wrap').width();
						$('.google-map').css({width: size + 'px', height: (size/2) + 'px'});
					}
					mapWidth();
					$(window).resize(mapWidth);

				});
				</script>

				<div class="map-list">

				

				
				</div>

			</div><!-- .entry-content -->

		</article>

	</div><!-- #container -->

</body>

</html>
<script>
var lost_addresses = [];
    geocode_count  = 0;
    resNumber = 0;
    map = new GMaps({
       div: '#gmap_marker',
       lat: 43.921493,
       lng: 12.337646,
    });

function loadMarkerTimeout(timeout) {
    setTimeout(loadMarker, timeout)
}

function loadMarker() { 
    map.setZoom(6);         
    $.ajax({
            url: [Insert here your URL] ,
            type:'POST',
            data: {
                "action":   "loadMarker"
            },
            success:function(result){

                /***************************
                 * Assuming your ajax call
                 * return something like: 
                 *   array(
                 *      'status' => 'success',
                 *      'results'=> $resultsArray
                 *   );
                 **************************/

                var res=JSON.parse(result);
                if(res.status == 'success') {
                    resNumber = res.results.length;
                    //Call the geoCoder function
                    getGeoCodeFor(map, res.results);
                }
            }//success
    });//ajax
};//loadMarker()

$().ready(function(e) {
  loadMarker();
});

//Geocoder function
function getGeoCodeFor(maps, addresses) {
        $.each(addresses, function(i,e){                
                GMaps.geocode({
                    address: e.address,
                    callback: function(results, status) {
                            geocode_count++;        

                            if (status == 'OK') {       

                                //if the element is alreay in the array, remove it
                                lost_addresses = jQuery.grep(lost_addresses, function(value) {
                                    return value != e;
                                });


                                latlng = results[0].geometry.location;
                                map.addMarker({
                                        lat: latlng.lat(),
                                        lng: latlng.lng(),
                                        title: 'MyNewMarker',
                                    });//addMarker
                            } else if (status == 'ZERO_RESULTS') {
                                //alert('Sorry, no results found');
                            } else if(status == 'OVER_QUERY_LIMIT') {

                                //if the element is not in the losts_addresses array, add it! 
                                if( jQuery.inArray(e,lost_addresses) == -1) {
                                    lost_addresses.push(e);
                                }

                            } 

                            if(geocode_count == addresses.length) {
                                //set counter == 0 so it wont's stop next round
                                geocode_count = 0;

                                setTimeout(function() {
                                    getGeoCodeFor(maps, lost_addresses);
                                }, 2500);
                            }
                    }//callback
                });//GeoCode
        });//each
};//getGeoCodeFor()
</script>

