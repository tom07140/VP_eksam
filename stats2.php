<?php require_once("header2.php"); ?>
<?php require_once("functions.php"); ?>
<?php
		if(isset($_SESSION["logged_in_user_id"])){
		header("Location: edit.php");
		
	}else{
		header("Location: main.php");
	}
	
	

	// käivitan funktsiooni
	$array_of_directions = $user->getDirection();
	
	

?>
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
				echo "<td>".$array_of_directions[$i]->korda."</td>";

				
				
			}
			
		
		
	
	
	?>

</table>