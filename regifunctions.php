<?php
	require("../../../config.php");
	$database = "if17_oskarj";
	
	
	function signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO chatusers (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssss", $signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
		$stmt->close();
		$mysqli->close();
		session_start();
	}
	
?>