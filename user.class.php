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
		  header("Location: edit.php");
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
}

?>