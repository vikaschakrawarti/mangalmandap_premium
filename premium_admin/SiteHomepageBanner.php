<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

	if(isset($_FILES['banner-1'])){
		$target_dir='../img/banners/';
		$imagename=$_FILES['banner-1']['name'];
		$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
		$imgConvertedName='banner-1'.'.'.$imageFileType;
		$target_file = $target_dir.$imgConvertedName;
		if($imageFileType != "jpg" && $imageFileType != "jpeg") {
			echo "<script>alert('Sorry, only JPG & JPEG files are allowed.')</script>";
			echo "<script>window.location='SiteHomepageBanner.php'</script>";
		}elseif($_FILES["banner-1"]["size"] > 1000000) {
			echo "<script>alert('your file size is more than 1MB.');</script>";
			echo "<script>window.location='SiteHomepageBanner.php';</script>";
		}else{
			if(move_uploaded_file($_FILES['banner-1']['tmp_name'],$target_file) == 1){
				$regThirdQry=$DatabaseCo->dbLink->query("UPDATE site_config SET banner1='$imgConvertedName' WHERE id='1'");
				echo "<script>alert('Banner 1 Uploaded Successfully');window.location='SiteHomepageBanner.php';</script>";
			}else{
				echo "<script>alert('Banner 1 size is too large or not image file.');window.location='SiteHomepageBanner.php';</script>";
			}
		}
	}

	if(isset($_FILES['banner-2'])){
		$target_dir='../img/banners/';
		$imagename=$_FILES['banner-2']['name'];
		$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
		$imgConvertedName='banner-2'.'.'.$imageFileType;
		$target_file = $target_dir.$imgConvertedName;
		if($imageFileType != "jpg" && $imageFileType != "jpeg") {
			echo "<script>alert('Sorry, only JPG & JPEG files are allowed.')</script>";
			echo "<script>window.location='SiteHomepageBanner.php'</script>";
		}elseif($_FILES["banner-2"]["size"] > 1000000) {
			echo "<script>alert('your file size is more than 1MB.');</script>";
			echo "<script>window.location='SiteHomepageBanner.php';</script>";
		}else{
			if(move_uploaded_file($_FILES['banner-2']['tmp_name'],$target_file) == 1){
				$regThirdQry=$DatabaseCo->dbLink->query("UPDATE site_config SET banner2='$imgConvertedName' WHERE id='1'");
				echo "<script>alert('Banner 2 Uploaded Successfully');window.location='SiteHomepageBanner.php';</script>";
			}else{
				echo "<script>alert('Banner 2 size is too large or not image file.');window.location='SiteHomepageBanner.php';</script>";
			}
		}
	}

	if(isset($_FILES['banner-3'])){
		$target_dir='../img/banners/';
		$imagename=$_FILES['banner-3']['name'];
		$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
		$imgConvertedName='banner-3'.'.'.$imageFileType;
		$target_file = $target_dir.$imgConvertedName;
		if($imageFileType != "jpg" && $imageFileType != "jpeg") {
			echo "<script>alert('Sorry, only JPG & JPEG files are allowed.')</script>";
			echo "<script>window.location='SiteHomepageBanner.php'</script>";
		}elseif($_FILES["banner-3"]["size"] > 1000000) {
			echo "<script>alert('your file size is more than 1MB.');</script>";
			echo "<script>window.location='SiteHomepageBanner.php';</script>";
		}else{
			if(move_uploaded_file($_FILES['banner-3']['tmp_name'],$target_file) == 1){
				$regThirdQry=$DatabaseCo->dbLink->query("UPDATE site_config SET banner3='$imgConvertedName' WHERE id='1'");
				echo "<script>alert('Banner 3 Uploaded Successfully');window.location='SiteHomepageBanner.php';</script>";
			}else{
				echo "<script>alert('Banner 3 size is too large or not image file.');window.location='SiteHomepageBanner.php';</script>";
			}
		}
	}

