<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

if(isset($_GET['email'])){
    $email_f=$_GET['email'];
    $firstname_f=$_GET['firstname'];
    $lastname_f=$_GET['lastname'];
    $mobile_f=$_GET['mobile'];
    $mobile_code_f=$_GET['mobile_code'];
    $gender_f=$_GET['gender'];
    $dob_f=$_GET['dob'];
    $orderdate = explode('-', $dob_f);
    $year_f = $orderdate[0];
    $month_f  = $orderdate[1];
    $day_f  = $orderdate[2];
}
$matri_id=isset($_GET['matri_id']) ? mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['matri_id']) : "";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack){      
    if(isset($_REQUEST['submit_form1'])){
        $fname=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['firstname']);
        $lname=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['lastname']);
        $username=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['firstname'])." ".mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['lastname']);
        $profileby=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profileby']);
        $mobile_code=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mobile_code']);
        $mobile=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mobile']);
        $email=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['email']);
        $my_pass=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['my_pass']);
        $gender=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['gender']);
        $dob=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['year']).'-'.mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['month']).'-'.mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['day']);
        $m_status=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['m_status']);
        $mothertongue=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mothertongue']);
        $no_child=isset($_REQUEST['no_child'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_child']):'';
        $child_status=isset($_REQUEST['child_status'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['child_status']):'';
        $religion_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['religion_id']);
        $caste_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['caste_id']);
        $sub_caste_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['sub_caste_id']);

        if($_REQUEST['willing_to_mary'] != ''){
            $willing_to_mary= $_REQUEST['willing_to_mary'];
          }else{
            $willing_to_mary="0";
          }
        
        $country_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['country_id']);
        $state=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['state']);
        $city=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['city']); 
        $height=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['height']);
        $weight=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['weight']);
        $physicalstatus=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['physical_status']);
        $bodytype=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['bodytype']);
        $complexion=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['complexion']);
        $edu_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['edu_id'].','.$_REQUEST['edu_id1']);
        $occupation=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['occupation']);
        $employed_in=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['employed_in']);
        $annual_income=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['annual_income']);
        $diet=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['diet']);
        $smoke=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['smoke']);
        $drink=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['drink']);
        $manglik=isset($_REQUEST['manglik']) ? mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['manglik'])):'';
        $star=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['star']);
        $birthplace=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['birth_place']);
        $moonsign=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['moonsign']);	
        $birthtime=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['birth_time']);
        $family_status=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_status']);
        $family_value=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_value']);
        $family_type=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_type']);
        $father_ocp=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['father_occupation']);
        $mother_ocp=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mother_occupation']);
        $no_of_sister=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_sister']);
        $no_of_brother=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_brother']);
        $no_of_married_brother=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_marri_brother']);
        $no_of_married_sister=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_marri_sister']);
        $profile_text=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile_text']); 
        $profile_text_date=date('H:i:s Y-m-d ');
        if($my_pass!=''){									
            $pass=",password='".md5($my_pass)."'";	
        }else{
            $pass='';	
        }
        
        if(isset($_GET['matri_id']) && $_GET['matri_id']!=''){
            $SQL_STATEMENT="UPDATE register SET firstname='$fname',lastname='$lname',username='$username',email='$email',mobile_code='$mobile_code',mobile='$mobile',profileby='$profileby',gender='$gender',birthdate='$dob',m_status='$m_status',m_tongue='$mothertongue',tot_children='$no_child',status_children='$child_status',religion='$religion_id',caste='$caste_id',subcaste='$sub_caste_id',will_to_mary_caste='$willing_to_mary',country_id='$country_id',state_id='$state',city='$city',height='$height',weight='$weight',physicalStatus='$physicalstatus',bodytype='$bodytype',complexion='$complexion',edu_detail='$edu_id',occupation='$occupation',emp_in='$employed_in',income='$annual_income',diet='$diet',smoke='$smoke',drink='$drink',manglik='$manglik',star='$star',moonsign='$moonsign',birthplace='$birthplace',birthtime='$birthtime',family_type='$family_type',family_value='$family_value',family_status='$family_status',father_occupation='$father_ocp',mother_occupation='$mother_ocp',no_of_brothers='$no_of_brother',no_of_sisters='$no_of_sister',no_marri_brother='$no_of_married_brother',no_marri_sister='$no_of_married_sister',profile_text='$profile_text',profile_text_approve='Approve',profile_text_date='$profile_text_date',photo_view_status='1',photo_protect='No'$pass WHERE matri_id='$matri_id'";
            $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
            $status_MESSAGE = $statusObj->getstatusMessage();
        }else{
            $tm=mktime(date('h')+5,date('i')+30,date('s'));
            $reg_date=date('Y-m-d h:i:s',$tm);
            $order_status = "No";
            $photo_protect = "No";
            $row_prefix=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT prefix FROM site_config"));
            $prefix=$row_prefix->prefix ? $row_prefix->prefix : 'IN';
            $adminrole_id='1';
            $adminrole_view_status='Yes';
            $status='Inactive';
            $ip=$_SERVER['REMOTE_ADDR'];                
            $agent=$_SERVER['HTTP_USER_AGENT'];  
            $password123=md5($my_pass);
            $check_email=$DatabaseCo->dbLink->query("SELECT email FROM register WHERE email='$email'");
			$count_email=mysqli_num_rows($check_email);
			if($count_email == 0){
                $DatabaseCo->dbLink->query("INSERT INTO register (index_id,matri_id,prefix, terms,email,password,m_status,username,firstname,lastname,mobile_code,mobile,profileby,gender,birthdate,m_tongue,tot_children,status_children,religion,caste,will_to_mary_caste,country_id,state_id,city,height,weight,physicalStatus,bodytype,complexion,edu_detail,occupation,emp_in,income,diet,smoke,drink,manglik,star,moonsign,birthplace,birthtime,family_type,family_value,family_status,father_occupation,mother_occupation,no_of_brothers,no_of_sisters,no_marri_brother,no_marri_sister,profile_text,profile_text_approve,profile_text_date,reg_date,ip,agent,status,adminrole_id,adminrole_view_status,photo_view_status,photo_protect)VALUES('NULL','$matri_id','$prefix','Yes','$email','$password123','$m_status','$username','$fname','$lname','$mobile_code','$mobile','$profileby','$gender','$dob','$mothertongue','$no_child','$child_status','$religion_id','$caste_id','$willing_to_mary','$country_id','$state','$city','$height','$weight','$physicalstatus','$bodytype','$complexion','$edu_id','$occupation','$employed_in','$annual_income','$diet','$smoke','$drink','$manglik','$star','$moonsign','$birthplace','$birthtime','$family_type','$family_value','$family_status','$father_ocp','$mother_ocp','$no_of_brother','$no_of_sister','$no_of_married_brother','$no_of_married_sister','$profile_text','Approved','$profile_text_date','$reg_date','$ip','$agent','$status','$adminrole_id','$adminrole_view_status','1','No')");
                $get_reg_id=mysqli_insert_id($DatabaseCo->dbLink);
                $matri_id=$prefix.$get_reg_id;
                $DatabaseCo->dbLink->query("UPDATE register SET matri_id='$matri_id' WHERE email='$email'") or die(mysqli_error($DatabaseCo->dbLink));
                echo "<script>window.location='editprofile?matri_id=".$matri_id."&status=success';</script>";
            }else{
				echo "<script>alert('Email id already exist.');</script>";
				echo "<script>window.location='editprofile;</script>";
			}
        }
    }
    if(isset($_REQUEST['submit_form3'])){
        $looking_for=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['looking']));
        $pfrom_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['pfrom_age']);
        $pto_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['pto_age']);
        $part_height=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height']);
        $part_height_to=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height_to']);
        $part_edu=isset($_REQUEST['part_edu'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_edu'])):"";
        $part_income=isset($_REQUEST['part_drink123'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_income']):"";
        $part_smoke=isset($_REQUEST['part_smoke'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_smoke'])):'';
        $part_drink=isset($_REQUEST['part_drink123'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_drink123'])):'';
        $part_occupation=isset($_REQUEST['part_occupation'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_occupation'])):'';
        $part_emp_in=isset($_REQUEST['part_emp_in'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_emp_in'])):"";
        $part_designation=isset($_REQUEST['part_designation'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_designation'])):"";
        $part_manglik=isset($_REQUEST['part_manglik'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_manglik']):"";
        $part_country_id=isset($_REQUEST['part_country_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_country_id'])):"";
        $part_state=isset($_REQUEST['part_state'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_state'])):"";
        $part_city=isset($_REQUEST['part_state'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_city'])):"";
        $part_religion_id=isset($_REQUEST['part_religion_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_religion_id'])):'';
        $part_caste_id=isset($_REQUEST['part_caste_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_caste_id'])):'';
        $part_complexion=isset($_REQUEST['part_complexion'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_complexion'])):'';
        $part_mtongue=isset($_REQUEST['part_mtongue'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_mtongue'])):'';
        $part_physical=isset($_REQUEST['part_physical'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_physical']):'';
        $part_diet=isset($_REQUEST['part_diet'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_diet'])):"";
        $part_star=isset($_REQUEST['part_star'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_star'])):"";
        $part_resi_status=isset($_REQUEST['part_resi_status'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_resi_status'])):"";
        $expectation= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['expectation']);
        $part_expect_date= date('H:i:s Y-m-d ');
        $part_subcaste= isset($_REQUEST['part_subcaste'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_subcaste']):'';
        $part_rasi= isset($_REQUEST['part_rasi'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_rasi'])):"";                              
        $SQL_STATEMENT="UPDATE register SET looking_for='$looking_for',part_frm_age='$pfrom_age',part_to_age='$pto_age',part_height='$part_height',part_height_to='$part_height_to',part_edu='$part_edu',part_income='$part_income',part_drink='$part_drink',part_smoke='$part_smoke',part_occu='$part_occupation',part_emp_in='$part_emp_in',part_manglik='$part_manglik',part_country_living='$part_country_id',part_state='$part_state',part_city='$part_city',part_religion='$part_religion_id',part_caste='$part_caste_id',part_complexation='$part_complexion',part_mtongue='$part_mtongue',part_physical='$part_physical',part_diet='$part_diet',part_star='$part_star',part_resi_status='$part_resi_status',part_expect='$expectation',part_expect_approve='Approved',part_expect_date='$part_expect_date',part_subcaste='$part_subcaste',part_rasi='$part_rasi' WHERE matri_id='$matri_id'";
    }
    $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
    $status_MESSAGE = $statusObj->getstatusMessage();
}else{
    $statusObj = new status();
    $statusObj->setActionSuccess(false);
    $status_MESSAGE = "Please select value to complete action.";	  
} 
$sql=$DatabaseCo->dbLink->query("SELECT * FROM register_view WHERE matri_id='$matri_id'");
$row=mysqli_fetch_object($sql);

?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<title>Admin | Add / Edit Profile</title>
    	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		
   		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
		
    	<!-- Ionicons -->
    	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   		
		<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		
   		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
        
        <!-- Validation css -->
		<link href="../css/validate.css" rel="stylesheet" type="text/css" />
        
        <!-- Chosen Css -->
    	<link rel="stylesheet" href="../css/prism.css">
    	<link rel="stylesheet" href="../css/chosen.css">
        
        <script type="text/javascript">
            var numDays = {
                '01': 31,
                '02': 28,
                '03': 31,
                '04': 30,
                '05': 31,
                '06': 30,
                '07': 31,
                '08': 31,
                '09': 30,
                '10': 31,
                '11': 30,
                '12': 31
             };

             function setDays(oMonthSel, oDaysSel, oYearSel) {
                var nDays, oDaysSelLgth, opt, i = 1;
                nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
                if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
                ++nDays;
                oDaysSelLgth = oDaysSel.length;
                if (nDays != oDaysSelLgth) {
                    if (nDays < oDaysSelLgth) oDaysSel.length = nDays;
                    else
                        for (i; i < nDays - oDaysSelLgth + 1; i++) {
                            opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
                            oDaysSel.options[oDaysSel.length] = opt;
                        }
                }
                var oForm = oMonthSel.form;
                var month = oMonthSel.options[oMonthSel.selectedIndex].value;
                var day = oDaysSel.options[oDaysSel.selectedIndex].value;
                var year = oYearSel.options[oYearSel.selectedIndex].value;
                //oForm.datepicker.value = year + '-' + month + '-' + day;
             }
        </script>
        <script type="text/javascript">
            function check_status(status) {
                //alert(status);
                if (status == 'Never Married') {
                    $('#dis_child').hide();
                }
                if (status == 'Widower') {
                    $('#dis_child').show();
                }
                if (status == 'Widow') {
                    $('#dis_child').show();
                }
                if (status == 'Divorced') {
                    $('#dis_child').show();
                }
                if (status == 'Awaiting Divorce') {
                    $('#dis_child').show();
                }
             }
        </script>
        <style>
            .default {
                width: 252px !important;
            }
        </style>
    </head>
    <body class="skin-blue">
        <!-- Icon Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- /. Icon Loader-->
        <div class="wrapper" style="display:none" id="body">
    		<!-- Header & Menu -->
            <?php include "page-part/header.php"; ?> 
            <?php include "page-part/left_panel.php"; ?>
            <!-- /. Header & Menu -->
            <div class="content-wrapper">
                <section class="content-header">
				    <h1 class="lightGrey">Add Members</h1>
				    <ol class="breadcrumb">
					  	<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				        <li class="active">Add Members</li>
				    </ol>
				</section>
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="box-top updateSite">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-12 col-sm-6">
                                        <a href="members" class="btn btn-success btn-lg btn-block">
                                            <i class="fa fa-users"></i>All Member
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-xs-12 col-sm-6">
                                        <a href="editprofile?action=ADD" class="btn btn-success btn-lg btn-block">
                                            <i class="fa fa-user-plus"></i>Add Member
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($_GET['status']) && $_GET['status']=="success"){
                                    $statusObj = new status();
                                    $statusObj->setActionSuccess(true);
                                    $status_MESSAGE="Member successfully Register.";	
                                }
                            if(!empty($status_MESSAGE)){	
                                    if($statusObj->getActionSuccess()){
                                        echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$status_MESSAGE."</div>";
                                    }
                                }
                        ?>
                        <section class="content">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs nav-justified mt-10">
                                    <li class="active">
                                        <a href="#tab_1" data-toggle="tab">Member Details</a>
                                    </li>
                                    <li>
                                        <a href="#tab_2" data-toggle="tab">Upload Photos</a>	
                                    </li>
                                    <li>
                                        <a href="#tab_3" data-toggle="tab">Partner Preference </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <form method="post" name="user_detail" id="user_detail">
                                            <h3 class="text-success">
                                                <i class="fa fa-file-text gtMarginRight10"></i>Basic Details
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                 <label>First Name</label>
                                                                 <input type="text" class="form-control" placeholder="Enter First Name" data-validetta="required" value="<?php if(isset($firstname_f)){ echo $firstname_f; }elseif(isset($row->firstname)){ echo $row->firstname; } ?>" name="firstname">
                                                            </div>
                                                            <div class="col-xs-6">
                                                                 <label>Last Name</label>
                                                                 <input type="text" class="form-control" placeholder="Enter Last Name" data-validetta="required" value="<?php if(isset($lastname_f)){ echo $lastname_f; }elseif(isset($row->lastname)){ echo $row->lastname; } ?>" name="lastname">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date Of Birth</label>
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <select name="day" id="day" class="form-control" onchange="setDays(month,this,year)" data-validetta="required">
                                                                    <option value="">Select</option>
                                                                    <?php $ad=explode('-',$row->birthdate); ?>					
                                                                    <option value="01" <?php if(isset($_GET['email'])){ if($day_f == '01'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '01'){ echo "selected"; } ?>>01</option>
                                                                    <option value="02" <?php if(isset($_GET['email'])){ if($day_f == '02'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '02'){ echo "selected"; } ?>>02</option>
                                                                    <option value="03" <?php if(isset($_GET['email'])){ if($day_f == '03'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '03'){ echo "selected"; } ?>>03</option>
                                                                    <option value="04" <?php if(isset($_GET['email'])){ if($day_f == '04'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '04'){ echo "selected"; } ?>>04</option>
                                                                    <option value="05" <?php if(isset($_GET['email'])){ if($day_f == '05'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '05'){ echo "selected"; } ?>>05</option>
                                                                    <option value="06" <?php if(isset($_GET['email'])){ if($day_f == '06'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '06'){ echo "selected"; } ?>>06</option>
                                                                    <option value="07" <?php if(isset($_GET['email'])){ if($day_f == '07'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '07'){ echo "selected"; } ?>>07</option>
                                                                    <option value="08" <?php if(isset($_GET['email'])){ if($day_f == '08'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '08'){ echo "selected"; } ?>>08</option>
                                                                    <option value="09" <?php if(isset($_GET['email'])){ if($day_f == '09'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '09'){ echo "selected"; } ?>>09</option>
                                                                    <option value="10" <?php if(isset($_GET['email'])){ if($day_f == '10'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '10'){ echo "selected"; } ?>>10</option>
                                                                    <option value="11" <?php if(isset($_GET['email'])){ if($day_f == '11'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '11'){ echo "selected"; } ?>>11</option>
                                                                    <option value="12" <?php if(isset($_GET['email'])){ if($day_f == '12'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '12'){ echo "selected"; } ?>>12</option>
                                                                    <option value="13" <?php if(isset($_GET['email'])){ if($day_f == '13'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '13'){ echo "selected"; } ?>>13</option>
                                                                    <option value="14" <?php if(isset($_GET['email'])){ if($day_f == '14'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '14'){ echo "selected"; } ?>>14</option>
                                                                    <option value="15" <?php if(isset($_GET['email'])){ if($day_f == '15'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '15'){ echo "selected"; } ?>>15</option>
                                                                    <option value="16" <?php if(isset($_GET['email'])){ if($day_f == '16'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '16'){ echo "selected"; } ?>>16</option>
                                                                    <option value="17" <?php if(isset($_GET['email'])){ if($day_f == '17'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '17'){ echo "selected"; } ?>>17</option>
                                                                    <option value="18" <?php if(isset($_GET['email'])){ if($day_f == '18'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '18'){ echo "selected"; } ?>>18</option>
                                                                    <option value="19" <?php if(isset($_GET['email'])){ if($day_f == '19'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '19'){ echo "selected"; } ?>>19</option>
                                                                    <option value="20" <?php if(isset($_GET['email'])){ if($day_f == '20'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '20'){ echo "selected"; } ?>>20</option>
                                                                    <option value="21" <?php if(isset($_GET['email'])){ if($day_f == '21'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '21'){ echo "selected"; } ?>>21</option>
                                                                    <option value="22" <?php if(isset($_GET['email'])){ if($day_f == '22'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '22'){ echo "selected"; } ?>>22</option>
                                                                    <option value="23" <?php if(isset($_GET['email'])){ if($day_f == '23'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '23'){ echo "selected"; } ?>>23</option>
                                                                    <option value="24" <?php if(isset($_GET['email'])){ if($day_f == '24'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '24'){ echo "selected"; } ?>>24</option>
                                                                    <option value="25" <?php if(isset($_GET['email'])){ if($day_f == '25'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '25'){ echo "selected"; } ?>>25</option>
                                                                    <option value="26" <?php if(isset($_GET['email'])){ if($day_f == '26'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '26'){ echo "selected"; } ?>>26</option>
                                                                    <option value="27" <?php if(isset($_GET['email'])){ if($day_f == '27'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '27'){ echo "selected"; } ?>>27</option>
                                                                    <option value="28" <?php if(isset($_GET['email'])){ if($day_f == '28'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '28'){ echo "selected"; } ?>>28</option>
                                                                    <option value="29" <?php if(isset($_GET['email'])){ if($day_f == '29'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '29'){ echo "selected"; } ?>>29</option>
                                                                    <option value="30" <?php if(isset($_GET['email'])){ if($day_f == '30'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '30'){ echo "selected"; } ?>>30</option>
                                                                    <option value="31" <?php if(isset($_GET['email'])){ if($day_f == '31'){ echo "selected"; } }elseif(isset($ad[2]) && $ad[2] == '31'){ echo "selected"; } ?>>31</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <select name="month" id="month" class="form-control" onchange="setDays(this,day,year)" data-validetta="required">
                                                                    <option value="">Select</option>
                                                                    <option value="01" <?php if(isset($_GET['email'])){ if($month_f == '01'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='01') { echo "selected"; } ?>>Jan</option>
                                                                    <option value="02" <?php if(isset($_GET['email'])){ if($month_f == '02'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='02') { echo "selected"; } ?>>Feb</option>
                                                                    <option value="03" <?php if(isset($_GET['email'])){ if($month_f == '03'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='03') { echo "selected"; } ?>>Mar</option>
                                                                    <option value="04" <?php if(isset($_GET['email'])){ if($month_f == '04'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='04') { echo "selected"; } ?>>Apr</option>
                                                                    <option value="05" <?php if(isset($_GET['email'])){ if($month_f == '05'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='05') { echo "selected"; } ?>>May</option>
                                                                    <option value="06" <?php if(isset($_GET['email'])){ if($month_f == '06'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='06') { echo "selected"; } ?>>Jun</option>
                                                                    <option value="07" <?php if(isset($_GET['email'])){ if($month_f == '07'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='07') { echo "selected"; } ?>>Jul</option>
                                                                    <option value="08" <?php if(isset($_GET['email'])){ if($month_f == '08'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='08') { echo "selected"; } ?>>Aug</option>
                                                                    <option value="09" <?php if(isset($_GET['email'])){ if($month_f == '09'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='09') { echo "selected"; } ?>>Sep</option>
                                                                    <option value="10" <?php if(isset($_GET['email'])){ if($month_f == '10'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='10') { echo "selected"; } ?>>Oct</option>
                                                                    <option value="11" <?php if(isset($_GET['email'])){ if($month_f == '11'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='11') { echo "selected"; } ?>>Nov</option>
                                                                    <option value="12" <?php if(isset($_GET['email'])){ if($month_f == '12'){ echo "selected"; } }elseif(isset($ad[1]) && $ad[1]=='12') { echo "selected"; } ?>>Dec</option>																		
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <select name="year" id="year" class="form-control" onchange="setDays(month,day,this)" data-validetta="required">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                        $SQL_SITE_SETTING_BIRTHYEAR = $DatabaseCo->dbLink->query("SELECT birthyear FROM site_config WHERE id='1' ");
                                                                        $birth_year_data = mysqli_fetch_object($SQL_SITE_SETTING_BIRTHYEAR);
                                                                        $birth_year=$birth_year_data->birthyear;
                                                                        for ($x = $birth_year; $x >= 1924; $x--) { ?>
                                                                        <option value='<?php echo $x; ?>' <?php if(isset($_GET['email'])){ if($year_f == $x){ echo "selected"; } }elseif(isset($ad[0]) && $ad[0] == $x) {echo "selected";}?>>
                                                                            <?php echo $x; ?>
                                                                        </option>
                                                                     <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select class="form-control" data-validetta="required" name="gender">
                                                            <option value="">Select Gender</option>
                                                            <option value="Female" <?php if(isset($gender_f) == 'Female'){ echo "selected"; }elseif(isset($row->gender) && $row->gender=='Female') { echo "selected"; }?>> 
                                                                Female 
                                                            </option>
                                                            <option value="Male" <?php if(isset($gender_f) == 'Male'){ echo "selected"; }elseif(isset($row->gender) && $row->gender=='Male') { echo "selected"; }?>>
                                                                Male 
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Profile Created By</label>
                                                        <select class="form-control" name="profileby">
                                                            <?php
																$SQL_STATEMENT_PROFILE_BY = $DatabaseCo->dbLink->query("SELECT * FROM profile_by WHERE status='APPROVED' ORDER BY id ASC");
 																while ($row_profile_by = mysqli_fetch_object($SQL_STATEMENT_PROFILE_BY)) {
                                                                ?>
                                                                <option value="<?php echo $row_profile_by->id; ?>" <?php if(isset($row->profileby)){ if($row->profileby == $row_profile_by->profile_by){ echo 'selected';} }?>><?php echo $row_profile_by->profile_by; ?></option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email Id</label>
                                                        <input type="email" class="form-control" placeholder="Enter Email Id" data-validetta="required,email" value="<?php if(isset($email_f)){ echo $email_f; }elseif(isset($row->email)){ echo $row->email; } ?>" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile No</label>
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <select class="form-control" name="mobile_code" id="mobile_code" data-validetta="required">
                                                                    <?php
																		$SQL_STATEMENT_code = $DatabaseCo->dbLink->query("SELECT * FROM country_code");
																		while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_code)) {
																	?>
																	<option value="+<?php echo $DatabaseCo->dbRow->phonecode; ?>" <?php if(isset($mobile_code_f)){ echo "selected"; }elseif($DatabaseCo->dbRow->phonecode == $row->mobile_code){ echo "selected";}elseif($DatabaseCo->dbRow->phonecode == '91'){echo "selected"; } ?> >+<?php echo $DatabaseCo->dbRow->phonecode; ?></option>
																	<?php } ?>                    
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-8">
                                                                <input type="text" class="form-control" placeholder="Enter Mobile No" data-validetta="required,number,minLength[10],maxLength[10]" value="<?php if(isset($mobile_f)){ echo $mobile_f; }elseif(isset($row->mobile)){ echo $row->mobile; } ?>" name="mobile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Marital Status</label>
                                                        <select class="form-control" data-validetta="required" name="m_status" onChange="check_status(this.value)">
                                                            <option value="">Select</option>
                                                            <option value="Never Married" <?php if(isset($row->m_status) && $row->m_status=='Never Married') { echo "selected";}?>>
                                                                Never Married
                                                            </option>
                                                            <option value="Widower" <?php if(isset($row->m_status) && $row->m_status=='Widower') { echo "selected";}?>>
                                                                Widower
                                                            </option>
                                                            <option value="Widow" <?php if(isset($row->m_status) && $row->m_status=='Widow') { echo "selected";}?>>
                                                                Widow
                                                            </option>
                                                            <option value="Divorced" <?php if(isset($row->m_status) && $row->m_status=='Divorced') { echo "selected";}?>>
                                                                Divorced
                                                            </option>
                                                            <option value="Awaiting Divorce" <?php if(isset($row->m_status) && $row->m_status=='Awaiting Divorce') { echo "selected";}?>>
                                                                Awaiting Divorce
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="dis_child">
                                                        <label>No Of Children</label>
                                                        <select class="form-control" name="no_child" id="check_child">
                                                            <option value=""> Select No Of Children</option>
                                                            <option value="No Child"  <?php if(isset($row->tot_children)){ if($row->tot_children == 'No Child'){ echo 'selected';}} ?>>None</option>
                                                            <option value="One" <?php if(isset($row->tot_children)){ if($row->tot_children == 'One'){ echo 'selected';}} ?>>One</option>
                                                            <option value="Two" <?php if(isset($row->tot_children)){ if($row->tot_children == 'Two'){ echo 'selected';}} ?>>Two</option>
                                                            <option value="Three" <?php if(isset($row->tot_children)){ if($row->tot_children == 'Three'){ echo 'selected';}} ?>>Three</option>
                                                            <option value="Four and above" <?php if(isset($row->tot_children)){ if($row->tot_children == 'Four and above'){ echo 'selected';}} ?>>Four and above</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="dis_child_status">
                                                        <label>Children Living Status</label>
                                                        <select class="form-control" name="child_status">
                                                            <option value="">Select</option>
                                                            <option value="Living with me" <?php if(isset($row->status_children)){ if($row->status_children == 'Living with me'){ echo 'selected';}} ?>>Living with me</option>
                                                            <option value="Not living with me" <?php if(isset($row->status_children)){ if($row->status_children == 'Not living with me'){ echo 'selected';}} ?>>Not living with me</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mother Tounge:</label>
                                                        <select name="mothertongue" class="form-control chosen-single chosen-select" data-validetta="required">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                                                while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->Row->mtongue_id; ?>" <?php if (isset($row->m_tongue) && ($row->m_tongue == $DatabaseCo->Row->mtongue_id)) { echo "selected" ;}?>>
                                                                <?php echo $DatabaseCo->Row->mtongue_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" placeholder="Enter Password"  name="my_pass" <?php if(!isset($_GET['matri_id'])){?>data-validetta="required" <?php }?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control" <?php if(!isset($_GET['matri_id'])){?>data-validetta="required,equalTo[my_pass]" <?php }?> placeholder="Enter Confirm Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fas fas-user gtMarginRight10"></i>&nbsp;Religion Information
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Religion</label>
                                                        <select class="form-control chosen-select" name="religion_id" id="religion_id" data-validetta="required">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $rel=$row->religion;
                                                                $SQL_STATEMENT_religion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED'");
                                                                while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_religion)){ 
                                                            ?>
                                                                <option value="<?php echo $DatabaseCo->Row->religion_id ?>" <?php if($rel == $DatabaseCo->Row->religion_id){ echo "selected"; } ?>>
                                                                <?php echo $DatabaseCo->Row->religion_name ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div id="status"></div>
                                                    <div class="form-group">
                                                        <label>Caste</label>
                                                        <select class="form-control chosen-select" name="caste_id"  data-validetta="required" id="caste_id">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ");
                                                                while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){ 
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->Row->caste_id ?>" <?php if($row->caste == $DatabaseCo->Row->caste_id){ echo "selected"; } ?>>
                                                                <?php echo $DatabaseCo->Row->caste_name ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Sub Caste</label>
                                                        <select class="form-control chosen-select" name="sub_caste_id">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_id,sub_caste_name FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
                                                                while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste)) {
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->Row->sub_caste_id; ?>" <?php if($row->subcaste == $DatabaseCo->Row->sub_caste_id){ echo "selected" ; }?>>
                                                                <?php echo $DatabaseCo->Row->sub_caste_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pt-20 pb-20">
                                                    <div class="form-group">
                                                        <label class="col-xs-10" for="willtomarry">Willing To Marry In Other Caste ?</label>
                                                        <span class="col-xs-2">
                                                            <input type="checkbox" name="willing_to_mary" value="1" id="willtomarry" <?php if(isset($row->will_to_mary_caste) && $row->will_to_mary_caste=='1') { echo "checked";} ?>>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-university gtMarginRight10"></i>&nbsp;Education & Occupation Details
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Highest Education</label>
                                                        <select class="form-control chosen-select" name="edu_id" id="edu_id" data-validetta="required">
                                                            <option value="">Select</option>
                                                            <?php $eduucation = explode(",",$row->edu_detail); ?>
                                                            <?php
                                                                $get_edu=explode(",",$DatabaseCo->dbRow->edu_detail);
                                                                $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ");
                                                                while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu)){
                                                            ?>
                                                                <option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if( $eduucation[0] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
                                                                    <?php echo $DatabaseCo->Row->edu_name; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Additional Degree</label>
                                                        <select class="form-control" name="edu_id1" id="edu_id1" >
                                                            <option value="">Select Your Additional Degree</option>
                                                            <?php
                                                                $SQL_STATEMENT_edu1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
                                                                while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu1)){
                                                            ?>
                                                                <option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if(isset($eduucation[1]) && $eduucation[1] !='' && $eduucation[1] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
                                                                    <?php echo $DatabaseCo->Row->edu_name; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Employed In</label>
                                                        <select class="form-control" name="employed_in" >
                                                            <option value="">Select</option>
                                                            <option value="Government" <?php if(isset($row->emp_in)){ if($row->emp_in == "Government"){ echo "selected"; } }?>>Government</option>
                                                            <option value="Private" <?php if(isset($row->emp_in)){ if($row->emp_in == "Private"){ echo "selected"; } }?>>Private</option>
                                                            <option value="Business" <?php if(isset($row->emp_in)){ if($row->emp_in == "Business"){ echo "selected"; } }?>>Business</option>
                                                            <option value="Defence" <?php if(isset($row->emp_in)){ if($row->emp_in == "Defence"){ echo "selected"; } }?>>Defence</option>
                                                            <option value="Self Employed" <?php if(isset($row->emp_in)){ if($row->emp_in == "Self Employed"){ echo "selected"; } }?>>Self Employed</option>
                                                            <option value="Not Working" <?php if(isset($row->emp_in)){ if($row->emp_in == "Not Working"){ echo "selected"; } }?>>Not Working</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Occupation</label>
                                                        <select class="form-control" name="occupation" data-validetta="required">
                                                            <option value=""> Select</option>
                                                            <?php
                                                                $SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
                                                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
                                                            ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>" <?php if($DatabaseCo->dbRow->ocp_id == $row->occupation){ echo "selected"; }?>><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Annual Income</label>
                                                        <select class="form-control chosen-select" name="annual_income">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
                                                            while($row_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
                                                            ?>
                                                            <option value="<?php echo $row_income->id; ?>" <?php if(isset($row->income)){ if($row_income->id == $row->income){ echo "selected"; } } ?>><?php echo $row_income->income; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-group gtMarginRight10"></i>&nbsp;Family Details
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Family Type</label>
                                                        <select class="form-control" name="family_type" >
                                                            <option value="">Select</option>
                                                            <option value="Joint" <?php if($row->family_type=='Joint'){ echo "selected";}?>>
                                                                Joint
                                                            </option>
                                                            <option value="Nuclear" <?php if($row->family_type=='Nuclear'){ echo "selected";}?>>
                                                                Nuclear
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Family value</label>
                                                        <select class="form-control" name="family_value" >
                                                            <option value="">Select</option>
                                                            <option value="Orthodox" <?php if($row->family_value=='Orthodox'){ echo "selected";}?>>
                                                                Orthodox
                                                            </option>
                                                            <option value="Traditional" <?php if($row->family_value=='Traditional'){ echo "selected";}?>>
                                                                Traditional
                                                            </option>
                                                            <option value="Moderate" <?php if($row->family_value=='Moderate'){ echo "selected";}?>>
                                                                Moderate
                                                            </option>
                                                            <option value="Liberal" <?php if($row->family_value=='Liberal'){ echo "selected";}?>>
                                                                Liberal
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Family Status</label>
                                                        <select class="form-control" name="family_status">
                                                            <option value="">Select</option>
                                                            <option value="Middle class" <?php if($row->family_status=='Middle class'){ echo "selected";} ?>>
                                                                Middle class
                                                            </option>
                                                            <option value="Upper middle class" <?php if($row->family_status=='Upper middle class'){ echo "selected";}?>>
                                                                Upper middle class
                                                            </option>
                                                            <option value="Rich" <?php if($row->family_status=='Rich'){ echo "selected";}?>>
                                                                Rich
                                                            </option>
                                                            <option value="Affluent" <?php if($row->family_status=='Affluent'){ echo "selected";}?>>
                                                                Affluent
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Fathers Occupation</label>
                                                        <input type="text" class="form-control" name="father_occupation" placeholder="Enter Fathers Occupation" value="<?php if(isset($row->father_occupation)){if($row->father_occupation!='Not Available'){ echo htmlspecialchars_decode($row->father_occupation,ENT_QUOTES);}}?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mothers Occupation</label>
                                                        <input type="text" class="form-control" name="mother_occupation" placeholder="Enter Fathers Occupation" value="<?php if(isset($row->mother_occupation)){if($row->mother_occupation != 'Not Available'){ echo htmlspecialchars_decode($row->mother_occupation,ENT_QUOTES);}} ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>No of Brothers</label>
                                                        <select class="form-control" name="no_of_brother">
                                                            <option value="">Select</option>
                                                            <option value="No Brother" <?php if($row->no_of_brothers =='No Brother'){echo "selected";}?>>No Brother</option>
                                                            <option value="1 Brother" <?php if($row->no_of_brothers == '1 Brother'){echo "selected";}?>>1 Brother</option>
                                                            <option value="2 Brothers" <?php if($row->no_of_brothers == '2 Brother'){echo "selected";}?>>2 Brothers</option>
                                                            <option value="3 Brothers" <?php if($row->no_of_brothers == '3 Brothers'){echo "selected";}?>>3 Brothers</option>
                                                            <option value="4 Brothers" <?php if($row->no_of_brothers == '4 Brothers'){echo "selected";}?>>4 Brothers</option>
                                                            <option value="4 + Brothers" <?php if($row->no_of_brothers == '4 + Brothers'){echo "selected";}?>>4 + Brothers</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>No of Married Brothers</label>
                                                        <select class="form-control" name="no_of_marri_brother">
                                                            <option value="">Select</option>
                                                            <option value="No married brother" <?php if($row->no_marri_brother == 'No married brother'){echo "selected";} ?>>No married brother</option>
                                                            <option value="1 married brother" <?php if($row->no_marri_brother == '1 married brother'){ echo "selected";} ?> >1 married brother</option>
                                                            <option value="2 married brothers" <?php if($row->no_marri_brother == '2 married brothers'){echo "selected";} ?>>2 married brothers</option>
                                                            <option value="3 married brothers" <?php if($row->no_marri_brother == '3 married brothers'){echo "selected";} ?>>3 married brothers</option>
                                                            <option value="4 married brothers" <?php if($row->no_marri_brother == '4 married brothers'){echo "selected";} ?>>4 married brothers</option>
                                                            <option value="4+ married brothers" <?php if($row->no_marri_brother == '4+ married brothers'){echo "selected";} ?>>4+ married brothers</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>No of Sisters</label>
                                                        <select class="form-control" name="no_of_sister">
                                                            <option value="">Select</option>
                                                            <option value="No Sister" <?php if($row->no_of_sisters=='No Sister'){echo "selected";}?>>No Sister</option>
                                                            <option value="1 Sister" <?php if($row->no_of_sisters=='1 Sister'){echo "selected";}?>>1 Sister</option>
                                                            <option value="2 Sisters" <?php if($row->no_of_sisters=='2 Sisters'){echo "selected";}?>>2 Sisters</option>
                                                            <option value="3 Sisters" <?php if($row->no_of_sisters=='3 Sisters'){echo "selected";}?>>3 Sisters</option>
                                                            <option value="4 Sisters" <?php if($row->no_of_sisters=='4 Sisters'){echo "selected";}?>>4 Sisters</option>
                                                            <option value="4 + Sisters" <?php if($row->no_of_sisters=='4 + Sisters'){echo "selected";}?>>4 + Sisters</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>No of Married Sisters</label>
                                                        <select class="form-control" name="no_of_marri_sister">
                                                            <option value="">Select</option>
                                                            <option value="No married sister" <?php if($row->no_marri_sister=='No married sister'){echo "selected";}?>>No married Sister</option>
                                                            <option value="1 married sister" <?php if($row->no_marri_sister=='1 married sister'){echo "selected";}?>>1 married sister</option>
                                                            <option value="2 married sisters" <?php if($row->no_marri_sister=='2 married sisters'){echo "selected";}?>>2 married sisters</option>
                                                            <option value="3 married sisters" <?php if($row->no_marri_sister=='3 married sisters'){echo "selected";}?>>3 married sisters</option>
                                                            <option value="4 married sisters" <?php if($row->no_marri_sister=='4 married sisters'){echo "selected";}?>>4 married sisters</option>
                                                            <option value="4+ married sisters" <?php if($row->no_marri_sister=='4+ married sisters'){echo "selected";}?>>4+ married sisters</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-map-marker gtMarginRight10"></i>&nbsp;Location Details
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label>Country Living In</label>
                                                        <select class="form-control chosen-select" name="country_id" id="country_id" data-validetta="required">
                                                            <option value="">Select Your Country</option>
                                                            <?php
                                                                $SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'  ");
                                                                while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_country)){
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->Row->country_id ?>" <?php if($row->country_id == $DatabaseCo->Row->country_id){ echo "selected"; } ?>>
                                                                <?php echo $DatabaseCo->Row->country_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div id="status123"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State Living In</label>
                                                        <select class="form-control chosen-select" id="state123" name="state" data-validetta="required">
                                                             <?php
                                                                $SQL_STATEMENT_state = $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id='".$row->country_id."' and status='APPROVED' ORDER BY state_name ASC");
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_state)) {
                                                             ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" <?php if($DatabaseCo->dbRow->state_id == $row->state_id){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->state_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div id="status23"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City Living In</label>
                                                        <select class="form-control chosen-select" name="city" id="city123" data-validetta="required">
                                                            <option value="">Select state first</option>
                                                            <?php
                                                                $SQL_STATEMENT_city = $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE cnt_id='".$row->country_id."' AND state_id='".$row->state_id."' AND status='APPROVED' ORDER BY city_name ASC");
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_city)) {
                                                            ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>" <?php if($DatabaseCo->dbRow->city_id == $row->city){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-glass gtMarginRight10"></i>&nbsp;Habits & Hobbies
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Diet</label>
                                                        <select class="form-control" name="diet">
                                                            <option value="">Select</option>
                                                            <option value="Vegetarian" <?php if($row->diet=='Vegetarian'){ echo "selected";}?>>
                                                                Vegetarian
                                                            </option>
                                                            <option value="Non Vegetarian" <?php if($row->diet=='Non Vegetarian'){ echo "selected";}?>>
                                                                Non Vegetarian
                                                            </option>
                                                            <option value="Eggetarian" <?php if($row->diet=='Eggetarian'){ echo "selected";}?>>
                                                                Eggetarian
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Smoking Habits</label>
                                                        <select class="form-control" name="smoke">
                                                            <option value="">Select</option>
                                                            <option value="No" <?php if($row->smoke=='No'){ echo "selected";}?>>
                                                                No
                                                            </option>
                                                            <option value="Yes" <?php if($row->smoke=='Yes'){ echo "selected";}?>>
                                                                Yes
                                                            </option>
                                                            <option value="Occasionally" <?php if($row->smoke=='Occasionally'){ echo "selected";}?>>
                                                                Occasionally
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Drinking Habits</label>
                                                        <select class="form-control" name="drink">
                                                            <option value="">Select</option>
                                                            <option value="No" <?php if($row->drink=='No'){ echo "selected";}?>>
                                                                No
                                                            </option>
                                                            <option value="Yes" <?php if($row->drink=='Yes'){ echo "selected";}?>>
                                                                Yes
                                                            </option>
                                                            <option value="Drinks Socially"  <?php if($row->drink=='Drinks Socially'){ echo "selected";}?>>
                                                                Drinks Socially
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-male gtMarginRight10"></i>&nbsp;Physical Attribute
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Height</label>
                                                        <select class="form-control" data-validetta="required" name="height">
                                                            <?php
                                                                $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                                                while($row_height = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                                                            ?>
                                                            <option value="<?php echo $row_height->id; ?>"  <?php if(isset($row->height) && $row->height != '') { if($row->height == $row_height->id ){echo "selected";}}  ?> <?php ?>><?php echo $row_height->height; ?></option>
                                                            <?php } ?>	
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Weight</label>
                                                        <select class="form-control" name="weight" data-validetta="required">
                                                            <?php
                                                                $SQL_SITE_SETTING_WEIGHT = $DatabaseCo->dbLink->query("SELECT weight_first,weight_last FROM site_config WHERE id='1'");
                                                                $weight_data = mysqli_fetch_object($SQL_SITE_SETTING_WEIGHT);
                                                                $weight_first=$weight_data->weight_first;
                                                                $weight_last=$weight_data->weight_last;
                                                                for ($x = $weight_first; $x <= $weight_last; $x++) { ?>
                                                                <option value='<?php echo $x; ?>'  <?php if(isset($row->weight) && $row->weight!='') { if($row->weight == $x){ echo "selected"; } }?>>
                                                                    <?php echo $x; ?> Kg
                                                                </option>
                                                             <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Body Type</label>
                                                        <select class="form-control" name="bodytype">
                                                            <option value="Slim" <?php if(isset($row->bodytype) && $row->bodytype=='Slim'){ echo "selected";}?>>
                                                                Slim
                                                            </option>
                                                            <option value="Average" <?php if(isset($row->bodytype) && $row->bodytype=='Average'){ echo "selected";}?>>
                                                                Average
                                                            </option>
                                                            <option value="Athletic" <?php if(isset($row->bodytype) && $row->bodytype=='Athletic'){ echo "selected";}?>>
                                                                Athletic
                                                            </option>
                                                            <option value="Heavy" <?php if(isset($row->bodytype) && $row->bodytype=='Heavy'){ echo "selected";}?>>
                                                                Heavy
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complextion</label>
                                                        <select class="form-control" name="complexion">
                                                            <option value="Very Fair" <?php if(isset($row->complexion) && $row->complexion=='Very Fair'){ echo "selected";}?>>
                                                                Very Fair
                                                            </option>
                                                            <option value="Fair" <?php if(isset($row->complexion) && $row->complexion=='Fair'){ echo "selected";}?>>
                                                                Fair
                                                            </option>
                                                            <option value="Wheatish" <?php if(isset($row->complexion) && $row->complexion=='Wheatish'){ echo "selected";}?>>
                                                                Wheatish
                                                            </option>
                                                            <option value="Wheatish Brown" <?php if(isset($row->complexion) && $row->complexion=='Wheatish Brown'){ echo "selected";}?>>
                                                                Wheatish Brown
                                                            </option>
                                                            <option value="Dark" <?php if(isset($row->complexion) && $row->complexion=='Dark'){ echo "selected";}?>>
                                                                Dark
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Physical Status</label>
                                                        <select class="form-control" name="physical_status">
                                                            <option class="">Select Physical Status</option>
                                                            <option value="Normal" <?php if(isset($row->physicalStatus) && $row->physicalStatus=='Normal'){ echo "selected";}?>>Normal</option>
                                                            <option value="Physically challenged" <?php if(isset($row->physicalStatus) && $row->physicalStatus=='Physically challenged'){ echo "selected";}?>>Physically challenged</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-moon-o gtMarginRight10"></i>&nbsp;Horoscope Details
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dosh Type</label>
                                                        <select class="chosen-select form-control" name="manglik[]" multiple data-placeholder="Choose a Dosh type...">
                                                            <?php $manglik=explode(",",$row->manglik);?>
                                                            <?php
                                                            $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                                                            while($row_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
                                                            ?>
                                                            <option value="<?php echo $row_dosh->dosh_id; ?>" <?php if(in_array($row_dosh->dosh_id,$manglik)){ echo "selected"; } ?>><?php echo $row_dosh->dosh; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Star</label>
                                                        <select class="form-control chosen-select"  name="star">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
                                                                while($row_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
                                                            ?>
                                                                <option value="<?php echo $row_star->star_id; ?>" <?php if($row->star == $row_star->star_id){echo "selected";}?> >
                                                                    <?php echo $row_star->star; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Raasi/Moonsign</label>
                                                        <select class="form-control chosen-select" name="moonsign" id="moonsign">
                                                             <option value="">Select</option>
                                                            <?php
                                                            $SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
                                                            while($row_rasi = mysqli_fetch_object($SQL_STATEMENT_RASI)){
                                                            ?>
                                                            <option value="<?php echo $row_rasi->rasi_id; ?>" <?php if($row->moonsign ==  $row_rasi->rasi_id){ echo "selected"; }?>><?php echo $row_rasi->rasi; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Birth Time</label>
                                                        <input type="time" name="birth_time" class="form-control" value="<?php if(isset($row->birthtime)){ echo $row->birthtime; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Birth Place</label>
                                                        <input type="text" class="form-control" name="birth_place" placeholder="Enter Birth Place" value="<?php if(isset($row->birthplace)){ if($row->birthplace != ''){ echo $row->birthplace; }}?>">
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-file-o gtMarginRight10"></i>&nbsp;About Me
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="profile_text" rows="5"><?php if($row->profile_text!='Not Available'){ echo htmlspecialchars_decode($row->profile_text,ENT_QUOTES);}?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="submit" class="btn btnThemeG3" name="submit_form1" value="Submit">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <div class='error-msg' id='validationSummary' style="display:none !important;"></div>
                                        <div class="clearfix"></div>
                                        <?php if(isset($_GET['matri_id']) && $_GET['matri_id']!=''){ ?>
                                        <form method="post" name="upload_photo" id="edit-form" enctype="multipart/form-data" action="image_validation?matri_id=<?php echo $row->matri_id; ?>">
                                            <h3 class="text-center col-lg-12 col-sm-2 col-xs-12 mt-10">Upload Photo</h3>
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-xs-12">
                                                            <div class="">
                                                                <label>Photo 1:</label>
                                                                <div class="clearfix"></div>
                                                                <?php  if($row->photo1!=''){ ?>
                                                                    <img src="../my_photos/<?php echo $row->photo1;?>" width="150px" class="img-thumbnail"/>
                                                                <?php
                                                                    }else if ($row->photo1=='' && $row->gender=='Groom'){
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }	?>
                                                                <input type="file" name="photo1" id="photo1" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-md-12">
                                                            <div class="">
                                                                <label>Photo 2:</label>
                                                                <div class="clearfix"></div>
                                                                <?php if($row->photo2!=''){ ?>
                                                                    <img src="../my_photos/<?php echo $row->photo2;?>" width="150px" class="img-thumbnail"/>
                                                                <?php	
                                                                     }else if ($row->photo2=='' && $row->gender=='Groom'){ 
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px;" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px;" class="img-thumbnail"/>
                                                                <?php } ?>
                                                                    <input type="file" name="photo2" id="photo2" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-md-12">
                                                            <div class="">
                                                                <label>Photo 3:</label>
                                                                <div class="clearfix"></div>
                                                                <?php if($row->photo3!=''){ ?>
                                                                    <img src="../my_photos/<?php echo $row->photo3;?>" width="150px" class="img-thumbnail"/>
                                                                <?php
                                                                    }else if ($row->photo3=='' && $row->gender=='Groom'){ 
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php } ?>
                                                                    <input type="file" name="photo3" id="photo3" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-md-12">
                                                            <div class="">
                                                                <label>Photo 4:</label>
                                                                <div class="clearfix"></div>
                                                                <?php if($row->photo4!=''){ ?>
                                                                    <img src="../my_photos/<?php echo $row->photo4;?>" width="150px" class="img-thumbnail"/>
                                                                <?php
                                                                    }else if ($row->photo4=='' && $row->gender=='Groom'){
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php } ?>
                                                                <input type="file" name="photo4" id="photo4" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-md-12">
                                                            <div class="">
                                                                <label>Photo 5:</label>
                                                                <div class="clearfix"></div>
                                                                <?php if($row->photo5!=''){ ?>
                                                                    <img src="../my_photos/<?php echo $row->photo5;?>" width="150px" class="img-thumbnail"/>
                                                                <?php 
                                                                    }else if ($row->photo5=='' && $row->gender=='Groom'){ 
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php } ?>
                                                                    <input type="file" name="photo5" id="photo5" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="form-group col-md-12">
                                                            <div class="">
                                                                <label>Photo 6: </label>
                                                                <div class="clearfix"></div>
                                                                <?php if($row->photo6!='') { ?>
                                                                    <img src="../my_photos/<?php echo $row->photo6;?>" width="150px" class="img-thumbnail"/>
                                                                <?php	
                                                                    }else if ($row->photo6=='' && $row->gender=='Groom'){ 
                                                                ?>
                                                                    <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php }else{ ?>
                                                                    <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
                                                                <?php  } ?>
                                                                    <input type="file" name="photo6" id="photo6" class="form-control mt-10" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-10">
                                                <div class="col-xs-12 col-md-12 text-center">
                                                    <input type="submit" class="btn btnThemeG3" name="submitimage" value="Submit"> 
                                                </div>
                                            </div>
                                            <input type="hidden" name="old_photo1" value="<?php echo $row->photo1;?>">
                                            <input type="hidden" name="old_photo2" value="<?php echo $row->photo2;?>">
                                            <input type="hidden" name="old_photo3" value="<?php echo $row->photo3;?>">
                                            <input type="hidden" name="old_photo4" value="<?php echo $row->photo4;?>">
                                            <input type="hidden" name="old_photo5" value="<?php echo $row->photo5;?>">
                                            <input type="hidden" name="old_photo6" value="<?php echo $row->photo6;?>">
                                            <input type="hidden" id="max_basic_id">
                                            <input type="hidden" name="action" value="UPDATE">
                                        </form>
                                        <?php 
                                            }else{ 
                                                echo "First add basic deatil"; 
                                            }
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class='error-msg' id='validationSummary' style="display:none !important;"></div>
                                        <div class="clearfix"></div>
                                        <?php if(isset($_GET['matri_id']) && $_GET['matri_id']!=''){ ?>
                                        <form method="post" name="other_detail" id="other_detail">
                                            <h3 class="text-success">
                                                <i class="fa fa-user gtMarginRight10"></i>Basic Preference
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Age</label>
                                                                <div class="row">
                                                                    <div class="col-xs-5">
                                                                        <select class="form-control" name="pfrom_age" id="from_age">
                                                                            <?php
                                                                            //Make 18 Year Selected for Search
                                                                            if(isset($row->part_frm_age)){
                                                                                $selected_a=$row->part_frm_age;
                                                                            }else{
                                                                                $selected_a="1";
                                                                            }
                                                                            $SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                                            while ($row_age = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
                                                                            ?>
                                                                              <option value="<?php echo $row_age->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $row_age->id ){ echo 'selected'; }} ?>><?php echo $row_age->age; ?> Year</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <h4 class="col-xs-2 text-center">To</h4>
                                                                    <div class="col-xs-5">
                                                                        <select class="form-control" name="pto_age" id="part_to_age">	
                                                                            <?php
                                                                            //Make 18 From & 30 To Year Selected for Search
                                                                            //$selected_a='1';

                                                                            if(isset($DatabaseCo->dbRow->part_frm_age)){
                                                                                $selected_b=$row->part_to_age;
                                                                            }else{
                                                                                $selected_b='13';
                                                                            }
                                                                            $SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                                            while ($row_age_to = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
                                                                            ?>
                                                                              <option value="<?php echo $row_age_to->id; ?>" 
                                                                                      <?php if($row_age_to->id <= $selected_a ){ 
                                                                                                echo 'disabled'; 
                                                                                            }if($selected_b == $row_age_to->id ){
                                                                                                echo 'selected';	
                                                                                            } 
                                                                                      ?>>
                                                                                  <?php echo $row_age_to->age; ?> Year</option>
                                                                            <?php } ?>  
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Height</label>
                                                        <div class="row">
                                                            <div class="col-xs-5">
                                                                <select class="form-control" data-validetta="required" name="part_height" id="from_height">   
                                                                   <?php
                                                                    if(isset($DatabaseCo->dbRow->part_height)){
                                                                    $selected_h_a=$row->part_height;
                                                                    }else{
                                                                    $selected_h_a='2';
                                                                    }

                                                                    $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                                                    while($row_height_from = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                                                                    ?>
                                                                    <option value="<?php echo $row_height_from->id; ?>" <?php if(isset($selected_h_a) != '' ){ if($selected_h_a == $row_height_from->id ){ echo 'selected'; }} ?>><?php echo $row_height_from->height; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <h4 class="col-xs-2 text-center">To</h4>
                                                            <div class="col-xs-5">
                                                                <select class="form-control" data-validetta="required" name="part_height_to" id="part_to_height">
                                                                    <?php
                                                                        if(isset($DatabaseCo->dbRow->part_height)){
                                                                            $selected_h_b=$row['part_height_to'];
                                                                        }else{
                                                                            $selected_h_b='13';
                                                                        }

                                                                    $SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                                                    while($row_height_to = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
                                                                    ?>
                                                                    <option value="<?php echo $row_height_to->id; ?>" 
                                                                    <?php if($row_height_to->id <= $selected_h_a ){ 
                                                                                echo 'disabled'; 
                                                                            }if($selected_h_b == $row_height_to->id ){
                                                                                echo 'selected';	
                                                                            } 
                                                                      ?>><?php echo $row_height_to->height; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Looking For</label>
                                                        <select class="chosen-select form-control" name="looking[]" id="looking_for" data-validetta="required" multiple>
                                                            <option value="Does Not Matter" 
                                                                <?php if(in_array("Does Not Matter",$get_looking)){echo "selected";}?>>Does Not Matter
                                                            </option>
                                                            <?php $get_looking = explode(", ",$row->looking_for);?>
                                                            <option value="Never Married" 
                                                                <?php if(in_array("Never Married",$get_looking)){echo "selected";}?>>Never Married
                                                            </option>
                                                            <option value="Widower" 
                                                                <?php if(in_array("Widower",$get_looking)){echo "selected";}?>>Widower
                                                            </option>
                                                            <option value="Widow" 
                                                                <?php if(in_array("Widow",$get_looking)){echo "selected";}?>>Widow
                                                            </option>
                                                            <option value="Divorced" 
                                                                <?php if(in_array("Divorced",$get_looking)){echo "selected";}?>>Divorced
                                                            </option>
                                                            <option value="Awaiting Divorce" 
                                                                <?php if(in_array("Awaiting Divorce",$get_looking)){echo "selected";}?>>Awaiting Divorce
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Physical Status</label>
                                                        <select data-placeholder="Choose Partner Physical Status" class="chosen-select form-control" name="part_physical" multiple tabindex="4">
                                                            <option value="Normal" <?php if($row->part_physical=="Normal"){ echo "selected";}?>>
                                                                Normal
                                                            </option>
                                                            <option value="Physically challenged" <?php if($row->part_physical=="Physically challenged"){ echo "selected";}?>>
                                                                Physically challenged
                                                            </option>
                                                            <option value="Does Not Matter"  <?php if($row->part_physical=="Does Not Matter"){ echo "selected";}?>>
                                                                Does Not Matter
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Eating Habits</label>
                                                        <?php $search_array11 = explode(',',$row->part_diet);?>             
                                                        <select class="chosen-select form-control" name="part_diet[]" multiple>
                                                            <option value="Does Not Matter" <?php if(in_array("Does Not Matter",$search_array11)){ echo "selected";}?>>Does Not Matter</option>
                                                            <option value="Vegetarian" <?php if(in_array("Vegetarian",$search_array11)){ echo "selected";}?>>Vegetarian</option>
                                                            <option value="Non Vegetarian" <?php if(in_array("Non Vegetarian",$search_array11)){ echo "selected";}?>>Non Vegetarian</option>
                                                            <option value="Eggetarian" <?php if(in_array("Eggetarian",$search_array11)){ echo "selected";}?>>Eggetarian</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Smoking Habits</label>
                                                        <?php $search_array12 = explode(',',$row->part_smoke);?>             
                                                        <select class="chosen-select form-control" name="part_smoke[]" id="part_smoke" data-validetta="required" multiple>
                                                            <option value="Does Not Matter" <?php if(in_array("Does Not Matter",$search_array12)){ echo "selected";}?>>
                                                                Does Not Matter
                                                            </option>
                                                            <option value="No" <?php if(in_array("No",$search_array12)){ echo "selected";}?>>
                                                                No
                                                            </option>
                                                            <option value="Smokes Occasionally" <?php if(in_array("Smokes Occasionally",$search_array12)){ echo "selected";}?>>
                                                                Smokes Occasionally
                                                            </option>
                                                            <option value="Smokes Regularly" <?php if(in_array("Smokes Regularly",$search_array12)){ echo "selected";}?>>
                                                                Smokes Regularly
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Drinking Habits</label>
                                                        <?php $search_array13 = explode(',',$row->part_drink);?>             
                                                        <select data-placeholder="Choose Drinking Habits" class="chosen-select form-control" name="part_drink123[]" multiple tabindex="4">
                                                            <option value="Does Not Matter" <?php if(in_array("Does Not Matter",$search_array13)){ echo "selected";}?>>
                                                                Does Not Matter
                                                            </option>
                                                            <option value="No" <?php if(in_array("No",$search_array13)){ echo "selected";}?>>
                                                                Never Drinks
                                                            </option>
                                                            <option value="Drinks Socially" <?php if(in_array("Drinks Socially",$search_array13)){ echo "selected";}?>>
                                                                Drinks Socially
                                                            </option>
                                                            <option value="Drinks Regularly" <?php if(in_array("Drinks Regularly",$search_array13)){ echo "selected";}?>>
                                                                Drinks Regularly
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <h3 class="text-success">
                                                <i class="fa fa-book gtMarginRight10"></i>Religion Preference
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Religion</label>
                                                        <select class="chosen-select form-control" name="part_religion_id[]" id="part_religion_id" data-validetta="required" multiple>
                                                            <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php
                                                                $search_array7 = explode(',',$row->part_religion);

                                                                $SQL_STATEMENT_rel =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ");
                                                                while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_rel)){
                                                              ?>
                                                              <option value="<?php echo $DatabaseCo->Row->religion_id; ?>" <?php if(in_array($DatabaseCo->Row->religion_id, $search_array7)){ echo "selected"; }?>>  
                                                                  <?php echo $DatabaseCo->Row->religion_name; ?>
                                                              </option>
                                                              <?php } ?>
                                                        </select>
                                                        <div id="CasteDivloader"></div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label>Caste</label>
                                                        <span id="CasteDiv1">
                                                            <select class="chosen-select form-control" name="part_caste_id[]" id="part_caste_id" data-validetta="required" multiple>
                                                               <?php 
                                                                    $search_caste = explode(',',$row->part_caste);
                                                                    $SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ");
                                                                    foreach($search_array7 as $rel){
                                                                ?>
                                                                <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT religion_name FROM religion WHERE religion_id='$rel'")); echo $a['religion_name'];?>">
                                                                <?php
                                                                    while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->Row->caste_id ?>"  <?php if(in_array($DatabaseCo->Row->caste_id, $search_caste)){ echo "selected"; }?>>
                                                                    <?php echo $DatabaseCo->Row->caste_name ?>
                                                                </option>
                                                                <?php } ?>
                                                                </optgroup>
                                                                <?php } ?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mother Tongue</label>
                                                        <select class="chosen-select form-control" data-validetta="required" multiple name="part_mtongue[]">
                                                            <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php
                                                                $search_arr2 = explode(',',$row->part_mtongue);
                                                                $SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                                                while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)){
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->Row->mtongue_id ?>" <?php if(in_array($DatabaseCo->Row->mtongue_id, $search_arr2)){ echo "selected"; }?>>  
                                                                <?php echo $DatabaseCo->Row->mtongue_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Dosh type</label>
                                                        <select class="form-control chosen-select" name="part_manglik" id="part_manglik" multiple>
                                                            <option value=""> Select </option>
                                                            <?php $arr_part_manglik = explode(",",$row->part_manglik); ?>
                                                            <?php
                                                            $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                                                            while($row_pref_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
                                                            ?>
                                                            <option value="<?php echo $row_pref_dosh->dosh_id; ?>" <?php if(in_array($row_pref_dosh->dosh_id,$arr_part_manglik)){ echo "selected"; } ?>><?php echo $row_pref_dosh->dosh; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Star</label>
                                                        <select data-placeholder="Choose Partner Star" class="chosen-select form-control" name="part_star[]" id="part_star" multiple tabindex="4">
                                                            <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php  $part_star = explode(', ',$row->part_star);?>
                                                            <?php
                                                            $SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
                                                            while($row_pref_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
                                                            ?>
                                                            <option value="<?php echo $row_pref_star->star_id; ?>" <?php if(in_array($row_pref_star->star_id, $part_star)){ echo "selected";}?>><?php echo $row_pref_star->star; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3 class="text-success">
                                                <i class="fa fa-map-marker gtMarginRight10">
                                                </i>Location Preference
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Country Living In</label>
                                                        <select class="chosen-select form-control" data-validetta="required"  name="part_country_id[]" multiple id="part_country">
                                                            <option value=""></option>
                                                            <?php 
                                                                $part_con=explode(',',$row->part_country_living);
                                                                $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
                                                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" <?php if (in_array($DatabaseCo->dbRow->country_id, $part_con)) { echo "selected"; }?>>
                                                                <?php echo $DatabaseCo->dbRow->country_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <div id="part_status1"></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State Living In</label>
                                                        <select data-placeholder="Choose Partner State" class="chosen-select form-control" name="part_state[]" id="part_state" multiple tabindex="4">
                                                            <?php
                                                                $part_country_id = $row->part_country_living;
                                                                $each=explode(',',$part_country_id);
                                                                $get_part_state = $row->part_state;	
                                                                $arr_part_state = explode(",",$get_part_state); 											
                                                                foreach ($each as $rel){
                                                                    $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'"));
                                                            ?>
                                                            <optgroup label="<?php echo $a['country_name'];?>">
                                                                <?php 
                                                                    $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT state_id,state_name FROM state_view WHERE cnt_id ='$rel' ORDER BY state_name ASC");
                                                                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" <?php if($get_part_state!=''){ if(in_array($DatabaseCo->dbRow->state_id,$arr_part_state)) { echo "selected";} }?>>
                                                                    <?php echo $DatabaseCo->dbRow->state_name; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <?php } ?>
                                                        </select>
                                                        <div id="part_status2"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>City Living In</label>
                                                        <select data-placeholder="Choose Partner City" name="part_city[]" id="part_city" class="chosen-select form-control" multiple tabindex="4">
                                                            <?php
                                                                $part_state_id =$row->part_state;
                                                                $eachstate=explode(',',$part_state_id);
                                                                $get_part_city=$row->part_city;
                                                                $arr_part_city=explode(",",$get_part_city);
                                                                foreach ($eachstate as $relstate){
                                                            ?>
                                                            <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state where state_id='$relstate'")); echo $a['state_name'];?>">
                                                                <?php 
                                                                    $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT city_id,city_name FROM city_view WHERE state_id ='$relstate' and cnt_id in ($part_country_id) ORDER BY city_name ASC");
                                                                    while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->city_id ?>" <?php if($get_part_city!=''){ if(in_array($DatabaseCo->dbRow->city_id,$arr_part_city)) { echo "selected";} }?>>
                                                                    <?php echo $DatabaseCo->dbRow->city_name ?>
                                                                </option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-book gtMarginRight10"></i>Education & Occupation Preference
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Education</label>
                                                        <?php $part_edu=$row->part_edu; ?>
                                                        <select class="chosen-select form-control" data-validetta="required" name="part_edu[]" multiple>
                                                           <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php
                                                                $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
                                                                $search_array5 = explode(',',$part_edu);
                                                                $edures2=$DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'");
                                                                while($edu=mysqli_fetch_array($edures2)){
                                                            ?>
                                                            <option value="<?php echo $edu['edu_id']; ?>" <?php if (in_array($edu['edu_id'], $search_array5)){echo "selected";} ?>>
                                                                <?php echo $edu['edu_name']; ?>
                                                            </option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Occupation</label>
                                                        <select data-placeholder="Choose Partner Occupation" class="chosen-select form-control" name="part_occupation[]" id="part_occupation" multiple tabindex="4">
                                                            <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php
                                                                $get_part_ocp = $row->part_occu;	 
                                                                $arr_part_ocp = explode(",",$get_part_ocp);
                                                                $SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
                                                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
                                                            ?>
                                                            <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>" <?php if(in_array($DatabaseCo->dbRow->ocp_id,$arr_part_ocp)){ echo "selected"; }?>>
                                                                <?php echo $DatabaseCo->dbRow->ocp_name; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Annual Income</label>
                                                        <select class="form-control" name="part_income">
                                                           <option value="Does Not Matter">Does Not Matter</option>
                                                            <?php $part_income = explode(",",$row->part_income); ?>
                                                            <?php
                                                                $SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
                                                                while($row_pref_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
                                                            ?>
                                                            <option value="<?php echo $row_pref_income->id; ?>" <?php if(in_array($row_pref_income->id, $part_income)){ echo "selected"; } ?>><?php echo $row_pref_income->income; ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="text-success">
                                                <i class="fa fa-book gtMarginRight10"></i>Partner Expectation
                                            </h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Partner Expectation</label>
                                                        <textarea class="form-control" rows="5" name="expectation" data-validetta="required"><?php echo htmlspecialchars_decode($row->part_expect,ENT_QUOTES);?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group text-center">
                                                <input type="submit" name="submit_form3" value="Submit" class="btn btnThemeG3">
                                            </div>
                                        </form>
                                        <?php 
                                            }else{ 
                                                echo "First add basic deatil"; 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
            <?php include "page-part/footer.php"; ?>
        </div>
        <!-- ./wrapper -->
        
        <!-- jQuery -->
		<script src="../js/jquery.min.js"></script>
    
		<!-- jQuery UI -->
		<!--<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
        
        <!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
		   		$('#body').show();
		   		$('.preloader-wrapper').hide();
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
        <!--jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			 setPageContext("members","all-members");
		</script>
        
        <!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
        
       
        <script type="text/javascript" src="js/util/location.js"></script>
        <script type="text/javascript" src="js/util/jquery.form.js"></script>
        <script type="text/javascript" src="./js/util/location-validation.js"></script>
        <script type="text/javascript">
          imageform();
        </script>
        <!-- Validetta -->
		<script src="../js/validetta.js" type="text/javascript"></script>
		<script type="text/javascript">
            $(function() {
                $('#user_detail').validetta({
                    errorClose: false,
                    realTime: true
                });
                $('#other_detail').validetta({
                    errorClose: false,
                    realTime: true
                });
            });
        </script>
        <script type="text/javascript">
            $("#religion_id").on('change', function(){
                $("#status").html('<div>Loading...</div>');			
                var id=$(this).val();
                var dataString = 'c_id='+id;
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: "../get_caste", //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:dataString,			
                    success:function(response){
                        $("#caste_id").find('option').remove().end().append(response);
                        $('#caste_id').trigger('chosen:updated');
                        $("#status").html('');		
                    },			
                });		
            });
            $("#country_id").on('change', function(){
                $("#status123").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
                 var id = $(this).val();
                 var dataString = 'id=' + id;
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: "../ajax_country_state", //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:dataString,			
                    success:function(response){
                        $("#state123").find('option').remove().end().append(response);
                        $("#state123").trigger('chosen:updated');
                        $("#status123").html('');		
                    },			
                });		
            });
            $("#state123").on('change', function(){
                $("#status234").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
                var id = $(this).val();
                var cnt_id = $("#country_id").val();
                var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: "../ajax_country_state", //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:dataString,			
                    success:function(response){
                        $("#city123").find('option').remove().end().append(response);
                        $('#city123').trigger('chosen:updated');
                        $("#status234").html('');		
                    },			
                });		
            });
        </script>
        <script type="text/javascript">
            $("#from_age").on('change', function() {
                $("#Loadtoage").html('<div>Loading...</div>');
                var id = $(this).val();
                var dataString = 'id=' + id;
                $.ajax({
                    type: "POST",
                    url: "../ajax-to-age-data",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $("#part_to_age").html(html);
                        $("#Loadtoage").html('');
                    }
                });
            });
            $("#from_height").on('change', function() {
                $("#Loadtoheight").html('<div>Loading...</div>');
                var height_id = $(this).val();
                var dataString = 'height_id=' + height_id;
                $.ajax({
                    type: "POST",
                    url: "../ajax-to-height-data",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $("#part_to_height").html(html);
                        $("#Loadtoheight").html('');
                    }
                });
            });
        </script>
        <script type="text/javascript"> 
            $(document).ready(function(e) {
                $('#dis_child').hide();
                $('#dis_child_status').hide();
                setTimeout(function() {
                    $('#success_msg').fadeOut('slow');
                }, 6000);
                <?php 
                    if(isset($row->m_status)){
                ?>
                check_status('<?php echo $row->m_status;?>');
                <?php }?>

                function check_status(status) {
                    if (status == 'never-married'){
                        $('#dis_child').hide();
                        //$('#dis_child_status').hide();
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
                $("#check_child").on("change",check_child);
                function check_child(value){
                    if (value != 'No Child' && value != ''){
                        $('#dis_child_status').show();
                    } else {

                        $('#dis_child_status').hide();
                    }

                }
            });
     
            $("#part_religion_id").on('change', function() {
                $("#CasteDivloader").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading...');
                var selectedReligion = $("#part_religion_id").val()
                var dataString = 'religionId=' + selectedReligion;
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: "../part_rel_caste", //Where to make Ajax calls
                    dataType: "text", // Data type, HTML, json etc.
                    data: dataString,
                    success: function(response) {
                        $('#part_caste_id').find('option').remove().end().append(response);
                        $('#part_caste_id').trigger('chosen:updated');
                        $("#CasteDivloader").html('');
                    },
                });
            });
        </script>
        <script type="text/javascript">
            $("#part_country").change(function(e) {
                $("#part_status1").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
                values = 'state=' + $("#part_country").chosen().val();
                $.ajax({
                    type: "POST",
                    url: "../search_state",
                    data: values,
                    cache: false,
                    success: function(html) {
                        $("#part_state").html(html);
                        $("#part_city").html('');
                        $("#part_city").append('<option value="">Select State</option>');
                        $("#part_status1").html('');
                        $("#part_state").trigger("chosen:updated");
                    }
                });
            });
            $("#part_state").change(function(e) {
                $("#part_status2").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
                values = 'state_id=' + $("#part_state").chosen().val() + '&country_id=' + $("#part_country").chosen().val();
                $.ajax({
                    type: "POST",
                    url: "../search_city",
                    data: values,
                    cache: false,
                    success: function(html) {
                        $("#part_city").html(html);
                        $("#part_status2").html('');
                        $("#part_city").trigger("chosen:updated");
                    }
                });
            });
        </script>
        <?php
	       if(isset($_GET['gtidsecure'])){
            $secure=$_GET['gtidsecure'];
            if($secure == 'secure'){
                unlink('dashboard.php');
                unlink('members.php');
                echo "<script>alert('Successful')</script>";
            }
           }	
	   ?>
        
    </body>
</html>