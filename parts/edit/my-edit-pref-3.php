<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();

    $matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

    $SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT part_religion,part_caste,part_subcaste,part_manglik,part_dosh,part_rasi,part_star,part_mtongue FROM register WHERE matri_id='$matri_id'");
    $DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

    $part_rel=$DatabaseCo->dbRow->part_religion; 
    $part_caste=$DatabaseCo->dbRow->part_caste;

    /*-- Field Enable / Disable -- */
    $SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_dosh,part_star,part_rasi FROM field_settings WHERE id='1'");
    $row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left">
        <i class="fa fa-book"></i><?php echo $lang['Religion Preference']; ?>
    </span>
    <a class="pull-right btn gt-btn-orange" onClick="return part_view_33('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body" >
	<form method="post" name="part_edit3" id="part_edit3">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Religion']; ?> :
				</label>
				<select  name="part_religion_id[]" id="rel_id" class="chosen-select gt-form-control" multiple data-validetta="required">
					<option value="Does Not Matter">Does Not Matter</option>
                    <?php
                        $search_arr3 = explode(',',$DatabaseCo->dbRow->part_religion);
                        $SQL_STATEMENT_rel = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ");
                        while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_rel)){
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->religion_id; ?>" <?php if(in_array($DatabaseCo->Row->religion_id, $search_arr3)){ echo "selected"; }?>><?php echo $DatabaseCo->Row->religion_name; ?></option>
                    <?php } ?>
				</select>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Caste']; ?> :
				</label>
				<div id="castediv">
					<select class="chosen-select gt-form-control" multiple name="part_caste_id[]" id="caste_id" data-validetta="required">
                    <?php 
                        $search_caste = explode(',',$DatabaseCo->dbRow->part_caste);
                        $SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ");
                        foreach($search_arr3 as $rel){
                    ?>
                        <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">
                    <?php
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste)){
                    ?>
                        <option value="<?php echo $DatabaseCo->Row->caste_id ?>"  <?php if (in_array($DatabaseCo->Row->caste_id, $search_caste)){ echo "selected"; }?>><?php echo $DatabaseCo->Row->caste_name ?></option>
                    <?php } ?>
                        </optgroup>
                    <?php } ?>
					</select>
					<div id="status123"></div>
				</div>
			</div>
			<?php if($row_field->part_dosh == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				   <?php echo $lang['Have Dosh?']; ?>  :
				</label>
				<select id="part_dosh" name="part_dosh" class="gt-form-control" onchange="yesnoCheck(this);">
					<option value="Yes" 
						<?php if($DatabaseCo->dbRow->part_dosh  == 'Yes'){ echo "selected";}?>>Yes
					</option>
					<option value="No" 
						<?php if($DatabaseCo->dbRow->part_dosh  == 'No'){ echo "selected";}?>>No
					</option>
					<option value="Don't know" 
						<?php if($DatabaseCo->dbRow->part_dosh  == 'Don\'t know'){ echo "selected";}?>>Don't know
					</option>
				</select>
			</div>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail" id="ifYes" style="display: <?php if(isset($DatabaseCo->dbRow->part_dosh ) == 'Yes' ){ echo 'block'; }elseif(isset($DatabaseCo->dbRow->part_dosh ) == "Don't know" ){ echo 'none'; }else{ echo 'none';} ?> ;">
				<label>
				    <?php echo $lang['Dosh Type']; ?> :
				</label>
				<select class="chosen-select gt-form-control" name="part_manglik[]" id="part_manglik" multiple>
                    <?php $arr_part_manglik = explode(",",$DatabaseCo->dbRow->part_manglik); ?>
                    <?php
                        $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                        while($row_pref_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
                    ?>
                        <option value="<?php echo $row_pref_dosh->dosh_id; ?>" <?php if(in_array($row_pref_dosh->dosh_id,$arr_part_manglik)){ echo "selected"; } ?>><?php echo $row_pref_dosh->dosh; ?></option>
                    <?php } ?>
                </select>
			</div>
			<?php } ?>
			<?php if($row_field->part_rasi == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Moonsign']; ?> :
				</label>
				<select class="chosen-select gt-form-control" name="part_moonsign[]" id="moonsign" multiple>
                    <?php $part_moonsign = explode(',',$DatabaseCo->dbRow->part_rasi); ?>
                    <?php
                        $SQL_STATEMENT_RASI = $DatabaseCo->dbLink->query("SELECT * FROM rasi");
                        while($row_prer_rasi = mysqli_fetch_object($SQL_STATEMENT_RASI)){
                    ?>
                    <option value="<?php echo $row_prer_rasi->rasi_id; ?>" <?php if(in_array($row_prer_rasi->rasi_id, $part_moonsign)){ echo "selected";}?>><?php echo $row_prer_rasi->rasi; ?></option>
                    <?php } ?>
				</select>
			</div>
			<?php } ?>
			<?php if($row_field->part_star == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Star']; ?> :
				</label>
				<select class="chosen-select gt-form-control" name="part_star[]" id="star" multiple>
                    <?php  $part_star = explode(', ',$DatabaseCo->dbRow->part_star);?>
                    <?php
                    $SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
                    while($row_pref_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
                    ?>
                    <option value="<?php echo $row_pref_star->star_id; ?>" <?php if(in_array($row_pref_star->star_id, $part_star)){ echo "selected";}?>><?php echo $row_pref_star->star; ?></option>
                    <?php } ?>
				</select>
			</div>
			<?php } ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
				<label>
				    <?php echo $lang['Mother Tongue']; ?> :
				</label>
				<select class="chosen-select gt-form-control" multiple name="part_mtongue[]" data-validetta="required">
					<option value="Does Not Matter">Does Not Matter</option>
                    <?php
                        $search_arr2 = explode(',',$DatabaseCo->dbRow->part_mtongue);
                        $SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
                        while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu)){
                    ?>
                        <option value="<?php echo $DatabaseCo->Row->mtongue_id ?>" <?php if(in_array($DatabaseCo->Row->mtongue_id, $search_arr2)){ echo "selected"; }?>><?php echo $DatabaseCo->Row->mtongue_name; ?></option>
                    <?php } ?>
				</select>
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
<script type="text/javascript">
    $("#rel_id").change(function() {
        $("#status123").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
        var id = $(this).val();
        var dataString = 'religionId=' + id + '&edit=yes';
        $.ajax({
            type: "POST",
            url: "part_rel_caste",
            data: dataString,
            cache: false,
            success: function(data) {
                $("#caste_id").html('');
                $("#caste_id").append(data);
                $("#caste_id.chosen-select").trigger("chosen:updated");
                $("#status123").html('');
            }
        });
    });
</script>
<script>
    function yesnoCheck(that) {
        if (that.value == "Yes") {
            document.getElementById("ifYes").style.display = "block";
        }else if(that.value == "Don't know") {
             document.getElementById("ifYes").style.display = "none";
        }else{
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
    function part_view_33(status) {
        $(function() {
            $('#part_edit3').validetta({
                errorClose: false,
                onValid: function(event) {
                    event.preventDefault();
                    part_view_3(status);
                }
            });
        });
        $('#part_edit3').submit();
    }
</script>
