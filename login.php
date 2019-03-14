<?php
	session_start();
	require_once("dbconnect.php");
	
	//  Verify that fields are not empty
	if ($_GET['login_name'] != "" && $_GET['login_password'] != '') 
	{
		// Take the form data
		$name = $_GET['login_name'];
		// $password = md5($_POST['login_password']);
		$password = $_GET['login_password'];
 
		// Build the select query
		$query = "SELECT * FROM $table WHERE `name` = '".$name."' AND `Password` = '".$password."'";
		
		//Execute the query
		$result = mysqli_query($connect,$query);
 
		// Check if the query executed successfully
		if (!$result || mysqli_num_rows($result) < 1)
		{
			echo '<p "style=color:red"> <i>Incorrect data</i></p>';
		} 
		else
		{
			// Save the credentials in session variables for further use
			$_SESSION['name'] = $name;
			$_SESSION['password'] = $password;
	 
			// Success message     
			echo '<p "style=color:green"> <i>Authentication succesful</i></p>';
			// Set a cookie with the last time visit or display it if exists
			// if(isset($_COOKIE[$username]))
			// {
			// 	$lastVisit = $_COOKIE[$username]; 
			// 	setcookie($username, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
			// 	echo "<h1>Hello $username, welcome back !<br>
			// 				Your last login : $lastVisit</h1>";
			// }
			// else
			// {
			// 	setcookie($username, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
			// 	echo "<h1>Welcome, $username ! <br></h1>";
			// }
		}
	}
	else
	{
		echo '<p "style=color:red"> <i>Please complete all the fields </i></p>';
	}
?>
