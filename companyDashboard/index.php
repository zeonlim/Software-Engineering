<?php
require("database.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
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
$companyDesc=$_POST['companyDesc'];

$searchCompanyDetailsql="SELECT * FROM `company` WHERE companyID=:companyID";
$searchCompanyDetailCmd=$conn->prepare($searchCompanyDetailsql);
$searchCompanyDetailCmd->bindParam(':companyID',$companyID);
$searchCompanyDetailCmd->execute();
$resultCompanyDetailId=$searchCompanyDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultCompanyDetailId)>0){
$companyName=$resultCompanyDetailId['companyName'];
$companyDesc=$resultCompanyDetailId['companyDesc'];
}

$companyLogoCmd=$conn->prepare("Select * from gallery where userID=:userID and type=:type");
$companyLogoCmd->execute([
'userID'=>$companyID,
'type'=>'logo'
]);
$resultLogo=$companyLogoCmd->fetch(PDO::FETCH_ASSOC);
$companyLogo=$resultLogo['picture'];



$companyID=$_SESSION['roleID'];
$informDuedate=$conn->prepare("Select * from packageStatus where companyID=:companyID ORDER BY id DESC");
$informDuedate->execute([
'companyID'=>$companyID
]);
$informDuedate=$informDuedate->fetch(PDO::FETCH_ASSOC);
$duedate=$informDuedate['dueDate'];
$today= date('Y-m-d');



$search=$conn->prepare("SELECT COUNT(*) FROM `packageStatus` WHERE companyID=:companyID AND :today>=dueDate ");
$search->execute([
  'companyID'=>$companyID,
  'today'=>$today
]);
$record= $search->fetchColumn(0);


$startTimeStamp = strtotime($today);
$endTimeStamp = strtotime($duedate);

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  

$numberDays = intval($numberDays);




if($numberDays <=7){
  $informMessage="Your package have left ".$numberDays." day (".$duedate.").";
}
if($today>$duedate){
  $informMessage="Please go subscribe a package";
}




?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Company Profile</title>

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
        
  <?php
  if(!empty($informMessage)){
    echo "<label>Important News: </label>"." ".$informMessage;
  }
  ?>
  <div class="well">
    
    
        
    <div class="row clearfix">
      <div class="col-md-3">
<?php
 echo " <img style='width:100%;' alt='companyLogo' src='../companyDashboard/upload/$companyLogo'> ";

?>
      </div>
      <div class="col-md-9">
        <h2><?= $companyName?></h2>
        <b><?= $companyDesc?></b>       
        <div class="">&nbsp;</div>
        <div class="">
          <a class="btn btn-primary" id="yw0" href="postedit.php">Edit</a>        </div>
      </div>
    </div>
    <hr>
    <div class="row-fluid">
          </div>
  </div>
</div>
    
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
</body>

</html>