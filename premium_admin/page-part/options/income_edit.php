<?php $part_income = explode(",",$row['part_income']); ?>
<?php

	$SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
	while($row_pref_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
?>
<option value="<?php echo $row_pref_income->id; ?>" <?php if(in_array($row_pref_income->id, $part_income)){ echo "selected"; } ?>><?php echo $row_pref_income->income; ?></option>
<?php } ?>