<?php
  require("database.php");

$internID=$_POST['internID'];
$university=$_POST['university'];
$month=$_POST['month'];
$years=$_POST['years'];
$qualification=$_POST['qualification'];
$location=$_POST['location'];
$study=$_POST['study'];
$major=$_POST['major'];
$grade=$_POST['grade'];
$additionalInformation=$_POST['additionalInformation'];


  
      $insertInternSql = "INSERT INTO `education`(`internID`,`university`, `month`, `years`, `qualification`, `location`, `study`, `major`, `grade`, `additionalInformation`) VALUES (:internID,:university,:month, :years,:qualification,:location,:study,:major,:grade,:additionalInformation)";
      $insertInternCmd=$conn->prepare($insertInternSql);
      $insertInternCmd->bindParam(':internID',$internID);
      $insertInternCmd->bindParam(':university',$university);
      $insertInternCmd->bindParam(':month',$month);
      $insertInternCmd->bindParam(':years',$years);
      $insertInternCmd->bindParam(':qualification',$qualification);
      $insertInternCmd->bindParam(':location',$location);
      $insertInternCmd->bindParam(':study',$study);
      $insertInternCmd->bindParam(':major',$major);
      $insertInternCmd->bindParam(':grade',$grade);
      $insertInternCmd->bindParam(':additionalInformation',$additionalInformation);
      

       if ($insertInternCmd->execute() === TRUE) {
          echo "Insert successfully";
      } else {
          echo "Error Insert: " . $conn->error;
      }
    
     
  


 

 



  
?>