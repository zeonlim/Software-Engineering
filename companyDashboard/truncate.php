<?php 
require("database.php");
$transactionpaypal=$conn->prepare("truncate table transactionpaypal");
$transactionpaypal->execute();

$packageStatus=$conn->prepare("truncate table packageStatus");
$packageStatus->execute();

$post=$conn->prepare("truncate table post");
$post->execute();
?>