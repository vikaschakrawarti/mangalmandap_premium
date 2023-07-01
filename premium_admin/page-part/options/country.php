										<?php
											$SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT * FROM country where status='APPROVED'  ");
											while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_country)){
										?>
										<option value="<?php echo $DatabaseCo->Row->country_id ?>" <?php if($row['country_id'] == $DatabaseCo->Row->country_id){ echo "selected"; } ?>>
											<?php echo $DatabaseCo->Row->country_name; ?>
										</option>
										<?php } ?>