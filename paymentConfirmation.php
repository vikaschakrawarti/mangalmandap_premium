<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	if(isset($_REQUEST['razorpay_payment_id']) != '' ){
		if(isset($_SESSION['user_id']) && isset($_SESSION['session_plan_id'])){
			$userid=$_SESSION['user_id'];
			$plan_id=$_SESSION['session_plan_id'];
			if($userid!=''){
				$get_gata=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT register.matri_id,register.email,register.mobile,register.username,register.franchies_id,register.address,membership_plan.plan_name,membership_plan.plan_duration,membership_plan.profile,membership_plan.chat,membership_plan.plan_contacts,membership_plan.plan_msg,membership_plan.plan_amount,membership_plan.plan_amount_type from register,membership_plan WHERE register.matri_id='$userid' AND membership_plan.plan_id='$plan_id'"));
				$pmatri_id=$get_gata->matri_id;
				$pname=$get_gata->username;
				$pemail=$get_gata->email;
				$paddress=$get_gata->address;
				$paymode='Online Payment';
				$today1 = strtotime ('now');
				$today=date("Y-m-d",$today1);
				$pactive_dt=$today;
				$p_plan=$get_gata->plan_name;
				$plan_duration=$get_gata->plan_duration;
				$profile=$get_gata->profile;
				$franchies_id=$get_gata->franchies_id;
				$chat=$get_gata->chat;
				$p_no_contacts=$get_gata->plan_contacts;
				$p_amount=$get_gata->plan_amount_type.' '.$get_gata->plan_amount;
				$p_bank_detail='';
				$p_msg=$get_gata->plan_msg;
				$date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
				$exp_date=date('Y-m-d', $date);
				$pay_id=$plan_id;
				$DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id='".$pmatri_id."'");
				$sql=$DatabaseCo->dbLink->query("INSERT INTO payments(pmatri_id,pname,pemail,paddress, paymode,pactive_dt,p_plan,plan_duration,profile,chat,p_no_contacts, p_amount,p_bank_detail,pay_id,p_msg,exp_date) VALUES('$pmatri_id','$pname','$pemail','$paddress','$paymode','$pactive_dt','$p_plan','$plan_duration','$profile','$chat','$p_no_contacts','$p_amount','$p_bank_detail','$pay_id','$p_msg','$exp_date')");
				/*	if(isset($franchies_id) != ''){	
				    $franchisee_qry=$DatabaseCo->dbLink->query("SELECT * FROM franchies WHERE id='$franchies_id' ");
					$get_franchise=mysqli_fetch_object($franchisee_qry);
				    $commission=$get_franchise->commission;
			        $amount = $get_gata->plan_amount;
					$franchisee_commission = ($commission / 100) * $amount;
					$DatabaseCo->dbLink->query("UPDATE register SET franchisee_amount='$franchisee_commission' WHERE matri_id='$userid'");
				}*/
				$DatabaseCo->dbLink->query("UPDATE register SET status='Paid' WHERE matri_id='$userid'");
                $_SESSION['mem_status'] = 'Paid';
			}
		}
		$status='success';
		$getnew_data=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payments WHERE pmatri_id='".$_SESSION['user_id']."'"));
	}else{
		$status='fail';
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
					<?php if($status == 'success'){?>
					<div class="container gt-margin-top-20">
						<div class="alert alert-success clearfix" role="alert">
							<h2 class="text-center inPageTitle fontMerriWeather inThemeGreen"><?php echo $lang['Congratulations']; ?> !</h2>
							<h5 class="text-center inPageSubTitle">
								<?php echo $lang['You are our paid member now.You can access our membership benifits now']; ?>.
							</h5>
							<div class="col-xxl-16 col-xl-16 text-center gt-margin-top-10 gt-margin-bottom-20">
								<a href="myHome" class="btn gt-btn-green inBtnTheme-2">
									<?php echo $lang['Go To Home']; ?>
								</a>
							</div>    
						</div>
						<div class="col-xxl-12 col-xxl-offset-2 col-xl-12 col-xl-offset-2 col-xs-16 well well-sm flat">
							<div class="col-xxl-8 col-xl-8">
								<h3 class="gt-text-orange"><?php echo $lang['Your Selected Plan']; ?></h3>
								<h4><?php echo $getnew_data->p_plan;?></h4>
							</div>
							<div class="col-xxl-8 col-xl-8">
								<h3 class="gt-text-orange"><?php echo $lang['Duration']; ?></h3>
								<h4><?php echo $getnew_data->plan_duration.' Days';?></h4>
							</div>
						</div>
					</div>
					<?php } if($status == 'fail'){ ?>
					<div class="container gt-margin-top-20">
						<div class="alert clearfix inPaymentFail" role="alert">
							<h2 class="text-center inPageTitle fontMerriWeather inThemeRed"><?php echo $lang['Payment Not Successful']; ?> !</h2>
							<h5 class="text-center inPageSubTitle">
								<?php echo $lang['Payment not successful.If payment is debited please contact us']; ?>.
							</h5>
							<div class="col-xxl-16 col-xl-16 text-center gt-margin-top-10 gt-margin-bottom-20">
								<a href="myHome" class="btn gt-btn-green inBtnTheme-2">
									<?php echo $lang['Go To Home']; ?>
								</a>
							</div>    
						</div>
					</div>
					<?php } ?>
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