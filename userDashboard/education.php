<?php
require("database.php");

session_start();
$loginUsername=$_SESSION['userName'];
  if($loginUsername==""){
   echo "<script type='text/javascript'>window.top.location='http://ijobassistant.com/';</script>";
}
$internID=$_SESSION['roleID'];
$university=$_POST['university'];
$month=$_POST['month'];
$years=$_POST['years'];
$qualification=$_POST['qualification'];
$location=$_POST['location'];
$study=$_POST['study'];
$major=$_POST['major'];
$grade=$_POST['grade'];
$additionalInformation=$_POST['additionalInformation'];

$searchInternDetailsql="SELECT * FROM `education` WHERE internID=:internID";
$searchInternDetailCmd=$conn->prepare($searchInternDetailsql);
$searchInternDetailCmd->bindParam(':internID',$internID);
$searchInternDetailCmd->execute();
$resultInternDetailId=$searchInternDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultInternDetailId)>0){
$university=$resultInternDetailId['university'];
$month=$resultInternDetailId['month'];
$years=$resultInternDetailId['years'];
$qualification=$resultInternDetailId['qualification'];
$location=$resultInternDetailId['location'];
$study=$resultInternDetailId['study'];
$major=$resultInternDetailId['major'];
$grade=$resultInternDetailId['grade'];
$additionalInformation=$resultInternDetailId['additionalInformation'];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Education</title>

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
			<li class="active"><a href="education.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Education</a></li>
			<li><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
			<li><a href="language.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Language</a></li>
			<li><a href="uploadresume.php"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Upload Resume</a></li>		
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
							<th width="35%">Institute/University</th>
							<th width="25%">Field of Study</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
<?php
$sql = "SELECT * FROM education where internID=:internID ";
$result = $conn->prepare($sql);
$result->bindParam(':internID',$internID);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$university = $row['university'];	
$month = $row['month'];
$years = $row['years'];
$qualification = $row['qualification'];
$location = $row['location'];
$study = $row['study'];
$major = $row['major'];
$grade = $row['grade'];
$additionalInformation = $row['additionalInformation'];

echo"
<tr>
							<th width='35%'>$university</th>
							<th width='25%'>$study</th>
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

</body>

</html>
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
	<p class="help-block">
		Fields with <span class="required">*</span> are required.	</p>

		<div class="form-group">
			<label class="control-label required" for="Entry_university"> Institute/University <span class="required">*</span></label>
			<input class="form-control" placeholder="Institute/University" name="university" id="university" type="text" value="<?= $university?>">
			<span id="errorUniversity"></span>
		</div>
        
		<div class="form-group">
			<label class="control-label" for="Entry_graduationDate">Graduation Date</label>
                <select  class="form-control" name="month" id="month" value="<?=$month?>">
          			<option value=""></option>
                	<option value="January">January</option>
                	<option value="February">February</option>
               	 	<option value="March">March</option>
               		<option value="April">April</option>
               		<option value="May">May</option>
                	<option value="June">June</option>
                	<option value="July">July</option>
                	<option value="August">August</option>
               		<option value="September">September</option>
                	<option value="October">October</option>
                	<option value="November">November</option>
                	<option value="December">December</option>
                </select>
                                                    
                                                    
                <select  class="form-control" name="years" id="years" value="<?=$years?>">
                    <option value=""></option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                </select>
             
             <span id="errorGraduationDate"></span>
		</div>

		<div class="form-group">
			<label class="control-label required" for="Entry_qualification"> Qualification <span class="required">*</span></label>
				<select  class="form-control" name="qualification" id="qualification" value="<?=$qualification?>">
                    <option value="Select Qualification" title="- Select Qualification -&quot;, &quot;0&quot;, ">- Select Qualification -</option>
                    <option value="Primary/Secondary School/SPM/'O' Level" title="Primary/Secondary School/SPM/'O' Level">Primary/Secondary School/SPM/'O' Level</option>
                    <option value="Higher Secondary/STPM/'A' Level/Pre-U" title="Higher Secondary/STPM/'A' Level/Pre-U">Higher Secondary/STPM/'A' Level/Pre-U</option>
                    <option value="Professional Certificate" title="Professional Certificate">Professional Certificate</option>
                    <option value="Diploma" title="Diploma">Diploma</option>
                    <option value="Advanced/Higher/Graduate Diploma" title="Advanced/Higher/Graduate Diploma">Advanced/Higher/Graduate Diploma</option>
                    <option value="Bachelor's Degree" title="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Post Graduate Diploma" title="Post Graduate Diploma">Post Graduate Diploma</option>
                    <option value="Professional Degree" title="Professional Degree">Professional Degree</option>
                    <option value="Master's Degree" title="Master's Degree">Master's Degree</option>
                    <option value="Doctorate (PhD)" title="Doctorate (PhD)">Doctorate (PhD)</option>
                </select>                                                                             
			<span id="errorQualification"></span>
		</div>

		<div class="form-group">
			<label class="control-label required" for="Entry_universityLocation"> Institute/University Location <span class="required">*</span></label>
			<select  class="form-control" name="location" id="location" value="<?=$location?>">
                <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia Hercegovina">Bosnia Hercegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="East Timor">East Timor</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="EL Salvador">EL Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bissau">Guinea-Bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea (North)">Korea (North)</option>
                <option value="Korea (South">Korea (South)</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macau">Macau</option>
                <option value="Macedonia">Macedonia</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia" selected="selected">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia">Micronesia</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Nambia">Nambia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Others">Others</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Republic Of Moldova">Republic Of Moldova</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia And South Sandwich Islands">South Georgia And South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="St. Helena">St. Helena</option>
                <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="TOGO">TOGO</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Yugoslavia">Yugoslavia</option>
                <option value="Zaire">Zaire</option>
                <option value="Zambia">Zambia</option
                ><option value="Zimbabwe">Zimbabwe</option>
            </select>
			<span id="errorUniversityLocation"></span>
		</div>
			
		<div class="form-group">
			
			<label class="control-label required" for="Entry_fieldofStudy"> Field of Study <span class="required">*</span></label>
				<select  class="form-control" name="study" id="study" value="<?=$study?>">
                    <option value="Select Field of Study" title="- Select Field of Study -">- Select Field of Study -</option>
                    <option value="Advertising/Media" title="Advertising/Media">Advertising/Media</option>
                    <option value="Agriculture/Aquaculture/Forestry" title="Agriculture/Aquaculture/Forestry">Agriculture/Aquaculture/Forestry</option>
                    <option value="Airline Operation/Airport Management" title="Airline Operation/Airport Management">Airline Operation/Airport Management</option>
                    <option value="Architecture" title="Architecture">Architecture</option>
                    <option value="Art/Design/Creative Multimedia" title="Art/Design/Creative Multimedia">Art/Design/Creative Multimedia</option>
                    <option value="Biology" title="Biology">Biology</option>
                    <option value="BioTechnology" title="BioTechnology">BioTechnology</option>
                    <option value="Business Studies/Administration/Management" title="Business Studies/Administration/Management">Business Studies/Administration/Management</option>
                    <option value="Chemistry" title="Chemistry">Chemistry</option>
                    <option value="Commerce" title="Commerce">Commerce</option>
                    <option value="Computer Science/Information Technology" title="Computer Science/Information Technology">Computer Science/Information Technology</option>
                    <option value="Dentistry" title="Dentistry">Dentistry</option>
                    <option value="Economics" title="Economics">Economics</option>
                    <option value="Journalism" title="Journalism">Journalism</option>
                    <option value="Education/Teaching/Training" title="Education/Teaching/Training">Education/Teaching/Training</option>
                    <option value="Engineering (Aviation/Aeronautics/Astronautics)" title="Engineering (Aviation/Aeronautics/Astronautics)">Engineering (Aviation/Aeronautics/Astronautics)</option>
                    <option value="Engineering (Bioengineering/Biomedical)" title="Engineering (Bioengineering/Biomedical)">Engineering (Bioengineering/Biomedical)</option>
                    <option value="Engineering (Chemical)" title="Engineering (Chemical)">Engineering (Chemical)</option>
                    <option value="Engineering (Civil)" title="Engineering (Civil)">Engineering (Civil)</option>
                    <option value="Engineering (Computer/Telecommunication)" title="Engineering (Computer/Telecommunication)">Engineering (Computer/Telecommunication)</option>
                    <option value="Engineering (Electrical/Electronic)" title="Engineering (Electrical/Electronic)">Engineering (Electrical/Electronic)</option>
                    <option value="Engineering (Environmental/Health/Safety)" title="Engineering (Environmental/Health/Safety)">Engineering (Environmental/Health/Safety)</option><option value="19" title="Engineering (Industrial)">Engineering (Industrial)</option>
                    <option value="Engineering (Marine)" title="Engineering (Marine)">Engineering (Marine)</option>
                    <option value="Engineering (Material Science)" title="Engineering (Material Science)">Engineering (Material Science)</option>
                    <option value="Engineering (Mechanical)" title="Engineering (Mechanical)">Engineering (Mechanical)</option>
                    <option value="Engineering (Mechatronic/Electromechanical)" title="Engineering (Mechatronic/Electromechanical)">Engineering (Mechatronic/Electromechanical)</option>
                    <option value="Engineering (Metal Fabrication/Tool &amp; Die/Welding)" title="Engineering (Metal Fabrication/Tool &amp; Die/Welding)">Engineering (Metal Fabrication/Tool &amp; Die/Welding)</option>
                    <option value="Engineering (Mining/Mineral)" title="Engineering (Mining/Mineral)">Engineering (Mining/Mineral)</option>
                    <option value="Engineering (Others)" title="Engineering (Others)">Engineering (Others)</option>
                    <option value="Engineering (Petroleum/Oil/Gas)" title="Engineering (Petroleum/Oil/Gas)">Engineering (Petroleum/Oil/Gas)</option>
                    <option value="Finance/Accountancy/Banking" title="Finance/Accountancy/Banking">Finance/Accountancy/Banking</option><option value="Food &amp; Beverage Services Management" title="Food &amp; Beverage Services Management">Food &amp; Beverage Services Management</option>
                    <option value="Food Technology/Nutrition/Dietetics" title="Food Technology/Nutrition/Dietetics">Food Technology/Nutrition/Dietetics</option>
                    <option value="Geographical Science" title="Geographical Science">Geographical Science</option>
                    <option value="Geology/Geophysics" title="Geology/Geophysics">Geology/Geophysics</option>
                    <option value="History" title="History">History</option>
                    <option value="Hospitality/Tourism/Hotel Management" title="Hospitality/Tourism/Hotel Management">Hospitality/Tourism/Hotel Management</option>
                    <option value="Human Resource Management" title="Human Resource Management">Human Resource Management</option>
                    <option value="Humanities/Liberal Arts" title="Humanities/Liberal Arts">Humanities/Liberal Arts</option>
                    <option value="Logistic/Transportation" title="Logistic/Transportation">Logistic/Transportation</option>
                    <option value="Law" title="Law">Law</option>
                    <option value="Library Management" title="Library Management">Library Management</option>
                    <option value="Linguistics/Languages" title="Linguistics/Languages">Linguistics/Languages</option>
                    <option value="Mass Communications" title="Mass Communications">Mass Communications</option>
                    <option value="Mathematics" title="Mathematics">Mathematics</option>
                    <option value="Medical Science" title="Medical Science">Medical Science</option>
                    <option value="Medicine" title="Medicine">Medicine</option>
                    <option value="Maritime Studies" title="Maritime Studies">Maritime Studies</option>
                    <option value="Marketing" title="Marketing">Marketing</option>
                    <option value="Music/Performing Arts Studies" title="Music/Performing Arts Studies">Music/Performing Arts Studies</option>
                    <option value="Nursing" title="Nursing">Nursing</option>
                    <option value="Optometry" title="Optometry">Optometry</option>
                    <option value="Personal Services" title="Personal Services">Personal Services</option>
                    <option value="Pharmacy/Pharmacology" title="Pharmacy/Pharmacology">Pharmacy/Pharmacology</option>
                    <option value="Philosophy" title="Philosophy">Philosophy</option>
                    <option value="Physical Therapy/Physiotherapy" title="Physical Therapy/Physiotherapy">Physical Therapy/Physiotherapy</option>
                    <option value="Physics" title="Physics">Physics</option>
                    <option value="Political Science" title="Political Science">Political Science</option>
                    <option value="Property Development/Real Estate Management" title="Property Development/Real Estate Management">Property Development/Real Estate Management</option>
                    <option value="Protective Services &amp; Management" title="Protective Services &amp; Management">Protective Services &amp; Management</option>
                    <option value="Psychology" title="Psychology">Psychology</option>
                    <option value="Quantity Survey" title="Quantity Survey">Quantity Survey</option>
                    <option value="Science &amp; Technology" title="Science &amp; Technology">Science &amp; Technology</option>
                    <option value="Secretarial" title="Secretarial">Secretarial</option>
                    <option value="Social Science/Sociology" title="Social Science/Sociology">Social Science/Sociology</option>
                    <option value="Sports Science &amp; Management" title="Sports Science &amp; Management">Sports Science &amp; Management</option>
                    <option value="Textile/Fashion Design" title="Textile/Fashion Design">Textile/Fashion Design</option>
                    <option value="Urban Studies/Town Planning" title="Urban Studies/Town Planning">Urban Studies/Town Planning</option>
                    <option value="Veterinary" title="Veterinary">Veterinary</option>
                    <option value="IT" title="IT">IT</option>
                    <option value="Others" title="Others">Others</option>
            	</select>
			<span id="errorFieldofStudy"></span>
		</div>
		
		<div class="form-group">
			<label class="control-label required" for="Entry_major"> Major </label>
			<input class="form-control" placeholder="Major" name="major" id="major" type="text" value="<?= $major?>">
			<span id="errorMajor"></span>
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_grade"> Grade <span class="required">*</span></label>
				<select  class="form-control" name="grade" id="grade" value="<?=$grade?>">
                    <option value=""></option>
                    <option value="Grade A">Grade A</option>
                    <option value="Grade B">Grade B</option>
                    <option value="Grade C">Grade C</option>
                    <option value="Grade D">Grade D</option>
                    <option value="1st Class">1st Class</option>
                    <option value="2nd Class Upper">2nd Class Upper</option>
                    <option value="2nd Class Lower">2nd Class Lower</option>
                    <option value="3rd Class">3rd Class</option>
                    <option value="CGPA/Percentage">CGPA/Percentage</option>
                    <option value="Pass/Non-gradable">Pass/Non-gradable</option>
                    <option value="Fail">Fail</option>
                    <option value="Incomplete">Incomplete</option>
                    <option value="On-going">On-going</option>
                </select>
			<span id="errorGrade"></span>
		</div>
		
		<div class="form-group">
			<label class="control-label required" for="Entry_additionalInformation"> Additional Information </label>
			<input class="form-control" placeholder="Additional Information" name="additionalInformation" id="additionalInformation" type="text" value="<?= $additionalInformation?>">
			<span id="errorAdditionalInformation"></span>
		</div>

		<div class="modal-footer">
			<input type="hidden" name="internID" id="internID" />
			<input type="hidden" name="operation" id="operation" />
			<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
      $('#action').click(function(){  
           var internID = $('#internID').val();  
           var university = $('#university').val(); 
           var month = $('#month').val();
           var years = $('#years').val();
           var qualification = $('#qualification').val(); 
           var location = $('#location').val(); 
           var study = $('#study').val(); 
           var major = $('#major').val(); 
           var grade = $('#grade').val(); 
           var additionalInformation = $('#additionalInformation').val();  
                
                $.ajax({  
                     url:"educationFunction.php",  
                     method:"POST",  
                     data:{
                     	internID:internID, 
                     	university:university, 
                     	month:month,
                     	years:years,
                     	qualification:qualification,
                     	location:location,
                     	study:study,
                     	major:major,
                     	grade:grade,
                     	additionalInformation:additionalInformation,
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

