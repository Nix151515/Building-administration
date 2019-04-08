
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
		<div id="registerDiv" >
			<h1 class="title"> <?php echo $lang['register']; ?> </h1>
			<form name="register_form">
				<div class="centered">
					<?php echo $lang['name'] ?><br>
					<input type="text" name="register_name" id="register_name"/><br><br>

					<?php echo $lang['surname'] ?><br>
					<input type="text" name="register_surname" id="register_surname"/><br><br>

					<?php echo $lang['room'] ?><br>
					<input type="number" name="register_room" id="register_room" min="100" max="600"/><br><br>

					<?php echo $lang['email'] ?> (optional)<br>
					<input type="email" name="register_email" id="register_email"/><br><br>

					<?php echo $lang['password'] ?><br>
					<input type="password" name="register_password" id="register_password"/><br><br>

							<!-- Google Map elements -->

					<div id="mapDiv">
						<?php echo $lang['address'] ?><br>
						<input id="address" type="text" value="Cluj">
						<input type="button" value="<?php echo $lang['check_address'] ?>" onclick="codeAddress()">
						<div id="googleMap"></div>
						<p id="latitude" hidden> ASD</p><br>
						<p id="longitude" hidden> ASD</p>
						<p id="err"></p>
			    	</div>
					



					<input type="button" name="register_btn" value="<?php echo $lang['register'] ?>" onclick="register()"/>
					<input type="reset" value="<?php echo $lang['erase'] ?>"> <br>

					<div id="registerResp">
					</div>

				</div>
			</form>
		</div>
	</body>

</html>