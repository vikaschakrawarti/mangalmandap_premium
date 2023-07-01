			<div class="gt-panel gt-panel-blue col-xs-16 gt-margin-top-15">
                	<div class="row">
                		<div class="gt-panel-head">
                    		<div class="gt-panel-title text-center">
                        		<i class="fa fa-star gt-margin-right-10"></i><?php echo $lang['Spotlight Profile']; ?>
                        	</div>
                    	</div>
                   		<div id="owl-demo-1" class="owl-carousel">
               	 			<?php 
							$get_spotlight=$DatabaseCo->dbLink->query("select birthdate,ocp_name,height,city_name,country_name,religion_name,photo1_approve,photo1,photo_view_status,photo_protect,photo_pswd,gender,username,matri_id from register_view where matri_id!='$mid' and gender!='".$_SESSION['gender123']."' and status!='Inactive' and status!='Suspendade' and fstatus='Featured' order by reg_date desc;");
							
									
									
							while($Row =mysqli_fetch_object($get_spotlight)){		
							?>
                            <div class="item">
								<div class="text-center">
                                	<?php include('search-result-photo.php');?>
                                    
                                    <a href="" class="gt-text-black">
                                    	<h5 class="text-center">
                                    		<?php echo $Row->username;?> 
                                    	</h5>
                                    	<article class="gt-margin-bottom-5 text-center">
                                    		<?php echo floor((time() - strtotime($Row->birthdate))/31556926).' Years';?>, <?php echo $Row->religion_name;?>, <?php echo $Row->ocp_name;?>
                                    	</article>
                                    	<article class="text-center">
                                    		<?php echo $Row->city_name.', '.$Row->country_name;?>
                                    	</article>
                                    </a>
                                    <a href="member-profile?view_id=<?php echo $Row->matri_id;?>" class="btn gt-btn-green gt-margin-top-10"><i class="fa fa-eye gt-margin-right-10"></i><?php echo $lang['View Profile']; ?></a>
                                </div>
                            </div>
                			<?php }?>
                		</div>
                    </div>
                </div>
				<style>
					.owl-theme .owl-controls {
						text-align: center;
						float: none;
						margin-top: 10px;
						font-size: 14px;
						position: relative;
						background-color: transparent;
						margin-left: 0px;
						width: 100%;
					}
					.owl-theme .owl-controls .owl-buttons div {
						color: #FFF;
						display: inline-block;
						margin: 5px;
						padding: 3px 10px;
						font-size: 18px;
						border-radius: 5px;
						background:#2C2B2A;
					}
				</style>
				<style>
				#owl-demo .item{
					margin-top : 3px;
					padding-bottom:15px;
					padding-top:10px;
					border-bottom:1px solid rgba(213,213,213,1.00);
				}
				#owl-demo .item img{
					display: block;
				}
				#owl-demo-1 .item{
					margin-top : 3px;
					padding-bottom:15px;
					padding-top:10px;
					border-bottom:1px solid rgba(213,213,213,1.00);
				}
				#owl-demo-1 .item img{
					display: block;
					width:100%;
				}
			</style>