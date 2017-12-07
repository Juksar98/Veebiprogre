<?php
require("registyle.css");
//require("index.js");
require("functions.php");
require("config.php");
	
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
	if(isset($_POST["signupButton"])){
	
	if (isset ($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName = test_input($_POST["signupFirstName"]);
		}
	}
	
	if (isset ($_POST["signupFamilyName"])){
		if (empty($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName = test_input($_POST["signupFamilyName"]);
		}
	}

	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail = test_input($_POST["signupEmail"]);
						
			$signupEmail = filter_var($signupEmail, FILTER_SANITIZE_EMAIL);
			$signupEmail = filter_var($signupEmail, FILTER_VALIDATE_EMAIL);
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			$signupPasswordError = "NB! Väli on kohustuslik!";
		} else {
			if (strlen($_POST["signupPassword"]) < 8){
				$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}
		}
	}
		
	if (!empty($signupFirstNameError) and !empty($signupFamilyNameError) and !empty($signupEmailError) and !empty($signupPasswordError)){
		echo "Hakkan salvestama!";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
	}
	}
?>
<!DOCTYPE html>

<form action="test2.php" method="get">
  <h1>Registeeri</h1><br/>

  <span class="input"></span>
  <input type="text" name="signupFirstName" placeholder="Eesnimi"/>
  <span class="input"></span>
  <input type="text" name="signupFamilyNameName" placeholder="Perekonnanimi"/>
  <span class="input"></span>
  <input type="email" name="signupEmail" placeholder="Email" required />
  <span id="passwordMeter"></span>
  <input type="password" name="signupPassword" id="password" placeholder="Parool"/>

  <button type="submit" name="signupButton" value="Sign Up" title="Submit form" class="icon-arrow-right"><span>Registeeru</span></button>
</form>
</html>