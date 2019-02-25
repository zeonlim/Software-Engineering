	<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
$companyID="";
$companyEmail=$_POST['companyEmail'];
$companyFirstName=$_POST['companyFirstName'];
$companyLastName=$_POST['companyLastName'];
$companyContact=$_POST['companyContact'];
$companyAddress=$_POST['companyAddress'];
$companyPostCode=$_POST['companyPostCode'];
$companyCountry=$_POST['companyCountry'];

$searchCompanyIdsql="SELECT * FROM `register` WHERE userName=:userName";
$searchCompanyIdCmd=$conn->prepare($searchCompanyIdsql);
$searchCompanyIdCmd->bindParam(':userName',$loginUsername);
$searchCompanyIdCmd->execute();
$resultCompanyId=$searchCompanyIdCmd->fetch(PDO::FETCH_ASSOC);
$companyID=$resultCompanyId['roleID'];


$searchCompanyDetailsql="SELECT * FROM `company` WHERE companyID=:companyID";
$searchCompanyDetailCmd=$conn->prepare($searchCompanyDetailsql);
$searchCompanyDetailCmd->bindParam(':companyID',$companyID);
$searchCompanyDetailCmd->execute();
$resultCompanyDetailId=$searchCompanyDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultCompanyDetailId)>0){
$companyEmail=$resultCompanyDetailId['email'];
$companyFirstName=$resultCompanyDetailId['firstName'];
$companyLastName=$resultCompanyDetailId['lastName'];
$companyContact=$resultCompanyDetailId['contact'];
$companyAddress=$resultCompanyDetailId['address'];
$companyPostCode=$resultCompanyDetailId['postCode'];
$companyCountry=$resultCompanyDetailId['country'];
}

?>
	<head>
		<title>home</title>
		<style>
			#profile header{
				position: static;
			}
		</style>
	</head>
	<body id="profile">
	<div id="headermenu"></div>
	<!-- content -->
<form id="companyProfile" >
<input  name="companyID" id="companyID" type="hidden" value="<?=$companyID?>">
<p class="help-block">
Fields with <span class="required">*</span> are required.	</p>

<label >Email</label>
<input placeholder="Email" name="companyEmail" id="companyEmail" type="text" value=<?=$companyEmail?>>
<span id="errorEmail"></span><br/>

<label >First Name*</label>
<input placeholder="First Name" name="companyFirstName" id="companyFirstName" type="text" value=<?=$companyFirstName?>>
<span id="errorCompanyFirstName"></span><br/>

<label >Last Name*</label>
<input placeholder="Last Name" name="companyLastName" id="companyLastName" type="text" value=<?=$companyLastName?>>
<span id="errorCompanyLastName"></span><br/>

<label >Contact Number</label>
<input placeholder="Contact Number" name="companyContact" id="companyContact" type="text" value=<?=$companyContact?>>
<span id="errorCompanyContact"></span><br/>

<label >Address</label>
<textarea placeholder="Address" name="companyAddress" id="companyAddress" ><?=$companyAddress?></textarea>
<span id="errorCompanyAddress"></span><br/>

<label>Post Code</label>
<input placeholder="Post Code" name="companyPostCode" id="companyPostCode" type="text" value=<?=$companyPostCode?>>
<span id="errorCompanyPostCode"></span><br/>

