<?php
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
    $_SESSION['matri_id_reg'];
	
	if($_SESSION['matri_id_reg'] == ""){
		echo "<script>window.location='index.php';</script>";
	}

if(isset($_POST['submit'])){
	$_SESSION['matri_id_reg'];	
	$image=$_FILES["attachment"]["name"];   
	$target_dir = "documents/";
	$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$img_name; 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.')</script>";
		echo "<script>window.location='aadhaar_upload';</script>";
	} elseif($_FILES["attachment"]["size"] > 2000000) {
        echo "<script>alert('your file size is more than 2MB.')</script>";
	    echo "<script>window.location='aadhaar_upload';</script>";
	} else {
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
		echo "<script>window.location='aadhaar_upload';</script>";
		$DatabaseCo->dbLink->query("UPDATE register set aadhaar_card='".$img_name."',aadhaar_card_status='PENDING' WHERE matri_id='".$_SESSION['matri_id_reg']."'");
    }
		
}
$fetch=$DatabaseCo->dbLink->query("SELECT aadhaar_card,aadhaar_card_status FROM register WHERE matri_id='".$_SESSION['matri_id_reg']."'");
$row1=mysqli_fetch_object($fetch);
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
    				<div class="container gtAadhaar mt-20">
        				<div class="row">
							<div class="col-xs-16 text-center">
								<h3 class="gt-text-green inPageTitle fontMerriWeather text-center mt-15 inThemeOrange"><?php echo $lang['Upload Your Document']; ?> </h3>
								<article><p class="inPageSubTitle text-center"><?php echo $lang['Upload your Id Proof']; ?>.</p></article>
							</div>
          	 	 			
						 	<div class="col-xxl-12 col-xxl-offset-2 gtRegister">
								<?php
									$AADHAR_UPLOAD_SECTION = $DatabaseCo->dbLink->query("SELECT aadhaar_pic_skip FROM site_config WHERE id=1");
									$row_aadhaar=mysqli_fetch_object($AADHAR_UPLOAD_SECTION);
									if($row_aadhaar->aadhaar_pic_skip == 'No'){
								?>
								<div class="row">
									<div class="col-xxl-3 col-xxl-offset-13">
										<a class="btn gt-btn-green btn-block" href="register-confirm-password"> <?php echo $lang['Skip']; ?> <i class="fa fa-caret-right"></i></a>
									</div>
								</div>
								<?php } ?>
								<div class="row">
									<?php if($row1->aadhaar_card != ""){ ?>
									<div class="col-xxl-6 gtAadhaarPrev">
										<a href="#myModal" data-toggle="modal" >
											<img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive img-thumbnail">
										</a>
									</div>
									<?php }else{?>
										<div class="col-xxl-6 gtAadhaarPrev">
											<img src="img/document-default.jpg" class="img-responsive">
										</div>
									<?php }?>
									<form class="col-xxl-10 gt-margin-top-50" name="" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label><?php echo $lang['Upload Your Id Proof']; ?></label>
											<input type="file" placeholder="Select File" class="gt-form-control" name="attachment"/>
											<p><?php echo $lang['Note']; ?>:&nbsp;&nbsp;<?php echo $lang['']; ?>.</p>
										</div>
										<input type="Submit" value="Upload" name="submit" class="btn gt-btn-green inIndexRegBtn">
										<p class="mt-10"><?php echo $lang['Select image click on']; ?> <b><?php echo $lang['Upload']; ?></b> <?php echo $lang['button and then click on']; ?> <b><?php echo $lang['Continue']; ?></b> <?php echo $lang['button to upload ID Proof']; ?>.</p>
									</form>
								 	<div class="col-xxl-16 text-center gt-margin-top-30">
										<a href="register-confirm-password" class="btn gt-btn-orange inIndexRegBtn inPhotoUploadBtn mt-20"><?php echo $lang['Continue']; ?></a>
								 	</div>
								</div>
							</div>
            			</div>	
    				</div>
    			</div>
  			</div>  
    		<?php include "parts/footer.php"; ?>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xxl-16">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="col-xxl-16 gtAadhaarModal">
                            <img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close']; ?></button>
                    </div>
                </div>
            </div>
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

        <!-- Validation js -->
        <script type="text/javascript" src="js/validetta.js"></script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  