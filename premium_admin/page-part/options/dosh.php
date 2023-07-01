						<?php $manglik=explode(", ",$row['manglik']);?>
						<?php
						$SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
						while($row_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
						?>
						<option value="<?php echo $row_dosh->dosh_id; ?>" <?php if(in_array($row_dosh->dosh_id,$manglik)){ echo "selected"; } ?>><?php echo $row_dosh->dosh; ?>
						</option>
						<?php } ?>