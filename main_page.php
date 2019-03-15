
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
	$sql = "SELECT id,name, login, lat, lng FROM users;";	
	$result = mysqli_query($connect,$sql);
	if($result) {
		while($out = mysqli_fetch_assoc($result))
		{
			echo $out["name"]. ", ".
				 $out["login"].", ".
				 $out["lat"].", ".
				 $out["lng"];
			echo "<input type='button' value='User Info' onclick=showInfo(".$out['id'].")><br>";
		}
	}
	else {
		echo "<p> Error fetching users </p>";
	}

 ?>

 <!DOCTYPE html>
<html lang="en">
	<head>
		<script>

		</script>
		<meta charset="utf-8"/>
		<title>Main Page</title>
	</head>
	<body>

	</body>
</html>


