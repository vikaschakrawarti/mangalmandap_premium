<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	include_once 'auth.php';
	$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
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
					<div class="container">
						<div class="row">
							<aside class="col-xxl-4 col-xl-4 col-xs-16">
								<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20 gt-margin-top-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
									<?php echo $lang['Options']; ?> <i class="fa fa-angel-down"></i>
								</a>
								<div class="collapse mobile-collapse" id="collapseExample">
									<?php include "parts/match-sidebar.php"; ?>
									<?php include "parts/level-2.php"; ?>
								</div>
							</aside>
							<div class="col-xxl-12 col-xl-12 col-xs-16">
								<h3 class="inPageTitle fontMerriWeather inThemeOrange text-center"><?php echo $lang['One Way Match']; ?></h3>
								<article class="text-center">
									<p class="inPageSubTitle mb-20"><?php echo $lang['One way match is the profile show in perticular criteria at its best.its help you to find out your life partner easily']; ?>.</p>
								</article>                 
								 <div id="loaderID" style="position:fixed; left:50%; top:50%; z-index:-1; opacity:0">
									<div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div>
								 </div>	
								 <div id="pagination"></div>
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
    	<script type="text/javascript">
			$(document).ready(function() {
				var dataString = 'result_status=one_way&actionfunction=showData' + '&page=1';
				$("#loaderID").css("opacity", 1);
				$("#loaderID").css("z-index", 9999);
				$.ajax({
					url: "dbmanupulate1",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$("#loaderID").css("opacity", 0);
						$("#loaderID").css("z-index", -1);
						$('#pagination').html(response);
					}
				});
				$('#pagination').on('click', '.page-numbers', function() {
					$("#loaderID").css("opacity", 1);
					$("#loaderID").css("z-index", 9999);
					$page = $(this).attr('href');
					$pageind = $page.indexOf('page=');
					$page = $page.substring(($pageind + 5));
					var dataString = 'result_status=one_way&actionfunction=showData' + '&page=' + $page;
					$.ajax({
						url: "dbmanupulate1",
						type: "POST",
						data: dataString,
						cache: false,
						success: function(response) {
							$("#loaderID").css("opacity", 0);
							$("#loaderID").css("z-index", -1);
							$('#pagination').html(response);
						}
					});
					return false;
				});
			});
		</script>  
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  