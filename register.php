



<?php
	session_start();
	require_once("dbconnect.php");
	include 'languages/lang_'.$_SESSION['lang'].'.php';

	/* 			If data sent correctly		*/
	if ($_GET['register_name'] != "" && $_GET['register_surname'] != "" && $_GET['register_password'] != '' && $_GET['register_room'] != "") 
	{
		/*			Take the form data 			*/
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
		$room = $_GET['register_room'];
		
		
		/*		 Build the query based on the data received   */
		$query = "INSERT INTO $table (name,surname,password,email,lat,lng,room) 
		VALUES ('$name','$surname','$password','$email','$lat','$lng', '$room')";
		
		/*		 Execute the query   */
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
	else 
	{
		echo '<p> <i>'.$lang['reqFields'].'</i></p>';
	}
?>
