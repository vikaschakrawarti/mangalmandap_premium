<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $plan_status = "";
    if(isset($_GET['plan_status'])){
        $plan_status = $_GET['plan_status'];
        $_SESSION['plan_status'] = $_GET['plan_status'];
    }else if(isset($_GET['page'])){
        $plan_status = $_SESSION['plan_status'];
    }else{
        $_SESSION['plan_status'] = "all";
        $plan_status = "all";
    }
    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){  		
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['plan_id']) && is_array($_POST['plan_id'])){
            $plan_id_arr = $_POST['plan_id'];
            $plan_id_val = "(";
            foreach($plan_id_arr as $plan_id){
                $plan_id_val .=	$plan_id.",";
            }
            $plan_id_val = substr($plan_id_val, 0, -1);
            $plan_id_val .=")";
            switch($ACTION){
                case 'DELETE':		
                $SQL_STATEMENT =  "DELETE FROM membership_plan WHERE plan_id IN ".$plan_id_val;	
                break;
                case 'APPROVED':
                $SQL_STATEMENT =  "UPDATE membership_plan SET status='APPROVED' WHERE plan_id IN ".$plan_id_val;	
                break;
                case 'UNAPPROVED':
                $SQL_STATEMENT =  "UPDATE membership_plan SET status='UNAPPROVED' WHERE plan_id IN ".$plan_id_val;	
                break;
            }
            $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
            $STATUS_MESSAGE = $statusObj->getStatusMessage();
        }else{
            $statusObj = new Status();
            $statusObj->setActionSuccess(false);
            $STATUS_MESSAGE = "Please select value to complete action.";	  
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<title>Admin | Membership Plan  </title>
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
		
		<!-- Post Validation CSS -->
    	<link href="css/postvalidationcss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validate.css">
		
		 <!-- Data table css -->
		<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/all_check.css" rel="stylesheet" type="text/css"/>  
		
		<!-- Confirm box Alert -->
		<script type="text/javascript" src="js/util/redirection.js"></script>
    	<link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
		
		<!-- Multiselect Css -->
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
		<link rel="stylesheet" href="../css/chosen.css">
    	<link rel="stylesheet" href="../css/prism.css">
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
					<h1 class="lightGrey">
						Membership Plan List
					</h1>
					<ol class="breadcrumb">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i> Home
							</a>
						</li>
						<li class="active">Membership Plan</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-lg-12 col-xs-12 col-sm-12 mb-15">
							<div class="box-top updateSite">
								<div class="row gtUserStatusBtn">
									<div class="col-lg-3 col-sm-4">
										<a class="md-trigger btn btn-default btn-lg btn-block"  href="manage_plan">
											<i class="fa fa-plus"></i>Add New Plan
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="membership_plan?plan_status=all" class="btn btn-success btn-block">
										<i class="fa fa-list"></i>All Plan <span class="badge"><?php echo getRowCount("SELECT count(plan_id) FROM membership_plan",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="membership_plan?plan_status=approved" class="btn btn-success btn-block">
										<i class="fa fa-thumbs-up"></i>Approved Plan <span class="badge"><?php echo getRowCount("SELECT count(plan_id) FROM  membership_plan WHERE status='APPROVED'",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="membership_plan?plan_status=unapproved" class="btn btn-success btn-block">
											<i class="fa fa-thumbs-down"></i>Unapproved Plan <span class="badge"><?php echo getRowCount("SELECT count(plan_id) FROM membership_plan WHERE status='UNAPPROVED'",$DatabaseCo);?></span> 
										</a>
									</div>
								</div>
							</div>
							<?php
								if(!empty($STATUS_MESSAGE)){	
									if($statusObj->getActionSuccess()){
									echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
								}else{
									echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
									}
								}
							?>
							<?php
								$success= isset($_GET['update_status']) ? $_GET['update_status'] :"" ;
								if(!empty($success)){
									echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i>Record Updated Successfully.</div>";
								}
							?>         
						</div>
						<?php
							$main_menu_count = getRowCount("SELECT count(plan_id) FROM membership_plan".getWhereClauseForStatus($plan_status),$DatabaseCo);
							if($main_menu_count>0){  
								$SQL_STATEMENT =  "SELECT * FROM membership_plan ".getWhereClauseForStatus($plan_status)." ORDER BY plan_id DESC";
						?>
						<div class="col-lg-12 col-xs-12 col-sm-12 mt-10 mb-15">
							<div class="box-top">
								<div class="row">
									<div class="col-lg-1">
										<input type="checkbox" name="check" id="selectall" class="second" />
										<label for="selectall" class="label2">&nbsp;</label> 
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-danger btnTheme1 btn-block" onclick="submitActionForm('DELETE');">
											<i class="fa fa-trash"></i> Delete
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-success btnTheme1 btn-block" onclick="submitActionForm('APPROVED');">
											<i class="fa fa-thumbs-up"></i>Approve
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-warning btnTheme1 btn-block" onclick="submitActionForm('UNAPPROVED');">
											<i class="fa fa-thumbs-down"></i>Unapprove
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 mt-10">
							<div class="box box-success">
								<div class="box-header">
									<h4>
										<?php echo strtoupper($plan_status); ?> MEMBERSHIP PLAN LIST
									</h4>
								</div>
								<div class="box-body gtMemPlan">
									<form method="post" action="membership_plan" id="action_form">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th></th>
													<th>Edit</th>
													<th>Status</th>
													<th>Plan Name</th>
													<th>Duration Type</th>
													<th>Allow Contacts</th>
													<th>Allow Profile</th>
													<th>Allow Messages</th>
													<th>Plan Type</th>
													<th>Online Chat</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php						
													$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
													$rowCount=0;
													while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){		
												?>
												<tr>
													<td>
														<input type="checkbox" name="plan_id[]" id="Item <?php  echo $DatabaseCo->dbRow->plan_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->plan_id;?>"/>
														<label for="Item <?php  echo $DatabaseCo->dbRow->plan_id;?>" class="label2">&nbsp;</label>	
													</td>
													<td>
														<a class="btn btn-default btn-sm md-trigger edit-popup"  href="manage_plan?id=<?php  echo $DatabaseCo->dbRow->plan_id;?>">
														<i class="fa fa-pen fa-fw"></i>
														<span class="hidden-xs">&nbsp;&nbsp;Edit</span>
														</a>
													</td>
													<?php
														$likeDisLikeCss = "";
														if($DatabaseCo->dbRow->status=="APPROVED"){
															$likeDisLikeCss = "fa-thumbs-up";
														}else{
															$likeDisLikeCss = "fa-thumbs-down";
														}
													?>     
													<td class="updateSiteApprovalStatus">
														<i class="fa <?php echo $likeDisLikeCss;?>"></i>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_name;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_duration;?> Days
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_contacts;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->profile;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_msg;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_type;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->chat;?>
													</td>
													<td>
														<?php  echo $DatabaseCo->dbRow->plan_amount_type;?> 
														<?php  echo $DatabaseCo->dbRow->plan_amount;?>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<input  type="hidden" name="action" value="" id="action"/>
									</form>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<center>
								<img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
							</center>
						</div>
						<?php }?>   
					</div>
				</section>
			</div>
			<?php include "page-part/footer.php"; ?>
		</div>
			<!-- jQuery -->
			<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>

			<!-- Bootstrap JS -->
			<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
			<script>
				$(document).ready(function() {
					$('#body').show();
					$('.preloader-wrapper').hide();
				});
			</script>
		
    		<!-- Jquery for left menu active class-->
			<script type="text/javascript" src="dist/js/general.js"></script>
			<script type="text/javascript" src="dist/js/cookieapi.js"></script>
			<script type="text/javascript">
				 setPageContext("mem_ship","plan");
			</script>
    		
			<!-- Data Table Js -->
			<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
			<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

			<!-- Theme Js -->
			<script src="dist/js/app.min.js" type="text/javascript"></script>
		
    		<script>
				$(function() {
					$("input[name=index_id]").click(function() {
						$("#selectall").prop("checked", false);
					});
					//     js for Check/Uncheck all CheckBoxes by Checkbox     // 
					$("#selectall").click(function() {
						$(".second").prop("checked", $("#selectall").prop("checked"))
					})
				});
    		</script> 
  	</body>
</html>
