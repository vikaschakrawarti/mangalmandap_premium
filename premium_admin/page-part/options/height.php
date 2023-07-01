							<?php
								$SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
								while($row_height = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
							?>
							<option value="<?php echo $row_height->id; ?>"  <?php if(isset($row['height']) && $row['height']!='') { if($row['height'] == $row_height->id ){echo "selected";}}  ?> <?php ?>><?php echo $row_height->height; ?></option>
							<?php } ?>	