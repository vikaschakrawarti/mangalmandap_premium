																<?php
																	$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                                                                	while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->Row->mtongue_id; ?>" <?php if (isset($DatabaseCo->dbRow->m_tongue) && ($DatabaseCo->dbRow->m_tongue == $DatabaseCo->Row->mtongue_id)) { echo "selected" ;}?>>
																	<?php echo $DatabaseCo->Row->mtongue_name; ?>
																</option>
                                                                <?php } ?>