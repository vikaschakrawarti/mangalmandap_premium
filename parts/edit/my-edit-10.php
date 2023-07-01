<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT birthplace,birthtime,star,moonsign,manglik,dosh FROM register WHERE matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT dosh,star,rasi,birthtime,birthplace FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-book"></i><?php echo $lang['Horoscope Information']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return view1010('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
	<form method="post" name="reg_edit_10" id="reg_edit_10">
		<div class="row">
			<?php if($row_field->dosh == 'Yes'){ ?>
				<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
					<label><?php echo $lang['Have Dosh?']; ?> :</label>
					<select class="gt-form-control" name="dosh" onchange="yesnoCheck(this);">
						<option value="No" <?php if($DatabaseCo->dbRow->dosh == 'No'){ echo 'selected' ;} ?>>No</option>
						<option value="Yes" <?php if($DatabaseCo->dbRow->dosh == 'Yes' ){ echo 'selected'; } ?>>Yes</option>
					</select>
				</div>
				<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail" id="ifYes">
					<label><?php echo $lang['Dosh Type']; ?> :</label>
					<select class="chosen-select gt-form-control" name="manglik[]" id="manglik" multiple>
						<?php $arr_manglik=explode(",",$DatabaseCo->dbRow->manglik);?>
						<?php
                            $SQL_STATEMENT_DOSH =  $DatabaseCo->dbLink->query("SELECT * FROM dosh WHERE status='APPROVED'");
                            while($row_dosh = mysqli_fetch_object($SQL_STATEMENT_DOSH)){
						?>
						<option value="<?php echo $row_dosh->dosh_id; ?>" <?php if(in_array($row_dosh->dosh_id,$arr_manglik)){ echo "selected"; } ?>><?php echo $row_dosh->dosh; ?>
						</option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail" >
				<div class="row">
					<?php if($row_field->rasi == 'Yes'){ ?>
						<div class="col-xs-6"><label><?php echo $lang['Moonsign']; ?> :</label></div>
					<?php } ?>
					<?php if($row_field->star == 'Yes'){ ?>
						<div class="col-xs-4 text-center"><h4 class="gt-font-weight-400"></h4></div>
						<div class="col-xs-6"><label><?php echo $lang['Star']; ?> :</label></div>
					<?php } ?>
				</div>   
				<div class="row">
					<div class="col-xs-6">
						<select id="moonsign" name="moonsign" class="gt-form-control">
							<option value="">Select</option>
                            <?php
                                $SQL_STATEMENT_RASI =  $DatabaseCo->dbLink->query("SELECT * FROM rasi");
                                while($row_rasi = mysqli_fetch_object($SQL_STATEMENT_RASI)){
                            ?>
                            <option value="<?php echo $row_rasi->rasi_id; ?>" <?php if($DatabaseCo->dbRow->moonsign ==  $row_rasi->rasi_id){ echo "selected"; }?>><?php echo $row_rasi->rasi; ?></option>
                            <?php } ?>							
						</select>
					</div>
					<?php if($row_field->star == 'Yes'){ ?>
					<div class="col-xs-4 text-center">
						<h4 class="gt-font-weight-400">&amp;</h4>
					</div>
					<div class="col-xs-6">
						<select id="star" name="star" class="gt-form-control">
							<option value="">Select</option>
                            <?php
								$SQL_STATEMENT_STAR =  $DatabaseCo->dbLink->query("SELECT * FROM star");
								while($row_star = mysqli_fetch_object($SQL_STATEMENT_STAR)){
							?>
                            <option value="<?php echo $row_star->star_id; ?>" <?php if($DatabaseCo->dbRow->star == $row_star->star_id){echo "selected";}?> ><?php echo $row_star->star; ?></option>
							<?php } ?>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>
			
			<?php if($row_field->birthtime == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
				<label><?php echo $lang['Birth Time']; ?> :</label>
				<input type="time" value="<?php if(isset($DatabaseCo->dbRow->birthtime)){ echo $DatabaseCo->dbRow->birthtime; } ?>" name="birthtime" class="gt-form-control">
				
			</div>
			<?php } ?>
			<?php if($row_field->birthplace == 'Yes'){ ?>
			<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pb-10 pt-10 gt-view-detail">
				<label><?php echo $lang['Birth Place']; ?> :</label>
				<input type="text" class="gt-form-control" value="<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthplace,ENT_QUOTES); ?>" name="birthplace">
			</div>
			<?php } ?>
		</div>
	</form>
</div>
<script>
	function yesnoCheck(that) {
		if (that.value == "Yes") {
			document.getElementById("ifYes").style.display = "block";
		} else {
			document.getElementById("ifYes").style.display = "none";
		}
	}
</script>
<script type="text/javascript">
  function view1010(status){
    view10(status);
  }
</script>                    
<!-- CHOSEN -->
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
<!-- CHOSEN END-->
