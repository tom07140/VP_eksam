<?php require_once('header.php'); ?>
<?php
	require_once("functions.php");
	// data.php
	

	

	
	$temp = $speed = $direction = "";
	$temp_error = $speed_error = $direction_error = "";
	
	//keegi vajutas nuppu numbrim�rgi lisamiseks
	if(isset($_POST["sisesta"])){
		// echo $_SESSION["logged_in_user_id"];
		
		// valideerite v�ljad
		// m�lemad on kohustuslikud
		// salvestatakse AB'i fn kaudu addCarPlate
		if ( empty($_POST["temp"]) ) {
				$temp_error = "See v�li on kohustuslik";
			}else{
			// puhastame muutuja v�imalikest �leliigsetest s�mbolitest
				$temp = cleanInput($_POST["temp"]);
			}
		if ( empty($_POST["kiirus"]) ) {
				$speed_error = "See v�li on kohustuslik";
			}else{
			// puhastame muutuja v�imalikest �leliigsetest s�mbolitest
				$speed = cleanInput($_POST["kiirus"]);
			}
		if ( empty($_POST["suund"]) ) {
				$direction_error = "See v�li on kohustuslik";
			}else{
				$direction = cleanInput($_POST["suund"]);
			}
		if(	$temp_error == "" && $speed_error == "" && $direction_error == ""){
					
					
					
					// kasutaja loomise funktsioon, failist functions.php
					// saadame kaasa muutujad
					$message = addStat($temp, $speed, $direction);
					
					if($message != ""){
						// �nnestus, teeme inputi v�ljad t�hjaks
						$temp = "";
						$speed = "";
						$direction = "";
						
						echo $message;
						
					}
				}
	}
	

	
?>
<html>

<h2>Vaatlusandmed</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<label for="temp">Temperatuur</label><br>
	<input id="temp" name="temp" type="text" value="<?php echo $temp; ?>"> <?php echo $temp_error; ?><br><br>
	<label for="kiirus">Tuule kiirus</label><br>
  	<input id="kiirus" name="kiirus" type="float" value="<?php echo $speed; ?>"> <?php echo $speed_error; ?><br><br>
	<label for="suund">Tuule suund</label><br>
  	<input id="suund" name="suund" type="text" value="<?php echo $direction; ?>"> <?php echo $direction_error; ?><br><br>
  	<input type="submit" name="sisesta" value="Salvesta">
  </form>