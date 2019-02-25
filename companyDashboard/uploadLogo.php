<?php  
require ('database.php');
session_start();
$userID=$_SESSION['roleID'];
$output = '';  
$status="0";
$balance="";
$message="";
$limit=1;

$search=$conn->prepare("SELECT COUNT(*) FROM `gallery` WHERE userID=:userID and type=:type");
$search->execute([
	'userID'=>$userID,
	'type'=>'logo'
]);
$totalUploadDB= $search->fetchColumn(0);

$totalUpload = count($_FILES['logo']['name']);


if($totalUploadDB<=$limit){
	$balance=$limit-$totalUploadDB;
	if($totalUpload<=$balance){

		if(is_array($_FILES)){
		      foreach ($_FILES['logo']['name'] as $name => $value)  
		      {  
		           $file_name = explode(".", $_FILES['logo']['name'][$name]);  
		           $allowed_ext = array("jpg", "jpeg", "png", "gif");  
		           if(in_array($file_name[1], $allowed_ext))  
		           {  
		                $new_name = md5(rand()) . '.' . $file_name[1];  
		                $sourcePath = $_FILES['logo']['tmp_name'][$name];  
		                $targetPath = "upload/".$new_name;  
		                if(move_uploaded_file($sourcePath, $targetPath))  
		                {  

							$store=$conn->prepare("INSERT INTO `gallery`( `userID`,`picture`,`type`) VALUES (:userID,:picture,:type)");
													$store->execute([
														'userID'=>$userID,
														'picture'=>$new_name,
														'type'=>'logo'
													]);
		                     $status="4";
		           			 $message="success";  
		                }                 
		           }else{
		           	$status="3";
		           	$message="Incorrect format";
		           }          
		      }  
		     
		} 



	}else{
		//cannot uploads
		$status="2";

	}

}else{
	//cannot upload
	$status="1";
}





$json = array(
	'output' => $output,
	'status' => $status,
	'message' => $message,
	'balance' => $balance,
	'data' => array()
);

header('Content-Type: application/json');
echo json_encode($json);


 ?>  