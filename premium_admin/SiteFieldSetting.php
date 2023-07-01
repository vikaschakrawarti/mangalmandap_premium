<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();

	if(isset($_POST['change'])){
		$sub_caste=$_POST['sub_caste'];
		$body_type=$_POST['body_type'];
		$will_to_marry=$_POST['will_to_marry'];
		$weight=$_POST['weight'];
		$physical_status=$_POST['physical_status'];
		$additional_degree=$_POST['additional_degree'];
		$annual_income=$_POST['annual_income'];
		$diet=$_POST['diet'];
		$complexion=$_POST['complexion'];
		$smoke=$_POST['smoke'];
		$drink=$_POST['drink'];
		$dosh=$_POST['dosh'];
		$star=$_POST['star'];
		$rasi=$_POST['rasi'];
		$birthtime=$_POST['birthtime'];
		$birthplace=$_POST['birthplace'];
		$family_status=$_POST['family_status'];
		$family_type=$_POST['family_type'];
		$family_value=$_POST['family_value'];
		$father_occupation=$_POST['father_occupation'];
		$mother_occupation=$_POST['mother_occupation'];
		$no_of_brother=$_POST['no_of_brother'];
		$no_of_married_brother=$_POST['no_of_married_brother'];
		$no_of_sister=$_POST['no_of_sister'];
		$no_of_married_sister=$_POST['no_of_married_sister'];
		$profile_text=$_POST['profile_text'];
		$part_diet=$_POST['part_diet'];
		$part_drink=$_POST['part_drink'];
		$part_smoke=$_POST['part_smoke'];
		$part_dosh=$_POST['part_dosh'];
		$part_star=$_POST['part_star'];
		$part_state=$_POST['part_state'];
		$part_city=$_POST['part_city'];
		$part_rasi=$_POST['part_rasi'];
		$part_annual_income=$_POST['part_annual_income'];
		$part_expect=$_POST['part_expect'];
		
		$DatabaseCo->dbLink->query("UPDATE field_settings SET sub_caste='$sub_caste',will_to_marry='$will_to_marry',weight='$weight',body_type='$body_type',complexion='$complexion',physical_status='$physical_status',additional_degree='$additional_degree',annual_income='$annual_income',diet='$diet',smoke='$smoke',drink='$drink',dosh='$dosh',star='$star',rasi='$rasi',birthtime='$birthtime',birthplace='$birthplace',family_status='$family_status',family_type='$family_type',family_value='$family_value',father_occupation='$father_occupation',mother_occupation='$mother_occupation',no_of_brother='$no_of_brother',no_of_married_brother='$no_of_married_brother',no_of_sister='$no_of_sister',no_of_married_sister='$no_of_married_sister',profile_text='$profile_text',part_diet='$part_diet',part_drink='$part_drink',part_smoke='$part_smoke',part_dosh='$part_dosh',part_star='$part_star',part_state='$part_state',part_city='$part_city',part_rasi='$part_rasi',part_annual_income='$part_annual_income',part_expect='$part_expect' WHERE id='1' ");
		$msg="Record is updated successfully.";
	}
	$sql=$DatabaseCo->dbLink->query("SELECT * FROM field_settings WHERE id='1'");
	$data=mysqli_fetch_object($sql);
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Admin | Enable / Disable Field</title>
    	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		
   		<!-- Bootstrap & custom css -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    	<!-- Font Awsome -->
		<script src="https://kit.fontawesome.com/48403ccd1a.js" crossorigin="anonymous"></script>
		
    	<!-- Ionicons -->
    	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   		
		<!-- Theme css -->
    	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		
   		<!-- Checkbox css -->
		<link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		
		<!-- Post Validation CSS -->
    	<link href="css/postvalidationcss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../css/validate.css">
	</head>	
	<body class="skin-blue">
    	<!-- Icon Loader -->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- /. Icon Loader-->
   		<div class="wrapper" style="display:none" id="body">
			<!-- Header & Menu -->
			<?php include "page-part/header.php"; ?> 
			<?php include "page-part/left_panel.php"; ?>
			<!-- /. Header & Menu -->
			<div class="content-wrapper">
				<section class="content-header">
					<h1 class="lightGrey">Field Enable / Disable</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"> Field Enable / Disable</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="box-body">
							<div class="box box-success">
								<div class="box-body gtSiteChangeId p-20">
									<form method="post" name="changefield" id="changefield">
										<div class="row">
											<?php if(isset($msg)){ ?>
											<div class="col-xs-12">
												<div id="success_msg" class="alert alert-success">
													<i class="fa fa-check-circle fa-fw fa-lg"></i>Record is updated successfully.
												</div>
											</div>
											<?php } ?>
											<div class="col-xs-12">
												<h2 class="titleTheme1 mb-20 themeColorRed">User Fields</h2>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label>Sub Caste :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="sub_caste">
                                                                <option value="Yes" <?php if($data->sub_caste == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->sub_caste == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>	
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label>Will to marry in other caste ? :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="will_to_marry">
                                                                <option value="Yes" <?php if($data->will_to_marry == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->will_to_marry == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>		
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Weight :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="weight">
                                                                <option value="Yes" <?php if($data->weight == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->weight == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>	
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Body Type :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="body_type">
                                                                <option value="Yes" <?php if($data->body_type == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->body_type == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select> 
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Complexion :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="complexion">
                                                                <option value="Yes" <?php if($data->complexion == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->complexion == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Physical Status :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="physical_status">
                                                                <option value="Yes" <?php if($data->physical_status == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->physical_status == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Additional Degree :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="additional_degree">
                                                                <option value="Yes" <?php if($data->additional_degree == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->additional_degree == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Annual Income :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="annual_income">
                                                                <option value="Yes" <?php if($data->annual_income == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->annual_income == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Diet :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="diet">
                                                                <option value="Yes" <?php if($data->diet == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->diet == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Smoke :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="smoke">
                                                                <option value="Yes" <?php if($data->smoke == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->smoke == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Drink :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="drink">
                                                                <option value="Yes" <?php if($data->drink == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->drink == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Dosh :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="dosh">
                                                                <option value="Yes" <?php if($data->dosh == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->dosh == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Star :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="star">
                                                                <option value="Yes" <?php if($data->star == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->star == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Rasi :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="rasi">
                                                                <option value="Yes" <?php if($data->rasi == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->rasi == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Birth Time :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="birthtime">
                                                                <option value="Yes" <?php if($data->birthtime == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->birthtime == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select> 
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Birth Place :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="birthplace">
                                                                <option value="Yes" <?php if($data->birthplace == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->birthplace == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Family Status :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="family_status">
                                                                <option value="Yes" <?php if($data->family_status == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->family_status == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Family Type :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="family_type">
                                                                <option value="Yes" <?php if($data->family_type == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->family_type == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Family Value :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="family_value">
                                                                <option value="Yes" <?php if($data->family_value == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->family_value == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Father Occupation :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="father_occupation">
                                                                <option value="Yes" <?php if($data->father_occupation == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->father_occupation == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Mother Occupation :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="mother_occupation">
                                                                <option value="Yes" <?php if($data->mother_occupation == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->mother_occupation == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>No of brother :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="no_of_brother">
                                                                <option value="Yes" <?php if($data->no_of_brother == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->no_of_brother == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select> 
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>No of married brother :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="no_of_married_brother">
                                                                <option value="Yes" <?php if($data->no_of_married_brother == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->no_of_married_brother == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select> 
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>No of sister :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="no_of_sister">
                                                                <option value="Yes" <?php if($data->no_of_sister == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->no_of_sister == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>No of married sister :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="no_of_married_sister">
                                                                <option value="Yes" <?php if($data->no_of_married_sister == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->no_of_married_sister == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select> 
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>About Us :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="profile_text">
                                                                <option value="Yes" <?php if($data->profile_text == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->profile_text == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-xs-12">
												<h2 class="titleTheme1 mb-20 themeColorRed ">Partner Preference Fields</h2>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Diet :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_diet">
                                                                <option value="Yes" <?php if($data->part_diet == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_diet == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Drink :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="part_drink">
                                                                <option value="Yes" <?php if($data->part_drink == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_drink == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Smoke :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_smoke">
                                                                <option value="Yes" <?php if($data->part_smoke == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_smoke == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Dosh :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_dosh">
                                                                <option value="Yes" <?php if($data->part_dosh == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_dosh == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Star :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="part_star">
                                                                <option value="Yes" <?php if($data->part_star == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_star == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner State :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_state">
                                                                <option value="Yes" <?php if($data->part_state == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_state == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner City :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="part_city">
                                                                <option value="Yes" <?php if($data->part_city == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_city == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<!--<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Rasi :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_rasi">
                                                                <option value="Yes" <?php if($data->part_rasi == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_rasi == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>-->
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Annual Income :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                           <select class="form-control" name="part_annual_income">
                                                                <option value="Yes" <?php if($data->part_annual_income == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_annual_income == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 mb-10">
												<div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                           <label>Partner Expectation :</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control" name="part_expect">
                                                                <option value="Yes" <?php if($data->part_expect == 'Yes'){ echo 'selected'; }?>>Yes</option>
                                                                <option value="No" <?php if($data->part_expect == 'No'){ echo 'selected'; }?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="col-xs-12 text-center siteLogo mt-15">
												<div class="form-group">
													<input type="submit" class="btn btnThemeG3 mr-10" value="Submit" name="change"/>
													<input type="reset" class="btn btnThemeR3" value="Cancel"/>
												</div>
											</div>
										</div>
									</form> 
 								</div>
							</div>
						</div>
          			</div>
				</section>
			</div>
			<?php include "page-part/footer.php"; ?>
		</div>
		<!-- jQuery -->
		<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
		<!-- jQuery UI -->
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
		
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
		   		$('#body').show();
		   		$('.preloader-wrapper').hide();
		   	});
	   	</script>	
    	
		<!--jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
			setPageContext("site-settings","sitefield");
		</script>
		
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
    	<!-- Theme Js -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
		
		<!-- Validetta -->
		<script src="../js/validetta.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				$('#changefield').validetta({
					errorClose : false,
					realTime : true
				});
    		});
		</script>
	
    	<!-- Success Msg Alert -->
		<script>
			$(document).ready(function(e) {
				if($('#success_msg').html()!=''){
					setTimeout(function() {
						$("#success_msg").css("opacity",0);
						 $("#success_msg").html('');
					},4000);	
				}
			});
		</script>
	</body>
</html>