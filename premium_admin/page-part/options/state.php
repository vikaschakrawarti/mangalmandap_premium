                                        <?php
											$SQL_STATEMENT_state = $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id='".$row['country_id']."' and status='APPROVED' ORDER BY state_name ASC");
											while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_state)) {
										?>
											<option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" <?php if($DatabaseCo->dbRow->state_id == $row['state_id']){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->state_name; ?></option>
										<?php } ?>