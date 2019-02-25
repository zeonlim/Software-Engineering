<?php
require("database.php");
$applyID=$_POST['applyID'];
$deleteApplyFunction=$conn->prepare("DELETE FROM `apply` WHERE applyID=:applyID");
$deleteApplyFunction->execute([
'applyID'=>$applyID,
]);
if($deleteApplyFunction->execute()==true){
	echo "success";
}else{
	echo "Delete Fail";
}
?>