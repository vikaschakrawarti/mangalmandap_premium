							<?php
								$SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
								while($row_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
							?>
								<option value="<?php echo $row_star->star_id; ?>" <?php if($row->star == $row_star->star_id){echo "selected";}?> >
									<?php echo $row_star->star; ?>
								</option>
							<?php } ?>