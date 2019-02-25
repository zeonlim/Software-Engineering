<?php
require("database.php");
$sql = "SELECT * FROM package ORDER BY id DESC LIMIT 1";
$resulta = $conn->prepare($sql);
$resulta->execute();
$row=$resulta->fetch(PDO::FETCH_ASSOC);
$id=$row["id"]+1;

$packageID="P000".$id;
$packageName=$_POST['packageName'];
$price=$_POST['price'];
$post=$_POST['post'];
$adver=$_POST['adver'];
$period=$_POST['period'];
$status="0";
$socialMediaedia=$_POST['socialMedia'];

if($adver>$post){
	echo"Adver cannot over than limit post";
}
else{
	
	$searchsql = "SELECT * FROM `package` WHERE packageName=:packageName";
	$searcstmt=$conn->prepare($searchsql);
	$searcstmt->bindParam(':packageName',$packageName);
	$searcstmt->execute();
	$result=$searcstmt->fetch(PDO::FETCH_ASSOC);
	if($result==""){
		$insertsql = "INSERT INTO `package`(`packageID`, `packageName`, `packagePrice`, `limitPost`, `packageAdwords`, `period`, `status`, `facebookStatus`) VALUES (:packageID,:packageName,:packagePrice,:limitPost,:packageAdwords,:period,:status,:facebookStatus)";
		$stmt=$conn->prepare($insertsql);
		$stmt->bindParam(':packageID',$packageID);
		$stmt->bindParam(':packageName',$packageName);
		$stmt->bindParam(':packagePrice',$price);
		$stmt->bindParam(':limitPost',$post);
		$stmt->bindParam(':packageAdwords',$adver);
		$stmt->bindParam(':period',$period);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':facebookStatus',$socialMediaedia);
		$stmt->execute();
		echo"Package created success";
	}
	else{
	echo "Package Name are existing";
	}
}












?>