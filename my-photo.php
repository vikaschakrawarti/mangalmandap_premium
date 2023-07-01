<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

include_once 'auth.php';
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if(isset($_POST['editPhoto1'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo1']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo1']['tmp_name'];
    $fn = $_FILES['photo1']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo1']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}elseif($_FILES["photo1"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo1']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo1='".$imgConvertedName."',photo1_approve='PENDING',photo_view_status='1',photo_protect='No' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto2'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo2']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo2']['tmp_name'];
    $fn = $_FILES['photo2']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo2']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}elseif($_FILES["photo2"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}else{
		if(move_uploaded_file($_FILES['photo2']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo2='".$imgConvertedName."',photo2_approve='PENDING' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo 2 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto3'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo3']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo3']['tmp_name'];
    $fn = $_FILES['photo3']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo3']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo3"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}else{
		if(move_uploaded_file($_FILES['photo3']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo3='".$imgConvertedName."',photo3_approve='PENDING' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo 3 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto4'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo4']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo4']['tmp_name'];
    $fn = $_FILES['photo4']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo4']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}elseif($_FILES["photo4"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo4']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo4='".$imgConvertedName."',photo4_approve='PENDING' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo 4 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto5'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo5']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo5']['tmp_name'];
    $fn = $_FILES['photo5']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo5']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}elseif($_FILES["photo5"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo5']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo5='".$imgConvertedName."',photo5_approve='PENDING' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo 5 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto6'])){
