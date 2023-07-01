											<?php
											$selected_h_b='13';

											$SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
											while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
											?>
											<option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
											<?php if($DatabaseCo->dbRow->id <= $selected_h_b ){ 
														echo 'disabled'; 
													}if($selected_h_b == $DatabaseCo->dbRow->id ){
														echo 'selected';	
													} 
											  ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
											<?php } ?>