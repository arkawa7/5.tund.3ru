<?php
	require_once("functions.php");
	//data.php
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location login_sample.php");
	}
	
	if(isset($_GET["logout"])){
		session_destroy();
		
		header("Location: login_sample.php");
	}
	
	$number_plate = $color = "";
	$number_plate_error = $color_error = "";
	
	 if(isset($_POST["add_plate"])){
		
		//echo $_SESSION["logged_in_user_id"]; 
		
		if ( empty($_POST["number_plate"]) ) {
			$number_plate_error = "See v�li on kohustuslik";
		}else{
			$number_plate = cleanInput($_POST["number_plate"]);
		}
		
		if ( empty($_POST["color"]) ) {
				$color_error = "See v�li on kohustuslik";
		}else{
			$color = cleanInput($_POST["color"]);
		}
		
		if($color_error == "" && $number_plate_error == ""){
			$msg = addCarPlate($number_plate, $color);
			if($msg !=""){
				$number_plate = "";
				$color ="";
				
				echo $msg;
				
			}
		}
	}
		
	
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
  }

?>
<p>
	Tere, <? echo $_SESSION["logged_in_user_id"];?>
	<a href="?logout=1>"> Logi v�lja <a>
</p>

<h2>Lisa autonumbrim�rk</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="number_plate">Auto numbrim�rk</label>
  	<input id="number_plate" name="number_plate" type="text"  value="<?php $number_plate; ?>"> <?=$number_plate_error; ?><br><br>
	<label for="color">V�rv</label><br>
  	<input id="color" name="color" type="text"  value="<?php echo $color; ?>"> <?=$color_error; ?><br><br>
  	<input type="submit" name="add_plate" value="Salvesta">
  </form>
  
 