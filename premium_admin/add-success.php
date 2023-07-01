<?php
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    $story_id = isset($_GET['story_id']) ? $_GET['story_id'] : "";
    if ($story_id != '') {
        $sql = "SELECT * FROM success_story WHERE story_id='$story_id'";
        $result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
        $row = mysqli_fetch_array($result);
    }
if (isset($_REQUEST['add_story'])) {
	$brideid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['brideid']);
	$bridename = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['bridename']);
	$groomid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomid']);
	$groomname = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomname']);
	$weddingphoto = $_FILES['weddingphoto']['name'];
	$marriagedate = $_POST['datepicker'];
    $engagement_date = $_POST['datepicker1'];
	$successmessage = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['successmessage']);
	$status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['status']);
	
	
	$file = $_FILES["weddingphoto"]["name"];
	$file_size = isset($_FILES['weddingphoto']['size']) ? $_FILES['weddingphoto']['size'] : '';
	$weddingphoto_type = 'photo';
	$d = explode(".", $file);
	$p = count($d);
	$chk_ext = $d[$p - 1];
	if (($chk_ext == "jpg" || $chk_ext == "JPG" || $chk_ext == "jpeg" || $chk_ext == "png" || $chk_ext == "gif") && ($file_size < 50960000)) {
        $time = time() . '.jpg';
        move_uploaded_file($_FILES['weddingphoto']['tmp_name'], "../SuccessStory/" . $time);
        $sql = "INSERT INTO success_story(`weddingphoto`,`weddingphoto_type`, `bridename`, `brideid`, `groomname`, `groomid`,`marriagedate`,`engagement_date`, `successmessage`,`status`,`fstatus`)VALUES('$time','$weddingphoto_type','$bridename','$brideid','$groomname','$groomid','$marriagedate','$engagement_date','$successmessage','$status','0')";
        $result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
        header("location:success_story_approval?success=Yes");
	} else {
	echo "<script laguage=\"javascript\">alert(\"Only .jpg,.jpeg,.png,.gif Extention Photo File AND Maximum 5 MB Size Allow \");</script>";
	}
}
if (isset($_REQUEST['update_story'])) {
	$brideid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['brideid']);
	$bridename = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['bridename']);
	$groomid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomid']);
	$groomname = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomname']);
	$marriagedate = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['datepicker']);
    $engagement_date = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['datepicker1']);
	$successmessage = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['successmessage']);
	$status = $_REQUEST['status'];


    if (@is_uploaded_file($_FILES["weddingphoto"]["tmp_name"])) {
        $file = $_FILES["weddingphoto"]["name"];
        $file_size = isset($_FILES['weddingphoto']['size']) ? $_FILES['weddingphoto']['size'] : '';
        $weddingphoto_type = 'photo';
        $d = explode(".", $file);
        $p = count($d);
        $chk_ext = $d[$p - 1];
        if (($chk_ext == "jpg" || $chk_ext == "JPG" || $chk_ext == "jpeg" || $chk_ext == "png" || $chk_ext == "gif") && ($file_size < 50960000)){
            $time = time() . '.jpg';
            if(file_exists("../SuccessStory/" . $_REQUEST['oldimg'])){
                unlink("../SuccessStory/" . $_REQUEST['oldimg']);
            }
            move_uploaded_file($_FILES['weddingphoto']['tmp_name'], "../SuccessStory/" . $time);
            $sql = "UPDATE success_story SET weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',engagement_date='$engagement_date',successmessage='$successmessage',status='$status' WHERE story_id='$story_id'";
            $result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
            header("location:success_story_approval?success=Yes");
        } else {
            echo "<script laguage=\"javascript\">alert(\"Only .jpg,.jpeg,.png,.gif Extention Photo File AND Maximum 5 MB Size Allow \");</script>";
        }
    }else{
        $time = $_POST['oldimg'];
        $weddingphoto_type = 'photo';
        $sql = "UPDATE success_story SET weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',engagement_date='$engagement_date',successmessage='$successmessage',status='$status',fstatus='0' WHERE story_id='$story_id'";
        $result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
        header("location:success_story_approval?success=Yes");
    }

}

