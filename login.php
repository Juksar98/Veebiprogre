<?php
	require("style.css");
	require("functions.php");
	require("config.php");
	
	
	$email = "";
	$password = "";
	$emailError = "";
	$passwordError = "";
	
	/*if(isset($_SESSION["userId"])){
		header("Location: index.php");
		exit();
	}*/
	if(isset($_POST["loginButton"])){
	
	if (isset ($_POST["email"])){
		if (empty($_POST["email"])){
			$emailError ="NB! Väli on kohustuslik!";
		} else {
			$email =($_POST["email"]);
		}
	}
	
	if (isset ($_POST["password"])){
		if (empty($_POST["password"])){
			$passwordError ="NB! Väli on kohustuslik!";
		} else {
			$password =($_POST["password"]);
		}
	}


	if (!empty($emailError) and !empty($passwordError)){
			echo "Login sisse!";
			$password = hash("sha512", $_POST["password"]);
			signIn($email, $password);
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
      <input type="text" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Parool" required />
      <button name="loginButton"><a>
	  Logi sisse</a></button>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>