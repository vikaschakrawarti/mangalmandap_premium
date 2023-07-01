<?php
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();
    $get_plan_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payments WHERE pmatri_id='".$_SESSION['user_id']."'"));
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
					<div class="container" >
						<div class="row">
							<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 text-center">
								<h2 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['Current Plan Details']; ?></h2>
								<p class="inPageSubTitle"><?php echo $lang['You can check your current membership plan detail and also recommanded plan suggestion with that']; ?>.</p>
							</div>
						</div>	
					</div>
					<div class="container gt-margin-top-20">
                    	<div class="row">
                        	<div class="col-xxl-16 col-xl-16 col-md-16 col-sm-16 col-lg-16">
                            	<div class="gt-panel gt-panel-default inCurrentPlan">
                                	<div class="gt-panel-head">
                                    	<div class="gt-panel-title">
                                        	<h4 class="gt-margin-bottom-0 gt-margin-top-0">
                                            	<span class="gt-text-orange"> 
                                                    <?php echo isset($get_plan_data->p_plan) ? $get_plan_data->p_plan : 'none'; ?>
                                                </span>
                                        	</h4>
                                    	</div>
                                	</div>
                                	<div class="gt-panel-body">
                                    	<div class="row">
                                        	<div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            	<h4 class="gt-text-orange"><?php echo $lang['Duration']; ?></h4>
                                            	<p class="gt-margin-bottom-5">
                                                    <b>
                                                        <?php echo isset($get_plan_data->plan_duration) ? $get_plan_data->plan_duration . ' Days' : 0; ?>
                                                    </b>
                                                </p>
                                            	<p>
                                                	<b class="text-danger">
                                                    <?php
                                                    	if (isset($get_plan_data->pactive_dt)) {
															$now = time(); // or your date as well
															$your_date = strtotime("$get_plan_data->pactive_dt");
															$datediff = $now - $your_date;
															$diff= $get_plan_data->plan_duration - floor($datediff / 86400);
															if($diff < 0){
																echo 0;
															}else{
																echo $diff;
															}
														} else {
                                                        	echo '0';
                                                    	}
                                                    ?> Days
                                                	</b>
                                            	</p>
                                        	</div>
                                        	<div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            	<h4 class="gt-text-orange"><?php echo $lang['Messages']; ?></h4>
												<p class="gt-margin-bottom-5">
                                                    <b>
                                                        <?php echo isset($get_plan_data->p_msg) ? $get_plan_data->p_msg : "none"; ?>
                                                    </b>
                                                </p>
												<p>
                                                    <b class="text-danger">
                                                        <?php echo (isset($get_plan_data->p_msg)) ? $get_plan_data->p_msg - $get_plan_data->r_msg . ' remaining' : 0; ?>
                                                    </b>
                                                </p>
                                        	</div>
                                        	<div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
												<h4 class="gt-text-orange"><?php echo $lang['Contact View']; ?></h4>
												<p class="gt-margin-bottom-5">
                                                    <b>
                                                        <?php echo isset($get_plan_data->p_no_contacts) ? $get_plan_data->p_no_contacts : 0; ?>
                                                    </b>
                                                </p>
                                            	<p>
													<b class="text-danger">
                                                    	<?php echo (isset($get_plan_data->p_no_contacts) && isset($get_plan_data->r_cnt)) ? $get_plan_data->p_no_contacts - $get_plan_data->r_cnt . " remaining" : 0; ?> 
                                                	</b>
                                            	</p>
                                        	</div>
											<div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
												<h4 class="gt-text-orange"><?php echo $lang['Live Chat']; ?></h4>
												<p class="gt-margin-bottom-5">
                                                    <b>
                                                        <?php echo isset($get_plan_data->chat) ? $get_plan_data->chat : 'No'; ?>
                                                    </b>
                                                </p>
												<p>
                                                    <b class="text-danger">
                                                        <?php echo isset($get_plan_data->chat) ? $get_plan_data->chat : 'No'; ?>
                                                    </b>
                                                </p>
											</div>
                                        	<div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
												<h4 class="gt-text-orange"><?php echo $lang['Profile View']; ?></h4>
                                            	<p class="gt-margin-bottom-5">
                                                    <b>
                                                        <?php echo isset($get_plan_data->profile) ? $get_plan_data->profile : 0; ?>
                                                    </b>
                                                </p>
												<p>
													<b class="text-danger">
														<?php echo (isset($get_plan_data->profile) && isset($get_plan_data->r_profile)) ? $get_plan_data->profile - $get_plan_data->r_profile . ' remaining' : 0; ?> 
													</b>
												</p>
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
	</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  