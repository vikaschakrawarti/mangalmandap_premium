<?php
$SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_RASI)){
?>
<option value="<?php echo $DatabaseCo->dbRow->rasi_id; ?>"><?php echo $DatabaseCo->dbRow->rasi; ?></option>
<?php } ?>
