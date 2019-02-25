<?php
require("database.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
$times= date('Y-m-d H:i:s');
$month = date("m",strtotime($times));
$year = date("Y",strtotime($times));

$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}

/*start*/
$roleUser=$conn->prepare("Select * from register where userName=:userName");
$roleUser->execute([
'userName'=>$loginUsername
]);
$resultRoleUser=$roleUser->fetch(PDO::FETCH_ASSOC);
if($resultRoleUser['role'] !=='Admin'){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
/*end*/

/*start count*/
$searchsql = "SELECT COUNT(*) FROM `transactionpaypal` where status=:status and (complete=:accept or complete=:pending) ";
$searcstmt=$conn->prepare($searchsql);
$searcstmt->execute([
'accept'=>'accept',
'pending'=>'pending',
'status'=>'0'
]);
$count= $searcstmt->fetchColumn(0);
/*end count*/


if($month=='01'){
	$whatMonth='January ';
}
if($month=='02'){
	$whatMonth='February ';
}
if($month=='03'){
	$whatMonth='March ';
}
if($month=='04'){
	$whatMonth='April ';
}
if($month=='05'){
	$whatMonth='May ';
}
if($month=='06'){
	$whatMonth='June';
}
if($month=='07'){
	$whatMonth='July';
}
if($month=='08'){
	$whatMonth='August';
}
if($month=='09'){
	$whatMonth='September';
}
if($month=='10'){
	$whatMonth='October';
}
if($month=='11'){
	$whatMonth='November';
}
if($month=='12'){
	$whatMonth='December';
}






  $totalUser="";
  $totalIntern="";
  $totalCompany="";
  $percentIntern="";
  $percentCompany="";


  $searchsql = "SELECT COUNT(*) FROM `register` ";
  $searcstmt=$conn->prepare($searchsql);
  $searcstmt->execute();
  $totalUser= $searcstmt->fetchColumn(0);
 
  /*<input type=text value=<?= $totalUser?>>*/




  $role="Intern";
  $searchInternsql = "SELECT COUNT(*) FROM `register` where role=:role";
  $searchInternCmd=$conn->prepare($searchInternsql);
  $searchInternCmd->bindParam(':role',$role);
  $searchInternCmd->execute();
  $totalIntern= $searchInternCmd->fetchColumn(0);
  $percentIntern= round((($totalIntern/$totalUser)*100))."%";






  $role="Company";
  $searchCompanysql = "SELECT COUNT(*) FROM `register` where role=:role";
  $searchCompanyCmd=$conn->prepare($searchCompanysql);
  $searchCompanyCmd->bindParam(':role',$role);
  $searchCompanyCmd->execute();
  $totalCompany= $searchCompanyCmd->fetchColumn(0);
  $percentCompany= round((($totalCompany/$totalUser)*100))."%";

$searchsql = "select sum(amount) FROM transactionpaypal WHERE complete=:complete and month=:month and year=:year";
$searcstmt=$conn->prepare($searchsql);
$searcstmt->execute([
'complete'=>'accept',
'year'=>$year,
'month'=>$month
]);
$latestPost= $searcstmt->fetchColumn(0);
if(empty($latestPost)){
	$totalSales="0";
}else{
	$totalSales=$latestPost;
}



   

function searchRecord($input) {
  require("database.php");
  $d = new DateTime();
  $years=$d->format('Y');  
  $searchMonthsql = "SELECT COUNT(*) FROM `register` WHERE YEAR(registerDate)=:year and  MONTH(registerDate) = :months";
  $searchMonthCmd=$conn->prepare($searchMonthsql);
  $searchMonthCmd->bindParam(':year',$years);
  $searchMonthCmd->bindParam(':months',$input);
  $searchMonthCmd->execute();
  $totalJan= $searchMonthCmd->fetchColumn(0);
  return $totalJan;
}



$jan=searchRecord("1");
$feb=searchRecord("2");
$march=searchRecord("3");
$april=searchRecord("4");
$may=searchRecord("5");
$june=searchRecord("6");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
<input type="hidden" name="jan" id="jan" value=<?= $jan?>>
<input type="hidden" name="feb" id="feb" value=<?= $feb?>>
<input type="hidden" name="march" id="march" value=<?= $march?>>
<input type="hidden" name="april" id="april" value=<?= $april?>>
<input type="hidden" name="may" id="may" value=<?= $may?>>
<input type="hidden" name="june" id="june" value=<?= $june?>>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://ijobassistant.com/"><span>iJOBAssistant </span>Admin</a>
				<ul class="user-menu">
					 <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="pointer-events:none;"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?= $loginUsername?> <span class="caret" style="display:none;"></span></a>
            
          </li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
		<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
      <li ><a href="adminProfile.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Profile</a></li>
			<li><a href="missions.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Missions</a></li>
			<li><a href="charts.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
			<li><a href="packageCreate.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Package <?php if($count>0){echo "(".$count.")";}?></a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="register.php"
      target="register.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Register Page</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked desktop computer and mobile"><use xlink:href="#stroked-desktop-computer-and-mobile"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?= $totalUser?></div>
							<div class="text-muted">Total Users</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?= $totalIntern?></div>
							<div class="text-muted">Total Intern</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$totalCompany?></div>
							<div class="text-muted">Total Company</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$totalSales?></div>
							<div class="text-muted">Sales in <?= $whatMonth?></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Register User Overview</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
