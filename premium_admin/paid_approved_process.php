<?php
    include_once '../databaseConn.php';
    include_once '../class/Config.class.php';
    $configObj = new Config();
    include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $website =  $configObj->getConfigName();
    $webfriendlyname =  $configObj->getConfigFname();
    $from = $configObj->getConfigFrom();
    $logo = $configObj->getConfigLogo();
    $pmatri_id= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mid']);
    $pname= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['name']);
    $pemail= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['email']);
    $paddress= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['address']);
    $paymode= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['pay_mode']);
    $pactive_dt= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['activedt']);
    $p_plan= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan']);
    $chat= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['chat']);
    $p_bank_detail= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['bankdet']);
    $plan_duration= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['duration']);
    $p_no_contacts= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_contacts']);
    $p_msg= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_msg']);
    $p_sms= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_sms']);
    $profile= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_profile']);
    $p_amount= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['amount']);
    $delete=$DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id='$pmatri_id'");
    $date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
    $exp_date=date('Y-m-d', $date);
    $DatabaseCo->dbLink->query("INSERT INTO payments(pmatri_id,pname,pemail,paddress, paymode,pactive_dt,p_plan,plan_duration,profile,chat,p_no_contacts, p_amount,p_bank_detail,p_msg,p_sms,exp_date) VALUES('$pmatri_id','$pname','$pemail','$paddress','$paymode','$pactive_dt','$p_plan','$plan_duration','$profile','$chat','$p_no_contacts','$p_amount','$p_bank_detail','$p_msg','$p_sms','$exp_date')");

    $mid = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mid']);
    $update=$DatabaseCo->dbLink->query("UPDATE register SET status='Paid' WHERE matri_id = '$mid' ")or die(mysqli_error());
    //mail sent to paid member
    $result = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id = '$mid' ");
    while($row = mysqli_fetch_object($result)){
        $name  = mysqli_real_escape_string($DatabaseCo->dbLink,$row->username); 
        $to  = mysqli_real_escape_string($DatabaseCo->dbLink, $row->email);
        $matriid  = mysqli_real_escape_string($DatabaseCo->dbLink,$row->matri_id);
        $email  = mysqli_real_escape_string($DatabaseCo->dbLink,$row->email);
        $mno  = mysqli_real_escape_string($DatabaseCo->dbLink,$row->mobile);
        $pass = mysqli_real_escape_string($DatabaseCo->dbLink,$row->password);
        $website = mysqli_real_escape_string($DatabaseCo->dbLink,$row->web_name);
        $webfriendlyname = mysqli_real_escape_string($DatabaseCo->dbLink,$row->web_frienly_name);
        $webtomail = mysqli_real_escape_string($DatabaseCo->dbLink,$row->to_email);
        $webfrommail = mysqli_real_escape_string($DatabaseCo->dbLink,$row->from_email);
        $from = mysqli_real_escape_string($DatabaseCo->dbLink, $row->from_email);
        $fb = mysqli_real_escape_string($DatabaseCo->dbLink, $row->facebook); 
        $li= mysqli_real_escape_string($DatabaseCo->dbLink, $row->linkedin);
        $tw = mysqli_real_escape_string($DatabaseCo->dbLink, $row->twitter);
        $gp = mysqli_real_escape_string($DatabaseCo->dbLink, $row->google);
        $contactno =mysqli_real_escape_string($DatabaseCo->dbLink, $row->contact_no);
        $result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Paid Member'");
        $rowcs5 = mysqli_fetch_object($result45);
	
        $subject = $rowcs5->EMAIL_SUBJECT;	
        $message = $rowcs5->EMAIL_CONTENT;
        $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
        $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name,"contactno"=>$contactno);
        $email_template = strtr($email_template, $trans);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= 'From:'.$from."\r\n";
        mail($to, $subject, $email_template, $headers);
        
    }
    echo "<script>alert('Record Updated Successfully');</script>";
    echo "<script>window.location='memberActiveToPaid.php?success=Paid';</script>";
?>