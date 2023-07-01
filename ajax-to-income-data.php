<?php 
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	$part_income_to_id =$_REQUEST['income_id'];
?>
<?php
$SQL_STATEMENT_INCOME_TO =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_INCOME_TO)){
?>
<option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($regSdata->income) != ''){ if($regSdata->income ==$DatabaseCo->dbRow->id ){ echo 'selected'; }}if($DatabaseCo->dbRow->id <= $part_income_to_id ){echo 'disabled'; } ?>><?php echo $DatabaseCo->dbRow->income; ?></option>
<?php } ?>

 