$SQL_SELECT_BANNER=$DatabaseCo->dbLink->query("SELECT banner1,banner2,banner3 FROM site_config WHERE id='1'");
$row=mysqli_fetch_object($SQL_SELECT_BANNER);
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
					<h1>Home Page Banner</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					  	<li class="active">Add / Edit Homepage Banner</li>
					</ol>
		  		</section>
			  	<section class="content">
					<div class="row">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-4">
									<form method="post" enctype="multipart/form-data" id="bannerForm1" action="">
										<div class="box box-success siteLogo">
											<div class="box-body">
												<h4>Add / Edit Banner 1</h4>
												<div class="row">
													<div class="col-xs-12">
														<?php 
															if($row->banner1 !="" && file_exists('../img/banners/'.$row->banner1)){ 
															?>
														<img src="../img/banners/<?php if($row->banner1 != ''){ echo $row->banner1; }?>" class="img-responsive img-thumbnail">
														<?php 
															}else{
															?>
														<img src="../img/no-banner.jpg" class="img-responsive img-thumbnail">
														<?php 
															}
															?>
													</div>
													<div class="col-xs-12">
														<p class="mt-5 fontS12"><b>Note</b>:- Banner size - <b class="text-danger">1351px(Width) X 591px(Height).</b></p>
													</div>
													<div class="col-xs-12">
														<div class="form-group mt-10">
															<input type="file" class="form-control" name="banner-1" data-validetta="required">
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Only <b>jpg & jpeg</b> files supported.Max Size <b>1MB</b>.</p>
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Press <b>Control + f5</b> if banner not reflecting after upload.</p>
														</div>
														<div class="form-group text-center">
															<input type="submit" class="btn btnThemeG3" name="sub_add_logo" value="Submit">
														</div>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-lg-4">
									<form method="post" enctype="multipart/form-data" id="bannerForm2" action="">
										<div class="box box-success siteLogo">
											<div class="box-body">
												<h4>Add / Edit Banner 2</h4>
												<div class="row">
													<div class="col-xs-12">
														<img src="../img/banners/<?php if($row->banner2 != ''){ echo $row->banner2; }?>" class="img-responsive img-thumbnail">
													</div>
													<div class="col-xs-12">
														<p class="mt-5 fontS12"><b>Note</b>:- Banner size - <b class="text-danger">1351px(Width) X 591px(Height).</b></p>
													</div>
													<div class="col-xs-12">
														<div class="form-group mt-10">
															<input type="file" class="form-control" name="banner-2" data-validetta="required">
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Only <b>jpg & jpeg</b> files supported.Max Size <b>1MB</b>.</p>
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Press <b>Control + f5</b> if banner not reflecting after upload.</p>
														</div>
														<div class="form-group text-center">
															<input type="submit" class="btn btnThemeG3" name="" value="Submit">
														</div>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-lg-4">
									<form method="post" enctype="multipart/form-data" id="bannerForm3" action="">
										<div class="box box-success siteLogo">
											<div class="box-body">
												<h4>Add / Edit Banner 3</h4>
												<div class="row">
													<div class="col-xs-12">
														<img src="../img/banners/<?php if($row->banner3 != ''){ echo $row->banner3; }?>" class="img-responsive img-thumbnail">
													</div>
													<div class="col-xs-12">
														<p class="mt-5 fontS12"><b>Note</b>:- Banner size - <b class="text-danger">1351px(Width) X 591px(Height).</b></p>
													</div>
													<div class="col-xs-12">
														<div class="form-group mt-10">
															<input type="file" class="form-control" name="banner-3" data-validetta="required">
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Only <b>jpg & jpeg</b> files supported.Max Size <b>1MB</b>.</p>
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Press <b>Control + f5</b> if banner not reflecting after upload.</p>
														</div>
														<div class="form-group text-center">
															<input type="submit" class="btn btnThemeG3" name="" value="Submit">
														</div>
													</div>
												</div>
												<div class="clearfix"></div>
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
   
  		<!-- Validation -->
		<script src="../js/validetta.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				$('#bannerForm1').validetta({
					errorClose : false,
					realTime : true
				});
				$('#bannerForm2').validetta({
					errorClose : false,
					realTime : true
				});
				$('#bannerForm3').validetta({
					errorClose : false,
					realTime : true
				});
			});
		</script>
		
		<!--jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			setPageContext("site-settings","homepagebanner");
		</script>	
  
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
    	<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
	</body>
</html>