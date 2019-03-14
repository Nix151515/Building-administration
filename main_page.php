
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
		echo "<h3>Welcome, $name ! <br></h3>";
	}
	
 ?>
 <html>
	<body>




	</body>
</html>


