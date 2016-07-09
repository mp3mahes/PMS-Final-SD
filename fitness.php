<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$catArray = $db_handle->runQuery("SELECT category FROM categories WHERE type='Fitness'");
$i = 0;
foreach ($catArray as $key=>$value)
{
	$jsArray[$i] = $catArray[$key]['category'];
	$i++;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" id="themestyle" href="jQueryTourPlugin/css/theme1/style.css">
<script src="jQueryTourPlugin/js/jquery-1.9.1.min.js"></script>
<script src="jQueryTourPlugin/js/jTour.min.js"></script>


	
		<!-- <link rel="stylesheet" type="text/css" href=".css" > -->
	    
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script>
			var northEast;
	var southWest;
	var markers = [];
	var geocoder; 
	var map2;
	var listings = [];
	
	function initialize2() 
	{
		var mapCanvas2 = document.getElementById('map2');
		geocoder = new google.maps.Geocoder();
		var mapOptions2 = {
		  center: new google.maps.LatLng(32.815869, -96.84492499999999),
		  zoom: 12,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map2 = new google.maps.Map(mapCanvas2, mapOptions2)
		google.maps.event.addDomListener(map2, 'bounds_changed', function() {setBoundingBox(map2.getBounds());});
	}
		google.maps.event.addDomListener(window, 'load', initialize2);

	
	function move () 
	{
		clearMarkers();
		var zipCode = document.getElementById("search").value;
		geocoder.geocode( { 'address': zipCode}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{
			//Got result, center the map and put it out there
			map2.setCenter(results[0].geometry.location);
			setBoundingBox(map2.getBounds(), function () {sendRequest();});
		} 
		else 
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
		});
	}
	
	function sendRequest()
	{
		var catArray = <?php echo json_encode($jsArray); ?>;
		for (var i = 0; i < catArray.length; i++)
		{
			var url = "proxy.php?term=" + catArray[i] + "&bounds=" + southWest + "|" + northEast + "&limit=5"
			var xhr = new XMLHttpRequest();
			xhr.open("GET", url);
			xhr.setRequestHeader("Accept","application/json");
			xhr.onreadystatechange = function () {
				if (this.readyState == 4) {
				try{
					var json = JSON.parse(this.responseText);
					}
				catch (e)
				{
				alert(e);
				}
					var str = JSON.stringify(json,undefined,2);
					generateList(json);
				}
			};
			xhr.send(null);
		}
	}
		
	function setBoundingBox(bounds, callback)
	{
		northEast = bounds.getNorthEast().toString();
		northEast = northEast.replace(/[( )]/g, '');
		southWest = bounds.getSouthWest().toString();
		southWest = southWest.replace(/[( )]/g, '');
		callback();
	}	
	
	function generateList(json)
	{
		for (var x = 0; x < json.businesses.length; x++)
		{
			if (!(listings.indexOf(json.businesses[x].location.address) > -1 ))
			{
			listings.push(json.businesses[x].location.address);
			addMarkers(json.businesses[x].location.coordinate.latitude, json.businesses[x].location.coordinate.longitude, json.businesses[x].name, json.businesses[x].location.address, json.businesses[x].phone);
			}
		}

	}
	
	function addMarkers(lattitude, longitude, name, address, phone)
	{
		var number = markers.length + 1;
		var attributes = [];
		var table = document.getElementById("results");
		var myLatLng = {lat: lattitude, lng: longitude};
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map2,
			title: name,
			icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + number +'|FF0000|000000' 
		});
		markers.push(marker);
		attributes[0] = number;
		attributes[1] = name;
		attributes[2] = address;
		attributes[3] = phone;
		var tr = document.createElement('TR');
		tr.style.color="white";
		table.appendChild(tr);
		for (var j=0; j<4; j++)
		{
			var td = document.createElement('TD');
			td.appendChild(document.createTextNode(attributes[j]));
			tr.appendChild(td);
		}
	}

	function clearMarkers() 
	{
		for (var x = 0; x < markers.length; x++) 
		{
			markers[x].setMap(null);
		}
		markers = [];
		var elmtTable = document.getElementById('results');
		var tableRows = elmtTable.getElementsByTagName('tr');
		var rowCount = tableRows.length;

		for (var x=rowCount-1; x>0; x--) 
		{
		   elmtTable.removeChild(tableRows[x]);
		}
	}
		
		</script>
	
	<body>
		<div id="header-wrapper-fitness">
	<div id="header-pages" class="container">
		<div id="logo">
			<h1><a href="#">Fitness</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.html" accesskey="1" title="">Home</a></li>
				<li><a href="#" id="starttour" accesskey="2" title="">Help</a></li>
				<li><a href="contact.html" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
	</div>
