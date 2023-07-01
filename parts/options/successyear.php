																		
																		<?php
																		$SQL_SITE_SETTING_SUCCESSYEAR = $DatabaseCo->dbLink->query("SELECT success_marriage_year FROM site_config WHERE id='1' ");
																		$success_year_data = mysqli_fetch_object($SQL_SITE_SETTING_SUCCESSYEAR);
																			$success_year=$success_year_data->success_marriage_year;
																			for ($x = $success_year; $x >= 1960; $x--) { ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                         <?php } ?>