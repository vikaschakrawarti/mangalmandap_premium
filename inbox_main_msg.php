<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once 'auth.php';
include_once './class/Config.class.php';
$configObj = new Config();
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
$select="select * from payment_view where pmatri_id='$mid'";
$exe=$DatabaseCo->dbLink->query($select) or die(mysqli_error($DatabaseCo->dbLink));
$fetch=mysqli_fetch_array($exe);
$total_msg=$fetch['p_msg'];
$used_msg=$fetch['r_sms'];
$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');
$get_msg_id=$_GET['msg_id'];
$DatabaseCo->dbLink->query("update messages set msg_read_status='Yes' where mes_id='$get_msg_id'");
$sel_msg_data=$DatabaseCo->dbLink->query("select * from messages where mes_id='$get_msg_id'") or die(mysqli_error($DatabaseCo->dbLink));
$get_msg_data=mysqli_fetch_object($sel_msg_data);
if(isset($_GET['inb']) && $_GET['inb']=='1')
{
$from_email_id = $get_msg_data->from_id;
}
if(isset($_GET['sent']) || isset($_GET['draft']) || isset($_GET['trash']) || isset($_GET['imp']))
{
$from_email_id = $get_msg_data->to_id;
}
if($from_email_id!='admin')
{
$msg_reg_nm = $DatabaseCo->dbLink->query("select matri_id,username,gender,photo1,photo1_approve,photo_protect,photo_view_status,photo_pswd,firstname,lastname from register where matri_id='".$from_email_id."'");
$Row = mysqli_fetch_object($msg_reg_nm);
}
else
{
$Row='';	
}
if(isset($_GET['inb']))
{
$backurl='inboxMessages';
$backtooltip='Inbox';	
$del_var='&inb=1';
}
elseif(isset($_GET['sent']))
{
$backurl='sentMessages';
$backtooltip='Sent';
$del_var='&sent=1';
}
elseif(isset($_GET['draft']))
{
$backurl='draft_msg';
$backtooltip='Draft Message';
$del_var='&draft=1';
}
elseif(isset($_GET['trash']))
{
$backurl='trashMessages';
$backtooltip='Trash Message';
$del_var='&trash=1';
}
elseif(isset($_GET['imp']))
{
$backurl='importantMessages';
$backtooltip='Important';
$del_var='&imp=1';
}
if(isset($_GET['del']))
{
if($_GET['inb']){
$DatabaseCo->dbLink->query("update messages set trash_receiver='Yes' where mes_id='".$_GET['msg_id']."'");		
}
else{
$DatabaseCo->dbLink->query("update messages set trash_sender='Yes' where mes_id='".$_GET['msg_id']."'");	
}
echo "<script>alert('Messages Deleted Succcessfully.');
window.location='".$backurl."';</script>";
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
        
        <!-- Owl Carousel CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
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
          					<div class="col-xxl-13 col-xxl-offset-3 col-xl-13 col-xl-offset-3 text-center">
            					<h2 class="inPageTitle fontMerriWeather inThemeOrange mb-30">
              						<span class="gt-font-weight-300"><?php echo $lang['Message']; ?></span> - <?php echo $backtooltip;?>
            					</h2>
          					</div>
          					<?php include('parts/msg_left_menu.php');?>
          					<div class="col-xxl-13 col-xl-12 col-xs-16 col-md-16 col-lg-12 col-sm-16 gt-msg-board inMessageFull">
								<div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16 col-lg-16 gt-msg-top-strip">
									<div class="row">
										<div class="col-xxl-4 col-xs-6 col-sm-6 col-md-4 gt-margin-bottom-5">
									 		<a href="<?php echo $backurl;?>" class="btn btn-default btn-block">
												<i class="fa fa-angle-left"></i>
												<span class="gt-margin-left-10"><?php echo $lang['Back To']; ?> 
												  <?php echo $backtooltip;?>
												</span>
									  		</a>
										</div>
										<div class="dropdown col-xxl-3 col-xs-10 col-sm-12 col-md-8 gt-margin-bottom-5 pull-right">
									  		<div class="btn-group text-right">
												<a class="btn btn-default" href="composeMessages?msg_id=<?php echo $_GET['msg_id'];echo $del_var;?>">
										  			<i class="fa fa-reply"></i><span class="gt-margin-left-10"><?php echo $lang['Reply']; ?></span>
												</a>
												<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  			<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<?php if($total_msg-$used_msg>0 && $exp_date > $today){
														if($from_email_id!='admin'){
													?>
													<li>
														<a href="composeMessages?msg_id=<?php echo $_GET['msg_id'];echo $del_var;?>">
															<i class="fa fa-reply"></i>
															<span class="gt-margin-left-10"><?php echo $lang['Reply']; ?></span>
														</a>
													</li>
													<li>
														<a href="composeMessages?msg_id=<?php echo $_GET['msg_id'];?>&frwd=1">
															<i class="fa fa-share"></i>
															<span class="gt-margin-left-10"><?php echo $lang['Forward']; ?></span>
														</a>
													</li>
													<?php } } ?>
													<?php if(!isset($_GET['trash'])){?>
													<li>
														<a href="?msg_id=<?php echo $_GET['msg_id'].$del_var.'&del=1';?>">
															<i class="fa fa-trash"></i>
															<span class="gt-margin-left-10"><?php echo $lang['Delete']; ?></span>
														</a>
													</li>
													<?php }?>
												</ul>
									  		</div>
										</div>   
								  	</div>
								</div>
            					<div class="col-xs-16 col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16 gt-read-msg-dash">
              						<div class="row inBorderExtraLightGrey pb-10">
                						<a href="">
                  							<div class="col-xxl-2 col-xl-2 col-xs-5 col-sm-5 col-md-4">
                    							<?php include('parts/search-result-photo.php');?>
                  							</div>
                  							<div class="col-xxl-6 col-xl-8 col-xs-11 col-md-12 col-sm-11">
                    							<h5 class="gt-margin-bottom-5 font-13 mb-5">
                     								<?php if(isset($_GET['sent'])!=''){ ?><?php echo $lang['To']; ?>,
                    								<?php }else{?>
                    									<?php echo $lang['From']; ?> :
                    								<?php }?>
                    							</h5>
                    							<h4 class="gt-margin-top-0 inThemeOrange">
													<?php if($username_settings->username_setting == 'full_username'){?>
														  <?php echo $Row->username; ?>
													<?php }elseif($username_settings->username_setting == 'first_surname'){?>
														 <?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>
													<?php }else{ ?>
													<?php } ?>
													<small class="gt-margin-left-5 text-muted">( 
														<?php 
															if($from_email_id!='admin'){
																echo $Row->matri_id;
															}else{
																echo "Admin";  
															}
														?> )
													</small>
                    							</h4>
                  							</div>
                						</a>
                						<div class="col-xxl-8 col-xl-6 col-xs-16 col-md-16 col-lg-16 text-right">
                  							<h4 class="gt-margin-top-25 font-14">
                   								<?php if(isset($_GET['sent'])!=''){ ?>
                    								<?php echo $lang['Sent on']; ?> :
                   	 							<?php }else{?>
                    								<?php echo $lang['Received on']; ?> :
                    							<?php }?> 
												<span class="">
												  <?php echo date('d M Y ,H:i A', strtotime($get_msg_data->sent_date)); ?>
												</span>
                  							</h4>
                						</div>
              						</div>
								  	<div class="row gt-margin-top-15">
										<h4 class="col-xxl-16 fontMerriWeather inThemeOrange"><?php echo $lang['Message']; ?></h4>
										<div class="col-xxl-16">
									  		<p><?php echo htmlspecialchars_decode($get_msg_data->message);?></p>
										</div>
								  	</div>
           			 			</div>
            					<div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16 gt-msg-top-strip gt-margin-top-15">
              						<div class="row">
										<?php 
											if($from_email_id!='admin'){
												if($total_msg-$used_msg>0 && $exp_date > $today){
										?>
										<div class="col-xxl-3 pull-right">
											<a href="composeMessages?msg_id=<?php echo $_GET['msg_id'];?>&frwd=1" class="btn btn-default btn-block">
												<i class="fa fa-share"></i>
												<span class="gt-margin-left-5"><?php echo $lang['Forward']; ?></span>
											</a>
										</div>
										<div class="col-xxl-3 gt-margin-bottom-5 pull-right">
											<a href="composeMessages?msg_id=<?php echo $_GET['msg_id'];echo $del_var;?>" class="btn gt-btn-orange btn-block">
												<i class="fa fa-reply"></i>
												<span class="gt-margin-left-5"><?php echo $lang['Reply']; ?></span>
											</a>
										</div>  
										<?php } }?>	 
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
    		<script>
      			$('[data-toggle="popover"]').popover({
        			trigger: 'click',
        			'placement': 'top'
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
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
