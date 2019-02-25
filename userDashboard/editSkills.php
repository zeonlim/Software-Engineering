<?php
  require("database.php");

$ids=$_POST['skillsID'];
$skills=$_POST['edit_skills'];
$proficiency=$_POST['edit_Proficiency'];

/*echo $ids.$skills.$proficiency;*/

  $updateInternSql = "UPDATE `skills` SET `skills`=:skills,`proficiency`=:proficiency WHERE id=:id";
      $updateInternCmd=$conn->prepare($updateInternSql);
      $updateInternCmd->bindParam(':skills',$skills);
      $updateInternCmd->bindParam(':proficiency',$proficiency);
      $updateInternCmd->bindParam(':id',$ids);

       if ($updateInternCmd->execute() == TRUE) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . $conn->error;
      }
  /*if(!empty($skills) and !empty($proficiency)){

    $searchsql = "SELECT * FROM `skills` WHERE id=:id";
    $searcstmt=$conn->prepare($searchsql);
    $searcstmt->bindParam(':id',$ids);
    $searcstmt->execute();
    $result=$searcstmt->fetch(PDO::FETCH_ASSOC);

    if(count($result)>0){
      $updateInternSql = "UPDATE `skills` SET `skills`=:skills,`proficiency`=:proficiency WHERE id=:id";
      $updateInternCmd=$conn->prepare($updateInternSql);
      $updateInternCmd->bindParam(':skills',$skills);
      $updateInternCmd->bindParam(':proficiency',$proficiency);
      $updateInternCmd->bindParam(':id',$ids);

       if ($updateInternCmd->execute() === TRUE) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . $conn->error;
      }
    
     
    }


 

 }*/



  
?>