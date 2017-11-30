<?php


$database = "if17_janross";
require("../../../config.php");

//alustame sessiooni	
session_start();



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