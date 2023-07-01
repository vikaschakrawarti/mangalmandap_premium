<?php
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$reg_caste = "";
$reg_email = "";

if (isset($_SESSION['reg_fnmae']) && $_SESSION['reg_fnmae'] != '') {
    $reg_caste = $_POST['caste'];
    $reg_email = $_POST['email'];
    $reg_password = md5($_POST['password']);
    $reg_country = $_POST['country'];
    $reg_bday = $_SESSION['reg_bday'];
    $reg_fnmae = $_POST['fname'];
    $reg_lnmae = $_POST['lname'];
    $reg_gender = trim($_SESSION['reg_gender']);
    $reg_code = $_SESSION['reg_code'];
    $reg_mobile = $_SESSION['reg_mobile'];
    $reg_profile_by = $_SESSION['reg_profile_by'];
    $reg_religion = $_POST['religion'];
    $reg_m_tongue = $_POST['m_tongue'];
    
    $mstatus = $_POST['mstatus'];
    $birth_time = $_POST['birth_time'];
    $birthplace = $_POST['birthplace'];
    $no_child = isset($_POST['no_child']) ? $_POST['no_child'] : '';
    $child_status = isset($_POST['child_status']) ? $_POST['child_status'] : '';
	if($_POST['will_to_mary_caste'] != ''){
		$will_to_mary_caste= $_POST['will_to_mary_caste'];
	}else{
		$will_to_mary_caste="0";
	}
    $state = $_POST['state'];
    $city = $_POST['city'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bodytype = $_POST['bodytype'];
    $complexion = $_POST['complexion'];
    $physicalStatus = $_POST['physicalStatus'];
    $education = $_POST['education'];
    $other_education = $_POST['other_education'];
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : "";
	$subcaste = isset($_POST['subcaste']) ? $_POST['subcaste'] : "";
    $employedin = isset($_POST['employedin']) ? $_POST['employedin'] : "";
    $income = $_POST['income'];
    $diet = $_POST['diet'];
    $smoking = $_POST['smoking'];
    $drinking = $_POST['drinking'];
    $dosh = $_POST['dosh'];
    if (isset($_POST['manglik'])) {
        $manglik = implode(",", $_POST['manglik']);
    } else {
        $manglik = '';
    }
    $star = $_POST['star'];
    $raasi = $_POST['raasi'];
    $family_status = $_POST['family_status'];
    $family_type = $_POST['family_type'];
    $family_values = $_POST['family_values'];
    $father_occupation = $_POST['father_occupation'];
    $mother_occupation = $_POST['mother_occupation'];
    $profile_text = $_POST['profile_text'];
	$profile_text_date= date('H:i:s Y-m-d ');
    $no_of_brothers = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_brothers']);
    $no_of_marri_brothers = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_marri_brothers']);
    $no_of_sisters = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_sisters']);
    $no_of_marri_sister = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_marri_sister']);
    $status = 'Inactive';
    $ip = $_SERVER['REMOTE_ADDR'];
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $tm = mktime(date('h') + 5, date('i') + 30, date('s'));
    $reg_date = date('Y-m-d h:i:s', $tm);
    $order_status = "No";
    $photo_protect = "No";
    $FETCH_PREFIX = $DatabaseCo->dbLink->query("SELECT prefix FROM site_config WHERE id='1'");
    $row_prfix = mysqli_fetch_object( $FETCH_PREFIX);
    $prefix = $row_prfix->prefix;
    $adminrole_id = '1';
    $adminrole_view_status = 'Yes';
    $SQL_CHECK_EMAIL =  $DatabaseCo->dbLink->query("SELECT matri_id FROM register WHERE email='".$_SESSION['reg_email']."'");
    if (mysqli_num_rows($SQL_CHECK_EMAIL) == '0') {
        $fname = $reg_fnmae;
        $lname = $reg_lnmae;
        $SQL_STATEMENT = $DatabaseCo->dbLink->query("INSERT INTO register (prefix,email,password,gender,username,firstname,lastname,birthdate,religion,caste,subcaste,country_id,mobile,mobile_code,m_tongue,m_status,birthtime,birthplace,tot_children,status_children,will_to_mary_caste,state_id,city,height,weight,bodytype,complexion,physicalStatus,edu_detail,occupation,emp_in,income,diet,smoke,drink,dosh,manglik,star,moonsign,family_status,family_type,family_value,father_occupation,mother_occupation,profile_text,profile_text_approve,profile_text_date,no_of_brothers,no_of_sisters,no_marri_sister,no_marri_brother,status,ip,agent,adminrole_id,adminrole_view_status,reg_date,profileby,photo_view_status,photo_protect) VALUES ('".$prefix."','".$reg_email."','".$reg_password."','".$reg_gender."','".$fname." " .$lname."','".$fname."','".$lname."','".$reg_bday."','".$reg_religion."','".$reg_caste."','".$subcaste."','".$reg_country."','".$reg_mobile."','". $reg_code."','".$reg_m_tongue."','".$mstatus."','".$birth_time."','".$birthplace."','".$no_child."','".$child_status."','".$will_to_mary_caste. "','".$state."','".$city."','".$height."','".$weight."','".$bodytype."','".$complexion."','".$physicalStatus."','".$education. ',' . $other_education."','".$occupation."','".$employedin."','".$income."','".$diet."','".$smoking."','".$drinking."','".$dosh."','".$manglik."','". $star."','".$raasi."','".$family_status."','".$family_type."','".$family_values."','".$father_occupation."','".$mother_occupation."','". $profile_text."','Pending','".$profile_text_date."','".$no_of_brothers."','".$no_of_sisters."','".$no_of_marri_sister."','".$no_of_marri_brothers. "','".$status."','".$ip."','".$agent."','".$adminrole_id."','".$adminrole_view_status."','".$reg_date."','".$reg_profile_by."','1','No')");


        $MAX_INDEX_ID = mysqli_insert_id($DatabaseCo->dbLink);
        $_SESSION['matri_id_reg'] = $matri_id = $prefix . $MAX_INDEX_ID;
        function RandomPassword() {
            $chars = "abcdefghijkmnopqrstuvwxyz023456789";
            srand((double) microtime() * 1000000);
            $i = 0;
            $pass = '';

            while ($i <= 7) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            return $pass;
        }
        $pswd = RandomPassword();
        $upd = mysqli_query($DatabaseCo->dbLink, "UPDATE register SET matri_id='" . $matri_id . "',prefix='".$prefix."',cpassword='$pswd' WHERE index_id='$MAX_INDEX_ID'");
	   
        $SQL_DELETE_FIRST = $DatabaseCo->dbLink->query("DELETE FROM first_form WHERE mobile_no='".$reg_mobile."' AND email_id='".$reg_email."'");
    }
    unset($_SESSION['reg_caste']);
    unset($_SESSION['reg_email']);
    unset($_SESSION['reg_password']);
    unset($_SESSION['reg_country']);
    unset($_SESSION['reg_bday']);
    unset($_SESSION['reg_fnmae']);
    unset($_SESSION['reg_gender']);
    unset($_SESSION['reg_m_tongue']);
    unset($_SESSION['reg_mobile']);
    unset($_SESSION['reg_profile_by']);
    unset($_SESSION['reg_religion']);
}

if (isset($_POST['chk_terms'])) {
    $matri_id = $_POST['matri_id'];
    $fname = isset($_POST['fname']) ? ucfirst(strtolower($_POST['fname'])) : '';
}

$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_physical_status,part_diet,part_drink,part_smoke,part_dosh,part_star,part_state,part_city,part_annual_income,part_expect FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<script type="text/javascript">
    function check_ststus(status){
      if (status == 'any'){
            $('#never-married').attr('checked', false);
            $('#widower').attr('checked', false);
            $('#divorced').attr('checked', false);
            $('#awaiting-divorce').attr('checked', false);
       }
        if (status == 'never-married'){
            $('#any-married').attr('checked', false);
        }
       if (status == 'widower'){
            $('#any-married').attr('checked', false);
        }
        if (status == 'divorced') {
            $('#any-married').attr('checked', false);
        }
        if (status == 'awaiting-divorce'){
            $('#any-married').attr('checked', false);
        }
    }

    function check_ststus_eat(status){
       if (status == 'doesnt-matter'){
            $('#vegetarian').attr('checked', false);
            $('#non-vegetarian').attr('checked', false);
            $('#eggetarian').attr('checked', false);
        }
        if (status == 'vegetarian'){
            $('#doesnt-matter').attr('checked', false);
        }
        if (status == 'non-vegetarian') {
            $('#doesnt-matter').attr('checked', false);
        }
        if (status == 'eggetarian'){
            $('#doesnt-matter').attr('checked', false);
        }
    }
    function check_ststus_smoke(status){
        if (status == 'doesnt-matter-smoke'){
            $('#never-smoke').attr('checked', false);
            $('#occasionally').attr('checked', false);
            $('#yes').attr('checked', false);
        }
        if (status == 'no'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
        if (status == 'occasionally'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
        if (status == 'yes'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
    }
    function check_ststus_drink(status){
        if (status == 'doesnt-matter-drink'){
            $('#never-drink').attr('checked', false);
            $('#drink-socially').attr('checked', false);
            $('#drink-yes').attr('checked', false);
        }
        if (status == 'no') {
            $('#doesnt-matter-drink').attr('checked', false);
        }
        if (status == 'drink-socially'){
            $('#doesnt-matter-drink').attr('checked', false);
        }
        if (status == 'drink-yes'){
            $('#doesnt-matter-drink').attr('checked', false);
        }
    }
</script>
<div class="container" id="top">
    <div class="row gt-margin-top-10 inRegTopTitle">
        <div class="col-xxl-11">
            <div class="row">
                <div class="col-xxl-14">
                    <h3 class="gt-text-green">
                        <?php echo $lang['Tell some details about your life partner']; ?>.
                    </h3>
                    <article>
                        <p>
                            <?php echo $lang['Tell us which kind of life partner you want to marry and we will find for you.Just fill below details and step closer to your life partner']; ?>.
                        </p>
                    </article>
                </div>
                <div class="col-xxl-2">
                    <img src="img/register-pref-img.png" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <div class="gtRegister col-xxl-11 " >
        <div class="row gt-margin-bottom-20">
            <img src="img/reg-step-2.png" class="img-responsive">
        </div>
        <form method="post" action="register-photo-upload" name="reg_form_2" id="reg_form_2">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['matri_id_reg']; ?>">
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green pb-10 gtRegTitle"><i class="fas fa-user-circle gt-margin-right-10"></i><?php echo $lang['Basic Preference']; ?></h3>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Age']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <div class="row">
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="pfromage" data-validetta="required" id="from_age">
                                    <option value="" >- Age -</option>
                                    <?php
                                        //Make 18 Year Selected for Search
                                        $selected_a='1';

                                        $SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                        while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
                                    ?>
                                        <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <h5 class="text-center">
                                    <?php echo $lang['To']; ?>
                                </h5>
                            </div>
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="ptoage" data-validetta="required" id="part_to_age">
                                    <option value="" >- Age -</option>
                                    <?php
                                    //Make 18 From & 30 To Year Selected for Search
                                    $selected_b='13';

                                    $SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                    while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
                                    ?>
                                      <option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
                                              <?php if($DatabaseCo->dbRow->id <= $selected_a ){ 
                                                        echo 'disabled'; 
                                                    }if($selected_b == $DatabaseCo->dbRow->id ){
                                                        echo 'selected';	
                                                    } 
                                              ?>>
                                          <?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                    <?php } ?>  
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Height']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <div class="row">
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="pfronheight" data-validetta="required" id="from_height"> 
                                    <option value="">From height</option>
									<?php
                                    $selected_h_a='2';
                                    $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_h_a) != '' ){ if($selected_h_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <h5 class="text-center">
                                    <?php echo $lang['To']; ?>
                                </h5>
                            </div>
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="ptoheight" data-validetta="required" id="part_to_height">
                                    <option value="">To height</option>
                                    <?php
                                    $selected_h_b='13';

                                    $SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
                                    <?php if($DatabaseCo->dbRow->id < $selected_h_b ){ 
                                                echo 'disabled'; 
                                            }if($selected_h_b == $DatabaseCo->dbRow->id ){
                                                echo 'selected';	
                                            } 
                                      ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Marital status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 mt-10">
                        <input type="checkbox" name="pmstatus[]" value="Does Not Matter" id="any-married" class="mt-0 pull-left pr-10" data-validetta="minChecked[1]" onclick="check_ststus('any');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="any-married">Does Not Matter</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Never Married" id="never-married" class="mt-0 pull-left pr-10" data-validetta="minChecked[1]" onclick="check_ststus('never-married');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="never-married">Never Married</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Widower" id="widower" class="mt-0 pull-left pr-10" data-validetta="minChecked[1]" onclick="check_ststus('widower');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="widower">Widower</label>
                        <div class="clearfix visible-xs"></div>
                        
                        <input type="checkbox" name="pmstatus[]" value="Divorced" id="divorced" class="mt-0 pull-left pr-10" data-validetta="minChecked[1]" onclick="check_ststus('divorced');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="divorced">Divorced</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Awaiting Divorce" id="awaiting-divorce" class="mt-0 pull-left pr-10" data-validetta="minChecked[1]" onclick="check_ststus('awaiting-divorce');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="awaiting-divorce">Awaiting Divorce</label>
                    </div>
                </div>
            </div>

			<?php if($row_field->part_physical_status == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Physical status']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="p_physical" value="Does Not Matter" id="doesntMatter" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="doesntMatter">Does Not Matter</label>
                        
                        <input type="radio" name="p_physical" value="Normal" id="Normal" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Normal">Normal</label>
                        
                        <input type="radio" name="p_physical" value="Physically challenged" id="Physically-challenged" class="mt-0 pull-left pr-10">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="Physically-challenged">Physically challenged</label>
                    </div>
                </div>
            </div>
			<?php } ?>

			<?php if($row_field->part_diet == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Eating Habits']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="checkbox" name="p_diet[]" value="Does Not Matter" id="doesnt-matter" class="mt-0 pull-left pr-10" onclick="check_ststus_eat('doesnt-matter');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="doesnt-matter">Does Not Matter</label>    
                        
                        <input type="checkbox" name="p_diet[]" value="Vegetarian" id="vegetarian"  class="mt-0 pull-left pr-10" onclick="check_ststus_eat('vegetarian');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="vegetarian">Vegetarian</label>

                        <input type="checkbox" name="p_diet[]" value="Non Vegetarian" id="non-vegetarian"  class="mt-0 pull-left pr-10" onclick="check_ststus_eat('non-vegetarian');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="non-vegetarian">Non Vegetarian</label>
                        <div class="clearfix"></div>
                        
                        <input type="checkbox" name="p_diet[]" value="Eggetarian" id="eggetarian" class="mt-0 pull-left pr-10" onclick="check_ststus_eat('eggetarian');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="eggetarian">Eggetarian</label>
                           
                       
                     </div>
                </div>
            </div>
			<?php } ?>

			<?php if($row_field->part_drink == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Smoking Habits']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                      	<input type="checkbox" name="p_smoke[]" value="Does Not Matter" id="doesnt-matter-smoke"  class="mt-0 pull-left pr-10" onclick="check_ststus_smoke('doesnt-matter-smoke');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="doesnt-matter-smoke">Does Not Matter</label>
                            
                        <input type="checkbox" name="p_smoke[]" value="No" id="never-smoke"  class="mt-0 pull-left pr-10" onclick="check_ststus_smoke('never-smoke');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="never-smoke">Never Smokes</label>
                        
                        <div class="clearfix"></div>
                        <input type="checkbox" name="p_smoke[]" value="Smokes Occasionally" id="occasionally"  class="mt-0 pull-left pr-10" onclick="check_ststus_smoke('occasionally');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="occasionally">Smokes Occasionally</label>
						
                        <input type="checkbox" name="p_smoke[]" value="Smokes Regularly" id="yes"  class="mt-0 pull-left pr-10" onclick="check_ststus_smoke('yes');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="yes">Smokes Regularly</label>
  
                    </div>
                </div>
            </div>
			<?php } ?>

			<?php if($row_field->part_smoke == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Drinking Habits']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        
                        <input type="checkbox" name="p_drink[]" value="Does Not Matter" id="doesnt-matter-drink"  class="mt-0 pull-left pr-10" onclick="check_ststus_drink('doesnt-matter-drink');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="doesnt-matter-drink">Does Not Matter</label>
                            
                        <input type="checkbox" name="p_drink[]" value="No" id="never-drink"  class="mt-0 pull-left pr-10" onclick="check_ststus_drink('never-drink');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="never-drink">Never Drinks</label>
                        
                        <div class="clearfix"></div>
                        <input type="checkbox" name="p_drink[]" value="Drinks Socially" id="drink-socially"  class="mt-0 pull-left pr-10" onclick="check_ststus_drink('drink-socially');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="drink-socially">Drinks Socially</label>
						
                        <input type="checkbox" name="p_drink[]" value="Drinks Regularly" id="drink-yes"  class="mt-0 pull-left pr-10" onclick="check_ststus_drink('drink-yes');">
                        <label class="pull-left font-13 gt-font-weight-500 pl-5 pr-10" for="drink-yes">Drinks Regularly</label>
                    </div>
                </div>
            </div>
			<?php } ?>

            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green pb-10 gtRegTitle"><i class="fa fa-book gt-margin-right-10"></i><?php echo $lang['Religion Preference']; ?></h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Religion']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" name="preligion[]" id="preligion" data-placeholder="Choose Parteners Religion" multiple tabindex="4" data-validetta="required">
                            <option value="Does Not Matter">Does Not Matter</option>
                            <?php
                            	$SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                           	?>
                            	<option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" <?php if (isset($_SESSION['reg_religion']) && $_SESSION['reg_religion'] == $DatabaseCo->dbRow->religion_id) { echo "selected"; }?>>
									<?php echo $DatabaseCo->dbRow->religion_name; ?>
								</option>
                            <?php } ?>
                        </select>
						<div id="caste1"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Caste']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" name="pcaste[]" id="pcaste"  data-validetta="required" multiple>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_dosh == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-margin-top-10 gt-text-light-Grey">
                            <b><?php echo $lang['Have Dosh?']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <div>
                            <label for="doshNo" class="gt-inline-block">
                                <span class="pull-left gt-margin-right-10">
                                    <input type="radio" name="dosh" value="No" id="doshNo" class="mt-0" onClick="check_dosh('No')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">No</span>
                            </label>
                            <label for="doshYes" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left gt-margin-right-10 ">
                                   <input type="radio" name="dosh" value="Yes" id="doshYes" class="mt-0" onClick="check_dosh('Yes')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">Yes</span>
                            </label>
                            <label for="doshDontNo" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left gt-margin-right-10 ">
                                    <input type="radio" name="dosh" value="Does not matter" id="doshDontNo" class="mt-0" onClick="check_dosh('0')">
                                </span>
                                <span class="pull-left font-13 gt-font-weight-500">Does not matter</span>
                            </label>
                        </div>
                        <div id="dosh_display">
                            <select class="chosen-select gt-form-control" data-placeholder="Choose Dosh Type" id="p_dosh" name="manglik[]" multiple>
                            	<?php
                                $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->dosh_id; ?>"><?php echo $DatabaseCo->dbRow->dosh; ?>
                                </option>
                                <?php } ?>
                        	</select>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_star == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-margin-top-10 gt-text-light-Grey">
                            <b><?php echo $lang['Star']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" data-placeholder="Choose Partners Star" id="p_star" name="p_star[]" multiple>
                            <option value="Does Not Matter">Does Not Matter</option>
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
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Mother Tongue']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="pmothertongue[]" data-placeholder="Choose Partners Mothertongue" data-validetta="required" class="chosen-select gt-form-control" multiple>
                            <option value="Does Not Matter">Does Not Matter</option>
                            <?php
                                $SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>">
                                <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
                            </option>
                            
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green pb-10 gtRegTitle"><i class="fa fa-globe gt-margin-right-10"></i><?php echo $lang['Location Preference']; ?></h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Country living in']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="pcountry[]" data-placeholder="Choose partners country living in" class="chosen-select gt-form-control" multiple tabindex="4" data-validetta="required" id="pcountry" >
                            <?php
                                $SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" <?php if(isset($_SESSION['reg_country'])){ if($DatabaseCo->dbRow->country_id == $_SESSION['reg_country']) { echo "selected"; }} ?>><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                            <?php } ?>
                        </select>
                        <div id="pstate_div"></div>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_state == 'Yes'){ ?>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Residing state']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" multiple name="pstate[]" id="pstate" data-placeholder="Choose partners state" >
                            <option value="">
                                Select Residing State
                            </option>
                        </select>
                        <div id="pcity_div"></div>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_city == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b><?php echo $lang['Residing city']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" multiple name="pcity[]" id="pcity" data-placeholder="Choose partners city">
                            <option value="">
                                Select Residing City
                            </option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green pb-10 gtRegTitle"><i class="fa fa-university gt-margin-right-10"></i><?php echo $lang['Professional Preference']; ?></h3>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Education']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="peducation[]" data-placeholder="Choose partners education" class="chosen-select gt-form-control flat" multiple tabindex="4" data-validetta="required">
                         	<option value="Does Not Matter">Does Not Matter</option>
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
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Occupation']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="poccupation[]" data-placeholder="Choose partners occupation" class="chosen-select gt-form-control flat" multiple tabindex="4" data-validetta="required">
                            <option value="Does Not Matter">Does Not Matter</option>
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
			<?php if($row_field->part_annual_income == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Annual Income']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" data-placeholder="Choose partners Annual Income"  name="pannualincome[]" multiple data-validetta="required">
							<option value="Does Not Matter">Does Not Matter</option>
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
			<?php if($row_field->part_expect == 'Yes'){ ?>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green pb-10 gtRegTitle"><i class="fa fa-user gt-margin-right-10"></i><?php echo $lang['Partner Expectation']; ?></h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b><?php echo $lang['Partner Expectation']; ?></b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <textarea class="gt-form-control" rows="5" cols="5" name="p_expt" <?php if($row_field->part_expect == 'Yes'){ ?> data-validetta="required,minLength[50]" <?php } ?>></textarea>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group text-center">
                <div class="row">
                    <input type="submit" name="reg2sub" value="<?php echo $lang['Continue']; ?>" class="btn gt-btn-orange inRegBtn">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- On top when page change -->
<script>
	window.location.hash = "top"; 
</script>
<!-- Dosh js -->
<script>
	$(document).ready(function(e) {
        $('#dosh_display').hide();
    });
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
</script>
