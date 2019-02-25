<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View </title>

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
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Ijobassistant </span> ADMIN</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Admin <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
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
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="missions.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Missions</a></li>
			<li><a href="charts.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
			<li><a href="tables.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
			<li class="active"><a href="packageCreate.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Package</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="register.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Register Page</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Package</h1>
			</div>
		</div><!--/.row-->

		<div class="main col-sm-9">
    
		<div id="main-alert"></div>        <h2></h2>
        	<div class="top-bar">
		<div id="yw3">
		<ul id="yw4" class="nav nav-tabs">
			<li>
				<a href="packageCreate.php">Create Package</a></li>
			<li>
				<a href="packageOther.php">Other Product</a></li>
			<li class="active">
				<a href="packageView.php">View Package</a></li>
			<li>
				<a href="packagePending.php">Transaction</a></li>

		</ul>
		<div class="tab-content"><div id="yw3_tab_1" class="tab-pane fade active in">
		<form class="form" id="yw0" action="/collaborator/default/updateEntryCollaborator?contentId=237968&amp;type=company" method="post">			
		<div class="row">
		</div>
		<script>
		$('.delete').click(function(event) {
			event.preventDefault();
			
			var id = $(this).data('id');
			$(this).siblings('select').attr('disabled', true);
			
			$('#delete_' + id).removeAttr('disabled').val(id);
			$(this).parent('div').addClass('disabled');
			$(this).remove();
		});
		</script>
	
		<div class="row">
		<div id="yw0" class="grid-view">
		<table class="items sortable-items table">
		<thead>
			<tr>
				<th>Package ID</th>
				<th>Package Name</th>
				<th>Package Price</th>
				<th>Limit Post</th>
				<th>Package Adver</th>
				<th>Period</th>
				<th>Social Media</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
require("database.php");
$sql = "SELECT * FROM package ";
$result = $conn->prepare($sql);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$packageID = $row['packageID'];	
$packageName = $row['packageName'];
$price = $row['packagePrice'];
$post = $row['limitPost'];
$adver = $row['packageAdwords'];
$period = $row['period'];
$facebookStatus = $row['facebookStatus'];
$social="";
if($facebookStatus=="0"){
$social="off";
}else if($facebookStatus=="1"){
$social="on";
}
echo "
			<tr>
				<th >$packageID</th>
				<th>$packageName</th>
				<th>$price</th>
				<th>$post</th>
				<th>$adver</th>
				<th>$period </th>
				<th >$social</th>
			</tr>
";



}
?>

			
		</tbody>
		</table>
		

		
		</div>	<!--/.main-->
		</div>

		<div class="row">&nbsp;</div>

		</form></div>

		<div id="yw3_tab_2" class="tab-pane fade"></div><div id="yw3_tab_3" class="tab-pane fade"></div></div></div>	</div>
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
</body>

</html>