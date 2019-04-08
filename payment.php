<?php

	/* 		Updating the pays in the database when clicking the pay button   */
	require_once("dbconnect.php");

	$m = "month".$_GET['month'];
	$id = $_GET['id'];

	/*		Set the paid month to 1		*/

	$sql ="UPDATE $table SET $m = 1 WHERE id = "."'$id'". ";";
	$result = mysqli_query($connect,$sql);
?>