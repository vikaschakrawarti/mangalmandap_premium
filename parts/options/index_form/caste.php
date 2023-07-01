							<?php
                           		$SQL_STATEMENT_CASTE = $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' AND religion_id='".$reg_religion."' ORDER BY caste_name ASC") or die(mysqli_error($DatabaseCo->dbLink));
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_CASTE )) {
                            ?>		
                            	<option value="<?php echo $DatabaseCo->dbRow->caste_id; ?>">
									<?php echo $DatabaseCo->dbRow->caste_name ?>
								</option>
                            <?php } ?>