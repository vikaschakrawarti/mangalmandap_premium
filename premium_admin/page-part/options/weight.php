																		<?php
																			$SQL_SITE_SETTING_WEIGHT = $DatabaseCo->dbLink->query("SELECT weight_first,weight_last FROM site_config WHERE id='1' ");
																			$weight_data = mysqli_fetch_object($SQL_SITE_SETTING_WEIGHT);
																			$weight_first=$weight_data->weight_first;
																			$weight_last=$weight_data->weight_last;
																			for ($x = $weight_first; $x <= $weight_last; $x++) { ?>
                                                                            <option value='<?php echo $x; ?>'  <?php if(isset($row['weight']) && $row['weight']!='') { if($row['weight'] == $x){echo "selected";} }?>  <?php ?>>
                                                                                <?php echo $x; ?> Kg
                                                                            </option>
                                                                         <?php } ?>								
