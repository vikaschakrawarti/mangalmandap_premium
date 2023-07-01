<?php
   $today1 = strtotime('now');
   $today = date("Y-m-d", $today1);
?>
<div class="col-lg-12 col-xs-12 col-md-12 gtAdminMemResult">
	<form action="" method="post" class="form-data" id="action_form">
		<div class="row mb-15">
			<div class="col-lg-2 col-xs-2 col-md-1">
				<input type="checkbox" name="action_id" id="action_id" value="<?php echo $Row->matri_id; ?>"> 
			</div>
			<h3 class="<?php if ($Row->fstatus == 'Featured') { echo "col-lg-6"; } else { echo "col-lg-7"; } ?> col-xs-10 col-md-5">
				<?php echo $Row->username; ?><span class="badge"><?php echo $Row->matri_id; ?></span>
				<?php if (isset($_SESSION['m_status']) && $_SESSION['m_status'] == 'match') {?>
				    <small>
                        <a href="new-match-to-member?email=<?php echo $Row->email; ?>" class="btn btn-info btn-sm text-danger" target="_blank">
                            <?php echo $sm; ?> match found
                        </a>
                    </small>
				<?php } ?>
			</h3>
			<ul class="gtAdminMemStatus <?php if($Row->fstatus == 'Featured') { echo "col-lg-4"; } else { echo "col-lg-3"; } ?> col-lg-4 col-xs-12 col-md-6"> 
                <?php if ($Row->fstatus == 'Featured') { ?>
                    <li class="col-lg-5 col-xs-4 text-center">
                        <i class="fa fa-star"></i><span class="hidden-xs"> Featured</span>
                    </li>
				<?php } ?>
				<?php if ($Row->status == 'Paid') { ?>
                    <li class="col-lg-5 col-xs-4 text-center">
                        <i class="fa fa-credit-card"></i><span class="hidden-xs"> Paid</span>
                    </li>
				<?php } elseif ($Row->status == 'Active') { ?>
                    <li class="col-lg-7 col-xs-4 text-center">
                        <i class="fa fa-thumbs-up"></i><span class="hidden-xs"> Approved</span>
                    </li>
				<?php } elseif ($Row->status == 'Inactive') { ?>
                    <li class="col-lg-8 col-xs-4 text-center">
                        <i class="fa fa-thumbs-down text-danger"></i><span class="hidden-xs"> Unapproved</span>
                    </li>
				<?php } elseif ($Row->status == 'Suspended') { ?>
                    <li class="col-lg-8 col-xs-4 text-center">
                        <i class="fa fa-user-times text-danger"></i><span class="hidden-xs"> Suspended</span>
                    </li>
				<?php } ?>
			</ul>
		</div>
		<div class="row">
			<div class="col-lg-2 col-xs-12 col-sm-6 col-md-4">
				<?php
				
					if ($Row->photo1 == '' && !file_exists("../my_photos/" .$Row->photo1."")) {
					    if ($Row->gender == 'Male') {
				?>
				<img src="../img/male.jpg" alt="User Image" height="150" width="130" class="img-thumbnail" style="width: 100%;"/>
				<?php
					} else {
				?>
				<img src="../img/female.jpg" alt="User Image" height="150" width="130"  class="img-thumbnail" style="width: 100%;"/>
				<?php
					}
				    } else {
				?>
				<img src="../my_photos/watermark.php?image=<?php echo $Row->photo1; ?>&watermark=watermark.png" alt="User Image"  class="img-thumbnail" style="width: 100%;"/>
				<?php } ?>
			</div>
			<div class="col-lg-10 col-xs-12 col-md-8 gtAdminMemDetails">
				<div class="row mb-5">
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Email :
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo $Row->email; ?>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Gender :
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo $Row->gender; ?>
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Country :
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo $Row->country_name; ?>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Age
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo floor((time() - strtotime($Row->birthdate)) / 31556926); ?> Years
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Education:
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php
								$a = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
								echo $a['edu_name'];
				            ?>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Height
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php
								if(isset($Row->height) && $Row->height !==''){
                                    $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height WHERE id='".$Row->height."'");
                                    $DatabaseCo->Row1 = mysqli_fetch_object($SQL_STATEMENT_HEIGHT);							
                                    echo $DatabaseCo->Row1->height;
								}else{
								    echo "N/A";	
								}
				            ?>
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Religion :
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo $Row->religion_name; ?>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class="col-lg-5 col-xs-5">
							Caste :
						</div>
						<div class="col-lg-7 col-xs-7">
							<?php echo $Row->caste_name; ?>
						</div>
					</div>
				</div>
				<div class="text-left col-xs-12 mt-10">
					<?php
						if (isset($_GET['member_status'])) {
								$member_status = $_GET['member_status'];
						}	
				    ?>
					<?php
						if ($member_status == 'Active') {
				    ?>
					<!-- approveaspaid.php page-->
					<a class="btn btn-info btn-sm add-details"  href="javascript:;"  onClick="approveaspaid('<?php echo $Row->matri_id; ?>')" data-toggle="modal" data-target="#modal-14">
					    Approve As Paid
					</a>
					<?php
						} else if (isset($Row->exp_date) && $Row->exp_date < $today) {
				    ?>
					<a class="btn btn-info btn-sm add-details"  href="javascript:;"  onClick="approveaspaid('<?php echo $Row->matri_id; ?>')" data-toggle="modal" data-target="#modal-14">
					    Renew Membership
					</a>
					<?php
						} else if (isset($_SESSION['plan_status_se']) && ($_SESSION['plan_status_se'] == 'Edit' || isset($_POST['plan_status']) == 'Edit') && $member_status == 'Paid') {
				    ?>
					<a class="btn btn-info btn-sm add-details"  href="javascript:;"  onClick="editplan('<?php echo $Row->matri_id; ?>')" data-toggle="modal" data-target="#modal-14">
					Edit Plan
					</a>
					<?php } ?> 
					<a class="btn btn-info btn-sm" href="memberFullProfile?matri_id=<?php echo $Row->matri_id; ?>">
					    View Profile
					</a>
					<a class="btn btn-danger btn-sm" href="editprofile?matri_id=<?php echo $Row->matri_id; ?>">
					    Edit Profile 
					</a>
				</div>
			</div>
		</div>
	</form>
</div>