											<?php
											$selected_i_b='13';

											$SQL_STATEMENT_INCOME_TO =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
											while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_INCOME_TO)){
											?>
											<option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
											<?php if($DatabaseCo->dbRow->id <= $selected_i_b ){ 
														echo 'disabled'; 
													}if($selected_h_b == $DatabaseCo->dbRow->id ){
														echo 'selected';	
													} 
											  ?>><?php echo $DatabaseCo->dbRow->income; ?></option>
											<?php } ?>