<?php
	session_start();
	// require_once("langs.php");
	require_once("dbconnect.php");
include 'languages/lang_'.$_SESSION['lang'].'.php';
	?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8"/>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVn9-H4vxfuCzjxfr0hb5dvMBJ07iaccU"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	
	</style>
</head>


<body>

	<ul>
	  <li><a onclick="loadPage('userRulesPage.php','userPageContent')"><?php echo $lang['rules']; ?></a></li>
	  <li><a onclick="loadPage('userMainPage.php','userPageContent')"><?php echo $lang['payments']; ?></a></li>
	</ul>
	


	<?php
		echo $lang['rulesTitle'];
		echo $lang['art25'];
		echo $lang['art26'];
		echo $lang['art27'];
	?>




</body>
</html>