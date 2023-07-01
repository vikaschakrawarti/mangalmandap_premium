<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
    if(isset($_REQUEST['edit_id'])){
        $edit_id=$_REQUEST['edit_id'];	
        $data=$DatabaseCo->dbLink->query("SELECT * FROM cms_pages WHERE cms_id='$edit_id'");
        $row=mysqli_fetch_object($data);
        if(isset($_REQUEST['update_cms'])){
            $cms_id=$_REQUEST['edit_id'];
            $page_name=htmlspecialchars($_REQUEST['page_name'],ENT_QUOTES);
            $cms_title=htmlspecialchars($_REQUEST['cms_title'],ENT_QUOTES);
            $status=$_REQUEST['status'];
            $cms_content=htmlspecialchars($_REQUEST['cms_content'],ENT_QUOTES);
            $DatabaseCo->dbLink->query("UPDATE cms_pages SET page_name='".$page_name."',cms_title=\"".$cms_title."\",cms_content=\"".$cms_content."\",status='".$status."' WHERE cms_id=".$cms_id);	
            echo "<script>window.location='cms_pages?update_status=success';</script>";
        }else{
            $statusObj = new Status();
            $statusObj->setActionSuccess(false);
            $STATUS_MESSAGE = "Please select value to complete action.";	  
        }
    }
    if(isset($_POST['add_cms'])){
        $page_name=htmlspecialchars($_POST['page_name'],ENT_QUOTES);
        $cms_title=htmlspecialchars($_POST['cms_title'],ENT_QUOTES);
        $status=$_POST['status'];
        $cms_content=htmlspecialchars($_POST['cms_content'],ENT_QUOTES);
        $DatabaseCo->dbLink->query("INSERT INTO cms_pages (cms_id,page_name,cms_title,cms_content,status) VALUES ('','".$page_name."',\"".$cms_title."\",\"".$cms_content."\",'".$status."')");
        echo "<script>window.location='cms_pages?update_status=success';</script>";
    }
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Manage | Add / Edit CMS Page</title>
    	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    	<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
   		<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	   	<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
    	<!-- jQuery -->
		<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    	<script src="js/textaditor/editor.js"></script>
    	<link href="css/textaditor/editor.css" type="text/css" rel="stylesheet"/>
    	<script type="text/javascript">
			$(document).ready(function() {
				$("#txtEditor").Editor();
				var cmscontent = $("#cms_content").val();
				$("#contentarea").append(cmscontent);
				$("#contentarea").blur(function() {
					var cms_cont = $("#contentarea").html();
					$("#cms_content").val(cms_cont);
				});
			});
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
                    <h1 class="lightGrey">Add New CMS Page</h1>
                    <ol class="breadcrumb">
                        <li>
                          <a href="dashboard">
                            <i class="fa fa-home"></i> Home
                          </a>
                        </li>
                        <li class="active"> Add New CMS Page</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
	                <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="box-top updateSite">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <a href="cms_pages" class="btn btn-success btn-lg btn-block"> <i class="fa fa-list hidden-xs">
                                    </i>All CMS Page </a>
                                    </div>
                                </div>
                            </div>
                        </div>
		                <div class="col-lg-12 col-xs-12 mt-10">
			                <div class="box box-success">
                                <div class="box-header with-border">
                                    <h4>
                                        <i class="fa fa-plus fa-fw"></i> New CMS Page
                                    </h4> 
                                </div>
				                <div class="row">
					                <form name="add_cms" id="add_cms" method="post">
						                <div class="box-body gtNewMemPlan">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label> Page Name : </label>
                                                    <input type="text" class="form-control" name="page_name" required value="<?php if(isset($_REQUEST['edit_id'])) {echo htmlspecialchars_decode($row->page_name); } ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label> Page Title : </label>
                                                    <input type="text" class="form-control" name="cms_title" required value="<?php if(isset($_REQUEST['edit_id'])){ echo htmlspecialchars_decode($row->cms_title);} ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label> Page Content: </label>
                                                    <div id="txtEditor"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label> Status: </label>
                                                    <select class="form-control" name="status">
                                                        <option value="APPROVED" <?php if(isset($_REQUEST[ 'edit_id'])){ if($row->status=='APPROVED') {echo "selected";} } ?>> Active </option>
                                                        <option value="UNAPPROVED" <?php if(isset($_REQUEST[ 'edit_id'])) { if($row->status=='UNAPPROVED') {echo "selected";} }?>> Inactive </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-15">
                                                <div class="col-xs-12 text-center form-group">
                                                    <?php if(isset($_REQUEST['edit_id'])) { ?>
                                                    <input type="submit" name="update_cms" value="Save" class="btn btnThemeG3">
                                                    <?php }else{ ?>
                                                    <input type="submit" name="add_cms" value="Save" class="btn btnThemeG3">
                                                    <?php } ?>
                                                    <input type="reset" value="Cancel" class="btn btnThemeR3">
                                                    <input type="hidden" name="action" value="update">
                                                    <input type="hidden" id="cms_content" name="cms_content" value="<?php if(isset($_REQUEST['edit_id'])){ echo $row->cms_content;} ?>" /> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
					            </div>
                            </div>
                        </div>
                     </div>
                </section>
            </div>
            <?php include "page-part/footer.php"; ?>
        </div>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Jquery for left menu active class-->
        <script type="text/javascript" src="dist/js/general.js"></script>
        <script type="text/javascript" src="dist/js/cookieapi.js"></script>
        <script type="text/javascript">
              setPageContext("cms","cms_page");
        </script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!-- Theme Js -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>