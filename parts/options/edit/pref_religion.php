		<?php
			$search_arr3 = explode(',',$DatabaseCo->dbRow->	part_religion);
			$SQL_STATEMENT_rel =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ");
			while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_rel)){
		  ?>
          <option value="<?php echo $DatabaseCo->Row->religion_id; ?>" <?php if(in_array($DatabaseCo->Row->religion_id, $search_arr3)){ echo "selected"; }?>>  
          <?php echo $DatabaseCo->Row->religion_name; ?>
          </option>
          <?php } ?>