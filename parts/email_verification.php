					<?php
					$SQL_SITE_SETTING = $DatabaseCo->dbLink->query("SELECT profile_verification FROM site_config WHERE id='1' ");
					$profile_method = mysqli_fetch_object($SQL_SITE_SETTING);
					if (isset($_REQUEST['confirm_id'])) {
                        $confid = $_REQUEST['confirm_id'];
                        $confemail = $_REQUEST['email'];
                        $select = $DatabaseCo->dbLink->query("SELECT matri_id,country_id,mobile,status FROM register WHERE email='$confemail' and cpassword='$confid'");
                        $exe = mysqli_num_rows($select);
                        $rowcc = mysqli_fetch_array($select);
                        $rowcc['status'];
                        if ($exe > 0) {
                            if ($rowcc['status'] == 'Inactive') {
								$text = "Congratulations! Your account has been activated Successfully.Login and find your life partner with us.Your Login id is " . $rowcc['matri_id'] . "";
                               	
								if($profile_method->profile_verification == 'auto_approve'){
                                	$update = $DatabaseCo->dbLink->query("UPDATE register SET cpass_status='yes',status='Active' WHERE email='$confemail'");
					?>
								<script>alert('<?php echo $text; ?>');</script>
								<script>window.location='index';</script>
					<?php 
						}else{
							$update = $DatabaseCo->dbLink->query("UPDATE register SET cpass_status='yes' WHERE email='$confemail'");
					?>
								<script>alert('Your Email id is verified.');</script>
								<script>window.location='index';</script>
					<?php } ?>
                    <?php } else { ?>
                                 <script>alert('Profile is already activated.');</script>
                                 <script>window.location='index';</script>
                    <?php }
                        } else {
                    ?>
                            <script>alert('Error in activation...');</script>
                    <?php
                        }
                    }
                    ?>