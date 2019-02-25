<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
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
$companyID=$_SESSION['roleID'];
$searchsql = "SELECT COUNT(*) FROM `apply` where companyID=:companyID ";
$searcstmt=$conn->prepare($searchsql);
$searcstmt->execute([
'companyID'=>$companyID
]);
$count= $searcstmt->fetchColumn(0);
/*end count*/
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}


$companyID=$_SESSION['roleID'];
$companyName=$_POST['companyName'];
$companyRegNo=$_POST['companyRegNo'];
$companyLogo=$_POST['companyLogo'];
$companyDesc=$_POST['companyDesc'];
$companyEmail=$_POST['companyEmail'];
$companyContact=$_POST['companyContact'];
$companyAddress=$_POST['companyAddress'];
$website=$_POST['website'];
$facebook=$_POST['facebook'];


$searchCompanyDetailsql="SELECT * FROM `company` WHERE companyID=:companyID";
$searchCompanyDetailCmd=$conn->prepare($searchCompanyDetailsql);
$searchCompanyDetailCmd->bindParam(':companyID',$companyID);
$searchCompanyDetailCmd->execute();
$resultCompanyDetailId=$searchCompanyDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultCompanyDetailId)>0){
$companyName=$resultCompanyDetailId['companyName'];
$companyLogo=$resultCompanyDetailId['companyLogo'];
$companyRegNo=$resultCompanyDetailId['companyRegNo'];
$companyDesc=$resultCompanyDetailId['companyDesc'];
$companyEmail=$resultCompanyDetailId['email'];
$companyContact=$resultCompanyDetailId['contact'];
$companyAddress=$resultCompanyDetailId['address'];
$website=$resultCompanyDetailId['website'];
$facebook=$resultCompanyDetailId['facebook'];



}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Post</title>

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
        <a class="navbar-brand" href="http://ijobassistant.com/"><span>Ijobassistant</span>Admin</a>
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
      <li class="active"><a href="index.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
      <li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
      <li><a href="hiringedit.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Hiring Requirement </a></li>
      <li><a href="gallery.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Gallery </a></li>
            <li><a href="notification.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Notification <?php if($count>0){echo "(".$count.")";}?></a></li>
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
        
      <div class="well">
  <div class="form">

  <form id="companyProfile" enctype="multipart/form-data" > 
  <input type="hidden" value="<?= $companyID?>" name="companyID" id="companyID">  
  <p class="help-block">
    Fields with <span class="required">*</span> are required. </p>

    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Name <span class="required">*</span></label>
      <input class="form-control" placeholder="Company Name" name="companyName" id="companyName" type="text" value="<?= $companyName?>">
      <span id="errorCompanyName"></span>
    </div>
    <div class="form-group">
      <label class="control-label" for="Entry_registrationNumber">Registration No.*</label>

      <?php
      if(empty($companyRegNo)){
      echo"
      <input class='form-control' placeholder='Registration No.' name='companyRegNo' id='companyRegNo' type='text' >
      ";
      }
      else{
        echo "
        <input class='form-control' disabled placeholder='Registration No.' name='companyRegNo' id='companyRegNo' type='text' value='$companyRegNo'>

        ";
      }
      ?>
      <span id="errorCompanyRegNo"></span>
    </div>

    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Email <span class="required">*</span></label>
      <input class="form-control" placeholder="Email" name="companyEmail" id="companyEmail" type="email" value="<?= $companyEmail?>" disabled>
      <span id="errorCompanyEmail"></span>
    </div>

    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Contact Number <span class="required">*</span></label>
      <input class="form-control" placeholder="Contact Number" name="companyContact" id="companyContact" type="tel" value="<?=$companyContact?>">
      <span id="errorCompanyContact"></span>
    </div>


    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Location <span class="required">*</span></label><input class="form-control" placeholder="Location" name="companyAddress" id="companyAddress" type="text" value="<?=$companyAddress?>">
      <span id="errorCompanyAddress"></span>
    </div>

    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Website </label><input class="form-control" placeholder="Company Website" name="website" id="website" type="text" value="<?=$website?>">
      <span id="errorWebsite"></span>
    </div>

    <div class="form-group">
      <label class="control-label required" for="Entry_name"> Company Facebook </label><input class="form-control" placeholder="Company Facebook" name="facebook" id="facebook" type="text" value="<?=$facebook?>">
      <span id="errorFacebook"></span>
    </div>

    <div class="showNone" style="display:none; ">
    <label for="Entry_logo">Company Logo</label>
    <div id="yw1_canvas" class="photo-file-selector controls-photo">
    <div id="yw1_photo" class="photo" style="position: relative;"></div>
    <input id="ytyw1" type="hidden" value="" name="Entry[logo]">
    <input id="yw1" name="companyLogo" id="companyLogo"  type="file" style="position: fixed; left: -500px;">
    <div class="jquery-filestyle " style="display: inline;">
    <input type="text" style="width:200px" disabled=""> 
    <label for="yw1"><i class="icon-folder-open"></i> <span>Choose file</span></label>
    </div>
    <input name="Entry[logo]" id="Entry_logo" type="hidden"></div>
    <span id="errorCompanyLogo"></span>
    </div>

    <div class="form-group">
      <label class="control-label" for="Entry_companyDescription">Company Description</label><br>
      <textarea name="companyDesc" id="companyDesc" style="resize:none;width:100%;"><?=$companyDesc?></textarea></br>
      <span id="errorCompanyDesc"></span>
      <div class="form-actions">
         <button value="create" name="submit" class="btn btn-primary" id="submit" type="submit">Save</button> 
      </div>
      <span id="companyMessage"></span>
    </div>  <!--/.main-->
    

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
           var companyName = $('#companyName').val();  
           var companyID = $('#companyID').val();  
           var companyRegNo = $('#companyRegNo').val();  
           var companyEmail = $('#companyEmail').val();  
           var companyContact = $('#companyContact').val();  
           var companyAddress = $('#companyAddress').val();  
           var companyLogo = $('#companyLogo').val();  
           var companyDesc = $('#companyDesc').val();  
           var facebook = $('#facebook').val();  
           var website = $('#website').val();  
           /*valid email*/
            var x = document.forms["companyProfile"]["companyEmail"].value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        /*phone*/
           var numbers = /^[0-9]+$/; 
           /*url*/
            var url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;


           if((companyRegNo=='')||( document.getElementById("companyContact").value.match(numbers)==null)||(companyName=='')||(companyContact=='')|| (companyAddress=='') || ( !url.test( facebook ) ) || ( !url.test( website ) ) )  
           {  
 
                if(companyName==''){
                   $('#errorCompanyName').html("Company Name is required");  
                }
                if(companyRegNo==''){
                   $('#errorCompanyRegNo').html("Company Registration No is required");  
                }
                 if(companyContact==''){
                   $('#errorCompanyContact').html("Contact Number is required");  
                }
                if(companyAddress==''){
                   $('#errorCompanyAddress').html("Address is required");  
                }
                 if( document.getElementById("companyContact").value.match(numbers)==null){
            $('#errorCompanyContact').html("Contact Number invalid format");  
          }  
          if ( !url.test( facebook ) ) { 
          $('#errorFacebook').fadeIn().html('Facebook url invalid format');  
        }

        if ( !url.test( website ) ) { 
          $('#errorWebsite').fadeIn().html('Website url invalid format');  
        }
                
              
               
           }  
           else  
           {  
                $('#errorCompanyName').html('');  
                $('#errorCompanyRegNo').html('');  
                $('#errorCompanyEmail').html('');  
                $('#errorCompanyContact').html('');  
                $('#errorCompanyAddress').html('');   
                $('#errorCompanyLogo').html('');   
                $('#errorCompanyDesc').html(''); 

                $.ajax({  
                     url:"postEditFunction.php",  
                     method:"POST",  
                     data:{
                      companyID:companyID, 
                      companyName:companyName, 
                      companyRegNo:companyRegNo,
                      companyEmail:companyEmail,
                      companyContact:companyContact,
                      companyAddress:companyAddress,
                      companyLogo:companyLogo,
                      website:website,
                      facebook:facebook,
                      companyDesc:companyDesc
                     },  
                     success:function(data){  
                          if(data.trim() == "Record updated successfully"){ 
                                $('#companyMessage').fadeIn().html(data);
                                
                          }else{
                               $('#companyMessage').fadeIn().html(data);  
                          }
                            setTimeout(function(){  
                                     $('#companyMessage').fadeOut("Slow");  
                                }, 2000); 
                     }  
                });  
           }  
      });  
 });  
