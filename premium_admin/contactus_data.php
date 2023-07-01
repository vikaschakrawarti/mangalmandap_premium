<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    $first_status = "";
    if(isset($_GET['first_status'])){
        $first_status = $_GET['first_status'];
        $_SESSION['first_status'] = $_GET['first_status'];
    }else if(isset($_GET['page'])){
        $first_status = $_SESSION['first_status'];
    }else{
        $_SESSION['first_status'] = "all";
        $first_status = "all";
    }

    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){     
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['id'])){
            $ei_id_arr = $_POST['id'];
            $ei_id_val = "(";
            foreach($ei_id_arr as $ei_id){
                $ei_id_val .=	$ei_id.",";
            }
            $ei_id_val = substr($ei_id_val, 0, -1);
            $ei_id_val .=")";
            switch($ACTION){
                case 'DELETE':		
                $SQL_STATEMENT =  "DELETE FROM contactus WHERE id IN ".$ei_id_val;	
                break;
            }
            $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
            $STATUS_MESSAGE = $statusObj->getStatusMessage();
        }else{
            $statusObj = new status();
            $statusObj->setActionSuccess(false);
            $STATUS_MESSAGE = "Please select value to complete action.";	  
        }
    }
?>
<!DOCTYPE html>
<html>
  	<head>
		<meta charset="UTF-8">
   		<title>Admin | Contact Us Data </title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
    
    	<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
   
    	<!-- Post Validation CSS -->
    	<link href="css/postvalidationcss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validate.css">
		
		<script src="../js/swfobject.js" type="text/javascript"></script>
    	
		<!-- Data table css -->
		<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/all_check.css" rel="stylesheet" type="text/css"/>  
    	
		<!-- Confirm box Alert -->
		<script type="text/javascript" src="js/util/redirection.js"></script>
		<script type="text/javascript" src="js/util/location.js"></script>
    	<link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
    	
		<!-- Multiselect Css -->
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
		
  		<!-- Checkbox css -->
		<link rel="stylesheet" href="css/all_check.css"/>   
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
                    <h1 class="lightGrey">Contact Us Data</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </li>
                        <li class="active"> Contact Us</li>
                      </ol>
                </section>
                <!-- Main content -->
                <section class="content">
	                <div class="row">
		                <div class="col-lg-12 col-xs-12 col-sm-12 mb-15">
			                <div class="box-top updateSite">
				                <div class="row">
					                <div class="col-lg-3 col-xs-12 col-sm-4">
						                <a href="contactus_data?status=all" class="btn btn-success btn-lg btn-block"> 
                                            <i class="fa fa-list"></i> Contact Us Data <span class="badge">
                                            <?php echo getRowCount("SELECT count(id) FROM contactus",$DatabaseCo);?></span>
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
                            $main_menu_count = getRowCount("SELECT count(id) FROM contactus".getWhereClauseForStatus($first_status),$DatabaseCo);
                            if($main_menu_count>0){
                                $SQL_STATEMENT =  "SELECT * FROM contactus ".getWhereClauseForStatus($first_status)." ORDER BY id DESC";
                        ?>
                        <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
				            <div class="box-top">
					            <div class="row">
						            <div class="col-lg-1 col-xs-3">
							            <input type="checkbox" name="check" id="selectall" class="second" />
							            <label for="selectall" class="label2">&nbsp; </label>
						            </div>
						            <div class="col-lg-2 col-xs-12 col-sm-4">
							            <a href="javascript:;" class="btn btn-danger btn-lg btn-block" onclick="submitActionForm('DELETE');">
                                            <i class="fa fa-trash"></i> Delete 
                                        </a>
						            </div>
					            </div>
				            </div>
			            </div>
			            <div class="col-xs-12 mt-10">
				            <div class="box box-success">
					            <div class="box-header">
						            <h4><?php echo strtoupper($first_status); ?>CONTACT US DATA</h4>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body gtMemPlan">
                                    <form method="post" action="contactus_data" id="action_form">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email Id</th>
                                                    <th>Mobile No</th>
                                                    <th>Subject</th>
                                                    <th>Desc</th>
                                                    <th>Date</th>
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
                                                    <input type="checkbox" name="id[]" id="Item <?php  echo $DatabaseCo->dbRow->id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->id;?>"/>
                                                    <label for="Item <?php  echo $DatabaseCo->dbRow->id;?>" class="label2">&nbsp;</label>	
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->id;?>
                                                </td>
                                                <td>
                                                    <?php  echo $DatabaseCo->dbRow->name;?>
                                                </td>
                                                <td>
                                                    <?php  echo $DatabaseCo->dbRow->email;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->mobile;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->subject;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->description;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->date;?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="action" value="" id="action"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
                        <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
                    </div>
                    <?php } ?>   
                    </div>
                </section>
            </div>
      		<!-- /.content-wrapper -->
      		<?php include "page-part/footer.php"; ?>
    	</div>
        <!-- ./wrapper -->
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
          setPageContext("contactus","contactus");
        </script>
        
        <!-- Data Table Js -->
        <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- Theme Js -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        
        <!-- 3D Slit effect pop js-->
        <script src="js/classie.js"></script>
        <script src="js/modalEffects.js"></script>
        
        <!-- Multiple Select -->
        <script src="js/util/select2.min.js"></script>
        
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                var refreshRequired = false;
                $("input[name=id]").click(function() {
                    $("#selectall").prop("checked", false);
                });
                //  js for Check/Uncheck all CheckBoxes by Checkbox // 
                $("#selectall").click(function() {
                    $(".second").prop("checked", $("#selectall").prop("checked"))
                })
                $('#example2').dataTable({
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
