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


?>
<p>
	Tere, <?php echo $_SESSION["logged_in_user_email"];?>
	<a href="?logout=1>"> Logi välja <a>