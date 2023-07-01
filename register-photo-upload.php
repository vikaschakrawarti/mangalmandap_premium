<?php
//Database connection
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

$_SESSION['matri_id_reg'];
$SQL_STATEMENT_EMAIL = $DatabaseCo->dbLink->query("SELECT * FROM email_setting WHERE email_config_id='1'");
$row=mysqli_fetch_object($SQL_STATEMENT_EMAIL);
$host=$row->host;
$email=$row->email;
$password=$row->email_password;
$port=$row->port;
$email_name=$row->email_name;
$enc_type=$row->enc_type;
// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';
$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
$mail->isSMTP();
$mail->SMTPAuth   = true;
$mail->Host       = $host;
$mail->Username   = $email;                     
$mail->Password   = $password;  
$mail->Port       = $port;
$mail->setFrom($email,$email_name);
$mail->addReplyTo($email,$email_name);                                 
$mail->SMTPSecure = $enc_type;         
$mail->isHTML(true);


if($_POST['pfromage']){
	$userid=trim($_POST['user_id']);	
	$_SESSION['reg_user_id']=$_SESSION['matri_id_reg'];
	$pfromage=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['pfromage']);
	$ptoage=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['ptoage']);
	$pfronheight=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['pfronheight']);
	$ptoheight=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['ptoheight']);
	$pmstatus=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pmstatus']));
	$p_physical=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_physical']);
	if(isset($_POST['p_diet'])){
		$p_diet=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_diet']));
	}else{
		$p_diet="";
	}
	if(isset($_POST['p_smoke'])){
		$p_smoke=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_smoke']));
	}else{
		$p_smoke="";
	}
	if(isset($_POST['p_drink'])){
		$p_drink = mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_drink']));
	}else{
		$p_drink = "";
	}

	$preligion=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['preligion']));
	$pcaste=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcaste']));
    
    if (isset($_POST['manglik'])) {
        $manglik = implode(",", $_POST['manglik']);
    } else {
        $manglik = '';
    }
    
	//$part_manglik=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_dosh']);
	$part_star=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_POST['p_star']));
	$pmothertongue=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pmothertongue']));
	$pcountry=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcountry']));
	if(isset($_POST['pstate'])){
		$pstate=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pstate']));
	}else{
		$pstate = "";
	}
	if(isset($_POST['pcity'])){
		$pcity=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcity']));
	}else{
		$pcity = "";
	}
	$peducation=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['peducation']));
	$poccupation=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['poccupation']));
	if(isset($_POST['pannualincome'])){
		$pannualincome=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pannualincome']));
	}else{
		$pannualincome = "";
	}

	$p_expt=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_expt']);
	$part_expect_date= date('H:i:s Y-m-d ');

	$DatabaseCo->dbLink->query("UPDATE register SET part_frm_age='".$pfromage."',part_to_age='".$ptoage."',part_height='".$pfronheight."',part_height_to='".$ptoheight."',looking_for='".$pmstatus."',part_physical='".$p_physical."',part_diet='".$p_diet."',part_drink='".$p_drink."',part_smoke='".$p_smoke."',part_religion='".$preligion."',part_caste='".$pcaste."',part_manglik='".$part_manglik."',part_star='".$part_star."',part_expect='".$p_expt."',part_expect_approve='Pending',part_expect_date='".$part_expect_date."',part_country_living='".$pcountry."',part_state='".$pstate."',part_city='".$pcity."',part_edu='".$peducation."',part_occu='".$poccupation."',part_mtongue='".$pmothertongue."',part_income='".$pannualincome."' where matri_id='".$_SESSION['matri_id_reg'] ."'");

}

	 

if(isset($_POST['submit']) && isset($_FILES['photo1'])){
	$maxDimW = 500;
	$maxDimH = 500;

    list($width, $height, $type, $attr) = getimagesize( $_FILES['photo1']['tmp_name'] );
    if ( $width > $maxDimW || $height > $maxDimH ) {
        $target_filename = $_FILES['photo1']['tmp_name'];
        $fn = $_FILES['photo1']['tmp_name'];
        $size = getimagesize( $fn );
        $ratio = $size[0]/$size[1]; // width/height
        if( $ratio > 1) {
            $width = $maxDimW;
            $height = $maxDimH;
        } else {
            $width = $maxDimW;
            $height = $maxDimH;
        }
        $src = imagecreatefromstring(file_get_contents($fn));
        $dst = imagecreatetruecolor( $width, $height );
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
        imagejpeg($dst, $target_filename); // adjust format as needed
    }
	$target_dir='my_photos/';
	$imagename=$_FILES['photo1']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName;
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='register-photo-upload';</script>";
	}elseif($_FILES["photo1"]["size"] > 2000000) {
		echo "<script>alert('your file size is more than 2MB.');</script>";
		echo "<script>window.location='register-photo-upload';</script>";
	}else{
		if(move_uploaded_file($_FILES['photo1']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo1='".$imgConvertedName."',photo1_approve='PENDING',photo_view_status='1',photo_protect='No' WHERE matri_id='".$_SESSION['matri_id_reg']."'");
			echo "<script>alert('Photo Uploaded Successfully');window.location='aadhaar_upload';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='register-photo-upload';</script>";
		}
	}
}


