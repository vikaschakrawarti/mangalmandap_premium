<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();

	$SQL_STATEMENT_EMAIL = $DatabaseCo->dbLink->query("SELECT * FROM email_setting WHERE email_config_id='1'");
	$row=mysqli_fetch_object($SQL_STATEMENT_EMAIL);
	$host=$row->host;
	$email_from=$row->email;
	$password=$row->email_password;
	$port=$row->port;
	$email_name=$row->email_name;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'phpmailer/vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	
	$mail = new PHPMailer(true);
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
	$mail->isSMTP();
	$mail->SMTPAuth   = true;
	$mail->Host       = $host;
	$mail->Username   = $email_from;                     
    $mail->Password   = $password;  
    $mail->Port       = $port;                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    
	$mail->isHTML(true);
	if(isset($_POST['sub_contact'])){
		$name=trim(ucwords($_POST['txt_name']));
		$to=$_POST['txt_email'];	  
		$mobile=$_POST['phone_no'];
		$subject1=$_POST['subject'];
		$description=$_POST['description'];
		//$to =  $configObj->getConfigContact();
		$website=$configObj->getConfigName();
		$webfriendlyname=$configObj->getConfigFooter();
		//include ('phpmailer/phpmailer.php');
		$mail->addAddress($email_from);
		$mail->setFrom($email_from,$email_from);
    	$mail->addReplyTo($email_from,$email_from);
		$mail->Subject = 'Feedback';
		$message = "<html>
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

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                           
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                   	Name : ".$name.".<br/>
									Email ID : ".$to.".<br/>
									Contact No : ".$mobile.".<br/>
									Subject : ".$subject1.".<br/>
									Description : ".$description.".<br/>                                 
                                    </b></p>
                           
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'></p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";
	
			$mail->Body= $message;
			//$mail->send();
			if($mail->send()){
			$_SESSION['cnt']['status'] = 'succses';
			$_SESSION['cnt']['msg'] = 'Feedback sucssesfully send.';
			}else{
			$_SESSION['cnt']['status'] = 'danger';
			$_SESSION['cnt']['msg'] = 'something went wrong.';
			}
		echo "<script>alert('Thank you for feedback.')</script>";
		echo "<script>window.location='feedback';</script>";
	}
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      	<!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <meta name="theme-color" content="#549a11">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#549a11">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">  
    	<!-- WEB SITE TITLE DESCRIPTION-->
    	<title><?php echo $configObj->getConfigFname(); ?></title>
    	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    	<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    	<!-- WEB SITE TITLE DESCRIPTION END--> 
        
		<!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END-->
        
		<!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css?version=1" rel="stylesheet">
    	<link href="css/custom-responsive.css?version=1" rel="stylesheet">
    	<link href="css/custom.css?version=1" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
        
    		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    		<!--[if lt IE 9]>
      		<script src="js/html5shiv.min.js"></script>
      		<script src="js/respond.min.js"></script>
    		<![endif]-->
  </head>
  <body>
  	    <!-- ICON LOADER-->
    	<div class="preloader-wrapper text-center">
        	<div class="loader"></div>
        	<h5>Loading...</h5>
    	</div>
    	<!-- ICON LOADER END-->
    <div id="body" style="display:none">
  		<div id="wrap">
  			<div id="main">
    			<!-- HEADER -->
            	<?php include "parts/header.php"; ?>
            	<?php include "parts/menu-aft-login.php"; ?>
            	<!-- HEADER END-->
    			<div class="container">
                	
    				<div class="row gt-margin-top-20">
        				
                		<div class="col-xxl-8 col-xxl-offset-4  col-xl-8 col-xl-offset-4">
                			<div class="row">
								<div class="col-xs-16">
        						<div class="gt-panel">
                					<div class="gt-panel-border-green">
                    					<h2 class="text-center"><?php echo $lang['FEEDBACK / SUGGESTIONS']; ?></h2>
                						<p class="text-center"><?php echo $lang['Give us your valuable feedback to make website more user friendly']; ?>.</p>
                    				</div>
                					<div class="gt-panel-body">
                    					<div class="row">
                    						<div class="col-xxl-16">
                        						<form method="post" id="contactform">
                                        			<div class="form-group">
                                            			<label><?php echo $lang['Full Name']; ?></label>
                                                		<input type="text" class="gt-form-control" name="txt_name" id="txt_name" placeholder="<?php echo $lang['Enter Your Full Name']; ?>" required>
                                           			</div>
                                            		<div class="form-group">
                                            			<label><?php echo $lang['Email Id']; ?></label>
                                                		<input type="email" class="gt-form-control" name="txt_email" id="txt_email" placeholder="<?php echo $lang['Enter Your Email Id Here']; ?>" required>
                                            		</div>
                                            		<div class="form-group">
                                            			<label><?php echo $lang['Contact No']; ?></label>
                                                		<input type="number" required maxlength="10" class="gt-form-control" placeholder="<?php echo $lang['Enter Your Mobile No']; ?>" name="phone_no" id="phone_no">
                                            		</div>
                                            		<div class="form-group">
                                            			<label><?php echo $lang['Subject']; ?></label>
                                                		<input type="text" class="gt-form-control" name="subject" id="subject" placeholder="<?php echo $lang['Enter Your Subject Here']; ?>" required>
                                            		</div>
                                            		<div class="form-group">
														<label><?php echo $lang['Description']; ?></label>
                                                		<textarea required  class="gt-form-control" rows="5" id="description" name="description" placeholder="<?php echo $lang['Enter Your Query Here']; ?>"></textarea>
                                            		</div>
                                            		<div class="form-group text-center">
                                            			<button type="submit" name="sub_contact" id="contact-btn" class="btn gt-btn-green btn-lg">
                                                			<?php echo $lang['Submit']; ?>
                                                		</button>
                                            		</div>
                                                    <?php if(isset($_SESSION['cnt'])) { ?>
                                                    <div class="alert alert-<?=$_SESSION['cnt']['status'] ;?>">
                                                    	<?=$_SESSION['cnt']['msg'];?>
                                                    </div>
                                                    <?php unset($_SESSION['cnt']);} ?>
                                       		   </form>
                          				  </div>
                        			  </div>
                    			  </div>
                 			 	</div>
								</div>
							</div>
                		</div>
        			</div>
    			</div>
    		</div>
  		</div>
  		<?php include "parts/footer-before-login.php"; ?>
	</div>
    <!-- Jquery --->
    <script src="js/jquery.min.js"></script>
    <!--- Jquery END --->
    
    <!--- BOOTSTRAP AND GREEN JS--->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script> 
    <script> 
		$(document).ready(function() {
			$("#contact-btn").click(function(){
				$("#contactform").validate();
			});	
        });
    </script>
    <!--- BOOTSTRAP AND GREEN JS END--->
	<!--- LOADER JS--->
    <script> 
		$(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
        });
    </script>
    <!--- LOADER JS END --->  
    	
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  