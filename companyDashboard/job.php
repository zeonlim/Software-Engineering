<?php
require('database.php');
$searchs=$conn->prepare("SELECT * FROM jobField	order by title asc");
$searchs->execute();
while ($row = $searchs->fetch(PDO::FETCH_ASSOC)){
echo $row['title']."<br/>";

}





$cars = array(
"Accounting / Audit / Tax Services",
"Advertising / Marketing / Promotion / PR",
"Aerospace / Aviation / Airline",
"Agricultural / Plantation / Poultry / Fisheries",
"Apparel",
"Architectural Services / Interior Designing",
"Arts / Design / Fashion",
"Automobile / Automotive Ancillary / Vehicle",
"Banking / Financial Services",
"BioTechnology / Pharmaceutical / Clinical research",
"Call Center / IT-Enabled Services / BPO",
"Chemical / Fertilizers / Pesticides",
"Computer / Information Technology (Hardware)",
"Computer / Information Technology (Software)",
"Construction / Building / Engineering",
"Consulting (Business Management)",
"Consulting (IT, Science, Engineering  Technical)",
"Consumer Products / FMCG",
"Education",
"Electrical Electronics",
"Entertainment / Media",
"Environment / Health / Safety",
"Exhibitions / Event management / MICE",
"Food Beverage / Catering / Restaurant",
"Gems / Jewellery",
"General Wholesale Trading",
"Government / Defence",
"Grooming / Beauty / Fitness",
"Healthcare / Medical",
"Heavy Industrial / Machinery / Equipment",
"Hotel / Hospitality",
"Human Resources Management / Consulting",
"Insurance",
"Journalism",
"Law / Legal",
"Library / Museum",
"Manufacturing / Production",
"Marine / Aquaculture",
"Mining",
"Non-Profit Organisation / Social Services / NGO",
"Oil / Gas / Petroleum",
"Polymer / Plastic / Rubber / Tyres",
"Printing / Publishing",
"Property / Real Estate",
"Repair Maintenance Services",
"Retail / Merchandise",
"Science Technology",
"Security / Law Enforcement",
"Semiconductor/Wafer Fabrication",
"Sports",
"Stockbroking / Securities",
"Telecommunication",
"Textiles / Garment",
"Tobacco",
"Transportation / Logistics",
"Travel / Tourism",
"Utilities / Power",
"Wood / Fibre / Paper"

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





 ?>