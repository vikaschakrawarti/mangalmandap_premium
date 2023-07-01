<?php
				//Make 18 From & 30 To Year Selected for Search
				//$selected_a='1';
				
				if(isset($DatabaseCo->dbRow->part_frm_age)){
					$selected_b=$DatabaseCo->dbRow->part_to_age;
				}else{
					$selected_b='13';
				}
				$SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
				while ($row_age_to = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
				?>
				  <option value="<?php echo $row_age_to->id; ?>" 
						  <?php if($row_age_to->id <= $selected_a ){ 
									echo 'disabled'; 
								}if($selected_b == $row_age_to->id ){
									echo 'selected';	
								} 
						  ?>>
					  <?php echo $row_age_to->age; ?> Year</option>
				<?php } ?>  