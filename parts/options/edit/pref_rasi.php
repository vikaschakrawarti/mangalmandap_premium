<?php  $part_moonsign = explode(',',$DatabaseCo->dbRow->part_rasi);?>
<?php
$SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
while($row_prer_rasi = mysqli_fetch_object($SQL_STATEMENT_RASI)){
?>
<option value="<?php echo $row_prer_rasi->rasi_id; ?>" <?php if(in_array($row_prer_rasi->rasi_id, $part_moonsign)){ echo "selected";}?>><?php echo $row_prer_rasi->rasi; ?></option>
<?php } ?>