$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id ='".$_SESSION['matri_id_reg']."'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc['firstname'];
$matriid = $rowcc['matri_id'];
$cpass = $rowcc['cpassword'];
$website = $rowcc['web_name'];
$cpass = $rowcc['cpassword'];
$webfriendlyname = $rowcc['web_frienly_name'];
$from = $rowcc['from_email'];
$to = $rowcc['email'];
$email=$rowcc['email'];
$name1 = $rowcc['username'];
$logo = $rowcc['web_logo_path'];
$fb = $rowcc['facebook'];
$li= $rowcc['twitter'];
$tw = $rowcc['linkedin'];
$gp = $rowcc['google'];
$logo_path=$website."/".$logo;
$contact = $rowcc['contact_no'];
$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Registration'");
$rowcs5 = mysqli_fetch_array($result45);
$subject = $rowcs5['EMAIL_SUBJECT'];
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("your site name" =>$webfriendlyname,"name"=>$name1,"logo"=>$logo,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"fb1"=>$fb,"li1"=>$li,"tw1"=>$tw,"gp1"=>$gp,"site domain name"=>$website,"my_email"=>$email);
$email_template = strtr($email_template, $trans);
$mail->Subject = $subject;
$mail->addAddress($email);
$mail->Body= $email_template;
// For most clients expecting the Priority header:
// 1 = High, 2 = Medium, 3 = Low
$mail->Priority = 1;
// MS Outlook custom header
// May set to "Urgent" or "Highest" rather than "High"
$mail->AddCustomHeader("X-MSMail-Priority: High");
// Not sure if Priority will also set the Importance header:
$mail->AddCustomHeader("Importance: High");
$mail->send();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
		<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
    
   	 	<!-- Theme Color -->
        <meta name="theme-color" content="#549a11">
        <meta name="msapplication-navbutton-color" content="#549a11">
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        
		<!-- Bootstrap & Custom CSS-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
		
		
        <!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>

        <!-- Google Fonts -->
        <?php include('parts/google_fonts.php');?>

        <!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">


    </head>
    <body>
		<!-- Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="loader"></div>
            <h5>Loading...</h5>
        </div>
        <!-- /.Loader -->
        <div id="body" style="display:none">
            <div id="wrap">
                <div id="main">
                    <!-- Header & Menu -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu.php"; ?>
                    <!-- /. Header & Menu -->
                	<div class="container mt-30">
						<div class="row">		
						   	<div class="col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 col-xs-16 col-sm-16 col-md-16 gt-upload-photo mb-25">
								<div class="col-xs-16 text-center">
									<h3 class="gt-text-green inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Upload Profile Picture']; ?></h3>
									<article><p class="inPageSubTitle text-center mb-30"><?php echo $lang['Uploading your profile picture give you 10 time more response']; ?>.</p></article>
								</div>
								<div class="gt-profile-pic-panel inPhotoUpload pb-30">
							  		<div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
										<?php
											$PHOTO_UPLOAD_SECTION = $DatabaseCo->dbLink->query("SELECT profile_pic_skip FROM site_config WHERE id=1");
											$row_profile=mysqli_fetch_object($PHOTO_UPLOAD_SECTION);
											if($row_profile->profile_pic_skip == 'No'){
										?>
								   		<div class="row">
											<div class="col-xxl-3 col-xxl-offset-13">
												<a class="btn gt-btn-green btn-block" href="aadhaar_upload"> <?php echo $lang['Skip']; ?> <i class="fa fa-caret-right"></i></a>
											</div>
										</div>
										<?php } ?>
										<form class="" method="POST" action="" enctype="multipart/form-data">
											<div class="row">
												<div class="col-xxl-16 mt-15">
													<div class="form-group text-center">
														<p class=""><?php echo $lang['Click on']; ?> <b><?php echo $lang['Select Image']; ?></b> <?php echo $lang['and then']; ?> <b><?php echo $lang['UPLOAD']; ?></b> <?php echo $lang['to upload image']; ?>.</p>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-xxl-8 col-xxl-offset-4 col-xl-8 col-xxl-offset-4 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5 mt-15">
													<center>
														<div class="thumbnail" style="max-height: 250px;width: 250px;">
															<img src="img/photo-default.png" class="img-responsive" id="photo1_prev" style="max-height: 250px;width: 250px;">
														</div>
													</center>
												</div>
											</div>
											<div class="row">
											   <div class="col-xxl-6 col-xl-16 col-xxl-offset-5 text-center">
													<div class="row">
														<input type="file" name="photo1" id="my_file" onchange="readURL(this);">
														<label for="my_file" class="btn btn-computer btn-block inIndexRegBtn">
															<?php echo $lang['Select Image']; ?>
														</label>
														<p class="mt-10"><?php echo $lang['After select image click on']; ?> <b><?php echo $lang['Upload & Continue']; ?></b> <?php echo $lang['button']; ?>.</p>
														<input type="submit" name="submit" value="<?php echo $lang['Upload & Continue']; ?>" class="btn gt-btn-green inIndexRegBtn btn-block inPhotoUploadBtn mt-20">
													</div>
												</div>
											</div>
										</form>
         							</div>
      							</div>
    						</div>
						</div>
                	</div>
            	</div>
        	</div>  
            <?php include "parts/footer.php"; ?>
        </div>
        	<!-- Jquery Js-->
			<script src="js/jquery.min.js"></script>
			<!-- Bootstrap & Green Js -->
			<script src="js/bootstrap.js"></script>
			<script src="js/green.js"></script>
			<script>
				$(document).ready(function() {
				  $('#body').show();
				  $('.preloader-wrapper').hide();
				});
			</script>

        	<!-- Validation js -->
			<script type="text/javascript" src="js/validetta.js"></script>

      		<!-- Thumbnail Display before image upload -->
			<script>
			  function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#photo1_prev').attr('src', e.target.result)
                    };
                    reader.readAsDataURL(input.files[0]);
				}
              }
			</script>
    </body>
</html>



