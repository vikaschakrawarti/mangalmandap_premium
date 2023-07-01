										<?php
									   		$SQL_STATEMENT_occu =  $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED'  ");
											while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_occu)){
									   	?>
									   	<option value="<?php echo $DatabaseCo->Row->ocp_id ?>" <?php if($DatabaseCo->dbRow->occupation==$DatabaseCo->Row->ocp_id){ echo "selected"; }?>>
											<?php echo $DatabaseCo->Row->ocp_name; ?>
										</option>
									   <?php } ?>