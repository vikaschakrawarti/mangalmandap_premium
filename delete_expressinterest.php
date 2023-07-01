<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['exp_id']) && !isset($_POST['exp_status']) && $_POST['exp_page']=='sent'){
	$DatabaseCo->dbLink->query("UPDATE expressinterest SET trash_sender='Yes' WHERE ei_id='".$_POST['exp_id']."'");
}
if(isset($_POST['exp_id']) && !isset($_POST['exp_status']) && $_POST['exp_page']=='receiver'){
	$DatabaseCo->dbLink->query("UPDATE expressinterest SET trash_receiver='Yes' WHERE ei_id='".$_POST['exp_id']."'");
}
if(isset($_POST['exp_status']) && $_POST['exp_status']=='trash_all' && $_POST['exp_page']=='receiver'){
	$DatabaseCo->dbLink->query("UPDATE expressinterest SET trash_receiver='Yes' WHERE ei_id IN (".$_POST['exp_id'].")");
}
if(isset($_POST['exp_status']) && $_POST['exp_status']=='trash_all' && $_POST['exp_page']=='sent'){
	$DatabaseCo->dbLink->query("UPDATE expressinterest SET trash_sender='Yes' WHERE ei_id IN (".$_POST['exp_id'].")");
}


?>