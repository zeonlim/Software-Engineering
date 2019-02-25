<?php
  require("database.php");

$internID
=$_POST['internIDs'];
$skills=$_POST['skills'];
$proficiency=$_POST['proficiency'];

  
      $insertInternSql = "INSERT INTO `skills`(`internID`,`skills`, `proficiency`) VALUES (:internID,:skills,:proficiency)";
      $insertInternCmd=$conn->prepare($insertInternSql);
      $insertInternCmd->bindParam(':internID',$internID);
      $insertInternCmd->bindParam(':skills',$skills);
      $insertInternCmd->bindParam(':proficiency',$proficiency);

       if ($insertInternCmd->execute() === TRUE) {
          echo "Insert successfully";
      } else {
          echo "Error Insert: " . $conn->error;
      }
    
     
  


 

 



  
?>