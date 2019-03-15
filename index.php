<?php
session_start();
require_once("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Register / Login</title>

		<script>
			function register() {
					var xmlhttp = new XMLHttpRequest();
					var name = document.getElementById("register_name").value;
					var surname = document.getElementById("register_surname").value;
					var password = document.getElementById("register_password").value;
					var email = document.getElementById("register_email").value;
					console.log(name,surname,password, email);

			        xmlhttp.onreadystatechange = function() {
			            if (this.readyState == 4 && this.status == 200) {
			                document.getElementById("registerResp").innerHTML = this.responseText;
			            }
			        };
			        xmlhttp.open("GET", "register.php?register_name="+name+
			        	"&register_surname="+surname+
			        	"&register_password="+password+
			        	"&register_email="+email
			        	, true);
			        xmlhttp.send();
				}


			function login() {
				var xmlhttp = new XMLHttpRequest();
				var name = document.getElementById("login_name").value;
				var password = document.getElementById("login_password").value;
				console.log(name,password);

			    xmlhttp.onreadystatechange = function() {
			        if (this.readyState == 4 && this.status == 200) {
			        	// console.log(this.responseText);
			            document.getElementById("loginResp").innerHTML = this.responseText;

			            console.log(this.responseText);
					    if(this.responseText.includes("Authentication succesful"))
					    	loadMainPage();
			        }
			    };
			    xmlhttp.open("GET", "login.php?login_name="+name+
			        "&login_password="+password
			        , true);
			    xmlhttp.send();
			}


			function loadMainPage() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			      document.getElementById("registerDiv").innerHTML =
			      this.responseText;
			    }
			  };
			  xhttp.open("GET", "main_page.php", true);
			  xhttp.send();
			}


		</script>

		
	</head>




	<body>


		<div id="googleMap" style="width:100%;height:400px;"></div>
		<script>
			var lat = 44;
			var long = 26;
			function myMap() {

				var user = "Gigi";

				var marker = new google.maps.Marker({
				  position: new google.maps.LatLng(lat, long)
				});

				var mapProp= {
				  center:new google.maps.LatLng(lat, long),
				  zoom:5
				};
				var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

				var infowindow = new google.maps.InfoWindow({
				  content:`User: ${user}`
				});

				google.maps.event.addListener(marker,'click',function() {
					infowindow.open(map,marker);
					map.setZoom(9);
					map.setCenter(marker.getPosition());
				});

				marker.setMap(map);
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVn9-H4vxfuCzjxfr0hb5dvMBJ07iaccU&callback=myMap"></script>

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