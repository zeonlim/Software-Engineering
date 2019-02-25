<?php
require("database.php");
ob_start();
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

$paymentDetail=$conn->prepare("Select * from transactionpaypal where userID=:userID and type=:type order by id desc");
$paymentDetail->execute([
   'userID'=>$_SESSION['roleID'],
   'type'=>'package'
]);
$result=$paymentDetail->fetch(PDO::FETCH_ASSOC);
if ($result['complete']=='pending'){
   header('Location:'.$result['link']);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Pricing</title>

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
         <li ><a href="index.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Company Profile</a></li>
         <li class="active"><a href="pricing.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Pricing </a></li>
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
      
<div class="container page-content">
   <div class="row">
      <div class="col-md-12">
         <div id="main-alert"></div>             
    <!-- Plans -->
    <section id="plans" class="m-t-20">
        
         <ul class="nav nav nav-tabs m-b-20">
            <li class="active"><a href="pricing.php">Job Advertisement</a></li>
            <li class=""><a href="pricingads.php">Extra Post</a></li>
            <li class=""><a href="pricingcredit.php">Extra Adword</a></li>
            <li class=""><a href="valid.php">Extra Valid</a></li>
         </ul>
            <div class="row">
            <?php
require("database.php");
$sql = "SELECT * FROM package where status=:status";
$result = $conn->prepare($sql);
$result->execute([
      'status'=>'package',
]);
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$packageID = $row['packageID'];  
$packageName = $row['packageName'];
$price = $row['packagePrice'];
$post = $row['limitPost'];
$adver = $row['packageAdwords'];
$sosial = $row['facebookStatus'];
$period = $row['period'];

echo "

<!-- item --><div class='col-md-4 text-center'>
          <div class='panel panel-bronze panel-pricing'>
            <div class='panel-heading'>
               <i class='fa fa-trophy'></i>
                    <i class='fa fa-file-text-o'></i>
               <h3>$packageName</h3>
            </div>
            <div class='panel-body text-center'>
               <p><strong>RM <big>$price</big></strong></p>
            </div>
            <ul class='list-group text-center'>
";             
            if($post>0){
               echo "   
               <li class='list-group-item'><i class='fa fa-check'></i>$post job advertisement ($period credit validity)</li>
               "; 
            }
            if($adver >0){
               echo "   
               <li class='list-group-item'><i class='fa fa-check'></i>$adver Adver job advertisement</li>
               "; 
            }
            if($sosial ==0){
               echo "   
               <li class='list-group-item'><i class='fa fa-check'></i>No promote on social media</li>
               "; 
            }else{
              echo "   
               <li class='list-group-item'><i class='fa fa-check'></i>Promote on social media</li>
               "; 
            }
               
echo "            
            </ul>                         
            <div class='panel-footer'>
            <a class='btn btn-lg btn-block btn-bronze' href='http://ijobassistant.com/companyDashboard/paypal/paypal/member/payment.php?packageID=$packageID' data-toggle='modal'>BUY NOW!</a>
            </div>                     
         </div>
         </div><!-- /item -->

"; 
}
?>
            </div>
    </section>
    <!-- /Plans -->     </div>
   </div>
</div>
      </div>   <!--/.main-->
     

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