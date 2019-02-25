<?php
   require("database.php");
   session_start();
   date_default_timezone_set("Asia/Kuala_Lumpur");
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

   $todayTime=date('Y-m-d H:i:s');


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
      <li class="active"><a href="hiringedit.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Hiring Requirement </a></li>
      <li><a href="gallery.php"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Gallery </a></li>
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
         <div class="main col-sm-9">
            <div id="main-alert"></div>
            <h2></h2>
<?php
   if($message=="success" or $message=="Post has reach the limit,please subsribe new package"){
      $searchRecordID=$conn->prepare("Select * from packageStatus where companyID=:companyID ORDER BY dueDate DESC");
   $searchRecordID->execute([
   'companyID'=>$companyID
   ]);
   $resultRecordID=$searchRecordID->fetch(PDO::FETCH_ASSOC);
   $latestRecordID=$resultRecordID['recordID'];
   $packageAdwords=$resultRecordID['packageAdwords'];
   $limitPost=$resultRecordID['limitPost'];



   $searchsql = "SELECT COUNT(*) FROM `post` where recordID=:recordID ";
   $searcstmt=$conn->prepare($searchsql);
   $searcstmt->execute([
         'recordID'=>$recordID
   ]);
   $latestPost= $searcstmt->fetchColumn(0);
   if($latestPost>=$packagePost){
      $postStatus= "0/".$limitPost; 
      $add=1;

   }else{      
      $postStatus=$limitPost-$latestPost."/".$limitPost;   
   }

   echo "
    <div class='add' style='margin-bottom:10px'>
   ";

   echo "
             Post Limit: $postStatus 
               ";
            if($add==1){
                echo "
                <a class='btn btn-primary' disabled style='margin-left:10px;' id='yw0' href='hiring.php'>Add</a>  
               ";
            }else{
               echo "
                <a class='btn btn-primary' style='margin-left:10px;' id='yw0' href='hiring.php'>Add</a>  
               ";
            }

   echo "
    </div>
   ";


    $viewPost=$conn->prepare("Select * from post where recordID=:recordID ORDER BY id DESC");
         $viewPost->execute([
         'recordID'=>$latestRecordID
         ]);
         while ($row = $viewPost->fetch(PDO::FETCH_ASSOC)){
         $jobTitle = $row['jobTitle'];  
         $recordID = $row['recordID'];
         $link = $row['link'];
         $jobDesc = $row['jobDesc'];
         $salary = $row['salary'];
         $shows = $row['shows'];
         $postid=$row['id'];

         echo "
         <div class='well'>
               <div class='row clearfix'>
                  <div class='col-md-12'>
                   <div class='' style='float:right;'>
                        <label class='switch'>
         ";

         if($shows =='1'){
            echo "
               <input type='checkbox' checked class='on_off' value=$postid>
            ";
         }else{
            echo "
               <input type='checkbox' class='on_off' value=$postid>
            ";
         }
                          
          echo "
                          <div class='slider round'></div>
                        </label>      
                     </div>
                     <h2>$jobTitle</h2>
                     <h4>RM $salary</h4>         
                     <b>$jobDesc</b>  
                     <a class='btn btn-primary' style='margin-left:10px;' id='yw0' href='http://ijobassistant.com/jobDetail.php?recordID=$recordID&link=$link' target='href='http://ijobassistant.com/jobDetail.php?recordID=$recordID&link=$link'>Preview</a> 
                     <input type='hidden' name='post' class='postArray' value=$postid>       
                  </div>
               </div>
               <hr>
               <div class='row-fluid'>
               </div>
            </div>

         ";



          }
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
      $(".on_off").click(function() {
         var postid=this.value;  // Outputs the answer
         $.ajax({  
                     url:"updatePost.php",  
                     method:"POST",  
                     data:{postid:postid},  
                     success:function(data){  
                          if(data.trim()=='fail'){
                           alert('fail');
                          }
                     }  
                }); 
      });/*end on off click*/
      </script>   
   </body>
</html>




