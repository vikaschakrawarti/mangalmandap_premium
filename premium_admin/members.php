<?php
	include_once '../databaseConn.php';
	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    unset($_SESSION['memstatus']);
    unset($_SESSION['m_status']);
    unset($_SESSION['franchies_id']);
    $search_case = false;
    $member_status = "";

    if(isset($_GET['member_status'])){
        $member_status = $_GET['member_status'];
        $_SESSION['member_status'] = $_GET['member_status'];
    }else if(isset($_GET['page'])){
        $member_status = $_SESSION['member_status'];
    }else{
        $_SESSION['member_status'] = "all";
        $member_status = "all";
    }
    if(isset($_GET['option']) && $_GET['option']=='clear_search'){
        unset($_SESSION['search_title']);
        unset($_SESSION['where_clause']);
        unset($_SESSION['search_action']);
        $search_case = false;
    }
    $search_title = "";
    $where_clause = "";

    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){     
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['index_id'])){
   	        $index_id_arr = $_POST['index_id'];
   	        $index_id_val = "(";
   	        foreach($index_id_arr as $index_id){
   		       $index_id_val .=	$index_id.",";
   	        }
   	        $index_id_val = substr($index_id_val, 0, -1);
   	        $index_id_val .=")";
   	        switch($ACTION){
   		       case 'DELETE':		
   		       $SQL_STATEMENT =  "DELETE FROM register WHERE index_id IN ".$index_id_val;
   		       break;	  
   		       case 'Active':
   		       $SQL_STATEMENT =  "UPDATE register set status='Active',fstatus='' WHERE index_id IN ".$index_id_val;
   		       break;
   		       case 'Inactive':
   		       $SQL_STATEMENT =  "UPDATE register set status='Inactive',fstatus='' WHERE index_id IN ".$index_id_val;	
   		       break;
   		       case 'Suspended':
   		       $SQL_STATEMENT =  "UPDATE register set status='Suspended',fstatus='' WHERE index_id IN ".$index_id_val;
   		       break;
   	        }
   	        $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
   	        $status_MESSAGE = $statusObj->getstatusMessage();
   	    }else if($ACTION=='SEARCH'){
   		   $search_case = true;
   		   $search_title = isset($_POST['search_title'])?$_POST['search_title']:"";
   		   $where_clause = isset($_POST['where_clause'])?$_POST['where_clause']:"";
   		   $_SESSION['search_title'] = $search_title;
   		   $_SESSION['where_clause'] = stripslashes($where_clause);
   		   $_SESSION['search_action'] = 'SEARCH';
   	    }else{
            $statusObj = new status();
   	        $statusObj->setActionSuccess(false);
   	        $status_MESSAGE = "Please select value to complete action.";	  
   	    }
    }
   	if(isset($_SESSION['search_action']) && $_SESSION['search_action']=='SEARCH'){
        	$search_case = true;
   	    $search_title = $_SESSION['search_title'];
   	    $where_clause =stripslashes($_SESSION['where_clause']);
		} 
   	if(isset($_POST['search'])){
        if(isset($_POST['gender']) && $_POST['gender']!=''){
            $_SESSION['search_gender']=$_POST['gender'];
        }else{
            unset($_SESSION['search_gender']);   
        }
        if(isset($_POST['keyword']) && $_POST['keyword']!=''){
            $_SESSION['search_keyword']=$_POST['keyword'];
        }else{
            unset($_SESSION['search_keyword']); 
        }
        if(isset($_POST['cnt_name']) && $_POST['cnt_name']!=''){
            $_SESSION['search_cntnm']=$_POST['cnt_name'];  
        }else{
            unset($_SESSION['search_cntnm']);
        }
        if(isset($_POST['state_name']) && $_POST['state_name']!=''){
            $_SESSION['search_statenm']=$_POST['state_name'];  
        }else{
            unset($_SESSION['search_statenm']);  
        }
        if(isset($_POST['city_name']) && $_POST['city_name']!=''){
            $_SESSION['search_citynm']=$_POST['city_name'];  
        }else{
            unset($_SESSION['search_citynm']);
        }
        if(isset($_POST['religion_name']) && $_POST['religion_name']!=''){
            $_SESSION['search_relnm']=$_POST['religion_name'];  
        }else{
            unset($_SESSION['search_relnm']);
        }
        if(isset($_POST['caste_name']) && $_POST['caste_name']!=''){
            $_SESSION['search_castenm']=$_POST['caste_name'];  
        }else{
            unset($_SESSION['search_castenm']);
        }
        if(isset($_POST['country_id']) && $_POST['country_id']!=''){
            $_SESSION['search_country']=$_POST['country_id'];  
        }else{
            unset($_SESSION['search_country']);
        }
        if(isset($_POST['state_id']) && $_POST['state_id']!=''){
            $_SESSION['search_state']=$_POST['state_id'];  
        }else{
         unset($_SESSION['search_state']); 
        }
        if(isset($_POST['city_id']) && $_POST['city_id']!=''){
            $_SESSION['search_city']=$_POST['city_id'];  
         }else{
             unset($_SESSION['search_city']); 
        }
          if(isset($_POST['religion_id']) && $_POST['religion_id']!='')
        {
            $_SESSION['search_religion']=$_POST['religion_id'];  
        }else{
             unset($_SESSION['search_religion']); 
        }	  
        if(isset($_POST['caste_id']) && $_POST['caste_id']!=''){
          $_SESSION['search_caste']=$_POST['caste_id'];  
        }else{
          unset($_SESSION['search_caste']);
        }
    }elseif(isset($_GET['clear-filter'])){
        unset($_SESSION['search_gender']); 
        unset($_SESSION['search_keyword']);
        unset($_SESSION['search_country']);
        unset($_SESSION['search_state']);
        unset($_SESSION['search_city']);
        unset($_SESSION['search_religion']);
        unset($_SESSION['search_caste']);
        unset($_SESSION['search_castenm']);
        unset($_SESSION['search_relnm']);
        unset($_SESSION['search_citynm']);
        unset($_SESSION['search_statenm']);
        unset($_SESSION['search_cntnm']);  
    }else{
        unset($_SESSION['search_gender']); 
        unset($_SESSION['search_keyword']);
        unset($_SESSION['search_country']);
        unset($_SESSION['search_state']);
        unset($_SESSION['search_city']);
        unset($_SESSION['search_religion']);
        unset($_SESSION['search_caste']);
        unset($_SESSION['search_castenm']);
        unset($_SESSION['search_relnm']);
        unset($_SESSION['search_citynm']);
        unset($_SESSION['search_statenm']);
        unset($_SESSION['search_cntnm']);
    }
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | All Members </title>
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
        <!--<link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>-->
		<link rel="stylesheet" href="../css/chosen.css">
    	<link rel="stylesheet" href="../css/prism.css">
        
		<script type="text/javascript">
        	function memstatus(status) {
				var dataString = 'actionfunction=showData' + '&page=1&status=' + status;
				$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
				$.ajax({
					url: "web-services/memres",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$('#result').html('');
						$('#result').html(response);
						$('.active').removeClass('active');
						$('#' + status + '').addClass('active');
						paggination();
					}
				});
			}

			function paggination(status) {
				$('#result').on('click', '.page-numbers', function() {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$page = $(this).attr('href');
					$pageind = $page.indexOf('page=');
					$page = $page.substring(($pageind + 5));
					var dataString = 'actionfunction=showData' + '&page=' + $page;
					$.ajax({
						url: "web-services/memres",
						type: "POST",
						data: dataString,
						cache: false,
						success: function(response) {
							$('#chkall').attr('checked', false);
							$('#result').html(response);
						}
					});
					return false;
				});
			}
		</script>
		<script>
        	function checkAll(ele) {
				var checkboxes = $('input[name="action_id"]');
				if(ele.checked) {
					for(var i = 0; i < checkboxes.length; i++) {
						if(checkboxes[i].type == 'checkbox') {
							checkboxes[i].checked = true;
						}
					}
				} else {
					for(var i = 0; i < checkboxes.length; i++) {
						console.log(i)
						if(checkboxes[i].type == 'checkbox') {
							checkboxes[i].checked = false;
						}
					}
				}
			}

			function delete_user() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=trash_all&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
					});
				} else {
					alert('Please select at list one message to complete trash action.');
					return false;
				}
			}

			function active() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=active&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
						error: function() {}
					});
				} else {
					alert('Please select at list one message to complete active action.');
					return false;
				}
			}

			function inactive() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=inactive&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
						error: function() {}
					});
				} else {
					alert('Please select at list one message to complete inactive action.');
					return false;
				}
			}

			function suspended() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=suspended&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
						error: function() {}
					});
				} else {
					alert('Please select at list one message to complete suspended action.');
					return false;
				}
			}

			function featured() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=trash_all&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
						error: function() {}
					});
				} else {
					alert('Please select at list one message to complete featured action.');
					return false;
				}
			}

			function paid() {
				var selectedOrderBy = new Array();
				$('input[name="action_id"]:checked').each(function() {
					selectedOrderBy.push(this.value);
				});
				if(selectedOrderBy != '') {
					$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
					$.ajax({
						url: 'user_action',
						type: 'POST',
						data: 'ac_status=trash_all&user_id=' + selectedOrderBy,
						success: function(data) {
							allmem();
							userstatusbtn();
							alert("Record is updated successfully.");
						},
						error: function() {}
					});
				} else {
					alert('Please select at list one message to complete paid action.');
					return false;
				}
			}

			function allmem() {
				var dataString = 'actionfunction=showData' + '&page=1';
				$("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
				$.ajax({
					url: "web-services/memres",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$('#result').html(response);
						$('#result').addClass('All');
						paggination('All');
					}
				});
			}

			function userstatusbtn() {
				var dataString = '';
				$.ajax({
					url: "user_status_btn",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$('#user_staus_btn').html(response);
					}
				});
			}
    	</script>
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
				   <h1 class="lightGrey">All Members</h1>
				   <ol class="breadcrumb">
					  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
					  <li class="active">All Members</li>
				   </ol>
				</section>
				<div class="scroll-menu hidden-xs">
					<ul class="col-xs-12">
						<li class="col-xs-12 clearfix">
							<input type="checkbox" onchange="checkAll(this);" name="chkall" id="chkall" style="cursor:pointer;">
						</li>
						<li class="col-xs-12 clearfix">
							<a style="cursor:pointer;" onClick="delete_user();" title="Delete">
							<i class="fa fa-trash"></i>
							</a>
						</li>
						<li class="col-xs-12 clearfix">
							<a style="cursor:pointer;color:#20c56b;" onClick="active();" title="Active">
							<i class="fa fa-thumbs-up"></i>
							</a>
						</li>
						<li class="col-xs-12 clearfix">
							<a style="cursor:pointer;color: rgb(221, 142, 57);" onClick="inactive();" title="Inactive">
							<i class="fa fa-thumbs-down"></i>
							</a>
						</li>
						<li class="col-xs-12 clearfix">
							<a style="cursor:pointer;" onClick="suspended();" title="Suspend">
							<i class="fa fa-user-times"></i>
							</a>
						</li>
					</ul>
				</div>
            	<section class="content">
					<div class="row">
						<div class="col-lg-12 col-xs-12 col-sm-12 mb-15">
							<div class="box-top updateSite">
								<div class="row">
									<div class="col-lg-2 col-xs-12 col-sm-6">
										<a href="members.php" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-users"></i>All Member
										</a>
									</div>
									<div class="col-lg-2 col-xs-12 col-sm-6">
										<a href="editprofile.php" class="btn btn-success btn-lg btn-block">
											<i class="fa fa-user-plus"></i>Add Member
										</a>
									</div>
									<?php 
										if(isset($_SESSION['search_gender']) || isset($_SESSION['search_keyword']) || isset($_SESSION['search_country']) || isset($_SESSION['search_state']) || isset($_SESSION['search_city']) || isset($_SESSION['search_religion']) || isset($_SESSION['search_caste'])){
									?>
									<div class="col-lg-2 col-xs-12 col-sm-6">
										<a class="md-trigger btn btn-success btn-lg btn-block add-details"  href="?clear-filter">
										    <i class="fa fa-times-circle"></i>Clear Filter
										</a>
									</div>
									<?php }else{ ?>
									<div class="col-lg-2 col-xs-12 col-sm-6">
										<a data-toggle="modal" data-target="#modal-13" class="btn btn-success btn-lg btn-block add-details">
										    <i class="fa fa-filter"></i>Filter Profile
										</a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 mt-10 mb-15">
							<div class="box-top">
								<div class="row">
									<div class="col-xs-12 gtUserStatusBtn">
										<label class="lightGrey mb-10">SORT MEMBERS</label>
										<div id="user_staus_btn"></div>
									</div>
								</div>
							</div>
						</div>
						<section class="col-lg-12 col-xs-12 col-md-12 ">
							<div class="box-top mt-10 mb-15">
								<div class="row">
									<div class="col-xs-12">
										<div class="col-lg-12 col-xs-12 col-md-12 gtSelectMember">
											<div class="row">
												<label class="btn btn-default col-lg-2 col-xs-12 col-md-2 btn-flat">
													<input type="checkbox" onchange="checkAll(this);" name="chkall" id="chkall" style="cursor:pointer;" class="mt-0">&nbsp;&nbsp;&nbsp;Select All
												</label>
												<div class="clearfix visible-xs"></div>
												<a  class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-2" onClick="delete_user();">
													<i class="fa fa-trash mr-10"></i> Delete
												</a>
												<a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-2" onClick="active();">
													<i class="fa fa-thumbs-up mr-10"></i>Active
												</a>
												<a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-3" onClick="inactive();">
													<i class="fa fa-thumbs-down mr-10"></i>Inactive
												</a>
												<a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-3"  onClick="suspended();">
													<i class="fa fa-user-times mr-10"></i>Suspended
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="result"></div>
						</section>
						<section class="col-lg-7 col-xs-12 connectedSortable"></section>
						<section class="col-lg-5 col-xs-12 connectedSortable"></section>
					</div>
				</section>
          	</div>
         	<?php include "page-part/footer.php"; ?>
      	</div>
		<!-- Filter Modal -->
        <div class="modal fade inFilterModal" id="modal-13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Filter Profile</h4>
                    </div>
                    <form method="post" id="search-form" action="" >
					<div class="modal-body">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="exampleInputEmail1"><b>Gender</b></label>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" class="" id="gender" value="Male">&nbsp;Male&nbsp;&nbsp;
								<input type="radio" name="gender" class="" id="gender" value="Female">&nbsp;Female
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><b>Keyword</b></label>
								<input type="text" name="keyword" class="form-control" id="keyword" placeholder="Enter country name">
							</div>
							<div class="form-group form-group-select2">
								<label for="exampleInputEmail1"><b>Country</b></label>
								<select class="form-control chosen-select chosen-single" name="country_id" id="country_id" data-validetta="required">
									<option value="">Select Your Country
									</option>
									<?php
										$SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'  ");
										while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_country)){
									?>
									<option value="<?php echo $DatabaseCo->Row->country_id ?>">
                                            <?php echo $DatabaseCo->Row->country_name; ?>
                                    </option>
									<?php } ?>
								</select>
								<div id="status123"></div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><b>State</b></label>
								<select class="form-control chosen-select"  name="state_id" id="state123" data-validetta="required">
									<option value="">
										Select
									</option>
								</select>
								<div id="status23"></div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><b>City</b></label>
								<select class="form-control chosen-select" name="city_id" id="city123" data-validetta="required">
									<option value="">Select state first
									</option>
								</select>
							</div>
							<div class="form-group form-group-select2">
								<label for="exampleInputEmail1"><b>Religion</b></label>
								<input type="hidden" name="religion_name" id="religion_name" value="">
								<select name="religion_id" id="religion_id" class="chosen-single chosen-select form-control">
									<option value="">Select Religion</option>
									<?php 
										$sel_country=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM religion WHERE status='APPROVED'") or die(mysqli_error());
										 while($get_cunt = mysqli_fetch_object($sel_country)){
										?>
									<option value="<?php echo $get_cunt->religion_id;?>"><?php echo $get_cunt->religion_name;?></option>
									<?php }?>
								</select>
								<div class="status3"></div>
							</div>
							<div class="form-group form-group-select2">
								<label for="exampleInputEmail1"><b>Caste</b></label>
								<input type="hidden" name="caste_name" id="caste_name" value="">
								<select name="caste_id" id="caste_id" class="chosen-single chosen-select form-control">
									<option value="">Select Caste</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<div class="col-md-4 col-md-offset-4">
							<input type="submit" id="save" class="btn btn-green btn-lg btn-block" name="search" value="SEARCH" title="SEARCH"/>
							<input type="hidden" name="keyword_id" id="keyword_id" value=""/>
							<input type="hidden" name="action" value="SEARCH" id="update_action"/>
						</div>
					</div>
				</form>
                </div>
            </div>
        </div>

    
		<!-- jQuery -->
		<script src="../js/jquery.min.js"></script>
    
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        
		<!-- Jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			setPageContext("members","all-members");
		</script>
		
     	
		
     	<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		
		<!-- 3D Slit effect pop js-->
		<!--<script src="js/classie.js"></script>
		<script src="js/modalEffects.js"></script>-->
		
		<!-- Multiple Select -->
		<!--<script src="js/util/select2.min.js"></script>-->
		
     	<!-- Page Js -->
      	<script type="text/javascript">
        	$(document).ready(function() {
				allmem();
				userstatusbtn();
				/*$('#religion_id').select2();
				$('#caste_id').select2();*/
			});
            $("#country_id").change(function(){
				$("#status123").html('<div>Loading...</div>');
				var id=$(this).val();
				var dataString = 'id=' + id;
				$.ajax({
					type: "POST",
					url: "../ajax_country_state",
					data: dataString,
					cache: false,
					success: function(html){
						$("#state123").html(html);
						$("#status123").html('');
                        $("#state123").trigger("chosen:updated");
					} 
				});
			});
        
			$("#state123").on('change', function() {
				$("#status23").html('<div>Loading...</div>');
				var id = $(this).val();
				var cnt_id = $("#country_id").val();
				var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
				$.ajax({
					type: "POST",
					url: "../ajax_country_state",
					data: dataString,
					cache: false,
					success: function(html) {
						$("#city123").html(html);
						$("#status23").html('');
                        $("#city123").trigger("chosen:updated");
					}
				});
			});
            
			$("#religion_id").on('change', function() {
				$("#caste_id").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
				var religion_name = $("#religion_id option:selected").text();
				$('#religion_name').val(religion_name);
				var religionId = $("#religion_id").val();
				var dataString = 'religionId=' + religionId;
				$.ajax({
					type: "POST",
					url: "ajax_search2",
					data: dataString,
					cache: false,
					success: function(html) {
						$("#caste_id").html(html);
						/*$('#caste_id').select2();*/
						$("#status3").html('');
                        $("#caste_id").trigger("chosen:updated");
					}
				});
			});
		</script>
    </body>
</html>