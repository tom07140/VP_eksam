<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php
	$create_email = "";
	$create_email_error = "";
	$create_password = "";
	$create_password_error = "";
		
		if(isset($_POST["create"])){
				if (empty($_POST["create_email"])) {
					$create_email_error = "See väli on kohustuslik";
				}else{
					$create_email = $user->cleanInput($_POST["create_email"]);
				}
				if (empty($_POST["create_password"])) {
					$create_password_error = "See väli on kohustuslik";
				} else {
					if(strlen($_POST["create_password"]) < 5) {
						$create_password_error = "Peab olema vähemalt 5 tähemärki pikk!";
					}else{
						$create_password = $user->cleanInput($_POST["create_password"]);
					}
				}
				if($create_email_error == "" && $create_password_error == ""){
					$hash = hash("sha512", $create_password);
					$user->createUser($create_email, $hash);


				}
		} 

?>
<html>
	<h2>Loo konto</h2>
		<form action="create.php" method="post"> 
			<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?> <br><br>
			<input name="create_password" type="password" placeholder="Parool" value="<?php echo $create_password; ?>"> <?php echo $create_password_error; ?> <br><br> 
			<input type="submit" name="create" value="Registreeru"> <br><br>
		</form>
</html>