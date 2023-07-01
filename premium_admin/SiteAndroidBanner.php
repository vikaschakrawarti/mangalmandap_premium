<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	
	if(isset($_FILES['android_img'])){
		$target_dir='../img/';
		$imagename=$_FILES['android_img']['name'];
		$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
		$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
		$target_file = $target_dir.$imgConvertedName;
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			echo "<script>window.location='SiteAndroidBanner'</script>";
		}elseif($_FILES["android_img"]["size"] > 1000000) {
			echo "<script>alert('your file size is more than 1MB.');</script>";
			echo "<script>window.location='SiteAndroidBanner';</script>";
		}else{
			if(move_uploaded_file($_FILES['android_img']['tmp_name'],$target_file) == 1){
				$regThirdQry=$DatabaseCo->dbLink->query("UPDATE site_config SET android_banner_img='$imgConvertedName' WHERE id='1'");
				echo "<script>alert('Android App Image Uploaded Successfully');window.location='SiteAndroidBanner';</script>";
			}else{
				echo "<script>alert('Android App Imag size is too large or not image file.');window.location='SiteAndroidBanner';</script>";
			}
		}
	}
	if(isset($_POST['android_link_btn'])){
		$android_link=$_POST['android_link'];
		$android_app_banner=$_POST['android_app_banner'];
		$UPDATE_ANDROID_LINK=$DatabaseCo->dbLink->query("UPDATE site_config SET android_link='$android_link',android_app_banner='$android_app_banner' WHERE id='1'");
		echo "<script>alert('Updated Successfully.');</script>";
		echo "<script>window.location='SiteAndroidBanner';</script>";
	}
	$HOMEPAGE_ANDROID_QUERY=$DatabaseCo->dbLink->query("SELECT android_link,android_app_banner,android_banner_img FROM site_config WHERE id='1'");
	$row=mysqli_fetch_object($HOMEPAGE_ANDROID_QUERY);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Update Homepage Banner</title>
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
					<h1 class="lightGrey">Homepage Android App Section </h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Homepage Android App Section </li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-6">
							<div class="box-body">
								<div class="box box-success">
									<div class="box-body">
										<div class="row">
											<form name="android_img" action="" method="post" enctype="multipart/form-data">	 
												<div class="col-md-12 col-xs-12">
													<div class="form-group logoUpload siteLogo">
														<h4 class="mb-20">Upload App Image</h4>
														<div class="col-xs-12 thumbnail">
															<img src="../img/<?php echo $row->android_banner_img; ?>" class="img-responsive">
														</div>
														<input type="file" class="form-control" name="android_img">
														<div class="alert alert-success alert-dismissable mt-30">
															<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
															<i class="icon fa fa-info"></i>Only JPEG, JPG, GIF, PNG types are accepted. 2 MB maximum size.
														</div>
														<div class="alert alert-success alert-dismissable mt-30">
															<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
															<i class="icon fa fa-info"></i>Press <b>Control + f5</b> if banner not reflecting after upload.
														</div>
													</div>
													<div class="form-group">
														<div class="form-group text-center">
															<input type="submit" class="btn btnThemeG3" name="android_img" value="Submit">
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body">
								<div class="box box-success">
									<div class="box-body">
										<div class="row">
											<form name="android_link_form" action="" id="android_link" method="post">	 
												<div class="col-md-12 col-xs-12">
													<div class="form-group">
														<label class="form-label">Android App Banner</label>
														<select class="form-control" name="android_app_banner">
															<option value="Yes" <?php if(isset($row->android_app_banner)){ if($row->android_app_banner == 'Yes'){ echo 'selected'; }}?>>Yes</option>
															<option value="No" <?php if(isset($row->android_app_banner)){ if($row->android_app_banner == 'No'){ echo 'selected'; }}?>>No</option>
														</select>
													</div>
												</div>
												<div class="col-md-12 col-xs-12">
													<div class="form-group">
														<label class="form-label">Play Store Link</label>
														<textarea name="android_link" class="form-control" rows="5"><?php if(isset($row->android_link)){ if($row->android_link != ''){ echo $row->android_link; }}?></textarea>
													</div>
												</div>
												<div class="form-group">
													<div class="form-group text-center">
														<input type="submit" class="btn btnThemeG3" name="android_link_btn" value="Submit">
													</div>
												</div>
											</form>
										</div>
									</div>
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
			setPageContext("site-settings","homepageandroidbanner");
		</script>
		
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
    	<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
	</body>
</html>