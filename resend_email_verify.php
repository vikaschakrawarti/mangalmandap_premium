<?php 
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$from=$configObj->getConfigFrom();
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();

if(isset($_REQUEST['resend_verification'])){
	$s = $DatabaseCo->dbLink->query("SELECT matri_id FROM register WHERE email='".$_POST['email']."'");

    if (mysqli_num_rows($s) == 0) {
         echo "<script>alert('Please enter your registerd email id.');</script>";
    }else{
		echo "<script>alert('Verification link sent successfully');</script>";
	}
                                                             
	$email = isset($_POST['email'])? $_POST['email']:"";
	$SQL_STATEMENT = $DatabaseCo->dbLink->query("SELECT * FROM register WHERE (email='".$email."' or matri_id='".$email."') AND status!='Suspended'");
	$result_count=mysqli_num_rows($SQL_STATEMENT);
	if($result_count == 1){
        $result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE (email='".$email."' or matri_id='".$email."')");
        $rowcc = mysqli_fetch_object($result3);
        $name = $rowcc->firstname;
        $matriid = $rowcc->matri_id;
        $cpass = $rowcc->cpassword;
        $website = $rowcc->web_name;
        $cpass = $rowcc->cpassword;
        $webfriendlyname = $rowcc->web_frienly_name;
        $from = $rowcc->from_email;
        $to = $rowcc->email;
        $email=$rowcc->email;
        $name1 = $rowcc->username;
        $logo = $rowcc->web_logo_path;
        $fb = $rowcc->facebook;
        $li= $rowcc->twitter;
        $tw = $rowcc->linkedin;
        $gp = $rowcc->google;
        $contact = $rowcc->contact_no;
        $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Registration'");
        $rowcs5 = mysqli_fetch_object($result45);
        $subject = $rowcs5->EMAIL_SUBJECT;
        $message = $rowcs5->EMAIL_CONTENT;
        $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
        $trans = array("your site name" =>$webfriendlyname,"name"=>$name1,"web logo"=>$logo,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"fb1"=>$fb,"li1"=>$li,"tw1"=>$tw,"gp1"=>$gp,"site domain name"=>$website,"my_email"=>$email);
        $email_template = strtr($email_template, $trans);
        include ('phpmailer/phpmailer.php');
        $mail->Subject = $subject;
        $mail->addAddress($email);
        $mail->Body= $email_template;
        if($mail->send()){
            $_SESSION['cnt']['status'] = 'succses';
            $_SESSION['cnt']['msg'] = 'Mail sucssesfully send.';
        }else{
            $_SESSION['cnt']['status'] = 'danger';
            $_SESSION['cnt']['msg'] = 'something went wrong.';
        }
    }
}		
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

    </head>
    <body>
		<!-- Loader -->
		<div class="preloader-wrapper text-center">
			<div class="loader"></div>
			<h5>Loading...</h5>
		</div>
		<!-- /.Loader -->
        <div id="body" style="display:none">
            <div id="wrap" class="gtLogin">
                <div id="main">
					<!-- Header & Menu -->
					<?php include "parts/header.php"; ?>
					<?php include "parts/menu.php"; ?>
					<!-- /. Header & Menu -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-6 col-xs-16 col-xl-6 col-xs-offset-0 col-xxl-offset-5 col-sm-offset-0 col-md-offset-0 col-xl-offset-5 col-lg-10 col-lg-offset-3 ">
                                <form class="gt-login-form" action="" method="post" id="login_form">
                                    <h2 class="inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Please verify your Email ID']; ?> .</h2>
                                    <h5 class="inPageSubTitle text-center mb-30"><?php echo $lang['We are always happy to help']; ?>.</h5>
                                    <div class="gt-margin-top-30 form-group">
                                        <label><?php echo $lang['Enter your email id or user id']; ?></label>
                                        <input type="text" class="gt-form-control" name="email" data-validetta="required" placeholder="<?php echo $lang['Enter Email ID or User Id']; ?>">
                                    </div>
                                    <div class="form-group gt-margin-top-30">
                                        <input type="submit" name="resend_verification" class="btn gt-btn-orange btn-block" name="<?php echo $lang['Submit']; ?>">
                                    </div>
                                    <input type="hidden" name="val_of_resend" value="<?php if(isset($_POST['resend_verification']) && $_POST['resend_verification']!=''){ echo $_POST['resend_verification'];}?>">
                                </form>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>  
            <?php include "parts/footer.php"; ?>
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
			<!-- Responsive Tab js -->
			<!-- Validation js -->
			<script type="text/javascript" src="js/validetta.js"></script>
			<script>
				$(function(){
					$('#login_form').validetta({
						errorClose : false,
						realTime : true
					});
				});
			</script>
        </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
