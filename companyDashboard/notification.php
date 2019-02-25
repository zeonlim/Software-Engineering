<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
$companyID=$_SESSION['roleID'];
/*start*/
$roleUser=$conn->prepare("Select * from register where userName=:userName");
$roleUser->execute([
'userName'=>$loginUsername
]);
$resultRoleUser=$roleUser->fetch(PDO::FETCH_ASSOC);
if($resultRoleUser['role'] !=='Company'){
	 echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
/*end*/

/*start count*/
$searchsql = "SELECT COUNT(*) FROM `apply` where companyID=:companyID ";
$searcstmt=$conn->prepare($searchsql);
$searcstmt->execute([
'companyID'=>$companyID
]);
$count= $searcstmt->fetchColumn(0);
/*end count*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Notification</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://ijobassistant.com/"><span>Ijobassistant</span>Company</a>
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
			<li><a href="index.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
			<li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
			<li><a href="hiringedit.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Hiring Requirement </a></li>
			<li><a href="gallery.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Gallery </a></li>
			<li  class="active"><a href="notification.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Notification <?php if($count>0){echo "(".$count.")";}?></a></li>
			
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="main col-sm-9">
    
		<div id="main-alert"></div>        <h2></h2>
        
<div class="row">
	<div class="col-lg-12">
		
	<div id="settings-grid" class="grid-view">
<table class="items sortable-items table">
<thead>
<tr>
<th>Name</th>
<th>Job Title</th>
<th>Message</th>
<th>Apply Date</th>
<th>View</th>
<th>Delete</th>
</thead>
<tbody>
<?php
$searchCount = "SELECT COUNT(*) FROM `apply` where companyID=:companyID ";
$searchCountCmd=$conn->prepare($searchCount);
$searchCountCmd->execute([
'companyID'=>$companyID
]);

$latestPost= $searchCountCmd->fetchColumn(0);
if($latestPost==0){
	echo "<tr><td colspan='6' class='empty'><span class='empty'>No results found.</span></td></tr>";
}else{
$searchsql = "
SELECT * FROM `apply` a
LEFT JOIN intern i
ON a.internID=i.internID
LEFT JOIN post p
ON a.jobID=p.id
where companyID=:companyID ";
$searcstmt=$conn->prepare($searchsql);
$searcstmt->execute([
'companyID'=>$companyID
]);
while ($row = $searcstmt->fetch(PDO::FETCH_ASSOC)){
	$applyID=$row['applyID'];
	$people=$row['internName'];
	$jobTitle=$row['jobTitle'];
	$applyDate=$row['applyDate'];
	$profileURL=$row['profileURL'];
	$jobID=$row['jobID'];
	$message=$row['message'];
	echo "
	<tr>
		<td>$people</td>
		<td>$jobTitle</td>
		<td>$message</td>
		<td>$applyDate</td>
		<td><a href=$profileURL target=$profileURL><button class='viewApply'value=$jobID>GO</button></a></td>
		<td><button class='deleteApply' value=$applyID>Delete</button></td>
	</tr>";
}


}
?>

</tbody>
</table>

</div>	</div>
</div>
</div>
		</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
<script>
$('.deleteApply').click(function(){
    var applyID=this.getAttribute('value');
    $.ajax({  
                     url:"deleteApply.php",  
                     method:"POST",  
                     data:{applyID:applyID},  
                     success:function(data){ 
                     	if(data.trim()=="success"){
                     		window.location="http://ijobassistant.com/companyDashboard/notification.php";
                     	}else{
                     		alert(data.trim());
                     	}
                     }  
        });  
});/*end pic click */
 </script>
</body>

</html>