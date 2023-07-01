<?php
$SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
?>
<option value="<?php echo $DatabaseCo->dbRow->dosh_id; ?>"><?php echo $DatabaseCo->dbRow->dosh; ?>
</option>
<?php } ?>
