<?php

	if(isset($_GET['lang']) && !empty($_GET['lang']))
	{
 		$_SESSION['lang'] = $_GET['lang'];
	}
	else
	{
		$_SESSION['lang'] = 'en';
	}

	
	include 'languages/lang_'.$_SESSION['lang'].'.php';

?>
