<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
    $SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_expect FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
?>
<div class="gt-panel-head">
	<span class="pull-left">
	    <i class="fa fa-star"></i><?php echo $lang['Patner Expectation']; ?>
	</span>
	<a class="pull-right btn gt-btn-orange" onClick="return part_view_5('edit');">
	    <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
	</a>
</div>
<div class="gt-panel-body" >
    <form name="part_edit5" method="post" id="part_edit5">
        <div class="row">
            <div class="col-xxl-16 col-xl-16 col-lg-16 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Expectations']; ?> :
                </label>
                <textarea name="txtPPE" class="form-control" rows="5" data-validetta="required"><?php echo $DatabaseCo->dbRow->part_expect; ?></textarea>
            </div>
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
   function part_view_55(status) {
 	$(function() {
 		$('#part_edit5').validetta({
 			errorClose: false,
 			onValid: function(event) {
 				event.preventDefault();
 				part_view_5(status);
 			}
 		});
 	});
 	$('#part_edit5').submit();
 }
</script>
