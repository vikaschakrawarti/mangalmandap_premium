<?php
$SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
?>
<option value="<?php echo $DatabaseCo->dbRow->id; ?>"><?php echo $DatabaseCo->dbRow->income; ?></option>
<?php } ?>