<?php require_once('header.php'); ?>
<?php
	require_once("functions.php");
	// data.php
	
	if(isset($_SESSION["logged_in_user_id"])){
		

		
	}else{
		header("Location: login.php");
	}

	

	
	$temp = "";
	$speed = "";
	$direction = "";
	$temp_error = "";
	$speed_error = "";
	$direction_error = "";
	
	//keegi vajutas nuppu numbrimärgi lisamiseks
	if(isset($_POST["sisesta"])){
		// echo $_SESSION["logged_in_user_id"];
		
		// valideerite väljad
		// mõlemad on kohustuslikud
		// salvestatakse AB'i fn kaudu addCarPlate
		if ( empty($_POST["temp"]) ) {
				$temp_error = "See väli on kohustuslik";
			}else{
			// puhastame muutuja võimalikest üleliigsetest sümbolitest
				$temp = $user->cleanInput($_POST["temp"]);
			}
		if ( empty($_POST["kiirus"]) ) {
				$speed_error = "See väli on kohustuslik";
			}else{
			// puhastame muutuja võimalikest üleliigsetest sümbolitest
				$speed = $user->cleanInput($_POST["kiirus"]);
			}
		if ( empty($_POST["suund"]) ) {
				$direction_error = "See väli on kohustuslik";
			}else{
				$direction = $user->cleanInput($_POST["suund"]);
			}
		if(	$temp_error == "" && $speed_error == "" && $direction_error == ""){
					
					
					
					// kasutaja loomise funktsioon, failist functions.php
					// saadame kaasa muutujad
					$message = $user->addStat($temp, $speed, $direction);
					
					if($message != ""){
						// õnnestus, teeme inputi väljad tühjaks
						$temp = "";
						$speed = "";
						$direction = "";
						
						echo $message;
						
					}
				}
	}
	

	
?>
<html>

<h1>Vaatlusandmete sisestus</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<label for="temp">Temperatuur</label><br>
	<input id="temp" name="temp" type="float" value="<?php echo $temp; ?>"> <?php echo $temp_error; ?><br><br>
	<label for="kiirus">Tuule kiirus</label><br>
  	<input id="kiirus" name="kiirus" type="float" value="<?php echo $speed; ?>"> <?php echo $speed_error; ?><br><br>
	<label for="suund">Tuule suund</label><br>
  	<input id="suund" name="suund" type="text" value="<?php echo $direction; ?>"> <?php echo $direction_error; ?><br><br>
  	<input type="submit" name="sisesta" value="Salvesta">
  </form>
<?php
	
	
	// kas kustutame
	// ?delete=vastav id mida kustutame on aadressireal

	

	// käivitan funktsiooni
	$array_of_weather = $user->getWeatherData();
	
	

?>
<p>
<h1>Vaatlusandmed</h1>
<table border=1>
	<tr>
		<th>id</th>
		<th>temp</th>
		<th>kiirus</th>
		<th>suund</th>
	</tr>
	
	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0;$i < count($array_of_weather);$i++){
			//echo $array_of_cars[$i]->id;
			
			
			
				echo "<tr>";
				echo "<td>".$array_of_weather[$i]->id."</td>";
				echo "<td>".$array_of_weather[$i]->temp."</td>";
				echo "<td>".$array_of_weather[$i]->tuul."</td>";
				echo "<td>".$array_of_weather[$i]->suund."</td>";
				echo "</tr>";
				
				
			}
			
		
		
	
	
	?>

</table>