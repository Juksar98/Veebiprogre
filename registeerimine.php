<?php
require("functions.php");
require("registyle.css");
//require("index.js");
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
			$signupFirstName =($_POST["signupFirstName"]);
		}
	}
	
	if (isset ($_POST["signupFamilyName"])){
		if (empty($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName =($_POST["signupFamilyName"]);
		}
	}

	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail =($_POST["signupEmail"]);
						
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
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
	/*	
	if (!empty($_POST["signupButton"])){
		echo "Hakkan salvestama!";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword);
	}*/
	}
?>
<!DOCTYPE html>

<form  method="POST">
  <h1>Registreeri</h1><br/>

  <span class="input"></span>
  <input type="text" name="signupFirstName" placeholder="Eesnimi" required />
  <span class="input"></span>
  <input type="text" name="signupFamilyName" placeholder="Perekonnanimi" required />
  <span class="input"></span>
  <input type="email" name="signupEmail" placeholder="Email" required />
  <span id="passwordMeter"></span>
  <input type="password" name="signupPassword" id="password" placeholder="Parool" required />

  <button type="submit" name="signupButton" value="Sign Up" title="Submit form" class="icon-arrow-right" ><span>Registreeru</span></button>
</form>
</html>