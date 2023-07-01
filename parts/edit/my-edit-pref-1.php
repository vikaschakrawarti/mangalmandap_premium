<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_expect,part_complexation,part_drink,part_smoke,part_diet,part_height_to,part_height,part_frm_age,part_to_age,looking_for,part_mtongue,part_physical FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$m_tongue=$DatabaseCo->dbRow->part_mtongue;

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_physical_status,part_diet,part_drink,part_smoke FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-file"></i><?php echo $lang['Basic Preferences']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return part_view_11('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body" >
	<form name="part_edit1" method="post" id="part_edit1">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Age']; ?> :
				</label>
				<div class="row">
					<div class="col-xs-6">
						<select class="gt-form-control" name="part_frm_age" data-validetta="required" id="from_age">
							<option value="">- Age -</option>
                            <?php
                            //Make 18 Year Selected for Search
                            if(isset($DatabaseCo->dbRow->part_frm_age)){
                                $selected_a=$DatabaseCo->dbRow->part_frm_age;
                            }else{
                                $selected_a="1";
                            }
                            $SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                            while ($row_age = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
                            ?>
                              <option value="<?php echo $row_age->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $row_age->id ){ echo 'selected'; }} ?>><?php echo $row_age->age; ?> Year</option>
                            <?php } ?>
						</select>
					</div>
					<div class="col-xs-4 text-center">
						<h4 class="gt-font-weight-400"><?php echo $lang['To']; ?></h4>
					</div>
					<div class="col-xs-6">
						<select class="gt-form-control" name="part_to_age" data-validetta="required" id="part_to_age">
							<option value="" >- Age -</option>
							<?php
                            //Make 18 From & 30 To Year Selected for Search
                            if(isset($DatabaseCo->dbRow->part_frm_age)){
                                $selected_b=$DatabaseCo->dbRow->part_to_age;
                            }else{
                                $selected_b='13';
                            }
                            $SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
                            while ($row_age_to = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
                            ?>
                              <option value="<?php echo $row_age_to->id; ?>" 
                                      <?php if($row_age_to->id <= $selected_a ){ 
                                                echo 'disabled'; 
                                            }if($selected_b == $row_age_to->id ){
                                                echo 'selected';	
                                            } 
                                      ?>>
                                  <?php echo $row_age_to->age; ?> Year</option>
                            <?php } ?>  
						</select>
					</div>
				</div>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				<span class="text-danger mr-5 gtRegMandatory LH-0">*</span> <?php echo $lang['Height']; ?> :
				</label>
				<div class="row">
					<div class="col-xs-6">
						<select class="gt-form-control" name="part_height" data-validetta="required" id="from_height">
							<option value="">From height</option>
							<?php
                            if(isset($DatabaseCo->dbRow->part_height)){
                                $selected_h_a=$DatabaseCo->dbRow->part_height;
                            }else{
                                $selected_h_a='2';
                            }
                            $SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                            while($row_height_from = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
                            ?>
                            <option value="<?php echo $row_height_from->id; ?>" <?php if(isset($selected_h_a) != '' ){ if($selected_h_a == $row_height_from->id ){ echo 'selected'; }} ?>><?php echo $row_height_from->height; ?></option>
                            <?php } ?>
						</select>
					</div>
					<div class="col-xs-4 text-center">
						<h4 class="gt-font-weight-400"><?php echo $lang['To']; ?></h4>
					</div>
					<div class="col-xs-6">
						<select class="gt-form-control" name="part_height_to" data-validetta="required" id="part_to_height">
							<option value="">To height</option>
                            <?php
                                if(isset($DatabaseCo->dbRow->part_height)){
                                    $selected_h_b=$DatabaseCo->dbRow->part_height_to;
                                }else{
                                    $selected_h_b='13';
                                }
                                $SQL_STATEMENT_HEIGHT_TO =  $DatabaseCo->dbLink->query("SELECT * FROM height");
                                while($row_height_to = mysqli_fetch_object($SQL_STATEMENT_HEIGHT_TO)){
                            ?>
                            <option value="<?php echo $row_height_to->id; ?>" 
                            <?php if($row_height_to->id <= $selected_h_a ){ 
                                        echo 'disabled'; 
                                    }if($selected_h_b == $row_height_to->id ){
                                        echo 'selected';	
                                    } 
                              ?>><?php echo $row_height_to->height; ?></option>
                            <?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory LH-0">*</span><?php echo $lang['Marital Status']; ?> :
				</label>
				<select  class="chosen-select gt-form-control" multiple name="part_mstatus[]" data-validetta="required">
					<?php $search_array = explode(', ',$DatabaseCo->dbRow->looking_for); ?>
					<option value="Does Not Matter" <?php if(in_array('Does Not Matter', $search_array)){ echo "selected"; } ?>>Does Not Matter</option>
					<option value="Never Married" <?php if(in_array('Never Married', $search_array)){ echo "selected"; } ?>>Never Married</option>
                    <?php if($DatabaseCo->dbRow->gender == 'Male'){ ?>
					<option value="Widow" <?php if(in_array('Widow', $search_array)){ echo "selected"; } ?>>Widow</option>
					<?php }else{?>
					<option value="Widower" <?php if(in_array('Widower', $search_array)){ echo "selected"; } ?>>Widower</option>
					<?php }?>
					<option value="Divorced" <?php if(in_array('Divorced', $search_array)){ echo "selected"; } ?>>Divorced</option>
					<option value="Awaiting Divorce" <?php if(in_array('Awaiting Divorce', $search_array)){ echo "selected"; } ?>>Awaiting Divorce</option>
				</select>
			</div>
			<?php if($row_field->part_diet == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Eating Habits']; ?> :
				</label>
				<select class="chosen-select gt-form-control" multiple name="part_diet[]">
					<?php  $part_dietmul=explode(", ",$DatabaseCo->dbRow->part_diet); ?>
					<option value="Vegetarian" <?php if(in_array('Vegetarian', $part_dietmul)){ echo "selected"; } ?>>Vegetarian</option>
					<option value="Eggetarian" <?php if(in_array('Eggetarian', $part_dietmul)){ echo "selected"; } ?>>Eggetarian</option>
					<option value="Non Vegetarian" <?php if(in_array('Non Vegetarian', $part_dietmul)){ echo "selected"; } ?>>Non Vegetarian</option>
					<option value="Does Not Matter" <?php if(in_array('Does Not Matter', $part_dietmul)){ echo "selected"; } ?>>Does Not Matter</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->part_smoke == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Smoking Habits']; ?> :
				</label>
				<select class="chosen-select gt-form-control" multiple name="part_smoke[]">
					<?php  $part_smokemul=explode(", ",$DatabaseCo->dbRow->part_smoke); ?>
					<option value="No" <?php if(in_array("No", $part_smokemul)){ echo "selected"; } ?>>Never Smokes</option>
					<option value="Smokes Occasionally" <?php if(in_array("Smokes Occasionally", $part_smokemul)){ echo "selected"; } ?>>Smokes Occasionally</option>
					<option value="Smokes Regularly" <?php if(in_array("Smokes Regularly", $part_smokemul)){ echo "selected"; } ?>>Smokes Regularly</option>
					<option value="Does Not Matter" <?php if(in_array("Does Not Matter", $part_smokemul)){ echo "selected"; } ?>>Does Not Matter</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->part_drink == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Drinking Habits']; ?> :
				</label>
				<select class="chosen-select gt-form-control" multiple name="part_drink[]">
					<?php $part_drinkmul=explode(", ",$DatabaseCo->dbRow->part_drink); ?>
					<option value="Does Not Matter" <?php if(in_array("Does Not Matter", $part_drinkmul)){ echo "selected"; } ?>>Does Not Matter</option>
					<option value="No" <?php if(in_array("No", $part_drinkmul)){ echo "selected"; } ?>>Never Drinks</option>
					<option value="Drinks Socially" <?php if(in_array("Drinks Socially", $part_drinkmul)){ echo "selected"; } ?>>Drinks Socially</option>
					<option value="Drinks Regularly" <?php if(in_array("Drinks Regularly", $part_drinkmul)){ echo "selected"; } ?>>Drinks Regularly</option>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->part_physical_status == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Physical status']; ?> :
				</label>
				<select class="gt-form-control" name="part_physicalstatus">
					<option value="Normal" <?php if($DatabaseCo->dbRow->part_physical=='Normal'){ echo "selected"; } ?>>Normal</option>
					<option value="Physically-challenged" <?php if($DatabaseCo->dbRow->part_physical=='Physically-challenged'){ echo "selected"; } ?>> Physically-challenged </option>
					<option value="Does Not Matter" <?php if($DatabaseCo->dbRow->part_physical=="Does Not Matter"){ echo "selected"; } ?>>Does Not Matter</option>
				</select>
			</div>
			<?php } ?>
		</div>
	</form>
</div>
<!-- CHOSEN -->
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
<!-- CHOSEN END -->
<script type="text/javascript" src="./js/validetta.js"></script>
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
<script type="text/javascript">
    function part_view_11(status){
        $(function(){
            $('#part_edit1').validetta({
              errorClose : false,
              onValid : function( event ) {
                  event.preventDefault();
                  part_view_1(status);
              }
          });
      });
      $('#part_edit1').submit();
    }
</script>

