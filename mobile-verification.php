<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

/*-- index form data --*/
if (isset($_POST['chk_terms'])) {
    $_SESSION['reg_caste'] = $_POST['caste'];
    $_SESSION['reg_email'] = $_POST['email'];
    $_SESSION['reg_country'] = $_POST['country'];
    $_SESSION['reg_bday'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $_SESSION['reg_fnmae'] = htmlspecialchars($_POST['nickname'], ENT_QUOTES);
    $_SESSION['reg_lnmae'] = htmlspecialchars($_POST['lastname'], ENT_QUOTES);
    $_SESSION['reg_gender'] = $_POST['gender'];
    $_SESSION['reg_m_tongue'] = $_POST['m_tongue'];
    $_SESSION['reg_code'] = $_POST['code'];
    $_SESSION['reg_mobile'] = $_POST['mobile'];
    $_SESSION['reg_profile_by'] = $_POST['profile_by'];
    $_SESSION['reg_religion'] = $_POST['religion'];
	
	/*-- Legal age validation --*/
	$from = new DateTime($_SESSION['reg_bday']);
	$to   = new DateTime('today');
	$age=$from->diff($to)->y;
	
	$get_legal_age = $DatabaseCo->dbLink->query("SELECT male_legal_age,female_legal_age FROM site_config WHERE id='1'");
   	$row_legal_age = mysqli_fetch_object($get_legal_age);
	
	$male_age=$row_legal_age->male_legal_age;
	$female_age=$row_legal_age->female_legal_age;
	
	if($_SESSION['reg_gender'] == 'Male'){
		if($male_age >= $age){
			?>
			<script>alert('Your age is below <?php echo $male_age; ?> year or check your birthdate.');</script>
			<script>window.location='index';</script>
			<?php
		}
	}
	if($_SESSION['reg_gender'] == 'Female'){
		if($female_age >= $age){
			?>
			<script>alert('Your age is below <?php echo $female_age; ?> year or check your birthdate.');</script>
			<script>window.location='index';</script>
			<?php
		}
	}
	/*-- ./ Legal age validation --*/
    
	$SQL_STATEMENT = $DatabaseCo->dbLink->query("INSERT INTO first_form (gender,first_name,last_name,dob,mobile_no,mobile_code,email_id)VALUES('".$_SESSION['reg_gender']."','".$_SESSION['reg_fnmae']."','".$_SESSION['reg_lnmae']."','".$_SESSION['reg_bday']."','".$_SESSION['reg_mobile']."','".$_SESSION['reg_code']."','".$_SESSION['reg_email']."')");

    $s = "SELECT matri_id FROM register WHERE email='".$_SESSION['reg_email']."'";
    $rr = $DatabaseCo->dbLink->query($s);

    if (mysqli_num_rows($rr) > 0) {
        echo "<script>alert('Email id is already Exist.');window.location='login.php';</script>";
    }
    
    $checkMobile = $DatabaseCo->dbLink->query("SELECT matri_id FROM register WHERE mobile='".$_SESSION['reg_mobile']."'");
    if (mysqli_num_rows($checkMobile) > 0) {
        echo "<script>alert('Mobile no is already Exist.Please enter correct mobile no.');window.location='index.php';</script>";
    }
	
	$user = ucfirst($_POST['nickname']);
    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
	
    $text = "Hello $user, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno = $_POST['mobile'];
	$code = $_POST['code'];
	include 'mobile-apis.php';
    $ret = file($url);	
}
if(isset($_POST['change_mobile'])){
	$_SESSION['reg_mobile']=$_POST['change_mobile'];
	$SQL_STATEMENT = $DatabaseCo->dbLink->query("insert into first_form(id,gender,first_name,last_name,dob,mobile_no,email_id)values ('','".$_SESSION['reg_gender']."','".$_SESSION['reg_fnmae']."','".$_SESSION['reg_lnmae']."','".$_SESSION['reg_bday']."','".$_SESSION['reg_mobile']."','".$_SESSION['reg_email']."')");
	
	$user = ucfirst($_SESSION['reg_fnmae']);
    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
   	$_SESSION['order_id'] = $order_id;
	
    $text = "Hello $user, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno =$_SESSION['reg_mobile'];
	//$code = $_POST['code'];
	include 'mobile-apis.php';
    $ret = file($url);	
}
/*-- ./index form data --*/

/*-- verify OTP --*/
if (isset($_POST['verify_submit'])) {
    if ($_POST['varify_code'] == $_SESSION['order_id']) {
        ?>
        <?php
        print "<script>";
        print "self.location='register'";
        print "</script>";
    }else{
		$msg="<b style='color:red'>Please Enter Valid OTP</b>";
	}
}
/*-- ./ verify OTP --*/

/*-- Send OTP Again --*/
if (isset($_POST['sms'])) {
    $order_id = uniqid(rand(10, 1000), false);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
    $user = ucfirst($_SESSION['reg_fnmae']);
    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
	
    $text = "Hello $user, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno =$_SESSION['reg_mobile'];
	//$code = $_POST['code'];
	include 'mobile-apis.php';
    $ret = file($url);	
}
/*-- ./ Send OTP Again --*/

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
                  			<div class="text-center inThemeOrange">
                           	 	<i class="fas fa-mobile-alt"></i>
                        	</div>
							<h2 class="inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Mobile No Verfication']; ?></h2>
                			<p class="inPageSubTitle text-center mb-20"><?php echo $lang['Verify your mobile number now to activate your profile']; ?>.</p>
							<article class="text-center text-danger">
                            	<?php echo $lang['It is mandatory to verify your mobile number otherwise your profile will not be displayed to other members']; ?>.
                        	</article>
                        	<div class="gtSMSVerification col-xxl-10 col-xxl-offset-3">
								<h4><?php echo $lang['Verify mobile number through SMS']; ?></h4>
                            	<p class="font-12"><?php echo $lang['An SMS with verification PIN has been sent to']; ?> </p>
								<h5 class="gtMobileNo"><?php echo $_SESSION['reg_code']; ?>-<?php echo $_SESSION['reg_mobile']; ?></h5>
								<div class="col-xxl-16">
									<a href="#myModal" data-toggle="modal" class="btn gt-btn-orange gt-margin-top-5"><?php echo $lang['Edit Mobile No']; ?></a>
								</div>
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
                                        	<div class="col-xs-16 font-12"><?php echo $lang['Not received verification code yet?']; ?> <span id="countVerify"></span><b>s</b></div>
											<div class="col-xs-16">
												<input type="submit" name="sms" class="btn gt-btn-orange mt-10" value="<?php echo $lang['Send OTP Again']; ?>" id="btnCounterVerify" disabled>
											</div>
                                    	</div>
                                    	<div class="clearfix"></div>
                                		<div class="col-xs-16 mt-15">
                                			<a href="register"><?php echo $lang['Skip mobile verification']; ?> <i class="fa fa-caret-right"></i></a>
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



