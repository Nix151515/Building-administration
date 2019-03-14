<?php
session_start();
require_once("dbconnect.php");
?>

<html>
	<head>
		<title>Register / Login</title>
	</head>
	<body>


								<!--  Register and login forms div  -->
		<div id="registerDiv">
			<form name="register_form" action="index.php" method="get">
				<fieldset>
					<legend>Create a new account:</legend>
					Name<br>
					<input type="text" name="register_name" id="register_name"/><br>
					Surname<br>
					<input type="text" name="register_surname" id="register_surname"/><br>
					Email (optional)<br>
					<input type="email" name="register_email" id="register_email"/><br>
					Password<br>
					<input type="password" name="register_password" id="register_password"/><br>
					<input type="button" name="register_btn" value="Register" onclick="register()"/>
					<input type="reset" value="Erase fields"> <br>
				</fieldset>
			</form>
			<br>

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
			</script>

			<div id="registerResp">
			</div>
			
			<!--  Login form  -->
			<form name="login_form" action="login.php" method="post">
				<fieldset>
					<legend>Login :</legend>
					Name<br>
					<input type="text" name="login_name" id="login_name" /><br>
<!-- 					Surname<br>
					<input type="text" name="login_surname" id="login_surname" /><br> -->
					Password<br>
					<input type="password" name="login_password" id="login_password"/><br>
					<input type="button" name="login_btn" value="Login" onclick="login()"/>
					<input type="reset" value="Erase fields"> <br>
				</fieldset>
			</form>

			<div id="loginResp">
			</div>
		</div>



		<script>

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
	</body>

</html>