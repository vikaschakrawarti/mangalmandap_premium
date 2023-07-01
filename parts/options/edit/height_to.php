											<?php
												if(isset($DatabaseCo->dbRow->part_height)){
													$selected_h_b=$DatabaseCo->dbRow->part_height_to;
												}else{
													$selected_h_b='13';
												}
											

											$SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
											while($row_height_to = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
											?>
											<option value="<?php echo $row_height_to->id; ?>" 
											<?php if($row_height_to->id <= $selected_h_a ){ 
														echo 'disabled'; 
													}if($selected_h_b == $row_height_to->id ){
														echo 'selected';	
													} 
											  ?>><?php echo $row_height_to->height; ?></option>
											<?php } ?>