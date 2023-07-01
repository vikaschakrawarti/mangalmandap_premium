<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT height,weight,bodytype,complexion,physicalStatus FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT weight,body_type,complexion,physical_status FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left">
        <i class="fa fa-star"></i><?php echo $lang['Physical Attributes']; ?>
    </span>
    <a class="pull-right btn gt-btn-orange" onClick="return view99('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
	<form method="post" name="reg_edit_8" id="reg_edit_9" >
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<div class="row">
					<div class="col-xs-6">
						<label><span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Height']; ?> :</label>
					</div>
					<?php if($row_field->weight == 'Yes'){ ?>
					<div class="col-xs-4 text-center">
						<h4 class="gt-font-weight-400"></h4>
					</div>
					<div class="col-xs-6">
						<label><span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Weight']; ?> :</label>
					</div>
					<?php } ?>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<select class="gt-form-control" name="height" data-validetta="required">
							<option value="">Select</option>
				            <?php
								$SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
								while($row_height = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
							?>
							<option value="<?php echo $row_height->id; ?>" <?php if($DatabaseCo->dbRow->height == $row_height->id){echo "selected";}?>><?php echo $row_height->height; ?></option>
							<?php } ?>	
						</select>
					</div>
					<?php if($row_field->weight == 'Yes'){ ?>
					<div class="col-xs-4 text-center">
						<h4 class="gt-font-weight-400">&amp;</h4>
					</div>
					<div class="col-xs-6">
						<select class="gt-form-control" name="weight" data-validetta="required">
							<option value="">Select</option>
                            <?php
                                $SQL_SITE_SETTING_WEIGHT = $DatabaseCo->dbLink->query("SELECT weight_first,weight_last FROM site_config WHERE id='1' ");
                                $weight_data = mysqli_fetch_object($SQL_SITE_SETTING_WEIGHT);
                                $weight_first=$weight_data->weight_first;
                                $weight_last=$weight_data->weight_last;
                                for ($x = $weight_first; $x <= $weight_last; $x++) { ?>
                                <option value='<?php echo $x; ?>' <?php if($DatabaseCo->dbRow->weight == $x){echo "selected";}?>>
                                    <?php echo $x; ?> Kg
                                </option>
                             <?php } ?>								
	
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if($row_field->body_type == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label><?php echo $lang['Body Type']; ?>  :</label>
				<select class="gt-form-control" name="bodytype">
					<option value="" >Select</option>
					<option value="Slim" <?php if($DatabaseCo->dbRow->bodytype == "Slim"){echo "selected";}?>>Slim</option>
					<option value="Average" <?php if($DatabaseCo->dbRow->bodytype == "Average"){echo "selected";}?>>Average</option>
					<option value="Athletic" <?php if($DatabaseCo->dbRow->bodytype == "Athletic"){echo "selected";}?>>Athletic</option>
					<option value="Heavy" <?php if($DatabaseCo->dbRow->bodytype == "Heavy"){echo "selected";}?>>Heavy</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->complexion == 'Yes'){ ?>  	
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label><?php echo $lang['Complexion']; ?>  :</label>
				<select class="gt-form-control" name="complexion">
					<option value="">Select</option>
					<?php echo $DatabaseCo->dbRow->complexion; ?>
					<option value="Very Fair" <?php if($DatabaseCo->dbRow->complexion == "Very Fair"){ echo "selected"; }?>>Very Fair</option>
					<option value="Fair" <?php if($DatabaseCo->dbRow->complexion == "Fair"){ echo "selected"; }?>>Fair</option>
					<option value="Wheatish" <?php if($DatabaseCo->dbRow->complexion == "Wheatish"){ echo "selected"; }?>>Wheatish</option>
					<option value="Wheatish Brown" <?php if($DatabaseCo->dbRow->complexion == "Wheatish Brown"){ echo "selected"; }?>>Wheatish Brown</option>
					<option value="Dark" <?php if($DatabaseCo->dbRow->complexion == "Dark"){ echo "selected"; }?>>Dark</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->physical_status == 'Yes'){ ?>  	
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label><?php echo $lang['Physical status']; ?> :</label>
				<select class="gt-form-control" name="physicalStatus">
					<option value="">Select</option>
					<option value="Normal" <?php if($DatabaseCo->dbRow->physicalStatus == "Normal"){echo "selected";}?>>Normal</option>
					<option value="Physically-challenged" <?php if($DatabaseCo->dbRow->physicalStatus == "Physically-challenged"){echo "selected";}?>>Physically-challenged</option>
				</select>
			</div>
			<?php } ?>
		</div>
	</form>
</div>
<script type="text/javascript" src="./js/validetta.js"></script>                
<script type="text/javascript">
	function view99(status){
    	$(function(){
      		$('#reg_edit_9').validetta({
        		errorClose : false,
        		onValid : function( event ) {
					event.preventDefault();
					view9(status);
        		}
      		});
    	});
    	$('#reg_edit_9').submit();
  	}
</script>
