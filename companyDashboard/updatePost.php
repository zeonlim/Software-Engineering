<?php
require("database.php");
session_start();
$postID=$_POST['postid'];



$searchPost=$conn->prepare("Select * from post where id=:id");
$searchPost->execute([
'id'=>$postID
]);
$result=$searchPost->fetch(PDO::FETCH_ASSOC);
$databaseShow=$result['shows'];

if($databaseShow=='1'){
	$latestShow='0';
}else{
	$latestShow='1';
}



$updataCmd=$conn->prepare("UPDATE post SET shows=:shows WHERE id=:id");
$updataCmd->execute([
'id'=>$postID,
'shows'=>$latestShow
]);

if($updataCmd->execute()===true){
	echo "pass";
}else{
	echo "fail";
}











?>