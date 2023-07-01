<?php 
	 include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

	$sql=$DatabaseCo->dbLink->query("SELECT web_logo_path,favicon FROM site_config WHERE id='1'");
	$data=mysqli_fetch_object($sql);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Logo & Favicon</title>
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
                    <h1 class="lightGrey">Logo & Favicon</h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Logo & Favicon</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box-body siteLogo">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class='error-msg' id='validationSummary' style="display:none !important;"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <form name="add-form" id="add-form" action="logo_favicon_validation" method="post" enctype="multipart/form-data">	 
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label><h4>Upload Logo</h4></label>
                                                    <div class="col-xs-12 thumbnail">
                                                        <img src="../img/<?php echo $data->web_logo_path; ?>" width="300">
                                                    </div>
                                                    <input type="file" class="form-control" name="siteimage" id="logo"  >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12 faviconUpload">
                                                <div class="form-group">
                                                    <label><h4>Upload Favicon</h4></label>
                                                    <div class="col-xs-12 thumbnail">
                                                        <img src="../img/<?php echo $data->favicon; ?>" width="50">
                                                    </div>
                                                    <input type="file" class="form-control" name="fvicon" id="fvicon" >
                                                </div>
                                            </div>
                                            <div class="col-xs-12 logoUpload">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                                    <i class="icon fa fa-info"></i>Only JPEG, JPG, GIF, PNG types are accepted. 2 MB maximum size.
                                                </div>
                                            </div>
                                            <div class="col-xs-12 text-center siteLogo">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btnThemeG3"name="sub_add_logo" value="Submit">
                                                    <input type="reset" class="btn btnThemeR3" value="Cancel" id="configreset">
                                                    <input type="hidden" id="max_basic_id">
                                                    <input type="hidden" name="logo_photo" value="<?php echo $data->web_logo_path;?>">
                                                    <input type="hidden" name="fvcon_photo" value="<?php echo $data->favicon; ?>">
                                                    <input type="hidden" name="action" value="UPDATE">
                                                </div>
                                            </div>
                                        </form>
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
			setPageContext("site-settings","sitelogo");
		</script>	
		
		<!-- Image Validation -->
		<script type="text/javascript" src="js/util/location.js"></script>
		<script type="text/javascript" src="js/util/jquery.form.js"></script>
		<script type="text/javascript" src="./js/util/location-validation.js"></script>
		<script type="text/javascript">
			registerForm();
		</script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
    		$.widget.bridge('uibutton', $.ui.button);
    	</script>
	</body>
</html>