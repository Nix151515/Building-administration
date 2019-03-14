<?php
	session_start();
	require_once("dbconnect.php");
	 
	//  Verify that fields are not empty
	// echo $_GET['register_name'];
	
	if ($_GET['register_name'] != "" && $_GET['register_surname'] != "" && $_GET['register_password'] != '') 
	{
		// Take the form data
		$name = $_GET['register_name'];
		$surname = $_GET['register_surname'];
		// $password = md5($_GET['register_password']);
		$password = $_GET['register_password'];
		if($_GET['register_email'] != "")
			$email = $_GET['register_email'];
		else
			$email = '';
		
		
		// Build the query based on the data received
		$query = "INSERT INTO $table (name,surname,password,email) VALUES ('$name','$surname','$password','$email')";
		
		// Execute the query
		$result = mysqli_query($connect,$query);
		if(!$result)
			die ("Error inserting: ". mysqli_error($connect));
		else
		{
			echo '<p "style=color:green"> <i>New account created successfully</i></p>';
		}
	}
	else // Fields empty
	{
		'<p "style=color:red"> <i>Please complete all the required fields</i></p>';
	}
?>