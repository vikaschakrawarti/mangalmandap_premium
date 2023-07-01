<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();

	$status = '';
	if ( isset($_POST['captcha']) && ($_POST['captcha']!="") ){
		// Validation: Checking entered captcha code with the generated captcha code
        if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
            // Note: the captcha code is compared case insensitively.
            // if you want case sensitive match, check above with strcmp()
            //$status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#FF0000;'>Entered captcha code does not match! Kindly try again.</span></p>";
            echo "<script>alert('Entered captcha code does not match! Kindly try again.')</script>";
            echo "<script>window.location='contactUs';</script>";
        }else{
            $name=$_POST['txt_name'];
            $to=$_POST['txt_email'];	  
            $mobile=$_POST['phone_no'];
            $subject1=$_POST['subject'];
            $description=$_POST['description'];
            $date = date('Y-m-d H:i:s');
            $SQL_CONTACT=$DatabaseCo->dbLink->query("INSERT INTO `contactus` (`name`, `email`, `mobile`, `subject`, `description`, `date`) VALUES ('".$name."','".$to."','".$mobile."','".$subject1."','".$description."','".$date."')");
            echo "<script>alert('Thank you for contact us. We will reach to you soon.')</script>";
            echo "<script>window.location='contactUs';</script>";
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
					<h2 class="text-center inPageTitle fontMerriWeather"><?php echo $lang['Contact Us']; ?></h2>
                	<p class="inPageSubTitle text-center mb-20"><?php echo $lang['Feel free to contact us you can ask your questions and query here']; ?>.</p>
    				<div class="row mt-30">
        				<div class="col-xxl-8 col-xl-8">
                			<div class="row">
                                <?php 
									$get_add1=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT cms_content,status FROM cms_pages WHERE cms_id='9'")); 
									if($get_add1->status == 'APPROVED'){	
								?>
        						<div class="col-xxl-16 col-xs-16 col-xl-16">
            						<div class="gt-panel inContactPanel">
                						<div class="gt-panel-border-orange">
                    						<h4 class="gt-panel-title"><?php echo $lang['Main Branch Address']; ?></h4>
                    					</div>
                						<div class="gt-panel-body">
                    						<div class="row">
                    							<div class="col-xxl-16">
                        							<?php 
														if(isset($get_add1)){
															echo htmlspecialchars_decode($get_add1->cms_content,ENT_QUOTES);	
														}
													?>
                        						</div>
                        					</div>
                    					</div>
                 					</div>
            					</div>
                                <?php } ?>
								<?php 
									$get_add12=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT cms_content,status FROM cms_pages WHERE cms_id='17'")); 
									if($get_add12->status == 'APPROVED'){	
								?>
           						<div class="col-xxl-16 col-xs-16 col-xl-16">
            						<div class="gt-panel inContactPanel">
                						<div class="gt-panel-border-green">
                    						<h4 class="gt-panel-title"><?php echo $lang['Sub Branch Address']; ?></h4>
                    					</div>
                						<div class="gt-panel-body">
                    						<div class="row">
                    							<div class="col-xxl-16">
                        						<?php 
													if(isset($get_add12)){
														echo htmlspecialchars_decode($get_add12->cms_content,ENT_QUOTES);	
													}	
												?>
                        						</div>
                        					</div>
                    					</div>
                 					</div>
           						</div>
								<?php } ?>
           					</div>
                		</div>
                		<div class="col-xxl-8 col-xl-8">
                			<div class="row">
								<div class="col-xs-16">
        							<div class="gt-panel inContactPanel">
										<div class="gt-panel-border-green">
											<h4 class="gt-panel-title"><?php echo $lang['Ask query or give us feedback']; ?></h4>
										</div>
										<div class="gt-panel-body">
											<div class="row">
												<div class="col-xxl-16">
													<form method="post" id="contactform" class="gt-search-opt">
														<div class="form-group">
															<label><?php echo $lang['Full Name']; ?></label>
															<input type="text" class="gt-form-control" name="txt_name" id="txt_name" placeholder="<?php echo $lang['Enter Your Full Name']; ?>" data-validetta="required">
														</div>
														<div class="form-group">
															<label><?php echo $lang['Email Id']; ?></label>
															<input type="email" class="gt-form-control" name="txt_email" id="txt_email" placeholder="<?php echo $lang['Enter Your Email Id Here']; ?>" data-validetta="email,required">
														</div>
														<div class="form-group">
															<label><?php echo $lang['Contact No']; ?></label>
															<input type="text" maxlength="10" class="gt-form-control" placeholder="<?php echo $lang['Enter Your Mobile No']; ?>" name="phone_no" id="phone_no" data-validetta="number,required">
														</div>
														<div class="form-group">
															<label><?php echo $lang['Subject']; ?></label>
															<input type="text" class="gt-form-control" name="subject" id="subject" placeholder="<?php echo $lang['Enter Your Subject Here']; ?>" data-validetta="required">
														</div>
														<div class="form-group">
															<label><?php echo $lang['Description']; ?></label>
															<textarea class="gt-form-control" rows="5" id="description" name="description" placeholder="<?php echo $lang['Enter Your Query Here']; ?>"></textarea>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-xl-8">
																	<label><?php echo $lang['Enter Captcha']; ?></label>
																	<input type="text" class="gt-form-control" name="captcha" placeholder="<?php echo $lang['Enter Captcha']; ?>" data-validetta="required">
																</div>
																<div class="col-xl-8">
																	<div class="mb-10">
																		<img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
																	</div>
																	<div>
																		<b><a href='javascript: refreshCaptcha();'><?php echo $lang['click here']; ?></a> <?php echo $lang['to refresh']; ?></p></b>
																	</div>
																	
																</div>
															</div>
															
														</div>
														<div class="form-group text-center">
															<button type="submit" name="sub_contact" id="contact-btn" class="btn gt-btn-green inIndexRegBtn">
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
         	<!-- Validation js -->
			<script type="text/javascript" src="js/validetta.js"></script>
			<script>
				$(function(){
					$('#contactform').validetta({
						errorClose : false,
						realTime : true
					});
				});
			</script>
			<script>
				//Refresh Captcha
				function refreshCaptcha(){
					var img = document.images['captcha_image'];
					img.src = img.src.substring(
				 0,img.src.lastIndexOf("?")
				 )+"?rand="+Math.random()*1000;
				}
			</script>
	</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  