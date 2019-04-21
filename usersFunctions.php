<?php
	require_once("dbconnect.php");
	error_reporting(E_ERROR | E_PARSE);
	session_start();
	include 'languages/lang_'.$_SESSION['lang'].'.php';
	
	/*  Creating the string for the last connection data  */
	$query = "SELECT * FROM $table WHERE `id` = '".$_GET['id']."'";
	$result = mysqli_query($connect, $query);	
	if($result) {
		$out = mysqli_fetch_assoc($result);
		$user->name = $out['name'];
		$user->surname = $out['surname'];
		$user->lat = $out['lat'];
		$user->lng = $out['lng'];
		date_default_timezone_set('Europe/Bucharest');

		$now = new DateTime();
		$lastTime = new DateTime(date($out['login']));
		$interval = $now->diff($lastTime);
		$message ='';


		if($interval->m > 0)
			$message .= $interval->m." ".$lang['months'].", ";
		if($interval->d > 0)
			$message .= $interval->d." ".$lang['days'].", ";
		if($interval->h > 0)
			$message .= $interval->h." ".$lang['hours'].", ";
		if($interval->i > 0)
			$message .= $interval->i." ".$lang['minutes']." ";
		if($message == '')
			$message .= $lang['less_an_hour'];
		else
			$message .= $lang['since_con'];

		$user->time = $message;

		echo json_encode($user);
	}
	else {
		echo "<p> SQL er </p>";
	}
?>