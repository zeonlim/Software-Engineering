<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create </title>

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
			<li class="active">
				<a href="packageCreate.php">Create Package</a></li>
			<li>
				<a href="packageOther.php">Other Product</a></li>
			<li>
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
			<div class="form">

			<form id="package" enctype="multipart/form-data" >	
			<input type="hidden" value="<?= $companyID?>" name="companyID" id="companyID">	
			<p class="help-block">
				Fields with <span class="required">*</span> are required.	</p>

			<div class="form-group">
				<label class="control-label required" for="Entry_packageName"> Package Name.<span class="required">*</span></label>
				<input class="form-control" placeholder="Package Name" name="packageName" id="packageName" type="text"/>
				<span id="errorName"></span>
			</div>

			<div class="form-group">
				<label class="control-label required" for="Entry_packagePrice"> Package Price (RM). <span class="required">*</span></label>
				<input class="form-control" placeholder="Package Price" name="packagePrice" id="packagePrice" type="text"/>
				<span id="errorPrice"></span>
			</div>

		
			<div class="form-group">
				<label class="control-label required" for="Entry_limitPost"> Limit Post. <span class="required">*</span></label>
				<input class="form-control" placeholder="Limit Post" name="limitPost" id="limitPost" type="text"/>
				<span id="errorPost"></span>
			</div>

			<div class="form-group">
				<label class="control-label required" for="Entry_packageAdver"> Package Adver. <span class="required">*</span></label>
				<input class="form-control" placeholder="Package Adver" name="packageAdver" id="packageAdver" type="text"/>
				<span id="errorAdver"></span>
			</div>


			<div class="form-group">
				<label class="control-label required" for="Entry_period"> Period. <span class="required">*</span></label><br>
				<select id="period" name="period">
					<option value="" disabled selected>Please select the Date</option>
					<option value="1 Months">1 Months</option>
					<option value="3 Months">3 Months</option>
					<option value="6 Months">6 Months</option>
					<option value="1 Years">1 Years</option>
				</select>
				<span id="errorPeriod"></span>
			</div>
			<div class="form-group">
				<label class="control-label" for="Entry_socialMedia"> Social Media. <span class="required">*</span></label>
				<div class="onoffswitch">
    				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >
   					<label class="onoffswitch-label" for="myonoffswitch">
        			<span class="onoffswitch-inner"></span>
        			<span class="onoffswitch-switch"></span>
    				</label>
				</div>
				<span id="errorSocialMedia"></span>
			</div>
			<div class="form-actions">
					 <button value="create" name="submit" class="btn btn-primary" id="submit" type="submit">Save</button> 
					  <span id="succesMessage"></span> 
			</div>

			</form>
			</div>
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

<script>
  $(document).ready(function(){  
      $('#submit').click(function(){  
            event.preventDefault();
           var packageName = $('#packageName').val();  
           var price = $('#packagePrice').val();  
           var post = $('#limitPost').val();  
           var adver = $('#packageAdver').val();  
           var period = $('#period').val();  
           var socialMedia = $('#myonoffswitch').val();  
           var priceID = document.getElementById('packagePrice');
           var adverID= document.getElementById('packageAdver');
           var postID = document.getElementById('limitPost');
           var numbers = /^[0-9]+$/; 

           var checkBox =document.getElementById("myonoffswitch");
           var checkBoxBanner =document.getElementById("banner");
           if(checkBox.checked == true){
               socialMedia="1";
           }
           else if(checkBox.checked == false){
              socialMedia="0";
           }


         
           if(( priceID.value.match(numbers)==null) ||packageName == '' || price == '' || socialMedia == '' || post == '' || adver == '' || period == null|| ( postID.value.match(numbers)==null) ||( adverID.value.match(numbers)==null)){  
                if(packageName == ''){
                  $('#errorName').html("Package Name is required");  
                }
                if(price == ''){
                  $('#errorPrice').html("Package Price is required");  
                }
                if(socialMedia == ''){
                  $('#errorSocialMedia').html("Social Media is required");  
                }
                 if(packageName == ''){
                  $('#errorName').html("Package Name is required");  
                }
                if(price == ''){
                  $('#errorPrice').html("Package Price is required");  
                }
                if(socialMedia == ''){
                  $('#errorSocialMedia').html("Social Media is required");  
                }
                if(post == ''){
                  $('#errorPost').html("Limit Post is required");  
                }
                if(adver == ''){
                  $('#errorAdver').html("Package Adver is required");  
                }
                if(period == null){
                  $('#errorPeriod').html("Package Period is required");  
                }
                if( priceID.value.match(numbers)==null){
             	  $('#errorPrice').html("Price invalid format");  
        		} 
        		if( postID.value.match(numbers)==null){
             	  $('#errorPost').html("Limit Post invalid format");  
       			 } 
        		if( adverID.value.match(numbers)==null){
            	  $('#errorAdver').html("Package Adver invalid format");  
        		} 
               
           }  
           else  
           {  
                $('#errorLoginUsername').html('');  
                $('#errorLoginPassword').html('');  
                $.ajax({  
                     url:"packageInsertfunction.php",  
                     method:"POST",  
                     data:{ 
                      packageName:packageName, 
                      price:price, 
                      post:post, 
                      adver:adver, 
                      period:period, 
                      socialMedia:socialMedia},  
                     success:function(data){  
                          if((data.trim() == "Adver cannot over than limit post")||(data.trim() == "Package Name are existing")){
            if(data.trim() == "Adver cannot over than limit post"){
                                $('#errorAdver').html("Adver cannot over than limit post");  
                          }
                        if(data.trim() == "Package Name are existing"){
                                $('#errorName').html("Package Name are existing");  
                          }
                      }
                      else{
                         $("#package").trigger("reset");  
                         $('#succesMessage').fadeIn().html(data); 
                         $('#errorName').html("");  
                       $('#errorPrice').html("");
                       $('#errorSocialMedia').html("");  
                       $('#errorPost').html("");  
                       $('#errorAdver').html(""); 
                       $('#errorPeriod').html("");  
 
                          setTimeout(function(){  
                                     $('#succesMessage').fadeOut("Slow");  
                                }, 2000); 
                           
                      }
                     }  
                });  
           }  
      });  
 });  
 </script>

</body>

</html>