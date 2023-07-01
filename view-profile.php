<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
include 'auth.php';
$sel_own_data = $DatabaseCo->dbLink->query("SELECT photo1,photo2,photo3,photo4,photo5,photo6,photo1_approve,photo2_approve,photo3_approve,photo4_approve,photo5_approve,photo6_approve,gender,username FROM register_view WHERE matri_id='$mid'");
$get_own_data = mysqli_fetch_object($sel_own_data);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry,weight,body_type,complexion,physical_status,additional_degree,annual_income,diet,smoke,drink,dosh,star,rasi,birthtime,birthplace,family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister,profile_text,part_expect FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
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
		
		 <!-- Owl Carousel CSS -->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
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
							<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 mb-20 text-center">
            					<h2 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['My Profile']; ?></h2>
                				<p class="inPageSubTitle"><?php echo $lang['This is your all profile detail which you added.You can view your all details and also can edit all your detail from here']; ?>.</p>
            				</div>
                            <div class="col-xxl-16 col-xs-16 gt-margin-bottom-20">
                                <div class="alert alert-warning" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                    <article>
                                        <?php echo $lang['Edit your profile details is very easy just click on the left pencil button']; ?> ( <i class="fas fa-pen-square gt-margin-left-5 gt-margin-right-5 font-18"></i> ) <?php echo $lang['and here we go. You can edit your profile detail']; ?>
                                    </article>
                                </div>
                            </div>
                        </div>	
                    </div>
					<div class="container gt-view-profile">
                        <div class="row">
                            <div class="col-xxl-3 col-xl-4 col-xs-16 col-sm-16">  
                                <div class="thumbnail gt-margin-bottom-0">
                                    <?php if ($get_own_data->photo1 != '' && file_exists('my_photos/' . $get_own_data->photo1)) { ?>
										<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo1; ?>&watermark=watermark.png" class="img-responsive">
                                    <?php } else { ?>  
									    <img src="img/<?php echo strtolower($_SESSION['gender123']) . ".jpg"; ?>" title="<?php echo $get_own_data->username; ?>" alt="<?php echo $mid; ?>" class="img-responsive">               	
									<?php } ?>
                                    <a href="my-photo" class="gt-view-caption">
                                        <?php echo $lang['Edit Profile Picture']; ?>
                                    </a>
                                </div>
								<?php if($get_own_data->photo1 != '' && file_exists('my_photos/' . $get_own_data->photo1) && $get_own_data->photo1_approve == 'APPROVED') { ?>
								<a href="#morePhotos" class="btn gt-btn-green btn-block mb-20 pt-10 pb-10" data-toggle="modal"><?php echo $lang['View More Photos']; ?></a>
								<?php } ?>
								<!-- Modal more photos -->
								<div class="modal fade" id="morePhotos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										  	<div class="modal-body">
												<div class="row">
													<div class="col-xs-16">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-16 col-xxl-10 col-xxl-offset-3">
														<div id="viewMorePhotos" class="owl-carousel gtImageUpload">
															<?php if ($get_own_data->photo1 != '' && file_exists('my_photos/' . $get_own_data->photo1)) { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo1; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?>  
															<?php if ($get_own_data->photo2 != '' && file_exists('my_photos/' . $get_own_data->photo2 ) && $get_own_data->photo2_approve == 'APPROVED') { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo2; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?>
															<?php if ($get_own_data->photo3 != '' && file_exists('my_photos/' . $get_own_data->photo3) && $get_own_data->photo3_approve == 'APPROVED') { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo3; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?>
															<?php if ($get_own_data->photo4 != '' && file_exists('my_photos/' . $get_own_data->photo4 ) && $get_own_data->photo4_approve == 'APPROVED') { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo4; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?>
															<?php if ($get_own_data->photo5 != '' && file_exists('my_photos/' . $get_own_data->photo5 ) && $get_own_data->photo5_approve == 'APPROVED') { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo5; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?>
															<?php if ($get_own_data->photo6 != '' && file_exists('my_photos/' . $get_own_data->photo6 ) && $get_own_data->photo6_approve == 'APPROVED') { ?>
															<div class="item">
																<a href="">
																	<img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo6; ?>&watermark=watermark.png" class="img-responsive">
																</a>	
															</div>
															<?php }?> 
														</div>
													</div>
												</div>
										  	</div>
									  		<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close']; ?></button>
									  		</div>
										</div>
								  	</div>
								</div>
								<!-- ./ Modal more photos -->
								<!-- Left Panel Mobile Only -->
                            	<a class="btn gt-btn-orange btn-block gt-margin-bottom-15 gt-margin-top-15 visible-xs visible-sm visible-md visible-lg" role="button" data-toggle="collapse" href="#collapseLeftPanel" aria-expanded="false" aria-controls="collapseLeftPanel">
									Options &nbsp;&nbsp;<i class="fa fa-angle-down"></i>
					   			</a>
                            	<div class="collapse gt-padding-bottom-15" id="collapseLeftPanel">
                            		<div class="col-xxl-16 col-xl-16">
                                		<div class="gt-left-opt-msg">
                                    		<ul>
                                        		<li><a href="sentMessages"><i class="fas fa-paper-plane gt-margin-right-10"></i><?php echo $lang['Send Message']; ?></a></li>
                                        		<li><a href="my-photo"><i class="fas fa-image gt-margin-right-10"></i><?php echo $lang['View Photos']; ?></a></li>
                                    		</ul>
                                		</div>
										<div class="gt-left-opt-msg">
											<ul>
												<li>
													<a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['MESSAGES']; ?></a>
												</li>
												<li>
													<a href="inboxMessages"><span class="pull-left"><?php echo $lang['Inbox']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE to_id='" . $_SESSION['user_id']."' AND msg_status='sent' AND trash_receiver='No'")); ?></span></a>
												</li>
												<li>
													<a href="sentMessages"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE from_id='" . $_SESSION['user_id']."' AND msg_status='sent' AND trash_sender='No'")); ?></span></a>
												</li>
											</ul>
										</div>
										<div class="gt-left-opt-msg">
											<ul>
												<li>
													<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-star gt-margin-right-10"></i><?php echo $lang['INTEREST']; ?></a>
												</li>
												<li>
													<a href="exp-interest"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender AND ei_receiver='$mid' AND trash_receiver='No' ")); ?></span></a>
												</li>
												<li>
													<a href="exp-interest"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver AND ei_sender='$mid' AND trash_sender='No' ")); ?></span></a>
												</li>
											</ul>
										</div>
										<div class="gt-left-opt-msg">
											<ul>
												<li>
													<a class="gt-bg-orange text-center gt-text-white"><i class="fas fa-picture gt-margin-right-10"></i><?php echo $lang['PHOTO REQUEST']; ?></a>
												</li>
												<li>
													<a href="photo-request"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id AND ph_requester_id='$mid' AND receiver_response='Pending'")); ?></span></a>
												</li>
												<li>
													<a href="photo-request"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id AND ph_receiver_id='$mid' AND receiver_response='Pending'")); ?></span></a>
												</li>
											</ul>
										</div>
                                		<div class="clearfix"></div>
                                		<?php include "parts/level-1.php"; ?>
                            		</div>
								</div>
								<!-- /. Left Panel Mobile Only -->
							</div>
                            <div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16">
                            	<!-- Basic Details -->
                                <div class="gt-panel gt-panel-default inViewProfile" id="edit1"></div>
                                <!-- /. Basic Details -->
                            </div>
                        </div>
                    </div>
					
                    <div class="container gt-view-profile">
                    	<div class="row">
							<!-- Left Panel Desktop Only -->
                        	<div class="col-xxl-3 col-xl-4 hidden-xs hidden-sm hidden-md hidden-lg">
                            	<div class="gt-left-opt-msg">
                               		<ul>
                                    	<li>
                                            <a href="sentMessages"><i class="fas fa-paper-plane gt-margin-right-10"></i><?php echo $lang['Send Message']; ?></a>
                                        </li>
                                        <li>
                                            <a href="my-photo"><i class="fas fa-image gt-margin-right-10"></i><?php echo $lang['View Photos']; ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gt-left-opt-msg">
                                    <ul>
                                        <li>
                                            <a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['MESSAGES']; ?></a>
                                        </li>
                                        <li>
                                            <a href="inboxMessages"><span class="pull-left"><?php echo $lang['Inbox']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE to_id='".$_SESSION['user_id']."' AND msg_status='sent' AND trash_receiver='No'")); ?></span></a>
                                        </li>
                                        <li>
                                            <a href="sentMessages"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE from_id='".$_SESSION['user_id']."' AND msg_status='sent' AND trash_sender='No'")); ?></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gt-left-opt-msg">
                                    <ul>
                                        <li>
                                            <a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['INTEREST']; ?></a>
                                        </li>
                                        <li>
                                            <a href="exp-interest"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender AND ei_receiver='$mid' AND trash_receiver='No' ")); ?></span></a>
                                        </li>
                                        <li>
                                            <a href="exp-interest"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver AND ei_sender='$mid' AND trash_sender='No' ")); ?></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gt-left-opt-msg">
                                    <ul>
                                        <li>
                                            <a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['PHOTO REQUEST']; ?></a>
                                        </li>
                                        <li>
                                            <a href="photo-request"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id AND ph_requester_id='$mid' AND receiver_response='Pending'")); ?></span></a>
                                        </li>
                                        <li>
                                            <a href="photo-request"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id AND ph_receiver_id='$mid' AND receiver_response='Pending'")); ?></span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                                <?php include "parts/level-1.php"; ?>
                            </div>
							<!-- /. Left Panel Desktop Only -->
						
                            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2" style="position: fixed; left: 43%; top: 20%; z-index: -1; opacity: 0;" id="loaderID">
                                <div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange">
                                    <font class="gt-margin-left-5">Loading ...&nbsp;&nbsp;</font>
                                </div>
                            </div>

                            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5" style="position: fixed; left: 43%; top: 20%; z-index: -1; opacity: 0;" id="edit_success">
                                <div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16 btn gt-btn-green">
                                    <font class="gt-margin-left-5"><?php echo $lang['']; ?>Your Profile Edit Successfully.&nbsp;&nbsp;</font>
                                </div>
                            </div>
                            <div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16">
								<?php if($row_field->profile_text == 'Yes'){ ?>
                                <div class="gt-panel gt-panel-default" id="edit2"></div>
								<?php } ?>
                                <div class="gt-panel gt-panel-default" id="edit3"></div>
                                <div class="gt-panel gt-panel-default" id="edit4"></div>
								<?php if($row_field->family_status == 'Yes' || $row_field->family_type == 'Yes' || $row_field->family_value == 'Yes' || $row_field->father_occupation == 'Yes' || $row_field->mother_occupation == 'Yes' || $row_field->no_of_brother == 'Yes' || $row_field->no_of_married_brother == 'Yes' || $row_field->no_of_sister == 'Yes' || $row_field->no_of_married_sister == 'Yes'){ ?>
                                <div class="gt-panel gt-panel-default" id="edit5"></div>
								<?php } ?>
                                <div class="gt-panel gt-panel-default" id="edit6"></div>
								<?php if($row_field->diet == 'Yes' || $row_field->drink == 'Yes' || $row_field->smoke == 'Yes'){ ?>
                                <div class="gt-panel gt-panel-default" id="edit7"></div>
								<?php } ?>
                                <div class="gt-panel gt-panel-default" id="edit9"></div>
								<?php if($row_field->dosh == 'Yes' || $row_field->star == 'Yes' || $row_field->rasi == 'Yes' || $row_field->birthtime == 'Yes' || $row_field->birthplace == 'Yes'){ ?>
								<div class="gt-panel gt-panel-default" id="edit10"></div>
								<?php } ?>
                                <div class="col-xs-16">
                                    <div class="row">
                                        <h4 class="text-center gt-bg-green pt-15 pb-15 inViewProSection">
                                            <i class="fa fa-heart gt-margin-right-10"></i><?php echo $lang['Partner Preference']; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="gt-panel gt-panel-default" id="editpref1"></div>
                                <div class="gt-panel gt-panel-default" id="editpref2"></div>
                                <div class="gt-panel gt-panel-default" id="editpref3"></div>
                                <div class="gt-panel gt-panel-default" id="editpref4"></div>
								<?php if($row_field->part_expect == 'Yes'){ ?>
                                <div class="gt-panel gt-panel-default" id="editpref5"></div>
								<?php } ?>
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
            <!-- Owl Carousel -->
        	<script src="js/owl.carousel.min.js"></script>    
		 	<script>
                $(document).ready(function() {
                    $("#viewMorePhotos").owlCarousel({
                        autoPlay: false,
                        items: 1,
						pagination:false,
                        navigation: true,
                        navigationText: ["PREV", "NEXT"],
                        itemsDesktop: [1199, 1],
                        itemsDesktopSmall: [979, 1]
                    });
                });
            </script>
            <!-- Chosen  js -->
            <script src="js/chosen.jquery.js" type="text/javascript"></script>
			<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
 				var config = {
        			'.chosen-select': {},
        			'.chosen-select-deselect': {allow_single_deselect: true},
        			'.chosen-select-no-single': {disable_search_threshold: 10},
        			'.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        			'.chosen-select-width': {width: "100%"}
    			}
    			for (var selector in config) {
        			$(selector).chosen(config[selector]);
   	 			}			
			</script>
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
			<!-- View & Edit Panel Ajax -->
        	<script>
				$(document).ready(function(e){
					view1('view');
					view2('view');
					view3('view');
					view4('view');
					view5('view');
					view6('view');
					view7('view');
					view8('view');
					view9('view');
					view10('view');
					part_view_1('view');
					part_view_2('view');
					part_view_3('view');
					part_view_4('view');
					part_view_5('view');
				});
				function edit1() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-1",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit1').html('');
								$('#edit1').append(response);
							}else{
								edit1();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit1();
						}
					});
				}
				function view1(status) {
					if (status == 'edit'){
						var edit = $('#reg_edit_1').serialize();
					}else{
						var edit = '';
					}
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-view-1",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit1').html('');
								$('#edit1').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view1(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view1(status);
						}
					});
				}

				function edit2() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-2",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit2').html('');
								$('#edit2').append(response);
							}else{
								edit2();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit2();
						}
					});
				}

				function view2(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_ptext').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-2",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit2').html('');
								$('#edit2').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view2(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view2(status);
						}
					});
				}
				function edit3() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-3",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit3').html('');
								$('#edit3').append(response);
							}else{
								edit3();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit3();
						}
					});
				}
				function view3(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_3').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-3",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit3').html('');
								$('#edit3').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view3(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view3(status);
						}
					});
				}
				function edit4() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-4",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit4').html('');
								$('#edit4').append(response);
							}else{
								edit4();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit4();
						}
					});
				}
				function view4(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_4').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-4",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit4').html('');
								$('#edit4').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view4(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view4(status);
						}
					});
				}
				function edit5() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-5",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit5').html('');
								$('#edit5').append(response);
							}else{
								edit5();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit5();
						}
					});
				}
				function view5(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_5').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-5",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit5').html('');
								$('#edit5').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view5(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view5(status);
						}
					});
				}
				function edit6() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-6",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit6').html('');
								$('#edit6').append(response);
							}else{
								edit6();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit6();
						}
					});
				}
				function view6(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_6').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-6",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit6').html('');
								$('#edit6').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view6(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view6(status);
						}
					});
				}

				function edit7() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-7",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit7').html('');
								$('#edit7').append(response);
							}else{
								edit7();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit7();
						}
					});
				}
				function view7(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_7').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-7",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit7').html('');
								$('#edit7').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view7(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view7(status);
						}
					});
				}
				function edit8() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-8",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit8').html('');
								$('#edit8').append(response);
							}else{
								edit8();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit8();
						}
					});
				}
				function view8(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_8').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-8",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit8').html('');
								$('#edit8').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view8(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view8(status);
						}
					});
				}
				function edit9() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-9",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit9').html('');
								$('#edit9').append(response);
							}else{
								edit9();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit9();
						}
					});
				}
				function view9(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_9').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-9",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit9').html('');
								$('#edit9').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view9(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view9(status);
						}
					});
				}
				function edit10() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-10",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#edit10').html('');
								$('#edit10').append(response);
							}else{
								edit10();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							edit10();
						}
					});
				}
				function view10(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#reg_edit_10').serialize();
					}else{
						var edit = '';
					}

					$.ajax({
						url: "parts/edit/my-view-10",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#edit10').html('');
								$('#edit10').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								view10(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							view10(status);
						}
					});
				}
				function part_edit_1() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-pref-1",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#editpref1').html('');
								$('#editpref1').append(response);
							}else{
								part_edit_1();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_edit_1();
						}
					});
				}

				function part_view_1(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#part_edit1').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-1",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref1').html('');
								$('#editpref1').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_1(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_1(status);
						}
					});
				}
				function part_edit_2() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-pref-2",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#editpref2').html('');
								$('#editpref2').append(response);
							}else{
								part_edit_2();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_edit_2();
						}
					});
				}
				function part_view_2(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#part_edit_2').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-2",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref2').html('');
								$('#editpref2').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_2(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_2(status);
						}
					});
				}

				function part_edit_3() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-pref-3",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#editpref3').html('');
								$('#editpref3').append(response);
							}else{
								part_edit_3();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_edit_3();
						}
					});
				}
				function part_view_3(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#part_edit3').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-3",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref3').html('');
								$('#editpref3').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);
									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_3(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_3(status);
						}
					});
				}
				function part_edit_4() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-pref-4",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#editpref4').html('');
								$('#editpref4').append(response);
							}else{
								part_edit_4();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_edit_4();
						}
					});
				}

				function part_view_4(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#part_edit4').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-4",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref4').html('');
								$('#editpref4').append(response);

								if (status == 'edit')
								{
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);

									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_4(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_4(status);
						}
					});
				}
				function part_edit_5() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$.ajax({
						url: "parts/edit/my-edit-pref-5",
						type: "POST",
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$("#edit_success").css("opacity", 0);
								$("#edit_success").css("z-index", -1);
								$('#editpref5').html('');
								$('#editpref5').append(response);
							}else{
								part_edit_5();
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_edit_5();
						}
					});
				}
				function part_view_4(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);

					if (status == 'edit'){
						var edit = $('#part_edit4').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-4",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref4').html('');
								$('#editpref4').append(response);

								if (status == 'edit')
								{
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);

									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_4(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_4(status);
						}
					});
				}
				function part_view_5(status) {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					if (status == 'edit'){
						var edit = $('#part_edit5').serialize();
					}else{
						var edit = '';
					}
					$.ajax({
						url: "parts/edit/my-view-pref-5",
						type: "POST",
						data: edit,
						cache: false,
						success: function(response, textStatus, xhr){
							if (xhr.status == '200'){
								$("#loaderID").css("opacity", 0);
								$("#loaderID").css("z-index", -1);
								$('#editpref5').html('');
								$('#editpref5').append(response);
								if (status == 'edit'){
									$("#edit_success").css("opacity", 1);
									$("#edit_success").css("z-index", 9999);

									setTimeout(function() {
										$("#edit_success").css("opacity", 0);
										$("#edit_success").css("z-index", -1);
									}, 3000);
								}
							}else{
								part_view_5(status);
							}
						},
						error: function(XMLHttpRequest, textStatus, xhr) {
							part_view_5(status);
						}
					});
				}
			</script>
        	
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  
