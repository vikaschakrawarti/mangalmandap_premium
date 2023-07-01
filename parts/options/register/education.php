																		<?php
																		   $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
																		   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu)){
																        ?>
																		   <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
																        <?php } ?>