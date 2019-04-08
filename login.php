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
			echo '<p> <i>Incorrect data</i></p>';
		} 
		else
		{
			// Save the credentials in session variables for further use
			$_SESSION['name'] = $name;
			$_SESSION['password'] = $password;

			$sql = "SELECT id FROM $table WHERE name = ". "'$name'".  "AND password =". "'$password'"  ." ;";	
			$result = mysqli_query($connect,$sql);

			if($result) 
				$out = mysqli_fetch_assoc($result);
			else 
				echo "<p> Nasoleo (User ID not found) </p>";


			$_SESSION['id'] = $out["id"];
			$id = $_SESSION['id'];


			$sql ="UPDATE $table SET login = SYSDATE() WHERE id = "."'$id'". ";";
			$result = mysqli_query($connect,$sql);
			
			if($result) {
				echo '<p> <i>Update succesful</i></p>';
			} else {
				echo '<p> <i>Update failed </i></p>';
			}
	 		
			// Success message
			if($name == 'admin')     
				echo '<p> <i>Authentication succesful, admin</i></p>';
			else
				echo '<p> <i>Authentication succesful, user</i></p>';


		}
	}
	else
	{
		echo '<p> <i>'.$lang['reqFields'].'</i></p>';
	}
?>

