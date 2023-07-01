<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

if (isset($_POST['image'])) {
    $image_name = substr($_POST['image_name'], -14);
    $img = $_POST['image']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    file_put_contents('my_photos/' . $image_name, $data);
    $DatabaseCo->dbLink->query("update register set photo1='" . $image_name . "',photo1_approve='UNAPPROVED' where matri_id='" . $_SESSION['reg_user_id'] . "'");
}
if (!isset($_SESSION['reg_email'])){
	//header('Location:index.php');
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

        <!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
        
        <!-- Time Picker -->
        <link rel="stylesheet" href="css/jquery.timepicker.css"> 
    
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

                    <!-- Register -->
                    <div id="register"></div>
                    <!-- /. Register -->
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
			<!-- Chosen Js -->
			<script src="js/chosen.jquery.js" type="text/javascript"></script>
			<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
				var config = {
				'.chosen-select'           : {},
				'.chosen-select-deselect'  : {allow_single_deselect:true},
				'.chosen-select-no-single' : {disable_search_threshold:10},
				'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
				'.chosen-select-width'     : {width:"100%"}
				}
				for (var selector in config) {
					$(selector).chosen(config[selector]);
				}
			</script>
			<!-- Validation js -->
			<script type="text/javascript" src="js/validetta.js"></script>
			<!-- Time Picker js -->
        	<script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
			<!-- Signup 1 -->
        	<script>
            	$(document).ready(function(e) {
                	$("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="fas fa-spinner fa-spin" style="font-size:40px;"></i></div><h4>Please Wait Loading...</h4></div>');
					var dataString = 'nickname=<?php
						if (isset($_POST['nickname'])) {
							echo $_POST['nickname'];
						}
						?>&email=<?php
						if (isset($_POST['email'])) {
							echo $_POST['email'];
						}
						?>&education=<?php
						if (isset($_POST['education'])) {
							echo $_POST['education'];
						}
						?>&gender=<?php
						if (isset($_POST['gender'])) {
							echo $_POST['gender'];
						}
						?>&occupation=<?php
						if (isset($_POST['occupation'])) {
							echo $_POST['occupation'];
						}
						?>&religion=<?php
						if (isset($_POST['religion'])) {
							echo $_POST['religion'];
						}
						?>&caste=<?php
						if (isset($_POST['caste'])) {
							echo $_POST['caste'];
						}
						?>';
						$.ajax({
							type: "POST",
							url: "web-services/register/reg-1",
							data: dataString,
							cache: false,
							success: function(data) {
								$("#register").html('');
								$("#register").html(data);
								reg_form_validation();
								reg1getdata();
							}
						});
						<?php if (isset($_POST['religion']) && $_POST['religion'] != '') { ?>
                    		$("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
							var id = $(this).val();
							var dataString = 'religionId=<?php echo $_POST['religion']; ?>&caste=<?php
							if (isset($_POST['caste'])) {
								echo $_POST['caste'];
							}
							?>';
							$.ajax({
								type: "POST",
								url: "ajax_search2",
								data: dataString,
								cache: false,
								success: function(html) {
									$("#caste").html(html);
									$("#caste1").html('');
								}
							});
						<?php } ?>
				
            			});
        			</script>
        			<!-- Signup Validation -->
        			<script type="text/javascript">
						function reg_form_validation() {
							$('.selector').chosen({search_contains: true});
							$(function() {
								$('#register_form').validetta({
									errorClose: false,
									onValid: function(event) {
										event.preventDefault();
										var dataString = $('#register_form').serialize();

										$("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

										$.ajax({
											type: "POST",
											url: "web-services/register/reg-2",
											data: dataString,
											cache: false,
											success: function(data) {
												$("#register").html('');
												$("#register").html(data);
												reg_form2_validation();
												reg2getdata();
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
											}
										});
									},
									onError : function( event ){

										var errorDiv = $('.validetta-error:visible').first();
										$('html, body').animate({
											scrollTop: errorDiv.offset().top
										}, 2000);
									  },
									realTime: true
								});
							});
						}
						function reg_form2_validation() {
							$(function() {
								/*$('.selector').chosen({search_contains: true});
								$('#reg_form_2').validetta({
									errorClose: false,
									onValid: function(event) {
										event.preventDefault();
										var dataString = $('#reg_form_2').serialize();
										$("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

										$.ajax({
											type: "POST",
											url: "register-photo-upload",
											data: dataString,
											cache: false,
											success: function(data) {
												$("#register").html('');
												$("#register").html(data);
												reg_form3_validation();
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
											}
										});
									},
									onError : function( event ){
										var errorDiv = $('.validetta-error:visible').first();
										$('html, body').animate({
											scrollTop: errorDiv.offset().top
										}, 2000);
									  },
									realTime: true
								});*/
							});
							/*$('#skip3').on('click', function() {
								$.ajax({
									type: "POST",
									url: "web-services/register/reg-4",
									data: "",
									cache: false,
									success: function(data) {
										$("#register").html('');
										$("#register").html(data);
									}
								});
							});*/
						}
						function reg_form3_validation() {
							$(function() {
								/*$('#reg_form_3').validetta({
									errorClose: false,
									onValid: function(event) {
										event.preventDefault(); // Will prevent the submission of the form
										var dataString = $('#reg_form_3').serialize();

										$("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

										$.ajax({
											type: "POST",
											url: "web-services/register/reg-4",
											data: dataString,
											cache: false,
											success: function(data) {
												$("#register").html('');
												$("#register").html(data);
											}
										});
									},
									onError : function( event ){

										var errorDiv = $('.validetta-error:visible').first();
										$('html, body').animate({
											scrollTop: errorDiv.offset().top
										}, 2000);
									  },
									realTime: true,

								});*/
							});
						}
        			</script>
					<!-- Signup 1 Ajax Data Load -->
        			<script type="text/javascript">
						function reg1getdata() {
							$("#country").change(function() {
								$("#status1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
								var id = $(this).val();
								var dataString = 'id=' + id;

								$.ajax({
									type: "POST",
									url: "ajax_country_state",
									data: dataString,
									cache: false,
									success: function(html) {
										$("#state").html(html);
										$("#status1").html('');
										$("#state").trigger("chosen:updated");
									}
								});
							});
							$("#state").on('change', function() {
								$("#status2").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
								var id = $(this).val();
								var cnt_id = $("#country").val();
								var dataString = 'state_id=' + id + '&country_id=' + cnt_id;

								$.ajax({
									type: "POST",
									url: "ajax_country_state",
									data: dataString,

									success: function(html) {

										$("#city").html(html);
										$("#status2").html('');
										$("#city").trigger("chosen:updated");
									}
								});
							});
							$("#religion").on('change', function() {
								$("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
								var id = $(this).val();
								var dataString = 'religionId=' + id;
								$.ajax({
									type: "POST",
									url: "ajax_search2",
									data: dataString,
									cache: false,
									success: function(html) {
										$("#caste").html(html);
										$("#caste1").html('');
										$("#caste").trigger("chosen:updated");
									}
								});
							});
							
						}
					</script>
					<!-- Signup 2 Ajax Data Load -->
					<script type="text/javascript">
						function reg2getdata() {
							$("#pcountry").on('change', function() {
								$("#pstate_div").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
								var id = $(this).val();
								var dataString = 'state=' + id;
								$.ajax({
									type: "POST",
									url: "search_state",
									data: dataString,
									cache: false,
									success: function(html) {

										$("#pstate").find('option').remove().end().append(html);
										$('#pstate').trigger('chosen:updated');
										$("#pstate_div").html('');

									}
								});
							});
							$("#pstate").on('change', function() {
								$("#pcity_div").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');

								var id = $(this).val();
								var cnt_id = $("#pcountry").val();
								var dataString = 'state_id=' + id + '&country_id=' + cnt_id;

								$.ajax({
									type: "POST",
									url: "search_city",
									data: dataString,
									cache: false,
									success: function(html)
									{
										$("#pcity").find('option').remove().end().append(html);
										$('#pcity').trigger('chosen:updated');
										$("#pcity_div").html('');
									}
								});

							});
							$("#preligion").on('change', function() {
								$("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
								var id = $(this).val();
								var dataString = 'religionId=' + id;
								$.ajax({
									type: "POST",
									url: "part_rel_caste",
									data: dataString,
									cache: false,
									success: function(html) {
										$("#pcaste").html(html);
										$("#pcaste").trigger("chosen:updated");
										$("#caste1").html('');
									}
								});
							});
							$("#from_age").on('change', function() {
								$("#Loadtoage").html('<div>Loading...</div>');
								var id = $(this).val();
								var dataString = 'id=' + id;
								$.ajax({
									type: "POST",
									url: "ajax-to-age-data",
									data: dataString,
									cache: false,
									success: function(html) {
										$("#part_to_age").html(html);
										$("#Loadtoage").html('');
								   }
								});
							});
							$("#from_height").on('change', function() {
								$("#Loadtoheight").html('<div>Loading...</div>');
								var height_id = $(this).val();
								var dataString = 'height_id=' + height_id;
								$.ajax({
									type: "POST",
									url: "ajax-to-height-data",
									data: dataString,
									cache: false,
									success: function(html) {
										$("#part_to_height").html(html);
										$("#Loadtoheight").html('');
									}
								});
							});
            			}
		 			</script>
   	 	</body>
	</html>

