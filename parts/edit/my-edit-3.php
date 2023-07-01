<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT religion,caste,will_to_mary_caste,subcaste FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

$religion=$DatabaseCo->dbRow->religion;
$caste=$DatabaseCo->dbRow->caste;

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-book"></i><?php echo $lang['Religion Information']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return view33('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
    <form method="post" name="reg_edit_3" id="reg_edit_3">
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Religion']; ?> :
                </label>
                <select class="gt-form-control chosen-select" name="religion" id="rel_id" data-validetta="required">
                    <?php
                        $SQL_STATEMENT_religion =  $DatabaseCo->dbLink->query("SELECT * FROM religion where status='APPROVED'");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_religion)){ 
                    ?>
                        <option value="<?php echo $DatabaseCo->Row->religion_id ?>" <?php if($DatabaseCo->dbRow->religion == $DatabaseCo->Row->religion_id){ echo "selected"; } ?>>
                        <?php echo $DatabaseCo->Row->religion_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div id="status"></div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Caste']; ?> :
                </label>
                <select class="gt-form-control chosen-select" name="caste"  data-validetta="required" id="caste_id">
                    <?php
                        $SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste where status='APPROVED' ");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){ 
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->caste_id ?>" <?php if($DatabaseCo->dbRow->caste==$DatabaseCo->Row->caste_id){ echo "selected"; } ?>>
                        <?php echo $DatabaseCo->Row->caste_name ?>
                    </option>
                    <?php } ?>
                </select>
            </div>      		
            <?php if($row_field->sub_caste == 'Yes'){ ?>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <?php echo $lang['Sub Caste']; ?>  :
                </label>
                <select class="gt-form-control chosen-select" name="subcaste" >
                    <option value="">Select</option>
                    <?php
                        $SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_id,sub_caste_name FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
                        while ($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste)) {
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->sub_caste_id; ?>" <?php if($DatabaseCo->dbRow->subcaste == $DatabaseCo->Row->sub_caste_id){ echo "selected" ; }?>>
                        <?php echo $DatabaseCo->Row->sub_caste_name; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <?php } ?>
            <?php if($row_field->will_to_marry == 'Yes'){ ?>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                     <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Will to marry in other caste?']; ?> :
                </label>
                <select class="gt-form-control" name="will_to_marry" data-validetta="required">
                    <option value="">Select</option>
                    <option value="1" <?php if($DatabaseCo->dbRow->will_to_mary_caste == '1'){ echo 'selected';} ?>>Yes</option>
                    <option value="0" <?php if($DatabaseCo->dbRow->will_to_mary_caste == '0'){ echo 'selected';} ?>>No</option>
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

<script>
	$("#rel_id").on('change', function(){
		$("#status").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		var id=$(this).val();
		var dataString = 'c_id='+id;
		jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "get_caste", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response){
				$("#caste_id").find('option').remove().end().append(response);
				$('#caste_id').trigger('chosen:updated');
				$("#status").html('');		
			},			
		});		
	});
</script> 
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
	function view33(status){	
		$(function(){
    		$('#reg_edit_3').validetta({
    			errorClose : false,
				onValid : function( event ) {
       		 		event.preventDefault();	
	   		 		view3(status);
    			}
    		});
    	});
		$('#reg_edit_3').submit();   
    }
</script> 
                     
  