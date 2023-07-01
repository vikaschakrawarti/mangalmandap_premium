                                                                <?php
																	$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                                                	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>">
                                                                    <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
                                                                </option>
                                                               
                                                                <?php } ?>