<label>Country*</label>
<select placeholder="Country" name="companyCountry" id="companyCountry">
<option value=""></option>
<optgroup label="Asia">
<option value="AF">Afghanistan</option>
<option value="AM">Armenia</option>
<option value="AZ">Azerbaijan</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BT">Bhutan</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="KH">Cambodia</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CY">Cyprus</option>
<option value="GE">Georgia</option>
<option value="HK">Hong Kong</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IL">Israel</option>
<option value="JP">Japan</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KP">Democratic People's Republic of Korea</option>
<option value="KR">Republic of Korea</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LB">Lebanon</option>
<option value="MO">Macao</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="MN">Mongolia</option>
<option value="MM">Myanmar</option>
<option value="NP">Nepal</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PS">Palestinia</option>
<option value="PH">Philippines</option>
<option value="QA">Qatar</option>
<option value="SA">Saudi Arabia</option>
<option value="SG">Singapore</option>
<option value="LK">Sri Lanka</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-leste</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="AE">United Arab Emirates</option>
<option value="UZ">Uzbekistan</option>
<option value="VN">Viet Nam</option>
<option value="YE">Yemen</option>
</optgroup>
<optgroup label="Europe">
<option value="AX">Åland Islands</option>
<option value="AL">Albania</option>
<option value="AD">Andorra</option>
<option value="AT">Austria</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BG">Bulgaria</option>
<option value="HR">Croatia</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="EE">Estonia</option>
<option value="FO">Faroe Islands</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="DE">Germany</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GG">Guernsey</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IT">Italy</option>
<option value="JE">Jersey</option>
<option value="LV">Latvia</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MK">Macedonia</option>
<option value="MT">Malta</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="ME">Montenegro</option>
<option value="NL">Netherlands</option>
<option value="NO">Norway</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="SM">San Marino</option>
<option value="RS">Serbia</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="ES">Spain</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="UA">Ukraine</option>
<option value="GB">United Kingdom</option>
</optgroup>
<optgroup label="Africa">
<option value="DZ">Algeria</option>
<option value="AO">Angola</option>
<option value="BJ">Benin</option>
<option value="BW">Botswana</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="CM">Cameroon</option>
<option value="CV">Cape Verde</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">The Democratic Republic of The Congo</option>
<option value="CI">Cote D'ivoire</option>
<option value="DJ">Djibouti</option>
<option value="EG">Egypt</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="ET">Ethiopia</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GH">Ghana</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-bissau</option>
<option value="KE">Kenya</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="ML">Mali</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="NA">Namibia</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="RE">Reunion</option>
<option value="RW">Rwanda</option>
<option value="SH">Saint Helena</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SN">Senegal</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="SD">Sudan</option>
<option value="SZ">Swaziland</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TG">Togo</option>
<option value="TN">Tunisia</option>
<option value="UG">Uganda</option>
<option value="EH">Western Sahara</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</optgroup>
<optgroup label="Oceania">
<option value="AS">American Samoa</option>
<option value="AU">Australia</option>
<option value="CK">Cook Islands</option>
<option value="FJ">Fiji</option>
<option value="PF">French Polynesia</option>
<option value="GU">Guam</option>
<option value="KI">Kiribati</option>
<option value="MH">Marshall Islands</option>
<option value="FM">Micronesia</option>
<option value="NR">Nauru</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="PW">Palau</option>
<option value="PG">Papua New Guinea</option>
<option value="PN">Pitcairn</option>
<option value="WS">Samoa</option>
<option value="SB">Solomon Islands</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TV">Tuvalu</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="VU">Vanuatu</option>
<option value="WF">Wallis and Futuna</option>
</optgroup>
<optgroup label="North America">
<option value="AI">Anguilla</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AW">Aruba</option>
<option value="BS">Bahamas</option>
<option value="BB">Barbados</option>
<option value="BZ">Belize</option>
<option value="BM">Bermuda</option>
<option value="CA">Canada</option>
<option value="KY">Cayman Islands</option>
<option value="CR">Costa Rica</option>
<option value="CU">Cuba</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="SV">El Salvador</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GT">Guatemala</option>
<option value="HT">Haiti</option>
<option value="HN">Honduras</option>
<option value="JM">Jamaica</option>
<option value="MQ">Martinique</option>
<option value="MX">Mexico</option>
<option value="MS">Montserrat</option>
<option value="AN">Netherlands Antilles</option>
<option value="NI">Nicaragua</option>
<option value="PA">Panama</option>
<option value="PR">Puerto Rico</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and The Grenadines</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="US">United States</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
</optgroup>
<optgroup label="Antarctica">
<option value="AQ">Antarctica</option>
<option value="BV">Bouvet Island</option>
<option value="TF">French Southern Territories</option>
<option value="HM">Heard Island and Mcdonald Islands</option>
<option value="GS">South Georgia and The South Sandwich Islands</option>
</optgroup>
<optgroup label="South America">
<option value="AR">Argentina</option>
<option value="BO">Bolivia</option>
<option value="BR">Brazil</option>
<option value="CL">Chile</option>
<option value="CO">Colombia</option>
<option value="EC">Ecuador</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="GF">French Guiana</option>
<option value="GY">Guyana</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="SR">Suriname</option>
<option value="UY">Uruguay</option>
<option value="VE">Venezuela</option>
</optgroup>
</select>
<span id="errorCompanyCountry"></span><br/>
<input type="submit" class="sendbutton" name="companyUpdate" id="companyUpdate"></input>
<span id="companyMessage"></span><br/>
</form>
	<!-- end content -->
	<div id="footerbar"></div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script type="text/javascript">
      $('#headermenu').load('header.html');
      $('#footerbar').load('footer.html');
      $(document).ready(function(){  
      $('#companyUpdate').click(function(){  
           var companyID = $('#companyID').val();  
           var companyEmail = $('#companyEmail').val();  
           var companyFirstName = $('#companyFirstName').val();  
           var companyLastName = $('#companyLastName').val();  
           var companyContact = $('#companyContact').val();  
           var companyAddress = $('#companyAddress').val();  
           var companyPostCode = $('#companyPostCode').val();  
           if((companyFirstName=='') || (companyLastName=='') || (companyCountry=='') ||(companyEmail==''))  
           {  
                if(companyFirstName==''){
                   $('#errorCompanyFirstName').html("First name is required");  
                }
                if(companyLastName==''){
                   $('#errorCompanyLastName').html("Last name is required");  
                }
              	if(companyCountry==''){
                   $('#errorCompanyCountry').html("Country is required");  
                }
                if(companyEmail==''){
                   $('#errorCompanyEmail').html("Email is required");  
                }
               
           }  
           else  
           {  
                 $('#errorCompanyFirstName').html('');  
                $('#errorCompanyLastName').html('');  
                $('#errorCompanyEmail').html('');  
                $('#errorCompanyContact').html('');  
                $('#errorCompanyAddress').html('');  
                $('#errorCompanyPostCode').html('');  
                $('#errorCompanyCountry').html('');   
                $.ajax({  
                     url:"updataCompanyFunction.php",  
                     method:"POST",  
                     data:{
                      companyID:companyID, 
                      companyEmail:companyEmail, 
                      companyFirstName:companyFirstName,
                      companyLastName:companyLastName, 
                      companyContact:companyContact,
                      companyAddress:companyAddress, 
                      companyPostCode:companyPostCode, 
                      companyContact:companyCountry
                    },  
                     success:function(data){  
                          /*if(data.trim() == "yes"){
                                $("#companyProfile").trigger("reset");  
                                $('#companyMessage').fadeIn().html(data);
                          }
                            setTimeout(function(){  
                                     $('#companyMessage').fadeOut("Slow");  
                                }, 2000); */
                                $('#companyMessage').fadeIn().html(data);
                     }  
                });  
           }  
      });  
 });  
 </script>
