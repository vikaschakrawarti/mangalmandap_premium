<?php
	$menu_settings = $DatabaseCo->dbLink->query("SELECT menu_search,menu_success,menu_membership,menu_contact,menu_login,menu_signup FROM menu_settings WHERE menu_id=1");
	$row_menu=mysqli_fetch_object($menu_settings);
?>
<?php if (isset($_SESSION['user_id'])) { ?>
    <!-- Menu after login -->
    <nav class="navbar gt-navbar-green flat mb-0">
        <div class="container">

            <!-- Mobile Menu Button -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:rgba(247,247,247,1.00);color:rgba(0,0,0,1.00) !important;">
                    <span><?php echo $lang['MENU']; ?></span>
                </button>
            </div>
            <!-- /. Mobile Menu Button -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active ripplelink"><a href="myHome"><?php echo $lang['My Home']; ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="mr-5"><?php echo $lang['My Profile']; ?></span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="view-profile"><?php echo $lang['View Profile']; ?></a></li>
                            <li><a href="view-profile"><?php echo $lang['Edit Profile']; ?></a></li>
                            <li><a href="saved-searches"><?php echo $lang['My Saved Searches']; ?></a></li>
                            <li><a href="inboxMessages"><?php echo $lang['My Messages']; ?></a></li>
                            <li><a href="exp-interest"><?php echo $lang['My Express Interest']; ?></a></li>
                            <li><a href="my-photo"><?php echo $lang['Manage Photo']; ?></a></li>
                            <li><a href="horoscope"><?php echo $lang['Manage Horoscope']; ?></a></li>
							<li><a href="aadhaar_upload_edit"><?php echo $lang['Manage Document']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="mr-5"><?php echo $lang['My Matches']; ?></span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="one-way-matches"><?php echo $lang['One Way Matches']; ?></a></li>
                            <li><a href="two-way-matches"><?php echo $lang['Two Way Matches']; ?></a></li>
                            <li><a href="broader-matches"><?php echo $lang['Broader Matches']; ?></a></li>
                            <li><a href="preferred-matches"><?php echo $lang['Preferred Matches']; ?></a></li>
                            <li><a href="custom-matches"><?php echo $lang['Custom Matches']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="mr-5"><?php echo $lang['Membership']; ?></span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="membershipplans"><?php echo $lang['Membership Plans']; ?></a></li>
                            <li><a href="current-plan"><?php echo $lang['Current Plan']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="mr-5"><?php echo $lang['Profile Details']; ?></span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="shortlisted-members"><?php echo $lang['Shortlisted Profile']; ?></a></li>
                            <li><a href="blocklisted-members"><?php echo $lang['Blocked Profile']; ?></a></li>
                            <li><a href="member-visited-me"><?php echo $lang['My Profile Viewed By']; ?></a></li>
                            <li><a href="i-visited-members"><?php echo $lang['I Visited Profile']; ?></a></li>
                            <li><a href="who-watch-mobileno"><?php echo $lang['My Mobile No Viewed By']; ?></a></li>
                            <li><a href="photo-request"><?php echo $lang['Photo Password Request']; ?></a></li>
                        </ul>
                    </li>                 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown gt-border-right-green gt-border-left-green">
                        <a href="#" class="dropdown-toggle ripplelink pl-30 pr-30" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fas fa-cog"></i> <span class="hidden-xxl hidden-xl hidden-lg"><?php echo $lang['Settings']; ?></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="settings?photoVisiblity"><?php echo $lang['Photo Privacy Setting']; ?></a></li>
                            <li><a href="settings?contactdiv"><?php echo $lang['Contact View Setting']; ?></a></li>
                            <li><a href="settings?changepass"><?php echo $lang['Change Password']; ?></a></li>
                            <li><a href="logout?action=logout"><?php echo $lang['Logout']; ?></a></li>
                        </ul>
                    </li>
                   
                    <li class="dropdown gt-border-right-green">
                        <a href="#" class="dropdown-toggle ripplelink pl-30 pr-30" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-bell"></i> <span class="hidden-xxl hidden-xl hidden-lg"><?php echo $lang['Notification']; ?></span>
							<span class="badge" style="position:absolute;top:8px;right: 16px;">
								<?php  
                                    $res_reminder = $DatabaseCo->dbLink->query("select * from notification where receiver_id='".$_SESSION['user_id']."' and seen='No' ORDER BY noti_id DESC");
                                    if ($res_reminder->num_rows > 0){ echo $count = $res_reminder->num_rows; }else{ echo $count= 0; }
                                ?>
							</span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php 
                                if ($res_reminder->num_rows > 0) { 
                                    while ($res = mysqli_fetch_object($res_reminder)) {
                            ?>
                            <li>
								<a href="<?php if($res->notification_type == 'Express Interest'){ echo 'exp-interest'; }elseif($res->notification_type == 'Message'){ echo 'inboxMessages'; }elseif($res->notification_type == 'Photo Password'){ echo 'photo-request'; } ?>" onClick="notification('<?php echo $res->noti_id; ?>') ">
								    <?php echo $res->notification; ?>
								</a>
                            </li>
                            
                            <?php } ?>
                            <?php
                                 } else { 
                            ?>
                            <li><a><?php echo $lang['No New Notification']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- MENU ITEMS END -->
        </div>
    </nav>
    <!-- /. Menu after login -->
<?php } else { ?>
	<!-- Menu before login -->
    <nav class="navbar gt-navbar-green flat mb-0">
        <div class="container"> 
        	<!-- Mobile Menu Button -->
        	<div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:rgba(247,247,247,1.00);color:rgba(0,0,0,1.00) !important;">
                    <span><?php echo $lang['MENU']; ?></span>
                </button>
            </div>
            <!-- /.Mobile Menu Button -->

            <!-- Menu tabs -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active ripplelink"><a href="index.php"><i class="fas fa-home mr-10 fa-lg"></i><?php echo $lang['Home']; ?></a></li>
					<?php if($row_menu->menu_search == 'APPROVED'){ ?>
                    <li class="dropdown">
                        <a href="search.php" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="mr-5"><i class="fas fa-search mr-10 fa-lg"></i><?php echo $lang['Search']; ?></span><span class="fa fa-angle-down"></span>
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
                    
					<?php if($row_menu->menu_success == 'APPROVED'){ ?>
                        <li class="ripplelink"><a href="success-story.php"><i class="fas fa-users mr-10 fa-lg"></i><?php echo $lang['Success Story']; ?></a></li>
					<?php } ?>
                    
					<?php if($row_menu->menu_membership == 'APPROVED'){ ?>
                        <li class="ripplelink"><a href="membershipplans.php"><i class="fas fa-id-card-alt mr-10 fa-lg"></i><?php echo $lang['Membership']; ?></a></li>
					<?php } ?>
                    
					<?php if($row_menu->menu_contact == 'APPROVED'){ ?>
                        <li class="ripplelink"><a href="contactUs.php"><i class="fa fa-phone-square mr-10 fa-lg"></i><?php echo $lang['Contact Us']; ?></a></li>
					<?php } ?>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
					<?php if($row_menu->menu_login == 'APPROVED'){ ?>
                    <li class="active ripplelink gt-border-right-green gt-border-left-green gtBorderRightSMXS0 gtBorderLeftSMXS0">
                        <a href="login.php"><i class="fas fa-sign-in-alt mr-10 fa-lg"></i><?php echo $lang['Login']; ?></a>
                    </li>
					<?php } ?>
                    
					<?php if($row_menu->menu_signup == 'APPROVED'){ ?>
                    <li class="ripplelink gt-border-right-green gtBorderRightSMXS0">
                        <a href="index.php"><i class="fas fa-pen-square mr-10 fa-lg"></i><?php echo $lang['Signup']; ?></a>
                    </li>
					<?php } ?>
                    
                </ul>

            </div>
            <!-- /.Menu tabs -->
        </div>
    </nav>
	<!-- /. Menu before login -->
<?php } ?>

<!-- To decrese notification count when click on notification -->
<script>
	function notification(noti_id){
		$.ajax({
		   url:"web-services/notification",
		   type:"POST",
		   data:"noti_id="+noti_id,
		   cache: false,
		   success: function(response){
			location.reload();	
		   }
		});
		return true;
	}
</script>