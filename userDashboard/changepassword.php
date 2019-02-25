<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Change Password</title>

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
				<a class="navbar-brand" href="#"><span>Ijobassistant</span> USER</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
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
			<li class="active"><a href="userprofile.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> User Profile</a></li>
			<li><a href="experience.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Experience</a></li>
			<li><a href="education.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Education</a></li>
			<li><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
			<li><a href="language.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Language</a></li>
			<li><a href="uploadresume.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Upload Resume</a></li>	
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="main col-md-9">
			<div id="main-alert"></div>	
			<div class="well">
				<div class="form">

					<form enctype="multipart/form-data" class="form" id="yw0" method="post">	
						<p class="help-block">Fields with <span class="required">*</span> are required.	</p>

					<div class="form-group">
						<label class="control-label required" for="EditProfileForm_oldPassword">Old Password 
							<span class="required">*</span>
						</label>
						<input class="form-control" placeholder="Old Password" name="EditProfileForm[oldPassword]" id="EditProfileForm_oldPassword" type="password">
					</div>

					<div class="form-group">
						<label class="control-label required" for="EditProfileForm_password">Password 
							<span class="required">*</span>
						</label>
						<input class="form-control" placeholder="Password" name="EditProfileForm[password]" id="EditProfileForm_password" type="password">
					</div>

					<div class="form-group">
						<label class="control-label required" for="EditProfileForm_password2">Verify Password 
							<span class="required">*</span>
						</label>
						<input class="form-control" placeholder="Verify Password" name="EditProfileForm[password2]" id="EditProfileForm_password2" type="password">
					</div>

					<div class="form-actions">
						<button value="updateMyProfile" name="submit" class="btn btn-primary" id="yw1" type="submit">Change Password</button> 
						<a class="btn btn-default" id="yw2" href="changepassword.php">Cancel</a>	
					</div>
					</form>	
				</div>
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
</body>

</html>