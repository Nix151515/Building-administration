<?php
session_start();
require_once("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Register / Login</title>
		<script src="scripts.js"></script>	
	</head>



	<body>

								




								<!--  Register and login forms div  -->
		<div id="registerDiv" >
			<h1 style="font-size:200%;color:Grey;text-align:center;font-family:verdana">Register/Login</h1>
			<form name="register_form" action="index.php" method="get">
				<fieldset style="width:50%;margin: 0 auto;">
					<legend>Create a new account:</legend>
					Name<br>
					<input type="text" name="register_name" id="register_name"/><br><br>
					Surname<br>
					<input type="text" name="register_surname" id="register_surname"/><br><br>
					Email (optional)<br>
					<input type="email" name="register_email" id="register_email"/><br><br>
					Password<br>
					<input type="password" name="register_password" id="register_password"/><br><br>

							<!-- Google Map elements -->

					<div id="mapDiv">
						Address<br>
						<input id="address" type="textbox" value="Regie, Bucuresti">
						<input type="button" value="Check address" onclick="codeAddress()">
						<div id="googleMap"></div><br>
						<p id="latitude" value="ASD" hidden> ASD</p><br>
						<p type="text" id="longitude" value="ASD" hidden> ASD</p>
						<p type="text" id="err"></p>
			    	</div>
					<script src="https://maps.googleapis.com/maps/api/js?key=<API_KEY>"></script>



					<input type="button" name="register_btn" value="Register" onclick="register()"/>
					<input type="reset" value="Erase fields"> <br>

					<div id="registerResp">
					</div>
				</fieldset>
			</form>
			<br>
			
			<!--  Login form  -->
			<form name="login_form" action="login.php" method="post">
				<fieldset style="width:50%;margin: 0 auto;">
					<legend>Login :</legend>
					Name<br>
					<input type="text" name="login_name" id="login_name" /><br><br>
					Password<br>
					<input type="password" name="login_password" id="login_password"/><br><br>
					<input type="button" name="login_btn" value="Login" onclick="login()"/>
					<input type="reset" value="Erase fields"> <br>
					<div id="loginResp">
					</div>
				</fieldset>
			</form>
		</div>



	</body>

</html>

<script type="text/javascript">
	// function myMap() {
			// 	var lat = 44;
			// 	var long = 26;
			// 	var user = "Gigi";

			// 	var marker = new google.maps.Marker({
			// 	  position: new google.maps.LatLng(lat, long)
			// 	});

			// 	var mapProp= {
			// 	  center:new google.maps.LatLng(lat, long),
			// 	  zoom:5
			// 	};
			// 	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

			// 	var infowindow = new google.maps.InfoWindow({
			// 	  content:`User: ${user}`
			// 	});

			// 	google.maps.event.addListener(marker,'click',function() {
			// 		infowindow.open(map,marker);
			// 		map.setZoom(9);
			// 		map.setCenter(marker.getPosition());
			// 	});

			// 	marker.setMap(map);
			// }
</script>
