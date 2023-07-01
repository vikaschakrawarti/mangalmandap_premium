                                                                    <?php
																		$SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
																		while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
																    ?>
																        <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
																    <?php } ?>