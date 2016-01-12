<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php
	$email = "";
	$email_error = "";
	$password = "";
	$password_error = "";
		// *********************
		// **** LOGI SISSE *****
		// *********************
		if(isset($_POST["login"])){
			if (empty($_POST["email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
				$email = $user->cleanInput($_POST["email"]);
			}
			if (empty($_POST["password"])) {
				$password_error = "See väli on kohustuslik";
			}else{
				$password = $user->cleanInput($_POST["password"]);
			}
			if($password_error == "" && $email_error == ""){
				$hash = hash("sha512", $password);
				$user->loginUser($email, $hash);

			}
			
		}
?>
<html>
<h2>Logi sisse</h2>
	
		<form action="login.php" method="post" >
			<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>">  <?php echo $email_error; ?><br><br>
			<input name="password" type="password" placeholder="parool" value="<?php echo $password; ?>">  <?php echo $password_error; ?><br><br>
			<input type="submit" name="login" value="Login">  <br><br>
		</form>
</html>