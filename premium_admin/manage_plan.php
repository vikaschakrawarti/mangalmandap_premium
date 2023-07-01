<?php
include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

if(isset($_REQUEST['id'])){
	$plan_id=$_REQUEST['id'];	
	$data=$DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='$plan_id'");
	$row=mysqli_fetch_object($data);
	if(isset($_REQUEST['update_plan'])){
        
		$plan_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['id']);	
		$plan_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_name']);
		$plan_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_type']);
		$plan_amount = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_amount']);
		$plan_currency_type = 'Rs.';
		$plan_duration = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_duration']);
		$plan_contacts = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_contacts']);
		$profile  =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile']);
		$plan_msg = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_msg']);
		$chat =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['chat']);
		$plan_status =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_status']);
        
		$DatabaseCo->dbLink->query("UPDATE membership_plan SET plan_name='$plan_name',plan_type='$plan_type',plan_amount='$plan_amount',plan_amount_type='$plan_currency_type',plan_duration='$plan_duration',plan_contacts='$plan_contacts',profile='$profile',plan_msg='$plan_msg',chat='$chat',status='$plan_status' WHERE plan_id='$plan_id'");
        
		echo "<script>window.location='membership_plan?update_status=success';</script>";
	}else{
		$statusObj = new Status();
		$statusObj->setActionSuccess(false);
		$STATUS_MESSAGE = "Please select value to complete action.";	  
	}
}
if(isset($_POST['add_plan'])){
    
	$plan_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_name']);
	$plan_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_type']);
	$plan_amount = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_amount']);
	$plan_currency_type = 'Rs.';
	$plan_duration = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_duration']);
	$plan_contacts = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_contacts']);
	$profile  =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile']);
	$plan_msg =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_msg']);
	$chat =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['chat']);
	$plan_status =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_status']);
    
	$DatabaseCo->dbLink->query("INSERT INTO membership_plan (plan_name,plan_type,plan_amount,plan_amount_type,plan_duration,plan_contacts,profile,plan_msg,chat,status) VALUES ('$plan_name','$plan_type','$plan_amount','$plan_currency_type','$plan_duration','$plan_contacts','$profile','$plan_msg','$chat','$plan_status')");
    
	echo "<script>window.location='membership_plan?update_status=success';</script>";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<title>Admin | All Manage Plan </title>
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
		
		 <!-- Data table css -->
		<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/all_check.css" rel="stylesheet" type="text/css"/>  
		
		<!-- Confirm box Alert -->
		<script type="text/javascript" src="js/util/redirection.js"></script>
    	<link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
		
		<!-- Multiselect Css -->
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
		<link rel="stylesheet" href="../css/chosen.css">
    	<link rel="stylesheet" href="../css/prism.css">
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
					<h1 class="lightGrey">
						Manage Plan
					</h1>
					<ol class="breadcrumb">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i> Home
							</a>
						</li>
						<li class="active"> Manage Plan</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12 mb-15">
							<div class="box-top updateSite">
								<div class="row">
									<div class="col-md-3 col-sm-6">
										<a href="membership_plan" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-list hidden-xs"></i>All Membership Plan
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 mt-10">
							<div class="box box-success pt-20">
								<div class="row">
									<form name="manage_plan" id="manage_plan" method="post" class="gtNewMemPlan">
										<div class="box-body">
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label>Plan Name :</label>
													<input type="text" class="form-control" name="plan_name" data-validetta="required" value="<?php  if(isset($_REQUEST['id'])) { echo $row->plan_name; } ?>" placeholder="Enter Plan Name">
												</div>
												<div class="form-group">
													<label>Plan Type :</label>
													<select class="form-control" name="plan_type" data-validetta="required">
														<option value="">Select Plan Type</option>
														<option value="FREE"  <?php  if(isset($_REQUEST['id']) && $row->plan_type=='FREE' ) { echo "selected"; } ?>>Free</option>
														<option value="PAID" <?php  if(isset($_REQUEST['id']) && $row->plan_type=='PAID' ) { echo "selected"; } ?>>Paid</option>
													</select>
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label>Allow Messages :</label>
													<input type="text" class="form-control" name="plan_msg" data-validetta="number" value="<?php if(isset($_REQUEST['id'])) { echo $row->plan_msg; } ?>" placeholder="Numeric Only">
												</div>
												<div class="form-group">
													<label>Plan Amount :</label>
													<input type="text" class="form-control" name="plan_amount" data-validetta="number" value="<?php if(isset($_REQUEST['id'])) { echo $row->plan_amount; } ?>" placeholder="Numeric Only">
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label>Plan Duration :</label>
													<input type="text" class="form-control" name="plan_duration" data-validetta="number" value="<?php if(isset($_REQUEST['id'])) { echo $row->plan_duration; } ?>" placeholder="Numeric Only">
												</div>
												<div class="form-group">
													<label>Allow Contacts :</label>
													<input type="text" class="form-control" name="plan_contacts" data-validetta="number" value="<?php if(isset($_REQUEST['id'])) { echo $row->plan_contacts; } ?>" placeholder="Numeric Only">
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label>Allow Profile :</label>
													<input type="text" class="form-control" name="profile" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row->profile; } ?>" placeholder="Numeric Only">
												</div>
												<div class="form-group">
													<label>Chat :</label>
													<div class="radio">
														<input id="optionsRadios1" class="rel_status" type="radio" name="chat" value="Yes"  <?php  if(isset($_REQUEST['id']) && $row->chat=='Yes' ) { echo "checked"; } ?> data-validetta="required,minSelected[1]">
														<label for="optionsRadios1"> 
														<b>Yes</b> &nbsp;&nbsp;
														<input id="optionsRadios2" class="rel_status" type="radio" name="chat" value="No" <?php  if(isset($_REQUEST['id']) && $row->chat=='No' ) { echo "checked"; } ?> data-validetta="required,minSelected[1]">
														<label for="optionsRadios2">
															<b>No</b>
														</label>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-12 col-lg-6">
												<div class="form-group">
													<label>Status :</label>
													<select class="form-control" name="plan_status" data-validetta="required">
														<option value="APPROVED" 
															<?php if(isset($_REQUEST['id'])){ if($row->status=='APPROVED') {echo "selected";} } ?>>
															Active 
														</option>
														<option value="UNAPPROVED" 
															<?php if(isset($_REQUEST['id'])) { if($row->status=='UNAPPROVED') {echo "selected";} }?>>
															Inactive
														</option>
													</select>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-12 text-center siteLogo mt-15">
												<div class="form-group">
												   <?php if(isset($_REQUEST['id'])){ ?>
													<input type="submit" name="update_plan" value="Save" class="btn btnThemeG3" >
													<?php }else{ ?>
													<input type="submit" name="add_plan" value="Save" class="btn btnThemeG3"> 
													<?php } ?>
													<input type="reset" value="Cancel" class="btn btnThemeR3" > 
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

			<!-- Bootstrap JS -->
			<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
			<script>
				$(document).ready(function() {
					$('#body').show();
					$('.preloader-wrapper').hide();
				});
			</script>
		
    		<!-- Jquery for left menu active class-->
			<script type="text/javascript" src="dist/js/general.js"></script>
			<script type="text/javascript" src="dist/js/cookieapi.js"></script>
			<script type="text/javascript">
				setPageContext("mem_ship","Addplan");
			</script>
			
			<!-- Validation JS -->
			<script src="../js/validetta.js" type="text/javascript"></script>
			<script type="text/javascript">
				$(function() {
					$('#manage_plan').validetta({
						errorClose: false,
						realTime: true
					});
				});
			</script>
			
			<!-- Theme Js -->
			<script src="dist/js/app.min.js" type="text/javascript"></script>
	</body>
</html>