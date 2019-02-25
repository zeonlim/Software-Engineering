<?php
  require("database.php");

$internID=$_POST['internID'];
$languages=$_POST['languages'];
$spoken=$_POST['spoken'];
$written=$_POST['written'];


  
      $insertInternSql = "INSERT INTO `languages`(`internID`,`languages`, `spoken`, `written`) VALUES (:internID,:languages,:spoken,:written)";
      $insertInternCmd=$conn->prepare($insertInternSql);
      $insertInternCmd->bindParam(':internID',$internID);
      $insertInternCmd->bindParam(':languages',$languages);
      $insertInternCmd->bindParam(':spoken',$spoken);
      $insertInternCmd->bindParam(':written',$written);

       if ($insertInternCmd->execute() === TRUE) {
          echo "Insert successfully";
      } else {
          echo "Error Insert: " . $conn->error;
      }
    
     
  


 

 



  
?>