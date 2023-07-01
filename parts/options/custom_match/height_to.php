											<?php
											/*$SQL_STATEMENT_match = "select part_height_to from matches where matri_id='$s_id'";
											$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
											$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
											if($DatabaseCo->dbRow->$DatabaseCo->dbRow->part_height_to != ''){
												$selected_h_b=$DatabaseCo->dbRow->part_height_to;
											}else{
												$selected_h_b='13';
											}*/
											$SQL_STATEMENT_match = "select part_height_to from matches where matri_id='$s_id'";
											$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
											$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
											if($DatabaseCo->dbRow->part_height_to != ''){
												$selected_h_b=$DatabaseCo->dbRow->part_height_to;
											}else{
												$selected_h_b='1';
											}
											

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