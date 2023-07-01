<?php 
																$SQL_STATEMENT_PROFILE_BY = $DatabaseCo->dbLink->query("SELECT * FROM profile_by WHERE status='APPROVED' ORDER BY id ASC");
 																while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_PROFILE_BY)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($DatabaseCo->dbRow->profileby)){ if($DatabaseCo->dbRow->profileby == $DatabaseCo->dbRow->profile_by){ echo 'selected';} }?>><?php echo $DatabaseCo->dbRow->profile_by; ?></option>
                                                                <?php } ?>