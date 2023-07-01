				<?php
				//Make 18 Year Selected for Search
				if(isset($DatabaseCo->dbRow->part_frm_age)){
					$selected_a=$DatabaseCo->dbRow->part_frm_age;
				}else{
					$selected_a="1";
				}
				$SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
				while ($row_age = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
				?>
				  <option value="<?php echo $row_age->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $row_age->id ){ echo 'selected'; }} ?>><?php echo $row_age->age; ?> Year</option>
				<?php } ?>