<?php 
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   $salt='%^&$#@*!';
   if(isset($_REQUEST['changepass'])){
   		$oldpass=trim($_REQUEST['oldpassword']);
   		$oldpass=md5($salt.$oldpass);
   		$newpass=trim($_REQUEST['newpassword']);
   		$newpass=md5($salt.$newpass);
   		$num=mysqli_num_rows($DatabaseCo->dbLink->query("SELECT id FROM admin_users WHERE `pswd`='$oldpass'"));
   		if($num>0) {		
   			$sql="UPDATE admin_users SET `pswd`='$newpass' WHERE `pswd`='$oldpass' and id='1'";
   			$go=$DatabaseCo->dbLink->query($sql);
   			$msg="Record is updated successfully.";
   		}else{
   			$error="Please enter correct old password.";
   		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Change Admin Password</title>
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
               		<h1 class="lightGrey">Change Admin Password</h1>
               		<ol class="breadcrumb">
                  		<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  		<li class="active">Change Admin Password</li>
               		</ol>
            	</section>
            	<section class="content">
               		<div class="row">
                  		<div class="box-body gtSiteChangeId">
                     		<div class="box box-success">
                        		<div class="box-body">
                           			<form method="post" name="changepass" id="changepass">
                              			<div class="row">
                                 		<?php if(isset($msg)){ ?>
                                			<div class="col-xs-12">
                                 				<div id="success_msg" class="alert alert-success">
                                    				<i class="fa fa-check-circle fa-fw fa-lg"></i>
                                    				Record is updated successfully.
                                 				</div>
                                			</div>
                                 		<?php } if(isset($error)){ ?>
                                 			<div id="success_msg" class="alert alert-danger">
												<i class="fa fa-times-circle fa-fw fa-lg"></i>
												Please enter correct old password.
                                 			</div>
                                 		<?php } ?>
											<div class="col-md-6 col-md-offset-3 col-xs-12">
												<div class="form-group">
													<label>Enter Old Password</label>
													<input type="password" class="form-control" name="oldpassword" data-validetta="required" placeholder="Enter Old Password">
												</div>
												<div class="form-group">
													<label>Enter New Password</label>
													<input type="password" class="form-control" name="newpassword" data-validetta="required" placeholder="Enter New Password">
												</div>
												<div class="form-group">
													<label>Confirm New Password</label>
													<input type="password" class="form-control" name="cpassword" data-validetta="equalTo[newpassword]" placeholder="Confirm New Password">
												</div>
											</div>
											<div class="col-xs-12 text-center siteLogo mt-15">
												<div class="form-group">
													<input type="submit" name="changepass" class="btn btnThemeG3 mr-10" value="Submit">
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
			 setPageContext("site-settings","sitepassword");
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
				$('#changepass').validetta({
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