<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}


$internID=$_SESSION['roleID'];
$internUsername=$_POST['internUsername'];
$internEmail=$_POST['internEmail'];
$internContactnumber=$_POST['internContactnumber'];
$internAddress=$_POST['internAddress'];
$internPostcode=$_POST['internPostcode'];
$internCountry=$_POST['internCountry'];
$internPassword=$_POST['internPassword'];
$internCPassword=$_POST['internCPassword'];



$searchInternDetailsql="SELECT * FROM `intern` WHERE internID=:internID";
$searchInternDetailCmd=$conn->prepare($searchInternDetailsql);
$searchInternDetailCmd->bindParam(':internID',$internID);
$searchInternDetailCmd->execute();
$resultInternDetailId=$searchInternDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultInternDetailId)>0){
$internUsername=$resultInternDetailId['internUsername'];
$internEmail=$resultInternDetailId['email'];
$internContactnumber=$resultInternDetailId['internContactnumber'];
$internAddress=$resultInternDetailId['internAddress'];
$internPostcode=$resultInternDetailId['internPostcode'];
$internCountry=$resultInternDetailId['internCountry'];
$internPassword=$resultInternDetailId['internPassword'];
$internCPassword=$resultInternDetailId['internCPassword'];

}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - User Profile</title>

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
				<a class="navbar-brand" href="http://ijobassistant.com/index.php"><span>Ijobassistant</span> USER</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?= $loginUsername?> <span class="caret"></span></a>
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
			<li class="active"><a href="userprofile.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> User Profile</a></li>
			<li><a href="experience.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Experience</a></li>
			<li><a href="education.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Education</a></li>
			<li><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
			<li><a href="language.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Language</a></li>
			<li><a href="uploadresume.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Upload Resume</a></li>			
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
<div class="main col-sm-9">
    
		<div id="main-alert"></div>        <h2></h2>
        
			<div class="well">
	<div class="form">

	<form id="userProfile" >	
	<input type="hidden" value="<?= $internID?>" name="internID" id="internID">	
	<p class="help-block">
		Fields with <span class="required">*</span> are required.	</p>

		<div class="form-group">
			<label class="control-label required" > Username <span class="required">*</span></label>
			<input class="form-control" placeholder="Username" name="internUsername" id="internUsername" type="text" value="<?= $internUsername?>">
			<span id="errorUserName"></span>
		</div>
		<div class="form-group">
			<label class="control-label" >Email <span class="required">*</span></label>
			<input class="form-control" placeholder="Email" name="internEmail" id="internEmail" type="text" value="<?=$internEmail?>">
			<span id="errorEmail"></span>
		</div>

		<div class="form-group">
			<label class="control-label required"> Contact Number <span class="required">*</span></label>
			<input class="form-control" placeholder="Contact Number" name="internContactnumber" id="internContactnumber" type="text" value="<?= $internContactnumber?>">
			<span id="errorContactNumber"></span>
		</div>

		<div class="form-group">
			<label class="control-label required"> Address <span class="required">*</span></label>
			<input class="form-control" placeholder="Address" name="internAddress" id="internAddress" type="text" value="<?=$internAddress?>">
			<span id="errorAddress"></span>
		</div>


		<div class="form-group">
			<label class="control-label required"> Post Code </label><input class="form-control" placeholder="Post Code" name="internPostcode" id="internPostcode" type="text" value="<?=$internPostcode?>">
			<span id="errorPostCode"></span>
		</div>

		<div class="form-group">
			<label class="control-label required"> Country <span class="required">*</span></label><select class="form-control" id="internCountry" name="internCountry" value="<?=$internCountry?>">

			<option value="AF">Afghanistan</option>
			<option value="AX">Åland Islands</option>
			<option value="AL">Albania</option>
			<option value="DZ">Algeria</option>
			<option value="AS">American Samoa</option>
			<option value="AD">Andorra</option>
			<option value="AO">Angola</option>
			<option value="AI">Anguilla</option>
			<option value="AQ">Antarctica</option>
			<option value="AG">Antigua and Barbuda</option>
			<option value="AR">Argentina</option>
			<option value="AM">Armenia</option>
			<option value="AW">Aruba</option>
			<option value="AU">Australia</option>
			<option value="AT">Austria</option>
			<option value="AZ">Azerbaijan</option>
			<option value="BS">Bahamas</option>
			<option value="BH">Bahrain</option>
			<option value="BD">Bangladesh</option>
			<option value="BB">Barbados</option>
			<option value="BY">Belarus</option>
			<option value="BE">Belgium</option>
			<option value="BZ">Belize</option>
			<option value="BJ">Benin</option>
			<option value="BM">Bermuda</option>
			<option value="BT">Bhutan</option>
			<option value="BO">Bolivia, Plurinational State of</option>
			<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
			<option value="BA">Bosnia and Herzegovina</option>
			<option value="BW">Botswana</option>
			<option value="BV">Bouvet Island</option>
			<option value="BR">Brazil</option>
			<option value="IO">British Indian Ocean Territory</option>
			<option value="BN">Brunei Darussalam</option>
			<option value="BG">Bulgaria</option>
			<option value="BF">Burkina Faso</option>
			<option value="BI">Burundi</option>
			<option value="KH">Cambodia</option>
			<option value="CM">Cameroon</option>
			<option value="CA">Canada</option>
			<option value="CV">Cape Verde</option>
			<option value="KY">Cayman Islands</option>
			<option value="CF">Central African Republic</option>
			<option value="TD">Chad</option>
			<option value="CL">Chile</option>
			<option value="CN">China</option>
			<option value="CX">Christmas Island</option>
			<option value="CC">Cocos (Keeling) Islands</option>
			<option value="CO">Colombia</option>
			<option value="KM">Comoros</option>
			<option value="CG">Congo</option>
			<option value="CD">Congo, the Democratic Republic of the</option>
			<option value="CK">Cook Islands</option>
			<option value="CR">Costa Rica</option>
			<option value="CI">Côte d'Ivoire</option>
			<option value="HR">Croatia</option>
			<option value="CU">Cuba</option>
			<option value="CW">Curaçao</option>
			<option value="CY">Cyprus</option>
			<option value="CZ">Czech Republic</option>
			<option value="DK">Denmark</option>
			<option value="DJ">Djibouti</option>
			<option value="DM">Dominica</option>
			<option value="DO">Dominican Republic</option>
			<option value="EC">Ecuador</option>
			<option value="EG">Egypt</option>
			<option value="SV">El Salvador</option>
			<option value="GQ">Equatorial Guinea</option>
			<option value="ER">Eritrea</option>
			<option value="EE">Estonia</option>
			<option value="ET">Ethiopia</option>
			<option value="FK">Falkland Islands (Malvinas)</option>
			<option value="FO">Faroe Islands</option>
			<option value="FJ">Fiji</option>
			<option value="FI">Finland</option>
			<option value="FR">France</option>
			<option value="GF">French Guiana</option>
			<option value="PF">French Polynesia</option>
			<option value="TF">French Southern Territories</option>
			<option value="GA">Gabon</option>
			<option value="GM">Gambia</option>
			<option value="GE">Georgia</option>
			<option value="DE">Germany</option>
			<option value="GH">Ghana</option>
			<option value="GI">Gibraltar</option>
			<option value="GR">Greece</option>
			<option value="GL">Greenland</option>
			<option value="GD">Grenada</option>
			<option value="GP">Guadeloupe</option>
			<option value="GU">Guam</option>
			<option value="GT">Guatemala</option>
			<option value="GG">Guernsey</option>
			<option value="GN">Guinea</option>
			<option value="GW">Guinea-Bissau</option>
			<option value="GY">Guyana</option>
			<option value="HT">Haiti</option>
			<option value="HM">Heard Island and McDonald Islands</option>
			<option value="VA">Holy See (Vatican City State)</option>
			<option value="HN">Honduras</option>
			<option value="HK">Hong Kong</option>
			<option value="HU">Hungary</option>
			<option value="IS">Iceland</option>
			<option value="IN">India</option>
			<option value="ID">Indonesia</option>
			<option value="IR">Iran, Islamic Republic of</option>
			<option value="IQ">Iraq</option>
			<option value="IE">Ireland</option>
			<option value="IM">Isle of Man</option>
			<option value="IL">Israel</option>
			<option value="IT">Italy</option>
			<option value="JM">Jamaica</option>
			<option value="JP">Japan</option>
			<option value="JE">Jersey</option>
			<option value="JO">Jordan</option>
			<option value="KZ">Kazakhstan</option>
			<option value="KE">Kenya</option>
			<option value="KI">Kiribati</option>
			<option value="KP">Korea, Democratic People's Republic of</option>
			<option value="KR">Korea, Republic of</option>
			<option value="KW">Kuwait</option>
			<option value="KG">Kyrgyzstan</option>
			<option value="LA">Lao People's Democratic Republic</option>
			<option value="LV">Latvia</option>
			<option value="LB">Lebanon</option>
			<option value="LS">Lesotho</option>
			<option value="LR">Liberia</option>
			<option value="LY">Libya</option>
			<option value="LI">Liechtenstein</option>
			<option value="LT">Lithuania</option>
			<option value="LU">Luxembourg</option>
			<option value="MO">Macao</option>
			<option value="MK">Macedonia, the former Yugoslav Republic of</option>
			<option value="MG">Madagascar</option>
			<option value="MW">Malawi</option>
			<option value="MY">Malaysia</option>
			<option value="MV">Maldives</option>
			<option value="ML">Mali</option>
			<option value="MT">Malta</option>
			<option value="MH">Marshall Islands</option>
			<option value="MQ">Martinique</option>
			<option value="MR">Mauritania</option>
			<option value="MU">Mauritius</option>
			<option value="YT">Mayotte</option>
			<option value="MX">Mexico</option>
			<option value="FM">Micronesia, Federated States of</option>
			<option value="MD">Moldova, Republic of</option>
			<option value="MC">Monaco</option>
			<option value="MN">Mongolia</option>
			<option value="ME">Montenegro</option>
			<option value="MS">Montserrat</option>
			<option value="MA">Morocco</option>
			<option value="MZ">Mozambique</option>
			<option value="MM">Myanmar</option>
			<option value="NA">Namibia</option>
			<option value="NR">Nauru</option>
			<option value="NP">Nepal</option>
			<option value="NL">Netherlands</option>
			<option value="NC">New Caledonia</option>
			<option value="NZ">New Zealand</option>
			<option value="NI">Nicaragua</option>
			<option value="NE">Niger</option>
			<option value="NG">Nigeria</option>
			<option value="NU">Niue</option>
			<option value="NF">Norfolk Island</option>
			<option value="MP">Northern Mariana Islands</option>
			<option value="NO">Norway</option>
			<option value="OM">Oman</option>
			<option value="PK">Pakistan</option>
			<option value="PW">Palau</option>
			<option value="PS">Palestinian Territory, Occupied</option>
			<option value="PA">Panama</option>
			<option value="PG">Papua New Guinea</option>
			<option value="PY">Paraguay</option>
			<option value="PE">Peru</option>
			<option value="PH">Philippines</option>
			<option value="PN">Pitcairn</option>
			<option value="PL">Poland</option>
			<option value="PT">Portugal</option>
			<option value="PR">Puerto Rico</option>
			<option value="QA">Qatar</option>
			<option value="RE">Réunion</option>
			<option value="RO">Romania</option>
			<option value="RU">Russian Federation</option>
			<option value="RW">Rwanda</option>
			<option value="BL">Saint Barthélemy</option>
			<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
			<option value="KN">Saint Kitts and Nevis</option>
			<option value="LC">Saint Lucia</option>
			<option value="MF">Saint Martin (French part)</option>
			<option value="PM">Saint Pierre and Miquelon</option>
			<option value="VC">Saint Vincent and the Grenadines</option>
			<option value="WS">Samoa</option>
			<option value="SM">San Marino</option>
			<option value="ST">Sao Tome and Principe</option>
			<option value="SA">Saudi Arabia</option>
			<option value="SN">Senegal</option>
			<option value="RS">Serbia</option>
			<option value="SC">Seychelles</option>
			<option value="SL">Sierra Leone</option>
			<option value="SG">Singapore</option>
			<option value="SX">Sint Maarten (Dutch part)</option>
			<option value="SK">Slovakia</option>
			<option value="SI">Slovenia</option>
			<option value="SB">Solomon Islands</option>
			<option value="SO">Somalia</option>
			<option value="ZA">South Africa</option>
			<option value="GS">South Georgia and the South Sandwich Islands</option>
			<option value="SS">South Sudan</option>
			<option value="ES">Spain</option>
			<option value="LK">Sri Lanka</option>
			<option value="SD">Sudan</option>
			<option value="SR">Suriname</option>
			<option value="SJ">Svalbard and Jan Mayen</option>
			<option value="SZ">Swaziland</option>
			<option value="SE">Sweden</option>
			<option value="CH">Switzerland</option>
			<option value="SY">Syrian Arab Republic</option>
			<option value="TW">Taiwan, Province of China</option>
			<option value="TJ">Tajikistan</option>
			<option value="TZ">Tanzania, United Republic of</option>
			<option value="TH">Thailand</option>
			<option value="TL">Timor-Leste</option>
			<option value="TG">Togo</option>
			<option value="TK">Tokelau</option>
			<option value="TO">Tonga</option>
			<option value="TT">Trinidad and Tobago</option>
			<option value="TN">Tunisia</option>
			<option value="TR">Turkey</option>
			<option value="TM">Turkmenistan</option>
			<option value="TC">Turks and Caicos Islands</option>
			<option value="TV">Tuvalu</option>
			<option value="UG">Uganda</option>
			<option value="UA">Ukraine</option>
			<option value="AE">United Arab Emirates</option>
			<option value="GB">United Kingdom</option>
			<option value="US">United States</option>
			<option value="UM">United States Minor Outlying Islands</option>
			<option value="UY">Uruguay</option>
			<option value="UZ">Uzbekistan</option>
			<option value="VU">Vanuatu</option>
			<option value="VE">Venezuela, Bolivarian Republic of</option>
			<option value="VN">Viet Nam</option>
			<option value="VG">Virgin Islands, British</option>
			<option value="VI">Virgin Islands, U.S.</option>
			<option value="WF">Wallis and Futuna</option>
			<option value="EH">Western Sahara</option>
			<option value="YE">Yemen</option>
			<option value="ZM">Zambia</option>
			<option value="ZW">Zimbabwe</option>
		</select>
			<span id="errorCountry"></span>
		</div>

		<div class="form-group">
			<label class="control-label required"> Password <span class="required">*</span></label><input class="form-control" placeholder="Password" name="internPassword" id="internPassword" type="password" value="<?=$internPassword?>">
			<span id="errorPassword"></span>
		</div>

		<div class="form-group">
			<label class="control-label required"> Confirm Password <span class="required">*</span></label><input class="form-control" placeholder="Confirm Password" name="internCPassword" id="internCPassword" type="password" value="<?=$internCPassword?>">
			<span id="errorCPassword"></span>
		</div>

		<div class="form-actions">
				 <button value="create" name="submit" class="btn btn-primary" id="submit" type="submit" > Save </button>
				 <button value="create" class="btn btn-primary" href="userprofile.php"> Cancel</button>	
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
           var internUsername = $('#internUsername').val();  
           var internID = $('#internID').val();  
           var internPassword = $('#internPassword').val(); 
           var internCPassword = $('#internCPassword').val();
           var internEmail = $('#internEmail').val();  
           var internContactnumber = $('#internContactnumber').val();  
           var internAddress = $('#internAddress').val();  
           var internCountry = $('#internCountry').val();  
           var internPostcode = $('#internPostcode').val();  
           if((internUsername=='')||(internEmail=='')||(internContactnumber=='')||(internCountry=='')|| (internAddress=='')|| (internPassword=='')|| (internCPassword==''))  
           {  
                if(internUsername==''){
                   $('#errorUserName').html("Username is required");  
                }
                if(internEmail==''){
                   $('#errorEmail').html("Email is required");  
                }
                 if(internContactnumber==''){
                   $('#errorContactNumber').html("Contact Number is required");  
                }
                if(internAddress==''){
                   $('#errorAddress').html("Address is required");  
                }
                if(internPassword==''){
                   $('#errorPassword').html("Password is required");  
                }
                if(internCPassword==''){
                   $('#errorCPassword').html("Password is required");  
                } 
                if(internCountry==''){
                   $('#errorCountry').html("Country is required");  
                }
              
               
           }  
           else  
           {  
                $('#errorUserName').html('');  
                $('#errorEmail').html('');  
                $('#errorContactNumber').html('');  
                $('#errorAddress').html('');  
                $('#errorPostCode').html('');   
                $('#errorCountry').html('');   
                $('#errorPassword').html(''); 
                $('#errorCPassword').html(''); 
                
                $.ajax({  
                     url:"userprofileFunction.php",  
                     method:"POST",  
                     data:{
                     	internID:internID, 
                     	internUsername:internUsername, 
                     	internEmail:internEmail,
                     	internContactnumber:internContactnumber,
                     	internAddress:internAddress,
                     	internPostcode:internPostcode,
                     	internCountry:internCountry,
                     	internPassword:internPassword,
                     	internCPassword:internCPassword
                     },  
                     success:function(data){  
                     	alert(data);
                         /* if(data.trim() == "yes"){
                                $("#internProfile").trigger("reset");  
                                $('#internMessage').fadeIn().html(data);
                          }else{
                               $('#loginMessage').fadeIn().html(data);  
                          }
                            setTimeout(function(){  
                                     $('#loginMessage').fadeOut("Slow");  
                                }, 2000); */
                     }  
                });  
           }  
      });  
 });  
</script>


</body>

</html>