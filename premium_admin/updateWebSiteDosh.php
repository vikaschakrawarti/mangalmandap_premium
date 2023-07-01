<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $dosh_status = "";
    if(isset($_GET['dosh_status'])){
        $dosh_status = $_GET['dosh_status'];
        $_SESSION['dosh_status'] = $_GET['dosh_status'];
    }else if(isset($_GET['page'])){
        $dosh_status = $_SESSION['dosh_status'];
    }else{
        $_SESSION['dosh_status'] = "all";
        $dosh_status = "all";
    }
    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){  		
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['dosh_id']) && is_array($_POST['dosh_id'])){
            $dosh_id_arr = $_POST['dosh_id'];
            $dosh_id_val = "(";
            foreach($dosh_id_arr as $dosh_id){
                $dosh_id_val .=	$dosh_id.",";
            }
            $dosh_id_val = substr($dosh_id_val, 0, -1);
            $dosh_id_val .=")";
            switch($ACTION){
                case 'DELETE':		
                $SQL_STATEMENT =  "DELETE FROM dosh WHERE dosh_id IN ".$dosh_id_val;	
                break;
                case 'APPROVED':
                $SQL_STATEMENT =  "UPDATE dosh SET status='APPROVED' WHERE dosh_id IN  ".$dosh_id_val;	
                break;
                case 'UNAPPROVED':
                $SQL_STATEMENT =  "UPDATE dosh SET status='UNAPPROVED' WHERE dosh_id IN ".$dosh_id_val;	
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
    	<title>Admin | All Dosh </title>
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
		<link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
		<script type="text/javascript" src="js/util/redirection.js"></script>
		<script type="text/javascript" src="js/util/location.js"></script>
		
		<link rel="stylesheet" href="css/all_check.css"/>
     	<link rel="stylesheet" href="css/libs/select2.css"/>
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
         	<div class="content-wrapper">
            	<section class="content-header">
               		<h1 class="lightGrey">
                  		Add Dosh
               		</h1>
               		<ol class="breadcrumb">
                  		<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  		<li class="active">Dosh</li>
               		</ol>
            	</section>
            	<section class="content">
					<div class="row">
						<div class="col-lg-12 col-xs-12 col-sm-12  mb-15">
							<div class="box-top updateSite">
								<div class="row">
									<div class="col-lg-3 col-sm-4">
										<a class="md-trigger btn btn-default btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
											<i class="fa fa-plus"></i>Add Dosh
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="updateWebSiteDosh?dosh_status=all" class="btn btn-success btn-lg col-xs-12">
											<i class="fa fa-list"></i>All Dosh <span class="badge"><?php echo getRowCount("SELECT count(dosh_id) FROM dosh",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="updateWebSiteDosh?dosh_status=approved" class="btn btn-success btn-lg col-xs-12">
											<i class="fa fa-thumbs-up"></i>Approved Dosh <span class="badge"><?php echo getRowCount("SELECT count(dosh_id) FROM dosh WHERE status='APPROVED'",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="updateWebSiteDosh?dosh_status=unapproved" class="btn btn-success btn-lg col-xs-12">
											<i class="fa fa-thumbs-down"></i>Unapproved Dosh <span class="badge"><?php echo getRowCount("SELECT count(dosh_id) FROM dosh WHERE status='UNAPPROVED'",$DatabaseCo);?></span>
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
						</div>
						<?php
							$main_menu_count = getRowCount("select count(dosh_id) from dosh".getWhereClauseForStatus($dosh_status),$DatabaseCo);
							if($main_menu_count>0){  
							$SQL_STATEMENT =  "SELECT * FROM dosh ".getWhereClauseForStatus($dosh_status)." ORDER BY dosh_id DESC";
						?>
						<div class="col-lg-12 col-xs-12 col-sm-12 mt-10 mb-15">
							<div class="box-top">
								<div class="row">
									<div class="col-lg-1 col-sm-2">
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
									<h4><?php echo strtoupper($dosh_status); ?> DOSH LIST</h4>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form method="post" action="updateWebSiteDosh" id="action_form">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th></th>
													<th>Edit</th>
													<th>Status</th>
													<th>Dosh</th>
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
														<input type="checkbox" name="dosh_id[]" id="Item <?php  echo $DatabaseCo->dbRow->dosh_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->dosh_id;?>"/>
														<label for="Item <?php  echo $DatabaseCo->dbRow->dosh_id;?>" class="label2">&nbsp;</label>	
													</td>
													<td>
														<a class="btn btn-default btn-sm md-trigger edit-popup"  href="javascript:;" data-modal="modal-13" data-id="<?php  echo $DatabaseCo->dbRow->dosh_id;?>" data-dosh="<?php  echo $DatabaseCo->dbRow->dosh;?>" data-dosh_status="<?php  echo $DatabaseCo->dbRow->status;?>"><i class="fa fa-pen fa-fw"></i><span class="hidden-xs">&nbsp;&nbsp;Edit</span>
														</a>
													</td>
													<?php
														$likeDisLikeCss = "";
														if($DatabaseCo->dbRow->status=="APPROVED")
														$likeDisLikeCss = "fa-thumbs-up";
														else
														$likeDisLikeCss = "fa-thumbs-down";
														?>     
													<td class="updateSiteApprovalStatus"><i class="fa <?php echo $likeDisLikeCss;?>"></i></td>
													<td class="updateSite"><span class="textUpdate"><?php  echo $DatabaseCo->dbRow->dosh;?></span></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<input  type="hidden" name="action" value="" id="action"/>
									</form>
								</div>
							</div>
						</div>
						<?php }else{ ?>
						<div class="col-lg-12 col-xs-12 col-sm-12">
							<center>
								<img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
							</center>
						</div>
						<?php } ?>  
					</div>
				</section>
         	</div>
         	<?php include "page-part/footer.php"; ?>
      	</div>
      	<!-- ./wrapper -->
      	<div class="md-modal" id="modal-13">
			<div class="md-content" id="dialog">
				<div class="modal-header" >
					<span id="new_button">
					<button class="md-close close" id="old">&times;</button>
					</span>
					<h4 class="modal-title" id="dialog_title">Add New Dosh</h4>
				</div>
				<div class='error-msg' id='validationSummary'></div>
				<form method="post" id="dosh-form" action="" method="post">
					<div class="modal-body gtSiteChangeId">
						<div class="form-group">
							<label for="exampleInputEmail1">Dosh</label>
							<input type="text" name="dosh" class="form-control" id="dosh_name" placeholder="Enter Dosh name">
						</div>
						<div class="form-group">
							<label>Status</label>
							<div class="radio">
								<input id="optionsRadios1" class="dosh_status" type="radio" checked="" value="APPROVED" name="dosh_status">
								<label for="optionsRadios1" class="mr-10">APPROVED </label>
								<input id="optionsRadios2" class="dosh_status" type="radio" value="UNAPPROVED" name="dosh_status">
								<label for="optionsRadios2">UNAPPROVED </label>
							</div>
						</div>
					</div>
					<div class="modal-footer updateSite">
						<input type="button" id="save" class="btn btn-success" value="Save Changes" title="Save Changes"/>
						<input type="hidden" name="dosh_id" id="dosh_id" value=""/>
						<input type="hidden" name="action" value="" id="update_action"/>
					</div>
				</form>
			</div>
		</div>
      	<div class="md-overlay"></div>
		
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
			setPageContext("add-new","dosh");
		</script>
   					
		<!-- Data Table Js -->
		<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
   		<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
   
    	<!-- 3D Slit effect pop js-->
		<script src="js/classie.js"></script>
		<script src="js/modalEffects.js"></script>
		
		<!-- page script -->
      	<script type="text/javascript">
        	$(function() {
				var refreshRequired = false;
				$("input[name=dosh_id]").click(function() {
					$("#selectall").prop("checked", false);
				});
				//     js for Check/Uncheck all CheckBoxes by Checkbox     // 
				$("#selectall").click(function() {
						$(".second").prop("checked", $("#selectall").prop("checked"))
					})
					// add details //
				$(document).on("click", ".add-details", function() {
					$("#save").val("Save Changes");
					$("#dialog_title").text("Add dosh");
					$("#update_action").val("ADD");
					$('#modal-13').modal('show');
					$("#validationSummary").hide();
					$("#dosh").focus();
					$("#dosh").val("");
				});
				//     edit details function starts here    // 
				$(document).on("click", ".edit-popup", function() {
					var myid = $(this).data('id');
					var dosh = $(this).data('dosh');
					var dosh_status = $(this).data('dosh_status');
					$("#dosh_id").val(myid);
					$("#dosh_name").val(dosh);
					$("#save").val("Update");
					$("#dialog_title").text("Update dosh");
					if(dosh_status == 'APPROVED') {
						$("#optionsRadios1").attr("checked", "checked");
					} else {
						$("#optionsRadios2").attr("checked", "checked");
					}
					$("#update_action").val("UPDATE");
					$('#modal-13').modal('show');
					$("#validationSummary").hide();
					$("#dosh").focus();
				});
				//     to save popup details    // 
				$("#save").button().click(function() {
					$("#validationSummary").attr("class", "alert alert-warning");
					$("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
					$("#validationSummary").show();
					var dataString = $("#dosh-form").serialize();
					$.ajax({
						type: "post",
						url: "web-services/add-details/add_dosh",
						dataType: "json",
						data: dataString,
						success: function(data) {
							if(data.successStatus) {
								$("#validationSummary").attr("class", "alert alert-success");
								$("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>" + data.responseMessage + "");
								$("#validationSummary").show();
								$("#old").remove();
								$('<a href="updateWebSiteDosh" id="old" class="md-close close">&times;</a>').appendTo('#new_button');
							} else {
								$("#validationSummary").attr("class", "alert alert-danger");
								$("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>" + data.responseMessage + "</ul>");
								$("#validationSummary").show();
							}
						}
					})
					return false;
				});
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
		</script>
	</body>
</html>
