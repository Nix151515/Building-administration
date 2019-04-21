<?php
	require_once("dbconnect.php");
	// error_reporting(E_ERROR | E_PARSE);
	session_start();
	include 'languages/lang_'.$_SESSION['lang'].'.php';

	// echo $_GET['text'];
	$text = $_GET['text'];

	$sql = "SELECT * FROM utilizatori;";	
	$result = mysqli_query($connect,$sql);

	$now = new DateTime();
	// $hint = "";

	if($result){
		if ($text !== "") {
		    $text = strtolower($text);
		    $len = strlen($text);

			while($out = mysqli_fetch_assoc($result)){

				// $fullname = $out['name']." ".$out['surname'];

				/*		Cauta textul introdus in tot numele (are lungimea = textul)    */
				if(stristr($text, substr($out['name'], 0, $len)) 
				|| stristr($text, substr($out['surname'], 0, $len))
				|| stristr($text, substr($out['room'], 0, $len)))
				{
					// if ($hint === "") {
		   //              $hint = $fullname;
		   //          } else {
		   //              $hint .= ", ".$fullname;
		   //          }
					$lastTime = new DateTime(date($out['login']));
					$interval = $now->diff($lastTime);

					$thisMonth = $lang[date('m')];
					$lastMonth = $lang[date('m', strtotime(date('Y-m')." -1 month"))];

					$valuePaid = $thisMonth." (".$lang['paid'].")";
					$valueUnpaid = $thisMonth." (".$lang['unpaid'].")";

					$valuePaid2 = $lastMonth." (".$lang['paid'].")";
					$valueUnpaid2 = $lastMonth." (".$lang['unpaid'].")";

					echo "<div class='user' style='width:240px; float:left; padding:2%'>";
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
				//TODO : Dau echo la divuri si inlocuiesc in functie divul #users cu ce imi iese aici
			}
		}
		/*  No input given  */
		else
		{
			while($out = mysqli_fetch_assoc($result)){
				$lastTime = new DateTime(date($out['login']));
					$interval = $now->diff($lastTime);

					$thisMonth = $lang[date('m')];
					$lastMonth = $lang[date('m', strtotime(date('Y-m')." -1 month"))];

					$valuePaid = $thisMonth." (".$lang['paid'].")";
					$valueUnpaid = $thisMonth." (".$lang['unpaid'].")";

					$valuePaid2 = $lastMonth." (".$lang['paid'].")";
					$valueUnpaid2 = $lastMonth." (".$lang['unpaid'].")";

					echo "<div class='user' style='width:240px; float:left; padding:2%'>";
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
		}
	}

	// Output "no suggestion" if no hint was found or output correct values 
	// echo $hint === "" ? "no suggestion" : $hint;


?>