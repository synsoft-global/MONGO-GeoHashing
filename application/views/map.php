<html>
<head>

<style>
body {
  font-family: sans-serif;
}
#map_canvas {
  position: absolute;
  width: 950px;
  height: 400px;
  top: 25px;
  left: 0px;
  border: 1px solid grey;
}
</style>
</head>
<body style="margin:0px; padding:0px;" onLoad="initialize()">
  <input type="hidden" id="pointerlimit" name="pointerlimit" value="0">
  <div id="map_canvas"></div>
  <!--<div id="listing"><table id="resultsTable"><tbody id="results"></tbody></table></div>-->
</body>
</html>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
  
	var map;
	var infoWindow = new google.maps.InfoWindow;
  
	function initialize() {
		var myLatlng = new google.maps.LatLng(48.870895, 2.779249);
		var myOptions = {
		  zoom: 2,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var pointerlimit = jQuery("#pointerlimit").val();
		showMarker(pointerlimit);
	}
	
	function showMarker(pointerlimit){
	var url= '<?php echo site_url('admin/getmarker'); ?>';

	jQuery.ajax({
		type:"POST",
		cache:false, 
		url:url,
		data:{plimit:pointerlimit}
		
	}).done(function(msg){
		var i=0;
		var results = jQuery.parseJSON(msg);
		//console.log(results.result);
		var obj = results.result;
		
		if(results.total){
		for(i=0;i<obj.length;i++){
			//console.log(obj[i].name);
			var html="<b>Name:</b>"+obj[i].name+"<br><b>Address:</b>"+obj[i].address+"<br><b>Latitude:</b>"+obj[i].lat+"<br><b>Longitude:</b>"+obj[i].lng+"<br><b>Geohash:</b>"+obj[i].geohashcode;
				var marker = new google.maps.Marker({
				position: new google.maps.LatLng(obj[i].lat, obj[i].lng),				
				map: map
				
				
			});
			
			bindInfoWindow(marker, map, infoWindow, html);
			
		}
		pointerlimit=parseInt(jQuery('#pointerlimit').val());
		pointerlimit=pointerlimit+1000;
		jQuery('#pointerlimit').val(pointerlimit);
		showMarker(pointerlimit);
		}
		else{
		 jQuery('#pointerlimit').val(0);
		}		
		
	});
	}
	function bindInfoWindow(marker, map, infoWindow, html) {

		google.maps.event.addListener(marker, 'click', function () {
			//If click on the marker we open associated infoWindow
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		});

		google.maps.event.addListener(map, 'click', function () {
			//If we click on the map the infowindow is closed
			infoWindow.close();
		});
	}
</script>
