																		<?php
																			$SQL_SITE_SETTING_WEIGHT = $DatabaseCo->dbLink->query("SELECT weight_first,weight_last FROM site_config WHERE id='1' ");
																			$weight_data = mysqli_fetch_object($SQL_SITE_SETTING_WEIGHT);
																			echo $weight_first=$weight_data->weight_first;
																			echo $weight_last=$weight_data->weight_last;
																			for ($x = $weight_first; $x <= $weight_last; $x++) { ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?> Kg
                                                                            </option>
                                                                         <?php } ?>	