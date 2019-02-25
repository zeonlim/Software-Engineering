<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Admin Collaborater</title>

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
        	<div class="top-bar">
		<div id="yw3">
		<ul id="yw4" class="nav nav-tabs">
			<li class="active">
				<a href="admincollaborater.php">Manage Collaborator</a></li>
			<li>
				<a href="admincollaboraterrole.php">Manage Role</a></li>
			<li>
				<a href="admincollaboraterpermission.php">Manage Permission</a></li>
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
			<div class="col-md-12"><label>Add collaborator</label></div>
			<div class="col-md-6 col-xs-9">
			
			<div class="select2-container select2-container-multi" id="s2id_collaborator" style="width: 100%;"><ul class="select2-choices">  <li class="select2-search-field">    <label for="s2id_autogen1" class="select2-offscreen"></label>    <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input select2-default" id="s2id_autogen1" placeholder="" style="width: 375px;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none select2-drop-active">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><input type="hidden" name="collaborator" id="collaborator" tabindex="-1" class="select2-offscreen">		</div>
		</div>
		<div class="row">&nbsp;</div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<button name="submit" class="btn btn-default" id="yw2" type="submit">Submit</button>		</div>
		</div>
		</form></div><div id="yw3_tab_2" class="tab-pane fade"></div><div id="yw3_tab_3" class="tab-pane fade"></div></div></div>	</div>
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