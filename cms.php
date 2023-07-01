<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	$trans = array("(" =>"",")"=>"","-"=>""," "=>"","'"=>"");
	$cms_id=isset($_GET['cms_id'])?$_GET['cms_id']:'';
	$cms_id = strtr($cms_id, $trans);
	
	
	$res2=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM cms_pages WHERE cms_id='".$cms_id."' AND status='APPROVED'" ));
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
					<div class="container gt-margin-top-20 inCMS">
						<div class="row">
							<div class="col-xs-16 col-lg-16 col-xxl-12 col-offset-2 col-xl-12 col-xl-offset-2">
								<div class="gt-panel">
									<div class="gt-panel-border-orange">
										<h2 class="gt-text-orange text-center fontMerriWeather">
								            <?php if(isset($res2)){ echo $res2->cms_title; } ?>
                                        </h2>
									</div>
									<div class="gt-panel-body pb-30">
									    <?php if(isset($res2)){ echo htmlspecialchars_decode($res2->cms_content); } ?>
									</div>
								</div>
							</div>
						</div>
    				</div>
  				</div>
            </div>
  		    <?php include "parts/footer.php"; ?>
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
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  