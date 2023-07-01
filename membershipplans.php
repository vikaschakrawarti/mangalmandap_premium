<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
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
						<h2 class="text-center inPageTitle fontMerriWeather"><?php echo $lang['Membership Plans']; ?></h2>
                		<p class="inPageSubTitle text-center mb-20"><?php echo $lang['Select from our multiple membership plan and find your best life partner with membership benefits']; ?>.</p>
    					<div class="row">
        					<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16">
        						<div class="row mb-20">
                					<?php 
										$sel_plan = $DatabaseCo->dbLink->query("SELECT * FROM `membership_plan` WHERE `status`='APPROVED' ORDER BY plan_id ASC");
										while($get_plan = mysqli_fetch_object($sel_plan)){
									?>
                       				<label for="gt-plan-<?php echo $get_plan->plan_id;?>" class="col-xxl-4 col-xl-4 col-xs-16 col-lg-8" >
                    					<div class="gt-plan" id="setselected<?php echo $get_plan->plan_id;?>">
                    						<div class="gt-plan-header">
                                				<h1><i class="fa fa-certificate"></i></h1>
                            					<h4>
                                                	<input type="radio" id="gt-plan-<?php echo $get_plan->plan_id;?>" name="plan" onChange="getselected('<?php echo $get_plan->plan_id;?>');" class="Table_Details inDisplayNone">
                                                    <span id="planname<?php echo $get_plan->plan_id;?>">
														<?php echo $get_plan->plan_name;?>
                                                    </span>
                               	    			</h4>
                                    			<div class="gt-plan-price">
                                					<h4 id="planamount<?php echo $get_plan->plan_id;?>">
                                						<?php echo $get_plan->plan_amount_type.' '.$get_plan->plan_amount;?>
                                					</h4>
                                    			</div>
                        					</div>
											<div class="clearfix"></div>
                       						<!-- Plan display for mobile -->
                       						<a class="btn btn-primary gtMobPlan visible-xs visible-sm visible-md" role="button" data-toggle="collapse" href="#collapsePlan<?php echo $get_plan->plan_id;?>" aria-expanded="false" aria-controls="collapsePlan<?php echo $get_plan->plan_id;?>">
  												<?php echo $lang['View Plan Detail']; ?>
												<div class="clearfix"></div>
												<i class="fa fa-chevron-down"></i>
											</a>
                       						<div class="collapse" id="collapsePlan<?php echo $get_plan->plan_id;?>">
  												<div class="well">
    												<div class="gt-plan-body">
                                						<ul class="gt-plan-desc">
															<li>
																<h3><?php echo $lang['Duration']; ?></h3>
																<h5 id="planduration<?php echo $get_plan->plan_id;?>">
																	<?php echo $get_plan->plan_duration;?> Days
																</h5>
															</li>
															<li>
																<h3><?php echo $lang['Messages']; ?></h3>
																<h5>
																	<?php echo $get_plan->plan_msg;?>  
																</h5>
															</li>
														
															<li>
																<h3><?php echo $lang['Contact Views']; ?></h3>
																<h5>
																	<?php echo $get_plan->plan_contacts;?>
																</h5>
															</li>
															<li>
																<h3><?php echo $lang['Live Chat']; ?></h3>
																<h5>
																	<?php echo $get_plan->chat;?>
																</h5>
															</li>
															<li>
																<h3><?php echo $lang['Profile Views']; ?></h3>
																<h5>
																	<?php echo $get_plan->profile;?>
																</h5>
															</li>
                                    					</ul>
                        							</div>
  												</div>
											</div>
                       						<!-- /. Plan display for mobile -->
											<!-- Plan for desktop -->
                        					<div class="gt-plan-body hidden-xs hidden-sm hidden-md">
                                				<ul class="gt-plan-desc">
                                    				<li>
                                        				<h3><?php echo $lang['Duration']; ?></h3>
                                            			<h5 id="planduration<?php echo $get_plan->plan_id;?>">
                                            				<?php echo $get_plan->plan_duration;?> Days
                                            			</h5>
                                        			</li>
                                        			<li>
                                        				<h3><?php echo $lang['Messages']; ?></h3>
                                        				<h5>
                                            				<?php echo $get_plan->plan_msg;?>  
                                            			</h5>
                                        			</li>
                                        			<li>
                                        				<h3><?php echo $lang['Contact Views']; ?></h3>
                                            			<h5>
                                            				<?php echo $get_plan->plan_contacts;?>
                                            			</h5>
                                        			</li>
                                        			<li>
                                        				<h3><?php echo $lang['Live Chat']; ?></h3>
                                            			<h5>
                                            				<?php echo $get_plan->chat;?>
                                            			</h5>
                                        			</li>
                                        			<li>
                                        				<h3><?php echo $lang['Profile Views']; ?></h3>
                                            			<h5>
                                            				<?php echo $get_plan->profile;?>
                                            			</h5>
                                        			</li>
                                    			</ul>
                        					</div>
                        					<div class="gt-plan-footer hidden-xs hidden-sm hidden-md">
												Select
                                			</div>
											<!-- /. Plan for desktop -->
                        				</div>
                   					</label>
                       				<?php } ?>
                    			    </div>
                    				<div class="row">
                    					<div class="col-xxl-16 col-xl-16 box">
                        					<div class="gt-panel inMembershipSelected" id="chkplan">
                            					<div class="gt-panel-head gt-bg-green"><?php echo $lang['You Have Selected']; ?></div>
                                				<div class="gt-panel-body">
                                					<div class="row">
                                    					<div class="col-xxl-5 col-xl-5 col-lg-4">
                                            				<h4><?php echo $lang['Plan Name']; ?></h4>
                                            				<h5 class="gt-text-orange" id="dis_plan_name">Bronze</h5>
                                            			</div>
                                        				<div class="col-xxl-5 col-xl-5 col-lg-4">
                                            				<h4><?php echo $lang['Duration']; ?></h4>
                                            				<h5 class="gt-text-orange" id="dis_plan_duaration">30 days</h5>
                                        				</div>
                                        				<div class="col-xxl-6 col-xl-6 col-lg-8">
                                            				<h4 class="gt-margin-top-30">
                                               					<?php echo $lang['Total  Amount']; ?>  :- 
                                                                    <span class="gt-margin-left-10 gt-text-green" id="dis_plan_amount">Rs.1000</span>
                                            				</h4>
                                        				</div>
                                    				</div>
                                    				<div class="row text-center">
                                       					<a href="" id="checkout" class="btn gt-btn-green gt-btn-md mt-15">
                                            				<i class="fas fa-shopping-cart gt-margin-right-10 font-12"></i><?php echo $lang['Checkout']; ?>
                                        				</a>
                                        			</div>
            										<div class="row text-right">
                                    					<div class="col-xs-16">
                                        					<p><?php echo $lang['Including all taxes']; ?> </p>
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
         	<script>
            	(function($) {
                	var $window = $(window),
                    $html = $('.mobile-collapse');
                	$window.width(function width() {
                    	if ($window.width() > 767) {
                        	return $html.addClass('in');
                    	}
                    	$html.removeClass('in');
                	});
            	})(jQuery);
        	</script> 
    	
			<!-- Plan selected bucket -->
			<script type="text/javascript">
				$(document).ready(function(e) {
					$('#chkplan').hide();
				});
				function getselected(planid){
					$('.gt-reco').removeClass('gt-reco');
					$('#setselected'+planid).addClass('gt-reco');
					$('#chkplan').show();
						var planname=$('#planname'+planid).html();
						var planduration=$('#planduration'+planid).html();
						var planamount=$('#planamount'+planid).html();
						var plantype=$('#plantype'+planid).html();
						$('#dis_plan_name').html('');
						$('#dis_plan_name').html(planname);
						$('#dis_plan_duaration').html('');
						$('#dis_plan_duaration').html(planduration);
						$('#dis_plan_amount').html('');
						$('#dis_plan_amount').html(planamount);
						$('#dis_plan_type').html('');
						$('#dis_plan_type').html(plantype);
						$('a#checkout').attr("href", 'paymentOptions.php?pid='+planid);
				}
			</script>
			<script>
				$('html, body').animate({scrollTop:$('.Table_Details').position().top}, 'slow');
				$(".Table_Details").click(function(){
					$('html, body').animate({scrollTop:$('.box').position().top}, 'slow');
				});
			</script>
 	 	</body>
	</html>                                                                                                                             
	<?php include 'thumbnailjs.php';?>                  