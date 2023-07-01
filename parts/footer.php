<?php
	$menu_settings = $DatabaseCo->dbLink->query("SELECT footer_contact,footer_faq,footer_refund,footer_terms,footer_policy,footer_report,footer_login,footer_register,footer_membership,footer_success,footer_about,footer_about_short FROM menu_settings WHERE menu_id=1");
	$row_menu=mysqli_fetch_object($menu_settings);
?>
<div class="container gt-margin-top-10">
	<?php include('level-3.php');?>
</div>
<!-- Footer -->
<footer class="footer-before-login gt-margin-top-25">
   <div class="container">
	  <div class="row">
		 <?php if($row_menu->footer_contact == 'APPROVED' || $row_menu->footer_faq == 'APPROVED' || $row_menu->footer_refund == 'APPROVED'){ ?>
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green gt-font-weight-600">
				<?php echo $lang['Help And Support']; ?>
            </h5>
 			<ul class="">
				<?php if($row_menu->footer_contact == 'APPROVED'){ ?>
				<li><a href="contactUs.php"><?php echo $lang['Contact Us']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_faq == 'APPROVED'){ ?>
				<li><a href="cms?cms_id=13"><?php echo $lang['FAQ']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_refund == 'APPROVED'){ ?>
				<li><a href="cms?cms_id=16"><?php echo $lang['Refund Policy']; ?></a></li>
				<?php } ?>
			</ul>
		 </div>
		 <?php } ?>
		 <?php if($row_menu->footer_terms == 'APPROVED' || $row_menu->footer_policy == 'APPROVED' || $row_menu->footer_report == 'APPROVED'){ ?>
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green gt-font-weight-600">
				<?php echo $lang['Terms & Policy']; ?>
			</h5>
			<ul class="">
				<?php if($row_menu->footer_terms == 'APPROVED'){ ?>
				<li><a href="cms?cms_id=7"><?php echo $lang['Terms & Conditions']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_policy == 'APPROVED'){ ?>
			 	<li><a href="cms?cms_id=6"><?php echo $lang['Privacy Policy']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_report == 'APPROVED'){ ?>
				<li><a href="cms?cms_id=15"><?php echo $lang['Report Misuse']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		<?php if($row_menu->footer_login == 'APPROVED' || $row_menu->footer_register == 'APPROVED' || $row_menu->footer_membership == 'APPROVED'){ ?>
		<div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green gt-font-weight-600">
				<?php echo $lang['Need Help?']; ?>
			</h5>
			<ul class="">
            	<?php if (!isset($_SESSION['user_id'])) { ?>
				<?php if($row_menu->footer_login == 'APPROVED'){ ?>
            	<li><a href="login"><?php echo $lang['Login']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_register == 'APPROVED'){ ?>
 				<li><a href="index"><?php echo $lang['Register']; ?></a></li>
				<?php } ?>
                <?php } ?>
				<?php if($row_menu->footer_membership == 'APPROVED'){ ?>
 				<li><a href="membershipplans"><i class="fa fa-star gt-text-orange"></i> <?php echo $lang['Upgrade Membership']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		<?php if($row_menu->footer_success == 'APPROVED' || $row_menu->footer_about == 'APPROVED' ){ ?>
		<div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green gt-font-weight-600">
				<?php echo $lang['Information']; ?>
			</h5>
			<ul class="">
				<?php if($row_menu->footer_success == 'APPROVED'){ ?>
				<li><a href="success-story"><?php echo $lang['Success Story']; ?></a></li>
				<?php } ?>
				<?php if($row_menu->footer_about == 'APPROVED'){ ?>
				<li><a href="cms?cms_id=8"><?php echo $lang['About Us']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
      </div>
      <div class="row">
		  <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-16">
			<?php if($row_menu->footer_about_short == 'APPROVED'){ ?>
			<h5 class="gt-text-green gt-font-weight-600"><?php echo $lang['About Us']; ?></h5>
            <p><?php echo $configObj->getConfigFshortDescription(); ?></p>
			<?php } ?>
		  </div>
		  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-16 text-center">
				<h5 class="gt-text-green gt-font-weight-600">
                    <?php echo $lang['Join us on social']; ?>
                </h5>
				<?php
					$get_soc_icon=mysqli_fetch_object($DatabaseCo->dbLink->query("select facebook,twitter,linkedin,google,google_analytics_code from site_config where id='1'"));	
				?>
                <ul class="gt-footer-social">
                   <li><a href="<?php echo $get_soc_icon->facebook;?>" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
				   <li><a href="<?php echo $get_soc_icon->google;?>" target="_blank"><i class="fab fa-pinterest-square"></i></a></li>
                   <li><a href="<?php echo $get_soc_icon->twitter;?>" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
				   <li><a href="<?php echo $get_soc_icon->linkedin;?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
 				</ul>
		  </div>
	   </div>   
   </div>
</footer>
<div class="container-fluid gt-footer-bottom">
  	<div class="row">
  		<div class="container text-center">
        	<?php echo $lang['All Rights Reserved By']; ?> @ <a href="<?php echo $configObj->getConfigName();?>"><?php echo $configObj->getConfigFooter();?></a>
        </div>
    </div>
</div>
<!--/. Footer -->
<a href="#selectLanguage" class="btn fixLangugeBtn" data-toggle="modal" style=""><i class="fas fa-language gt-margin-right-5"></i><span>Change language</span></a>
<div class="modal fade gtLogModal" id="selectLanguage" tabindex="-1" role="dialog" aria-labelledby="selectLanguage" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="col-12">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['Select your language']; ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-16">
                        <div class="list-group">
                            <a href="index.php?lang=en" class="list-group-item list-group-item-action">English</a>
                            <a href="index.php?lang=hi" class="list-group-item list-group-item-action">हिंदी</a>
				            <a href="index.php?lang=te" class="list-group-item list-group-item-action">తెలుగు</a>
				            <a href="index.php?lang=mr" class="list-group-item list-group-item-action">मराठी</a>
				            <a href="index.php?lang=ta" class="list-group-item list-group-item-action">தமிழ்</a>
                            <a href="index.php?lang=kn" class="list-group-item list-group-item-action">ಕನ್ನಡ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login With OTP Modal  -->
<div class="modal fade" id="loginWithOTP" tabindex="-1" role="dialog" aria-labelledby="loginWithOTPLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="loginWithOTPLabel"><?php echo $lang['Login With OTP']; ?></h5>
            </div>
            <div class="modal-body">
                <form class="" action="login-with-otp" method="post">
                    <div class="form-group">
                        <label><?php echo $lang['Email/Mobile No/Matri id']; ?></label>
                        <input type="text" name="userId" class="gt-form-control" placeholder="<?php echo $lang['Enter Email id / Mobile No / Matri Id']; ?>">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="<?php echo $lang['GET OTP']; ?>" class="btn gt-btn-green">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Right Click Disable -->
<!--
<script language=JavaScript>
	function clickIE4(){
		if (event.button==2){
			return false;
		}
	}
	function clickNS4(e){
		if (document.layers||document.getElementById&&!document.all){
			if (e.which==2||e.which==3){
				return false;
			}
		}
	}
	if (document.layers){
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown=clickNS4;
	}else if (document.all&&!document.getElementById){
		document.onmousedown=clickIE4;
	}
	document.oncontextmenu=new Function("return false")
</script>
-->
<!-- /.Right Click Disable -->

<!-- Live Chat -->
<script type="text/javascript">
	var auto_refresh = setInterval(
		function (){
			$('#count').load('parts/online').fadeIn("slow");
		},15000 
	); // refresh every 10 second
</script>
<script src="js/jquery.min.js"></script>
<small class="pull-right">
    <?php
        $mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
        $select=$DatabaseCo->dbLink->query("SELECT * FROM payments WHERE pmatri_id='$mid'");
        $fetch=mysqli_fetch_object($select);
        if(isset($fetch->exp_date)){
            $exp_date=$fetch->exp_date;
        }else{
            $exp_date="";
        }
        
        $today= date('Y-m-d');
	    if(isset($_SESSION['user_id']) && $_SERVER['PHP_SELF']!='/memprofile.php'){
    ?>
    <link rel="stylesheet" type="text/css" href="who-is-online/widget.css" />
    <script type="text/javascript" src="who-is-online/widget.js"></script>
    <div class="onlineWidget">
	    <div class="channel">
            <img class="preloader" src="who-is-online/img/preloader.gif" alt="Loading.." width="22" height="22" />
        </div>
	    <div class="count" id="count"></div>
        <div class="label">online member</div>
        <div class="arrow"></div>
    </div>
<?php } ?>
</small>
<!-- /. Live Chat -->

<!-- Analytic Code -->
<?php $google = mysqli_fetch_object($DatabaseCo->dbLink->query("select google_analytics_code from site_config where id='1'")); ?>
<script>
	var id = '<?php echo $google->google_analytics_code; ?>';
  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', id, 'auto');
  	ga('send', 'pageview');
</script>
<!-- /.Analytic Code -->


 