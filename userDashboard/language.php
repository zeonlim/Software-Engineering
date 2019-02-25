<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
$internID=$_SESSION['roleID'];
$languages=$_POST['languages'];
$spoken=$_POST['spoken'];
$written=$_POST['written'];




$searchInternDetailsql="SELECT * FROM `languages` WHERE internID=:internID";
$searchInternDetailCmd=$conn->prepare($searchInternDetailsql);
$searchInternDetailCmd->bindParam(':internID',$internID);
$searchInternDetailCmd->execute();
$resultInternDetailId=$searchInternDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultInternDetailId)>0){
$languages=$resultInternDetailId['languages'];
$spoken=$resultInternDetailId['spoken'];
$written=$resultInternDetailId['written'];
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Language</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">



<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

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
			<li><a href="userprofile.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> User Profile</a></li>
			<li><a href="experience.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Experience</a></li>
			<li><a href="education.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Education</a></li>
			<li><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
			<li class="active"><a href="language.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Language</a></li>
			<li><a href="uploadresume.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Upload Resume</a></li>			
		</ul>
	</div><!--/.sidebar-->

	<div class="container box">
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="35%">Language</th>
							<th width="25%">Spoken</th>
							<th width="25%">Written</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>

<?php
$sql = "SELECT * FROM languages where internID=:internID ";
$result = $conn->prepare($sql);
$result->bindParam(':internID',$internID);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$languages = $row['languages'];	
$spoken = $row['spoken'];
$written = $row['written'];

echo"
<tr>
							<th width='35%'>$languages</th>
							<th width='25%'>$spoken</th>
							<th width='25%'>$written</th>
							<th width='10%'>Edit</th>
							<th width='10%'>Delete</th>
</tr>
";
}
?>
					</thead>
				</table>
				
			</div>
	</div>	<!--/.main-->



<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<div class="modal-body">
				<form id="userProfile" >	
				<input type="hidden" value="<?= $internID?>" name="internID" id="internID">	
			<div class="form-group">
				<label class="control-label required" for="Entry_language"> Spoken Languages </label>
				<select class="form-control" id="languages" name="languages" value="<?=$languages?>">
					<option value=""></option>
				
					<option value="Arabic">Arabic</option>
					<option value="Bahasa Indonesia">Bahasa Indonesia</option>
					<option value="Bahasa Malaysia">Bahasa Malaysia</option>
					<option value="Bengali">Bengali</option>
					<option value="Chinese">Chinese</option>
					<option value="Dutch">Dutch</option>
					<option value="English">English</option>
					<option value="Filipino">Filipino</option>
					<option value="French">French</option>
					<option value="German">German</option>
					<option value="Hebrew">Hebrew</option>
					<option value="Hindi">Hindi</option>
					<option value="Italian">Italian</option>
					<option value="Japanese">Japanese</option>
					<option value="Korean">Korean</option>
					<option value="Portuguese">Portuguese</option>
					<option value="Russian">Russian</option>
					<option value="Spanish">Spanish</option>
					<option value="Tamil">Tamil</option>
					<option value="Thai">Thai</option>
					<option value="Vietnamese">Vietnamese</option>
				
				</select>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="Entry_spoken">Spoken</label>
				<select class="form-control" id="spoken" name="spoken" value="<?=$spoken?>">
					<option value=""></option>
						
					<option value="10">10</option>
					<option value="9">9</option>
					<option value="8">8</option>
					<option value="7">7</option>
					<option value="6">6</option>
					<option value="5">5</option>
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
					<option value="0">0</option>
												
				</select>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="Entry_written">Written</label>
				<select class="form-control" id="written" name="written" value="<?=$written?>">
					<option value=""></option>
						
					<option value="10">10</option>
					<option value="9">9</option>
					<option value="8">8</option>
					<option value="7">7</option>
					<option value="6">6</option>
					<option value="5">5</option>
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
					<option value="0">0</option>
												
				</select>
		</div>
				<div class="modal-footer">
					<input type="hidden" name="internID" id="internID" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="addFunction" id="addFunction" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<span id="ss"></span>
				</div>
			</div>
		</form>
	</div>
</div>
	</body>

</html>  

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
      $('#addFunction').click(function(){  
           var internID = $('#internID').val();  
           var languages = $('#languages').val(); 
           var spoken = $('#spoken').val();
           var written = $('#written').val();  
                
                $.ajax({  
                     url:"languagesFunction.php",  
                     method:"POST",  
                     data:{
                     	internID:internID, 
                     	languages:languages, 
                     	spoken:spoken,
                     	written:written
                     },  
                     success:function(data){  
                     	alert(data);
                          if(data.trim() == "yes"){
                                $("#internProfile").trigger("reset");  
                                $('#internMessage').fadeIn().html(data);
                          }else{
                               $('#loginMessage').fadeIn().html(data);  
                          }
                            setTimeout(function(){  
                                     $('#loginMessage').fadeOut("Slow");  
                                }, 2000);
                     }  
                });  
           
              
          
      });  
 });  
 </script>




