<?php
	$database = "if17_nurkrobi";
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

<html>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Saada sõnum: </label>
		<input name="text" type="text">
		<br>
		<br>
		<input name="msgButton" type="submit" value="Saada sõnum!">
		
	</form>
	<hr>
	<div style="width: 40%">
		<?php echo showMsg(); ?>
	</div>
</html>