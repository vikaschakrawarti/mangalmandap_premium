																		
																		<?php
																			$SQL_SITE_SETTING_BIRTHYEAR = $DatabaseCo->dbLink->query("SELECT birthyear FROM site_config WHERE id='1' ");
																			$birth_year_data = mysqli_fetch_object($SQL_SITE_SETTING_BIRTHYEAR);
																			$birth_year=$birth_year_data->birthyear;
																			for ($x = $birth_year; $x >= 1924; $x--) { ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                         <?php } ?>