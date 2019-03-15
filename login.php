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

			$sql = "SELECT id FROM users WHERE name = ". "'$name'".  "AND password =". "'$password'"  ." ;";	
			$result = mysqli_query($connect,$sql);
			if($result) {
				$out = mysqli_fetch_assoc($result);
				

				// LA FEL CA FETCH ROW DAR INTOARCE ARRAY ASOCIATIV, NU NUMERIC
				// $out = mysqli_fetch_assoc($result);
				// echo $out["id"];

				// FETCH ROW INTOARCE UN ARRAY CU CAMPURILE REZULTATULUI (Doar 1)
				// $out = mysqli_fetch_row($result);
				// echo $out[0];

				// PENTRU MAI MULTE REZULTATE
				// while($out = mysqli_fetch_assoc($result))
			}
			else {
				echo "<p> Nasoleo (User ID not found) </p>";
			}

			$_SESSION['id'] = $out["id"];
			$id = $_SESSION['id'];


			$sql ="UPDATE users SET login = SYSDATE() WHERE id = "."'$id'". ";";
			$result = mysqli_query($connect,$sql);
			if($result) {
				echo '<p "style=color:green"> <i>Update succesful</i></p>';
			} else {
				echo '<p "style=color:red"> <i>Update failed </i></p>';
			}
	 		
			// Success message     
			echo '<p "style=color:green"> <i>Authentication succesful</i></p>';


		}
	}
	else
	{
		echo '<p "style=color:red"> <i>Please complete all the fields </i></p>';
	}
?>
