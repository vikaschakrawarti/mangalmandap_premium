<?php 
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();

    $from=$configObj->getConfigFrom();
    $website =  $configObj->getConfigName();
    $webfriendlyname =  $configObj->getConfigFname();

    if(isset($_REQUEST['forgoten_sub'])){
        $s = "SELECT matri_id FROM register WHERE (email='".$email."' or matri_id='".$email."')";
        $rr = $DatabaseCo->dbLink->query($s);

        if (mysqli_num_rows($rr) == 0) {
             echo "<script>alert('Please enter your registerd email id.');</script>";
        }else{
            echo "<script>alert('Please check your email account for further process.');</script>";
        }
                                                             
        $email = isset($_POST['email'])? $_POST['email']:"";
        
        $SQL_STATEMENT = "SELECT matri_id,username,email,mobile,status FROM register WHERE (email='".$email."' or matri_id='".$email."') AND status!='Suspended'";
        $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
        $statusObj = handle_post_request("FORGET",$SQL_STATEMENT,$DatabaseCo);
        $STATUS_MESSAGE = $statusObj->getStatusMessage();
        
        if($statusObj->getActionSuccess()){
            $matri_id = $DatabaseCo->dbRow->matri_id; 
            $username = $DatabaseCo->dbRow->username;
            $mobile_fetch = $DatabaseCo->dbRow->mobile; 
            function RandomPassword() {
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                srand((double)microtime()*1000000);
                $i = 0;
                $pass = '' ;
                while ($i <= 5) {
                    $num = rand() % 33;
                    $tmp = substr($chars, $num, 1);
                    $pass = $pass . $tmp;
                    $i++;
                }
                return $pass;
            }
            $pswd = RandomPassword();
            $upasswd = md5($pswd);
            $sql = $DatabaseCo->dbLink->query("UPDATE register SET password='".$upasswd."' WHERE email='".$email."'");
            $text = "Hello $matri_id,Your new password is $pswd";
            $message = str_replace(" ", "%20", $text);
            $mno = $mobile_fetch;
            //$code = $_POST['code'];
            include 'mobile-apis.php';
            $ret = file($url_forgot);	
            include ('phpmailer/phpmailer.php');
            
            $mail->addAddress($email);
            $mail->Subject = 'Your new password';
            $message="
                <html>
                    <head>
                        <title><h1>Your new password</h1></title>
                    </head>
                    <body>
                        <table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                            <tbody>
                                <tr>
                                    <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>
                                        <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                                            <tbody>
                                                <tr style='background:#f9f9f9'>
                                                    <td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
                                                        <span tabindex='0' class='aBn' data-term='goog_849968294'>
                                                            <span class='aQJ'></span>
                                                        </span>
                                                    </td>
                                                    <td style='float:left;margin-top:30px;color:#048c2e;font-size:26px;padding-left:15px'>
                                                        $webfriendlyname
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                        <tr>
                                            <td style='float:left;width:710px;min-height:auto'>
                                                <h6 style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px'>Hello, $username</h6>
                                                <p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                                    Message : Your forgot password request has been received in our system.Given below is your profile login details,
                                                </p>
                                                <p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>Matri ID : $matri_id (or) 
                                                        <a style='text-decoration:none;color:#096b53;outline:none'>$email</a>
                                                    <br>New Password : $pswd </b>
                                                </p>
                                                <p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                                    Thank you for helping us reach you better,
                                                </p>
                                                <p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                                    Thanks & Regards ,<br>Team At $webfriendlyname
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </body>
                        </html>";
                        $mail->Body= $message;
                        // For most clients expecting the Priority header:
                        // 1 = High, 2 = Medium, 3 = Low
                        $mail->Priority = 1;
                        // MS Outlook custom header
                        // May set to "Urgent" or "Highest" rather than "High"
                        $mail->AddCustomHeader("X-MSMail-Priority: High");
                        // Not sure if Priority will also set the Importance header:
                        $mail->AddCustomHeader("Importance: High");
                        //$mail->send();
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
			<div id="wrap">
				<div id="main">
					<!-- Header & Menu -->
					<?php include "parts/header.php"; ?>
					<?php include "parts/menu.php"; ?>
					<!-- /. Header & Menu -->
                    
					<div class="container">
						<div class="row">
							<div class="col-xxl-6 col-xs-16 col-xl-6 col-xs-offset-0 col-xxl-offset-5 col-sm-offset-0 col-md-offset-0 col-xl-offset-5 col-lg-10 col-lg-offset-3 ">
								<form class="gt-login-form gtLogin" action="" method="post" id="forgot_form">
									<h2 class="inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Forgot Password ?']; ?></h2>
									<p class="inPageSubTitle text-center mb-30"><?php echo $lang['We are always happy to help']; ?>.</p>
									<div class="gt-margin-top-30 form-group">
										<label><?php echo $lang['Email id / Matri id']; ?></label>
										<input type="text" class="gt-form-control" name="email" placeholder="<?php echo $lang['Enter Email id / Matri id']; ?>" data-validetta="required">
									</div>
									<div class="form-group  gt-margin-top-30">
										<input type="submit" name="forgoten_sub" class="btn gt-btn-orange btn-block" value="<?php echo $lang['SUBMIT']; ?>">
									</div>
									<input type="hidden" name="val_of_forgot" value="<?php if(isset($_POST['forgot']) && $_POST['forgot']!=''){ echo $_POST['forgot'];} ?>">
								</form>
							</div>
						</div>	
					</div>
				</div>
			</div>
    		<?php include "parts/footer.php"; ?>
		</div> 
        
        <!-- Jquery Js -->
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
        
        <!-- Validation Js -->
        <script type="text/javascript" src="js/validetta.js"></script>
        <script>
            $(function(){
                $('#forgot_form').validetta({
                    errorClose : false,
                    realTime : true
                });
            });
        </script>
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
