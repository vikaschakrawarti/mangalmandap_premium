<li class="gt-panel gt-panel-default <?php if ($Row->fstatus == 'Featured') { echo "gt-spotlight"; } else { echo "gt-panel-default"; } ?> gt-main-profile">
	<a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" target="_blank" class="gt-panel-head">
    	<div class="row">
      		<div class="col-xxl-5 col-xl-5 col-xs-16 col-lg-5 gridFullWidth <?php if ($Row->fstatus == 'Featured') { echo "gt-spotlight-name";  } else { echo "gt-main-name"; } ?>">
        		<h4 class="gt-margin-top-0 gt-margin-bottom-0 inThemeOrange">
          		<?php 
					if($username_settings->username_setting == 'full_username'){
						echo $Row->username;
					}elseif($username_settings->username_setting == 'first_surname'){
						echo $Row->firstname." ".substr($Row->lastname, 0, 1);
					}else{
					}
				?>
                ( <?php echo $Row->matri_id; ?> )	
				</h4>
      		</div>
      		<div class="col-xxl-11 col-xl-11 col-lg-11 col-xs-16 text-right gridHidden">
        		<h5 class="gt-margin-top-5 gt-margin-bottom-0">
         			<?php echo $lang['Register On']; ?>: <?php echo date('d M Y ,H:i A', strtotime($Row->reg_date)); ?>
        		</h5>
      		</div>
     	</div>
  	</a>
  	<a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" target="_blank" class="gt-result-panel-body">
    	<div class="row gt-padding-bottom-15">
			<div class="col-xxl-2 col-xl-2 col-xs-16 col-lg-3 gridFullWidth">
				<div class="thumbnail gt-margin-bottom-0">
				  <?php include('search-result-photo.php'); ?>
				</div>
			</div>
      		<div class="col-xxl-14 col-xl-14 col-xs-16 col-lg-13 gt-margin-top-10 gridFullWidth">
        		<div class="row">
          			<div class="redirect">
            			<div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridFullWidth">
              				<p class="row gt-margin-bottom-0">
               		 			<label class="col-xs-7 "><?php echo $lang['Age']; ?> :</label>
								<span class="col-xs-9">
								<?php
									$birthDate = explode("-", $Row->birthdate);
									//get age from date or birthdate
									$age = ageDOB($birthDate[0], $birthDate[1], $birthDate[2]); 
									echo sprintf("%d years %d months ", $age['y'], $age['m'], $age['d']);
								?> 											
								</span>
              				</p>
            			</div>
            			<div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridFullWidth">
              				<p class="row gt-margin-bottom-0">
								<label class="col-xs-7 "><?php echo $lang['Height']; ?> :</label>
								<span class="col-xs-9">
								<?php
                                    $ao3 = $Row->height;
                                    $SQL_STATEMENT_HEIGHT = $DatabaseCo->dbLink->query("SELECT * FROM height WHERE id='".$ao3."' ");
                                    $height_row=mysqli_fetch_object($SQL_STATEMENT_HEIGHT);
                                    echo $toheight1=$height_row->height;
								?>
								</span>
              				</p>
            			</div>
						<div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridHidden ">
							<p class="row gt-margin-bottom-0">
								<label class="col-xs-7"><?php echo $lang['Religion']; ?> :</label>
								<span class="col-xs-9">
							  		<?php echo $Row->religion_name; ?>
								</span>
						  	</p>
						</div>
            			<div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridHidden">
              				<p class="row gt-margin-bottom-0">
								<label class="col-xs-7"><?php echo $lang['Caste']; ?> :</label>
								<span class="col-xs-9">
								  <?php echo $Row->caste_name; ?>
								</span>
              				</p>
            			</div>
            			<div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridFullWidth">
              				<p class="row gt-margin-bottom-0 ">
								<label class="col-xs-7 gridHidden"><?php echo $lang['Location']; ?> :</label>
								<span class="col-xs-9 gridFullWidth">
									<?php echo $Row->city_name . ', ' . $Row->country_name; ?>
								</span>
              				</p>
            			</div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridHidden">
                            <p class="row gt-margin-bottom-0">
                                <label class="col-xs-7"><?php echo $lang['Education']; ?> :</label>
                                <span class="col-xs-9">
                                    <?php
                                        $a = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
                                        echo $a['edu_name'];
                                    ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridHidden">
                            <p class="row gt-margin-bottom-0">
                                <label class="col-xs-7"><?php echo $lang['Mother Tongue']; ?> :</label>
                                <span class="col-xs-9">
                                    <?php
                                        $a = mysqli_fetch_array(mysqli_query($DatabaseCo->dbLink, "SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS my_language FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id, a.m_tongue ) >0 WHERE a.index_id = '" . $Row->index_id . "'  GROUP BY a.m_tongue"));
                                        echo $a['my_language'];
                                    ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-xs-16 gridHidden">
                            <p class="row gt-margin-bottom-0">
                                <label class="col-xs-7"><?php echo $lang['Occupation']; ?> :</label>
                                <span class="col-xs-9">
                                    <?php echo $Row->ocp_name; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <div class="gt-result-panel-footer">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 gt-margin-top-10 gridHidden">
                <a href="<?php if (isset($_SESSION['user_id'])) { echo "composeMessages?user_id=" . $Row->matri_id . ""; } else { echo "login"; } ?>" class="btn btn-default btn-block inResultSendMessageBtn">
                    <i class="fas fa-envelope"></i> <?php echo $lang['Send Message']; ?>
                </a>
            </div>
            <div class="col-xxl-11 col-xl-11 col-lg-11 pull-right gridFullWidth">
                <div class="row">
                    <div class="col-xxl-5 col-xl-5 col-xs-16 col-lg-5 gt-margin-top-10 gridFullWidth">
                        <?php
                            if (isset($_SESSION['user_id'])) {
                                if (isset($sql_exp) && $sql_exp->receiver_response == 'Pending') {
                        ?>
                        <a  title="Send Reminder" onClick="sendreminder(<?php echo $sql_exp->ei_id ?>);" id="reminder<?php echo $sql_exp->ei_id; ?>" class="btn gt-btn-orange btn-block">
                            <i class="fas fa-bell gt-margin-right-5"></i><?php echo $lang['Send Reminder']; ?>
                        </a>
                        <?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Accept'){ ?>
                        <h5 class="interestAccepted">Interest Accepted</h5>
                        <?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Reject'){ ?>
                        <h5 class="interestRejected">Interest Rejected</h5>
                        <?php } else { ?>	
                        <a data-toggle="modal" data-target="#myModal1" title="Send Interest" onclick="ExpressInterest('<?php echo $Row->matri_id; ?>')" class="btn gt-btn-orange btn-block">
                            <i class="fas fa-heart gt-margin-right-5"></i><?php echo $lang['Send Interest']; ?>
                        </a>
                        <?php } } ?>
                    </div>
                    <?php
                        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
                        $select1 = $DatabaseCo->dbLink->query("SELECT block_id FROM block_profile WHERE block_by='".$user_id."' AND block_to='".$Row->matri_id."'");
                        if (mysqli_num_rows($select1) == 0) {
                    ?>
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-xs-16 gt-margin-top-10 gridHidden">
                        <a <?php if(!isset($_SESSION['user_id'])) { ?>href="login"<?php } ?> class="btn btn-default btn-block inResultBlockBtn gt-cursor 
                        <?php if (isset($_SESSION['user_id'])) { echo "addToshort-data"; } ?>" id="<?php echo $Row->matri_id; ?>" title="Add to Blocklist">
                            <i class="fas fa-ban gt-margin-right-5"></i><?php echo $lang['Add to Blocklist']; ?>
                        </a>
                    </div>
                    <?php } else { ?> 
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-xs-16 gt-margin-top-10 gridHidden">
                        <a <?php if (!isset($_SESSION['user_id'])) { ?>href="login"<?php } ?> class="btn btn-default btn-block inResultBlockBtn gt-cursor <?php if (isset($_SESSION['user_id'])) { echo "addToblock-data"; } ?>" id="<?php echo $Row->matri_id; ?>" title="Remove Blocklist">
                            <i class="fas fa-ban gt-margin-right-5"></i><?php echo $lang['Remove Blocklist']; ?>
                        </a>
                    </div>
                    <?php }
	                   $select = $DatabaseCo->dbLink->query("SELECT sh_id FROM shortlist WHERE to_id='".$Row->matri_id."' AND from_id='".$user_id."'");
	                   if(mysqli_num_rows($select) == 0) {
                    ?>
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-xs-16 gt-margin-top-10 gridHidden">
                        <a <?php if (!isset($_SESSION['user_id'])) { ?>href="login"<?php } ?> class="btn btn-default btn-block inResultShortBtn gt-cursor <?php if (isset($_SESSION['user_id'])) { echo "addToshort-link"; } ?>" id="<?php echo $Row->matri_id; ?>"  title="Add to Shortlist">
                            <i class="fa fa-sort gt-margin-right-5"></i><?php echo $lang['Add to Shortlist']; ?>
                        </a>
                    </div>
                    <?php } else { ?>
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-xs-16 gt-margin-top-10 gridHidden">
                        <a <?php if (!isset($_SESSION['user_id'])) { ?>href="login"<?php } ?> class="btn btn-default btn-block  inResultShortBtn gt-cursor 
                        <?php if (isset($_SESSION['user_id'])) { echo "addToblock-link"; } ?>" title="Remove From Shortlist" id="<?php echo $Row->matri_id; ?>">
                            <i class="fa fa-sort gt-margin-right-5"></i><?php echo $lang['Remove Shortlist']; ?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</li>