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

/*$sql="select * from sms_api WHERE status='APPROVED'";
$rr=mysqli_query($DatabaseCo->dbLink,$sql) or die(mysqli_error($DatabaseCo->dbLink));
$num_sms=mysqli_num_rows($rr);
$sms=mysqli_fetch_object($rr);*/
if(isset($_POST['ac_status']) && $_POST['ac_status']=='active'){
    echo $user_id=str_replace(",","','",$_POST['user_id']);
    $DatabaseCo->dbLink->query("UPDATE register SET status='Active',fstatus='' WHERE matri_id IN ('$user_id')");
    $DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id=('$user_id')");
    $result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Active Member'");
    $rowcs5 = mysqli_fetch_object($result45);
    $resultcc = $DatabaseCo->dbLink->query("SELECT firstname,lastname,username,email,matri_id,facebook,twitter,linkedin,google FROM register,site_config WHERE matri_id ='".$user_id ."'");
    $rowcc = mysqli_fetch_object($resultcc);
    $name = $rowcc->firstname;
    $matriid = $rowcc->matri_id;
    $fb = $rowcc->facebook;
    $li= $rowcc->twitter;
    $tw = $rowcc->linkedin;
    $gp = $rowcc->google;
	
    $subject = $rowcs5->EMAIL_SUBJECT;	
    $message = $rowcs5->EMAIL_CONTENT;
    $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
    $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name);
    $email_template = strtr($email_template, $trans);
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= 'From:'.$from."\r\n";
	
    $select=$DatabaseCo->dbLink->query("SELECT email,matri_id FROM register WHERE matri_id IN ('$user_id')");
    while ($row = mysqli_fetch_object($select)){
        $email = $row->email;
        mail($email, $subject, $email_template, $headers);
    }	
}

if(isset($_POST['ac_status']) && $_POST['ac_status']=='inactive'){
    $user_id=str_replace(",","','",$_POST['user_id']);
    $DatabaseCo->dbLink->query("UPDATE register SET status='Inactive',fstatus='' WHERE matri_id IN ('$user_id')");
    $DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id=('$user_id')");
	
    $result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Inactive Member'");
    $rowcs5 = mysqli_fetch_object($result45);
    $resultcc = $DatabaseCo->dbLink->query("SELECT firstname,lastname,username,email,matri_id,facebook,twitter,linkedin,google FROM register,site_config where matri_id ='".$user_id ."'");
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
	
    $select=$DatabaseCo->dbLink->query("SELECT email,mobile,matri_id FROM register WHERE matri_id IN ('$user_id')");
    while ($row = mysqli_fetch_object($select)){
        $email = $row->email;
        mail($email, $subject, $email_template, $headers);
    }	
}

if(isset($_POST['ac_status']) && $_POST['ac_status']=='suspended'){
    $user_id=str_replace(",","','",$_POST['user_id']);
    $DatabaseCo->dbLink->query("UPDATE register set status='Suspended',fstatus='' WHERE matri_id IN ('$user_id')");
    $DatabaseCo->dbLink->query("DELETE from payments WHERE pmatri_id=('$user_id')");
    $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Suspend Member'");
    $rowcs5 = mysqli_fetch_object($result45);

    $resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id ='".$user_id ."'");
    $rowcc = mysqli_fetch_object($resultcc);
    $name = $rowcc->firstname;
    $matriid = $rowcc->matri_id;
    $fb = $rowcc->facebook;
    $li= $rowcc->twitter;
    $tw =$rowcc->linkedin;
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

if(isset($_POST['ac_status']) && $_POST['ac_status']=='trash_all'){
    $user_id=str_replace(",","','",$_POST['user_id']);
    $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates WHERE EMAIL_TEMPLATE_NAME = 'Delete Member'");
    $rowcs5 = mysqli_fetch_object($result45);
    $subject = $rowcs5->EMAIL_SUBJECT;	
    $message = $rowcs5->EMAIL_CONTENT;
    $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
    $trans = array("webfriendlyname" =>$webfriendlyname);
    $email_template = strtr($email_template, $trans);
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= 'From:'.$from."\r\n";
    $search_array1 = explode(',',$_POST['user_id']);
    foreach ($search_array1 as $matri_id){
        $select=$DatabaseCo->dbLink->query("SELECT email,photo1,photo2,photo3,photo4,photo5,photo6,matri_id,mobile FROM register WHERE matri_id ='".$matri_id."'");
        $row = mysqli_fetch_object($select);
        is_file(unlink("../my_photos/".$row->photo1));
        is_file(unlink("../my_photos_big/".$row->photo1));
        is_file(unlink("../my_photos/".$row->photo2));
        is_file(unlink("../my_photos_big/".$row->photo2));
        is_file(unlink("../my_photos/".$row->photo3));
        is_file(unlink("../my_photos_big/".$row->photo3));
        is_file(unlink("../my_photos/".$rowphoto4));
        is_file(unlink("../my_photos_big/".$row->photo4));
        is_file(unlink("../my_photos/".$row->photo5));
        is_file(unlink("../my_photos_big/".$row->photo5));
        is_file(unlink("../my_photos/".$row->photo6));
        is_file(unlink("../my_photos_big/".$row->photo6));
  
        $email = $row->email;
        mail($email, $subject, $email_template, $headers);
        
        $del_membership =$DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id ='".$row->matri_id."'");	   	
    }
    $DatabaseCo->dbLink->query("DELETE FROM register WHERE matri_id IN ('$user_id')");
}

?>