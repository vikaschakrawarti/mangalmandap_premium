							<div class="col-xxl-4 col-xs-8 col-lg-4 gt-margin-bottom-10">
                    			<a href="member-profile?view_id=<?php echo $Row->matri_id;?>" target="_blank" class="gt-result">
                                	<div class="thumbnail">
								        <?php include('search-result-photo.php');?>
                                    </div>
                                    <h5 class="text-center gt-text-orange">
                                    	<?php if($username_settings->username_setting == 'full_username'){?>
                                            <?php echo $Row->username; ?>(<?php echo $Row->matri_id; ?>)
										<?php }elseif($username_settings->username_setting == 'first_surname'){?>
								            <?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>(<?php echo $Row->matri_id; ?>)
								        <?php }else{ ?>
								            <?php echo $Row->matri_id; ?>
										<?php } ?>
                                    </h5>
                                    <article class="gt-margin-bottom-5 text-center">
                                    	<?php echo floor((time() - strtotime($Row->birthdate))/31556926); ?> Years, <?php $ao3 = $Row->height;
																	$SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height WHERE id='".$ao3."'");
																	$DatabaseCo->Row1 = mysqli_fetch_object($SQL_STATEMENT_HEIGHT);
																	echo $DatabaseCo->Row1->height; ?> , <?php echo $Row->ocp_name;?>
                                    </article>
                                    <article class="text-center">
                                    	<?php if($Row->city_name!=''){echo $Row->city_name;}else{ echo "N/A";}?>,<?php echo $Row->country_name;?>
                                    </article>
                                    </a>
                                    
                                    <?php	
										if(isset($_SESSION['user_id'])){
											if(isset($sql_exp) && $sql_exp->receiver_response=='Pending'){
									?>
                            		
                                    <button class="btn gt-btn-green btn-block gt-margin-top-5 gtFontSMXS12" onClick="sendreminder(<?php echo $sql_exp->ei_id?>);" id="reminder<?php echo $sql_exp->ei_id;?>" title="Send Reminder" >
                                    	<i class="fa fa-bell gt-margin-right-5"></i><?php echo $lang['Send Reminder']; ?>
                                    </button>
									<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Accept'){?>
										<h5 class="interestAccepted"><?php echo $lang['Interest Accepted']; ?></h5>
									<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Reject'){?>
										<h5 class="interestRejected"><?php echo $lang['Interest Rejected']; ?></h5>
                                    <?php }else{?>	
                                        <button class="btn gt-btn-green btn-block gt-margin-top-5 gtFontSMXS12" onclick="ExpressInterest('<?php echo $Row->matri_id;?>')" title="Send Interest" data-target="#myModal1" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    		<i class="fa fa-heart"></i> <?php echo $lang['Send Interest']; ?>
                                    	</button>
                                    <?php }}?>
                                    
                        		
                            </div>