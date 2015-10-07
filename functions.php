<?php
	//functions.php
	require_once("../configglobal.php");
	$database = "if15_arkadi_3";
	
	session_start();
	
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
			
			//teiktan sessiooni muutujad
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
			
			header("Location: data.php");
			
		}else{
			echo "Wrong credentials!";
				}
		$stmt->close();
		$mysqli->close();
	}
		
	
	function addCarPlate($car_plate, $car_color){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO car_plates (user_id, number_plate, color) VALUES (?,?,?)");
        $stmt->bind_param("iss", $_SESSION['logged_in_user_id'], $car_plate, $car_color);
		
		//sõnum
		$message = "";
		
        if ($stmt->execute()){
			//kui tõene,
			//siis insert õnnestus
			$message = "Sai edukalt lisatud";
			
		}else{
			echo $stmt->error;
			
		}
        
		return $message;
		
		$stmt->close();
		
		
		$mysqli->close();
	}
	
?>