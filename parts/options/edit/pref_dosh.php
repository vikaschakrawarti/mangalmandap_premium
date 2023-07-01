<?php $arr_part_manglik = explode(", ",$DatabaseCo->dbRow->part_manglik); ?>
<?php
$SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
while($row_pref_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
?>
<option value="<?php echo $row_pref_dosh->dosh_id; ?>" <?php if(in_array($row_pref_dosh->dosh_id,$arr_part_manglik)){ echo "selected"; } ?>><?php echo $row_pref_dosh->dosh; ?>
</option>
<?php } ?>