<br>
<br>
<div id = "outmap">
	<h1 style="color:white">  Fitness Centers Near You </h1>
</div>
<div style="width: 100%; overflow: auto;">
	<div id="map2" style="float: left;" class="map-help">
	</div>
	<div style="float:left; height:100%; overflow: auto" width="100%">
		<table id = "results" cellspacing="5" cellpadding="0" border="1" width="100%" style="overflow:auto;">
         <tr style="color:white;background-color:grey">
            <th>Number</th>
            <th>Name</th>
			<th>Address</th>
            <th>Phone</th>
         </tr>
</table>
	</div>
</div>
		<br>
		<div id = "belowmap">
			<h4>
		<form onkeypress="return event.keyCode != 13">

			<label>Enter the Zipcode: <input type = "text" id="search"/></label>
			<input type = "button" id="search_button" onclick="move();" value = "Search"/>
		</form>
		
	</h4>
	</div>

</div>

	<div id="wrapper">
	<div id="staff" class="container">
		<div class="title">
	
		
	<!--	<div class="links">
			<a href="video.php"><img src="images/videos.png" height="200" width="200" align = "middle" alt="fitness"  margin-left: "100"/></a>
			<a href="reading.html"><img src="images/readings.png" height="200" width="200" align = "middle" alt="fitness" /></a>
			<a href="index.html"><img src="images/back.png" height="200" width="200" align = "right" alt="fitness" /></a>
		</div>

	-->
	<span><h3><center>&nbsp;&nbsp;&nbsp;&nbsp;Click below to explore more </h3></span> </div>
		<div class="tbox1"><td><a href="readings.php?language=english&type=exercise"><img src="images/readings.png" width="250" height="250" alt="" /></a></td></div>
		<div class="tbox2"><td><a href="video.php?language=english&type=exercise"><img src="images/videos.png" width="250" height="250" alt="" />  </a></td></div>
<script>
$(document).ready(function() {

	var tourdata = [
		{
			html: "Place your cursor over this box at anytime to control the interactive help."
		},{
			html: "Enter your zipcode here.",
			element: $("#search"),
			overlayOpacity: 0.8,
			expose: true,
			position: 's'
		},{
			html: "Then click this button...",
			element: $("#search_button"),
			overlayOpacity: 0.8,
			expose: true,
			position: 's'
		},{
			html: "and all the nearby gyms, parks, and trails will be displayed here.",
			element: $("#map2"),
			overlayOpacity: 0.8,
			expose: true,
			position: 'n'
		},{
			html: "Click here for readings.",
			element: $(".tbox1"),
			overlayOpacity: 0.8,
			expose: true,
			position: 'n'
		},{
			html: "Click here for videos.",
			element: $(".tbox2"),
			overlayOpacity: 0.8,
			expose: true,
			position: 'n'
		}
	];
	
	var myTour = jTour(tourdata,{
		axis:'y', // use only one axis prevent flickring on iOS devices
		onStop:function(){
		},
		onChange:function(current){
		},
		onFinish:function(current){
		}
	} 
	);
	
	//myTour.start();
	
	
	//the Button
	$('#starttour').click(function(){
		myTour.restart();
	});
	
});
</script>
	</body>
</html>