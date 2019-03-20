<?php
	// session_start();

	// if(!isset $_SESSION['lang'])
		
	
	if(isset($_GET['lang']) && !empty($_GET['lang']))
	{
		// echo "Language set ".$_GET['lang'];
 		$_SESSION['lang'] = $_GET['lang'];
	}
	else
	{
		$_SESSION['lang'] = 'en';
	}

	
	include 'languages/lang_'.$_SESSION['lang'].'.php';

?>
