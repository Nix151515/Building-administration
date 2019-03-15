
<?php
	$server = "localhost";
	$database = "ProgramareWeb";
	$username = "root";
	$parola = "admin";
	$table = "users";
	 
	// connect to MySQL server
	$connect = mysqli_connect($server, $username, $parola);
	 
	 // verify the connection
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//echo "(Connected successfully to MySQL server)<br><br>";
	// echo "<script>console.log( 'Connected successfully to MySQL server' );</script>";
	 
	// select the database
	$db = mysqli_select_db($connect,$database);
	if(!$db)
		die("Connection to database failed".mysqli_error($connect));
	
	// write the query to create the table
	$sql = "CREATE TABLE users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(30) NOT NULL,
		surname VARCHAR(30) NOT NULL,
		password VARCHAR(50) NOT NULL,
		email VARCHAR(50),
		login DATETIME DEFAULT NOW(),
		lat FLOAT(7,5),
		lng FLOAT(7,5)
		);";
	
	// apply the query to create the table
	$result = mysqli_query($connect, $sql);
	// if(!$result) { 
		// echo "<p> Table not created</p>";
	// }
?>