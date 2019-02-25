<?php
require("database.php");
$_GET['paymentID']='PAY-35T92251LL567024HLDMKBZQ';
$_GET['companyID']='zeon';
$paymentID=$_GET['paymentID'];
$companyID=$_GET['companyID'];

$salesDetail=$conn->prepare("Select * from packageStatus where companyID=:companyID");
$salesDetail->execute([
	'companyID'=>$companyID
	]);
$result=$salesDetail->fetch(PDO::FETCH_ASSOC);
if ($result==""){
	echo "empty";
}else{
//Get packageid from transactionpaypal -- package,userID
//Get package detail from package and calculate expired day--- limitPost,packageAdwords,period
//Insert into packageStatus ----- registerDate,duedate,companyID,packageAdwords,limitPost


// transactionpaypal
$salesDetail=$conn->prepare("Select * from transactionpaypal where paymentID=:paymentID");
$salesDetail->execute([
'paymentID'=>$paymentID
]);
$result=$salesDetail->fetch(PDO::FETCH_ASSOC);
$packageID=$result['package'];
$companyID=$result['userID'];

//package
$packageDetail=$conn->prepare("Select * from package where packageID=:packageID");
$packageDetail->execute([
'packageID'=>$packageID
]);
$result=$packageDetail->fetch(PDO::FETCH_ASSOC);
$post=$result['limitPost'];
$adwords=$result['packageAdwords'];
$period=$result['period'];
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

//packageStatus
$store=$conn->prepare("
INSERT INTO `packageStatus`( `registerDate`, `dueDate`, `companyID`, `packageAdwords`, `limitPost`) VALUES (:registerDate,:dueDate,:companyID,:packageAdwords,:limitPost)");
$store->execute([
'registerDate'=>$registerDate,
'dueDate'=>$duedate,
'companyID'=>$companyID,
'packageAdwords'=>$adwords,
'limitPost'=>$post
]);
}









?>
