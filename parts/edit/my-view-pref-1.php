<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

if(isset($_REQUEST['part_mstatus'])){
    $part_mstatus=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_mstatus']));
    $part_frm_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_frm_age']);
    $part_to_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_to_age']);
    $part_height=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height']);
    $part_height_to=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height_to']);
    $part_diet=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_diet']));
    $part_drink=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_drink']));
    $part_smoke=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_smoke']));	
    $part_physicalstatus=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_physicalstatus']);
    $DatabaseCo->dbLink->query("UPDATE register SET looking_for='$part_mstatus',part_frm_age='$part_frm_age',part_to_age='$part_to_age',part_height='$part_height',part_height_to='$part_height_to',part_diet='$part_diet',part_drink='$part_drink',part_smoke='$part_smoke',part_physical='$part_physicalstatus' WHERE matri_id='$matri_id'");
    
    $result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config WHERE matri_id = '$matri_id'");
    $rowcc = mysqli_fetch_array($result3);
    $name = $rowcc['firstname']." ".$rowcc['lastname'];
    $matriid = $rowcc['matri_id'];
    $cpass = $rowcc['cpassword'];
    $website = $rowcc['web_name'];
    $webfriendlyname = $rowcc['web_frienly_name'];
    $from = $rowcc['from_email'];
    $to = $rowcc['email'];
    $name = $rowcc['username'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
    $subject = "Basic Preferences Updated";	
    $message = "
    <!doctype html>
    <html>
    <link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
    <body  style='margin: 0 auto;padding-top:20px;padding-bottom:20px;background: rgba(233,233,233,1.00);'>
        <div id='templateBody' style='border: 3px solid #e2e2e2;
        width: 64%;
        margin: 40px auto 40px auto;
        border-radius: 5px;background-color:white;'>
            <div id='gtheader' style='background: #fff;padding: 15px;'>
                <div id='gtLogo' style=''>
                    <img src='$website/img/$logo' style='max-height: 70px;'>
                </div>	
            </div>
            <div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
                    <h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Basic preferences updated</h5>
            </div>
            <div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
                <div id='gtUDetails' style='padding: 15px;'>
                    <h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
        font-weight: 400;'>Name : $name</h5>
                    <h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
        font-weight: 400;text-decoration:none;color:black;'>Email : $to </h5>
                    <h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
        font-weight: 400;'>User Id: $matriid</h5>
                </div>
                <div id='gtlogin' style='text-align: center;'>
                    <a href='$website/login' style='font-family: Roboto, sans-serif;
                    padding: 10px 30px 10px 30px;
        font-size: 18px;
        background: rgb(234, 38, 38);
        display: inline-block;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        margin-top: 15px;
        margin-bottom: 15px;'>LOGIN</a>
                </div>
                <div id='gtIncase'>
                    <p style='font-family: Roboto, sans-serif;
        font-weight: 400;
        font-size: 14px;
        color: #565656;'>In case of profile not updated by you,Please change password or contact us on $contact.</p>
                </div>
                <div id='gtThank'>
                    <p style='font-family: Roboto, sans-serif;
        font-weight: 500;
        font-size: 14px;
        color: #565656;
        margin-top: 30px;
        margin-bottom: 5px;'>Thank You</p>
                    <h5 style='font-family: Roboto, sans-serif;
        font-size: 18px;
        color: #ea2626;
        margin-top: 5px;
        font-weight: 200;'>Team $webfriendlyname</h5>
                </div>
            </div>
            <div id='gtFooter' style='padding: 15px;text-align: center;background: #efefef;
        '>
                <h5 style='font-family: Roboto, sans-serif;margin-top: 10px;
        margin-bottom: 5px;
        font-size: 18px;
        font-weight: 300;'>Join us on</h5>
        <div>
            <a href='$fb' style='margin-left: 2px;
        margin-right: 2px;' target='_blank'><img src='$website/img/if_square-facebook_317727.png' style='width:38px;'></a>
            <a href='$tw' style='font-size: 44px;
        color: #707171;
        margin-left: 2px;
        margin-right: 2px;' target='_blank'><img src='$website/img/if_square-twitter_317723.png' style='width:38px;'></a>
            <a href='$li' style='font-size: 44px;
        color: #707171;
        margin-left: 2px;
        margin-right: 2px;' target='_blank'><img src='$website/img/if_square-linkedin_317725.png' style='width:38px;'></a>
            <a href='$gp' style='font-size: 44px;
        color: #707171;
        margin-left: 2px;
        margin-right: 2px;' target='_blank'><img src='$website/img/if_square-google-plus_317726.png' style='width:38px;'></a>
            </div>
            </div>
        </div>
    </body>
    </html>
    ";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= 'From:'.$from."\r\n";
    mail($to,$subject,$message,$headers);
}
$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_expect,part_complexation,part_drink,part_smoke,part_diet,part_height_to,part_height,part_frm_age,part_to_age,looking_for,part_mtongue,part_physical FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$m_tongue=$DatabaseCo->dbRow->part_mtongue;

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_physical_status,part_diet,part_drink,part_smoke FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>	
<div class="gt-panel-head">
    <span class="pull-left">
        <i class="fa fa-file"></i><?php echo $lang['Basic Preferences']; ?>
    </span>
    <a class="pull-right btn gt-btn-orange" onClick="return part_edit_1();">
        <i class="fas fa-pencil-alt fa-fw"></i>
        <font class="gt-margin-left-5"><?php echo $lang['EDIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
	<div class="row">
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Marital Status']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					    <?php echo $DatabaseCo->dbRow->looking_for; ?>
					</b>
				</div>
			</div>
		</div>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Age']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					<?php
						$age_from = $DatabaseCo->dbRow->part_frm_age;
                        $SQL_STATEMENT_AGE_FROM = $DatabaseCo->dbLink->query("SELECT * FROM age WHERE id='$age_from'");
                        $DatabaseCo->Row_age_from = mysqli_fetch_object($SQL_STATEMENT_AGE_FROM);
                        if (isset($age_from)) {
                            echo $DatabaseCo->Row_age_from->age.'&nbsp;&nbsp;Years';
                        } else {
                           echo 'Not Available';
                        }
				    ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['To']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
					<?php
						$age_to = $DatabaseCo->dbRow->part_to_age;
                        $SQL_STATEMENT_AGE_TO = $DatabaseCo->dbLink->query("SELECT * FROM age WHERE id='$age_to'");
                        $DatabaseCo->Row_age_to = mysqli_fetch_object($SQL_STATEMENT_AGE_TO);
                        if (isset($age_to)) {
                            echo $DatabaseCo->Row_age_to->age.'&nbsp;&nbsp;Years';
                        } else {
                            echo 'Not Available';
                        }
				    ?>
					</b>
				</div>
			</div>
		</div>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Height']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					<?php
						$height_from = $DatabaseCo->dbRow->part_height;
                        $SQL_STATEMENT_HEIGHT_FROM = $DatabaseCo->dbLink->query("SELECT * FROM height WHERE id='$height_from'");
                        $DatabaseCo->Row_height_from = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_FROM);
                        if (isset($height_from)) {
				            echo $DatabaseCo->Row_height_from->height;
                        } else {
                            echo 'Not Available';
                        }
				    ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['To']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
					<?php
						$height_to = $DatabaseCo->dbRow->part_height_to;
                        $SQL_STATEMENT_HEIGHT_TO = $DatabaseCo->dbLink->query("SELECT * FROM height WHERE id='$height_to'");
                        $DatabaseCo->Row_height_to = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO);
                        if (isset($height_to)) {
                            echo $DatabaseCo->Row_height_to->height;
				        } else {
                            echo 'Not Available';
				        }
				    ?>
					</b>
				</div>
			</div>
		</div>
		<?php if($row_field->part_diet == 'Yes'){ ?>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Eating Habits']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					    <?php if($DatabaseCo->dbRow->part_diet!=''){ echo $DatabaseCo->dbRow->part_diet; }else{ echo "Not Available"; } ?>
					</b>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if($row_field->part_smoke == 'Yes'){ ?>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Smoking Habits']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					    <?php if($DatabaseCo->dbRow->part_smoke!=''){ echo $DatabaseCo->dbRow->part_smoke; }else{ echo "Not Available"; }?>
					</b>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if($row_field->part_drink == 'Yes'){ ?>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Drinking Habits']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					    <?php if($DatabaseCo->dbRow->part_drink!=''){echo $DatabaseCo->dbRow->part_drink;}else{ echo "Not Available"; } ?>
					</b>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if($row_field->part_physical_status == 'Yes'){ ?>
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
			<div class="row">
				<div class="col-xs-6">
					<?php echo $lang['Physical status']; ?> :
				</div>
				<div class="col-xs-10">
					<b>
					    <?php if($DatabaseCo->dbRow->part_physical!=''){ echo $DatabaseCo->dbRow->part_physical; }else{ echo "Not Available";} ?>
					</b>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
