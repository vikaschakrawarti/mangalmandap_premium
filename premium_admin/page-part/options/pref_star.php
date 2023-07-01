<?php  $part_star = explode(', ',$row['part_star']);?>
<?php
$SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
while($row_pref_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
?>
<option value="<?php echo $row_pref_star->star_id; ?>" <?php if(in_array($row_pref_star->star_id, $part_star)){ echo "selected";}?>><?php echo $row_pref_star->star; ?></option>
<?php } ?>
