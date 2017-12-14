<?php
class Failupload {
	/*private $testPrivate;
	public $testPublic;*/
	private $tempFile;
	private $failType;
	private $myTempFail;
	private $myFail;

	
	function __construct($tempFile, $failType){
		/*$this->testPrivate = $x;
		$this->testPublic = "Täitsa avalik asi! ";
		echo $this->testPrivate;*/
		$this->tempFile = $tempFile;
		$this->failType = $failType;
	}
	
	public function saveFail($directory, $fileName){
	$target_file = $directory .$fileName;
	
	if($this->failType == "txt"){
		if(file($this->myFail, $target_file, 5)){
			$notice .= "Fail laeti üles! ";
		} else {
			$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
		}
	}				
	if($this->failType == "doc"){
		if(file($this->myFail, $target_file)){
			$notice .= "Fail laeti üles! ";
		} else {
			$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
		}
	}
	//return $notice;
	}
	
	public function saveOriginal($directory, $fileName){
		$target_dir = $directory .$fileName;
		if (move_uploaded_file($this->tempFile, $target_file)) {
			$notice .= "Originaal fail laeti üles! ";
		} else {
			$notice .= "Vabandust, originaalfaili üleslaadimisel tekkis tõrge! ";
		}
		return $notice;
	}
	
	/*public function clearFiles(){
		imagedestroy ($this->myTempFail);
		imagedestroy ($this->myFail);	
	}*/
	
} 	//class lõppeb

?>