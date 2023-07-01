<?php
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();
    $menu_settings = $DatabaseCo->dbLink->query("SELECT menu_search,menu_success,menu_membership,menu_contact,menu_login,menu_signup FROM menu_settings WHERE menu_id=1");
	$row_menu=mysqli_fetch_object($menu_settings);

    $android_settings = $DatabaseCo->dbLink->query("SELECT android_app,android_app_link FROM site_config WHERE id=1");
	$row_android=mysqli_fetch_object($android_settings);

    $SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
    $username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
    
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
        
        <!-- Owl Carousel CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
       
        <!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
     	
        <!-- Angular JS-->
        <script src="js/angular.min.js"></script>

        <!-- Birthdate JS -->
        <script type="text/javascript">
            var numDays = {'01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31};
            function setDays(oMonthSel, oDaysSel, oYearSel)
            {
                var nDays, oDaysSelLgth, opt, i = 1;
                nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
                if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
                    ++nDays;
                oDaysSelLgth = oDaysSel.length;
                if (nDays != oDaysSelLgth) {
                    if (nDays < oDaysSelLgth)
                        oDaysSel.length = nDays;
                    else
                        for (i; i < nDays - oDaysSelLgth + 1; i++) {
                            opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
                            oDaysSel.options[oDaysSel.length] = opt;
                        }
                }
                var oForm = oMonthSel.form;
                var month = oMonthSel.options[oMonthSel.selectedIndex].value;
                var day = oDaysSel.options[oDaysSel.selectedIndex].value;
                var year = oYearSel.options[oYearSel.selectedIndex].value;
            }
        </script>
    </head>
    <body ng-app class="ng-scope">
        <!-- Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="loader"></div>
            <h5>Loading...</h5>
        </div>
        <!-- /.Loader -->
        <div id="body" style="display:none">
            <div id="wrap">
                <div id="main">
                    <!-- Email id Verification -->
                    <?php include("parts/email_verification.php"); ?>
                    <!-- /.Email id Verification -->
                    <!-- Header & Menu -->
                    <nav class="navbar inPrem2Nav">
                        
                        <div class="container">
                            <a class="navbar-brand " href="index">
                                <img src="img/<?php echo $configObj->getConfigLogo(); ?>" class="img-responsive gt-header-logo">
                            </a>
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <!--<ul class="nav navbar-nav navbar-left inPrem2Logo hidden-xs hidden-sm hidden-md">
                                    <li>
                                        <a href="index" class="ripplelink">
                                            <img src="img/<?php echo $configObj->getConfigLogo(); ?>" class="img-responsive gt-header-logo">
                                        </a>
                                    </li>
                                </ul>-->

                                <ul class="nav navbar-nav navbar-right">
                                    <li class="active ripplelink"><a href="index.php" class="inPrem2Link"><?php echo $lang['Home']; ?></a></li>
                                    <?php if($row_menu->menu_search == 'APPROVED'){ ?>
                                    <li class="dropdown">
                                        <a href="search.php" class="dropdown-toggle ripplelink inPrem2Link" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="mr-5"><?php echo $lang['Search']; ?></span><span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu flat" role="menu">
                                            <li><a href="search?gt-quick-search"><?php echo $lang['Quick Search']; ?></a></li>
                                            <li><a href="search?gt-basic-search"><?php echo $lang['Basic Search']; ?></a></li>
                                            <li><a href="search?gt-advance-search"><?php echo $lang['Advanced Search']; ?></a></li>
                                            <li><a href="search?gt-keyword-search"><?php echo $lang['Keyword Search']; ?></a></li>
                                            <li><a href="search?gt-location-search"><?php echo $lang['Location Search']; ?></a></li>
                                            <li><a href="search?gt-occupation-search"><?php echo $lang['Occupation Search']; ?></a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                    
                                    <!--<?php if($row_menu->menu_success == 'APPROVED'){ ?>
                                        <li class="ripplelink"><a href="success-story.php"><i class="fas fa-users mr-10 fa-lg"></i><?php echo $lang['Success Story']; ?></a></li>
                                    <?php } ?>-->

                                    <?php if($row_menu->menu_membership == 'APPROVED'){ ?>
                                        <li class="ripplelink"><a href="membershipplans.php" class="inPrem2Link"><?php echo $lang['Membership']; ?></a></li>
                                    <?php } ?>

                                    <?php if($row_menu->menu_contact == 'APPROVED'){ ?>
                                        <li class="ripplelink"><a href="contactUs.php" class="inPrem2Link"><?php echo $lang['Contact Us']; ?></a></li>
                                    <?php } ?>
                                    <a href="login" class="btn gt-btn-green"><i class="fas fa-lock mr-10 font-15"></i><?php echo $lang['Login']; ?></a>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <?php // include "parts/header.php"; ?>
                    <?php //include "parts/menu.php"; ?>
                    <!-- /. Header & Menu -->
                    <div class="container-fluid">
                        <div class="row">
                        	<?php 
								$row_banner = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT banner1,banner2,banner3 FROM site_config WHERE id='1'"));
							?>
							<!-- Main Carousel -->
                            <div id="owl-demo-2" class="owl-carousel gt-slide-up">
								<?php 
									if($row_banner->banner1 !="" && file_exists('img/banners/'.$row_banner->banner1)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner1;?>" alt="banner-1">
                                </div>
								<?php 
									}
									if($row_banner->banner2 !="" && file_exists('img/banners/'.$row_banner->banner2)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner2; ?>" alt="banner-2">
                                </div>
								<?php 
									}
									if($row_banner->banner3 !="" && file_exists('img/banners/'.$row_banner->banner3)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner3;?>" alt="banner-3">
                                </div>
								<?php } ?>
                            </div>
                            <!-- /. Main Carousel -->
                            <div class="container gt-pad-lr-0-479">
                               
								<!-- Signup form -->
                                <div class="col-xxl-6 col-xxl-offset-10 col-xl-7 col-xl-offset-9 col-lg-16 gt-pad-lr-0-479">
								    <div class="gt-slideup-form">
								        <div class="gt-slideUp-form-head">
                                            <h4><?php echo $lang['REGISTER NOW']; ?></h4>
                                        </div>
                                        <div class="gt-slideUp-form-body">
                                            <form action="mobile-verification" id="frm" method="post" name="frm" onsubmit="return validateForm()">
                                                <div class="col-xxl-16 col-xl-16 form-group gt-index-collab">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                                                            <select class="gt-form-control form-1" name="profile_by" >
																<option value=""><?php echo $lang['Profile Created By']; ?></option>
																<?php 
                                                                    $SQL_STATEMENT_PROFILE_BY = $DatabaseCo->dbLink->query("SELECT * FROM profile_by WHERE status='APPROVED' ORDER BY id ASC");
                                                                    while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_PROFILE_BY)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" ><?php echo $DatabaseCo->dbRow->profile_by; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <select class="gt-form-control form-2" name="gender">
                                                                <option value=""><?php echo $lang['Select Gender']; ?></option>
																<option value="Female">Female</option>
                                                                <option value="Male">Male</option>
															</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group gt-index-collab">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            <input type="text" class="gt-form-control form-1" placeholder="<?php echo $lang['Enter First Name']; ?>" name="nickname" id="nickname" ng-maxlength="30" ng-model="user.name">
                                                            <span ng-show="frm.lastname.$dirty && frm.lastname.$error.maxlength" class="text-danger gt-margin-left-10">Name Is Too Long!</span>
                                                            <input type="text" class="gt-form-control form-2" placeholder="<?php echo $lang['Enter Last Name']; ?>" name="lastname" id="lastname" ng-maxlength="30" ng-model="user.lastname">
															<span ng-show="frm.nickname.$dirty && frm.nickname.$error.maxlength" class="text-danger gt-margin-left-10">Name Is Too Long !</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <div class="row">
                                                                <div class="col-xxl-4 col-xs-5 col-s-5 col-m-5 col-l-5">
                                                                    <select name="day" id="day" class="gt-form-control form-1" onchange="setDays(month, this, year)">
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-5 col-xs-6 col-s-6 col-m-6 col-l-6">
                                                                    <select name="month" id="month" class="gt-form-control" onchange="setDays(this, day, year)">
                                                                        <option value=""><?php echo $lang['Month']; ?></option>
                                                                        <option value="01">Jan</option>
                                                                        <option value="02">Feb</option>
                                                                        <option value="03">Mar</option>
                                                                        <option value="04">Apr</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">Jun</option>
                                                                        <option value="07">Jul</option>
                                                                        <option value="08">Aug</option>
                                                                        <option value="09">Sep</option>
                                                                        <option value="10">Oct</option>
                                                                        <option value="11">Nov</option>
                                                                        <option value="12">Dec</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-7 col-xs-5 col-s-5 col-m-5 col-l-5">
                                                                    <select name="year" id="year" class="gt-form-control" onchange="setDays(month, day, this)">
                                                                        <option value=""><?php echo $lang['Year']; ?></option>
                                                                    	<?php
																			$SQL_SITE_SETTING_BIRTHYEAR = $DatabaseCo->dbLink->query("SELECT birthyear FROM site_config WHERE id='1' ");
																			$birth_year_data = mysqli_fetch_object($SQL_SITE_SETTING_BIRTHYEAR);
																			$birth_year=$birth_year_data->birthyear;
																			for ($x = $birth_year; $x >= 1924; $x--) { ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                         <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-book fa-fw"></i></span>
                                                            <select class="gt-form-control flat chosen-single chosen-select" name="religion" id="religion">
                                                                <option value=""><?php echo $lang['Select Your Religion']; ?></option>
                                                                <?php
                                                                    $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                                                                    while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>">
                                                                    <?php echo $DatabaseCo->dbRow->religion_name; ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                            <div id="caste1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                                                           	<select class="gt-form-control chosen-single chosen-select" name="caste" id="caste" >
                                                                <option value=""><?php echo $lang['Select Religion First']; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group custom-chosen">
                                                            <span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
                                                            <select class="gt-form-control chosen-single chosen-select" name="m_tongue" id="m_tongue" >
                                                                <option value=""><?php echo $lang['Mother Tongue']; ?></option>
                                                                <?php
																	$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                                                	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>">
                                                                    <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
                                                                </option>
                                                               
                                                                <?php } ?>
                                                            </select>
                                                            <span class="f2">
																<select class="gt-form-control chosen-single chosen-select" name="country">
																	<option value=""><?php echo $lang['Country']; ?></option>
																	<?php
																		$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
																		while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
																	?>
																	<option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" ><?php echo $DatabaseCo->dbRow->country_name; ?></option>
																	<?php } ?>
																</select>
															</span>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                                            <div class="row">
                                                                <div class="col-xxl-5 col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                                    <select class="gt-form-control form-1" name="code" id="code" >
                                                                    <?php
																		$SQL_STATEMENT_code = $DatabaseCo->dbLink->query("SELECT * FROM country_code");
																		while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_code)) {
																	?>
																	<option value="+<?php echo $DatabaseCo->dbRow->phonecode; ?>" <?php if($DatabaseCo->dbRow->phonecode == "91"){ echo "selected";} ?> >+<?php echo $DatabaseCo->dbRow->phonecode; ?></option>
																	<?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-11 col-xs-11 col-sm-11 col-md-11 col-lg-12">
                                                                    <input type="number" class="gt-form-control" placeholder="<?php echo $lang['Enter Your 10 Digit No']; ?>" name="mobile" id="mobile" maxlength="10" ng-maxlength="10" ng-minlength="5" ng-model="user.mobile">
                                                                    <span ng-show="frm.mobile.$dirty && frm.mobile.$error.maxlength" class="text-danger">Mobile Number Is Too Long !</span>
                                                                    <span ng-show="frm.mobile.$dirty && frm.mobile.$error.minlength" class="text-danger">Mobile Number Is Too Short !</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fas fa-at fa-fw"></i></span>
                                                            <input type="email" class="gt-form-control form-1" placeholder="<?php echo $lang['Enter Your Email Id']; ?>" name="email" ng-model="user.email">
                                                            <span ng-show="frm.email.$dirty && frm.email.$error.email" class="text-danger gt-margin-left-10">Enter Valid Email Id !</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <label for="terms" class="inTerms">
                                                            <input type="checkbox" id="terms" name="chk_terms" checked data-validetta="required"><span class="gt-margin-left-10"><?php echo $lang['I accept']; ?> <a href="cms?cms_id=7" target="_blank"><?php echo $lang['terms & conditions']; ?></a> <?php echo $lang['and']; ?> <a href="cms?cms_id=6" target="_blank"><?php echo $lang['privacy policy']; ?></a></span>.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-xxl-16 text-center">
                                                        <button type="submit" class="btn gt-btn-green inIndexRegBtn" name="reg_sub"><?php echo $lang['Register Now']; ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
								    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <section class="inPrem2Search">
                        <div class="container">
                            <form method="post" action="search" id="">
                                <div class="col-xxl-2">
                                    <label>Looking For</label>
                                    <select class="gt-form-control" name="gender">
                                        <option value="Female">Bride</option>
                                        <option value="Male">Groom</option>
                                    </select>
                                </div>
                                <div class="col-xxl-5">
                                    <label>Age</label>
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <select class="gt-form-control" name="from_age" id="from_age">
                                                <option value="">Select Age From</option>
                                                <?php
                                                //Make 18 Year Selected for Search
                                                $selected_a='1';

                                                $SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
                                                ?>
                                                    <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 text-center mt-10"><?php echo $lang['To']; ?></div>
                                        <div class="col-xs-7">
                                            <select class="gt-form-control" name="to_age" id="part_to_age">
                                                <?php
                                                //Make 18 From & 30 To Year Selected for Search
                                                $selected_b='13';

                                                $SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
                                                ?>
                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if($DatabaseCo->dbRow->id <= $selected_a ){ echo 'disabled'; } if($selected_b == $DatabaseCo->dbRow->id ){ echo 'selected';	} ?>>
                                                    <?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                                <?php } ?>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <label><?php echo $lang['Religion']; ?></label>
                                    <select class="gt-form-control" id="religion_id" name="religion_id[]">
                                        <option>Religion</option>
                                        <?php
                                            $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                                        ?>
                                            <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" <?php if (isset($_SESSION['reg_religion']) && $_SESSION['reg_religion'] == $DatabaseCo->dbRow->religion_id) { echo "selected"; }?>>
                                                <?php echo $DatabaseCo->dbRow->religion_name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div id="CasteDivloader"></div>
                                </div>
                                <div class="col-xxl-3">
                                    <label><?php echo $lang['Caste']; ?></label>
                                    <select class="gt-form-control" tabindex="4" id="caste_id" name="caste_id[]">
                                        <option value="">Select Religion</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3">
                                    <input type="submit" value="Search Now" class="btn gt-btn-orange btn-block" name="quick_sub">
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </section>
                    <!-- Welcome Section -->
                    <section class="gt-bg-white">
                        <div class="container pb-50">
                            <h2 class="text-center inThemeOrange fontMerriWeather mt-50"><?php echo $configObj->getConfigWelcome(); ?></h2>
                            <p class="text-center inGrey500 indexContent">
                                <?php echo $lang['Best matrimony service provider in India.We find the best perfect life partner for you.join us now and']; ?><br><?php echo $lang['find your life partner from our thousand’s of verified profiles.']; ?>

                                
                            </p>

                            <div class="gt-hearts">
                                <div class="gt-hearts-group gt-bg-white">
                                    <i class="fa fa-heart font-20 heart gt-text-orange"></i>
                                    <i class="fa fa-heart font-38 heart gt-text-orange"></i>
                                    <i class="fa fa-heart font-20 heart gt-text-orange"></i>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-star index-color-1 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-24 inGrey500 gt-font-weight-600 fontMerriWeather">
                                            <?php echo $lang['Success Story']; ?>
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p>
                                                <?php echo $lang['Hundred’s of successful member found their soulmates with us.']; ?>
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="success-story" class="gt-text-Grey"><?php echo $lang['View Success Stories']; ?> <i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-users index-color-2 gt-index-icon-font tex"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-24 inGrey500 gt-font-weight-600 fontMerriWeather">
                                            <?php echo $lang['Verified Members']; ?>
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p class="font-13">
                                                <?php echo $lang['Thousands of verified member profile so our members find perfect partner without any concern.']; ?>
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="login" class="gt-text-Grey"><?php echo $lang['View Profiles Now']; ?><i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-search index-color-3 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-24 inGrey500 gt-font-weight-600 fontMerriWeather">
                                            <?php echo $lang['Search Options']; ?>
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p class="font-13">
                                                <?php echo $lang['Multiple search options to find partner who know you better.']; ?>
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="search" class="gt-text-Grey"><?php echo $lang['Search Now']; ?> <i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-list-ol index-color-4 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-24 inGrey500 gt-font-weight-600 fontMerriWeather">
                                            <?php echo $lang['Matching Profiles']; ?>
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p class="font-13">
                                                <?php echo $lang['With our auto match profile you can see members which was suits you best and get married.']; ?>
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="login" class="gt-text-Grey"><?php echo $lang['View Matches Now']; ?><i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /. Welcome Section -->
                    <div class="clearfix"></div>
					<!-- Featured Bride -->
                    <?php 
						$sel_fet_bride = $DatabaseCo->dbLink->query("SELECT matri_id,birthdate,username,country_name,city_name,photo_view_status,photo1_approve,photo1,photo_protect,photo_pswd,gender,firstname,lastname FROM register_view WHERE gender='Female' AND fstatus='Featured' ORDER BY rand() limit 0,9");
						if (mysqli_num_rows($sel_fet_bride) > 0) {
					?>
                	<section class="gt-bg-index-white">
                       <div class="container">
                            <h2 class="text-center gt-text-Grey fontMerriWeather mb-0 mt-0"><?php echo $lang['Featured Brides']; ?></h2>
                        	<p class="text-center gt-text-Grey">
                            	<?php echo $lang['This is our featured brides section where you can check our elite profiles.']; ?>
                            </p>
                        	<div class="gt-hearts">
                            	<div class="gt-hearts-group gt-bg-white">
                                    <i class="fa fa-heart font-20 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-38 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-20 heart gt-text-green"></i>
                            	</div>
                            </div>
                        	<div id="inFetBride" class="owl-carousel">
                    			<?php
									while ($Row = mysqli_fetch_object($sel_fet_bride)) {
                    			?>
                               	<a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" class="item text-center">
                                    <div class="thumbnail">
                                    	<?php include 'parts/search-result-photo.php';?>
                                    </div>
                                    <h4 class="inThemeGreen font-15">
                           	 			<?php if($username_settings->username_setting == 'full_username'){ ?>
                                        <?php echo $Row->username; ?>&nbsp;&nbsp;(<?php echo $Row->matri_id; ?>)
                                        <?php }elseif($username_settings->username_setting == 'first_surname'){?>
                                            <?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>(<?php echo $Row->matri_id; ?>)
                                        <?php }else{ ?>
                                        <?php echo $Row->matri_id; ?>
                                        <?php } ?>
                                    </h4>
                                    <p class="font-12 inGrey500 mb-0">
                            			<?php echo floor((time() - strtotime($Row->birthdate)) / 31556926) . ' Years'; ?>,<?php
                            				$a = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
                           					echo $a->edu_name;
                            			?>
                                    </p>
                                    <p class="font-12 inGrey500 mb-15">
                            			<?php
                            				if ($Row->city_name != '') {
                                				echo $Row->city_name;
                            				} else {
                                				echo "N/A";
                            				}
                            			?>,
										<?php echo $Row->country_name; ?>.
                                    </p>
                                    <span class="gt-btn-round gt-inline-block">
                                     <?php echo $lang['View Profile']; ?>
                                    </span>
                               </a>
                            	<?php }
         				} else {
                    ?>
                    <div class="col-xs-16">
                       <div class="" style="display:none;"></div>
                    </div>
                    <?php } ?>
                        </div>
                       </div>
                	</section>
					<div class="clearfix"></div>
                	<!-- /. Featured Bride -->
                  	
                    <!--- Featured Groom --->
                    <?php  
						$sel_fet_groom = $DatabaseCo->dbLink->query("SELECT matri_id,birthdate,username,country_name,city_name,photo_view_status,photo1_approve,photo1,photo_protect,photo_pswd,gender,firstname,lastname FROM register_view WHERE gender='Male' AND fstatus='Featured' ORDER BY rand() limit 0,9");
                    	if (mysqli_num_rows($sel_fet_groom) > 0) {
					?>
                    <section class="gt-bg-lgtGrey">
                   		<div class="container">
                            <h2 class="text-center gt-text-Grey fontMerriWeather mb-0 mt-0"><?php echo $lang['Featured Groom']; ?></h2>
                        	<p class="text-center gt-text-Grey">
                            	<?php echo $lang['This is our featured grooms section where you can check our elite profiles.']; ?>
                            </p>
                        	<div class="gt-hearts">
                            	<div class="gt-hearts-group">
                                    <i class="fa fa-heart font-20 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-38 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-20 heart gt-text-green"></i>
                            	</div>
                        	</div>
                        	<div id="inFetGroom" class="owl-carousel">
                    		<?php
                   				while ($Row = mysqli_fetch_object($sel_fet_groom)) {
                    		?>
                            <a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" class="item text-center">
                                    <div class="thumbnail">
                                    	<?php include 'parts/search-result-photo.php';?>
                                    </div>
                                    <h4 class="inThemeGreen font-15">
                           	 			<?php if($username_settings->username_setting == 'full_username'){ ?>
                                        <?php echo $Row->username; ?>&nbsp;&nbsp;(<?php echo $Row->matri_id; ?>)
                                        <?php }elseif($username_settings->username_setting == 'first_surname'){?>
                                            <?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>(<?php echo $Row->matri_id; ?>)
                                        <?php }else{ ?>
                                        <?php echo $Row->matri_id; ?>
                                        <?php } ?>
                                    </h4>
                                    <p class="font-12 inGrey500 mb-0">
                            			<?php echo floor((time() - strtotime($Row->birthdate)) / 31556926) . ' Years'; ?>,<?php
                            				$a = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
                           					echo $a->edu_name;
                            			?>
                                    </p>
                                    <p class="font-12 inGrey500 mb-15">
                            			<?php
                            				if ($Row->city_name != '') {
                                				echo $Row->city_name;
                            				} else {
                                				echo "N/A";
                            				}
                            			?>,
										<?php echo $Row->country_name; ?>.
                                    </p>
                                    <span class="gt-btn-round gt-inline-block">
                                      <?php echo $lang['View Profile']; ?>
                                    </span>
                               </a>
                            <?php } } else { ?>
                            <div class="col-xs-12">
                                <div class="" style="display:none;"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                	</section>
					<div class="clearfix"></div>
                	<!--- /. Featured Groom --->
                    <?php if($row_android->android_app == 'Yes'){ ?>
					<section class="gtAndroidDown">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-16">
                                    <div class="row">
                                        <div class="col-xxl-5 col-xxl-offset-2">
                                            <img src="img/android_app_showcase.png" class="img-responsive">
                                        </div>
                                        <div class="col-xxl-8 col-xxl-offset-1 gtAndroidDownDet">
                                            <h4>
                                                Download our mobile app & find<br>
                                                start searching your life partner<br>
                                                in a tap.
                                            </h4>
                                            <h1>
                                                Download App Now !
                                            </h1>
                                            <a href="<?php if($row_android->android_app_link != ''){ echo $row_android->android_app_link; }?>" target="_blank">
                                                <img src="img/google_play_download_btn.png" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
        <!-- Chosen Js -->
     	<script src="js/chosen.jquery.js" type="text/javascript"></script>
     	<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"100%"}
			}
			for (var selector in config) {
				$(selector).chosen(config[selector]);
			}
     	</script>
     	<!-- Validation Js -->
        <script type="text/javascript">
			function validateForm() {
				var a = document.forms["frm"]["profile_by"].value;
				if (a == "") {
					alert("Select Profile Created By");
					return false;
				}
				var b = document.forms["frm"]["gender"].value;
				if (b == "") {
					alert("Select Your Gender");
					return false;
				}
				var c = document.forms["frm"]["nickname"].value;
				if (c == "") {
					alert("First name must be filled out");
					return false;
				}
				var d = document.forms["frm"]["lastname"].value;
				if (c == "") {
					alert("Last name must be filled out");
					return false;
				}
				var g = document.forms["frm"]["day"].value;
				if (g == "") {
					alert("Please select your birthdate");
					return false;
				}
				var h = document.forms["frm"]["month"].value;
				if (h == "") {
					alert("Please select your birth month");
					return false;
				}
				var i = document.forms["frm"]["year"].value;
				if (i == "") {
					alert("Please select your birth year");
					return false;
				}
				var e = document.forms["frm"]["religion"].value;
				if (e == "") {
					alert("Please select religion");
					return false;
				}
				var f = document.forms["frm"]["caste"].value;
				if (f == "") {
					alert("Please select caste");
					return false;
				}
				var j = document.forms["frm"]["m_tongue"].value;
				if (j == "") {
					alert("Please select mother tongue");
					return false;
				}
				var k = document.forms["frm"]["country"].value;
				if (k == "") {
					alert("Please select country");
					return false;
				}
				var l = document.forms["frm"]["code"].value;
				if (l == "") {
					alert("Please select country code");
					return false;
				}
				var m = document.forms["frm"]["mobile"].value;
				if (m == "") {
					alert("Mobile must be filled out.");
					return false;
				}
				var n = document.forms["frm"]["email"].value;
				if (n == "") {
					alert("Email id must be filled out.");
					return false;
				}
			}
		</script>
        <!-- Validation js -->
        <script type="text/javascript" src="js/validetta.js"></script>
        <script>
            $(function(){
                $('#frm').validetta({
                    errorClose : false,
                    realTime : true
                });
            });
            $(function(){
                $('#quick-search').validetta({
                    errorClose : false,
                    realTime : true
                });
            });
        </script>
        <!-- Owl Carousel Js -->
        <script src="js/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#inFetBride").owlCarousel({
                    autoPlay: 3000,
                    items: 5,
                    navigation: true,
                    navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                    itemsDesktop: [1199, 5],
                    itemsDesktopSmall: [979, 4],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 2],
                        [700, 2],
                        [800, 3],
                        [1000, 5],
                        [1200, 5],
                        [1400, 5],
                        [1600, 5]
                    ],
                });
				$("#inFetGroom").owlCarousel({
                    autoPlay: 3000,
                    items: 5,
                    navigation: true,
                    navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                    itemsDesktop: [1199, 5],
                    itemsDesktopSmall: [979, 4],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 2],
                        [700, 2],
                        [800, 3],
                        [1000, 5],
                        [1200, 5],
                        [1400, 5],
                        [1600, 5]
                    ],
                });
				$("#owl-demo-2").owlCarousel({
                    autoPlay: 3000,
                    autoPlay:true,
                            items: 1,
                    itemsDesktop: [1199, 1],
                    itemsDesktopSmall: [979, 1],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 1],
                        [700, 1],
                        [1000, 1],
                        [1200, 1],
                        [1400, 1],
                        [1600, 1]
                    ],
                });
            });
        </script>
       	<script>
            $("#gtFetVendor").owlCarousel({
                items:3,
                loop:true,
                lazyLoad:true,
                margin:10,
                autoPlay:true,
                autoPlayTimeout:1000,
                autoPlayHoverPause:true,
                navigation:true,
                pagination:false,
                navigationText: ["<button type='button' class='btn gtBtnLeftRes'><i class='fas fa-chevron-left'></i></button>", "<button type='button' class='btn gtBtnRigRes'><i class='fas fa-chevron-right'></i></button>"],
            }); 
		</script>
        <!-- Caste Ajax -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#religion").on('change', function() {
                    $("#caste1").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
                    var id = $(this).val();
                    var dataString = 'religionId=' + id;
                    $.ajax({
                        type: "POST",
                        url: "ajax_search2",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#caste").html(html);
                            $("#caste1").html('');
							$("#caste").trigger("chosen:updated");
                        }
                    });
                });
                $("#religion_id").on('change', function(){
				    $("#CasteDivloader").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
                    var selectedReligion = $("#religion_id").val() 
					var dataString = 'religion='+ selectedReligion;
					jQuery.ajax({
						type: "POST", // HTTP method POST or GET
						url: "search_rel_caste", //Where to make Ajax calls
						dataType:"text", // Data type, HTML, json etc.
						data:dataString,			
						success:function(response){
							$("#caste_id").find('option').remove().end().append(response);
							$('#caste_id').trigger('chosen:updated');
							$("#CasteDivloader").html('');		
						},			
					});		
			     });
                $("#from_age").on('change', function() {
            	$("#Loadtoage").html('<div>Loading...</div>');
                var id = $(this).val();
                var dataString = 'id=' + id;
                $.ajax({
                	type: "POST",
                    url: "ajax-to-age-data",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                    	$("#part_to_age").html(html);
                        $("#Loadtoage").html('');
						$("#part_to_age").trigger("chosen:updated");
                   }
				});
            });
            });
        </script>
        <!-- Language select modal -->
    <?php if($_SESSION['lang'] == 'en_main'){?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#selectLanguage').modal('show');
        });
    </script>
    <?php } ?>
	</body>
</html>
<!-- Thumbnail Ajax -->
<?php include'thumbnailjs.php'; ?>
