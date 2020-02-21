<?php
/**
 * Plugin Name: Distance between two points demo
 * Plugin URI: https://github.com/MattFales/distance_calc_demo_wordpress_plugin.git
 * Description: Calculations of distance between two points shortcode [distance-calc-demo]
 * Version: 1.0
 * Text Domain: distance-calc-demo
 * Author: Matthew Fales
 * Author URI: https://mfales.com
 */

 function distance_calc_demo($atts) {
	$Content = "<style>\r\n";
	$Content .= "h3.demoClass {\r\n";
	$Content .= "color: #26b158;\r\n";
	$Content .= "}\r\n";
	$Content .= "</style>\r\n";
	$Content .= '<h3 class="demoClass">Check it out!</h3>';

require_once('geoplugin.class.php');  //Third party API class https://www.geoplugin.com/webservices/php
$geoplugin = new geoPlugin();

//locate the IP
$geoplugin->locate();

	$city = $geoplugin->city;
	$state = $geoplugin->region;
	$country = $geoplugin->countryName;
	
	$city2 = "Washington, D.C.";
	$state2 = "District of Columbia";
	$country2 = "United States";
	
	$lat1 = $geoplugin->latitude;
	$lon1 = $geoplugin->longitude;
	$lat2 = 38.897957;             // Fixed location https://www.latlong.net/place/the-white-house-washington-dc-usa-20381.html
	$lon2 = -77.036560;
	
	$earthRadius_miles = 3959 ;          // miles
	$earthRadius_km = 6371 ;            // km
	$earthRadius_feet = (3959 * 5282) ; // feet
	$earthRadius_meter= (6371 *1000);   // meter
	
	$latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo = deg2rad($lat2);
    $lonTo = deg2rad($lon2);

	$latDelta = $latTo - $latFrom;
	$lonDelta = $lonTo - $lonFrom;

	$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
   
	$output_miles= $angle * $earthRadius_miles;
	$output_format_miles = number_format((float)$output_miles,2,'.','');
	
	$output_km= $angle * $earthRadius_km;
	$output_format_km = number_format((float)$output_km,2,'.','');
 
	$output_feet= $angle * $earthRadius_feet;
	$output_format_feet = number_format((float)$output_feet,2,'.','');
	
	$output_meter= $angle * $earthRadius_meter;
	$output_format_meter = number_format((float)$output_meter,2,'.','');	
?>	

<div class="col-sm-12" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:150%; text-align: center;"><b>How far from the Whitehouse am I?</b> </div>	
	<div class="col-sm-6" style="outline-style: solid; outline-color: red; outline-width: thin; font-size:125%;text-align: center;"><b>Start Location<b> 	
		<div class="col-sm-12" style="font-size:90%; text-align:left;">
			<b>Latitude:</b> <?php echo $lat1; ?> 
				<br>
			<b>Longitude:</b> <?php echo $lon1; ?>
				<br>
			<b>City:</b> <?php echo $city; ?> 
				<br>
			<b>State:</b> <?php echo $state; ?>
				<br>
			<b>Country:</b> <?php echo $country; ?>
		</div>
	</div>	
	<div class="col-sm-6" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:125%;text-align: center;"><b>End  Location<b> 		
		<div class="col-sm-12" style="font-size:90%;text-align: left;"> 
			<b>Latitude:</b> <?php echo $lat2; ?> 
				<br>
			<b>Longitude:</b> <?php echo $lon2; ?>
				<br>
			<b>City:</b> <?php echo $city2; ?> 
				<br>
			<b>State:</b> <?php echo $state2; ?>
				<br>
			<b>Country:</b> <?php echo $country2; ?>
		</div>
	</div>	

<div class="col-sm-12" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:125%;text-align: center;"><b>Total Distance<b> </div>	

<div class="col-sm-3" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:100%;">
	Miles
	<br>
	<?php echo $output_format_miles; ?>
</div>	

<div class="col-sm-3" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:100%;">
	KM
	<br>
	<?php echo $output_format_km; ?>
</div>	
<div class="col-sm-3" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:100%;">
	Feet
	<br>
	<?php echo $output_format_feet; ?>
</div>	
<div class="col-sm-3" style="outline-style: solid; outline-color: red; outline-width: thin;font-size:100%;">
	Meters
	<br>
<?php echo $output_format_meter; ?>
</div>	

  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/css/ol.css" type="text/css">
    <style>
      .map {
        height: 400px;
        width: 100%;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/build/ol.js"></script>
    <title>OpenLayers example</title>
  </head>
  <body>
    <h2>Map</h2>
    <div id="map" class="map"></div>
<script type="text/javascript">// https://openlayers.org/
var js_lat1 = "<?php echo $lat1; ?>";   // lat1 from php code above
var js_lon1 = "<?php echo $lon1; ?>";   // lon1 from php code above
	var map = new ol.Map({
	  target: 'map',
	  layers: [
		new ol.layer.Tile({
		  source: new ol.source.OSM()
		})
	  ],
	  view: new ol.View({
		center: ol.proj.fromLonLat([js_lon1, js_lat1]),
		zoom: 4
	  })
	});
	var coords = [
	  [js_lon1, js_lat1],
	  [-77.036560, 38.897957] // Fixed locations
	];
	var lineString = new ol.geom.LineString(coords);
	// transform to EPSG:3857
	lineString.transform('EPSG:4326', 'EPSG:3857');

	// create the feature
	var feature = new ol.Feature({
	  geometry: lineString,
	  name: 'Line'
	});
	var lineStyle = new ol.style.Style({
	  stroke: new ol.style.Stroke({
		color: '#ff0000',
		width: 6
	  })
	});

	var source = new ol.source.Vector({
	  features: [feature]
	});
	var vector = new ol.layer.Vector({
	  source: source,
	  style: [lineStyle]
	});
map.addLayer(vector);
    </script>
  </body>
	
<?php	
    return;
}
add_shortcode('distance-calc-demo', 'distance_calc_demo'); //Short code and call to the function
?>




  
   
   
   
   
   
   
   
   
   
   



