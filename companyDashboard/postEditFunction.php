<?php
  require("database.php");
    /*$companyLogo=$_POST['companyLogo'];*/
  $companyID=$_POST['companyID'];
  $companyName=$_POST['companyName'];
  $companyRegNo=$_POST['companyRegNo'];
  $companyEmail=$_POST['companyEmail'];
  $companyContact=$_POST['companyContact'];
  $companyAddress=$_POST['companyAddress'];
  $facebook=$_POST['facebook'];
  $website=$_POST['website'];
  $companyLogo="1";
  $companyDesc=$_POST['companyDesc'];



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["companyLogo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(($_FILES["fileToUpload"]["size"] > 500000)/*||($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" )*/){

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
}
else{
  $check=move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  print_r($check);
  
}







  if(!empty($companyName) and !empty($companyEmail) and !empty($companyContact) and !empty($companyAddress) ){

    $searchsql = "SELECT * FROM `company` WHERE companyID=:companyID";
    $searcstmt=$conn->prepare($searchsql);
    $searcstmt->bindParam(':companyID',$companyID);
    $searcstmt->execute();
    $result=$searcstmt->fetch(PDO::FETCH_ASSOC);

    if(count($result)>0){
      $updateCompanySql = "UPDATE `company` SET `companyName`=:companyName,`companyRegNo`=:companyRegNo,`companyLogo`=:companyLogo,`companyDesc`=:companyDesc,`contact`=:contact,`email`=:email,`address`=:address,`website`=:website,`facebook`=:facebook WHERE companyID=:companyID";
      $updateCompanyCmd=$conn->prepare($updateCompanySql);
      $updateCompanyCmd->bindParam(':companyRegNo',$companyRegNo);
      $updateCompanyCmd->bindParam(':companyName',$companyName);
      $updateCompanyCmd->bindParam(':companyLogo',$companyLogo);
      $updateCompanyCmd->bindParam(':companyDesc',$companyDesc);
      $updateCompanyCmd->bindParam(':email',$companyEmail);
      $updateCompanyCmd->bindParam(':contact',$companyContact);
      $updateCompanyCmd->bindParam(':address',$companyAddress);
      $updateCompanyCmd->bindParam(':website',$website);
      $updateCompanyCmd->bindParam(':facebook',$facebook);
      $updateCompanyCmd->bindParam(':companyID',$companyID);

       if ($updateCompanyCmd->execute() === TRUE) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . $conn->error;
      }
    
     
    }


 

 }



  
?>