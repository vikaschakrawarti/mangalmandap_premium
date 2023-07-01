<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

    $SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT smoke,drink,diet FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

    $SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT diet,smoke,drink FROM field_settings WHERE id='1'");
    $row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
	<span class="pull-left">
	    <i class="fa fa-star"></i><?php echo $lang['Habits And Hobbies']; ?>
	</span>
	<a class="pull-right btn gt-btn-orange" onClick="return view77('edit');">
	    <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
	</a>
</div>
<div class="gt-panel-body">
	<form method="post" name="reg_edit_7" id="reg_edit_7">
		<div class="row">
			<?php if($row_field->diet == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Eating Habits']; ?> :
				</label>
				<select class="gt-form-control" name="diet">
					<option value="">Select</option>
					<option value="Vegetarian" <?php if($DatabaseCo->dbRow->diet == "Vegetarian"){echo "selected";}?>>Vegetarian</option>
					<option value="Non Vegetarian" <?php if($DatabaseCo->dbRow->diet == "Non Vegetarian"){echo "selected";}?>>Non Vegetarian</option>
					<option value="Eggetarian" <?php if($DatabaseCo->dbRow->diet == "Eggetarian"){echo "selected";}?>>Eggetarian</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->smoke == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Drinking Habits']; ?> :
				</label>
				<select class="gt-form-control" name="drink">
					<option value="">Select</option>
					<option value="No" <?php if($DatabaseCo->dbRow->drink == "No"){echo "selected";}?>>No</option>
					<option value="Yes" <?php if($DatabaseCo->dbRow->drink == "Yes"){echo "selected";}?>>Yes</option>
					<option value="Drinks Socially" <?php if($DatabaseCo->dbRow->drink == "Drinks Socially"){echo "selected";}?>>Drinks Socially</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->drink == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Smoking Habits']; ?> :
				</label>
				<select class="gt-form-control" name="smoke">
					<option value="" >Select</option>
					<option value="No" <?php if($DatabaseCo->dbRow->smoke == "No"){echo "selected";}?>>No</option>
					<option value="Yes" <?php if($DatabaseCo->dbRow->smoke == "Yes"){echo "selected";}?>>Yes</option>
					<option value="Occasionally" <?php if($DatabaseCo->dbRow->smoke == "Occasionally"){echo "selected";}?>>Occasionally</option>
				</select>
			</div>
			<?php } ?>
		</div>
	</form>
</div>
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
	var config = {
    	'.chosen-select': {},
    	'.chosen-select-deselect': {allow_single_deselect: true},
       	'.chosen-select-no-single': {disable_search_threshold: 10},
       	'.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "100%"}
    }
    for (var selector in config) {
    	$(selector).chosen(config[selector]);
   	}			
</script> 
<script type="text/javascript">
  function view77(status){
    view7(status);
  }
</script>