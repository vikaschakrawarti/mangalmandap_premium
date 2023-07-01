 <?php
											$SQL_STATEMENT_city = $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE cnt_id='".$row['country_id']."' AND state_id='".$row['state_id']."' and status='APPROVED' ORDER BY city_name ASC");
											while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_city)) {
										?>
											<option value="<?php echo $DatabaseCo->dbRow->city_id; ?>" <?php if($DatabaseCo->dbRow->city_id == $row['city']){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->city_name ?></option>
										<?php } ?>