

<?php
//Et pääseks ligi funktsioonidele ja sessionile
require("functions.php");
$notice = "";
require("../../../config.php");
	
if(isset($_POST["saveMessage"])){
	
	if(isset($_POST["sonum"]) and !empty($_POST["sonum"])){
		$notice = saveMsg($_POST["sonum"]);
	}
}
?>

<!DOCTYPE html>
<html>


<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>



<body>
	<h2>Chati nimi</h2>
	<div style="chatbox">
		<div class="chatbox">
		<?php echo listMsg(); ?>
		</div>
	</div>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Text: </label>
		<input name="sonum" type="text">
		<input name="saveMessage" type="submit" value="Saada!">
		<span><?php echo $notice; ?></span>
		
	</form>
	
	
</body>
</html>