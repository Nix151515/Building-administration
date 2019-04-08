
<?php
	$server = "localhost";
	$database = "ProgramareWeb";
	$username = "root";
	$parola = "admin";
	$table = "utilizatori";
	 
	/*			Connect to the SQL server 		*/
	$connect = mysqli_connect($server, $username, $parola);
	 
	/*			Verify the connection  		*/
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}

	/*			Select the database 		*/
	$db = mysqli_select_db($connect,$database);
	if(!$db)
		die("Connection to database failed".mysqli_error($connect));
	
	/*			Write the query to create the users table    		*/
	$sql = "CREATE TABLE utilizatori (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(30) NOT NULL,
		surname VARCHAR(30) NOT NULL,
		password VARCHAR(50) NOT NULL,
		email VARCHAR(50),
		login DATETIME DEFAULT NOW(),
		lat FLOAT(7,5),
		lng FLOAT(7,5),
		room INT(3) NOT NULL,
		month1 INT(2) default 0,
		month2 INT(2) default 0
		);";
	
	/*			Apply the query 		*/
	$result = mysqli_query($connect, $sql);
	
?>