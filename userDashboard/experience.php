<?php
require("database.php");

session_start();

$internID=$_SESSION['roleID'];
$positionTitle=$_POST['positionTitle'];
$companyName=$_POST['companyName'];
$specialization=$_POST['specialization'];
$role=$_POST['role'];
$country=$_POST['country'];
$industry=$_POST['industry'];
$position=$_POST['position'];
$salary=$_POST['salary'];
$montlySalary=$_POST['montlySalary'];
$experienceDescription=$_POST['experienceDescription'];

$searchInternDetailsql="SELECT * FROM `experience` WHERE internID=:internID";
$searchInternDetailCmd=$conn->prepare($searchInternDetailsql);
$searchInternDetailCmd->bindParam(':internID',$internID);
$searchInternDetailCmd->execute();
$resultInternDetailId=$searchInternDetailCmd->fetch(PDO::FETCH_ASSOC);
if(count($resultInternDetailId)>0){
$positionTitle=$resultInternDetailId['positionTitle'];
$companyName=$resultInternDetailId['companyName'];
$specialization=$resultInternDetailId['specialization'];
$role=$resultInternDetailId['role'];
$country=$resultInternDetailId['country'];
$industry=$resultInternDetailId['industry'];
$position=$resultInternDetailId['position'];
$salary=$resultInternDetailId['salary'];
$montlySalary=$resultInternDetailId['montlySalary'];
$experienceDescription=$resultInternDetailId['experienceDescription'];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ijobassistant - Experience</title>

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
			<li class="active"><a href="experience.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Experience</a></li>
			<li><a href="education.php"><svg class="glyph stroked mobile device"><use xlink:href="#stroked-mobile-device"/></svg> Education</a></li>
			<li><a href="skills.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Skills</a></li>
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
				<table id="user_data" class="table table-bordered table-striped main col-sm-9">
					<thead>
						<tr>
							<th width="35%">Position Title</th>
							<th width="25%">Company Name</th>
							<th width="25%">Role</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
<?php
$sql = "SELECT * FROM experience where internID=:internID ";
$result = $conn->prepare($sql);
$result->bindParam(':internID',$internID);
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
$positionTitle = $row['positionTitle'];	
$companyName = $row['companyName'];
$specialization = $row['specialization'];
$role = $row['role'];
$country = $row['country'];
$industry = $row['industry'];
$position = $row['position'];
$salary = $row['salary'];
$montlySalary = $row['montlySalary'];
$experienceDescription = $row['experienceDescription'];

echo"
<tr>
							<th width='35%'>$positionTitle</th>
							<th width='25%'>$companyName</th>
							<th width='25%'>$role</th>
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
			<label class="control-label required" for="Entry_positionTitle"> Position Title <span class="required">*</span></label>
			<input class="form-control" placeholder="Position Title" name="positionTitle" id="positionTitle" type="text" value="<?= $positionTitle?>">
			<span id="errorPositionTitle"></span>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="Entry_companyName">Company Name <span class="required">*</span></label>
			<input class="form-control" placeholder="Company Name" name="companyName" id="companyName" type="text" value="<?=$companyName?>">
			<span id="errorCompanyName"></span>
		</div>

		<div class="form-group">
			<label class="control-label required" for="Entry_specialization"> Specialization <span class="required">*</span></label>
				<select class="form-control" name="specialization" id="specialization" value="<?=$specialization?>">
                    <option value=""></option>
                    <option title="Actuarial Science/Statistics" value="103"> Actuarial Science/Statistics </option>
                    <option title="Advertising/Media Planning" value="100"> Advertising/Media Planning </option>
                    <option title="Agriculture/Forestry/Fisheries" value="102"> Agriculture/Forestry/Fisheries </option>
                    <option title="Architecture/Interior Design" value="180"> Architecture/Interior Design </option>
                    <option title="Arts/Creative/Graphics Design" value="101"> Arts/Creative/Graphics Design </option>
                    <option title="Aviation/Aircraft Maintenance" value="181"> Aviation/Aircraft Maintenance </option>
                    <option title="Banking/Financial Services" value="135"> Banking/Financial Services </option>
                    <option title="Biotechnology" value="182"> Biotechnology </option>
                    <option title="Chemistry" value="183"> Chemistry </option>
                    <option title="Clerical/Administrative Support" value="133"> Clerical/Administrative Support </option>
                    <option title="Corporate Strategy/Top Management" value="148"> Corporate Strategy/Top Management </option>
                    <option title="Customer Service" value="134"> Customer Service </option>
                    <option title="Education" value="105"> Education </option>
                    <option title="Engineering - Chemical" value="185"> Engineering - Chemical </option>
                    <option title="Engineering - Civil/Construction/Structural" value="184"> Engineering - Civil/Construction/Structural </option>
                    <option title="Engineering - Electrical" value="187"> Engineering - Electrical </option>
                    <option title="Engineering - Electronics/Communication" value="186"> Engineering - Electronics/Communication </option>
                    <option title="Engineering - Environmental/Health/Safety" value="189"> Engineering - Environmental/Health/Safety </option>
                    <option title="Engineering - Industrial" value="200"> Engineering - Industrial </option>
                    <option title="Engineering - Mechanical/Automotive" value="195"> Engineering - Mechanical/Automotive </option>
                    <option title="Engineering - Oil/Gas" value="190"> Engineering - Oil/Gas </option>
                    <option title="Engineering - Others" value="188"> Engineering - Others </option>
                    <option title="Entertainment/Performing Arts" value="106"> Entertainment/Performing Arts </option>
                    <option title="Finance - Audit/Taxation" value="130"> Finance - Audit/Taxation </option>
                    <option title="Finance - Corporate Finance/Investment/Merchant Banking" value="132"> Finance - Corporate Finance/Investment/Merchant Banking </option>
                    <option title="Finance - General/Cost Accounting " value="131"> Finance - General/Cost Accounting  </option>
                    <option title="Food Technology/Nutritionist" value="108"> Food Technology/Nutritionist </option>
                    <option title="Food/Beverage/Restaurant Service" value="107"> Food/Beverage/Restaurant Service </option>
                    <option title="General Work (Housekeeper, Driver, Dispatch, Messenger, etc)" value="110"> General Work (Housekeeper, Driver, Dispatch, Messenger, etc) </option>
                    <option title="Geology/Geophysics" value="109"> Geology/Geophysics </option>
                    <option title="Healthcare - Doctor/Diagnosis" value="113"> Healthcare - Doctor/Diagnosis </option>
                    <option title="Healthcare - Nurse/Medical Support &amp; Assistant" value="111"> Healthcare - Nurse/Medical Support &amp; Assistant </option>
                    <option title="Healthcare - Pharmacy" value="112"> Healthcare - Pharmacy </option>
                    <option title="Hotel Management/Tourism Services" value="114"> Hotel Management/Tourism Services </option>
                    <option title="Human Resources" value="137"> Human Resources </option>
                    <option title="IT/Computer - Hardware" value="192"> IT/Computer - Hardware </option>
                    <option title="IT/Computer - Network/System/Database Admin" value="193"> IT/Computer - Network/System/Database Admin </option>
                    <option title="IT/Computer - Software" value="191"> IT/Computer - Software </option>
                    <option title="Journalist/Editor" value="104"> Journalist/Editor </option>
                    <option title="Law/Legal Services" value="138"> Law/Legal Services </option>
                    <option title="Logistics/Supply Chain" value="147"> Logistics/Supply Chain </option>
                    <option title="Maintenance/Repair (Facilities &amp; Machinery)" value="115"> Maintenance/Repair (Facilities &amp; Machinery) </option>
                    <option title="Manufacturing/Production Operations" value="194"> Manufacturing/Production Operations </option>
                    <option title="Marketing/Business Development" value="139"> Marketing/Business Development </option>
                    <option title="Merchandising" value="149"> Merchandising </option>
                    <option title="Personal Care/Beauty/Fitness Service" value="118"> Personal Care/Beauty/Fitness Service </option>
                    <option title="Process Design &amp; Control/Instrumentation" value="196"> Process Design &amp; Control/Instrumentation </option>
                    <option title="Property/Real Estate" value="150"> Property/Real Estate </option>
                    <option title="Public Relations/Communications" value="141"> Public Relations/Communications </option>
                    <option title="Publishing/Printing" value="117"> Publishing/Printing </option>
                    <option title="Purchasing/Inventory/Material &amp; Warehouse Management" value="140"> Purchasing/Inventory/Material &amp; Warehouse Management </option>
                    <option title="Quality Control/Assurance" value="197"> Quality Control/Assurance </option>
                    <option title="Quantity Surveying" value="198"> Quantity Surveying </option>
                    <option title="Sales - Corporate" value="142"> Sales - Corporate </option>
                    <option title="Sales - Engineering/Technical/IT" value="143"> Sales - Engineering/Technical/IT </option>
                    <option title="Sales - Financial Services (Insurance, Unit Trust, etc)" value="144"> Sales - Financial Services (Insurance, Unit Trust, etc) </option>
                    <option title="Sales - Retail/General" value="145"> Sales - Retail/General </option>
                    <option title="Sales - Telesales/Telemarketing" value="151"> Sales - Telesales/Telemarketing </option>
                    <option title="Science &amp; Technology/Laboratory" value="199"> Science &amp; Technology/Laboratory </option>
                    <option title="Secretarial/Executive &amp; Personal Assistant" value="146"> Secretarial/Executive &amp; Personal Assistant </option>
                    <option title="Security/Armed Forces/Protective Services" value="119"> Security/Armed Forces/Protective Services </option>
                    <option title="Social &amp; Counselling Service" value="120"> Social &amp; Counselling Service </option>
                    <option title="Technical &amp; Helpdesk Support" value="152"> Technical &amp; Helpdesk Support </option>
                    <option title="Training &amp; Development" value="121"> Training &amp; Development </option>
                    <option value="Others">Others</option>
                </select>
			<span id="errorSpecialization"></span>
		
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_role"> Role </label>
			<input class="form-control" placeholder="Role" name="role" id="role" type="text" value="<?= $role?>">
			<span id="errorRole"></span>
		
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_country"> Country <span class="required">*</span></label>
                <select  class="form-control" name="country" id="country" value="<?=$country?>">
                <option value="">Country</option>
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
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
			<span id="errorCountry"></span>
		
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_industry"> Industry <span class="required">*</span></label>
				<select  class="form-control" name="industry" id="industry" value="<?=$industry?>">
                    <option value=""></option>
                        <option title="Accounting / Audit / Tax Services" value="Accounting / Audit / Tax Services"> Accounting / Audit / Tax Services </option>
                        <option title="Advertising / Marketing / Promotion / PR" value="Advertising / Marketing / Promotion / PR"> Advertising / Marketing / Promotion / PR </option>
                        <option title="Aerospace / Aviation / Airline" value="Aerospace / Aviation / Airline"> Aerospace / Aviation / Airline </option>
                        <option title="Agricultural / Plantation / Poultry / Fisheries" value="Agricultural / Plantation / Poultry / Fisheries"> Agricultural / Plantation / Poultry / Fisheries </option>
                        <option title="Apparel" value="Apparel"> Apparel </option>
                        <option title="Architectural Services / Interior Designing" value="Architectural Services / Interior Designing"> Architectural Services / Interior Designing </option>
                        <option title="Arts / Design / Fashion" value="Arts / Design / Fashion"> Arts / Design / Fashion </option>
                        <option title="Automobile / Automotive Ancillary / Vehicle" value="Automobile / Automotive Ancillary / Vehicle"> Automobile / Automotive Ancillary / Vehicle </option>
                        <option title="Banking / Financial Services" value="Banking / Financial Services"> Banking / Financial Services </option>
                        <option title="BioTechnology / Pharmaceutical / Clinical research" value="BioTechnology / Pharmaceutical / Clinical research"> BioTechnology / Pharmaceutical / Clinical research </option>
                        <option title="Call Center / IT-Enabled Services / BPO" value="Call Center / IT-Enabled Services / BPO"> Call Center / IT-Enabled Services / BPO </option>
                        <option title="Chemical / Fertilizers / Pesticides" value="Chemical / Fertilizers / Pesticides"> Chemical / Fertilizers / Pesticides </option>
                        <option title="Computer / Information Technology (Hardware)" value="Computer / Information Technology (Hardware)"> Computer / Information Technology (Hardware) </option>
                        <option title="Computer / Information Technology (Software)" value="Computer / Information Technology (Software)"> Computer / Information Technology (Software) </option>
                        <option title="Construction / Building / Engineering" value="Construction / Building / Engineering"> Construction / Building / Engineering </option>
                        <option title="Consulting (Business &amp; Management)" value="Consulting (Business &amp; Management)"> Consulting (Business &amp; Management) </option>
                        <option title="Consulting (IT, Science, Engineering &amp; Technical)" value="Consulting (IT, Science, Engineering &amp; Technical)"> Consulting (IT, Science, Engineering &amp; Technical) </option>
                        <option title="Consumer Products / FMCG" value="Consumer Products / FMCG"> Consumer Products / FMCG </option>
                        <option title="Education" value="Education"> Education </option>
                        <option title="Electrical &amp; Electronics" value="Electrical &amp; Electronics"> Electrical &amp; Electronics </option>
                        <option title="Entertainment / Media" value="Entertainment / Media"> Entertainment / Media </option>
                        <option title="Environment / Health / Safety" value="Environment / Health / Safety"> Environment / Health / Safety </option>
                        <option title="Exhibitions / Event management / MICE" value="Exhibitions / Event management / MICE"> Exhibitions / Event management / MICE </option>
                        <option title="Food &amp; Beverage / Catering / Restaurant" value="Food &amp; Beverage / Catering / Restaurant"> Food &amp; Beverage / Catering / Restaurant </option>
                        <option title="Gems / Jewellery" value="Gems / Jewellery"> Gems / Jewellery </option>
                        <option title="General &amp; Wholesale Trading" value="General &amp; Wholesale Trading"> General &amp; Wholesale Trading </option>
                        <option title="Government / Defence" value="Government / Defence"> Government / Defence </option>
                        <option title="Grooming / Beauty / Fitness" value="Grooming / Beauty / Fitness"> Grooming / Beauty / Fitness </option>
                        <option title="Healthcare / Medical" value="Healthcare / Medical"> Healthcare / Medical </option>
                        <option title="Heavy Industrial / Machinery / Equipment" value="Heavy Industrial / Machinery / Equipment"> Heavy Industrial / Machinery / Equipment </option>
                        <option title="Hotel / Hospitality" value="Hotel / Hospitality"> Hotel / Hospitality </option>
                        <option title="Human Resources Management / Consulting" value="Human Resources Management / Consulting"> Human Resources Management / Consulting </option>
                        <option title="Insurance" value="Insurance"> Insurance </option>
                        <option title="Journalism" value="Journalism"> Journalism </option>
                        <option title="Law / Legal" value="Law / Legal"> Law / Legal </option>
                        <option title="Library / Museum" value="Library / Museum"> Library / Museum </option>
                        <option title="Manufacturing / Production" value="Manufacturing / Production"> Manufacturing / Production </option>
                        <option title="Marine / Aquaculture" value="Marine / Aquaculture"> Marine / Aquaculture </option>
                        <option title="Mining" value="Mining"> Mining </option>
                        <option title="Non-Profit Organisation / Social Services / NGO" value="Non-Profit Organisation / Social Services / NGO"> Non-Profit Organisation / Social Services / NGO </option>
                        <option title="Oil / Gas / Petroleum" value="Oil / Gas / Petroleum"> Oil / Gas / Petroleum </option>
                        <option title="Polymer / Plastic / Rubber / Tyres" value="Polymer / Plastic / Rubber / Tyres"> Polymer / Plastic / Rubber / Tyres </option>
                        <option title="Printing / Publishing" value="Printing / Publishing"> Printing / Publishing </option>
                        <option title="Property / Real Estate" value="Property / Real Estate"> Property / Real Estate </option>
                        <option title="R&amp;D" value="R&amp;D"> R&amp;D </option>
                        <option title="Repair &amp; Maintenance Services" value="Repair &amp; Maintenance Services"> Repair &amp; Maintenance Services </option>
                        <option title="Retail / Merchandise" value="Retail / Merchandise"> Retail / Merchandise </option>
                        <option title="Science &amp; Technology" value="Science &amp; Technology"> Science &amp; Technology </option>
                        <option title="Security / Law Enforcement" value="Security / Law Enforcement"> Security / Law Enforcement </option>
                        <option title="Semiconductor/Wafer Fabrication" value="Semiconductor/Wafer Fabrication"> Semiconductor/Wafer Fabrication </option>
                        <option title="Sports" value="Sports"> Sports </option>
                        <option title="Stockbroking / Securities" value="Stockbroking / Securities"> Stockbroking / Securities </option>
                        <option title="Telecommunication" value="Telecommunication"> Telecommunication </option>
                        <option title="Textiles / Garment" value="Textiles / Garment"> Textiles / Garment </option>
                        <option title="Tobacco" value="Tobacco"> Tobacco </option>
                        <option title="Transportation / Logistics" value="Transportation / Logistics"> Transportation / Logistics </option>
                        <option title="Travel / Tourism" value="Travel / Tourism"> Travel / Tourism </option>
                        <option title="Utilities / Power" value="Utilities / Power"> Utilities / Power </option>
                        <option title="Wood / Fibre / Paper" value="Wood / Fibre / Paper"> Wood / Fibre / Paper </option>
                        <option value="Others">Others</option>
                </select>            
			<span id="errorIndustry"></span>
		
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_position"> Position Level </label>
                <select  class="form-control" name="position" id="postion" value="<?=$position?>">
                    <option value=""></option>
                        <option title="Senior Manager" value="Senior Manager"> Senior Manager </option>
                        <option title="Manager" value="Manager"> Manager </option>
                        <option title="Senior Executive" value="Senior Executive"> Senior Executive </option>
                        <option title="Junior Executive" value="Junior Executive"> Junior Executive </option>
                        <option title="Fresh / Entry Level" value=" Fresh / Entry Level"> Fresh / Entry Level </option>
                        <option title="Non-Executive" value=" Non-Executive"> Non-Executive </option>
                </select>
			<span id="errorPositionLevel"></span>
	
		</div>
			
		<div class="form-group">
			<label class="control-label required" for="Entry_salary"> Montly Salary </label>
                <select class="form-control" name="salary" id="salary" value="<?=$salary?>">
               		 <option value="">Currency</option>
                     <option value="MYR">MYR</option>
                     <option value="SGD">SGD</option>
                     <option value="PHP">PHP</option>
                     <option value="USD">USD</option>
                     <option value="INR">INR</option>
                     <option value="AUD">AUD</option>
                     <option value="IDR">IDR</option>
                     <option value="THB">THB</option>
                     <option value="HKD">HKD</option>
                     <option value="EUR">EUR</option>
                     <option value="CNY">CNY</option>
                     <option value="JPY">JPY</option>
                     <option value="GBP">GBP</option>
                     <option value="VND">VND</option>
                     <option value="BDT">BDT</option>
                     <option value="NZD">NZD</option>
                </select>   
			<input class="form-control" placeholder="Montly Salary" name="montlySalary" id="montlySalary" type="text" value="<?= $montlySalary?>"></input>
		
			<span id="errorMontlySalary"></span>
	
		</div>

		<div class="form-group">
			<label class="control-label required" for="Entry_experienceDescription"> Experience Description </label>
			<input class="form-control" placeholder="Experience Description" name="experienceDescription" id="experienceDescription" type="text" value="<?= $experienceDescription?>">
			<span id="errorExperienceDescription"></span>
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
           var positionTitle = $('#positionTitle').val(); 
           var companyName = $('#companyName').val();
           var specialization = $('#specialization').val();
           var role = $('#role').val(); 
           var country = $('#country').val(); 
           var industry = $('#industry').val(); 
           var position = $('#position').val(); 
           var salary = $('#salary').val(); 
           var montlySalary = $('#montlySalary').val();
           var experienceDescription = $('#experienceDescription').val();   
                
                $.ajax({  
                     url:"experienceFunction.php",  
                     method:"POST",  
                     data:{
                     	internID:internID, 
                     	positionTitle:positionTitle, 
                     	companyName:companyName,
                     	specialization:specialization,
                     	role:role,
                     	country:country,
                     	industry:industry,
                     	position:position,
                     	salary:salary,
                     	montlySalary:montlySalary,
                     	experienceDescription:experienceDescription,
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
