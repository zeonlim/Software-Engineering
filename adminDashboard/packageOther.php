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
				<a class="navbar-brand" href="#"><span>Ijobassistant</span> ADMIN</a>
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
	        
	<div id="permissions">
	<div id="permissions">
		
	<div id="yw1">
		<ul id="yw4" class="nav nav-tabs">
			<li>
				<a href="packageCreate.php">Create Product</a></li>
			<li class="active">
				<a href="packageOther.php">Other Product</a></li>
			<li>
				<a href="packageView.php">View Package</a></li>
			<li>
				<a href="packagePending.php">Transaction</a></li>
		</ul>
	</div>	
		
	
		<div class="row">
		<div class="form">

		<form id="package" enctype="multipart/form-data" >	
			<input type="hidden" value="<?= $companyID?>" name="companyID" id="companyID">	
			<p class="help-block">
				Fields with <span class="required">*</span> are required.	</p>

		<div class="form-group">
				<label class="control-label required" for="Entry_packageName"> Package Name.<span class="required">*</span></label>
				<input class="form-control" placeholder="Package Name" name="packageName" id="packageName" type="text"/>
				<span id="errorpackageName"></span>
		</div>

		<div class="form-group">
				<label class="control-label required" for="Entry_packagePrice"> Package Price (RM). <span class="required">*</span></label>
				<input class="form-control" placeholder="Package Price" name="packagePrice" id="packagePrice" type="text"/>
				<span id="errorpackagePrice"></span>
		</div>

		<div class="form-group">
				<label class="control-label required" for="Entry_item"> Item. <span class="required">*</span></label></br>
				<select id="items" name="items">
					<option value="selection" disabled selected>Please select type of items</option>
					<option value="limitPost">Limit Post</option>
					<option value="adver">Adver</option>
					<option value="duration">Duration</option>
				</select>
				<span id="errorItems"></span>
		</div>

		<div id="packageQuantity"  style="display:none;">
			<div class="form-group">
				<label class="control-label required" for="Entry_packageQuantity"> Quantity. <span class="required">*</span></label>
				<input class="form-control" placeholder="Package Quantity" name="packageQuantity" id="quantity" type="text"/>
				<span id="errorQuantity"></span>
			</div>
		</div>

		<div id="packagePeriod"  style="display:none;">
			<div class="form-group">
				<label class="control-label required" for="Entry_period"> Period. <span class="required">*</span></label><br>
				<select id="optionPeriod" name="optionPeriod">
					<option value="choice" disabled selected>Please select the Date</option>
					<option value="1 Months">1 Months</option>
					<option value="3 Months">3 Months</option>
					<option value="6 Months">6 Months</option>
					<option value="1 Years">1 Years</option>
				</select>
				<span id="error0ptionPeriod"></span>
			</div>
		</div>
		</br>

		<div class="form-actions">
			<button value="create" name="submit" class="btn btn-primary" id="submit" type="submit">Save</button> 
			<span id="succesMessage"></span> 
		</div>

		</form>
		</div>	<!--/.main-->
		</div>

		<div class="row">&nbsp;</div>

		</form>

	</div>
	</div>
<div id="yw2_tab_3" class="tab-pane fade"></div></div></div></div>
		
		</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
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
           var packagePrice = $('#packagePrice').val();  
           var packageQuantity = $('#packageQuantity').val();  
           var packagePeriod = $('#packagePeriod').val();
           var items = $('#items').val();
           var packagePrice = document.getElementById('packagePrice');
           var quantity = document.getElementById('quantity');
           var optionPeriod = document.getElementById('optionPeriod');
           var numbers = /^[0-9]+$/; 

        
           if(packageName == ''||packagePrice == ''||(packagePrice.value.match(numbers)==null)||items == null||optionPeriod == null||quantity == ''||(quantity.value.match(numbers)==null)) {  
                if(packageName == ''){
                  $('#errorpackageName').html("Package Name is required");  
                }
                if(packagePrice == ''){
                  $('#errorpackagePrice').html("Package Price is required");  
                }
                if(packagePrice.value.match(numbers)==null){
                  $('#errorpackagePrice').html("Price invalid format");  
                }
                if(items == null){
                  $('#errorItems').html("Please select the items");  
                }
                if(optionPeriod.value == 'choice'){
                  $('#error0ptionPeriod').html("Please select the time");  
                }
                if(packageQuantity == ''){
                  $('#errorQuantity').html("Item quantity is required");  
                }
                if(quantity.value.match(numbers)==null){
                  $('#errorQuantity').html("Item quantity invalid format");  
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
                      pkacagePrice:packagePrice, 
                      post:post, 
                      adver:adver, 
                      period:period},  
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
                        $('#errorpackageName').html("");  
                       	$('#errorpackagePrice').html(""); 
                       	$('#errorItems').html("");  
                       	$('#errorQuantity').html(""); 
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

<script type="text/javascript">
	var select = document.getElementById("items");
		select.onchange=function(){
    		if(select.value=="limitPost"){
       			document.getElementById("packageQuantity").style.display="inline";
       			document.getElementById("packagePeriod").style.display="none";
    		}
    		if(select.value=="adver"){
       			document.getElementById("packageQuantity").style.display="inline";
       			document.getElementById("packagePeriod").style.display="none";
    		}
    		if(select.value=="duration"){
       			document.getElementById("packagePeriod").style.display="inline";
       			document.getElementById("packageQuantity").style.display="none";
    		}

}
</script>
</body>

</html>


