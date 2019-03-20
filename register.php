



<?php
	session_start();
	require_once("dbconnect.php");
	// error_reporting(E_ERROR | E_PARSE);
	 
	//  Verify that fields are not empty
	// echo $_GET['register_password'];
	
	if ($_GET['register_name'] != "" && $_GET['register_surname'] != "" && $_GET['register_password'] != '') 
	{
		// Take the form data
		$name = $_GET['register_name'];
		$surname = $_GET['register_surname'];
		// $password = md5($_GET['register_password']);
		$password = $_GET['register_password'];
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
		if($_GET['register_email'] != "")
			$email = $_GET['register_email'];
		else
			$email = '';
		
		
		// Build the query based on the data received
		$query = "INSERT INTO $table (name,surname,password,email,lat,lng) VALUES ('$name','$surname','$password','$email','$lat','$lng')";
		
		// Execute the query
		$result = mysqli_query($connect,$query);
		if(!$result)
		{
			echo '<p> <i>Error inserting</i></p>';
			die ("Error inserting: ". mysqli_error($connect));
		}
		else
		{
			echo '<p> <i>New account created successfully</i></p>';
		}
	}
	// Fields empty
	else 
	{
		echo '<p> <i>Please complete all the required fields</i></p>';
	}
?>
