<?php 
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	$part_age_to_id = $_REQUEST['id'];
?>
<?php
$SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
?>
  <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if($DatabaseCo->dbRow->id <= $part_age_to_id ){ echo 'disabled'; } ?> ><?php echo $DatabaseCo->dbRow->age; ?> Year</option>
<?php } ?>  
