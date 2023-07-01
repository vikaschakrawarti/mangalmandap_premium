															
                                                                <?php
																$SQL_STATEMENT_PROFILE_BY = $DatabaseCo->dbLink->query("SELECT * FROM profile_by WHERE status='APPROVED' ORDER BY id ASC");
 																while ($row_profile_by = mysqli_fetch_object($SQL_STATEMENT_PROFILE_BY)) {
                                                                ?>
                                                                <option value="<?php echo $row_profile_by->id; ?>" <?php if(isset($row['profileby'])){ if($row['profileby'] == $row_profile_by->profile_by){ echo 'selected';} }?>><?php echo $row_profile_by->profile_by; ?></option>
                                                                <?php } ?>