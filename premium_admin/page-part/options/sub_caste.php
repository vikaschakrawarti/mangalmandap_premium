							<?php
								$SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_id,sub_caste_name FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
                            	while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->Row->sub_caste_id; ?>" <?php if($row['subcaste'] == $DatabaseCo->Row->sub_caste_id){ echo "selected" ; }?>>
								<?php echo $DatabaseCo->Row->sub_caste_name; ?>
							</option>
                            <?php } ?>