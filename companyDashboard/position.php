<?php
require('database.php');
$searchs=$conn->prepare("SELECT * FROM position	order by title asc");
$searchs->execute();
while ($row = $searchs->fetch(PDO::FETCH_ASSOC)){
echo $row['title']."<br/>";

}





$cars = array(
"Senior-Manager",
"Manager",
"Senior-Executive",
"Junior-Executive",
"Fresh-Entry-Level",
"Non-Executive"

);
foreach ($cars as $key => $value) {
$search=$conn->prepare("SELECT * FROM position where title=:title" );
$search->execute([
	'title'=>trim($value),
]);
$row = $search->fetch(PDO::FETCH_ASSOC);
if(lcfirst($row['title'])==lcfirst($value)){
	
}else{
	$store=$conn->prepare("INSERT INTO `position`( `title`) VALUES (:title)");
	$store->execute([
		'title'=>ucwords($value),
	]);
}

}





 ?>