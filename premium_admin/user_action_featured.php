<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();
$from = $configObj->getConfigFrom();
$logo = $configObj->getConfigLogo();

if(isset($_POST['ac_status']) && $_POST['ac_status']=='Featured'){
    $user_id=str_replace(",","','",$_POST['user_id']);
    $DatabaseCo->dbLink->query("UPDATE register SET fstatus='Featured' WHERE matri_id IN ('$user_id')");
    $result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Featured Profile'");
    $rowcs5 = mysqli_fetch_object($result45);

    $resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id ='".$user_id ."'");
    $rowcc = mysqli_fetch_object($resultcc);
    $name = $rowcc->firstname;
    $matriid = $rowcc->matri_id;
    $fb = $rowcc->facebook;
    $li= $rowcc->twitter;
    $tw = $rowcc->linkedin;
    $gp = $rowcc->google;
    $contactno = $rowcc->contact_no;

    $subject = $rowcs5->EMAIL_SUBJECT;	
    $message = $rowcs5->EMAIL_CONTENT;
    $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
    $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name,"contactno"=>$contactno);
    $email_template = strtr($email_template, $trans);  
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= 'From:'.$from."\r\n";
    

    while ($row = mysqli_fetch_object($select)){
        $email = $row->email;
        mail($email, $subject, $email_template, $headers);
    }
}

    if(isset($_POST['ac_status']) && $_POST['ac_status']=='Remove_Featured'){
    $user_id=str_replace(",","','",$_POST['user_id']);
    $DatabaseCo->dbLink->query("UPDATE register set fstatus='' WHERE matri_id IN ('$user_id')");
    $result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Featured Profile'");
    $rowcs5 = mysqli_fetch_object($result45);

    $resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id ='".$user_id ."'");
    $rowcc = mysqli_fetch_object($resultcc);
    $name = $rowcc->firstname;
    $matriid = $rowcc->matri_id;
    $fb = $rowcc->facebook;
    $li= $rowcc->twitter;
    $tw = $rowcc->linkedin;
    $gp = $rowcc->google;
    $contactno = $rowcc->contact_no;

    $subject = $rowcs5->EMAIL_SUBJECT;	
    $message = $rowcs5->EMAIL_CONTENT;
    $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
    $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name,"contactno"=>$contactno);
    $email_template = strtr($email_template, $trans);  
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= 'From:'.$from."\r\n";
    while ($row = mysqli_fetch_object($select)){
        $email = $row->email;
        mail($email, $subject, $email_template, $headers);
    }
}

?>