<?php
//update transaction paypal to actice the package(status and duedate)
//insert record to the packagestatus to give company create record based on the package

require("database.php");
 date_default_timezone_set("Asia/Kuala_Lumpur");
$message='';
$success=0;
$paymentID=$_POST['paymentID'];
$duedate= date('Y-m-d');
//process
$paymentDetail=$conn->prepare("SELECT * FROM transactionpaypal WHERE paymentID=:paymentID");
$paymentDetail->execute([
		'paymentID'=>$paymentID
]);
$result=$paymentDetail->fetch(PDO::FETCH_ASSOC);
if($result['complete']=='pending'){
	$message='Client payment have not done ,cannot proceed to this stage';
	$success=0;
}elseif($result['complete']=='accept'){
	//get last record id from package status
	//search pacakge detail based on the packageid in the transactionpaypal table

	$packageID=$result['package'];
	$companyID=$result['userID'];


    $sql = "SELECT * FROM packageStatus ORDER BY id DESC LIMIT 1";
	$resulta = $conn->prepare($sql);
	$resulta->execute();
	$row=$resulta->fetch(PDO::FETCH_ASSOC);
	$id=$row["id"]+1;
	$recordID="RID000".$id;


	$packageDetail=$conn->prepare("Select * from package where packageID=:packageID");
	$packageDetail->execute([
	'packageID'=>$packageID
	]);
	$resultPackageDetail=$packageDetail->fetch(PDO::FETCH_ASSOC);
	$post=$resultPackageDetail['limitPost'];
	$adwords=$resultPackageDetail['packageAdwords'];
	$period=$resultPackageDetail['period'];
	$sosial=$resultPackageDetail['facebookStatus'];
	$registerDate = date('Y-m-d');
	$add_days = "";
	$duedate = "";
	if($period=='1 Months'){
	$add_days = 30;
	}elseif ($period=='3 Months') {
	$add_days = 90;
	}elseif ($period=='6 Months') {
	$add_days = 180;
	}elseif ($period=='1 Years') {
	$add_days = 365;
	}
	$duedate = date('Y-m-d',strtotime($registerDate) + (24*3600*$add_days));

	

	$insertPackageStaus=$conn->prepare("
		INSERT INTO `packageStatus`(`recordID`, `registerDate`, `dueDate`, `companyID`, `packageAdwords`, `limitPost`,`status`,`sosial`) VALUES (:recordID,:registerDate,:dueDate,:companyID,:packageAdwords,:limitPost,:status,:sosial)");
	$insertPackageStaus->execute([
		'recordID'=>$recordID,
		'registerDate'=>$registerDate,
		'dueDate'=>$duedate,
		'companyID'=>$companyID,
		'packageAdwords'=>$adwords,
		'status'=>'1',
		'sosial'=>$sosial,
		'limitPost'=>$post
	]);

	$updataTransaction=$conn->prepare("UPDATE `transactionpaypal` SET `status`=:status ,`dueDate`=:dueDate WHERE paymentID=:paymentID");
	$updataTransaction->execute([
		'paymentID'=>$paymentID,
		'status'=>'1',
		'dueDate'=>$duedate
	]);


	if($updataTransaction->execute()===true){
		$message='Approval is success';
		$success=1;
	}else{
		$message='Update is falil';
		$success=0;
	}	
}



$json = array(
	'message' =>$message ,
	'success' =>$success 
);

header('Content-Type: application/json');
echo json_encode($json);

?>