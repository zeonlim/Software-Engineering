<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - My Subscription</title>

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
				<a class="navbar-brand" href="#"><span>Ijobassistant</span>Company</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
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
			<li><a href="post.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
			<li><a href="notification.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Notification</a></li>
			<li><a href="mysubscription.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> My Subscription</a></li>
			<li><a href="scheduled.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Scheduled</a></li>
			<li class="active"><a href="admincollaborater.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Admin Collaborater</a></li>
			<li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="login.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
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
        
<div id="yw2">
<ul id="yw4" class="nav nav-tabs">
			<li>
				<a href="admincollaborater.php">Manage Collaborator</a></li>
			<li class="active">
				<a href="admincollaboraterrole.php">Manage Role</a></li>
			<li>
				<a href="admincollaboraterpermission.php">Manage Permission</a></li>
		</ul>
<div class="tab-content"><div id="yw2_tab_1" class="tab-pane fade"></div><div id="yw2_tab_2" class="tab-pane fade active in">
<div class="search-form" style="display:none">
	</div>

<div class="row">
	<div class="col-lg-12">

			<div>	<a style="float:right;" class="btn btn-primary" id="yw0" href="newcollaboratorrole.html"><span class="glyphicon glyphicon-plus"></span> New Collaborator Role</a></div>	
			<div>	</div>		
	<div id="settings-grid" class="grid-view">
<table class="items sortable-items table">
<thead>
<tr>
<th class="checkbox-column" id="settings-grid_c0"><input class="select-on-check-all" type="checkbox" value="1" name="settings-grid_c0_all" id="settings-grid_c0_all"></th><th><a>Name</a></th><th class="button-column" id="settings-grid_c2">&nbsp;</th></tr>
<tr class="filters">
<td>&nbsp;</td><td><div class="filter-container"><input class="form-control" name="CollaboratorRoles[name]" id="CollaboratorRoles_name" type="text" maxlength="50"></div></td><td>&nbsp;</td></tr>
</thead>
<tfoot>
<tr><td colspan="3"><div id="egw0" style="position:relative" class="pull-right">&nbsp;<a class="disabled bulk-actions-btn btn btn-default btn-sm" id="bulk_action_0" href="/collaborator/role/batchDelete">Delete Selected</a>&nbsp;<div style="position:absolute;top:0;left:0;height:100%;width:100%;display:block;" class="bulk-actions-blocker"></div></div></td></tr></tfoot>
<tbody>
<tr class="odd"><td class="checkbox-column"><input class="select-on-check" value="15" id="settings-grid_c0_0" type="checkbox" name="settings-grid_c0[]"></td><td>Staft</td><td class="button-column"><a class="update" title="" data-toggle="tooltip" href="updatecollaborator.html" data-original-title="Update"><i class="glyphicon glyphicon-pencil"></i></a> <a class="delete" title="" data-toggle="tooltip" href="/collaborator/role/delete?id=15" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a></td></tr></tbody>
</table>Export to: <a href="?contentId=237968&amp;type=company&amp;exportType=Excel2007&amp;grid_mode=export">Excel(*.xlsx)</a></div>
</div>
</div><div id="yw2_tab_3" class="tab-pane fade"></div></div></div></div>
		
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