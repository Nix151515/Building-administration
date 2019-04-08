
<?php
	session_start();
	include 'languages/lang_'.$_SESSION['lang'].'.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
	</head>

	<body>
		<div id="loginDiv" >
			<h1 class="title"><?php echo $lang['login'] ?></h1>
			<form name="login_form">
				<div class="centered">
					<?php echo $lang['name'] ?><br>
					<input type="text" name="login_name" id="login_name" /><br><br>
					<?php echo $lang['password'] ?><br>
					<input type="password" name="login_password" id="login_password"/><br><br>
					<input type="button" value="<?php echo $lang['login'] ?>" onclick="login()"></input>
					<input type="reset" value="<?php echo $lang['erase'] ?>"> <br>
					<div id="loginResp">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>