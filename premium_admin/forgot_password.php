<?php	
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$salt='%^&$#@*!';
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	$STATUS_MESSAGE = "";
	if($isPostBack){
		$email=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['forgotlogid']);	
		$res=$DatabaseCo->dbLink->query("SELECT * FROM admin_users WHERE email='$email' AND status='1'");
		$row=mysqli_fetch_object($res);
		if(mysqli_num_rows($res) > 0){
			$email=$row->email;
			$uname=$row->uname;
			$passwd=rand(111111,999999);
			$upasswd=md5($salt.$passwd);
			$sql=$DatabaseCo->dbLink->query("UPDATE admin_users SET pswd='$upasswd' WHERE email='$email'");
			$from = $configObj->getConfigFrom();
			include ('phpmailer/phpmailer.php');
			$mail->addAddress($email);
			$mail->Subject = 'Your New Password';
			$ToSubject = "Your Matrimonial Password";
	    	$message =  "<html>
						<head>
							<title>Your Password Has Been Changed.</title>
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
															<td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>Change password request</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
								<td style='float:left;width:710px;min-height:auto'>
									<h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
									<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
										Your password for admin panel has been changed.
									</p>
									<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
										<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
											Dear, Admin <br/>
											Username is : $uname <br/>
											New Password is : $passwd <br/>                                    
										</b>
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
					if($mail->send()){
				?>
						<script>alert('New password sent on your email id.');</script>
						<script>window.location='index';</script>
				<?php }else{ ?>
						<script>alert('Problem in password reset.');</script>
						<script>window.location='forgot_password';</script>
				<?php 
					  }			
			}else{
				$STATUS_MESSAGE= "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i>
				Provided email id is wrong, Please enter correct email id.</p>";	
		}	
	}
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Dashboard | Forgot Password</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />

		<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>

		<!-- Theme css -->
		<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

		<!--GOOGLE FONTS-->
		<?php include('page-part/google_fonts.php');?>

		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		
		<!-- Validation css -->
		<link href="../css/validate.css" rel="stylesheet" type="text/css" />
	</head>
  	<body class="login-page">
    	<div class="login-box">
      		<div class="login-box-body">
      			<div class="login-logo">
        			<a href="index"><b class="font600">Forgot</b> Password</a>
					<p class="login-box-msg">Enter Admin Email Id.</p>
      			</div>
				<form action="" method="post" id="login_form">
 					<div class="form-group">
						<input name="forgotlogid" type="text" class="form-control" placeholder="Enter admin email id" data-validetta="email,required"/>
					</div>
					<div class="row">
                		<div class="col-xs-12 mt-15">
                			<button type="submit" class="btn btn-block btnThemeG1">Submit</button>
               	 		</div>
						<div class="col-xs-12 mt-15">
                			<a href="index" class="btn btn-block btnThemeR1">Back To Login</a>
               	 		</div>
					</div>
        		</form>
				<br>
	   		</div>
    	</div>
    
    	<!-- Jquery  -->
    	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
		<!-- Bootstrap Js -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  
    	<!--Validation Js -->
    	<script src="../js/validetta.js" type="text/javascript"></script>
    	<script type="text/javascript">
    		$(function(){
    			$('#login_form').validetta({
    				errorClose : false,
    				realTime : true
    			});
    		});
    	</script>
	</body>
</html>