<?php
	// require_once("langs.php");
	
	session_start();
	// echo $_SESSION['lang'];
	include 'languages/lang_'.$_SESSION['lang'].'.php';
?>

 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Main Page</title>
	</head>
	<body>

<!-- 		<ul>
		  <li><a class="active" href="#home">Home</a></li>
		  <li><a href="#news">News</a></li>
		  <li><a href="#contact">Contact</a></li>
		  <li><a href="#about">About</a></li>
		</ul> -->
	</body>
</html>


<?php

	session_start();
	require_once("dbconnect.php");
	$name = $_SESSION['name'];

	if(isset($_COOKIE[$name]))
	{
		$lastVisit = $_COOKIE[$name]; 
		setcookie($name, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
		echo "<h3>Hello $name, welcome back !<br>
					Your last login : $lastVisit</h3>";
	}
	else
	{
		setcookie($name, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
		echo "<h3>Welcome to the platform, $name ! <br></h3>";
	}

	echo "<h3> Here are the users and their last connection status: </h3>";
	$sql = "SELECT id,name, login, lat, lng FROM utilizatori;";	
	$result = mysqli_query($connect,$sql);
	if($result)
	{
		echo "<div id='users'>";
		while($out = mysqli_fetch_assoc($result))
		{
			echo 
			"<div class='user'>".
			// "<img src='https://upload.wikimedia.org/wikipedia/commons/1/12/User_icon_2.svg'></img>".
			"<img class='icon' src='pictures/Bullet-ambar.png'></img>".
			"<span>".$out["name"]."</span>".
			"<input type='button' value="."'".$lang['userInfo']."'"." class='showUser' onclick=showInfo(".$out['id'].")><br>".
			"</div>";
		}
		echo "</div>";
	}
	else {
		echo "<p> Error fetching users </p>";
	}

 ?>