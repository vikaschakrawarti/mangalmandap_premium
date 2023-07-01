<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

    $SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_edu,part_occu,part_emp_in,part_income FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
    $part_edu=$DatabaseCo->dbRow->part_edu; 
    $part_occu=$DatabaseCo->dbRow->part_occu;

    /*-- Field Enable / Disable -- */
    $SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_annual_income FROM field_settings WHERE id='1'");
    $row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left">
        <i class="fa fa-university"></i><?php echo $lang['Education / Professional Preference']; ?>
    </span>
    <a class="pull-right btn gt-btn-orange" onClick="return part_view_22('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
	<form method="post" name="reg_edit_2" id="part_edit_2">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Education']; ?>  :
				</label>
				<select class="chosen-select gt-form-control"  multiple name="part_edu[]" data-validetta="required">
                    <option value="Does Not Matter">Does Not Matter</option>
                    <?php
                        $search_arr2 = explode(',',$DatabaseCo->dbRow->part_edu);
                        $SQL_STATEMENT_part_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ");
                        while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_part_edu)){
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->edu_id ?>"<?php if(in_array($DatabaseCo->Row->edu_id, $search_arr2)){ echo "selected"; }?>> <?php echo $DatabaseCo->Row->edu_name; ?></option>
                    <?php } ?>
				</select>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				   <?php echo $lang['Occupation']; ?>   :
				</label>
				<select class="chosen-select gt-form-control"  multiple name="part_occu[]">
					<option value="Does Not Matter">Does Not Matter</option>
					<?php 
                        $search_arr2 = explode(',',$DatabaseCo->dbRow->part_occu);
						$SQL_STATEMENT_part_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ");
						while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_part_ocp)){
				    ?>
					<option value="<?php echo $DatabaseCo->Row->ocp_id ?>"<?php if(in_array($DatabaseCo->Row->ocp_id, $search_arr2)){ echo "selected"; }?>><?php echo $DatabaseCo->Row->ocp_name; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Employed in']; ?> :
				</label>
				<select data-validetta="required" name="empin" class="gt-form-control">
					<option value="Private" <?php if($DatabaseCo->dbRow->part_emp_in == "Private"){ echo "selected"; }?>>Private</option>
					<option value="Government" <?php if($DatabaseCo->dbRow->part_emp_in == "Government"){ echo "selected"; }?>>Government</option>
					<option value="Business" <?php if($DatabaseCo->dbRow->part_emp_in == "Business"){ echo "selected"; }?>>Business</option>
					<option value="Defence" <?php if($DatabaseCo->dbRow->part_emp_in == "Defence"){ echo "selected"; }?>>Defence</option>
					<option value="Not working" <?php if($DatabaseCo->dbRow->part_emp_in == "Not working"){ echo "selected"; }?>>Not working</option>
					<option value="Others" <?php if($DatabaseCo->dbRow->part_emp_in == "Others"){ echo "selected"; }?>>Others</option>
				</select>
			</div>
			<?php if($row_field->part_annual_income == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Annual Income']; ?>  :
				</label>
				<select class="chosen-select gt-form-control" multiple name="part_income[]"  data-validetta="required">
				    <?php $part_income = explode(",",$DatabaseCo->dbRow->part_income); ?>
                    <?php
                        $SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
                        while($row_pref_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
                    ?>
                    <option value="<?php echo $row_pref_income->id; ?>" <?php if(in_array($row_pref_income->id, $part_income)){ echo "selected"; } ?>><?php echo $row_pref_income->income; ?></option>
                    <?php } ?>
				</select>
			</div>
			<?php } ?>
		</div>
	</form>
</div>
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

<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
    function part_view_22(status){
        $(function(){
            $('#part_edit_2').validetta({
                errorClose : false,
                onValid : function( event ) {
                    event.preventDefault();
                    part_view_2(status);
                }
            });
        });
        $('#part_edit_2').submit();
    }
</script>
