	<?php
	$search_arr2 = explode(',',$row['part_mtongue']);
	$SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
	while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)){
	?>
    <option value="<?php echo $DatabaseCo->Row->mtongue_id ?>" <?php if(in_array($DatabaseCo->Row->mtongue_id, $search_arr2)){ echo "selected"; }?>>  
    	<?php echo $DatabaseCo->Row->mtongue_name; ?>
    </option>
  <?php } ?>