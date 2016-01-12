<?php require_once("header.php"); ?>
<?php require_once('functions.php'); ?>
<?php
	if(isset($_SESSION["logged_in_user_id"])){


		
	}else{
		header("Location: main.php");
	}
	
	// kas kustutame
	// ?delete=vastav id mida kustutame on aadressireal
	if(isset($_GET["delete"])){
		
		echo "kustutame id ".$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id
		$user->deleteData($_GET["delete"]);
		
	}
	
	

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
		<th>kustuta</th>
	</tr>
	
	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0;$i < count($array_of_weather);$i++){
			//echo $array_of_cars[$i]->id;
			
			
			
				echo "<tr>";
				echo "<td>".$array_of_weather[$i]->id."</td>";
				echo "<td>".$array_of_weather[$i]->temp."</td>";
				echo "<td>".$array_of_weather[$i]->tuul." m/s"."</td>";
				echo "<td>".$array_of_weather[$i]->suund."</td>";
				echo "<td><a href='?delete=".$array_of_weather[$i]->id."'>X</a></td>";
				echo "</tr>";
				
				
			}
			
		
		
	
	
	?>

</table>
<br><br>
<?php
	
	
	

	// käivitan funktsiooni
	$array_of_directions = $user->getDirection();
	
	

?>
<h1>Mitu korda mis suunast tuul on puhunud</h1>
<table border=1>
	<tr>
		<th>suund</th>
		<th>korda</th>
	</tr>
	
	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0;$i < count($array_of_directions);$i++){
			//echo $array_of_cars[$i]->id;
			
			
				echo "<tr>";
				echo "<td>".$array_of_directions[$i]->suund."</td>";
				echo "<td><p style='font-weight:".($array_of_directions[$i]->korda*300)."'>".$array_of_directions[$i]->korda."</p></td>";

				
				
			}
			
		
		
	
	
	?>

</table>