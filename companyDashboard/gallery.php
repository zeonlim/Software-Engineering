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
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>ijobassistant - Gallery</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/datepicker3.css" rel="stylesheet">
      <link href="css/styles.css" rel="stylesheet">
      <link href="gallery.css" rel="stylesheet">
      <!--Icons-->
      <script src="js/lumino.glyphs.js"></script>
      <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
      <style>
         .galleryPic img{
            width: 100%;
            height: auto;
            margin-bottom: 15px;
         }
         .hoverPic:hover:after {
            width: 100%;
            height: 100%;
            content: "Remove";
            position: absolute;
            background: rgba(0,0,0,0.4);
            top: 0;
            left: 0;
            text-align: center;
            padding-top: 25%;
            color: white;
        }
      </style>
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
               <a class="navbar-brand" href="http://ijobassistant.com/"><span>Ijobassistant</span>Company</a>
               <ul class="user-menu">
                  <li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="pointer-events:none;"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?= $loginUsername?> <span class="caret" style="display:none;"></span></a>
						
					</li>
               </ul>
            </div>
         </div>
         <!-- /.container-fluid -->
      </nav>
      <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
         <form role="search">
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Search">
            </div>
         </form>
         <ul class="nav menu">
           <li ><a href="index.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
			<li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
			<li><a href="hiringedit.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Hiring Requirement </a></li>
			<li class="active"><a href="gallery.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Gallery </a></li>
			<li><a href="notification.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Notification <?php if($count>0){echo "(".$count.")";}?></a></li>
         </ul>
      </div>
      <!--/.sidebar-->
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
         <div class="row">
            <ol class="breadcrumb">
               <li>
                  <a href="#">
                     <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                     </svg>
                  </a>
               </li>
               <li class="active">Icons</li>
            </ol>
         </div>
         <!--/.row-->
         <div class="container page-content">
            <div class="row">
               <div class="col-md-12">
                  <div id="main-alert"></div>
                   <form id="uploadLogoForm"  method="post" style="margin-top:15px;margin-bottom:15px;">  
                     <div id="logo"></div>  
                     <div class="col-md-4" align="right">  
                          <label>Upload Max 1 logo</label>  <br/>
                          <span>(recommended size 260px x 260px)</span>
                     </div>  
                     <div class="col-md-4">  
                          <input name="logo[]" type="file"  class="inputLogo" />  
                     </div>  
                     <div class="col-md-4">  
                          <input type="submit" value="Submit" />  
                     </div>  
                     <div style="clear:both"></div>  
                </form>  
<?php
require("database.php");
session_start();
$companyID=$_SESSION['roleID'];
$post=$conn->prepare("Select * from gallery where userID=:userID and type=:type");
$post->execute([
'userID'=>$companyID,
'type'=>'logo'
]);
$stack = array();
while ($row = $post->fetch(PDO::FETCH_ASSOC)){
   array_push($stack, $row['picture']);
}

?>
<div class="row galleryPic">
<div class="col-md-4 hoverPic" value='<?= $stack[0];?>'> 
<?php
if(!empty($stack[0])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[0]'>";
}
?>
</div>
</div>
                 <form id="uploadForm"  method="post" style="margin-top:15px;margin-bottom:15px;">  
                     <div id="gallery"></div>  
                     <div class="col-md-4" align="right">  
                          <label>Upload Max 5 Image</label>  <br/>
                          <span>(recommended size 1600px x 400px)</span>
                     </div>  
                     <div class="col-md-4">  
                          <input name="files[]" type="file" multiple class="inputPicture" />  
                     </div>  
                     <div class="col-md-4">  
                          <input type="submit" value="Submit" />  
                     </div>  
                     <div style="clear:both"></div>  
                </form>  

<?php
require("database.php");
session_start();
$companyID=$_SESSION['roleID'];
$post=$conn->prepare("Select * from gallery where userID=:userID and type=:type");
$post->execute([
'userID'=>$companyID,
'type'=>'pic'
]);
$stack = array();
while ($row = $post->fetch(PDO::FETCH_ASSOC)){
   array_push($stack, $row['picture']);
}

