<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
   		<title>Admin | Database Backup</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
    
    	<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Data table css -->
		<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/all_check.css" rel="stylesheet" type="text/css"/>  
		
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
                    <h1 class="lightGrey">
                        Database Backup
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="active"> Database Backup</li>
                    </ol>
                </section>
	            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box-body">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3 col-xs-12">
                                            <div class="form-group updateSite">
                                                <a href="exampleScript.php" class="btn btn-success btn-lg btn-block mt-15 pt-10 pb-10" >
                                                    Take full backup of database now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include "page-part/footer.php"; ?>
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
			setPageContext("database","expdata");
		</script>
    </body>
</html>