?>
<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8">
        <title>Admin | Add / Edit Success Story</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- Bootstrap & custom css -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" />

        <!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
        
        <!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        
	    <!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="../css/validate.css">
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
					<h1 class="lightGrey">Add/Edit Sucess Story</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Add/Edit Sucess Story</li>
					</ol>
				</section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="box-top updateSite">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <a href="success_story_approval" class="btn btn-success btn-lg btn-block">
                                            <i class="fas fa-list hidden-xs"></i>All Sucess Story 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
		                <div class="col-lg-12 col-xs-12 mt-10">
			                <div class="box box-success">
				                <div class="box-header with-border">
					                <h4>ADD / EDIT SUCCESS STORY</h4> 
                                </div>
				                <?php
					               if(!empty($STATUS_MESSAGE)) {
					                   if($save) {
					                       echo "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4></div>";
					                       echo "<div class='error-msg' id='validationSummary'></div>";
					                   } else {
					                       echo "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
					                   }
					               } else {
					                   echo "<div class='error-msg' id='validationSummary'></div>";
					               }
					           ?>
					            <div class="row">
						            <div class="box-body">
							            <form action="" enctype="multipart/form-data" method="post" class="form-data gtNewMemPlan" id="add_form" class="">
								            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Bride ID : </label>
                                                    <input type="text" class="form-control" name="brideid" value="<?php if ($story_id != '') { echo $row['brideid']; } ?>" id="brideid" title="bridid" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Bride name : </label>
										            <input type="text" class="form-control" name="bridename" value="<?php if ($story_id != '') { echo $row['bridename']; } ?>" id="bridename" title="bridename" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Groom ID : </label>
										            <input type="text" class="form-control" name="groomid" value="<?php if ($story_id != '') { echo $row['groomid']; } ?>" id="groomid" title="groomid" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Groom Name : </label>
										            <input type="text" class="form-control" name="groomname" value="<?php if ($story_id != '') { echo $row['groomname']; } ?>" id="groomname" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Upload Photo : </label>
										            <input type="file" class="form-control" name="weddingphoto" id="weddingphoto" size="8" <?php if ($story_id=='' ) { ?>data-validetta="required" <?php } ?>/>
                                                    <input type="hidden" name="oldimg" id="oldimg" value="<?php if ($story_id != '') { echo $row['weddingphoto']; } ?>" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Marrage Date : </label>
										            <input type="text" class="form-control" name="datepicker" value="<?php if ($story_id != '') { echo $row['marriagedate']; } ?>" id="datepicker" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
										            <label> Engagement Date : </label>
										            <input type="text" class="form-control" name="datepicker1" value="<?php if ($story_id != '') { echo $row['engagement_date']; } ?>" id="datepicker1" data-validetta="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6 mt-30">
                                                <div class="form-group">
										            <label class="mr-10"> Status: </label>
										            <input type="radio" value="APPROVED" name="status" id="statusA" <?php if ($story_id !='' && $row[ 'status']=="APPROVED" ) { ?> checked="checked" <?php } ?> data-validetta="required" /> 
                                                    <label class="radio-btn-text mr-10" for="statusA">Active</label>
                                                    
											        <input type="radio" value="UNAPPROVED" name="status" id="statusI" <?php if ($story_id !='' && $row[ 'status']=="UNAPPROVED" ) { ?> checked="checked" <?php } ?> data-validetta="required"  /> 
                                                    <label class="radio-btn-text" for="statusI">Inactive</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group">
										            <label> Success Masssage : </label>
										            <textarea name="successmessage" id="successmessage" data-validetta="required" class="form-control" rows="5"><?php if ($story_id != '') { echo $row['successmessage']; } ?></textarea>
									            </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12 text-center mt-15 mb-20">
                                                <?php if (!empty($story_id)) { ?>
                                                <input type="submit" class="btn btnThemeG3" value="Update" name="update_story" title="Update" />
                                                <input type="hidden" name="update_story" class="btn btnThemeG3" value="submit" />
                                                <input type="hidden" name="oldimg" value="<?php echo $row['weddingphoto']; ?>" />
											    <?php } else { ?>
                                                <input type="submit" class="btn btnThemeG3" value="Add" name="add_story" title="Add" />
                                                <input type="hidden" name="add_story" value="submit" />
								                <?php } ?>
                                                <input type="reset" class="btn btnThemeR3" value="Cancel" title="Cancel" /> 
                                            </div>
							            </form>
                                        <div class="clearfix"></div>
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
			setPageContext("success_story", "add_success");
		</script>
        
        <script type="text/javascript" src="js/util/redirection.js"></script>
        
        <!-- Validation Js -->
        <script src="../js/validetta.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('#add_form').validetta({
                    errorClose: false,
                    custom: {
                        regname: {
                            pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
                            errorMessage: 'Custom Reg Error Message !'
                        },
                        // you can add more
                        example: {
                            pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
                            errorMessage: 'Lan mal !'
                        }
                    },
                    realTime: true
                });
            });
        </script>
        
        <!-- Datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                $("#datepicker1").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script> 
        
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        
        <!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
        
        <!-- Photo upload validation -->
        <script language="JavaScript">
            $(document).ready(function(e) {
               setVisibility('upvideo', 'none');
               setVisibility('upphoto', 'inline');
            });

            function setVisibility(id, visibility) {
                document.getElementById(id).style.display = visibility;
                if(id == 'upvideo' && visibility == 'inline') {
                    <?php if ($story_id == '') { ?>
                        $('#weddingvideo').attr('data-validetta', 'required');
                    <?php } ?>
                }
                if(id == 'upvideo' && visibility == 'none') {
                    $('#weddingvideo').attr('data-validetta', '');
                }
                if(id == 'upphoto' && visibility == 'inline') {
                    <?php if ($story_id == '') { ?>
                        $('#weddingphoto').attr('data-validetta', 'required');
                    <?php } ?>
                }
                if(id == 'upphoto' && visibility == 'none') {
                    $('#weddingphoto').attr('data-validetta', '');
                }
            }
        </script>
    </body>
</html>