?>
<div class="row galleryPic">
<div class="col-md-4 hoverPic" value='<?= $stack[0];?>'> 
<?php
if(!empty($stack[0])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[0]'>";
}
?>
</div>

<div class="col-md-4 hoverPic" value='<?= $stack[1];?>'> 
<?php
if(!empty($stack[1])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[1]'>";
}
?>
</div>

<div class="col-md-4 hoverPic" value='<?= $stack[2];?>'> 
<?php
if(!empty($stack[2])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[2]'>";
}
?>
</div>                 
</div>



<div class="row galleryPic" >
<div class="col-md-4 hoverPic" value='<?= $stack[3];?>'> 
<?php
if(!empty($stack[3])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[3]'>";
}
?>
</div>
<div class="col-md-4 hoverPic" value='<?= $stack[4];?>'> 
<?php
if(!empty($stack[4])){
   echo " <img class='picClick' src='../companyDashboard/upload/$stack[4]'>";
}
?>
</div>
</div>



               
            
               </div>
            </div>
         </div>
      </div>
      <!--/.main-->
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
      $('#uploadLogoForm').on('submit', function(e){  
           e.preventDefault();  
           var selectPic = $('.inputLogo').val();
           if(selectPic==""){
            alert("Please select image");
           }else{

           $.ajax({  
                url: "uploadLogo.php",  
                type: "POST",  
                data: new FormData(this),  
                contentType: false,  
                processData:false,  
               beforeSend: function() {
                   $('#prog').show();
                   $("#prog").attr('value','0');
                },
                xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                     
                                    $('#prog').text(percentComplete + '%');
                                     $('#prog').val(percentComplete);
                                }
                            }, false);
                            return xhr;
                           
                },
                success: function(data)  
                {  

                  if(data.status=="1"){
                    alert("You have over the limit");
                  }/*else if(data.status=="0"){
                    $("#gallery").html(data.output);  
                     
                  }*/else if(data.status=="2"){
                    var texts="You just can upload "+data.balance+" picture";
                    alert(texts);
                  }else if(data.status=="4"){
                     window.location = "http://ijobassistant.com/companyDashboard/gallery.php";   
                  }else if(data.status=="3"){
                    var text=data.message;
                    alert(text);
                  }
                     
                }  
           });

           } 
      });  
 });  
 </script>
    <script>  
 $(document).ready(function(){  
      $('#uploadForm').on('submit', function(e){  
           e.preventDefault();  
           var selectPic = $('.inputPicture').val();
           if(selectPic==""){
            alert("Please select image");
           }else{

           $.ajax({  
                url: "uploadImage.php",  
                type: "POST",  
                data: new FormData(this),  
                contentType: false,  
                processData:false,  
               beforeSend: function() {
                   $('#prog').show();
                   $("#prog").attr('value','0');
                },
                xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                     
                                    $('#prog').text(percentComplete + '%');
                                     $('#prog').val(percentComplete);
                                }
                            }, false);
                            return xhr;
                           
                },
                success: function(data)  
                {  

                  if(data.status=="1"){
                    alert("You have over the limit");
                  }/*else if(data.status=="0"){
                    $("#gallery").html(data.output);  
                     
                  }*/else if(data.status=="2"){
                    var texts="You just can upload "+data.balance+" picture";
                    alert(texts);
                  }else if(data.status=="4"){
                     window.location = "http://ijobassistant.com/companyDashboard/gallery.php";   
                  }else if(data.status=="3"){
                    var text=data.message;
                    alert(text);
                  }
                     
                }  
           });

           } 
      });  
 });  
 </script>
 <script>
$('.hoverPic').click(function(){
    var pictureLink=this.getAttribute('value');
    var status=0;
        if(pictureLink==""){
            
        }else{
             if (confirm("Are you sure to delete!") == true) {
        status=1;
    } else {
        status=0;
    }
        }
   


    if(status==1){
        $.ajax({  
                     url:"deletePic.php",  
                     method:"POST",  
                     data:{pictureLink:pictureLink},  
                     success:function(data){  
                         if(data.trim()=='success'){
                            window.location = "http://ijobassistant.com/companyDashboard/gallery.php";   
                         }else{
                          alert(data);
                         }

                     }  
        });  
    }

});/*end pic click */
 </script>




   </body>
</html>