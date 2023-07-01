										<?php
                               				$SQL_STATEMENT_edu1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
                               				while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu1)){
                               			?>
											<option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if(isset($eduucation[1]) && $eduucation[1] !='' && $eduucation[1] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
												<?php echo $DatabaseCo->Row->edu_name; ?>
											</option>
                               			<?php } ?>