$maxDimW = 500;
$maxDimH = 500;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo6']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo6']['tmp_name'];
    $fn = $_FILES['photo6']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo6']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}elseif($_FILES["photo6"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.');</script>";
		echo "<script>window.location='my-photo';</script>";
	}else{
		if(move_uploaded_file($_FILES['photo6']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("UPDATE register SET photo6='".$imgConvertedName."',photo6_approve='PENDING' WHERE matri_id='".$mid."'");
			echo "<script>alert('Photo 6 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
$Row = $DatabaseCo->dbLink->query("SELECT photo1,photo2,photo3,photo4,photo5,photo6,gender,photo_view_status,photo_protect,photo_pswd,photo1_approve,photo2_approve,photo3_approve,photo4_approve,photo5_approve,photo6_approve FROM register WHERE matri_id='".$mid."'") or die(mysqli_error($DatabaseCo->dbLink));
$Row = mysqli_fetch_object($Row);

if(isset($_GET['del_id'])){
    if($_GET['del_id'] == 1){
        if (file_exists('my_photos/'."".$Row->photo1)) {
            unlink('my_photos/'."".$Row->photo1);
        }
        $del1=$DatabaseCo->dbLink->query("UPDATE register SET photo1='',photo1_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
    if($_GET['del_id'] == 2){
        if (file_exists('my_photos/'."".$Row->photo2)) {
            unlink('my_photos/'."".$Row->photo2);
        }
        $del2=$DatabaseCo->dbLink->query("UPDATE register SET photo2='',photo2_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
    if($_GET['del_id'] == 3){
        if (file_exists('my_photos/'."".$Row->photo3)) {
            unlink('my_photos/'."".$Row->photo3);
        }
        $del3=$DatabaseCo->dbLink->query("UPDATE register SET photo3='',photo3_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
    if($_GET['del_id'] == 4){
        if (file_exists('my_photos/'."".$Row->photo4)) {
            unlink('my_photos/'."".$Row->photo4);
        }
        $del4=$DatabaseCo->dbLink->query("UPDATE register SET photo4='',photo4_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
    if($_GET['del_id'] == 5){
        if (file_exists('my_photos/'."".$Row->photo5)) {
            unlink('my_photos/'."".$Row->photo5);
        }
        $del5=$DatabaseCo->dbLink->query("UPDATE register SET photo5='',photo5_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
    if($_GET['del_id'] == 6){
        if (file_exists('my_photos/'."".$Row->photo6)) {
            unlink('my_photos/'."".$Row->photo6);
        }
        $del6=$DatabaseCo->dbLink->query("UPDATE register SET photo6='',photo6_approve='' WHERE matri_id='$mid'");
        echo "<script>window.location='my-photo';</script>";
    }
}
/*$Row = $DatabaseCo->dbLink->query("SELECT photo1,photo2,photo3,photo4,photo5,photo6,gender,photo_view_status,photo_protect,photo_pswd,photo1_approve,photo2_approve,photo3_approve,photo4_approve,photo5_approve,photo6_approve FROM register WHERE matri_id='".$mid."'") or die(mysqli_error($DatabaseCo->dbLink));
$Row = mysqli_fetch_object($Row);*/

?>
<?php
if (isset($_GET['mp-rem-id'])) {
    $DatabaseCo->dbLink->query("UPDATE reminder SET reminder_view_status='No' WHERE rem_id='".$_GET['mp-rem-id']."'");
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
        			<div class="container gt-margin-top-20">
            			<div class="row">
							<div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center">
								<h2 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['Upload & Profile Picture Settings']; ?></h2>
								<article>
									<p class="inPageSubTitle mb-20">
										<?php echo $lang['Here is your option to set your profile pictures and other pictures.Remember upload profile picture gives you 10 times better respose.So do it now if you didnt']; ?>.
									</p>
								</article>
							</div>
							<div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
								<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
									<?php echo $lang['']; ?>Options <i class="fa fa-angle-down"></i>
								</a>
								<div class="collapse mobile-collapse" id="collapseExample">
									<?php include "parts/left_panel.php"; ?>
								</div>
							</div>
                			<div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
								<div class="inUploadPhoto mb-30">
									<div class="gt-profile-pic-title">
										<h4><?php echo $lang['Change Or Upload Profile Picture']; ?></h4>
									</div>
									<div class="gt-profile-pic-panel">
										<div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
											<div class="row">
												<div class="col-xxl-6 col-xxl-offset-5 col-xl-6 col-xxl-offset-5 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5">
													<div class="col-xs-16 gtImageUpload">
														<?php if($Row->photo1 != '' && file_exists('my_photos/'.$Row->photo1)){ ?> 
															<img src="my_photos/<?php echo $Row->photo1; ?>" class="img-responsive img-thumbnail gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo1 == ''){ ?> 
																<img src="img/male.jpg" class="img-responsive img-thumbnail gt-margin-bottom-15">
															<?php }else{ ?> 
																<img src="img/female.jpg" class="img-responsive img-thumbnail gt-margin-bottom-15">
														<?php }}?> 
															<a href="#editPhoto1Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
																<?php echo $lang['Change Profile Picture']; ?>
															</a>
														<?php if($Row->photo1 != '' && file_exists('my_photos/'.$Row->photo1)){ ?> 
															<a href="my-photo.php?del_id=1" class="btn btn-danger btn-block">
																<?php echo $lang['Delete Profile Picture']; ?>
															</a>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="inUploadPhoto mb-30">
									<div class="gt-profile-pic-title">
										<h4><?php echo $lang['Upload More Photos']; ?></h4>
									</div>
									<div class="gt-profile-pic-panel">
                        				<div class="row">
											<div class="col-xxl-4 col-xs-8 col-md-4">
												<div class="gtImageUpload">
													<div class="thumbnail">
														<div class="caption text-center"><?php echo $lang['Photo']; ?> 2</div>
														<?php if($Row->photo2 != '' && file_exists('my_photos/'.$Row->photo2)){ ?>
															<img src="my_photos/<?php echo $Row->photo2; ?>" class="img-responsive gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo2 == ''){ ?>
																<img src="img/male.jpg" class="img-responsive gt-margin-bottom-15">
															<?php }else{ ?>
																<img src="img/female.jpg" class="img-responsive gt-margin-bottom-15">	
														<?php }}?>										 
													</div>  
													<a href="#editPhoto2Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
														<?php echo $lang['Edit Photo']; ?> 2
													</a>
													<?php if($Row->photo2 != '' && file_exists('my_photos/'.$Row->photo1)){ ?>
														<a href="my-photo.php?del_id=2" class="btn btn-danger btn-block">
															<?php echo $lang['Delete Photo']; ?> 2
														</a>
													<?php }?>
												</div>
											</div>
											<div class="col-xxl-4 col-xs-8 col-md-4">
												<div class="gtImageUpload">
													<div class="thumbnail">
														<div class="caption text-center">
															<?php echo $lang['Photo']; ?> 3
														</div>
														<?php if($Row->photo3 != '' && file_exists('my_photos/'.$Row->photo3)){ ?>
															<img src="my_photos/<?php echo $Row->photo3; ?>" class="img-responsive gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo3 == ''){ ?>
																<img src="img/male.jpg" class="img-responsive gt-margin-bottom-15">
															<?php }else{ ?>
																<img src="img/female.jpg" class="img-responsive gt-margin-bottom-15">	
														<?php }}?>										 
													</div>  
													<a href="#editPhoto3Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
														<?php echo $lang['Edit Photo']; ?> 3
													</a>
													<?php if($Row->photo3 != '' && file_exists('my_photos/'.$Row->photo3)){ ?>
														<a href="my-photo.php?del_id=3" class="btn btn-danger btn-block">
															<?php echo $lang['Delete Photo']; ?> 3
														</a>
													<?php } ?>
												</div>
											</div>
											<div class="col-xxl-4 col-xs-8 col-md-4">
												<div class="gtImageUpload">
													<div class="thumbnail">
														<div class="caption text-center"><?php echo $lang['Photo']; ?> 4</div>
														<?php if($Row->photo4 != '' && file_exists('my_photos/'.$Row->photo4)){ ?>
															<img src="my_photos/<?php echo $Row->photo4; ?>" class="img-responsive gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo4 == ''){ ?>
																<img src="img/male.jpg" class="img-responsive gt-margin-bottom-15">
															<?php }else{ ?>
																<img src="img/female.jpg" class="img-responsive gt-margin-bottom-15">	
														<?php }}?>										 
													</div>  
													<a href="#editPhoto4Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
														<?php echo $lang['Edit Photo']; ?> 4
													</a>
													<?php if($Row->photo4 != '' && file_exists('my_photos/'.$Row->photo4)){ ?>
														<a href="my-photo.php?del_id=4" class="btn btn-danger btn-block">
															<?php echo $lang['Delete Photo']; ?> 4
														</a>
													<?php }?>
												</div>
											</div>
											<div class="col-xxl-4 col-xs-8 col-md-4">
												<div class="gtImageUpload">
													<div class="thumbnail">
														<div class="caption text-center"><?php echo $lang['Photo']; ?> 5</div>
														<?php if($Row->photo5 != '' && file_exists('my_photos/'.$Row->photo5) ){ ?>
															<img src="my_photos/<?php echo $Row->photo5; ?>" class="img-responsive gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo5 == ''){ ?>
																<img src="img/male.jpg" class="img-responsive gt-margin-bottom-15">
															<?php }else{ ?>
																<img src="img/female.jpg" class="img-responsive gt-margin-bottom-15">	
														<?php }}?>										 
													</div>  
													<a href="#editPhoto5Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
														  <?php echo $lang['Edit Photo']; ?> 5
													</a>
													<?php if($Row->photo5 != '' && file_exists('my_photos/'.$Row->photo5)){ ?>
														<a href="my-photo.php?del_id=5" class="btn btn-danger btn-block">
														   <?php echo $lang['Delete Photo']; ?> 5
														</a>
													<?php }?>
												</div>
											</div>
						 				</div>
										<div class="row gt-margin-top-20">
											<div class="col-xxl-4 col-xs-8 col-md-4">
												<div class="gtImageUpload">
													<div class="thumbnail">
														<div class="caption text-center"><?php echo $lang['']; ?><?php echo $lang['Photo']; ?> 6</div>
														<?php if($Row->photo6 != '' && file_exists('my_photos/'.$Row->photo6)){ ?>
															<img src="my_photos/<?php echo $Row->photo6; ?>" class="img-responsive gt-margin-bottom-15">
														<?php }else{?>
															<?php if($Row->gender == 'Male' && $Row->photo6 == ''){ ?>
																<img src="img/male.jpg" class="img-responsive gt-margin-bottom-15">
															<?php }else{ ?>
																<img src="img/female.jpg" class="img-responsive gt-margin-bottom-15">	
														<?php }}?>										 
													</div>  
													<a href="#editPhoto6Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
														<?php echo $lang['Edit Photo']; ?> 6
													</a>
													<?php if($Row->photo6 != '' && file_exists('my_photos/'.$Row->photo6)){ ?>
														<a href="my-photo.php?del_id=6" class="btn btn-danger btn-block">
														   <?php echo $lang['Delete Photo']; ?> 6
														</a>
													<?php }?>
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
			<!-- Photo Edit Modal -->
			<?php include 'parts/modal/edit_photo1_modal.php'; ?>
			<?php include 'parts/modal/edit_photo2_modal.php'; ?>
			<?php include 'parts/modal/edit_photo3_modal.php'; ?>
			<?php include 'parts/modal/edit_photo4_modal.php'; ?>
			<?php include 'parts/modal/edit_photo5_modal.php'; ?>
			<?php include 'parts/modal/edit_photo6_modal.php'; ?>
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
        <script src="js/jquery.bootstrap-responsive-tabs.min.js" type="text/javascript"></script>
        <script>
			$('.responsive-tabs').responsiveTabs({
  			accordionOn: ['xs', 'sm']
		});
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
		<script>
			function readURL1(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo1_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
	  	<script>
			function readURL2(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo2_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
	  	<script>
			function readURL3(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo3_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
	  	<script>
			function readURL4(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo4_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
	  	<script>
			function readURL5(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo5_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
	  	<script>
			function readURL6(input) {
				if(input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#photo6_prev').attr('src', e.target.result)
					};
					reader.readAsDataURL(input.files[0]);
				}
			}
	  	</script>
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  


