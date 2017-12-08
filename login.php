<?php
	require("style.css");
	require("functions.php");
	require("config.php");
	//lahe
	$notice = "";
	$loginEmail = "";
	$loginPassword = "";
	$loginEmailError = "";
	$loginPasswordError = "";
	

		//kas klõpsati sisselogimise nuppu
	if(isset($_POST["loginButton"])){
	
	//kas on kasutajanimi sisestatud
	if (isset ($_POST["loginEmail"])){
		if (empty ($_POST["loginEmail"])){
			$loginEmailError ="NB! Sisselogimiseks on vajalik kasutajatunnus (e-posti aadress)!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	if(!empty($loginEmail) and !empty($_POST["loginPassword"])){
		//echo "Logime sisse!";
		$notice = signIn($loginEmail, $_POST["loginPassword"]);
	}
	}
	
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sisselogimine</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
	
  <div class="login-page">
  <div class="form">
  <h1>Logi Sisse</h1>
    <form class="login-form" method="POST">
      <input type="text" name="loginEmail" placeholder="Email" required />
      <input type="password" name="loginPassword" placeholder="Parool" required />
      <input name="loginButton" type="submit" value="Logi Sisse"> <span><?php echo $notice; ?></span>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>