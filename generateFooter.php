<?php
	$path    = '.';
	$files = scandir($path);
	$files = array_diff(scandir($path), array('.', '..'));
	$i = 0;
	for($i = 2; $i<= count($files); $i ++)
	{
		if (strpos($files[$i], 'Page') !== false)
		{
			$fileTitle = ucfirst(str_replace("Page.php", "", $files[$i]));

			if($_GET['user']==='admin'){
				if(strpos($fileTitle, 'User') === false) {
					if(strpos($fileTitle, 'Admin') !== false) {
						$format = str_replace("Admin", "", $fileTitle);
						echo "<a onclick=".'"'."loadPage('$files[$i]','adminMainPage');getWidths();".'"'.">".$format."</a><br>";
					} else {
						echo "<a onclick=".'"'."changeFooter('nimic'); loadPage('$files[$i]','mainPage')".'"'.">".$fileTitle."</a><br>";
					}
				}
			}

			if($_GET['user']==='user') {
				if(strpos($fileTitle, 'Admin') === false) {
					if(strpos($fileTitle, 'User') !== false) {
						$format = str_replace("User", "", $fileTitle);
						echo "<a onclick=".'"'."loadPage('$files[$i]','userPageContent')".'"'.">".$format."</a><br>";
					} else {
						echo "<a onclick=".'"'."changeFooter('nimic'); loadPage('$files[$i]','mainPage')".'"'.">".$fileTitle."</a><br>";
					}
				}
			}

			if($_GET['user'] !=='user' && $_GET['user'] !== 'admin') {
				if(strpos($fileTitle, 'Admin') === false && strpos($fileTitle, 'User') === false) {
					echo "<a onclick=".'"'."loadPage('$files[$i]','mainPage');".'"'.">".$fileTitle."</a><br>";
				}
			}
		}
	}
?>