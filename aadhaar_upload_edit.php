<?php 
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();

    include_once 'auth.php';
    $mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';

    if(isset($_POST['submit'])){
       $_SESSION['user_id'];	
        $image=$_FILES["attachment"]["name"];   
        $target_dir = "documents/";
        $imageFileType = pathinfo($image,PATHINFO_EXTENSION);
        $img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
        $target_file = $target_dir.$img_name; 
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.');</script>";
            echo "<script>window.location='aadhaar_upload_edit';</script>";
        } elseif($_FILES["attachment"]["size"] > 2000000) {
            echo "<script>alert('your file size is more than 2MB.');</script>";
            echo "<script>window.location='aadhaar_upload_edit';</script>";
        } else {
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
            echo "<script>window.location='aadhaar_upload_edit';</script>";
            $DatabaseCo->dbLink->query("UPDATE register SET aadhaar_card='".$img_name."',aadhaar_card_status='PENDING' WHERE matri_id='".$mid."'");
        }

    }

    $fetch=$DatabaseCo->dbLink->query("select aadhaar_card,aadhaar_card_status from register where matri_id='".$mid."'");
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
					<div class="container gt-margin-top-20">
						<div class="row">
							<div class="col-xxl-12 col-xxl-offset-2 col-xl-12 col-xl-offset-2  gt-margin-bottom-20 gt-upload-photo">
								<h3 class="inPageTitle fontMerriWeather inThemeOrange text-center"><?php echo $lang['Document – Upload / Edit Details']; ?></h3>
								<article class="text-center">
									<p class="inPageSubTitle mb-20">
										<?php echo $lang['Uploading document will get your profile approval of authentication']; ?>
									</p>
								</article>
								<div class="gt-profile-pic-panel gt-margin-top-20">
									<div class="row">
										<div class="col-xxl-6 gtPreviewAadhaar">
											<div class="thumbnail">
												<?php if($row1->aadhaar_card != ''){ ?>
													<a href="#myModal" data-toggle="modal" >
														<img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
													</a>
												<?php }else{?>
													<img src="img/document-default.jpg" class="img-responsive">
												<?php }?>
												<div class="caption">
													<h5 class="text-center gt-margin-bottom-0 gt-margin-top-0"><?php echo $lang['Status']; ?> : <b class="text-danger"><?php echo $row1->aadhaar_card_status; ?></b></h5>
												</div>
											</div>
										</div>
										<form action="" class="col-xxl-10 gt-margin-top-40" method="post" enctype="multipart/form-data" >
											<div class="form-group">
												<label><?php echo $lang['To get verified Upload document below']; ?>:</label>
												<input type="file" placeholder="Select File" class="gt-form-control" name="attachment"/>
											</div>
											<div class="col-xxl-16 text-center">
											<input type="Submit" value="<?php echo $lang['Upload']; ?>" name="submit" class="btn gt-btn-orange inBtnTheme-2">
											</div>
									   </form>
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
        				<img src="uploads/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
        			</div>
      			</div>
      			<div class="clearfix"></div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close']; ?></button>
      			</div>
    		</div>
  		</div>
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