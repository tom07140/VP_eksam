<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php
	if(isset($_SESSION["logged_in_user_id"])){
		
		
	}else{
		header("Location: main.php");
	}
	
	

	// käivitan funktsiooni
	$array_of_stats = $user->getStats();
	
	

?>
<table border=1>
	<tr>
		<th>temp</th>
		<th>mitu korda</th>
	</tr>
	
	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0;$i < count($array_of_stats);$i++){
			//echo $array_of_cars[$i]->id;
			
			
				echo "<tr>";
				echo "<td>".$array_of_stats[$i]->temp."</td>";
				echo "<td>".$array_of_stats[$i]->number."</td>";

				
				
			}
			
		
		
	
	
	?>

</table>