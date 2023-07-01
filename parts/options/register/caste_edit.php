										<?php
									   		$SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste where status='APPROVED' ");
		                           			while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){ ?>
                                    			<option value="<?php echo $DatabaseCo->Row->caste_id ?>" <?php if($DatabaseCo->dbRow->caste==$DatabaseCo->Row->caste_id){ echo "selected"; } ?>>
													<?php echo $DatabaseCo->Row->caste_name ?>
												</option>
                                   		<?php } ?>