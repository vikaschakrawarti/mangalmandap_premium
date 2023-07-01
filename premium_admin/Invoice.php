<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    $index_id = isset($_GET['id'])?$_GET['id']:0;
    if($index_id!=0){
        $DatabaseCo = new DatabaseConn(); 
        $SQL_STATEMENT = "SELECT * FROM site_config,register_view,payment_view WHERE register_view.index_id=payment_view.index_id AND register_view.index_id=".$index_id;
        $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
        while ($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){ 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    	<title>Admin | Invoice</title>
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
                    <h1 class="lightGrey">Invoice</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </li>
                        <li>Invoice</li>
                    </ol>
                </section>
                <div class="pad margin no-print">
                    <div class="callout callout-info" style="margin-bottom: 0!important;">												
                        <h4><i class="fa fa-info"></i> Note:</h4>This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                </div>
                <form action="" name="adminInvoice" method="post">
	                <input type="hidden" name="username" id="username" value=""/>
	                <input type="hidden" name="email" id="email" value=""/>
	                <!-- Main content -->
	                <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header mt-0 pb-20">
                                    <i class="fa fa-globe"></i>&nbsp;&nbsp;
                                    <strong class="" style="color: #20c56b;">
                                        <?php echo $DatabaseCo->dbRow->web_frienly_name;?>
                                    </strong>  
                                </h2>
                            </div>
                        </div>
	                    <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h5>From,</h5>
                                    </div>
                                </div>
                                <address>
                                    <div class="row mb-10">
                                        <div class="col-xs-12">
                                            <b style="color: #20c56b;"><?php echo $DatabaseCo->dbRow->web_frienly_name;?></b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 mb-5">
                                            <b style="color: #20c56b;" class="invoiceBoldStyle">Contact No:</b>
                                            <b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->contact_no;?></b>
                                        </div>
                                        <div class="col-xs-12">
                                            <b style="color: #20c56b;" class="invoiceBoldStyle">Email:</b>
                                            <b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->from_email;?></b>  
                                        </div>
                                    </div>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h5>To,</h5>
                                    </div>
                                </div>
                                <address>
                                    <div class="row mb-10">
                                        <div class="col-xs-12">
                                            <b style="color: #20c56b;"><?php echo $DatabaseCo->dbRow->pname;?></b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 mb-5">
                                            <b style="color: #20c56b;" class="invoiceBoldStyle">Contact No:</b>
                                            <b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->mobile;?></b>
                                        </div>
                                        <div class="col-xs-12">
                                            <b style="color: #20c56b;" class="invoiceBoldStyle">Email:</b>
                                            <b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->pemail;?></b>
                                        </div>
                                    </div>
                                </address>
                             </div>
                             <div class="col-sm-4 invoice-col">
                                 <div class="col-xs-12 mb-5">
                                     <strong style="color: #20c56b;" class="invoiceBoldStyle">Invoice: </strong>&nbsp;&nbsp;<b class="invoiceBoldStyle">INV001<?php echo $DatabaseCo->dbRow->pmatri_id; ?></b>
                                 </div>
                                <div class="col-xs-12 mb-5">
                                    <strong style="color: #20c56b;" class="invoiceBoldStyle">Customer Id: </strong>&nbsp;&nbsp;<b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->pmatri_id;?></b>
                                </div>
                                <div class="col-xs-12 mb-5">
                                    <strong style="color: #20c56b;" class="invoiceBoldStyle">Payment Mode: </strong>&nbsp;&nbsp;<b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->paymode;?></b>
                                </div>
                                <div class="col-xs-12 mb-5">
                                    <strong style="color: #20c56b;" class="invoiceBoldStyle">Activated On: </strong>&nbsp;&nbsp;<b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->pactive_dt;?></b>
                                </div>
                                <!--<div class="col-xs-12">
                                    <strong  style="color: #20c56b;" class="invoiceBoldStyle">Account: </strong>&nbsp;&nbsp;<b class="invoiceBoldStyle"><?php echo $DatabaseCo->dbRow->payid;?></b>
                                </div>-->
                                </div>
                            </div>
	                        <div class="row mt-30">
		                        <div class="col-xs-12 table-responsive">
			                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                                <th>expire On</th>
                                                <th>Description</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
				                        <tbody>
					                        <tr>
						                        <td>1</td>
                                                <td >
                                                    <?php echo $DatabaseCo->dbRow->p_plan;?> Membership for 
                                                    <?php echo $DatabaseCo->dbRow->plan_duration;?> Days
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->exp_date;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->description;?>
                                                </td>
                                                <td>
                                                    <?php echo $DatabaseCo->dbRow->p_amount;?>
                                                </td>
					                        </tr>
				                        </tbody>
			                        </table>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-xs-5" style="float:right;">
                                    <p class="lead">Billing Information</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total:</th>
                                                <td><?php echo $DatabaseCo->dbRow->p_amount;?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-print">
	                            <div class="col-xs-12">
	                                <div align="left">
		                                <img src="img/print.png" onClick="window.print()" style=" text-align:center; cursor:pointer;" >
		                                </br>
		                                <span>
		                                    <strong>Print Invoice</strong>
                                        </span>
	                                </div>
                                </div>
                            </div>
                        </form>  
                    </section>
                    <div class="clearfix"></div>
                </div>
            <?php //include "page-part/footer.php"; ?>
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
            setPageContext("sales","report");
        </script>	
        <?php  } }else{ echo "<h1>Invalid User ID.</h1>"; } ?>
    </body>
</html>