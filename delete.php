<<<<<<< HEAD
<?php

$filepath =  'matafailid'; // The place the files will be uploaded to.
$path =$filepath;
if(empty($_GET['f']))
  echo error;
  exit();
$file = str_replace(array('/', '..'), '', $_GET['f']);
$filePath = realpath($path.$file);
if($filePath !== FALSE)
  unlink($filePath);



=======
<?php

$filepath =  'matafailid'; // The place the files will be uploaded to.
$path =$filepath;
if(empty($_GET['f']))
  echo error;
  exit();
$file = str_replace(array('/', '..'), '', $_GET['f']);
$filePath = realpath($path.$file);
if($filePath !== FALSE)
  unlink($filePath);



>>>>>>> 99081895e8b1b233b0abf2bcbee05dd34e96e315
?>