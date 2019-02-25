<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
$internID=$_SESSION['roleID'];
$skills=$_POST['skills'];
$id=$_POST['skillsID'];
$proficiency=$_POST['proficiency'];

$searchInternDetailsql="SELECT * FROM `skills` WHERE internID=:internID";
$searchInternDetailCmd=$conn->prepare($searchInternDetailsql);
$searchInternDetailCmd->bindParam(':internID',$internID);
$searchInternDetailCmd->execute();
$resultInternDetailId=$searchInternDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultInternDetailId)>0){
$skills=$resultInternDetailId['skills'];
$proficiency=$resultInternDetailId['proficiency'];
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Skills</title>

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
			<li class="active"><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
			<li><a href="language.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Language</a></li>
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
				<table id="recordData" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="35%">Skills</th>
							<th width="25%">Proficiency</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>

<?php
$sql = "SELECT * FROM skills where internID=:internID ";
$result = $conn->prepare($sql);
$result->bindParam(':internID',$internID);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$skills = $row['skills'];	
$internIDs = $row['internID'];	
$skillsID = $row['id'];	
$proficiency = $row['proficiency'];


echo"

<tr>

							<th width='35%'>$skills<input type='hidden' value=$skillsID name='skills_id' class='skills_id'></th>
							<th width='25%'>$proficiency</th>
							<th width='20%'><button type='button' class='add_button' data-toggle='modal' data-target='#editUserModal' class='btn btn-info btn-lg' data-id=$skillsID>Edit</button></th>
							<th width='20%'>Delete</th>
							
</tr>
";
}
?>
					</thead>
				</table>
				
			</div>
	</div>	<!--/.main-->

</body>

</html>
//Edit	
<div id="editUserModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<div class="modal-body">
					<form id="userProfile" >	
					<input type="hidden" value="<?= $id?>" name="id" id="ids">	
					<p class="help-block">
						Fields with <span class="required">*</span> are required.</p>
					<div class="form-group">
						<label class="control-label required" for="Entry_skills"> Skills <span class="required">*</span></label>
						<input class="form-control" placeholder="Skills" name="editSkills" id="edit_skills" type="text" value="<?= $Skills?>">
						<span id="errorSkills"></span>
					</div>
					<div class="form-group">
						<label class="control-label" for="Entry_proficiency">Proficiency</label>
						<select  class="form-control" name="editProficiency" id="edit_Proficiency" value="<? $proficiency?>">
							<option value="Beginner">Beginner</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Advanced">Advanced</option>
						</select>
						<span id="errorProficiency"></span>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="editAction" id="editAction" class="btn btn-success" value="Update" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</form>
				</div>
			</div>
		</form>
	</div>
</div>

//Add	
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
					<input type="hidden" value="<?= $internID?>" name="internIDs" id="internIDs">	
					<p class="help-block">
						Fields with <span class="required">*</span> are required.</p>
					<div class="form-group">
						<label class="control-label required" for="Entry_skills"> Skills <span class="required">*</span></label>
						<input class="form-control" placeholder="Skills" name="skills" id="skills" type="text" value="<?= $skills?>">
						<span id="errorSkills"></span>
					</div>
					<div class="form-group">
						<label class="control-label" for="Entry_proficiency">Proficiency</label>
						<select  class="form-control" name="proficiency" id="proficiency" value="<?= $proficiency?>">
							<option value="Beginner">Beginner</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Advanced">Advanced</option>
						</select>
						<span id="errorProficiency"></span>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="internIDs" id="internIDs" />
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</form>
				</div>
			</div>
		</form>
	</div>
</div>



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
      $('#action').click(function(event){  
      	event.preventDefault();
           var internIDs = $('#internIDs').val();  
           var skills = $('#skills').val(); 
           var proficiency = $('#proficiency').val();
                  
                $.ajax({  
                     url:"skillsFunction.php",  
                     method:"POST",  
                     data:{
                     	internIDs:internIDs, 
                     	skills:skills, 
                     	proficiency:proficiency,
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

<script>
/*$(document).ready(function() {
 
  $('#editAction').click(function() {
  	 var term = $('.').val();
    alert(term);
  });
});*/

$("#editAction").click(function() {
   var myClass = $('#recordData').closest('tr').find('.skills_id').val();
   alert(myClass);
});
</script> 
<script> 
 $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content').html(''); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click
 	
 		console.log("dfsdf");
    /* $.ajax({
          url: 'getuser.php',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content').html(''); // blank before load.
          $('#dynamic-content').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });*/

    });
});
 </script> 


