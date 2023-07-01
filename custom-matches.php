<?php
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();

    $mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
    $s_id =$_SESSION['user_id'];
    $get_match_id=$DatabaseCo->dbLink->query("SELECT matri_id FROM matches WHERE matri_id='".$_SESSION['user_id']."'");

    if(mysqli_num_rows($get_match_id)=='0'){
        $SQL_STATEMENT_new = "SELECT username,looking_for,part_frm_age,part_to_age,part_income,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living FROM register_view WHERE matri_id='$s_id'";
        $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_new);
        $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
        $education=$DatabaseCo->dbRow->part_edu;
        $m_status=$DatabaseCo->dbRow->looking_for;
        $t3=$DatabaseCo->dbRow->part_frm_age;
        $t4=$DatabaseCo->dbRow->part_to_age;
        $fromheight=$DatabaseCo->dbRow->part_height;
        $toheight=$DatabaseCo->dbRow->part_height_to;
        $religion=$DatabaseCo->dbRow->part_religion;
        $caste=$DatabaseCo->dbRow->part_caste;
        $m_tongue=$DatabaseCo->dbRow->part_mtongue;
        $occ=$DatabaseCo->dbRow->part_mtongue;
        $part_complexation=$DatabaseCo->dbRow->part_complexation;
        $part_country=$DatabaseCo->dbRow->part_country_living;
        $DatabaseCo->dbLink->query("INSERT INTO matches (match_id,matri_id,looking_for,part_frm_age,part_to_age,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living)VALUES('','$s_id','$m_status','$t3','$t4','$fromheight','$toheight','$part_complexation','$m_tongue','$religion','$caste','$education','$part_country')");
    }
    if(isset($_POST['sub_matches'])){
        if(isset($_POST['txtlooking'])){
            $txtlooking=implode(", ",$_POST['txtlooking']);	
        }else{
            $txtlooking="";
        }
        if(isset($_POST['part-caste'])){
            $pcaste=implode(",",$_POST['part-caste']);
        }else{
            $pcaste="";
        }   
        if(isset($_POST['part-religion'])){
            $preligion=implode(",",$_POST['part-religion']);	
        }else{
            $preligion="";
        }
        if(isset($_POST['pcomplextion'])){
            $pcomplextion=implode(", ",$_POST['pcomplextion']);	
        }else{
            $pcomplextion="";
        }
        if(isset($_POST['pcountry'])){
            $pcountry=implode(",",$_POST['pcountry']);
        }else{
            $pcountry="";
        }
        if(isset($_POST['pmtongue'])){
            $pmtongue=implode(",",$_POST['pmtongue']);	
        }else{
            $pmtongue="";
        }	
        $txtPHeight=$_POST['txtPHeight'];
        $txtPheightto=$_POST['txtPheightto'];
        $Fromage=$_POST['Fromage'];
        $ToAge=$_POST['ToAge'];		
        if(isset($_POST['education'])){
            $education=implode(",",$_POST['education']);		
        }else{
            $education="";
        }

        $DatabaseCo->dbLink->query("UPDATE matches SET looking_for='$txtlooking',part_caste='$pcaste',part_religion='$preligion',part_complexation='$pcomplextion',part_country_living='$pcountry',part_mtongue='$pmtongue',part_height='$txtPHeight',part_height_to='$txtPheightto',part_frm_age='$Fromage',part_to_age='$ToAge',part_edu='$education' WHERE matri_id='".$_SESSION['user_id']."'") OR die(mysqli_error($DatabaseCo->dbLink));
        echo "<script>window.location='custom-matches';</script>";
    }
    $SQL_STATEMENT_match = "SELECT * FROM matches WHERE matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
    $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
    $education=$DatabaseCo->dbRow->part_edu;
    $m_status=$DatabaseCo->dbRow->looking_for;
    $t3=$DatabaseCo->dbRow->part_frm_age;
    $t4=$DatabaseCo->dbRow->part_to_age;
    $fromheight=$DatabaseCo->dbRow->part_height;
    $toheight=$DatabaseCo->dbRow->part_height_to;
    $religion=$DatabaseCo->dbRow->part_religion;
    $caste=$DatabaseCo->dbRow->part_caste;
    $m_tongue=$DatabaseCo->dbRow->part_mtongue;
    $occ=$DatabaseCo->dbRow->part_mtongue;
    $part_complexation=$DatabaseCo->dbRow->part_complexation;
    $part_country=$DatabaseCo->dbRow->part_country_living;

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

        <!-- Google Fonts -->
        <?php include('parts/google_fonts.php');?>
		
		<!-- Chosen CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
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
      				<div class="container gt-margin-top-20">
        				<div class="row">
          					<aside class="col-xxl-4 col-xl-4 col-xs-16">
            					<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20 gt-margin-top-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
              						<?php echo $lang['Options']; ?> 
              						<i class="fa fa-angel-down"></i>
            					</a>
            					<div class="collapse mobile-collapse" id="collapseExample">
              						<?php include "parts/match-sidebar.php"; ?>
              						<?php include "parts/level-2.php"; ?>
            					</div>
          					</aside>
          					<div class="col-xxl-12 col-xl-12 col-xs-16">
            					<h3 class="inPageTitle fontMerriWeather inThemeOrange text-center"><?php echo $lang['Custom Match']; ?></h3>
            					<article class="gt-margin-bottom-20 text-center">
              						<p class="inPageSubTitle"><?php echo $lang['In custom match you can set criteria to get auto results']; ?>.</p>
            					</article>
								<div class="col-xl-16 text-center mb-20">
									<a class="btn gt-btn-green" data-toggle="collapse" href="#collapseCustomMatch" role="button" aria-expanded="false" aria-controls="collapseCustomMatch">
    									<?php echo $lang['Set Custom Match']; ?>
  									</a>
									 
								</div>
								<div class="collapse" id="collapseCustomMatch">
            					<div class="gt-panel inCustomMatch"> 
              						<div class="gt-panel-body">
										<div class="row">
											<div class="col-xs-16">
												<h3 class="text-center"><?php echo $lang['Create Your Custom Match']; ?></h3>
										  	</div>
										</div>
                						<form class="" method="post" action="" name="match_form" id="match_form"> 
                  							<div class="row">
                    							<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
                      								<label for="religion"><?php echo $lang['Looking For']; ?>:</label>
                      								<select data-placeholder="Looking For" class="chosen-select gt-form-control" multiple tabindex="4" name="txtlooking[]" >
														<?php 
															$search_array = explode(', ',$m_status);				
														?>
														<option value="Never Married" <?php if(in_array('Never Married', $search_array)){ echo "selected"; } ?>>
															Never Married
														</option>
														<?php if($_SESSION['gender123'] == 'Female'){?>
														<option value="Widower" <?php if(in_array('Widower', $search_array)){ echo "selected"; } ?>>
															Widower
														</option>
														<?php }else{ ?>
														<option value="Widow" <?php if(in_array('Widow', $search_array)){ echo "selected"; } ?>>
															Widow
														</option>
														<?php }?>
														<option value="Divorced" <?php if(in_array('Divorced', $search_array)){ echo "selected"; } ?>>
															Divorced
														</option>
														<option value="Awaiting Divorce" <?php if(in_array('Awaiting Divorce', $search_array)){ echo "selected"; } ?>>
															Awaiting Divorce
														</option>                                    
                									</select>
            									</div>
            									
  												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
    												<label for="Mother Tongue"><?php echo $lang['Mother Tongue']; ?> :</label>
    												<select data-placeholder="Partner Mother Tongue" class="chosen-select gt-form-control" multiple tabindex="4" name="pmtongue[]" >
														<?php	
															$search_arr2 = explode(',',$m_tongue);
															$rescn2=$DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' order by  mtongue_name");
															while($rowcc=mysqli_fetch_array($rescn2)){
														?>
														<option value="<?php echo $rowcc['mtongue_id']; ?>" <?php if (in_array($rowcc['mtongue_id'], $search_arr2)){echo "selected";}?>>
															<?php echo ucfirst($rowcc['mtongue_name']); ?>
														</option>
														<?php } ?>
    												</select>
  												</div>
                                                <div class="clearfix"></div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
  													<label for="occupation"><?php echo $lang['Country']; ?> :</label>
  													<select data-placeholder="Partner Country" class="chosen-select gt-form-control" multiple tabindex="4" name="pcountry[]" >
    												<?php
														$search_array_C = explode(',',$part_country);
														$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
														$DatabaseCo1->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT1);
														while($DatabaseCo1->dbRow = mysqli_fetch_object($DatabaseCo1->dbResult)){
													?>
    													<option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" <?php if (in_array($DatabaseCo1->dbRow->country_id, $search_array_C)){echo "selected";}?>>
    														<?php echo $DatabaseCo1->dbRow->country_name; ?>
    													</option>
  													<?php } ?>
  													</select>
												</div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
											  		<label for="Religion"><?php echo $lang['Religion']; ?> :</label>
  													<select data-placeholder="Partner Religion" class="chosen-select form-control" name="part-religion[]" id="part-religion" multiple tabindex="4" >
														<?php  
															$search_array5 = explode(',',$religion);
															$SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
															$DatabaseCooo->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT);
															while($DatabaseCooo->dbRow = mysqli_fetch_object($DatabaseCooo->dbResult)){
														?>
														<option value="<?php echo $DatabaseCooo->dbRow->religion_id; ?>" <?php if (in_array($DatabaseCooo->dbRow->religion_id, $search_array5)){echo "selected";}?>>
															<?php echo $DatabaseCooo->dbRow->religion_name; ?>
														</option>
														<?php }	?>
  													</select>
													<div id="CasteDivloader"></div>
												</div>
                                                <div class="clearfix"></div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
											  		<label for="Caste"><?php echo $lang['Caste']; ?> :</label>
  													<select data-placeholder="Partner Caste" class="chosen-select gt-form-control" name="part-caste[]" id="part-caste" multiple tabindex="4" >
    													<?php
															$search_caste = explode(',',$caste);
															$a=$DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ORDER BY caste_name ASC");
														?>
    													<?php foreach ($search_array5 as $rel){ ?>
    														<optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">  
																<?php 
																	$SQL_STATEMENT =  "SELECT * FROM caste WHERE religion_id ='$rel' ORDER BY caste_name ASC";
																	$DatabaseCo->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT);
																	while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){
																?>
																<option value="<?php echo $DatabaseCo->dbRow->caste_id ?>" <?php if (in_array($DatabaseCo->dbRow->caste_id, $search_caste)) { echo "selected";}?>>
																	<?php echo $DatabaseCo->dbRow->caste_name ?>
																</option>
																<?php } ?>
  															</optgroup>
														<?php } ?>
													</select>
												</div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
											  		<label for="Caste"><?php echo $lang['Education']; ?> :</label>
  													<select data-placeholder="Partner Education" class="chosen-select gt-form-control" name="education[]" multiple tabindex="4" >
    													<?php 
															$search_array5 = explode(',',$education);
															$SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
															while($row123=mysqli_fetch_array($SQL_STATEMENT_edu)){
														?>
    													<option value="<?php echo $row123['edu_id']; ?>" <?php if (in_array($row123['edu_id'], $search_array5)){ echo "selected";} ?>>
    														<?php echo $row123['edu_name']; ?>
    													</option>
  														<?php } ?> 
  													</select>
												</div>
                                                <div class="clearfix"></div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
											  		<label><?php echo $lang['Age']; ?>:</label>
  													<div class="row">
    													<div class="col-xs-6">
															<select class="gt-form-control inThemeFormControl" name="Fromage" id="from_age">
																<option value="" >- Age -</option>
																<?php
                                                                //Make 18 Year Selected for Search

                                                                $SQL_STATEMENT_match = "select part_frm_age from matches where matri_id='$s_id'";
                                                                $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
                                                                $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
                                                                if($DatabaseCo->dbRow->part_frm_age != ''){
                                                                    $selected_a=$DatabaseCo->dbRow->part_frm_age;
                                                                }else{
                                                                    $selected_a='1';
                                                                }
                                                                $SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
                                                                ?>
                                                                  <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                                                <?php } ?>
															</select>
      														
														</div>
														<div class="col-xs-4">
															<h4 class="text-center"><?php echo $lang['To']; ?></h4>
														</div>
    													<div class="col-xs-6">
															<select class="gt-form-control inThemeFormControl" name="ToAge" id="part_to_age">
																<option value="" >- Age -</option>
																<?php
                                                                //Make 18 From & 30 To Year Selected for Search
                                                                //$selected_a='1';

                                                                $SQL_STATEMENT_match = "select part_to_age from matches where matri_id='$s_id'";
                                                                $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
                                                                $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
                                                                if($DatabaseCo->dbRow->part_to_age != ''){
                                                                    $selected_b=$DatabaseCo->dbRow->part_to_age;
                                                                }else{
                                                                    $selected_b='1';
                                                                }

                                                                $SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
                                                                          <?php if($DatabaseCo->dbRow->id <= $selected_a ){ 
                                                                                    echo 'disabled'; 
                                                                                }if($selected_b == $DatabaseCo->dbRow->id ){
                                                                                    echo 'selected';	
                                                                                } 
                                                                          ?>>
                                                                      <?php echo $DatabaseCo->dbRow->age; ?> Year</option>
                                                                <?php } ?>  

															</select>
      														
    													</div>
  													</div>
												</div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
													<label><?php echo $lang['Height']; ?>:</label>
  													<div class="row">
    													<div class="col-xs-6">
      														<select class="gt-form-control inThemeFormControl" name="txtPHeight" id="from_height">
																<?php
                                                                $SQL_STATEMENT_match = "select part_height from matches where matri_id='$s_id'";
                                                                $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
                                                                $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
                                                                if($DatabaseCo->dbRow->part_height != ''){
                                                                    $selected_h_a=$DatabaseCo->dbRow->part_height;
                                                                }else{
                                                                    $selected_h_a='2';
                                                                }



                                                                $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_h_a) != '' ){ if($selected_h_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
                                                                <?php } ?>
																 
      														</select>
    													</div>
    													<div class="col-xs-4">
      														<h4 class="text-center"><?php echo $lang['To']; ?></h4>
    													</div>
    													<div class="col-xs-6">
      														<select class="gt-form-control inThemeFormControl" name="txtPheightto" id="part_to_height">
																<?php
                                                                $SQL_STATEMENT_match = "SELECT part_height_to FROM matches WHERE matri_id='$s_id'";
                                                                $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
                                                                $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
                                                                if($DatabaseCo->dbRow->part_height_to != ''){
                                                                    $selected_h_b=$DatabaseCo->dbRow->part_height_to;
                                                                }else{
                                                                    $selected_h_b='1';
                                                                }


                                                                $SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                                                while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
                                                                ?>
                                                                <option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
                                                                <?php if($DatabaseCo->dbRow->id <= $selected_h_b ){ 
                                                                            echo 'disabled'; 
                                                                        }if($selected_h_b == $DatabaseCo->dbRow->id ){
                                                                            echo 'selected';	
                                                                        } 
                                                                  ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
                                                                <?php } ?>
																
      														</select>
    													</div>
  													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-20">
              										<label><?php echo $lang['Complexion']; ?> :</label>
              										<select data-placeholder="Partner Complexion" class="chosen-select gt-form-control" name="pcomplextion[]" multiple tabindex="4" >
														<?php $search_array1 = explode(', ',$part_complexation);?>             
														<option value="Very-Fair" <?php if(in_array('Very-Fair', $search_array1)){ echo "selected"; } ?>>
															Very Fair
														</option>
														<option value="Fair" <?php if(in_array('Fair', $search_array1)){ echo "selected"; } ?>>
															Fair
														</option>
														<option value="Wheatish" <?php if(in_array('Wheatish', $search_array1)){ echo "selected"; } ?>>
															Wheatish
														</option>
														<option value="Wheatish Brown" <?php if(in_array('Wheatish Brown', $search_array1)){ echo "selected"; } ?>>
															Wheatish Brown
														</option>
														<option value="Dark" <?php if(in_array('Dark', $search_array1)){ echo "selected"; } ?>>
															Dark
														</option>
      												</select>
    											</div>
											</div>  
											<div class="row gt-margin-bottom-20 mt-20">
												<div class="col-xs-16 text-center">
													<input type="submit" class="btn gt-btn-orange inBtnTheme-2" value="<?php echo $lang['Save & Search']; ?>" name="sub_matches">
											 	</div>
											</div>
										</form>
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-xs-16 text-center">
										<h3 class="inPageTitle fontMerriWeather inThemeOrange text-center mb-30">
									  		<?php echo $lang['Your Custom Match Result']; ?>
										</h3>
								  	</div>
								</div>             
								<div id="loaderID" style="position:fixed;  left:50%; top:50%; z-index:-1; opacity:0">
  									<div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange">
    									<font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font>
  									</div>
								</div>	
								<div id="pagination"></div>  
							</div>      
						</div>
					</div>
				</div>
			</div>
			<?php include "parts/footer.php"; ?>
		</div>
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
	  	<script>
            (function($) {
                var $window = $(window),
                $html = $('.mobile-collapse');
                $window.width(function width() {
                	if ($window.width() > 767) {
                    	return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
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
		<script type="text/javascript">
  			$(document).ready(function() {
   				var dataString = 'result_status=custom&actionfunction=showData' + '&page=1';
				$("#loaderID").css("opacity", 1);
				$("#loaderID").css("z-index", 9999);
				$.ajax({
					url: "dbmanupulate1",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$("#loaderID").css("opacity", 0);
						$("#loaderID").css("z-index", -1);
						$('#pagination').html(response);
					}
				});
				$('#pagination').on('click', '.page-numbers', function() {
				$("#loaderID").css("opacity", 1);
				$("#loaderID").css("z-index", 9999);
				$page = $(this).attr('href');
				$pageind = $page.indexOf('page=');
				$page = $page.substring(($pageind + 5));
				var dataString = 'result_status=custom&actionfunction=showData' + '&page=' + $page;
				$.ajax({
					url: "dbmanupulate1",
					type: "POST",
					data: dataString,
					cache: false,
					success: function(response) {
						$("#loaderID").css("opacity", 0);
						$("#loaderID").css("z-index", -1);
						$('#pagination').html(response);
					}
				});
				return false;
				});
			});
		</script>
		<script>
			$("#from_age").on('change', function() {
                $("#Loadtoage").html('<div>Loading...</div>');
                var id = $(this).val();
                var dataString = 'id=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax-to-age-data",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $("#part_to_age").html(html);
                        $("#Loadtoage").html('');
                   }
                });
             });
            $("#from_height").on('change', function() {
                $("#Loadtoheight").html('<div>Loading...</div>');
                var height_id = $(this).val();
                var dataString = 'height_id=' + height_id;
                $.ajax({
                    type: "POST",
                    url: "ajax-to-height-data",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $("#part_to_height").html(html);
                        $("#Loadtoheight").html('');
                    }
                });
            });
		</script>
	</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
		

