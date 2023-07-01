<?php 
	$search_caste = explode(',',$row['part_caste']);
	$SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ");
	foreach($search_arr3 as $rel){
?>
         <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">
            <?php
				while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){
			?>
            <option value="<?php echo $DatabaseCo->Row->caste_id ?>"  <?php if (in_array($DatabaseCo->Row->caste_id, $search_caste)){ echo "selected"; }?>>
            	<?php echo $DatabaseCo->Row->caste_name ?>
          	</option>
        	<?php } ?>
       	 </optgroup>
      <?php
}
?>