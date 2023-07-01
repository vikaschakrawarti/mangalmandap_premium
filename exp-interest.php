<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
		<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>

        <!-- Theme Color -->
        <meta name="theme-color" content="#549a11">
        <meta name="msapplication-navbutton-color" content="#549a11">
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        
		<!-- Bootstrap & Custom CSS-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
	  	
	  	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>

        <!-- Google Fonts -->
        <?php include('parts/google_fonts.php');?>
        
        <!-- Owl Carousel CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
    </head>
    <body>
        <!-- Loader -->
        <div class="preloader-wrapper text-center">
            <div class="loader"></div>
            <h5>Loading...</h5>
        </div>
        <!-- /.Loader -->
        <div id="body" style="display:none">
            <div id="wrap">
                <div id="main">
                    <!-- Header & Menu -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu.php"; ?>
                    <!-- /. Header & Menu -->
                    <div class="container gt-margin-top-20">
                        <div class="row">
                            <?php include "parts/express-interest-side-pan.php" ?>
                            <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-exp-main">
                                <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16">
                                    <div class="row" id="exp-1"></div>
                                    <div class="row" id="exp-2"></div>
                                    <div class="row" id="exp-3"></div>
                                    <div class="row" id="exp-4"></div>
                                    <div class="row" id="exp-5"></div>
                                    <div class="row" id="exp-6"></div>
                                    <div class="row" id="exp-7"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "parts/footer.php"; ?>
        </div>
        <!-- Jquery Js-->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap & Green Js -->
        <script src="js/bootstrap.js"></script>
        <script src="js/green.js"></script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>			
        <!---bootstrap and green js End-->
        <script type="text/javascript" src="js/expressinterest.js"></script> 
        <script>
            $('[data-toggle="popover"]').popover({
                trigger: 'click',
                'placement': 'top'
            });
        </script>
        <script>
            jQuery(function ($) {
                var $active = $('#accordion .panel-collapse.in').prev().addClass('active');
                $active.find('a').prepend('<i class="fa fa-minus pull-right"></i>');
                $('#accordion .panel-heading').not($active).find('a').prepend('<i class="fa fa-plus pull-right"></i>');
                $('#accordion').on('show.bs.collapse', function (e) {
                    $('#accordion .panel-heading.active').removeClass('active').find('.fa').toggleClass('fa-plus fa-minus');
                    $(e.target).prev().addClass('active').find('.fa').toggleClass('fa-plus fa-minus');
                })
            });
        </script>
        <!-- Mobile Side Panel Collapse -->
        <script>
            (function($) {
                var $window = $(window),
                $html = $('.mobile-collapse');
                $window.width(function width(){
                    if ($window.width() > 767) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script>
        <script type="text/javascript">
            <?php if(isset($_GET['exp-res-pen'])){
                $DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='".$_GET['exp-res-pen']."'");
            ?>
            getexpreceivependingdata();
            <?php }elseif(isset($_GET['exp-res-rej'])){
                $DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='".$_GET['exp-res-rej']."'");
            ?>
            getexpreceiverejectdata();
            <?php }elseif(isset($_GET['exp-res-acc'])){
                $DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='".$_GET['exp-res-acc']."'");
            ?>
            getexpreceiveacceptgdata();
            <?php }else{ ?>
            getexpsentdata();
            <?php } ?>
            
            $('#exp-1').on('click','.page-numbers',function(){
                if($(".xyz.active").attr("id")=='sent_all_define'){
                    var exp_status='sent_all_interest';
                }else if($(".xyz.active").attr("id")=='receive_all_define'){
                    var exp_status='receive_all_interest';
                }
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-result",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-1').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-1').on('click',function(){
                getexpsentdata();
            });
            $('#exp-link-2').on('click',function(){
                getexpsentacceptdata();
            });
            $('#exp-2').on('click','.page-numbers',function(){
                var exp_status='sent_accept_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-sent-accept",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-2').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-3').on('click',function(){
                getexpsentrejectdata();
            });
            $('#exp-3').on('click','.page-numbers',function(){
                var exp_status='sent_reject_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-sent-reject",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-3').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-4').on('click',function(){
                getexpsentpendingdata();
            });
            $('#exp-4').on('click','.page-numbers',function(){
                var exp_status='sent_pending_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-sent-pending",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-4').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-5').on('click',function(){
                getexpreceiveacceptgdata();
            });
            $('#exp-5').on('click','.page-numbers',function(){
                var exp_status='receive_accept_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-receive-accept",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-5').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-6').on('click',function(){
                getexpreceiverejectdata();
            });
            $('#exp-6').on('click','.page-numbers',function(){
                var exp_status='receive_reject_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-receive-reject",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-6').html(response);
                    }
                });
                return false;
            });
            $('#exp-link-7').on('click',function(){
                getexpreceivependingdata();
            });
            $('#exp-7').on('click','.page-numbers',function(){
                var exp_status='receive_pending_interest';
                $page = $(this).attr('href');
                $pageind = $page.indexOf('page=');
                $page = $page.substring(($pageind+5));
                var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
                $.ajax({
                    url:"parts/exp-receive-pending",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(response){
                        $('#exp-7').html(response);
                    }
                });
                return false;
              });
        </script>
	</body>
</html>                                                                                                                             
<?php include'thumbnailjs.php';?>                  

