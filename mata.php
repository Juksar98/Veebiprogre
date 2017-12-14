<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");
require("classes/failupload.class.php"); 

$target_dir = ("matafailid/");
$target_file = "";
$uploadOk = 1;
$failType = "";
$newFileName = "";

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
	

	//kas vajutati laadimise nuppu
	if(isset($_POST["submit"])) {
		//kas fail on valitud, failinimi olemas
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//fikseerin failinime
			$failType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$target_file = "hmv_" .(microtime(1) * 10000) ."." .$failType;
			
			//Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}
			//pildi laadimine
		if ($uploadOk == 0) {
			$notice .= "Vabandust, pilti ei laetud üles! ";
		} else {
			 $my_folder = "matafailid/";
			copy($_FILES["fileToUpload"]["tmp_name"],$my_folder.$_FILES["fileToUpload"]["name"]);
			echo "Fail üles laaditud.";
			$myFail = new Failupload($_FILES["fileToUpload"]["tmp_name"], $failType);
			$myFail->saveFail($target_dir, $target_file);
			//$myFail->clearFiles();
			
			unset($myFail);
		if ($uploadOk == 1){
			$notice = "";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			$stmt = $mysqli ->prepare("INSERT INTO wpfiles (userid, filename) VALUES (?, ?)");
			echo $mysqli->error;
			$stmt -> bind_param("is", $_SESSION["userId"], $target_file);
			if($stmt->execute()){					
				$notice = "Andmebaasi salvestatud";
				echo $notice;
			} else {
				$notice = "Salvestamisel tekkis viga:" .$stmt->error;
				echo $notice;
			}
		}
	

	}
	}
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
<form action="mata.php"  id="myForm" method="POST" enctype="multipart/form-data">

        Files: <input type="file" id="fileToUpload" name="fileToUpload" multiple>
			<input type="submit" value="Lae üles" name="submit">
        <div id="selectedFiles"></div>

      
		
</form>
	
<?php
echo "Üles laetud failid";
echo "<br /><br />";
$path = "matafailid";
$dh = opendir($path);
$i=1;
while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") {
        echo "<a href='$path/$file'>$file</a>";
		echo "    ";
		echo "<a href='mata.php?remove=$path/$file'>kustuta fail</a><br> <br>";
		if(isset($_GET['remove'])){
			/*$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			$stmt = $mysqli ->prepare("UPDATE wpfiles SET deleted = now() WHERE (userid = ? AND filename='?') ");
			echo $mysqli->error;
			$stmt -> bind_param("is", $_SESSION["userId"], $file);
			if($stmt->execute()){					
				$notice = "Kustutatud";
				echo $notice;  TRA SEE SITT EI TÖÖÖÖÖTAAAAAAAAAA MA EI OSKA SEDA ID-D VÕI FAILINIME LEIDA SEALT NAHHUIII*/ 
			unlink($_GET['remove']);
			header('Location: mata.php');
			}
		$i++;
}
    }
}
closedir($dh);



?>
<p align="center"><a href="digitech.php">Tagasi instituudi lehele</a></p>
<script>
    var selDiv = "";
        
    document.addEventListener("DOMContentLoaded", init, false);
    
    function init() {
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
        
    function handleFileSelect(e) {
        
        if(!e.target.files) return;
        
        selDiv.innerHTML = "";
        
        var files = e.target.files;
        for(var i=0; i<files.length; i++) {
            var f = files[i];
            
            selDiv.innerHTML += f.name + "<br/>";

        }
        
    }
    </script>

</body>
</html>