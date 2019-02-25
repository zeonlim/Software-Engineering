<?php
require("database.php");
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");


$jobTitle=$_POST['hiringRequirement'];
$jobDesc=$_POST['jobDescription'];
$salary=$_POST['salary'];
$industry=$_POST['industry'];
$jobContact=$_POST['jobContact'];
$jobEmail=$_POST['jobEmail'];
$workingHour=$_POST['workingHour'];
$dressCode=$_POST['dressCode'];
$resposible=$_POST['resposible'];
$requirement=$_POST['requirement'];
$location=$_POST['locations'];
$workAddress=$_POST['workAddress'];
$companyID=$_POST['companyID'];
$adver=$_POST['adver'];
$times=date('Y-m-d H:i:s');
$hash=md5($times);
$successStatus=$companyID;


/*$insertPost=$conn->prepare("INSERT INTO `post`(`recordID`,`link`, `jobTitle`, `jobDesc`, `salary`, `industry`,`jobContact`,`jobEmail`,`workingHour`,`dressCode`,`requirement`,`responsible`,`location`,`workAddress`,`url`, `sosial`, `status`) VALUES (:recordID,:link,:jobTitle,:jobDesc,:salary,:industry,:jobContact,:jobEmail,:workingHour,:dressCode,:requirement,:resposible,:location,:workAddress,:url,:sosial,:status)");
$success=$insertPost->execute([
  'recordID'=>$jobTitle,
  'link'=>$jobTitle,
  'jobTitle'=>$jobTitle,
  'jobDesc'=>$jobDesc,
  'salary'=>$salary,
  'industry'=>$industry,
  'jobContact'=>$jobContact,
  'jobEmail'=>$jobEmail,
  'workingHour'=>$workingHour,
  'dressCode'=>$dressCode,
  'requirement'=>$requirement,
  'resposible'=>$resposible,
  'location'=>$location,
  'workAddress'=>$workAddress,
  'url'=>$jobTitle,
  'sosial'=>$workAddress,
  'status'=>'0'
]);
if($success===true){
  $successStatus="Insert record success";
}else{
  $successStatus="Insert record fail";
}*/


$packageDetail=$conn->prepare("Select * from packageStatus where companyID=:companyID ORDER BY id DESC");
$packageDetail->execute([
'companyID'=>$companyID
]);
$resultPackageDetail=$packageDetail->fetch(PDO::FETCH_ASSOC);
if(!empty($resultPackageDetail)){
  //Getting variable for checking
  $recordID=$resultPackageDetail['recordID'];
  $packageStatus=$resultPackageDetail['status'];
  $packageDuedate=$resultPackageDetail['dueDate'];
  $packageSosial=$resultPackageDetail['sosial'];
  $packagePost=$resultPackageDetail['limitPost'];
  $today=date('Y-m-d H:i:s');
  $url='http://ijobassistant.com/jobDetail.php?recordID='.$recordID.'&link='.$hash;


  $insertPost=$conn->prepare("INSERT INTO `post`(`recordID`,`link`, `jobTitle`, `jobDesc`, `salary`, `industry`,`jobContact`,`jobEmail`,`workingHour`,`dressCode`,`requirement`,`responsible`,`location`,`workAddress`,`url`, `sosial`, `status`,`adver`, `shows`) VALUES (:recordID,:link,:jobTitle,:jobDesc,:salary,:industry,:jobContact,:jobEmail,:workingHour,:dressCode,:requirement,:resposible,:location,:workAddress,:url,:sosial,:status,:adver,:shows)");
  $success=$insertPost->execute([
    'recordID'=>$recordID,
    'link'=>$hash,
    'jobTitle'=>$jobTitle,
    'jobDesc'=>$jobDesc,
    'salary'=>$salary,
    'industry'=>$industry,
    'jobContact'=>$jobContact,
    'jobEmail'=>$jobEmail,
    'workingHour'=>$workingHour,
    'dressCode'=>$dressCode,
    'requirement'=>$requirement,
    'resposible'=>$resposible,
    'location'=>$location,
    'workAddress'=>$workAddress,
    'url'=>$url,
    'sosial'=>$packageSosial,
    'status'=>'0',
    'adver'=>$adver,
    'shows'=>'1'
  ]);
  if($success===true){
    $successStatus="Insert record success";

    $searchsql = "SELECT COUNT(*) FROM `post` where recordID=:recordID ";
    $searcstmt=$conn->prepare($searchsql);
    $searcstmt->execute([
      'recordID'=>$recordID
     ]);
     $latestPost= $searcstmt->fetchColumn(0);
     if($latestPost>=$packagePost){
      $successStatus="refresh"; 
     }
     else{    
      $successStatus="Insert record success"; 
     }

  }else{
    $successStatus="Insert record fail";
  }
}


$json = array(
  'successStatus' => $successStatus,
  'data' => array()
);

header('Content-Type: application/json');
echo json_encode($json);
?>
