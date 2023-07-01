<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
	include 'auth.php';
	$sel_own_data = $DatabaseCo->dbLink->query("SELECT photo1,gender,username FROM register_view WHERE matri_id='$mid'");
	$get_own_data = mysqli_fetch_object($sel_own_data);
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

        <!--GOOGLE FONTS-->
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
							<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 text-center mb-10">
								<h2 class="inPageTitle fontMerriWeather inThemeOrange"><?php echo $lang['Saved Searches']; ?></h2>
								<p class="inPageSubTitle"><?php echo $lang['All saved searches are here, with single button click you can search profile on behalf of your search criteria']; ?>.</p>
							</div>
							
						</div>
					</div>
    				<div class="container gt-view-profile">
    					<div class="row">
        					<div class="col-xxl-3 col-xl-4 col-xs-16 col-sm-16">
								<!-- left option visible only in small-->
								<?php include_once('parts/view_profile_left_side.php'); ?>
                                <?php include_once('parts/level-1.php'); ?>
								<!--  left option visible only in small end-->
            				</div>
        					<div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16">
            					<div class="row">
									<?php
										$sel_save_count =mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM save_search WHERE matri_id='".$_SESSION['user_id']."'"));
										if($sel_save_count > 0){
											$sel_save_search = $DatabaseCo->dbLink->query("SELECT * FROM save_search WHERE matri_id='".$_SESSION['user_id']."'");
											while($get_ss_data = mysqli_fetch_object($sel_save_search)){
									?>
									<div class="col-xxl-8 col-xl-8 col-sm-16 col-md-16 col-xs-16 col-lg-8 mb-30" id="remove<?php echo $get_ss_data->ss_id;?>">
										<div class="gt-saved-search-bucket">
											<h3 class="gt-margin-top-10">
												<span class="pull-left fontMerriWeather inThemeGreen"><?php echo $get_ss_data->ss_name;?></span>
												<a class="pull-right gt-cursor inThemeGreen" onClick="del_ss(<?php echo $get_ss_data->ss_id;?>);"><i class="fa fa-trash"></i></a>
											</h3>
											<div class="clearfix"></div>
											<h5>
												<i class="fas fa-calendar-alt gt-margin-right-5"></i><?php echo date('d M Y ,H:i A', strtotime($get_ss_data->save_date)); ?>
											</h5>
											<a href="search_result.php?ss_id=<?php echo$get_ss_data->ss_id; ?>" class="btn gt-btn-orange"><?php echo $lang['Search']; ?></a>
										</div>
									</div>
                    				<?php } } else { ?>
                    				<div class="col-xs-16">
									   <div class="thumbnail">
										   <img src="img/nodata-available.jpg" class="img-responsive">
									   </div>
                    				</div>
				  					<?php  } ?>
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
		<!-- Mobile Side Panel Collapse -->
		<script>
			(function($) {
    			var $window = $(window),
        			$html = $('.mobile-collapse');
					$window.width(function width(){
        				if ($window.width() > 991) {
            				return $html.addClass('in');
        				}
						$html.removeClass('in');
    				});
			})(jQuery);
		</script>
		<!-- Delete Saved Search -->
    	<script>
	  		function del_ss(ss_id){
			$.ajax({
					type: "POST",
					url: "delete_ss_query",
					data: 'ss_id='+ss_id,
					success: function(data){
						$('#remove'+ss_id+'').fadeOut('slow');
					}
				});
			}
    	</script>
  	</body>
</html>
<?php include'thumbnailjs.php';?>
