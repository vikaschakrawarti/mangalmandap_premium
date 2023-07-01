<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Config.class.php';
$configObj = new Config();
$DatabaseCo = new DatabaseConn();

$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$select=$DatabaseCo->dbLink->query("select * from register_view where matri_id='".$mid."'");
$fetch=mysqli_fetch_array($select);

$payu_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='3'"));

// Merchant key here as provided by Payu
$MERCHANT_KEY = $payu_data->merchant_key;
// Merchant product info.
// Populate name, merchantId, description, value, commission parameters as per your code logic; in case of multiple splits pass multiple json objects in paymentParts
$firstSplitArr = array("name"=>"splitID1", "value"=>"6", "merchantId"=>$payu_data->merchant_id, "description"=>"test description", "commission"=>"2");
$paymentPartsArr = array($firstSplitArr);	
$finalInputArr = array("paymentParts" => $paymentPartsArr);
$Prod_info = json_encode($finalInputArr);
//var_dump($Prod_info);
// Merchant Salt as provided by Payu
$SALT = $payu_data->salt;
// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";
$action = '';
$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}


if(isset($_REQUEST['submit_payu'])){
    $_SESSION['plan']=$_REQUEST['plan_name'];
    $_SESSION['plan_id']=$_REQUEST['plan_id'];
    $_SESSION['amount']=$_REQUEST['plan_amount'];	 
    $_REQUEST['plan_amount'];
}


?>
<html>
    <head>
        <!-- Required Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        
        <script src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js"></script>
        
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
    </head>
    <body>
        <div id="wrap">
  	        <div id="main">
                
                <!-- Header & Menu -->
                <?php include "parts/header.php"; ?>
                <?php include "parts/menu.php"; ?>
                <!-- /. Header & Menu -->
                
                <div class="container">	
                    <ol class="breadcrumb mt-20">
                        <li><a href="#">Home</a></li>
                        <li class="active">PayU Form</li>
                    </ol>
                    <div class="panel panel-success">
                    <div class="panel-heading">
                      <h3 class="panel-title"> Fill Details </h3>
                    </div>
                    <div class="panel-body">
				        <div class="col-sm-8 col-sm-offset-4">
                            <?php if($formError) { ?>
                            <span style="color:red">Please fill all mandatory fields.</span>
                            <br/>
                            <br/>
                            <?php } ?>
                            <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm" class="form-horizontal">
                                <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
                                <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                <h3 class="text-primary text-center">Mandatory Parameters</h3>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">
                                        Amount (Rs.)&nbsp;<font class="text-danger">*</font>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="amount" value="<?php echo $_SESSION['amount'];?>" class="form-control" id="amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">
                                        User Name &nbsp;<font class="text-danger">*</font>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="firstname" id="firstname" value="<?php echo $fetch['username'];?>" class="form-control">
                                    </div>
                                </div>        
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Email &nbsp;<font class="text-danger">*</font></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" id="email" value="<?php echo $fetch['email'];?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">Phone &nbsp;<font class="text-danger">*</font></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone" value="<?php echo $fetch['mobile'];?>"  class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-6 control-label">
                                        Product Info &nbsp;<font class="text-danger">*</font>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="productinfo" class="form-control">Matrimony Membership <?php echo $_SESSION['plan'];?> Plan</textarea>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label for="inputEmail3" class="col-sm-6 control-label">
                                        Success URI &nbsp;<font class="text-danger">*</font>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="surl" value="<?php echo $configObj->getConfigname();?>/payupaymentConfirmation?plan=<?php echo $_SESSION['plan_id'];?>&id=<?php echo $_SESSION['user_id'];?>" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-group" style="display:none;">
                                    <label for="inputEmail3" class="col-sm-6 control-label">
                                        Failure URI &nbsp;<font class="text-danger">*</font>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="furl" value="<?php echo $configObj->getConfigname();?>/membershipplans" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="service_provider" value="payu_paisa" size="64"/>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-8 col-sm-8">
                                        <?php if(!$hash) { ?>
                                        <input type="submit" value="Submit" name="submit" class="btn btn-success btn-lg"/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>          		
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "parts/footer.php"; ?>
</body>

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
    <script>
        var hash = '<?php echo $hash ?>';
        /*function submitPayuForm() {

        alert('ok');	
        if(hash == '') {
        return;
        }
        var payuForm = document.forms.payuForm;*/
        <?php if($hash!=''){?>
        $('#payuForm').submit();
        <?php }?>
    /* }*/
    </script>
</html>
<?php include'thumbnailjs.php';?>                  