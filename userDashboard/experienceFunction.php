<?php
  require("database.php");

$internID=$_POST['internID'];
$positionTitle=$_POST['positionTitle'];
$companyName=$_POST['companyName'];
$specialization=$_POST['specialization'];
$role=$_POST['role'];
$country=$_POST['country'];
$industry=$_POST['industry'];
$position=$_POST['position'];
$salary=$_POST['salary'];
$montlySalary=$_POST['montlySalary'];
$experienceDescription=$_POST['experienceDescription'];


  
      $insertinternSql="INSERT INTO `experience`(`internID`, `positionTitle`, `companyName`, `specialization`, `role`, `country`, `industry`, `position`, `salary`, `montlySalary`, `experienceDescription`) VALUES (:internID,:positionTitle,:companyName,:specialization,:role,:country,:industry,:position,:salary,:montlySalary,:experienceDescription)";
      $insertInternCmd=$conn->prepare($insertInternSql);
      $insertInternCmd->bindParam(':internID',$internID);
      $insertInternCmd->bindParam(':positionTitle',$positionTitle);
      $insertInternCmd->bindParam(':companyName',$companyName);
      $insertInternCmd->bindParam(':specialization',$specialization);
      $insertInternCmd->bindParam(':role',$role);
      $insertInternCmd->bindParam(':country',$country);
      $insertInternCmd->bindParam(':industry',$industry);
      $insertInternCmd->bindParam(':position',$position);
      $insertInternCmd->bindParam(':salary',$salary);
      $insertInternCmd->bindParam(':montlySalary',$montlySalary);
      $insertInternCmd->bindParam(':experienceDescription',$experienceDescription);
      

       if ($insertInternCmd->execute() === TRUE) {
          echo "Insert successfully";
      } else {
          echo "Error Insert: " . $conn->error;
      }
    
     
  


 

 



  
?>