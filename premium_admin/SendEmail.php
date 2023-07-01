<?php 
    include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

    $SQL_STATEMENT='';
    $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
    if($isPostBack){      
        $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
        if(isset($_POST['sendEmail'])){
            $subject=$_REQUEST['subject'];
            $message=$_REQUEST['msg'];	
            $website =  $configObj->getConfigName();
            $webfriendlyname =  $configObj->getConfigFname();
            $from = $configObj->getConfigFrom();
            switch($ACTION){
                case 'SEND':
                    include ('phpmailer/phpmailer.php');	
                    ob_start();
                    include ("email_format.php");
                    $html_message=ob_get_clean();
                    if(in_array('selectall',$_REQUEST['emailto'])){
                        $status=$_REQUEST['status'];
                        $sql=$DatabaseCo->dbLink->query("SELECT email,mobile FROM register_view WHERE status='$status'");
                        $emailto='';
                        while($row=mysqli_fetch_object($sql)){
                            if($row->email!=''){
                                $emailto.= $row->email.",";
                            }
                        }
                        $email=str_ireplace(",","','",$emailto);	
                        $sub_email=substr($email,0,-3);				
                        $email123="'$sub_email'";
                    }else{
                        $to=$_REQUEST['emailto'];
                        foreach ($to as $address) {
                            $mail->addAddress($address);
                        }
                    }	
                    $mail->Subject= $subject;
                    $mail->Body= $html_message;
                    $mail->send();
                    break;	  
                }
                $statusObj = handle_post_request("SEND",$SQL_STATEMENT,$DatabaseCo);
                $status_MESSAGE = $statusObj->getstatusMessage();
            }else{
                $statusObj = new status();
                $statusObj->setActionSuccess(false);
                $status_MESSAGE = "Please select value to complete action.";	  
            }
        }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
   		<title>Admin | Send Email</title>
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
    	<link rel="stylesheet" href="chosen_v0.13.0/chosen.min.css"/>  
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
		
  		<!-- Checkbox css -->
		<link rel="stylesheet" href="css/all_check.css"/> 
		
		<!-- bootstrap wysihtml5 - text editor -->
    	<link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
                        Send Email To
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i>Home</a></li>
                        <li class="active">Send Email To</li>
                    </ol>
                </section>
	            <?php
                    if(!empty($status_MESSAGE)){
                        if($statusObj->getActionSuccess()){
                            echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$status_MESSAGE."</div>";
                        }else{
                            echo "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$status_MESSAGE."</li></ul></div>";		
                        }
                    }
                ?>     
	            <?php
                    $success= isset($_GET['success']) ? $_GET['success'] :"" ;
                    if(!empty($success)){
                        echo "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
                    }
                ?>   
	            <section class="content">
		            <div class="row">
			            <div class="col-xs-12">
				            <div class="box box-success">
					            <div class="box-header">
						            <h4><i class="fa fa-envelope"></i>&nbsp;&nbsp;Send Email To</h4>
					            </div>
					            <form action="" method="post" id="action_form">
						            <div class="box-body">
							            <div class="form-group">
								            <select class="form-control form-flat" name="status" id="status" onChange="getdetail(this.value);" data-validetta="required">
                                                <option value="">Select Status</option>
                                                <option value="Active">Active Members</option>
                                                <option value="Inactive">Inactive Members</option>
                                                <option value="Paid">Paid Members</option>
                                                <option value="Featured">Featured Members</option>
                                                <option value="Suspended">Suspended Members</option>
								            </select>
								            <div id="status1"></div>
							            </div>
                                        <div class="form-group">
                                            <select multiple class="chzn-select-width form-control" tabindex="16" name="emailto[]" data-placeholder="Email to" style="height:34px !important;" id="email123" data-validetta="required">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject" data-validetta="required"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="msg" data-validetta="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <button class="btn btnThemeG3 btn-lg" id="sendEmail" name="sendEmail" onClick="submitActionForm('SEND');">Send Email</button>
                                            </div>
                                        </div>
                                    </div>
						            <input  type="hidden" name="action" value="" id="action"/>
					            </form>
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
        
        <!-- Jquery for left menu active class-->
        <script type="text/javascript" src="dist/js/general.js"></script>
        <script type="text/javascript" src="dist/js/cookieapi.js"></script>
        <script type="text/javascript">
          setPageContext("send-email","email-list");
        </script>
        
        <!-- Theme Js -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        
    
        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../js/validetta.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('#action_form').validetta({
                    errorClose: false,
                    realTime: true
                });
            });
        </script>
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="chosen_v0.13.0/chosen.jquery.js" type="text/javascript"></script>
        <script type="text/javascript"> 
            var config = {
                '.chzn-select': {},
                '.chzn-select-deselect': {
                    allow_single_deselect: true
                },
                '.chzn-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chzn-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chzn-select-width': {
                    width: "100%"
                }
             }
             for (var selector in config) {
                $(selector).chosen(config[selector]);
             }
        </script>
        <script type="text/javascript">
            function getdetail(val) {
                $("#status1").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
                $.ajax({
                    type: "POST",
                    url: "get_email_list",
                    data: 'status_name=' + val,
                    success: function(data) {
                        $('#email123').find('option').remove().end().append(data);
                        $('#email123').trigger('liszt:updated');
                        $("#status1").html('');
                    }
                });
            }
        </script>
    </body>
</html>