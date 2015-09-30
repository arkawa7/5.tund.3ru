<?php
	//functions.php
	require_once("../configglobal.php");
	$database = "if15_arkadi_3";
	
	
	function createUser($create_email, $hash) {
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();
	}

	function loginUser($email, $hash) {
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){	
			echo "Email ja parool on õiged, kasutaja id=".$id_from_db;
		}else{
			echo "Wrong credentials!";
				}
		$stmt->close();
	}
		$mysqli->close();
	
	
	
?>