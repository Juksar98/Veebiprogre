<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");
	
	//Kui pole sisseloginud, liigume login lehele
if(!isset($_SESSION["userId"])){
	session_destroy();
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



<body id="home">
	<br><br><br><br><br><br><br>
	<h1>Teretulemast TLU üliõpilaste kodutööde keskkonda </h1>
	<br>
	<br>
	<div id="home">
	<p>Meie motto: Tudengilt tudengile</p>
	<p>Liiga pikalt on kestnud info maksuvalli taha peitmine, aeg see vabastada. Õppematerjale tuleb veel 21. sajandil osta portaalidest nagu annaabi.ee, et näha teise inimese
	mõttenurka ülesande lahendamisele. Meie aitame astuda sammu lähemale infovabadusele. Lae oma kodutöö meie portaali üles ja vaata, mida teised on välja pakkunud. Vali instituut
	ja näed koheselt mis juba on üleval. Aita rajada tee helgema tuleviku poole!</p>
	</div>
	
</body>
</html>