<?php
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();

   if(isset($_REQUEST['basicupdate'])){
	   	$interest_setting=$_POST['interest_setting'];
	   	$profile_view_setting=$_POST['profile_view_setting'];
	   	$username_setting=$_POST['username_setting'];
	   	$profile_verification=$_POST['profile_verification'];
	   	$birthyear=$_POST['birthyear'];
	   	$male_legal_age=$_POST['male_legal_age'];
	   	$female_legal_age=$_POST['female_legal_age'];
	    $success_marriage_year=$_POST['success_marriage_year'];
   		$weight_first=$_POST['weight_first'];
	    $weight_last=$_POST['weight_last'];
	    $profile_pic_skip=$_POST['profile_pic_skip'];
	    $aadhaar_pic_skip=$_POST['aadhaar_pic_skip'];
       
	    $DatabaseCo->dbLink->query("UPDATE site_config SET interest_setting='$interest_setting',profile_view_setting='$profile_view_setting',username_setting='$username_setting',profile_verification='$profile_verification',birthyear='$birthyear',female_legal_age='$female_legal_age',male_legal_age='$male_legal_age',success_marriage_year='$success_marriage_year',weight_first='$weight_first',weight_last='$weight_last',profile_pic_skip='$profile_pic_skip',aadhaar_pic_skip='$aadhaar_pic_skip' WHERE id='1'");
       
   		$msg="Record is updated successfully.";
   }
   $sql=$DatabaseCo->dbLink->query("SELECT profile_view_setting,interest_setting,username_setting,profile_verification,birthyear,male_legal_age,female_legal_age,success_marriage_year,weight_first,weight_last,profile_pic_skip,aadhaar_pic_skip from site_config WHERE id='1'");
   $data=mysqli_fetch_object($sql);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Basic Site Config</title>
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
               		<h1 class="lightGrey">Site Configuration</h1>
               		<ol class="breadcrumb">
                  		<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  		<li class="active">Site Configuration</li>
               		</ol>
            	</section>
           		<section class="content">
               		<div class="row">
                  		<div class="box-body gtSiteChangeId">
                     		<div class="box box-success">
                        		<div class="box-body">
                           			<form method="post" name="basic_form" id="basic_form">
                              			<div class="row">
											<?php if(isset($msg)){ ?>
											<div class="col-xs-12">
												<div id="success_msg" class="alert alert-success">
													<i class="fa fa-check-circle fa-fw fa-lg"></i>
													Record is updated successfully.
												</div>
											</div>
											<?php } ?>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Express Interest Sent Setting</label>
													<select name="interest_setting" class="form-control">
														<option value="send_to_all" <?php if($data->interest_setting == 'send_to_all'){ echo 'selected'; } ?>>All Member Can Send</option>
														<option value="send_to_paid" <?php if($data->interest_setting == 'send_to_paid'){ echo 'selected'; } ?>>Only Paid Member Can Send</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Profile View Setting</label>
													<select name="profile_view_setting" class="form-control">
														<option value="visible_to_all" <?php if($data->profile_view_setting == 'visible_to_all'){ echo 'selected'; } ?>>All Member View</option>
														<option value="visible_to_paid" <?php if($data->profile_view_setting == 'visible_to_paid'){ echo 'selected'; } ?>>Only Paid Member View</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Username Setting</label>
													<select name="username_setting" class="form-control">
														<option value="full_username" <?php if($data->username_setting == 'full_username'){ echo 'selected'; } ?>>Show full username</option>
														<option value="first_surname" <?php if($data->username_setting == 'first_surname'){ echo 'selected'; } ?>>Show firstname and lastname first letter</option>
														<option value="hide_username" <?php if($data->username_setting == 'hide_username'){ echo 'selected'; } ?>>Hide username</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Profile Activation Method Setting</label>
													<select name="profile_verification" class="form-control">
														<option value="auto_approve" <?php if($data->profile_verification == 'auto_approve'){ echo 'selected'; } ?>>User can activate profile via email verification link</option>
														<option value="manual_approve" <?php if($data->profile_verification == 'manual_approve'){ echo 'selected'; } ?>>Approve Profile Only Via Admin</option>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Profile Pic Optional (Signup)</label>
													<select name="profile_pic_skip" class="form-control">
														<option value="Yes" <?php if($data->profile_pic_skip == 'Yes'){ echo 'selected'; } ?>>Yes</option>
														<option value="No" <?php if($data->profile_pic_skip == 'No'){ echo 'selected'; } ?>>No</option>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-xs-12">
												<div class="form-group">
													<label>Document Upload Optional (Signup)</label>
													<select name="aadhaar_pic_skip" class="form-control">
														<option value="Yes" <?php if($data->aadhaar_pic_skip == 'Yes'){ echo 'selected'; } ?>>Yes</option>
														<option value="No" <?php if($data->aadhaar_pic_skip == 'No'){ echo 'selected'; } ?>>No</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Weight Start From</label>
															<input type="text" name="weight_first" placeholder="Enter Weight Start From" class="form-control" value="<?php if(isset($data->weight_first)){ if($data->weight_first != ''){ echo $data->weight_first; }} ?>" data-validetta="number,required">
														</div>
														<div class="col-md-6">
															<label>Weight To</label>
															<input type="text" name="weight_last" placeholder="Enter Weight To" class="form-control" value="<?php if(isset($data->weight_last)){ if($data->weight_last != ''){ echo $data->weight_last; }} ?>" data-validetta="number,required">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
                                                    <div class="row">
														<div class="col-md-6">
															<label>Last Birth Year</label>
															<input type="text" class="form-control" placeholder="Enter Last Birth Year (Only integer)" data-validetta="required,number" maxlength="4" name="birthyear" value="<?php  if(isset($data->birthyear)){ if($data->birthyear != ''){ echo $data->birthyear; }} ?>" data-validetta="number,required">
														</div>
														<div class="col-md-6">
															<label>Success Story Last Year Option</label>
															<input type="text" class="form-control" placeholder="Enter Success Story Last Year Option" data-validetta="required,number" maxlength="4" name="success_marriage_year" value="<?php  if(isset($data->success_marriage_year)){ if($data->success_marriage_year != ''){ echo $data->success_marriage_year; }} ?>" data-validetta="number,required">
														</div>
													</div>
                                                </div>
											</div>
											<div class="col-md-6 col-xs-12">
												<div class="form-group">
                                                    <div class="row">
														<div class="col-md-6">
															<label>Male Legal Age (In Years)</label>
															<input type="text" class="form-control" placeholder="Enter Male Legal Age" data-validetta="required,number" maxlength="2" name="male_legal_age" value="<?php  if(isset($data->male_legal_age)){ if($data->male_legal_age != ''){ echo $data->male_legal_age; }} ?>" data-validetta="number,required">
														</div>
														<div class="col-md-6">
															<label>Female Legal Age (In Years)</label>
															<input type="text" class="form-control" placeholder="Enter Female Legal Age" data-validetta="required,number" maxlength="2" name="female_legal_age" value="<?php  if(isset($data->female_legal_age)){ if($data->female_legal_age != ''){ echo $data->female_legal_age; }} ?>" data-validetta="number,required">
														</div>
													</div>
												</div>
											</div>
											
											
											<div class="col-xs-12 text-center siteLogo mt-15">
												<div class="form-group">
													<input type="submit" name="basicupdate" class="btn btnThemeG3 mr-10" value="Submit">
													<input type="reset"  class="btn btnThemeR3" value="Cancel">
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
			 setPageContext("site-settings","sitebasicconfig");
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
				$('#basic_form').validetta({
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