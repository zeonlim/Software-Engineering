<?php
require ('database.php');
session_start();

$pictureLink=$_POST['pictureLink'];


$deletePic=$conn->prepare("DELETE FROM `gallery` WHERE picture=:picture");
$deletePic->execute([
	'picture'=>$pictureLink
]);

$target_dir = "upload/".$pictureLink;
unlink($target_dir);

if($deletePic->execute()==true){
	echo "success";
}else{
	echo "fail";
}


?>