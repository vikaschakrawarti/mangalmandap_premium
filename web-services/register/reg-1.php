<?php
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();

/*-- Dynamic field data fetch --*/
$SQL_STATEMENT_occupation = $DatabaseCo->dbLink->query("SELECT ocp_id,ocp_name FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
$SQL_STATEMENT_education = $DatabaseCo->dbLink->query("SELECT edu_id,edu_name FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
$SQL_STATEMENT_education1 = $DatabaseCo->dbLink->query("SELECT edu_id,edu_name FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
/*-- /. Dynamic field data fetch --*/
	

/*-- Session data first form --*/
if (isset($_SESSION['reg_fnmae']) && $_SESSION['reg_fnmae'] != '') {
    $reg_caste = $_SESSION['reg_caste'];
    $reg_email = $_SESSION['reg_email'];
    $reg_country = $_SESSION['reg_country'];
    $reg_bday = $_SESSION['reg_bday'];
    $reg_fnmae = $_SESSION['reg_fnmae'];
    $reg_lnmae = $_SESSION['reg_lnmae'];
    $reg_gender = trim($_SESSION['reg_gender']);
    $reg_m_tongue = $_SESSION['reg_m_tongue'];
    $reg_mobilecode = $_SESSION['reg_code'];
    $reg_mobile = $_SESSION['reg_mobile'];
    $reg_profile_by = $_SESSION['reg_profile_by'];
    $reg_religion = $_SESSION['reg_religion'];
}
/*-- ./ Session data first form --*/

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry,weight,body_type,complexion,physical_status,additional_degree,annual_income,diet,smoke,drink,dosh,star,rasi,birthtime,birthplace,family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister,profile_text FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);

?>

<!-- Chosen css -->
<link rel="stylesheet" href="css/prism.css">
<link rel="stylesheet" href="css/chosen.css">
<!-- /. Chosen css -->

<div class="container">
    <div class="row mt-10 inRegTopTitle">
        <div class="col-xxl-11">
            <div class="row">
                <div class="col-xxl-2">
                    <img src="img/register-img.png" class="img-responsive">
                </div>
                <div class="col-xxl-14">
                    <h3 class="gt-text-green">
                        <?php echo $lang['Completing this page will take you closer to your perfect match']; ?>.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="gtRegister col-xxl-11">
        <div class="row mb-20">
            <img src="img/reg-step-1.png" class="img-responsive">
        </div>
		<h3 class="gt-text-green mb-10 fontMerriWeather">
        	<i class="fa fa-user mr-10"></i><?php echo $lang['Personal Information']; ?>
        </h3>
        <article>
           <p>
              <?php echo $lang['You have many matching profiles based on your details. Completing this page will take you closer to your perfect match.']; ?>
           </p>
        </article>
        <b class="text-danger mr-5 gtRegMandatory">*</b><b class="gt-text-Grey"><?php echo $lang['Mandatory fields']; ?></b>
                  	
        <form id="register_form" name="register_form" method="post" action="" class="">
            <input type="hidden" name="matri_id" value="">
            <h4 class="gtRegTitle mt-30 inThemeOrange">
                <i class="fas fa-user-circle mr-10 fa-fw"></i> <?php echo $lang['Account Information']; ?> 
            </h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['First Name']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control" name="fname" id="fname" data-validetta="required" placeholder="<?php echo $lang['Enter Your Firstname']; ?>" value="<?php
							if (isset($reg_fnmae)) {
								echo ucfirst($reg_fnmae);
							}
                        ?>" >   
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Last Name']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control" name="lname" id="lname" data-validetta="required"  placeholder="<?php echo $lang['Enter Your Lastname']; ?>" value="<?php
                        if (isset($reg_lnmae)) {
                            echo ucfirst($reg_lnmae);
                        }
                        ?>" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Email Id']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="hidden" name="email" value="<?php
                        if (isset($reg_email)) {
                            echo $reg_email;
                        }
                        ?>">
                        <input type="text" class="gt-form-control gtDisabled" name="email" id="email" data-validetta="required,email" value="<?php
                        if (isset($reg_email)) {
                            echo $reg_email;
                        }
                        ?>" placeholder="<?php echo $lang['Enter Your Proper Email Id']; ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Password']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="password" class="gt-form-control" name="password" id="password" value="" placeholder="<?php echo $lang['Enter Your Password']; ?>" data-validetta="required,minLength[5]">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Confirm Password']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="password" class="gt-form-control " name="cpassword" id="cpassword" data-validetta="required,equalTo[password]" value="" placeholder="<?php echo $lang['Enter Your Confirm Password']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Mobile No']; ?>.</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control gtDisabled" name="mobile" id="mobile" data-validetta="required" value="<?php echo $reg_mobilecode . '-' . $reg_mobile; ?>" disabled>
                    </div>
                </div>
            </div>
            <h4 class="gtRegTitle mt-30 inThemeOrange">
            	<i class="fa fa-user mr-10 fa-fw"></i><?php echo $lang['Some Personal Information']; ?>
            </h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Gender']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <label for="male" class="gt-inline-block">
                            <span class="pull-left mr-10">
                                <?php echo $reg_gender; ?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Date Of Birth']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <label for="male" class="gt-inline-block">
                            <span class="pull-left mr-10">
                                <?php echo date('d/ m /Y', strtotime($reg_bday)); ?>                                        
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Marital status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                    	<input type="radio" name="mstatus" value="Never Married" id="never-married" class="mt-0 pull-left pr-10" data-validetta="required" onClick="check_ststus('never-married')">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="never-married">Never Married</label>
                        
                        <?php if($reg_gender=="Male"){ ?>
							<input type="radio" name="mstatus" value="Widower" id="widower" class="mt-0 pull-left pr-10" data-validetta="required" onClick="check_ststus('widower')">
							<label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="widower">Widower</label>
                        <?php } ?>
                        
                        <?php if($reg_gender=="Female"){ ?>
							<input type="radio" name="mstatus" value="Widow" id="widow" class="mt-0 pull-left pr-10" data-validetta="required" onClick="check_ststus('widow')">
							<label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="widow">Widow</label>
                        <?php } ?>
                        
                        <div class="clearfix visible-xs visible-sm"></div>
                        
                        <input type="radio" name="mstatus" value="Divorced" id="divorced" class="mt-0 pull-left pr-10" data-validetta="required" onClick="check_ststus('divorced')">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="divorced">Divorced</label>
                        
                        <input type="radio" name="mstatus" value="Awaiting Divorce" id="awaiting-divorce" class="mt-0 pull-left pr-10" data-validetta="required" onClick="check_ststus('awaiting-divorce')">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="awaiting-divorce">Awaiting Divorce</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="dis_child">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['No. of children']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="no_child" onchange="check_child(this.value)">
							<option value="">Select</option>
                           	<option value="No child">None</option>
                            <option value="One">One</option>
                            <option value="Two">Two</option>
                            <option value="Three">Three</option>
                            <option value="Four and above">Four and above</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" id="dis_child_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                          <b><?php echo $lang['Children Living Status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="child_status">
                            <option value="">Select</option>
                            <option value="Living with me">Living with me</option>
                            <option value="Not living with me">Not living with me</option>
                        </select>
                    </div>
                </div>
            </div>	
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Religion']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="hidden" name="religion" value="<?php echo $reg_religion;?>">
                        <select class="gt-form-control gtDisabled" id="religion" name="religion" data-validetta="required" disabled>
                            <option value="">Select Your Religion </option>
                            <?php
                            	$SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                           	?>
                            	<option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" <?php if (isset($_SESSION['reg_religion']) && $_SESSION['reg_religion'] == $DatabaseCo->dbRow->religion_id) { echo "selected"; }?>>
									<?php echo $DatabaseCo->dbRow->religion_name; ?>
								</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Caste']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" id="caste" name="caste" data-validetta="required">
                            <option value="">Select Your Related Caste </option>
                            <?php
                           		$SQL_STATEMENT_CASTE = $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' AND religion_id='".$reg_religion."' ORDER BY caste_name ASC") or die(mysqli_error($DatabaseCo->dbLink));
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_CASTE)) {
                            ?>		
                            	<option value="<?php echo $DatabaseCo->dbRow->caste_id; ?>" <?php if ($DatabaseCo->dbRow->caste_id == $reg_caste) { echo "selected"; } ?>>
									<?php echo $DatabaseCo->dbRow->caste_name; ?>
								</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->will_to_marry == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <label class="col-xxl-16 col-xs-16 text-center" for="willingToMarry">
                        <span class="mr-10">
                            <input type="checkbox" id="willingToMarry" name="will_to_mary_caste" value="1">
                        </span>
                        <span class="gt-text-Grey font-13">
                            <?php echo $lang['Willing to marry in other caste?']; ?>
                        </span>
                    </label>
                </div>
            </div>
			<?php } ?>
            <?php if($row_field->sub_caste == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Sub Caste']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select"  name="subcaste" id="subcaste">
                            <option value="">Select Your Sub Caste</option>
                            <?php
								$SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_id,sub_caste_name FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
                            	while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->Row->sub_caste_id; ?>" <?php if($DatabaseCo->dbRow->subcaste == $DatabaseCo->Row->sub_caste_id){ echo "selected" ; }?>>
								<?php echo $DatabaseCo->Row->sub_caste_name; ?>
							</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Mother Tongue']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" id="m_tongue" name="m_tongue" data-validetta="required" >
                            <option value="">Select Your Mother Tongue </option>
							<?php
								$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>" <?php if(isset($_SESSION['reg_m_tongue'])){ if($_SESSION['reg_m_tongue'] == $DatabaseCo->dbRow->mtongue_id) { echo "selected"; }}?>>
								    <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
								</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory LH-0">*</b><b><?php echo $lang['Country Living In']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" name="country" id="country" data-validetta="required" >
                            <option value="">Select Country living in</option>
                            <?php
                                $SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" <?php if(isset($_SESSION['reg_country'])){ if($DatabaseCo->dbRow->country_id == $_SESSION['reg_country']) { echo "selected"; }} ?>><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                            <?php } ?>
                        </select>
                        <div id="status1"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Residing State']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" data-validetta="required" id="state" name="state">
                            <option value="">Select Residing State</option>
                        </select>
                        <div id="status2"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Residing City']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" data-validetta="required" id="city" name="city">
                            <option value="">Select Residing City</option>
                        </select>
                    </div>
                </div>
            </div>
           	<h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-walking mr-10 fa-fw"></i><?php echo $lang['Physical Attributes']; ?> </h4>            		
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Height']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control"  name="height" data-validetta="required">
                            <option value="">Select Height In ft</option>
                           	<?php
                                $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->height; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->weight == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Weight']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="weight" <?php if($row_field->weight == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                            <option value="">Select Weight In Kg</option>
                            <?php
                                $SQL_SITE_SETTING_WEIGHT = $DatabaseCo->dbLink->query("SELECT weight_first,weight_last FROM site_config WHERE id='1' ");
                                $weight_data = mysqli_fetch_object($SQL_SITE_SETTING_WEIGHT);
                                $weight_first=$weight_data->weight_first;
                                $weight_last=$weight_data->weight_last;
                                for ($x = $weight_first; $x <= $weight_last; $x++) { ?>
                                <option value='<?php echo $x; ?>'>
                                    <?php echo $x; ?> Kg
                                </option>
                             <?php } ?>	
                        </select>
					</div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->body_type == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Body type']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="bodytype" value="Slim" id="Slim" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Slim">Slim</label>
                        
                        <input type="radio" name="bodytype" value="Average" id="Average" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Average">Average</label>
                        
                        <div class="clearfix visible-xs visible-sm"></div>
                        <input type="radio" name="bodytype" value="Athletic" id="Athletic" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Athletic">Athletic</label>   
                        
                        <input type="radio" name="bodytype" value="Heavy" id="Heavy" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Heavy">Heavy</label>
                     </div>
				</div>
			</div>
			<?php } ?>
			<?php if($row_field->complexion == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Complexion']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="complexion" value="Very Fair" id="Very-Fair" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Very-Fair">Very Fair</label>
                        
                        <input type="radio" name="complexion" value="Fair" id="Fair" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Fair">Fair</label>
                        
                        <div class="clearfix visible-xs"></div>
                        <input type="radio" name="complexion" value="Wheatish" id="Wheatish" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Wheatish">Wheatish</label>
                        
                        <input type="radio" name="complexion" value="Wheatish Brown" id="Wheatish-brown" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Wheatish-brown">Wheatish brown</label>
                        
                        <input type="radio" name="complexion" value="Dark" id="Dark" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Dark">Dark</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->physical_status == 'Yes'){ ?> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Physical status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                       <input type="radio" name="physicalStatus" value="Normal" id="Normal" class="mt-0 pull-left pr-10" data-validetta="required" >
                       <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Normal">Normal</label>
                        
                       <input type="radio" name="physicalStatus" value="Physically-challenged" id="Physically-challenged" class="mt-0 pull-left" data-validetta="required">
                       <label class="pull-left font-13 gt-font-weight-500 pl-5" for="Physically-challenged">Physically challenged</label>
                    </div>
                </div>
            </div>
			<?php } ?>
            <h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-book mr-10 fa-fw"></i><?php echo $lang['Education & Occupation']; ?></h4> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Highest Education']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" data-validetta="required" name="education">
                            <option value="">Select Your Highest Education</option>
                            <?php
                               $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
                               while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu)){
                            ?>
                               <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->additional_degree == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                           <b><?php echo $lang['Additional Degree']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" name="other_education">
                            <option value="">Select Your Additional Degree </option>
                            <?php
                               $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
                               while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu)){
                            ?>
                               <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                           <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Occupation']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select"  data-validetta="required" name="occupation" >
                            <option value="">Select Your Occupation</option>
                            <?php
                                $SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Employed in']; ?> </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="employedin" value="Government" id="Government" class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Government">Government</label>
                        
                        <input type="radio" name="employedin" value="Private" id="Private"  class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Private">Private</label>
                        
                        <input type="radio" name="employedin" value="Business" id="Business"  class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Business">Business</label>
                        
						<div class="clearfix mb-10"></div>
                        <input type="radio" name="employedin" value="Defence" id="Defence"  class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Defence">Defence</label>
                        
                        <input type="radio" name="employedin" value="Self Employed" id="Self-Employed"  class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Self-Employed">Self Employed</label>
                        
						<?php if ($_SESSION['reg_gender'] == 'Female') { ?>
						<input type="radio" name="employedin" value="Not Working" id="Not-Working"  class="mt-0 pull-left pr-10" data-validetta="required">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Not-Working">Not Working</label>
						<?php } ?>
                    </div>
                </div>
            </div>
			
			<?php if($row_field->annual_income == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Annual Income']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="income">
                            <option value="">Select Annual Income</option>
                            <?php
                                $SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->income; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			
			<?php if($row_field->diet == 'Yes' || $row_field->smoke == 'Yes' || $row_field->drink == 'Yes'){ ?>
            <h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-glass-martini-alt mr-10 fa-fw"></i><?php echo $lang['Habits']; ?></h4> 
			<?php if($row_field->diet == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Diet']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                       <input type="radio" name="diet" value="Vegetarian" id="Vegetarian" class="mt-0 pull-left pr-10"  <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                       <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Vegetarian">Vegetarian</label>
                        
                       <input type="radio" name="diet" value="Non Vegetarian" id="Non-Vegetarian" class="mt-0 pull-left pr-10" <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                       <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Non-Vegetarian">Non Vegetarian</label>
                        
                       <div class="clearfix visible-xs visible-sm"></div>
                        <input type="radio" name="diet" value="Eggetarian" id="Eggetarian" class="mt-0 pull-left pr-10" <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Eggetarian">Eggetarian</label>
                     </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->smoke == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Smoking']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="smoking" value="No" id="SmokingNo"  class="mt-0 pull-left pr-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="SmokingNo">No</label>
                        
                        <input type="radio" name="smoking" value="Occasionally" id="occasionally" class="mt-0 pull-left pr-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="occasionally">Occasionally</label>
                        
                      	<input type="radio" name="smoking" value="Yes" id="SmokingYes" class="mt-0 pull-left pr-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="SmokingYes">Yes</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->drink == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Drinking']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="drinking" value="No" id="DrinkingNo"  class="mt-0 pull-left pr-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="DrinkingNo">No</label>
                        <input type="radio" name="drinking" value="Drinks Socially" id="Drinks-Socially"  class="mt-0 pull-left pr-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Drinks-Socially">Drinks Socially</label>
                        <input type="radio" name="drinking" value="Yes" id="DrinkingYes"  class="mt-0 pull-left pr-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="DrinkingYes">Yes</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			<?php if($row_field->dosh == 'Yes' || $row_field->star == 'Yes' || $row_field->rasi == 'Yes' || $row_field->birthtime == 'Yes' || $row_field->birthplace == 'Yes'){ ?>
            <h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-moon mr-10 fa-fw"></i><?php echo $lang['Horoscope Details']; ?></h4>
            <article class="mb-25">
				<p><?php echo $lang['We suggest our members to please insert your horoscope details even of you dont believe in it because our lots of members interested in this detail']; ?>.</p>
            </article>
			<?php if($row_field->dosh == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey"><b><?php echo $lang['Have Dosh?']; ?></b></label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <div>
                            <label for="doshNo" class="gt-inline-block">
                                <span class="pull-left mr-10">
                                    <input type="radio" name="dosh" value="No" id="doshNo" class="mt-0" onClick="check_dosh('No')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">No</span>
                            </label>
                            <label for="doshYes" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left mr-10 ">
                                    <input type="radio" name="dosh" value="Yes" id="doshYes" class="mt-0" onClick="check_dosh('Yes')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">Yes</span>
                            </label>
                            <label for="doshDontNo" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left mr-10 ">
                                    <input type="radio" name="dosh" value="Do not know" id="doshDontNo" class="mt-0" onClick="check_dosh('0')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">Do not know</span>
                            </label>
                        </div>
                        <div id="dosh_display">
							<select class="chosen-select gt-form-control" data-placeholder="Choose Dosh Type" id="p_star" name="manglik[]" multiple>
                            	<?php
                                    $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
                                ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->dosh_id; ?>"><?php echo $DatabaseCo->dbRow->dosh; ?></option>
                                <?php } ?>
                        	</select>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->star == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Star']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" id="star" name="star">
                            <option value="">Select Your Star </option>
                            <?php
                                $SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_STAR)){
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->star_id; ?>" ><?php echo $DatabaseCo->dbRow->star; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->rasi == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Raasi/Moonsign']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" name="raasi">
                            <option value="">
                                Select Your Related Raasi/Moonsign
                            </option>
                           	<?php
                                $SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_RASI)){
                            ?>
                                <option value="<?php echo $DatabaseCo->dbRow->rasi_id; ?>"><?php echo $DatabaseCo->dbRow->rasi; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->birthtime == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Birth Time']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-lg-7">
                        <input type="time" name="birth_time" class="gt-form-control">
                        
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->birthplace == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Birth Place']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" name="birthplace" class="gt-form-control" placeholder="<?php echo $lang['Enter Your Birth Place']; ?>">
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			
			<?php if($row_field->family_status == 'Yes' || $row_field->family_type == 'Yes' || $row_field->family_value == 'Yes' || $row_field->father_occupation == 'Yes' || $row_field->mother_occupation == 'Yes' || $row_field->no_of_brother == 'Yes' || $row_field->no_of_married_brother == 'Yes' || $row_field->no_of_sister == 'Yes' || $row_field->no_of_married_sister == 'Yes'){ ?>
            <h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-users mr-10 fa-fw"></i><?php echo $lang['Family Profile']; ?></h4>
			<?php if($row_field->family_status == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Family status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="family_status" value="Middle class" id="Middle-class" class="mt-0 pull-left pr-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Middle-class">Middle class</label>   
                        <input type="radio" name="family_status" value="Upper middle class" id="Upper-middle-class" class="mt-0 pull-left pr-10"  <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Upper-middle-class">Upper middle class</label>
                        <input type="radio" name="family_status" value="Rich" id="Rich" class="mt-0 pull-left pr-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Rich">Rich</label>
                        <input type="radio" name="family_status" value="Affluent" id="Affluent" class="mt-0 pull-left pr-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Affluent">Affluent</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->family_type == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Family type']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="family_type" value="Joint" id="Joint" class="mt-0 pull-left pr-10"  <?php if($row_field->family_type == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Joint">Joint</label>
                            
                        <input type="radio" name="family_type" value="Nuclear" id="Nuclear" class="mt-0 pull-left pr-10" <?php if($row_field->family_type == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Nuclear">Nuclear</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->family_value == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Family value']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="radio" name="family_values" value="Orthodox" id="Orthodox" class="mt-0 pull-left pr-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Orthodox">Orthodox</label>
                        <input type="radio" name="family_values" value="Traditional" id="Traditional" class="mt-0 pull-left pr-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Traditional">Traditional</label>
                        <div class="clearfix visible-xs visible-sm"></div>
                        <input type="radio" name="family_values" value="Moderate" id="Moderate" class="mt-0 pull-left pr-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Moderate">Moderate</label>
                        <input type="radio" name="family_values" value="Liberal" id="Liberal" class="mt-0 pull-left pr-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Liberal">Liberal</label>
                   </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->father_occupation == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Father Occupation']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
						<input type="text" name="father_occupation" value="" class="gt-form-control" placeholder="<?php echo $lang['Enter Father Occupation']; ?>">
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->mother_occupation == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Mother Occupation']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" name="mother_occupation" value="" class="gt-form-control" placeholder="<?php echo $lang['Enter Mother Occupation']; ?>">
                    </div>
                </div>
            </div>
			<?php } ?> 
			<?php if($row_field->no_of_brother == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['No. of Brothers']; ?> </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_brothers" class="gt-form-control" onChange="check_brother_sister('brother', this.value)" >
							<option value="No Brother">No Brother</option>
                            <option value="1 Brother">1 Brother</option>
                            <option value="2 Brothers">2 Brothers</option>
                            <option value="3 Brothers">3 Brothers</option>
                            <option value="4 Brothers">4 Brothers</option>
                            <option value="4 + Brothers">4 + Brothers</option>  
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_married_brother == 'Yes'){ ?>
            <div class="form-group" id="brothers_married_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Married Brothers']; ?> </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_marri_brothers" class="gt-form-control" >
							<option value="No married brother">No married brother</option>
                            <option value="1 married brother">1 married brother</option>
                            <option value="2 married brothers">2 married brothers</option>
                            <option value="3 married brothers">3 married brothers</option>
                            <option value="4 married brothers">4 married brothers</option>
                            <option value="4 + married brothers">4+ married brothers</option>  
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_sister == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['No. of Sisters']; ?> </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_sisters" class="gt-form-control"  onChange="check_brother_sister('sister', this.value)" >
							<option value="No Sister">No Sister</option>
                            <option value="1 Sister">1 Sister</option>
                            <option value="2 Sisters">2 Sisters</option>
                            <option value="3 Sisters">3 Sisters</option>
                            <option value="4 Sisters">4 Sisters</option>
                            <option value="4 + Sisters">4 + Sisters</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_married_sister == 'Yes'){ ?>
            <div class="form-group" id="sisters_married_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Married Sisters']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_marri_sister" class="gt-form-control" >
							<option value="No married sister">No married sister</option>
                            <option value="1 married sister">1 married sister</option>
                            <option value="2 married sisters">2 married sisters</option>
                            <option value="3 married sisters">3 married sisters</option>
                            <option value="4 married sisters">4 married sisters</option>
                            <option value="4+ married sisters">4+ married sisters</option>
						</select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			
			<?php if($row_field->profile_text == 'Yes'){ ?>
            <h4 class="gtRegTitle mt-30 inThemeOrange"><i class="fas fa-user-edit mr-10 fa-fw"></i><?php echo $lang['Something About You']; ?> </h4>
            <article class="mb-30">
                <p>
                    <?php echo $lang['Write some of about you.for example which kind of person you are ,about your']; ?> <b><?php echo $lang['Personality']; ?></b>,<b><?php echo $lang['Hobbies']; ?></b>,<b><?php echo $lang['About your family']; ?></b> <?php echo $lang['ect']; ?>.
                </p>
            </article>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger mr-5 gtRegMandatory">*</b><b><?php echo $lang['Something About You']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <textarea class="gt-form-control" rows="5" cols="5" name="profile_text" data-validetta="required,minLength[50]"></textarea>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group text-center">
                <input type="submit" name="submit" id="submit" value="<?php echo $lang['Continue']; ?>" class="btn gt-btn-green inRegBtn">
            </div>	
		</form>
    </div>
    <div class="col-xxl-5">
        <div class="gtRegisterBucket text-center mt-30">
            <i class="fas fa-mobile-alt index-color-1"></i>
            <h4 class="index-color-1"><?php echo $lang['Mobile Verified Profiles']; ?></h4>
        </div>
        <div class="gtRegisterBucket text-center">
            <i class="fas fa-users index-color-2"></i>
            <h4 class="index-color-2"><?php echo $lang['Many Happy Couples']; ?></h4>
        </div>
        <div class="gtRegisterBucket text-center">
            <i class="fas fa-check index-color-3"></i>
            <h4 class="index-color-3"><?php echo $lang['Most Trusted Matrimony']; ?></h4>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {

        $('#dis_child').hide();
        $('#dosh_display').hide();
        $('#dis_child_status').hide();
        $('#brothers_married_status').hide();
        $('#sisters_married_status').hide();
        $("#status1").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id = '<?php echo $reg_country; ?>';
        var dataString = 'id=' + id;
        $.ajax({
            type: "post",
            url: "ajax_country_state",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#state").html(html);
                $("#status1").html('');
				$("#state").trigger("chosen:updated");
            }
        });

    });
	function check_brother_sister(child, status) {
        if (child == 'brother' && status != "" && status != "No Brothers"){
            $('#brothers_married_status').show();
        }
		
        if (child == 'sister' && status != "" && status != "No Sisters"){
            $('#sisters_married_status').show();
        }
		
    }
    /*function check_brother_sister(child, status) {
        if (child == 'brother' && status != "No Brother" && status !=''){
            $('#brothers_married_status').show();
        }else{
			$('#brothers_married_status').hide();
		}
        if (child == 'sister' && status != "No Sister" && status !=''){
            $('#sisters_married_status').show();
        }else{
			$('#sisters_married_status').hide();
		}
    }*/
    function check_ststus(status) {
        if (status == 'never-married'){
            $('#dis_child').hide();
            $('#dis_child_status').hide();
        }
        if (status == 'widower'){
            $('#dis_child').show();
        }
        if (status == 'widow'){
            $('#dis_child').show();
        }
		if (status == 'divorced'){
            $('#dis_child').show();
        }
	
        if (status == 'awaiting-divorce'){
            $('#dis_child').show();
        }
    }
    function check_dosh(status){
        if (status == 'No'){
            $('#dosh_display').hide();
        }
        if (status == 'Yes'){
            $('#dosh_display').show();
        }
        if (status == '0'){
            $('#dosh_display').hide();
        }
     }

    function check_child(val){
        if (val != '0' && val != ''){
            $('#dis_child_status').show();
        } else {
            $('#dis_child_status').hide();
        }
    }
    $(document).ready(function() {
        $("#bodytype-alert").hide();
        $("#complexion-alert").hide();
        $("#physicalStatus-alert").hide();
        $("#employedin-alert").hide();
        $("#smoking-alert").hide();
        $("#diet-alert").hide();
        $("#drinking-alert").hide();
        $("#family_status-alert").hide();
        $("#family_type-alert").hide();
        $("#family_values-alert").hide();
        $("#submit").click(function() {
            if ($("input[name=bodytype]:checked").length == 0) {
                $("#bodytype-alert").show();
            } else {
                $("#bodytype-alert").hide();
            }
            if ($("input[name=complexion]:checked").length == 0) {
                $("#complexion-alert").show();
            } else {
                $("#complexion-alert").hide();
            }
            if ($("input[name=physicalStatus]:checked").length == 0) {
                $("#physicalStatus-alert").show();
            } else {
                $("#physicalStatus-alert").hide();
            }
            if ($("input[name=employedin]:checked").length == 0) {
                $("#employedin-alert").show();
            } else {
                $("#employedin-alert").hide();
            }
            if ($("input[name=diet]:checked").length == 0) {
                $("#diet-alert").show();
            } else {
                $("#diet-alert").hide();
            }
            if ($("input[name=smoking]:checked").length == 0) {
                $("#smoking-alert").show();
            } else {
                $("#smoking-alert").hide();
            }
            if ($("input[name=drinking]:checked").length == 0) {
                $("#drinking-alert").show();
            } else {
                $("#drinking-alert").hide();
            }
            if ($("input[name=family_status]:checked").length == 0) {
                $("#family_status-alert").show();
            } else {
                $("#family_status-alert").hide();
            }
            if ($("input[name=family_type]:checked").length == 0) {
                $("#family_type-alert").show();
            } else {
                $("#family_type-alert").hide();
            }
            if ($("input[name=family_values]:checked").length == 0) {
                $("#family_values-alert").show();
            } else {
                $("#family_values-alert").hide();
            }
        });
    });
</script>
 		<!-- Chosen Js -->
        <script src="js/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        <!-- /. Chosen Js -->