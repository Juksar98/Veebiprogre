

<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");
	
/*	//Kui pole sisseloginud, liigume login lehele
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}		*/
 //Logi välja funktsioon
if(isset($_GET["Logout"])){
	session_destroy();
	header("Location: login.php");
	exit();
}

?>

<!DOCTYPE html>
<html>


<head>
	<link rel="stylesheet" type="text/css" href="indexstyle.css">
	<meta charset="utf-8">
	<ul>
	<li><a href="main.php">Pealeht</a></li>
	<li><a href="lehed.php">Huvitavad leheküljed</a></li>
	<li><a href="?Logout=1">Logi välja!</a></li>
	</ul>
	<title>Pealeht</title>
</head>



<body>
	<h2>Põnevad leheküljed</h2><br>
	<p>Normaalne</p>
	
	
</body>
</html>