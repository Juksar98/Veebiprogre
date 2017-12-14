<<<<<<< HEAD
<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");
	
	//Kui pole sisseloginud, liigume login lehele
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}		
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
	<header>
	<div class="nav">
		<ul>
		<li><a href="index.php">Pealeht</a></li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Instituudid</a>
			<div class="dropdown-content">
			<a href="digitech.php">Digitehnoloogiate Instituut</a>
			<a href="haridus.php">Haridusteaduste Instituut</a>
			<a href="yhiskond.php">Ühiskonnateaduste Instituut</a>
			</div>
		</li>
		<li><a href="?Logout=1">Logi välja!</a></li>
		</ul>
	</div>
	</header>
	<title>Pealeht</title>
</head>



<body>
	<h2>Digitehnoloogiate instituut</h2><br>
	<select name="aine" onchange="location = this.value;">
	<option value="0" selected="selected">Vali endale sobiv aine..</option>
	<option value="mata.php">Matemaatika</option>
	<option value="inform.php">Informaatika</option>
	<option value="teadus.php">Infoteadus</option>
	</select>
	
	<p>Palun mitte jagada neid väärtuslikke faile kellegagi väljastpoolt kooli!</p>
	
	
	
	
</body>
=======
<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");
	
	//Kui pole sisseloginud, liigume login lehele
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}		
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
	<header>
	<div class="nav">
		<ul>
		<li><a href="index.php">Pealeht</a></li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Instituudid</a>
			<div class="dropdown-content">
			<a href="digitech.php">Digitehnoloogiate Instituut</a>
			<a href="haridus.php">Haridusteaduste Instituut</a>
			<a href="yhiskond.php">Ühiskonnateaduste Instituut</a>
			</div>
		</li>
		<li><a href="?Logout=1">Logi välja!</a></li>
		</ul>
	</div>
	</header>
	<title>Pealeht</title>
</head>



<body>
	<h2>Digitehnoloogiate instituut</h2><br>
	<select name="aine" onchange="location = this.value;">
	<option value="0" selected="selected">Vali endale sobiv aine..</option>
	<option value="mata.php">Matemaatika</option>
	<option value="inform.php">Informaatika</option>
	<option value="teadus.php">Infoteadus</option>
	</select>
	
	<p>Palun mitte jagada neid väärtuslikke faile kellegagi väljastpoolt kooli!</p>
	
	
	
	
</body>
>>>>>>> 99081895e8b1b233b0abf2bcbee05dd34e96e315
</html>