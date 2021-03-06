<?php
//alustame sessiooni
session_start();
$database = "if17_oskarj";
require("config.php");
//lahw
	
	
	function signIn($loginEmail, $loginPassword){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM chatusers WHERE email = ?");
		$stmt->bind_param("s", $loginEmail);
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime vastavust
		if ($stmt->fetch()){
			$hash = hash("sha512", $loginPassword);
			if ($hash == $passwordFromDb){
				$notice = "Logisite sisse!";
				
				//Määran sessiooni muutujad
				$_SESSION["userId"] = $id;
				$_SESSION["firstname"] = $firstnameFromDb;
				$_SESSION["lastname"] = $lastnameFromDb;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume pealehele
				header("Location: index.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat " .$loginEmail ." ei ole!";
		}
		return $notice;
	}


//uue kasutaja andmebaasi lisamine
function signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword){
	//loome andmebaasiühenduse
	
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//valmistame ette käsu andmebaasiserverile
	$stmt = $mysqli->prepare("INSERT INTO chatusers (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
	echo $mysqli->error;
	//s - string
	//i - integer
	//d - decimal
	$stmt->bind_param("ssss", $signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
	//$stmt->execute();
	if ($stmt->execute()){
		//echo "\n Õnnestus!";
		echo("<script>location.href = 'login.php$msg';</script>");
		exit();
	} else {
		echo "\n Tekkis viga : " .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
}

?>
