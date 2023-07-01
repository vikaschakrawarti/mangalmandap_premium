<?php 
	if(!isset($_SESSION['admin_user_name'])){
    	header("location: index.php");
		echo "<script>window.location='index'</script>";
    }
	$loggedn_user = isset($_SESSION['admin_user_name'])?$_SESSION['admin_user_name']: "Admin" ;
?>
<header class="main-header">
	<a href="dashboard" class="logo"><b>Control</b> Panel</a>
	<nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
       	<a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button"><i class="fas fa-bars"></i></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              	<li class="dropdown user user-menu">
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  		<span class="hidden-xs">Hello, <b class="font600"><?php echo $loggedn_user;?></b></span>
                	</a>
                	<ul class="dropdown-menu">
                  		<li class="user-header">
                    		<p><?php echo $_SESSION['admin_email'];?></p>
                  		</li>
                	</ul>
              	</li>
              	<li>
              		<a href="../index" target="_blank" class="">
                		<span class="pull-left mr-10"><i class="fa fa-desktop fontS12"></i></span>
                    	<span class="pull-left">Front End</span>
                    	<div class="clearfix"></div>
                	</a>
              	</li>
              	<li>
              		<a href="index.php?option=logout" class="">
                		<span class="pull-left mr-10"><i class="fas fa-sign-out-alt"></i></span>
                    	<span class="pull-left">Logout</span>
                    	<div class="clearfix"></div>
                	</a>
             	</li>
           	</ul>
        </div>
	</nav>
</header>