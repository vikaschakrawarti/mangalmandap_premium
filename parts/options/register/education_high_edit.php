										<?php
											$get_edu=explode(",",$DatabaseCo->dbRow->edu_detail);
											$SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ");
                               				while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu)){
                               			?>
                               				<option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if( $get_edu[0] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
												<?php echo $DatabaseCo->Row->edu_name; ?>
											</option>
                               			<?php } ?>