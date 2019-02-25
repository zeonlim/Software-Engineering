<?php
require('database.php');
$cars = array(
"Accounting",
"Pharmaceutical",
"Automotive",
"Government",
"Services",
"Banking",
"Grocery",
"Purchasing",
"Procurement",
"Biotech",
"Health",
"QA",
"Broadcast ",
"Journalism",
"Hotel",
"Hospitality",
"Real Estate",
"Business",
"Research",
"Construction",
"Technology",
"Restaurant",
"Food",
"Consultant",
"Installation",
"Maint",
"Repair",
"Retail",
"Customer",
"Insurance",
"Sales",
"Design",
"Inventory",
"Science",
"Distribution",
"Shipping",
"Legal",
"Trades",
"Education",
"Teaching",
"Strategy",
"Planning",
"Engineering",
"Management",
"Supply",
"Manufacturing",
"Telecommunications",
"Executive",
"Marketing",
"Training",
"Facilities",
"Media",
"Journalism",
"Newspaper",
"Transportation",
"Finance",
"Nonprofit",
"Social",
"Warehouse",
"Franchise"
);
foreach ($cars as $key => $value) {
$search=$conn->prepare("SELECT * FROM jobField where title=:title" );
$search->execute([
	'title'=>trim($value),
]);
$row = $search->fetch(PDO::FETCH_ASSOC);
if(lcfirst($row['title'])==lcfirst($value)){
	
}else{
	$store=$conn->prepare("INSERT INTO `jobField`( `title`) VALUES (:title)");
	$store->execute([
		'title'=>ucwords($value),
	]);
}

}

$searchs=$conn->prepare("SELECT * FROM jobField order by title asc" );
$searchs->execute([
	'title'=>trim($value),
]);
while ($row = $searchs->fetch(PDO::FETCH_ASSOC)){
echo $row['title']."<br/>";
}



 ?>