<?php
  require("database.php");

$internID=$_POST['internID'];
$internUsername=$_POST['internUsername'];
$internEmail=$_POST['internEmail'];
$internContactnumber=$_POST['internContactnumber'];
$internAddress=$_POST['internAddress'];
$internPostcode=$_POST['internPostcode'];
$internCountry=$_POST['internCountry'];
$internPassword=$_POST['internPassword'];
$internPassword=md5($internPassword);
$internCPassword=$_POST['internCPassword'];
$internCPassword=md5($internCPassword);


  if(!empty($internUsername) and !empty($internEmail) and !empty($internContactnumber) and !empty($internAddress) and !empty($internPassword) and !empty($internCPassword) and !empty($internCountry) ){

    $searchsql = "SELECT * FROM `intern` WHERE internID=:internID";
    $searcstmt=$conn->prepare($searchsql);
    $searcstmt->bindParam(':internID',$internID);
    $searcstmt->execute();
    $result=$searcstmt->fetch(PDO::FETCH_ASSOC);

    if(count($result)>0){
      $updateInternSql = "UPDATE `intern` SET `internID`=:internID,`internUsername`=:internUsername,`email`=:email,`internAddress`=:internAddress,`internCountry`=:internCountry,`internPassword`=:internPassword,`internCPassword`=:internCPassword,`internContactnumber`=:internContactnumber,`internPostcode`=:internPostcode WHERE internID=:internID";
      $updateInternCmd=$conn->prepare($updateInternSql);
      $updateInternCmd->bindParam(':internPostcode',$internPostcode);
      $updateInternCmd->bindParam(':internUsername',$internUsername);
      $updateInternCmd->bindParam(':internPassword',$internPassword);
      $updateInternCmd->bindParam(':internCPassword',$internCPassword);
      $updateInternCmd->bindParam(':internCountry',$internCountry);
      $updateInternCmd->bindParam(':email',$internEmail);
      $updateInternCmd->bindParam(':internContactnumber',$internContactnumber);
      $updateInternCmd->bindParam(':internAddress',$internAddress);
      $updateInternCmd->bindParam(':internID',$internID);

       if ($updateInternCmd->execute() === TRUE) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . $conn->error;
      }
    
     
    }


 

 }



  
?>