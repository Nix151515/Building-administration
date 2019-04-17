
<?php
	session_start();
	require_once("langs.php");
	require_once("dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en" >
	<head>

		<title> P16 </title>

		<meta charset="utf-8"/>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVn9-H4vxfuCzjxfr0hb5dvMBJ07iaccU"></script>
		<script src="script.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
			// getWidths()
		function getUserrs(element) {
			let text = element.value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    	document.getElementById("usersComp").innerHTML = this.responseText;
				    }
				};

			xmlhttp.open("GET", "getUsers.php?text="+text, true);
			xmlhttp.send();
		}

		
		</script>


	</head>

	<body id="pageContent">
			<div id="tett"></div>
			<div id="mainPage">

				<div style="float:right;">
					<img src="pictures/ro_flag.png" class="flag" onclick="changeLang('ro')">  </img>
					<img src="pictures/uk_flag.png" class="flag" onclick="changeLang('en')">  </img>
				</div>

				<br><br><br>


				<h1 class="title"> <?php echo $lang['startPage'] ?> </h1>
				<div class="centered">
					<button onclick="loadPage('registerPage.php', 'mainPage')" class="half"> <?php echo $lang['register'] ?> </button>
					<button onclick="loadPage('loginPage.php', 'mainPage')" class="half"> <?php echo $lang['login'] ?> </button>
				</div>
			</div>


			<footer id="footer">

				<?php
					$path    = '.';
					$files = scandir($path);
					$files = array_diff(scandir($path), array('.', '..'));
					$i = 0;

					for($i = 2; $i< count($files); $i ++)
					{
						// echo "File ".$files[$i]."<br>";
						if (strpos($files[$i], 'Page') !== false)
						{
							$fileTitle = ucfirst(str_replace("Page.php", "", $files[$i]));
							echo isset($_SESSION['name']);

							if(isset($_SESSION['name']))
							{
								// echo "Set, ".$_SESSION['name']."<br>";
								if($_SESSION['name'] === 'admin' && strpos($fileTitle, 'Admin'))
									echo "<a onclick=loadPage('$files[$i]','mainPage')>".$fileTitle."</a><br>";
								if($_SESSION['name'] !== 'admin' && strpos($fileTitle, 'User'))
									echo "<a onclick=loadPage('$files[$i]','mainPage')>".$fileTitle."</a><br>";
							}
							else
							{
								// echo "Not set ". $fileTitle;
								if(strpos($fileTitle, 'User') === false && strpos($fileTitle, 'Admin') === false)
									echo "<a onclick=loadPage('$files[$i]','mainPage')>".$fileTitle."</a><br>";
								
							}
						}
					}
				?>
			</footer>
	
	</body>

</html>