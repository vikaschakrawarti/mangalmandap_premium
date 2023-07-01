<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $success_approval = "";
    if (isset($_GET['success_approval'])) {
        $success_approval = $_GET['success_approval'];
        $_SESSION['success_approval'] = $_GET['success_approval'];
    } else if (isset($_GET['page'])) {
        $success_approval = $_SESSION['success_approval'];
    } else {
        $_SESSION['success_approval'] = "all";
        $success_approval = "all";
    }
    $isPostBack = ($_SERVER["REQUEST_METHOD"] === "POST");
    if ($isPostBack) {
        $ACTION = isset($_POST['action']) ? $_POST['action'] : "";
        if (isset($_POST['story_id'])) {
            $story_id_arr = $_POST['story_id'];
            $story_val = "(";
            foreach ($story_id_arr as $story_id) {
                $story_val .= $story_id . ",";
            }
            $story_val = substr($story_val, 0, -1);
            $story_val .=")";
            switch ($ACTION) {
                case 'DELETE':
                $SQL_STATEMENT = "DELETE FROM success_story WHERE story_id IN " . $story_val;
                $exe = $DatabaseCo->dbLink->query("SELECT weddingphoto FROM success_story WHERE story_id IN " . $story_val);
                while ($get = mysqli_fetch_array($exe)) {
                    if(file_exists("../SuccessStory/" . $get['weddingphoto'])){
                        unlink("../SuccessStory/" . $get['weddingphoto']);
                    }
                }
                break;
                case 'APPROVED':
                $SQL_STATEMENT = "UPDATE success_story SET status='APPROVED' WHERE story_id IN " . $story_val;
                break;
                case 'UNAPPROVED':
                $SQL_STATEMENT = "UPDATE success_story SET status='UNAPPROVED' WHERE story_id IN " . $story_val;
                break;
            }
            $statusObj = handle_post_request("UPDATE", $SQL_STATEMENT, $DatabaseCo);
            $STATUS_MESSAGE = $statusObj->getStatusMessage();
        } else {
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
    	<title>Admin | Aadhaar Card Approval </title>
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
		<script type="text/javascript" src="js/util/location.js"></script>
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
					<h1 class="lightGrey">Success Story Approval</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Success Story Approval</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-lg-12 col-xs-12 col-sm-12 mb-15">
							<div class="box-top updateSite">
								<div class="row">
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="javascript:;" class="md-trigger btn btn-default btn-lg btn-block add-details" title="Add New Success Story" onclick="window.location = 'add-success?action=ADD'" data-modal="modal-13">
											<i class="fa fa-plus"></i>Add New Success Story
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="success_story_approval?success_approval=all" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-list"></i>All Success Story <span class="badge">
											<?php echo getRowCount("select count(story_id) from success_story", $DatabaseCo); ?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="success_story_approval.php?success_approval=approved" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-thumbs-up"></i>Approved Success Story <span class="badge">
											<?php echo getRowCount("select count(story_id) from success_story where status='APPROVED'", $DatabaseCo); ?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="success_story_approval.php?success_approval=unapproved" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-thumbs-down"></i>Unapproved Success Story <span class="badge">
											<?php echo getRowCount("select count(story_id) from success_story where  status='UNAPPROVED'", $DatabaseCo); ?></span>
										</a>
									</div>
								</div>
							</div>
							<?php
								if (!empty($STATUS_MESSAGE)) {
									if ($statusObj->getActionSuccess()) {
										echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> " . $STATUS_MESSAGE . "</div>";
									} else {
										echo "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
									}
								}
							?>   
							<?php
								$success = isset($_GET['success']) ? $_GET['success'] : "";
								if (!empty($success)) {
									echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> Record is updated successfully.</div>";
								}
							?>       
						</div>
						<?php
							$main_menu_count = getRowCount("select count(story_id) from success_story" . getWhereClauseForStatus($success_approval), $DatabaseCo);
								if ($main_menu_count > 0) {
									$SQL_STATEMENT = "SELECT * FROM success_story" . getWhereClauseForStatus($success_approval) . " ORDER BY story_id DESC";
						?>
						<div class="col-lg-12 col-xs-12 col-sm-12 mt-10 mb-15">
							<div class="box-top">
								<div class="row">
									<div class="col-lg-1 col-xs-3">
										<input type="checkbox" name="check" id="selectall" class="second" />
										<label for="selectall" class="label2">&nbsp;</label> 
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-danger btnTheme1 col-xs-12" onclick="submitActionForm('DELETE');">
											<i class="fa fa-trash"></i> Delete
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-success btnTheme1 col-xs-12" onclick="submitActionForm('APPROVED');">
											<i class="fa fa-thumbs-up"></i>Approve
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-warning btnTheme1 col-xs-12" onclick="submitActionForm('UNAPPROVED');">
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
										<?php echo strtoupper($success_approval); ?>  SUCCESS STORY LIST
									</h4>
								</div>
								<div class="box-body gtMemPlan">
									<form method="post" action="success_story_approval" id="action_form">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th></th>
													<th>Edit</th>
													<th width="10%">Status</th>
													<th width="15%">Bride name</th>
													<th width="15%">Groom Name</th>
													<th width="15%">Wedding Date</th>
													<th width="22%">Description</th>
													<th width="35%">Success Photo/Video</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
													$rowCount = 0;
													while ($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)) {
												?>
												<tr>
													<td>
														<input type="checkbox" name="story_id[]" id="Item <?php echo $DatabaseCo->dbRow->story_id; ?>" class="second" value="<?php echo $DatabaseCo->dbRow->story_id; ?>"/>
														<label for="Item <?php echo $DatabaseCo->dbRow->story_id; ?>" class="label2">&nbsp;</label>	
													</td>
													<td> 
														<a class="btn btn-default btn-sm md-trigger edit-popup" href="add-success.php?action=UPDATE&story_id=<?php echo $DatabaseCo->dbRow->story_id; ?>" title="Edit">
															<i class="fas fa-pen"></i> Edit
														</a>
													</td>
													<?php
														$likeDisLikeCss = "";
														if ($DatabaseCo->dbRow->status == "APPROVED"){
															$likeDisLikeCss = "fa-thumbs-up";
														}else{
															$likeDisLikeCss = "fa-thumbs-down";
														}
													?>     
													<td class="updateSiteApprovalStatus">
														<i class="fa <?php echo $likeDisLikeCss; ?>"></i>
													</td>
													<td>
														<?php echo $DatabaseCo->dbRow->bridename; ?>
													</td>
													<td>
														<?php echo $DatabaseCo->dbRow->groomname; ?>
													</td>
													<td>
														<?php
															$a = $DatabaseCo->dbRow->marriagedate;
															echo date('F j, Y', (strtotime($a)));
														?>
													</td>
													<td>
														<?php echo substr($DatabaseCo->dbRow->successmessage, 0, 25); ?>..<a data-toggle="modal" data-target="#successModal" href="#successModal">Read More...</a>
													</td>
													<td title="<?php echo $DatabaseCo->dbRow->story_id; ?>">
														<a data-toggle="modal" data-target="#successModal" href="#successModal">
															<img src="../SuccessStory/<?php echo $DatabaseCo->dbRow->weddingphoto; ?>" width="200" height="180" style="vertical-align: middle"/>
														</a>
													</td>
												</tr>
												<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel"> 
																	<?php echo $DatabaseCo->dbRow->bridename; ?> &  <?php echo $DatabaseCo->dbRow->groomname; ?>
																</h4>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-xs-12">
																		<div class="thumbnail">
																			<img src="../SuccessStory/<?php echo $DatabaseCo->dbRow->weddingphoto; ?>"  class="img-responsive"/>
																		</div>
																	</div>
																	<div class="col-xs-12">
																		<p><?php echo $DatabaseCo->dbRow->successmessage; ?></p>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
												<?php
													$rowCount++;
													}
												?>
											</tbody>
										</table>
										<input  type="hidden" name="action" value="" id="action"/>
									</form>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
						</div>
						<?php } ?>  
					</div>
				</section>
				<div class="clearfix"></div>
			</div>
    		<?php include "page-part/footer.php"; ?>
    	</div>
  
		<div class="modal fade-in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
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
				 setPageContext("approval","succ-approve");
			</script>
		
			<!-- Data Table Js -->
			<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
			<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
			
			<!-- Theme Js -->
			<script src="dist/js/app.min.js" type="text/javascript"></script>
		
			<!-- Multiple Select -->
			<script src="js/util/select2.min.js"></script>
		
			<!-- 3D Slit effect pop js-->
			<script src="js/classie.js"></script>
			<script src="js/modalEffects.js"></script>
		
			<!-- page script -->
			<script type="text/javascript">
				$(function() {
					var refreshRequired = false;
					$("input[name=index_id]").click(function() {
						$("#selectall").prop("checked", false);
					});
					//     js for Check/Uncheck all CheckBoxes by Checkbox     // 
					$("#selectall").click(function() {
						$(".second").prop("checked", $("#selectall").prop("checked"))
					})
					$('#example1').dataTable({
						"aaSorting": [
							[3, 'desc']
						],
						'aoColumnDefs': [{
							'bSortable': false,
							'info': true,
							"paging": true,
							'aTargets': [0, 1, 2, ],
							'pageLength': 10
						}]
					});
				});
				function Getphoto(toid, photoid) {
					$("#myModal6").html("Please wait...");
					$.get("./web-services/get_photos?frmid=" + toid + "&photoid=" + photoid, function(data) {
						$("#myModal6").html(data);
					});
				}
			</script>
  </body>
</html>