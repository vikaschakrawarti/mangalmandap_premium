<?php 
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	$part_height_to_id =$_REQUEST['height_id'];
?>
<?php
$SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
?>
<option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($regSdata->height) != ''){ if($regSdata->height ==$DatabaseCo->dbRow->id ){ echo 'selected'; }}if($DatabaseCo->dbRow->id <= $part_height_to_id ){echo 'disabled'; } ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
<?php } ?>

 
