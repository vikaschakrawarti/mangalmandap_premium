							<?php
                            	$SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                           	?>
                            	<option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>">
									<?php echo $DatabaseCo->dbRow->religion_name; ?>
								</option>
                            <?php } ?>