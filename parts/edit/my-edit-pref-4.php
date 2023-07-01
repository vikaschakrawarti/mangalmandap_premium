<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

    $SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_country_living,part_state,part_city FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

    /*-- Field Enable / Disable -- */
    $SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_state,part_city FROM field_settings WHERE id='1'");
    $row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left">
        <i class="fa fa-map-marker"></i><?php echo $lang['Location Preference']; ?>
    </span>
    <a class="pull-right btn gt-btn-orange" onClick="return part_view_44('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body" >
	<form name="part_edit4" method="post" id="part_edit4">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span> <?php echo $lang['Country']; ?>  :
				</label>
				<select class="chosen-select gt-form-control"  multiple name="part_con_living[]" id="part_con_living" data-validetta="required">
					<?php 
						$search_con=explode(',',$DatabaseCo->dbRow->part_country_living);
						$SQLSTATEMENT_part_con=$DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED' ");
						while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_con)){ 
				    ?>
					<option value="<?php echo $DatabaseCo->Row->country_id; ?>" <?php if(in_array($DatabaseCo->Row->country_id, $search_con)){ echo "selected"; }?> >
						<?php echo $DatabaseCo->Row->country_name; ?>
					</option>
					<?php } ?> 
				</select>
				<div id="status1"></div>
			</div>
			<?php if($row_field->part_state == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
				<label><?php echo $lang['State']; ?> :</label>
				<select class="chosen-select gt-form-control" multiple name="part_state[]" id="part_state">
					<?php 
						$part_state=explode(',',$DatabaseCo->dbRow->part_state);
						$SQLSTATEMENT_part_state=$DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE status='APPROVED' AND cnt_id IN (".$DatabaseCo->dbRow->part_country_living.") ");
						while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_state)){
				    ?>
				    <option value="<?php echo $DatabaseCo->Row->state_id; ?>" <?php if(in_array($DatabaseCo->Row->state_id, $part_state)){ echo "selected"; }?> ><?php echo $DatabaseCo->Row->state_name; ?></option>
					<?php } ?> 
				</select>
				<div id="status12"></div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php if($row_field->part_city == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
				<label><?php echo $lang['City']; ?> :</label>
				<select class="chosen-select gt-form-control"  multiple name="part_city[]" id="part_city">
					<?php 
						$part_city=explode(',',$DatabaseCo->dbRow->part_city);
						$SQLSTATEMENT_part_city=$DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE status='APPROVED' AND state_id IN (".$DatabaseCo->dbRow->part_state.") ");
				    ?>
					<?php
						while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_city)){
				    ?>
					<option value="<?php echo $DatabaseCo->Row->city_id; ?>" <?php if(in_array($DatabaseCo->Row->city_id, $part_city)){ echo "selected"; }?>><?php echo $DatabaseCo->Row->city_name; ?></option>
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
    function part_view_44(status) {
        $(function() {
            $('#part_edit4').validetta({
                errorClose: false,
                onValid: function(event) {
                    event.preventDefault();
                    part_view_4(status);
                }
            });
        });
        $('#part_edit4').submit();
    }
</script>
<script>
    $("#part_con_living").change(function() {
        $("#status1").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
        var id = $(this).val();
        var dataString = 'id=' + id;
        $.ajax({
            type: "POST",
            url: "part_ajax_country_state",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#part_state").html(html);
                $("#status1").html('');
                $("#part_state").trigger("chosen:updated");
            }
        });
    });
    $("#part_state").change(function() {
        $("#status2").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
        var id = $(this).val();
        var cnt_id = $("#part_con_living").val();
        var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
        $.ajax({
            type: "POST",
            url: "part_ajax_country_state",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#part_city").html(html);
                $("#status2").html('');
                $("#part_city").trigger("chosen:updated");
            }
        });
    });
</script>
