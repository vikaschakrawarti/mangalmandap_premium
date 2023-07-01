<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT edu_detail,occupation,income,emp_in,gender FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$edu_detail=$DatabaseCo->dbRow->edu_detail; 
$occupation=$DatabaseCo->dbRow->occupation; 
$emp_in=$DatabaseCo->dbRow->emp_in;

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT additional_degree,annual_income FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-university"></i><?php echo $lang['Education / Profession Information']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return view44('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
    <form method="post" name="reg_edit_4" id="reg_edit_4">
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Highest Education']; ?>:
                </label>
                <select class="gt-form-control chosen-select" name="edu_detail" data-validetta="required">
                    <?php
                        $get_edu=explode(",",$DatabaseCo->dbRow->edu_detail);
                        $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu)){
                    ?>
                        <option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if( $get_edu[0] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
                            <?php echo $DatabaseCo->Row->edu_name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php if($row_field->additional_degree == 'Yes'){ ?>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label><?php echo $lang['Additional Degree']; ?> :</label>
                <select class="gt-form-control chosen-select" name="edu_detail1" data-validetta="required">
                    <?php
                        $SQL_STATEMENT_edu1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu1)){
                    ?>
                        <option value="<?php echo $DatabaseCo->Row->edu_id ?>" <?php if(isset($get_edu[1]) && $get_edu[1] !='' && $get_edu[1] == $DatabaseCo->Row->edu_id){ echo "selected"; }?>>
                            <?php echo $DatabaseCo->Row->edu_name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php } ?>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Employed in']; ?> :
                </label>
                <select class="gt-form-control" name="empin" data-validetta="required">
                    <option value="">Select</option>
                    <option value="Private" <?php if($emp_in=='Private'){echo "selected";}?>>Private</option>
                    <option value="Government" <?php if($emp_in=='Government'){echo "selected";}?>>Government</option>
                    <option value="Business" <?php if($emp_in=='Business'){echo "selected";}?>>Business</option>
                    <option value="Defence" <?php if($emp_in=='Defence'){echo "selected";}?>>Defence</option>
                    <option value="Self Employed" <?php if($emp_in=='Self Employed'){echo "selected";}?>>Self Employed</option>
                    <?php
                        if ($DatabaseCo->dbRow->gender == 'Female') {
                    ?>
                    <option value="Not Working" <?php if($emp_in=='Not Working'){echo "selected";}?>>Not Working</option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Occupation']; ?>  :
                </label>
                <select class="gt-form-control chosen-select" name="occupation" data-validetta="required">
                    <option value="">Select</option>
                    <?php
                        $SQL_STATEMENT_occu =  $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED'  ");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_occu)){
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->ocp_id ?>" <?php if($DatabaseCo->dbRow->occupation==$DatabaseCo->Row->ocp_id){ echo "selected"; }?>>
                        <?php echo $DatabaseCo->Row->ocp_name; ?>
                    </option>
                   <?php } ?>
                </select>
            </div>	
            <?php if($row_field->annual_income == 'Yes'){ ?>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <?php echo $lang['Annual Income']; ?>  :
                </label>
                <select class="gt-form-control" name="income">
                    <?php
                        $SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
                        while($row_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
                    ?>
                    <option value="<?php echo $row_income->id; ?>" <?php if($row_income->id == $DatabaseCo->dbRow->income){ echo "selected"; } ?>><?php echo $row_income->income; ?></option>
                    <?php } ?>   	
                </select>
            </div>
            <?php } ?>
        </div>
    </form>
</div>
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
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
	function view44(status){	
		$(function(){
            $('#reg_edit_4').validetta({
                errorClose : false,
                onValid : function( event ) {
                 event.preventDefault();	
                 view4(status);
                }
            });
        });
		$('#reg_edit_4').submit();   
    }
</script>
           