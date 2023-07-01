<?php 

include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	include_once 'auth.php';
	$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
if(isset($_POST['subform']) && isset($_FILES['horoscope'])){
$maxDimW = 500;
$maxDimH = 500;

list($width, $height, $type, $attr) = getimagesize( $_FILES['horoscope']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['horoscope']['tmp_name'];
    $fn = $_FILES['horoscope']['tmp_name'];
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
	$target_dir='horoscope_img/';
	$imagename=$_FILES['horoscope']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName;
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		//echo "<script>window.location='horoscope';</script>";
	}elseif($_FILES["horoscope"]["size"] > 2000000) {
		echo "<script>alert('your file size is more than 2MB.');</script>";
		//echo "<script>window.location='horoscope';</script>";
	}else{
		if(move_uploaded_file($_FILES['horoscope']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set hor_photo='".$imgConvertedName."',hor_check='PENDING' where matri_id='".$_SESSION['user_id']."'");
			//echo "<script>alert('Horoscope Image Uploaded Successfully');window.location='horoscope';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			//echo "<script>window.location='horoscope';</script>";
		}
	}
}
/*
if(isset($_POST['subform'])){
		 	$image=$_FILES["horoscope"]["name"];   
			$target_dir = "horoscope-list/";
			$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
			$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
			$target_file = $target_dir.$img_name; 
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			 echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			 echo "<script>window.location='horoscope.php'</script>";
			}
			elseif($_FILES["horoscope"]["size"] > 1000000) {
			 echo "<script>alert('your file size is more than 1MB.')</script>";
			 echo "<script>window.location='horoscope.php'</script>";
			}else {
				move_uploaded_file($_FILES["horoscope"]["tmp_name"], $target_file);
			}
			$DatabaseCo->dbLink->query("update register set hor_photo='".$img_name."',hor_check='UNAPPROVED' where matri_id='".$_SESSION['user_id']."'");	
			echo "<script>alert('Your Horoscope image uploade successfully.');</script>";



}
*/

$getimg=mysqli_fetch_object($DatabaseCo->dbLink->query("select hor_photo,username,caste,birthdate,birthtime,birthplace,star,padham,moonsign,lagnam,dosh,janana1,janana2,janana3,janana4,rasi1,rasi2,rasi3,rasi4,rasi5,rasi6,rasi7,rasi8,rasi9,rasi10,rasi11,rasi12,amsam1,amsam2,amsam3,amsam4,amsam5,amsam6,amsam7,amsam8,amsam9,amsam10,amsam11,amsam12 from register where matri_id='".$_SESSION['user_id']."'"));

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

        <!-- Owl Carousel CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
		
        <!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
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
							<div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center gt-margin-bottom-20">
								<h3 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['Upload Horoscope']; ?></h3>
								<article>
									<p class="inPageSubTitle mb-20"><?php echo $lang['Here is your option to set your Horoscope.Upload your horoscope image(kundli) may be you not believe but other user does']; ?>.</p>
								</article>
							</div>
							<div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
								<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
									<?php echo $lang['Options']; ?> <i class="fa fa-angel-down"></i>
								</a>
								<div class="collapse mobile-collapse" id="collapseExample">
									<?Php include "parts/level-2.php"; ?>
								</div>
							</div>
							<div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
								<div class="inUploadPhoto mb-30">
								<div class="gt-profile-pic-title">
									<div class="col-xxl-10 col-xl-10 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
										<h4><?php echo $lang['Change Or Upload Horoscope']; ?></h4>
									</div>
							   	</div>
							   	<div class="gt-profile-pic-panel">
									<div class="col-xs-16 gt-margin-bottom-15">
										<div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-8 gt-padding-top-5">
											<label><?php echo $lang['Upload Your Horoscope Image']; ?></label>
										</div>	
										<div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-8 gt-upload-photo">
											<form action="" method="post" enctype="multipart/form-data" name="horoscopeform" id="horoscopeform">
												<input type="file" name="horoscope" id="horoscope" class="upload btn btn-default" placeholder="<?php echo $lang['Change Horoscope']; ?>"/>
												<input type="hidden" name="subform" value="<?php echo $lang['Submit']; ?>">
											</form>
										</div>
									</div>
									<div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
                    					<div class="row">
                        					<?php 
												if($getimg->hor_photo!=''){
											?>
                                            <img class="img-thumbnail" src="horoscope_img/<?php echo $getimg->hor_photo;?>">
											<?php 
												}else{
											?>
                                            <img class="img-thumbnail" src="img/nodata-available.jpg">
                                            <?php  }?>
                        				</div>
                    				</div>
               					</div>
								</div>
								<!--<div class="inUploadPhoto mb-30">
							   	<div class="gt-profile-pic-title">
									<div class="col-xxl-10 col-xl-10 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
										<h4>Edit / Add Horoscope</h4>
									</div>
							   	</div>
							   	<div class="gt-profile-pic-panel">
									<div class="row">
										<div class="col-md-8 gt-margin-bottom-15">
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Name </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->username ; ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Date of Birth </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->birthdate; ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Birth Place </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->birthplace; ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Time of Birth </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->birthtime; ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Dosh </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->dosh; ?></b> 
												</div>
											</div>
										</div>
										<div class="col-md-8 gt-margin-bottom-15">
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Star </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->star; ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Dasa type </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->janana1 ?></b> 
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Birth Balance Dasa </div>
												<div class="col-xs-10"> 
													<b><?php echo $getimg->janana2 ." Years ".$getimg->janana3 ." Month ".$getimg->janana4 ." Days" ; ?></b>
												</div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Raasi </div>
												<div class="col-xs-10"> <b><?php echo $getimg->moonsign; ?></b> </div>
											</div>
											<div class="row gt-margin-bottom-15">
												<div class="col-xs-6"> Caste </div>
												<div class="col-xs-10"> 
													<b>
														<?php
															$caste= $getimg->caste;
															$SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT caste_name FROM caste WHERE caste_id='$caste'");
															$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste);			
															echo $DatabaseCo->Row->caste_name; ?>  
													</b> 
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-16 text-center">
											<a href="edit-horoscope.php" class="btn gt-btn-orange"><i class="fa fa-pencil"></i> Edit Horoscope</a> 
										</div>
										<div class="col-xs-16 text-center gt-margin-top-20 gt-margin-bottom-30">
											<form>
												<div class="row">
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi1; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi2; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi3; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi4; ?>" disabled> </div>
												</div>
												<div class="row">
													<div class="col-xs-4">
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi5; ?>" disabled> </div>
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi6; ?>" disabled> </div>
													</div>
													<div class="col-xs-8">
														<div class="box">
															<h4>Rasi</h4> </div>
													</div>
													<div class="col-xxl-4">
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi7; ?>" disabled> </div>
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi8; ?>" disabled> </div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi9; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi10; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi11; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi12; ?>" disabled> </div>
												</div>
											</form>
										</div>
										<div class="col-xs-16 text-center gt-margin-top-25">
											<form>
												<div class="row">
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam1; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam2; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam3; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam4; ?>" disabled> </div>
												</div>
												<div class="row">
													<div class="col-xs-4">
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam5; ?>" disabled> </div>
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam6; ?>" disabled> </div>
													</div>
													<div class="col-xs-8">
														<div class="box">
															<h4>Amsam</h4> </div>
													</div>
													<div class="col-xxl-4">
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam7; ?>" disabled> </div>
														<div class="form-group">
															<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam8; ?>" disabled> </div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam9; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam10; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam11; ?>" disabled> </div>
													<div class="col-xs-4 gt-margin-bottom-15">
														<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam12; ?>" disabled> </div>
												</div>
											</form>
										</div>
									</div>
								</div>	
								
							</div>-->
               			</div>  
          			</div>
    			</div>
				</div>
			</div>
    		<?php include "parts/footer.php"; ?>
    	</div>
	</body>
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
		<script>
			$(document).ready(function(e) {
				$('#horoscope').on('change',function(){
					$('#horoscopeform').submit();
				});
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
	</html>
	<?php include'thumbnailjs.php' ; ?> 