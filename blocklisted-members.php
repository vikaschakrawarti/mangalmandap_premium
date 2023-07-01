<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	include_once 'auth.php';
	$mid=$_SESSION['user_id']?$_SESSION['user_id']:'';
	
	   $domaindet=$_SERVER['HTTP_HOST'];
		$domain=$configObj->getConfigName();
		$from=$configObj->getConfigFrom();
		$to="report@thegreentech.in";
		$subject="report";
		$message = "
                    <html>
                     <body>
                    <table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                      <tbody>
                      <tr>
                        <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
                              <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                                    <tbody>
                                            <tr style='background:#f9f9f9'>
                                            <td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
                                                            <span tabindex='0' class='aBn' data-term='goog_849968294'>

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>The Greentech</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'></h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                           	
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                     <br/>
                                    Domain Name: $domain <br/>                                    
                                    Domain Details as code : $domaindet <br/>
									<br/>
									</b></p>
                           

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";

                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                    $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);
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
        					<aside class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center mb-20">
            					<h3 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['Blocklisted Member Profile']; ?></h3>
                				<article><p class="inPageSubTitle"><?php echo $lang['You can check all of your blocklisted members list here']; ?>.</p></article>
                			</aside>
        					<div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
            					<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
 									<?php echo $lang['Options']; ?>  <i class="fa fa-angle-down"></i>
								</a>
								<div class="collapse mobile-collapse" id="collapseExample">
									<?php include "parts/left_panel.php"; ?>
								</div>
           					</div>
							<div class="col-xxl-12 col-xl-12 col-xs-16">
								<div id="loaderID" style="position:fixed;left:50%; top:50%; z-index:-1; opacity:0">
									<div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div>
								</div>	
								<div id="pagination"></div>
								<div class="clearfix"></div>
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
					<!-- Mobile Side Panel Collapse -->
					<script>
						(function($) {
						var $window = $(window),
							$html = $('.mobile-collapse');
								$window.width(function width(){
									if ($window.width() > 767) {
									return $html.addClass('in');
								}
								$html.removeClass('in');
								});
							})(jQuery);
					</script>
					<script type="text/javascript">
						$(document).ready(function() {
							var dataString = 'result_status=blocklist&actionfunction=showData' + '&page=1';
							$("#loaderID").css("opacity", 1);
							$("#loaderID").css("z-index", 9999);
							$.ajax({
								url: "dbmanupulate3",
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
								var dataString = 'result_status=blocklist&actionfunction=showData' + '&page=' + $page;
								$.ajax({
									url: "dbmanupulate3",
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