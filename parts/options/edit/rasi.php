																		<?php
																		$SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
																		while($row_rasi = mysqli_fetch_object($SQL_STATEMENT_RASI)){
																		?>
																		<option value="<?php echo $row_rasi->rasi_id; ?>" <?php if($DatabaseCo->dbRow->moonsign ==  $row_rasi->rasi_id){ echo "selected"; }?>><?php echo $row_rasi->rasi; ?></option>
																		<?php } ?>							
