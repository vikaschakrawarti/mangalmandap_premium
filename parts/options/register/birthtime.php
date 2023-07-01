                            <?php
                                for ($i = 12; $i > 0; $i--) {
                                    for ($j = 0; $j < 60; $j++) {
                                        if (strlen($j) == '1') {
                                            $k = '0' . $j;
                                        } else {
                                            $k = $j;
                                        }
                                        ?>
                                        <option value="<?php echo $i . ":" . $k . " am"; ?>"><?php echo $i . ":" . $k . " am"; ?></option>	
                                        <?php
                                    }
                                }
                            ?>
                            <?php
                                for ($i = 12; $i > 0; $i--) {
                                    for ($j = 0; $j < 60; $j++) {
                                        if (strlen($j) == '1') {
                                            $k = '0' . $j;
                                        } else {
                                            $k = $j;
                                        }
                                        ?>
                                        <option value="<?php echo $i . ":" . $k . " pm"; ?>"><?php echo $i . ":" . $k . " pm"; ?></option>	
                                        <?php
                                    }
                                }
                            ?>