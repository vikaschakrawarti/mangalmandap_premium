<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    $horoscop_status = "";
    if(isset($_GET['horoscop_status'])){
        $horoscop_status = $_GET['horoscop_status'];
        $_SESSION['horoscop_status'] = $_GET['horoscop_status'];
    }else if(isset($_GET['page'])){
        $horoscop_status = $_SESSION['horoscop_status'];
    }else{
        $_SESSION['horoscop_status'] = "all";
        $horoscop_status = "all";
    }
    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){     
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['index_id'])){
            $index_id_arr = $_POST['index_id'];
            $index_val = "(";
            foreach($index_id_arr as $index_id){
                $index_val .=	$index_id.",";
            }
            $index_val = substr($index_val, 0, -1);
            $index_val .=")";
            switch($ACTION){
                case 'DELETE':		
                $SQL_STATEMENT =  "UPDATE register SET hor_photo='' WHERE index_id IN ".$index_val;	
                $exe=$DatabaseCo->dbLink->query("SELECT hor_photo FROM register WHERE index_id IN ".$index_val);
                while($get=mysqli_fetch_object($exe)){		
                    unlink("../horoscope_img/".$get->hor_photo);
                }	  
                break;
                case 'APPROVED':
                $SQL_STATEMENT =  "UPDATE register SET hor_check='APPROVED' WHERE index_id IN ".$index_val;	
                break;
                case 'UNAPPROVED':
                $SQL_STATEMENT =  "UPDATE register SET hor_check='UNAPPROVED' WHERE index_id IN ".$index_val;	
                break;
                case 'PENDING':
                $SQL_STATEMENT =  "UPDATE register SET hor_check='PENDING' WHERE index_id IN ".$index_val;	
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
    	<title>Admin | Horoscope Approval </title>
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
					<h1 class="lightGrey">
						Horoscope Approval
					</h1>
					<ol class="breadcrumb">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i> Home
							</a>
						</li>
						<li class="active"> Horoscope Approval</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-lg-12 col-xs-12 col-sm-12 mb-15">
							<div class="box-top updateSite">
								<div class="row">
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="horoscop_approval.php?horoscop_status=all" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-list"></i>All Horoscope <span class="badge">
											<?php echo getRowCount("SELECT count(index_id) FROM register WHERE hor_photo!='' ",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="horoscop_approval.php?horoscop_status=approved" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-thumbs-up"></i>Approved Horoscope <span class="badge">
											<?php echo getRowCount("SELECT count(index_id) FROM register WHERE hor_photo!='' AND hor_check='APPROVED'",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="horoscop_approval.php?horoscop_status=unapproved" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-thumbs-down"></i>Unapproved Horoscope <span class="badge">
											<?php echo getRowCount("SELECT count(index_id) FROM register WHERE hor_photo!='' AND hor_check='UNAPPROVED'",$DatabaseCo);?></span>
										</a>
									</div>
									<div class="col-lg-3 col-xs-12 col-sm-4">
										<a href="horoscop_approval.php?horoscop_status=pending" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-thumbs-down"></i>Pending Horoscope <span class="badge">
											<?php echo getRowCount("SELECT count(index_id) from register WHERE hor_photo!='' AND hor_check='PENDING'",$DatabaseCo);?></span>
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
							$main_menu_count = getRowCount("SELECT count(index_id) FROM register".getWhereClauseForHoro($horoscop_status),$DatabaseCo);
							if($main_menu_count>0){  
								$SQL_STATEMENT =  "SELECT * FROM register".getWhereClauseForHoro($horoscop_status)." ORDER BY index_id DESC";
						?>
						<div class="col-lg-12 col-xs-12 col-sm-12 mt-10 mb-15">
							<div class="box-top">
								<div class="row">
									<div class="col-lg-1 col-sm-3 col-xs-3">
										<input type="checkbox" name="check" id="selectall" class="second" />
										<label for="selectall" class="label2">&nbsp;</label> 
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-danger btnTheme1 btn-block" onclick="submitActionForm('DELETE');">
										<i class="fa fa-trash">
										</i> Delete
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-success btnTheme1 btn-block" onclick="submitActionForm('APPROVED');">
										<i class="fa fa-thumbs-up">
										</i>Approve
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-4">
										<a href="javascript:;" class="btn btn-warning btnTheme1 btn-block" onclick="submitActionForm('UNAPPROVED');">
										<i class="fa fa-thumbs-down">
										</i>Unapprove
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 mt-10">
							<div class="box box-success">
								<div class="box-header">
									<h4>
										<?php echo strtoupper($horoscop_status); ?>  HOROSCOPE LIST
									</h4>
								</div>
								<div class="box-body gtMemPlan">
									<form method="post" action="horoscop_approval" id="action_form">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th></th>
													<th width="10%">Status</th>
													<th width="15%">Matri ID</th>
													<th width="20%">User name</th>
													<th width="15%">User Status</th>
													<th width="37%">Horoscope Image</th>
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
														<input type="checkbox" name="index_id[]" id="Item <?php  echo $DatabaseCo->dbRow->index_id;?>" class="second" value="<?php  echo 				$DatabaseCo->dbRow->index_id;?>"/>
														<label for="Item <?php  echo $DatabaseCo->dbRow->index_id;?>" class="label2">&nbsp;</label>	
													</td>
													<?php
														$likeDisLikeCss = "";
														if($DatabaseCo->dbRow->hor_check=="APPROVED"){
															$likeDisLikeCss = "fa-thumbs-up";
														}elseif($DatabaseCo->dbRow->hor_check=="PENDING"){
															$likeDisLikeCss = "fa-clock-o";
														}else{
															$likeDisLikeCss = "fa-thumbs-down";
														}
													?>  
													<td class="updateSiteApprovalStatus ">
														<i class="fa <?php echo $likeDisLikeCss;?>"></i>
													</td>
													<td>
														<?php echo $DatabaseCo->dbRow->matri_id;?>
													</td>
													<td>
														<?php echo $DatabaseCo->dbRow->username;?>
													</td>
													<td>
														<?php echo $DatabaseCo->dbRow->status;?>
													</td>
													<td title="<?php echo $DatabaseCo->dbRow->username;?>">
														<img src="../horoscope_img/<?php echo $DatabaseCo->dbRow->hor_photo;?>" width="170" height="160" style="vertical-align:middle;cursor:pointer;" data-target="#myModal6" data-toggle="modal" onclick="Gethoroscope('<?php echo  $DatabaseCo->dbRow->matri_id;?>');" />
													</td>
												</tr>
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
				 setPageContext("approval","horoscope-approve");
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

                function Gethoroscope(toid){
                    $("#myModal6").html("Please wait...");
                    $.get("./web-services/get_horoscope?frmid="+toid,
                    function(data){
                        $("#myModal6").html(data);
                    });
                }
            </script>   
	</body>
</html>