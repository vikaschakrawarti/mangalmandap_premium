 <?php
$SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_STAR)){
?>
<option value="<?php echo $DatabaseCo->dbRow->star_id; ?>" <?php if($DatabaseCo->dbRow->star == $DatabaseCo->dbRow->star_id){echo "selected";}?> ><?php echo $DatabaseCo->dbRow->star; ?></option>
<?php } ?>
