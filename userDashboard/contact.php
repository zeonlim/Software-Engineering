<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Contact</title>

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
				<a class="navbar-brand" href="http://ijobassistant.com/index.php"><span>Ijobassistant</span> USER</a>
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
			<li><a href="post.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
			<li><a href="notification.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Notification</a></li>
			<li><a href="mysubscription.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> My Subscription</a></li>
			<li><a href="scheduled.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Scheduled</a></li>
			<li><a href="admincollaborater.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Admin Collaborater</a></li>
			<li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
			<li class="active"><a href="contact.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Contact</a></li>			
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="main col-sm-9">
    
			<div id="main-alert"></div><h2></h2>
	        
				<div class="well">
					<div class="form">

						<form id="companyProfile" >	
							<input type="hidden" value="<?= $companyID?>" name="companyID" id="companyID">
							<p class="help-block">
								Fields with <span class="required">*</span> are required.</p>

								<div class="form-group">
									<label class="control-label required" for="Entry_username"> Username <span class="required">*</span></label>
									<input class="form-control" placeholder="Username" name="contactUsername" id="contactUsername" type="text" value="<?= $Username?>">
									<span id="errorContactUsername"></span>
								</div>

								<div class="form-group">
									<label class="control-label" for="Entry_emailaddress">Email address</label>
									<input class="form-control" placeholder="Email address" name="contactEmailaddress" id="contactEmailaddress" type="text" value="<?=$Emailaddress?>">
									<span id="errorContactEmailaddress"></span>
								</div>

								<div class="form-group">
									<label class="control-label required" for="Entry_subject"> Subject <span class="required">*</span></label>
									<input class="form-control" placeholder="Subject" name="contactSubject" id="contactSubject" type="text" value="<?= $Subject?>">
									<span id="errorContactSubject"></span>
								</div>

								<div class="form-group">
									<label class="control-label" for="Entry_message">Message</label></br>
									<textarea name="contactMessage" id="contactMessage"><?=$companyMess?></textarea></br>
									<span id="errorContactMessage"></span>
									<div class="form-actions">
										 <button value="create" name="submit" class="btn btn-primary" id="submit" type="submit">Submit</button><a class="btn btn-default" id="yw4" href="contact.php">Cancel</a>
									</div>
									<span id="companyMessage"></span>
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