</script>
<script type="text/javascript">
  function changeProductContent( errro ) {
    return function( e ) {
      errro.innerHTML = '';
    }
  }

  var companyName = document.getElementById( 'companyName' );
  var errroCompanyName = document.getElementById( 'errorCompanyName' );
  var companyEmail = document.getElementById( 'companyEmail' );
  var errorCompanyEmail = document.getElementById( 'errorCompanyEmail' );
  var contact = document.getElementById( 'companyContact' );
  var errorContact = document.getElementById( 'errorCompanyContact' );
  var companyAddress = document.getElementById( 'companyAddress' );
  var errorCompanyAddress = document.getElementById( 'errorCompanyAddress' );

  contact.addEventListener( 'keypress', changeProductContent( errorContact) )
  companyName.addEventListener( 'keypress', changeProductContent( errroCompanyName) )
  companyEmail.addEventListener( 'keypress', changeProductContent( errorCompanyEmail) )
  companyAddress.addEventListener( 'keypress', changeProductContent( errorCompanyAddress) )
  
  /*companyContact.addEventListener( 'keypress', changeProductContent( errorCompanyContact) )*/
  
</script>
<script type="text/javascript">
  function changeProductContent( errro ) {
    return function( e ) {
      console.log(e);
      errro.innerHTML = '';
    }
  }

  var companyName = document.getElementById( 'companyName' );
  var errroCompanyName = document.getElementById( 'errroCompanyName' );

  var companyRegNo= document.getElementById( 'companyRegNo' );
  var errorCompanyRegNo = document.getElementById( 'errorCompanyRegNo' );

  var companyEmail = document.getElementById( 'companyEmail' );
  var errorCompanyEmail = document.getElementById( 'errorCompanyEmail' );

  var companyContact = document.getElementById( 'companyContact' );
  var errorCompanyContact = document.getElementById( 'errorCompanyContact' );

  var companyAddress = document.getElementById( 'companyAddress' );
  var errorCompanyAddress = document.getElementById( 'errorCompanyAddress' );

  var website = document.getElementById( 'website' );
  var errorWebsite = document.getElementById( 'errorWebsite' );

  var facebook = document.getElementById( 'facebook' );
  var errorFacebook = document.getElementById( 'errorFacebook' );


  var companyDesc = document.getElementById( 'companyDesc' );
  var errorCompanyDesc = document.getElementById( 'errorCompanyDesc' );





  companyName.addEventListener( 'keypress', changeProductContent( errroCompanyName) );
  companyRegNo.addEventListener( 'keypress', changeProductContent( errorCompanyRegNo) );
  companyEmail.addEventListener( 'keypress', changeProductContent(errorCompanyEmail));
  companyContact.addEventListener( 'keypress', changeProductContent( errorCompanyContact) );
  companyAddress.addEventListener( 'keypress', changeProductContent( errorCompanyAddress) );
  website.addEventListener( 'keypress', changeProductContent( errorWebsite) );
  facebook.addEventListener( 'keypress', changeProductContent( errorFacebook) );
  companyDesc.addEventListener( 'change', changeProductContent( errorCompanyDesc) );

  


  
</script>

</body>

</html>