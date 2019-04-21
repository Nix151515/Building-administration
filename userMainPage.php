
<?php
	session_start();
	require_once("dbconnect.php");
	include 'languages/lang_'.$_SESSION['lang'].'.php';
	$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8"/>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVn9-H4vxfuCzjxfr0hb5dvMBJ07iaccU"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>


<body>



<div id="userPageContent">

	<ul>
	  <li><a onclick="loadPage('userRulesPage.php','userPageContent')"><?php echo $lang['rules']; ?></a></li>
	  <li><a onclick="loadPage('userMainPage.php','userPageContent')"><?php echo $lang['payments']; ?></a></li>
	</ul>

	<?php
		if(isset($_COOKIE[$name]))
		{
			$lastVisit = $_COOKIE[$name]; 
			setcookie($name, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
			echo "<h1>".$lang['welcome_message'].", ". $name."</h1><br>";
		}
		else
		{
			setcookie($name, date("d/m/y h:i:s"), time()+60*60*24*7, "/","", 0); // a week
			echo "<h1>".$lang['welcome_message_first'].", ". $name."</h1><br>";
			echo "<p>".$lang['notice1']."</p><br>";
			echo "<p>".$lang['notice2']."</p><br>";
		}
	?>

	<?php 
		$query = "SELECT * FROM $table WHERE `id` = '".$_SESSION['id']."'";
		
		//Execute the query
		$result = mysqli_query($connect,$query);
		if($result)
		{
				$out = mysqli_fetch_assoc($result);

				$now = new DateTime();
				$lastTime = new DateTime(date($out['login']));
				$interval = $now->diff($lastTime);

				$thisMonth = $lang[date('m')];
				$lastMonth = $lang[date('m', strtotime(date('Y-m')." -1 month"))];

				$valuePaid = $thisMonth." (".$lang['paid'].")";
				$valueUnpaid = $thisMonth." (".$lang['unpaid'].")";

				$valuePaid2 = $lastMonth." (".$lang['paid'].")";
				$valueUnpaid2 = $lastMonth." (".$lang['unpaid'].")";
				echo "<div class='centered'>";
				if($out["month1"] == 0)
					echo "<input type='button' 
						value="."'".$valueUnpaid."'"." 
						class='unpaid' disabled><br>";
				else
					echo "<input type='button' 
						value="."'".$valuePaid."'"."
						class='paid' disabled><br>";

				if($out["month2"] == 0)
					echo "<input type='button' 
						value="."'".$valueUnpaid2."'"."
						class='unpaid' disabled><br>";
				else
					echo "<input type='button' 
						value="."'".$valuePaid2."'"."
						class='paid' disabled><br>";
				echo "</div>";
		}
	?>
	
</div>
</body>
</html>