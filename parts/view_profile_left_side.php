				<a class="btn gt-btn-green btn-block gt-margin-bottom-20 hidden-xxl hidden-xl" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
 					<?php echo $lang['Options']; ?> <i class="fa fa-angel-down"></i>
				</a>
                <div class="collapse mobile-collapse" id="collapseExample">
                	<div class="gt-left-opt-msg">
            			<ul>
                			<li>
                            	<a href="sentMessages"><i class="fas fa-paper-plane gt-margin-right-10"></i><?php echo $lang['Send Message']; ?></a>
                            </li>
                            <li>
                            	<a href="my-photo"><i class="fas fa-image gt-margin-right-10"></i><?php echo $lang['View Photos']; ?></a>
                            </li>
                		</ul>
                	</div>
					<div class="gt-left-opt-msg">
						<ul>
							<li>
								<a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['MESSAGES']; ?></a>
							</li>
							<li>
								<a href="inboxMessages"><span class="pull-left"><?php echo $lang['Inbox']; ?></span><span class="pull-right badge"><?php echo $inbox_cnt1=mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE to_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_receiver='No'"));	?></span></a>
							</li>
							<li>
								<a href="sentMessages"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo $sent_cnt2=mysqli_num_rows($DatabaseCo->dbLink->query("SELECT mes_id FROM messages WHERE from_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_sender='No'")); ?></span></a>
							</li>
						</ul>
					</div>
					<div class="gt-left-opt-msg">
						<ul>
							<li>
								<a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['INTEREST']; ?></a>
							</li>
							<li>
								<a href="exp-interest"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender AND ei_receiver='$mid' AND trash_receiver='No' "));?></span></a>
							</li>
							<li>
								<a href="exp-interest"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver AND ei_sender='$mid' AND trash_sender='No' "));?></span></a>
							</li>
						</ul>
					</div>
					<div class="gt-left-opt-msg">
						<ul>
							<li>
								<a class="gt-bg-orange text-center gt-text-white"><?php echo $lang['PHOTO REQUEST']; ?></a>
							</li>
							<li>
								<a href="photo-request"><span class="pull-left"><?php echo $lang['Received']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id AND ph_requester_id='$mid' AND receiver_response='Pending'"));?></span></a>
							</li>
							<li>
								<a href="photo-request"><span class="pull-left"><?php echo $lang['Sent']; ?></span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id AND ph_receiver_id='$mid' AND receiver_response='Pending'"));?></span></a>
							</li>
						</ul>
					</div>
                </div>