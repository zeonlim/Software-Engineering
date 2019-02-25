<?php
require('database.php');
$searchs=$conn->prepare("SELECT * FROM currency	order by title asc");
$searchs->execute();
while ($row = $searchs->fetch(PDO::FETCH_ASSOC)){
echo $row['title']."<br/>";

}





$cars = array(
"SGD",
"PHP",
"USD",
"INR",
"AUD",
"IDR",
"THB",
"HKD",
"EUR",
"CNY",
"JPY",
"GBP",
"VND",
"BDT",
"NZD"

);
foreach ($cars as $key => $value) {
$search=$conn->prepare("SELECT * FROM currency where title=:title" );
$search->execute([
	'title'=>trim($value),
]);
$row = $search->fetch(PDO::FETCH_ASSOC);
if(lcfirst($row['title'])==lcfirst($value)){
	
}else{
	$store=$conn->prepare("INSERT INTO `currency`( `title`) VALUES (:title)");
	$store->execute([
		'title'=>ucwords($value),
	]);
}

}





 ?>