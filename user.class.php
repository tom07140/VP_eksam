<?php
class User {
	//private - klassi sees
	private $connection;

	//klassi loomisel (new User)
	function __construct($mysqli) {

		// this tähendab selle klassi muutujat

		$this->connection = $mysqli;

	}
	  function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
	  function loginUser($email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM VP_kasutajad WHERE email=? AND hash=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
		  $_SESSION["logged_in_user_id"] = $id_from_db;
		  $_SESSION["logged_in_user_email"] = $email_from_db;
		  $user = new StdClass();
		  $user->email = $email_from_db;
		  header("Location: main.php");
		}
		else{
		  echo "Valed andmed";
		}
	  }
	
	  function createUser($create_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO VP_kasutajad (email, hash) VALUES (?,?)");
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();

		}

	  function addStat($temp, $speed, $direction){
		  $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		  $stmt = $mysqli->prepare("INSERT INTO VP_ilmavaatlus (temp, tuul, suund) VALUES (?,?,?)");
		  $stmt->bind_param("sss", $temp, $speed, $direction);
		  $stmt->execute();
		  $stmt->close();
	  }
	  
	  function deleteData(){
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
			$stmt = $mysqli->prepare("UPDATE VP_ilmavaatlus SET kustutatud=NOW() WHERE id=?");
			$stmt->bind_param("i", $id);
			if($stmt->execute()){
				// sai kustutatud
				// kustutame aadressirea tühjaks
				header("Location: edit.php");
			
			}
		
			$stmt->close();
			$mysqli->close();
	  }
	  
	  function getWeatherData(){
		  $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
			$stmt = $mysqli->prepare("SELECT id, temp, tuul, suund FROM VP_ilmavaatlus WHERE kustutatud IS NULL");
			$stmt->bind_result($id, $temp, $windSpeed, $windDirection);
			$stmt->execute();
		
			// tekitan tühja massiivi, kus edaspidi hoian objekte
			$weather_array= array();
		
			// tee midagi seni, kuni saame ab'st ühe rea andmeid
			while($stmt->fetch()){
				// seda siin sees tehakse nii mitu korda kuni on ridu
				
				//tekitan objekti, kus hakkan hoidma väärtusi
				$weather = new StdClass();
				$weather->id = $id;
				$weather->temp = $temp;
				$weather->tuul = $windSpeed;
				$weather->suund = $windDirection;
			
				// lisan massiivi ühe rea juurde
				array_push($weather_array, $weather);
				// var_dump ütleb muutuja nime ja stuffi
				//echo "<pre>";
				//var_dump($car_array);
				//echo "</pre><br>";
			}
		
			// tagastan massiivi, kus kõik read sees
			return $weather_array;
			
			$stmt->close();
			$mysqli->close();
	  }
	  
	  function getStats(){
		  $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
			$stmt = $mysqli->prepare("SELECT temp, count(temp) FROM VP_ilmavaatlus GROUP BY temp");
			$stmt->bind_result($temp, $number);
			$stmt->execute();
		
			// tekitan tühja massiivi, kus edaspidi hoian objekte
			$stats_array= array();
		
			// tee midagi seni, kuni saame ab'st ühe rea andmeid
			while($stmt->fetch()){
				// seda siin sees tehakse nii mitu korda kuni on ridu
				
				//tekitan objekti, kus hakkan hoidma väärtusi
				$stats = new StdClass();
				$stats->temp = $temp;
				$stats->number = $number;
			
				// lisan massiivi ühe rea juurde
				array_push($stats_array, $stats);
				// var_dump ütleb muutuja nime ja stuffi
				//echo "<pre>";
				//var_dump($car_array);
				//echo "</pre><br>";
			}
		
			// tagastan massiivi, kus kõik read sees
			return $stats_array;
			
			$stmt->close();
			$mysqli->close();
	  }
	  
	  function getDirection(){
		  $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
			$stmt = $mysqli->prepare("SELECT suund, count(suund) FROM VP_ilmavaatlus GROUP BY suund");
			$stmt->bind_result($suund, $korda);
			$stmt->execute();
		
			// tekitan tühja massiivi, kus edaspidi hoian objekte
			$direction_array= array();
		
			// tee midagi seni, kuni saame ab'st ühe rea andmeid
			while($stmt->fetch()){
				// seda siin sees tehakse nii mitu korda kuni on ridu
				
				//tekitan objekti, kus hakkan hoidma väärtusi
				$direction = new StdClass();
				$direction->suund = $suund;
				$direction->korda = $korda;
			
				// lisan massiivi ühe rea juurde
				array_push($direction_array, $direction);
				// var_dump ütleb muutuja nime ja stuffi
				//echo "<pre>";
				//var_dump($car_array);
				//echo "</pre><br>";
			}
		
			// tagastan massiivi, kus kõik read sees
			return $direction_array;
			
			$stmt->close();
			$mysqli->close();
	  }
}

?>