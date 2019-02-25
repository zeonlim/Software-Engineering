<?php
  require("database.php");
  echo "here";
  $companyID=$_POST['companyID'];
  $companyEmail=$_POST['companyEmail'];
  $companyFirstName=$_POST['companyFirstName'];
  $companyLastName=$_POST['companyLastName'];
  $companyContact=$_POST['companyContact'];
  $companyAddress=$_POST['companyAddress'];
  $companyPostCode=$_POST['companyPostCode'];
  $companyCountry=$_POST['companyCountry'];

if(!empty($companyEmail) and !empty($companyFirstName) and !empty($companyLastName) and !empty($companyCountry) ){
  /*$updateCompanySql = "UPDATE `company` SET `email`=:email,`firstName`=:firstName,`lastName`=:lastName,`contact`=:contact,`address`=:address,`postCode`=:postCode,`country`=:country WHERE companyID=:companyID";
  $updateCompanyCmd=$conn->prepare($updateCompanySql);
  $updateCompanyCmd->bindParam(':email',$companyEmail);
  $updateCompanyCmd->bindParam(':firstName',$companyFirstName);
  $updateCompanyCmd->bindParam(':lastName',$companyLastName);
  $updateCompanyCmd->bindParam(':contact',$companyContact);
  $updateCompanyCmd->bindParam(':address',$companyAddress);
  $updateCompanyCmd->bindParam(':postCode',$companyPostCode);
  $updateCompanyCmd->bindParam(':country',$companyCountry);
  $updateCompanyCmd->bindParam(':companyID',$companyID);
  $resultUpdate=$updateCompanyCmd->execute();*/
  echo"yes";
 }



  
?>