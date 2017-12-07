<?php

session_start();
$database = "if17_janross";
require("config.php");

//alustame sessiooni	




function listMsg(){
	$username = "Shaya";
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//$stmt = $mysqli ->prepare("SELECT idea, ideacolor FROM vpuserideas");
	$stmt = $mysqli ->prepare("SELECT idea, ideacolor FROM vpuserideas ORDER BY id DESC");

	echo $mysqli->error;
	$stmt -> bind_result($idea, $color);
	$stmt->execute();
	
	while($stmt->fetch()){
		//<p style=="background-color: ##ff5577">Hea mõte</p>
		//$notice .='<p style="background-color: ' .$color .'">' .$idea  ."</p> \n";
		$notice .='<p>'.$username .": " .$idea  ."</p> \n";
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
}
?>

<?php
	$database = "if17_oskarj";
	require("config.php");
	
	
	
	function signIn($email, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM chatusers WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime vastavust
		if ($stmt->fetch()){
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb){
				$notice = "Logisite sisse!";
				
				//Määran sessiooni muutujad
				$_SESSION["userId"] = $id;
				$_SESSION["firstname"] = $firstnameFromDb;
				$_SESSION["lastname"] = $lastnameFromDb;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume pealehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei ole!";
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
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
?>



<?php
//Et pääseks ligi funktsioonidele ja sessionile
//require("functions.php");
$notice = "";
require("config.php");
	
if(isset($_POST["saveMessage"])){
	
	if(isset($_POST["sonum"]) and !empty($_POST["sonum"])){
		$notice = saveMsg($_POST["sonum"]);
	}
}
?>


<?php
	$database = "if17_janross";
	$serverHost = "localhost";
	$serverUsername = "if17";
	$serverPassword = "if17";
	
	$name = "robin";
	function saveMsg($text, $name){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO chat (text, name) VALUES (?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ss", $text, $name);
		if($stmt->execute()){
			$notice = "Saadetud!";
		} else {
			$notice = "Saatmisel tekkis viga: " .$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
	}


	if(isset($_POST["msgButton"])){
		if(isset($_POST["text"]) and !empty($_POST["text"])){
			//echo $_POST["ideaColor"];
			$notice = saveMsg($_POST["text"], $name);
			
		}
	}

	function showMsg(){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT text, name, time FROM chat ORDER BY time DESC");
		echo $mysqli->error;
		$stmt->bind_result($text, $name, $time);
		$stmt->execute();
		
		while($stmt->fetch()){
			
			$notice .= "Saadetud- ".$time ."  ".$name ." : " .$text ." \n";
			//$notice .= '<p style="background-color: ' .$color .'">' .$idea ."</p> \n";
			//<p style="background-color: #ffff80">Hea mõte</p>
			//<p style="background-color: #ffff80">Hea mõte | <a href ="edituseridea.php?id=13">Toimeta</a></p>
		}
	
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
?>

<