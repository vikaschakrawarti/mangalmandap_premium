<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

	if(isset($_FILES['watermark'])){
		$target_dir='../my_photos/';
		$target_dir1='../my_photos_big/';
		$imagename=$_FILES['watermark']['name'];
		$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
		$imgConvertedName='watermark'.'.'.$imageFileType;
		$target_file = $target_dir.$imgConvertedName;
		if($imageFileType != "png") {
			echo "<script>alert('Sorry, only png files are allowed.')</script>";
			echo "<script>window.location='SitePhotoWatermark'</script>";
		}elseif($_FILES["watermark"]["size"] > 500000) {
			echo "<script>alert('Your file size is more than 500kb.');</script>";
			echo "<script>window.location='SitePhotoWatermark';</script>";
		}else{
			if(move_uploaded_file($_FILES['watermark']['tmp_name'],$target_file) == 1){
				//unlink("../my_photos/watermark.png") ;
				move_uploaded_file($_FILES['watermark']['tmp_name']);
				$regThirdQry=$DatabaseCo->dbLink->query("UPDATE site_config SET watermark='$imgConvertedName' WHERE id='1'");
				
				echo "<script>alert('Watermark Uploaded Successfully');window.location='SitePhotoWatermark';</script>";
			}else{
				echo "<script>alert('Watermark size is too large or not image file.');window.location='SitePhotoWatermark';</script>";
			}
		}
	}
    $SQL_SELECT_WATERMARK=$DatabaseCo->dbLink->query("SELECT watermark FROM site_config WHERE id='1'");
    $row=mysqli_fetch_object($SQL_SELECT_WATERMARK);
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Update Photo Watermark</title>
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
					<h1>Photo Watermark</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					 	<li class="active">Photo Watermark</li>
					</ol>
	  			</section>
  				<section class="content">
    				<div class="row">
      					<div class="box-body">
          					<div class="row">
								<div class="col-lg-6 col-lg-offset-3">
									<form method="post" enctype="multipart/form-data" id="watermarkForm" action="">
										<div class="box box-success siteLogo">
											<div class="box-body">
												<div class="row">
													<h4 class="col-lg-12">Add / Edit Photo Watermark</h4>
													<div class="col-xs-12 mt-10">
														<center>
															<?php if($row->watermark !="" && file_exists('../my_photos/'.$row->watermark)){ ?>
															<img src="../my_photos/<?php if($row->watermark != ''){ echo $row->watermark; }?>" class="img-responsive img-thumbnail">
															<?php }else{ ?>
															<img src="../img/no-watermark.jpg" class="img-responsive img-thumbnail">
															<?php  } ?>
														</center>
													</div>
													<div class="col-xs-12 pl-30 pr-30">
														<p class="mt-5 fontS12"><b>Note</b>:- watermark size - <b class="text-danger">25px(Width) X 250px(Height).</b></p>
													</div>
													<div class="col-xs-12">
														<div class="form-group mt-10">
															<input type="file" class="form-control" name="watermark" data-validetta="required">
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Only <b>png</b> file supported.Max Size <b>500kb</b>.</p>
														</div>
														<div class="col-xs-12">
															<p class="fontS12"><b>Note:-</b>Press <b>Control + f5</b> if watermark not reflecting after upload.</p>
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
		<div class="clearfix"></div>
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
			setPageContext("site-settings","photowatermark");
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
				$('#watermarkForm').validetta({
					errorClose : false,
					realTime : true
				});
			});
		</script>
  	</body>
</html>