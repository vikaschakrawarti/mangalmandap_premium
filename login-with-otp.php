<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

if(isset($_POST['userId'])){
    // Check mobile no is registered or not
    $userId=$_POST['userId'];
	$userIdCheck=$DatabaseCo->dbLink->query("SELECT matri_id,mobile,email,mobile_code FROM register WHERE (matri_id='$userId' OR mobile='$userId' OR email='$userId')");
	if(mysqli_num_rows($userIdCheck) == 1){
		$mobileQry=mysqli_fetch_object($userIdCheck);
	    $mobileNo=$mobileQry->mobile;
        $mobileCode=$mobileQry->mobile_code;
        
        //Set Mobile no and country code in session
        $_SESSION['mobile_se']=$mobileNo;
        $_SESSION['country_code_se']=$mobileCode;

        // Generate OTP
        $otp = rand(1000,9999);
        $otp = substr($otp, rand(0, strlen($otp) - 4), 4);
        $_SESSION['otp'] = $otp;
        $text = "Hello,Your OTP is $otp. Do not share your OTP with anyone.";
        $message = str_replace(" ", "%20", $text);
        
        $mno = $mobileNo;
        $code = $mobileCode;
        
        // Api url file
        include 'mobile-apis.php';
        $ret = file($url);	
       
	}else{
        echo "<script>alert('User no not found.Please enter valid user login id.')</script>";
        echo "<script>window.location='login.php';</script>";
        exit();
    }
}
if (isset($_POST['sms'])) {
    // Generate OTP
    $otp = rand(1000,9999);
    $otp = substr($otp, rand(0, strlen($otp) - 4), 4);
    $_SESSION['otp'] = $otp;
    $text = "Hello,Your OTP is $otp. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    
    $mno=$_SESSION['mobile_se'];
	$code = $_SESSION['country_code_se'];
    
	include 'mobile-apis.php';
    $ret = file($url);	
}
if (isset($_POST['verify_submit'])) {
    if ($_POST['varify_code'] == $_SESSION['otp']) {
        $username = isset($_SESSION['mobile_se']) ? $_SESSION['mobile_se'] : "";
        $SQL_STATEMENT1 = $DatabaseCo->dbLink->query("SELECT email,matri_id,username,gender,index_id,status FROM register WHERE mobile='".$username."' AND status!='Suspended'");
        if (mysqli_num_rows($SQL_STATEMENT1) > 0) {
            $sql = "UPDATE register set logged_in='1' WHERE mobile='".$username."'";
            $DatabaseCo->dbLink->query($sql);
        }
        $SQL_STATEMENT = $DatabaseCo->dbLink->query("SELECT email,matri_id,username,gender,index_id,status,last_login,photo1,photo2,photo3,photo4,photo5,photo6 FROM register WHERE mobile='".$username."' AND status!='Suspended'");
        
        if ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)) {
            if ($DatabaseCo->dbRow->status != 'Inactive') {
                session_regenerate_id();
                $_SESSION['login_time'] = date('Y-m-d h:i:s');
                $_SESSION['user_name'] = $DatabaseCo->dbRow->email;
                $_SESSION['user_id'] = $DatabaseCo->dbRow->matri_id;
                $_SESSION['uname'] = $DatabaseCo->dbRow->username;
                $_SESSION['gender123'] = $DatabaseCo->dbRow->gender;
                $_SESSION['uid'] = $DatabaseCo->dbRow->index_id;
                $_SESSION['email'] = $DatabaseCo->dbRow->email;
                $_SESSION['photo1'] = $DatabaseCo->dbRow->photo1;
                $_SESSION['photo2'] = $DatabaseCo->dbRow->photo2;
                $_SESSION['photo3'] = $DatabaseCo->dbRow->photo3;
                $_SESSION['photo4'] = $DatabaseCo->dbRow->photo4;
                $_SESSION['photo5'] = $DatabaseCo->dbRow->photo5;
                $_SESSION['photo6'] = $DatabaseCo->dbRow->photo6;
                $_SESSION['mem_status'] = $DatabaseCo->dbRow->status;
                $_SESSION['last_login'] = $DatabaseCo->dbRow->last_login;
                $email = $_SESSION['email'];
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $url = $_SERVER['HTTP_HOST'];
                $ip = $_SERVER['SERVER_ADDR'];
                if (isset($getdata) && $getdata != '') {
                        session_write_close();
                        echo "<script>window.location='paymentOptions.php'</script>";
                    } else {
                    session_write_close();
                        echo "<script>window.location='myHome'</script>";
                        exit();
                    }
            } else {
                echo "<script>alert('Please verifiy your profile by confirmation link.');</script>";
            } 
        }
    }else{ 
        echo "<script>alert('Please enter correct OTP');</script>";
        echo "<script>window.location='login-with-otp';</script>";
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
		
        <!-- Otp css -->
        <link href="css/bootstrap-pincode-input.css" rel="stylesheet">

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
                    	<div class="gtMobileVerification col-xxl-10 col-xxl-offset-3 col-xs-16 col-xs-offset-0">
                        	<div class="gtSMSVerification col-xxl-10 col-xxl-offset-3">
                                <h2 class="inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Login With OTP']; ?></h2>
                                <p class="inPageSubTitle text-center mb-20"><?php echo $lang['Enter OTP for login']; ?>.</p>
								<h5 class="gtMobileNo"><?php echo $_SESSION['country_code_se']; ?>-<?php echo $_SESSION['mobile_se']; ?></h5>
								<div class="clearfix"></div>
                            	<div class="form-group mt-30">
                               		<form action="" method="post">
										<div class="row">
											<div class="col-md-16 col-xs-16 mb-20">
												<input type="text" id="pincode-input1" class="gt-form-control otp-enter" name="varify_code" >
											   <!-- <input type="text"  placeholder="Enter Your OTP code here">-->
											</div>
											<div class="col-md-16 col-xs-16 text-center">
												<input type="submit" name="verify_submit" class="btn gt-btn-green btnVerify mt-10" value="<?php echo $lang['Verify']; ?>">
											</div>
											<div class="col-xs-16 mt-10">
												<?php 
													if (isset($_POST['verify_submit'])) {
														echo $msg; 
													}
												?>
											</div>
										</div>
                                	</form>
                            	</div>
                            	<div class="col-xs-16"> 
                                	<form action="" method="post">
                                    	<div class="row">
                                        	<div class="col-xs-16 font-12"><?php echo $lang['Not received OTP yet?']; ?> <span id="countVerify"></span><b>s</b></div>
											<div class="col-xs-16">
												<input type="submit" name="sms" class="btn gt-btn-orange mt-10" value="<?php echo $lang['Send OTP Again']; ?>" id="btnCounterVerify" disabled>
											</div>
                                    	</div>
                                    	<div class="clearfix"></div>
                                		<div class="col-xs-16 mt-15">
                                			<a href="login"><i class="fa fa-caret-left"></i> <?php echo $lang['Back To Login']; ?></a>
										</div>
                                	</form>
                             	</div>
                            	<div class="clearfix"></div>
                        	</div>
                    	</div>    
                	</div>
            	</div>
        	</div> 
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<form action="" method="post" class="inMobileVerifyChange gt-search-opt">
								<div class="row">
									<div class="col-xxl-16 text-center">
										<h4 class="fontMerriWeather"><?php echo $lang['Edit Mobile No']; ?></h4>
									</div>
									<div class="col-xxl-16 mt-20">
										<div class="form-group">
											<label><?php echo $lang['Mobile No']; ?></label>
											<input type="text" class="gt-form-control" name="change_mobile" placeholder="<?php echo $lang['Enter Mobile No']; ?>">
										</div>
									</div>
									<div class="col-xxl-16 text-center">
										<div class="form-group">
											<input type="submit" class="btn gt-btn-orange gt-margin-top-5" name="Submit" class="gt-form-control" value="<?php echo $lang['Submit']; ?>">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close']; ?></button>
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
        <!-- Responsive Tab js -->
        <!-- Otp js -->
        <script type="text/javascript" src="js/bootstrap-pincode-input.js"></script>
        <script>
            $(document).ready(function() {
                $('#pincode-input1').pincodeInput({hidedigits:false,complete:function(value, e, errorElement){
                    $("#pincode-callback").html("This is the 'complete' callback firing. Current value: " + value);
                }});  
            });
            window.onload = function() {
                $('#pincode-input1').pincodeInput().data('plugin_pincodeInput').focus();
            };
        </script>
        <!-- Timer js -->
        <script>
            // Get refreence to span and button
            var spn = document.getElementById("countVerify");
            var btn = document.getElementById("btnCounterVerify");

            var count = 10;     // Set count
            var timer = null;  // For referencing the timer

            (function countDown(){
              // Display counter and start counting down
              spn.textContent = count;

              // Run the function again every second if the count is not zero
              if(count !== 0){
                timer = setTimeout(countDown, 1000);
                count--; // decrease the timer
              } else {
                // Enable the button
                btn.removeAttribute("disabled");
              }
            }());
        </script>
    </body>
</html>



