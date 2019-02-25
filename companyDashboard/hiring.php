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

$status=0;
$transactionpaypal=$conn->prepare("Select * from transactionpaypal where userID=:userID and type=:type ORDER BY id DESC");
$transactionpaypal->execute([
'userID'=>$companyID,
'type'=>'package'
]);
$resultPackageDetail=$transactionpaypal->fetch(PDO::FETCH_ASSOC);
if(!empty($resultPackageDetail)){

  if($resultPackageDetail['complete']=='pending'){
    $message="Package approval is pending.";
  }else if($resultPackageDetail['complete']=='cancel'){
    $message="Please subsribe a package before proceed to this page";
    $status=1;
  }else if($resultPackageDetail['complete']=='accept'){
    if($resultPackageDetail['status']=='0'){
      $message="Package approval is pending.";
    }else{
      $packageDetail=$conn->prepare("Select * from packageStatus where companyID=:companyID ORDER BY id DESC");
      $packageDetail->execute([
      'companyID'=>$companyID
      ]);
      $resultPackageDetail=$packageDetail->fetch(PDO::FETCH_ASSOC);
      $recordID=$resultPackageDetail['recordID'];
      $packageStatus=$resultPackageDetail['status'];
      $packageDuedate=$resultPackageDetail['dueDate'];
      $packageSosial=$resultPackageDetail['sosial'];
      $packagePost=$resultPackageDetail['limitPost'];
      $today=date('Y-m-d');
      if($packageDuedate>=$today){
       $searchsql = "SELECT COUNT(*) FROM `post` where recordID=:recordID ";
       $searcstmt=$conn->prepare($searchsql);
       $searcstmt->execute([
        'recordID'=>$recordID
       ]);
       $latestPost= $searcstmt->fetchColumn(0);
       if($latestPost>=$packagePost){
        $message="Post has reach the limit,please subsribe new package";
       }
       else{    
        $message="success"; 
       }


    }else{
      $message="Package is expired,please subsribe a new package";
    }

    }
  }

}else{
  $message="Please subsribe a package before proceed to this page";
  $status=1;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Hiring Requirement</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
<!-- ckeditor -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
        <a class="navbar-brand" href="http://ijobassistant.com/"><span>Ijobassistant</span>Company</a>
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
      <li ><a href="index.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
      <li><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
      <li class="active"><a href="hiringedit.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Hiring Requirement </a></li>
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
    
    
<?php
if($message=="success"){     
   
   $searchRecordID=$conn->prepare("Select * from packageStatus where companyID=:companyID ORDER BY dueDate DESC");
   $searchRecordID->execute([
   'companyID'=>$companyID
   ]);
   $resultRecordID=$searchRecordID->fetch(PDO::FETCH_ASSOC);
   $latestRecordID=$resultRecordID['recordID'];
   $packageAdwords=$resultRecordID['packageAdwords'];


   $searchsql = "SELECT COUNT(*) FROM `post` where recordID=:recordID and adver=:adver";
   $searcstmt=$conn->prepare($searchsql);
   $searcstmt->execute([
         'recordID'=>$recordID,
         'adver'=>'1'
   ]);
   $latestAdver= $searcstmt->fetchColumn(0);
   if($latestAdver>=$packageAdwords){
   }else{      
    
     $adverStatus=$packageAdwords-$latestAdver."/".$packageAdwords;  
      echo "

  <div class='' style='float:right;'>
    <label class='switch'>
   <input type='checkbox' id='on_off' >
    <div class='slider round'></div>
     </label>      
  </div>
  <div class='' style='float:right;font-size:15px;margin-right:3px;padding-top:7px;'>
    <div class='text'>Adver $adverStatus </div>
  </div>

    ";   
   }


  



  echo "
  <div id='main-alert'></div>        <h2></h2>
        <div class='well' style='margin-top:35px;'>
        <div class='form'>
          <form id='hiringForm' > 
  <input type='hidden' value=$companyID name='companyID' id='companyID'>  
  <p class='help-block'>
    Fields with <span class='required'>*</span> are required. </p>
     ";
  echo "
    <div class='form-group'>
      <label class='control-label required' for='Entry_category'> Category <span class='required'>*</span></label>
      <select id='category'>
      <option disabled selected value='empty' disabled></option>
    ";

    $searchs=$conn->prepare("SELECT * FROM jobField order by title asc");
    $searchs->execute();
    while ($row = $searchs->fetch(PDO::FETCH_ASSOC)){
    echo "<option value=".str_replace(' ', '&nbsp;', $row['title']).">".$row['title']."</option>";
    }   
          
      
  echo "
    
    </select><br/>
    <span id='errorIndustry'></span>
    </div>
      ";
    



  echo "
    <div class='form-group'>
      <label class='control-label required' for='Entry_location'>Location <span class='required'>*</span></label>
      <select id='location'>
        <option disabled selected value='empty'></option>
        <option value='Selangor'>Selangor</option>
        <option value='Kuala Lumpur'>Kuala Lumpur</option>
        <option value='Sarawak'>Sarawak</option>
        <option value='Johor'>Johor</option>
        <option value='Penang'>Penang</option>
        <option value='Sabah'>Sabah</option>
        <option value='Perak'>Perak</option>
        <option value='Pahang'>Pahang</option>
        <option value='Negeri Sembilan'>Negeri Sembilan</option>
        <option value='Kedah'>Kedah</option>
        <option value='Malacca'>Malacca</option>
        <option value='Terengganu'>Terengganu</option>
        <option value='Kelantan'>Kelantan</option>
        <option value='Perlis'>Perlis</option>
        <option value='Labuan'>Labuan</option>
      </select>
      <span id='errorLocation'></span>
    </div>
    <div class='form-group'>
      <label class='control-label required' for='Entry_hiringRequirement'> Job Title <span class='required'>*</span></label>
      <input class='form-control' placeholder='Hiring Requirement' name='hiringRequirement' id='hiringRequirement' type='text' >
      <span id='errorHiringRequirement'></span>
    </div>
    <div class='form-group'>
      <label class='control-label' for='Entry_jobDescription'> Job Description <span class='required'>*</span></label>
      <textarea name='editor1' id='editor1' rows='3' cols='80' placeholder='Start with here'>
      </textarea>
      <span id='errorJobDescription'></span>
    </div>
    <div class='form-group'>
      <label class='control-label' for='Entry_salary'> Salary <span class='required'>*RM</span></label>
      <input class='form-control' placeholder='salary' name='salary' id='salary' type='text' >
      <span id='errorSalary'></span>
    </div>
    

    <div class='form-group'>
      <label class='control-label required' for='Entry_workLocation'> Work Address <span class='required'>*</span></label>
      <input class='form-control' placeholder='Work Address' name='workAddress' id='workAddress' type='text' >
      <span id='errorWorkAddress'></span>
    </div>

    <div class='form-group'>
      <label class='control-label required' for='Entry_jobContact'> Contact <span class='required'>*</span></label>
      <input class='form-control' placeholder='Person In-charge Contact' name='jobContact' id='jobContact' type='text'>
      <span id='errorJobContact'></span>
    </div>


    <div class='form-group'>
      <label class='control-label required' for='Entry_jobEmail'> Email <span class='required'>*</span></label>
      <input class='form-control' placeholder='Person In-charge Email' name='jobEmail' id='jobEmail' type='text' >
      <span id='errorJobEmail'></span>
    </div>

    <div class='form-group'>
      <label class='control-label required' for='Entry_workingHour'> Working Hour <span class='required'>*</span></label>
      <input class='form-control' placeholder='Example:9 hour' name='workingHour' id='workingHour' type='text' >
      <span id='errorWorkingHour'></span>
    </div>
    <div class='form-group'>
      <label class='control-label required' for='Entry_dressCode'> Dress Code <span class='required'>*</span></label>
      <input class='form-control' placeholder='Dress Code' name='dressCode' id='dressCode' type='text' >
      <span id='errorDressCode'></span>
    </div>
    <div class='form-group'>
      <label class='control-label' for='Entry_resposible'> Job Resposible <span class='required'>*</span></label>
      <textarea name='resposible' id='resposible' rows='3' cols='80'  placeholder='&bull;&nbsp;Support bullet format'>
      </textarea>
      <span id='errorResposible'></span>
    </div>
    <div class='form-group'>
      <label class='control-label' for='Entry_requirement'> Job Requirement <span class='required'>*</span></label>
      <textarea name='requirement' id='requirement' rows='3' cols='80'  placeholder='&bull;&nbsp;Support bullet format'>
      </textarea>
      <span id='errorRequirement'></span>
    </div>
      <div class='form-actions'>
         <button value='create' name='submit' class='btn btn-primary' id='submitButton' type='submit'>Save</button> 
      </div>
      <span id='succesMessage'></span>
    </div>  <!--/.main-->
    </form>
  ";

}else{
  echo "
  <form id='hiringForm' > 
  <p>$message</p>";
  if($status==1){
    echo "
    <a href='http://ijobassistant.com/companyDashboard/pricing.php'>GO</a>
    ";
  }
  echo "
  </form>
  ";
  
  
}


?>
  

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

<script type="text/javascript">
  function changeProductContent( errro ) {
    return function( e ) {
      console.log(e);
      errro.innerHTML = '';
    }
  }

  var hiringRequirement = document.getElementById( 'hiringRequirement' );
  var errorHiringRequirement = document.getElementById( 'errorHiringRequirement' );

  var salary= document.getElementById( 'salary' );
  var errorSalary = document.getElementById( 'errorSalary' );

  var workAddress = document.getElementById( 'workAddress' );
  var errorWorkAddress = document.getElementById( 'errorWorkAddress' );

  var jobContact = document.getElementById( 'jobContact' );
  var errorJobContact = document.getElementById( 'errorJobContact' );

  var jobEmail = document.getElementById( 'jobEmail' );
  var errorJobEmail = document.getElementById( 'errorJobEmail' );

  var workingHour = document.getElementById( 'workingHour' );
  var errorWorkingHour = document.getElementById( 'errorWorkingHour' );

  var dressCode = document.getElementById( 'dressCode' );
  var errorDressCode = document.getElementById( 'errorDressCode' );


  var location1 = document.getElementById( 'location' );
  var errorLocation = document.getElementById( 'errorLocation' );


  var category = document.getElementById( 'category' );
  var errorIndustry = document.getElementById( 'errorIndustry' );





  

  


  hiringRequirement.addEventListener( 'keypress', changeProductContent( errorHiringRequirement) );
  salary.addEventListener( 'keypress', changeProductContent( errorSalary) );
  workAddress.addEventListener( 'keypress', changeProductContent(errorWorkAddress));
  jobContact.addEventListener( 'keypress', changeProductContent( errorJobContact) );
  workingHour.addEventListener( 'keypress', changeProductContent( errorWorkingHour) );
  jobEmail.addEventListener( 'keypress', changeProductContent( errorJobEmail) );
  dressCode.addEventListener( 'keypress', changeProductContent( errorDressCode) );
  location1.addEventListener( 'change', changeProductContent( errorLocation) );
  category.addEventListener( 'change', changeProductContent( errorIndustry) );
  


  
</script>








<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  CKEDITOR.plugins.addExternal( 'confighelper', 'http://ijobassistant.com/companyDashboard/ckeditor/confighelper/' );
    var config = { extraPlugins: 'confighelper', toolbar:'Basic'};
    CKEDITOR.replace( 'editor1' ,config);
    CKEDITOR.replace( 'resposible' ,config);
    CKEDITOR.replace( 'requirement' ,config);

  CKEDITOR.instances['editor1'].on('instanceReady', function() {
        this.document.on('keyup', function(e){
          var errorJobDescription = document.getElementById( 'errorJobDescription' );

          if(CKEDITOR.instances['editor1'].getData().length > 0){
          errorJobDescription.innerHTML = '';
        }else{
          errorJobDescription.innerHTML = 'Job Description cannot be blank';
        }
        });
  });

  CKEDITOR.instances['resposible'].on('instanceReady', function() {
        this.document.on('keyup', function(e){
          var errorResposible = document.getElementById( 'errorResposible' );

          if(CKEDITOR.instances['resposible'].getData().length > 0){
          errorResposible.innerHTML = '';
        }else{
          errorResposible.innerHTML = 'Job Resposible cannot be blank';
        }
        });
  });

  CKEDITOR.instances['requirement'].on('instanceReady', function() {
        this.document.on('keyup', function(e){
          var errorRequirement = document.getElementById( 'errorRequirement' );

          if(CKEDITOR.instances['requirement'].getData().length > 0){
          errorRequirement.innerHTML = '';
        }else{
          errorRequirement.innerHTML = 'Job Requirement cannot be blank';
        }
        });
  });


</script>

<script>  
$("#submitButton").click(function(e) {
   e.preventDefault();
   var companyID = $('#companyID').val();
   var industry = $('#category').val();  
   var hiringRequirement = $('#hiringRequirement').val();
   var jobDescription = CKEDITOR.instances.editor1.getData();

   var salary = $('#salary').val();
   var locations = $('#location').val();
   var workAddress = $('#workAddress').val();
   var jobContact = $('#jobContact').val();
   var jobEmail = $('#jobEmail').val();
   var workingHour = $('#workingHour').val();
   var dressCode = $('#dressCode').val();
   var resposible = CKEDITOR.instances.resposible.getData();
   var requirement = CKEDITOR.instances.requirement.getData();
   var reg = /^[\+]?[0-9]{2,4}[-]?[0-9]{7,10}$/;
   var number = /^\d+$/;
   var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   var adver='';
   var onOffSwitch =document.getElementById("on_off");

   if(onOffSwitch.checked==false){
    adver="0";
   }else{
    adver="1";
   }




    

  

if((industry==null)||(hiringRequirement=="")||(locations=="")||(workAddress=="")||(!re.test( jobEmail ))||(workingHour=="")||(dressCode=="")||(jobDescription=="")||(resposible=="")||(requirement=="")||(!reg.test( jobContact ))||(!number.test( salary ))){
        if(industry==null){
      $('#errorIndustry').fadeIn().html('Industry cannot be blank');  
    }
    if(hiringRequirement==""){
      $('#errorHiringRequirement').fadeIn().html('Job Title cannot be blank');  
    }
    if ( !number.test( salary ) ) { 
      $('#errorSalary').fadeIn().html('Salary required number format');  
    }
    if(locations==null){
      $('#errorLocation').fadeIn().html('location cannot be blank');  
    }
    if(workAddress==""){
      $('#errorWorkAddress').fadeIn().html('Work Address cannot be blank');  
    }
    if ( !reg.test( jobContact ) ) { 
      $('#errorJobContact').fadeIn().html('Contact Number required number format');  
    }
    if ( !re.test( jobEmail ) ) { 
        $('#errorJobEmail').fadeIn().html('Email format invalid');  
    }
    if(workingHour==""){
      $('#errorWorkingHour').fadeIn().html('Work Hour cannot be blank');  
    }
    if(dressCode==""){
      $('#errorDressCode').fadeIn().html('Dress Code cannot be blank');    
    }
     if(jobDescription==""){
        $('#errorJobDescription').fadeIn().html('Job Description cannot be blank'); 
     }
     if(resposible==""){
        $('#errorResposible').fadeIn().html('Job Resposible cannot be blank');   
     }
     if(requirement==""){
        $('#errorRequirement').fadeIn().html('Job Requirement cannot be blank');  
     }
}else{
      $('#errorIndustry').fadeIn().html('');  
      $('#errorHiringRequirement').fadeIn().html('');  
      $('#errorJobDescription').fadeIn().html('');  
      $('#errorSalary').fadeIn().html(''); 
      $('#errorLocation').fadeIn().html('');  
      $('#errorWorkAddress').fadeIn().html('');  
      $('#errorJobContact').fadeIn().html('');  
      $('#errorJobEmail').fadeIn().html('');  
      $('#errorWorkingHour').fadeIn().html(''); 
      $('#errorDressCode').fadeIn().html(''); 
      $('#errorRequirement').fadeIn().html(''); 
      $('#errorResposible').fadeIn().html(''); 

       $.ajax({  
                     url:"hiringFunction.php",  
                     method:"POST",  
                     data:{
                hiringRequirement:hiringRequirement, 
                jobDescription:jobDescription,
                salary:salary,
                industry:industry,
                jobContact:jobContact,
                jobEmail:jobEmail,
                workingHour:workingHour,
                dressCode:dressCode,
                resposible:resposible,
                requirement:requirement,
                locations:locations,
                workAddress:workAddress,
                adver:adver,
                companyID:companyID
               },  
                     success:function(json){  
                     if(json.successStatus == "Insert record success"){
                            $("#hiringForm").trigger("reset");  
                            $('#succesMessage').fadeIn().html(json.successStatus); 
                              CKEDITOR.instances.editor1.setData("");
                              CKEDITOR.instances.resposible.setData("");
                              CKEDITOR.instances.requirement.setData("");
                            CKEDITOR.instances.editor1.setData(''); 
                     }else if(json.successStatus == "refresh"){
                             CKEDITOR.instances.editor1.setData("");
                              CKEDITOR.instances.resposible.setData("");
                              CKEDITOR.instances.requirement.setData("");
                        $('#succesMessage').fadeIn().html('Insert record success and you have reach the post limit');  
                        setTimeout(function () {
                     window.location.href = "http://ijobassistant.com/companyDashboard/hiring.php"; 
                  }, 4000);
                     }else{
                           $('#succesMessage').fadeIn().html(json.successStatus);  
                     }
                     setTimeout(function(){  
                            $('#succesMessage').fadeOut("Slow");  
                     }, 2000);
                 }  
                });  
}                                         




 
});
</script> 














</body>

</html>