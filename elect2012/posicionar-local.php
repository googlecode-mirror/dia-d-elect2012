<?php 
	include "aplicacao/boot.php";
	$sql = "SELECT hash_local,local FROM secao GROUP BY hash_local,local ORDER BY local"; 
	$lista = banco::listar($sql);
?>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(-3.7183943,-38.5433948);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 8,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<body>
  <style >
	  #mapCanvas {
	    width: 500px;
	    height: 400px;
	    float: left;
	  }
	  #infoPanel {
	    float: left;
	    margin-left: 10px;
	  }
	  #infoPanel div {
	    margin-bottom: 5px;
	  }
  </style>
  
  <div id="mapCanvas"></div>
  <div id="infoPanel">
    <b>Status:</b>
    <div id="markerStatus"><i>clique e arraste o pin.</i></div>
    <b>Posição:</b>
    <div id="info"></div>
    <b>Endereço mais próximo:</b>
    <div id="address"></div>
    <form method="POST" >
    	 <select name="local" id="local">
	    	<?php 
	    		foreach($lista as $item){
					print "<option value='".$item->hash_local."'>".$item->local."</option>";
				}
	    	?>
	    </select>
	    <input type="submit" value="Alterar"/>
    </form>
   
  </div>
</body>
</html>
