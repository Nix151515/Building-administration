
<?php

	session_start();
	include 'languages/lang_'.$_SESSION['lang'].'.php';
	require_once("dbconnect.php");
	$name = $_SESSION['name'];
	// require_once("index.php");
?>


<div id='adminMainPage'>
<ul>
	<li><a onclick='loadPage(`adminMainPage.php`,`adminMainPage`)'><?php echo $lang['adminPage']; ?></a></li>
	<li><a onclick='loadPage(`adminChartPage.php`,`adminMainPage`); getWidths()'><?php echo $lang['chart']; ?></a></li>
</ul>


<?php
/*		Set login cookies  	*/
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
	}
?>


<?php
	// echo "<input type='button' value='See users chart' onclick='loadPage(`charts.php`, `mainPage`)'>";


$sql = "SELECT * FROM utilizatori;";	
	$result = mysqli_query($connect,$sql);
	if($result)
	{
		$now = new DateTime();

		echo "<div id='users' style='width: 70%; margin: 0 auto;'>";
		echo $lang['searchLabel'];
		echo "<input type='text' onkeyup='getUserrs(this)' />";
		echo "<div id='usersComp' style='overflow-y:auto; height:76vh;'>";


		while($out = mysqli_fetch_assoc($result))
		{
			$lastTime = new DateTime(date($out['login']));
			$interval = $now->diff($lastTime);

			$thisMonth = $lang[date('m')];
			$lastMonth = $lang[date('m', strtotime(date('Y-m')." -1 month"))];

			$valuePaid = $thisMonth." (".$lang['paid'].")";
			$valueUnpaid = $thisMonth." (".$lang['unpaid'].")";

			$valuePaid2 = $lastMonth." (".$lang['paid'].")";
			$valueUnpaid2 = $lastMonth." (".$lang['unpaid'].")";

			echo "<div class='user'>";
			if($interval->d == 0 && $interval->m == 0 && $interval->y == 0)
				echo "<img class='icon' src='pictures/Bullet-green.png'></img>";
			else
				echo "<img class='icon' src='pictures/Bullet-ambar.png'></img>";

			echo 
			"<span style='margin 0 auto;'>".$out["name"]." ".$out["surname"]." - ".$out["room"]."</span>";

			if($out["month1"] == 0)
				echo "<input type='button' 
					value="."'".$valueUnpaid."'"." 
					class='unpaid' id='month1'
					onclick=pay(".$out['id'].",this".",1".")><br>";
			else
				echo 
					"<input type='button' 
					value="."'".$valuePaid."'"."
					class='paid' disabled><br>";

			if($out["month2"] == 0)
				echo "<input type='button' 
					value="."'".$valueUnpaid2."'"." 
					class='unpaid' id='month2' 
					onclick=pay(".$out['id'].",this".",2".")><br>";
			else
				echo "<input type='button' 
					value="."'".$valuePaid2."'"." 
					class='paid' disabled><br>";

			echo "<input type='button' 
					value="."'".$lang['userInfo']."'"." 
					onclick=showInfo(".$out['id'].")><br>";

			echo "</div>";

		}
		echo "</div>";
		echo "</div>";
	}
	else {
		echo "<p> Error fetching users </p>";
	}

 ?>

<?php 
	/*	The map and user data 	*/
		echo '<div id="userData">
			<div id="userFetchedData">
				<h2 id="userName"></h2>
				<h2 id="userSurname"></h2>
				<h4 id="userConnection"></h4>
				<div id="userMap"></div>
			</div>
		</div>';
?>
</div>