<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	if(isset($_POST['change'])){
		$menu_search=$_POST['menu_search'];
		$menu_success=$_POST['menu_success'];
		$menu_membership=$_POST['menu_membership'];
		$menu_contact=$_POST['menu_contact'];
		$menu_login=$_POST['menu_login'];
		$menu_signup=$_POST['menu_signup'];
		
		$footer_contact=$_POST['footer_contact'];
		$footer_faq=$_POST['footer_faq'];
		$footer_refund=$_POST['footer_refund'];
		$footer_terms=$_POST['footer_terms'];
		$footer_policy=$_POST['footer_policy'];
		$footer_report=$_POST['footer_report'];
		$footer_login=$_POST['footer_login'];
		$footer_register=$_POST['footer_register'];
		$footer_membership=$_POST['footer_membership'];
		$footer_success=$_POST['footer_success'];
		$footer_about=$_POST['footer_about'];
		$footer_about_short=$_POST['footer_about_short'];
	
		
		$DatabaseCo->dbLink->query("UPDATE menu_settings SET menu_search='$menu_search',menu_success='$menu_success',menu_membership='$menu_membership',menu_contact='$menu_contact',menu_login='$menu_login',menu_signup='$menu_signup',footer_contact='$footer_contact',footer_faq='$footer_faq',footer_refund='$footer_refund',footer_terms='$footer_terms',footer_policy='$footer_policy',footer_report='$footer_report',footer_login='$footer_login',footer_register='$footer_register',footer_membership='$footer_membership',footer_success='$footer_success',footer_about='$footer_about',footer_about_short='$footer_about_short' WHERE menu_id='1' ");
		$msg="Record is updated successfully.";
	}
	$MENU_SETTINGS_QUERY=$DatabaseCo->dbLink->query("SELECT * FROM menu_settings WHERE menu_id='1'");
	$row=mysqli_fetch_object($MENU_SETTINGS_QUERY);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Enable / Disable Header & Footer Menu</title>
    	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		
   		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
		
    	<!-- Ionicons -->
    	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   		
		<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		
   		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		
		<!-- Post Validation CSS -->
    	<link href="css/postvalidationcss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validate.css">
	</head>	
	<body class="skin-blue">
 		<!-- Icon Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- /. Icon Loader-->
   		<div class="wrapper" style="display:none" id="body">
			<!-- Header & Menu -->
			<?php include "page-part/header.php"; ?> 
			<?php include "page-part/left_panel.php"; ?>
			<!-- /. Header & Menu -->
			<div class="content-wrapper">
				<section class="content-header">
					<h1 class="lightGrey">Menu Item Enable / Disable</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"> Menu Item Enable / Disable</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="box-body">
							<div class="box box-success">
								<div class="box-body gtSiteChangeId">
									<form method="post" name="changemenu" id="changemenu">
										<div class="row">
										<?php if(isset($msg)){ ?>
											<div class="col-xs-12">
												<div id="success_msg" class="alert alert-success">
													<i class="fa fa-check-circle fa-fw fa-lg"></i>Record is updated successfully.
												</div>
                                			</div>
										<?php } ?>
										<div class="col-xs-12 mb-15">
											<h2 class="titleTheme1 mb-20 themeColorRed ">Header Menu</h2>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Search :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_search">
                                                            <option value="APPROVED" <?php if(isset($row->menu_search)){ if($row->menu_search == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_search)){ if($row->menu_search == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Success :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_success">
                                                            <option value="APPROVED" <?php if(isset($row->menu_success)){ if($row->menu_success == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_success)){ if($row->menu_success == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Membership :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_membership">
                                                            <option value="APPROVED" <?php if(isset($row->menu_membership)){ if($row->menu_membership == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_membership)){ if($row->menu_membership == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Contact :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_contact">
                                                            <option value="APPROVED" <?php if(isset($row->menu_contact)){ if($row->menu_contact == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_contact)){ if($row->menu_contact == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Login :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_login">
                                                            <option value="APPROVED" <?php if(isset($row->menu_login)){ if($row->menu_login == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_login)){ if($row->menu_login == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Menu Signup :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="menu_signup">
                                                            <option value="APPROVED" <?php if(isset($row->menu_signup)){ if($row->menu_signup == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->menu_signup)){ if($row->menu_signup == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-xs-12 mb-15">
											<h2 class="titleTheme1 mb-20 themeColorRed ">Footer Menu</h2>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Contact :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_contact">
                                                            <option value="APPROVED" <?php if(isset($row->footer_contact)){ if($row->footer_contact == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_contact)){ if($row->footer_contact == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Faq :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_faq">
                                                            <option value="APPROVED" <?php if(isset($row->footer_faq)){ if($row->footer_faq == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_faq)){ if($row->footer_faq == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Refund :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_refund">
                                                            <option value="APPROVED" <?php if(isset($row->footer_refund)){ if($row->footer_refund == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_refund)){ if($row->footer_refund == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Terms :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_terms">
                                                            <option value="APPROVED" <?php if(isset($row->footer_terms)){ if($row->footer_terms == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_terms)){ if($row->footer_terms == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Policy :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_policy">
                                                            <option value="APPROVED" <?php if(isset($row->footer_policy)){ if($row->footer_policy == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_policy)){ if($row->footer_policy == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Report :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_report">
                                                            <option value="APPROVED" <?php if(isset($row->footer_report)){ if($row->footer_report == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_report)){ if($row->footer_report == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Login :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_login">
                                                            <option value="APPROVED" <?php if(isset($row->footer_login)){ if($row->footer_login == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_login)){ if($row->footer_login == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Register :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_register">
                                                            <option value="APPROVED" <?php if(isset($row->footer_register)){ if($row->footer_register == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_register)){ if($row->footer_register == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Membership :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_membership">
                                                            <option value="APPROVED" <?php if(isset($row->footer_membership)){ if($row->footer_membership == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_membership)){ if($row->footer_membership == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer Success :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_success">
                                                            <option value="APPROVED" <?php if(isset($row->footer_success)){ if($row->footer_success == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_success)){ if($row->footer_success == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer About :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_about">
                                                            <option value="APPROVED" <?php if(isset($row->footer_about)){ if($row->footer_about == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_about)){ if($row->footer_about== 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
								            </div>
										</div>
										<div class="col-md-6 col-xs-12 mb-10">
											<div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Footer About Short :</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="footer_about_short">
                                                            <option value="APPROVED" <?php if(isset($row->footer_about_short)){ if($row->footer_about_short == 'APPROVED'){ echo 'selected'; }}?>>APPROVED</option>
                                                            <option value="UNAPPROVED" <?php if(isset($row->footer_about_short)){ if($row->footer_about_short == 'UNAPPROVED'){ echo 'selected'; }}?>>UNAPPROVED</option>
                                                        </select>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="col-xs-12 text-center siteLogo mt-15">
											<div class="form-group">
												<input type="submit" class="btn btnThemeG3 mr-10" value="Submit" name="change"/>
												<input type="reset" class="btn btnThemeR3" value="Cancel"/>
											</div>
										</div>
									</div>
								</form> 
 								</div>
							</div>
						</div>
          			</div>
				</section>
			</div>
			<?php include "page-part/footer.php"; ?>
		</div>
		
		<!-- jQuery -->
		<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
		<!-- jQuery UI -->
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
		
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
		   		$('#body').show();
		   		$('.preloader-wrapper').hide();
		   	});
	   	</script>	
    	
		<!--jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			setPageContext("site-settings","sitemenu");
		</script>
		
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
    	<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
		
		<!-- Validetta -->
		<script src="../js/validetta.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				$('#changemenu').validetta({
					errorClose : false,
					realTime : true
				});
    		});
		</script>
	
    	<!-- Success Msg Alert -->
		<script>
			$(document).ready(function(e) {
				if($('#success_msg').html()!=''){
					setTimeout(function() {
						$("#success_msg").css("opacity",0);
						 $("#success_msg").html('');
					},4000);	
				}
			});
		</script>
	</body>
</html>