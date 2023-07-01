<?php
	$SQL_STATEMENT_religion =  $DatabaseCo->dbLink->query("SELECT * FROM religion where status='APPROVED'");
	while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_religion)){ 
?>
	<option value="<?php echo $DatabaseCo->Row->religion_id ?>" <?php if($DatabaseCo->dbRow->religion == $DatabaseCo->Row->religion_id){ echo "selected"; } ?>>
		<?php echo $DatabaseCo->Row->religion_name ?>
	</option>
<?php } ?>