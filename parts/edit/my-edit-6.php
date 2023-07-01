<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

	$SQLSTATEMENT=$DatabaseCo->dbLink->query("SELECT country_id,state_id,city,city_name,state_name FROM register_view WHERE matri_id='$matri_id'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
	
	$country_id=$DatabaseCo->dbRow->country_id;
	$state_id=$DatabaseCo->dbRow->state_id;
	$city=$DatabaseCo->dbRow->city;
?>	
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-map-marker"></i><?php echo $lang['Location Information']; ?></span>
    <a class="pull-right btn gt-btn-orange" onClick="return view66('edit');">
        <i class="fas fa-pencil-alt fa-fw"></i><font class="gt-margin-left-5"><?php echo $lang['SUBMIT']; ?></font>
    </a>
</div>
<div class="gt-panel-body">
    <form method="post" name="reg_edit_6" id="reg_edit_6">
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['Country Living In']; ?> :
                </label>
                <select class="gt-form-control chosen-select" name="country" id="country" data-validetta="required">
                    <option value="">Select</option>
                    <?php
                        $SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT * FROM country where status='APPROVED'  ");
                        while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_country)){
                    ?>
                    <option value="<?php echo $DatabaseCo->Row->country_id ?>" <?php if($DatabaseCo->dbRow->country_id == $DatabaseCo->Row->country_id){ echo "selected"; } ?>>
                        <?php echo $DatabaseCo->Row->country_name; ?>
                    </option>
                    <?php } ?>
                    <div id="status1"></div>		
                </select>
            </div>				
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['State Living In']; ?> :
                </label>
                <select class="gt-form-control chosen-select" id="state" name="state_id" data-validetta="required">
                    <option value="">Select</option>
                    <?php
                        $SQL_STATEMENT_state = $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id='$country_id' and status='APPROVED' ORDER BY state_name ASC");
                        while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_state)) {
                    ?>
                        <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" <?php if($DatabaseCo->dbRow->state_id== $state_id){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->state_name; ?></option>
                    <?php } ?>
                </select>
                <div id="status2"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 pt-10 pb-10 gt-view-detail">
                <label>
                    <span class="text-danger mr-5 gtRegMandatory">*</span><?php echo $lang['City Living In']; ?> :
                </label>
                <select class="gt-form-control chosen-select" id="city" name="city" data-validetta="required">
                    <option value="">Select</option>
                    <?php
                        $SQL_STATEMENT_city = $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE cnt_id='".$country_id."' AND state_id='".$state_id."' and status='APPROVED' ORDER BY city_name ASC");
                        while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_city)) {
                    ?>
                        <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>" <?php if($DatabaseCo->dbRow->city_id == $city){ echo "selected"; } ?>><?php echo $DatabaseCo->dbRow->city_name ?></option>
                    <?php } ?>
                </select>    
            </div>
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
	function view66(status){	
		$(function(){
            $('#reg_edit_6').validetta({
                errorClose : false,
                onValid : function( event ) {
                 event.preventDefault();	
                 view6(status);
                }
            });
        });
		$('#reg_edit_6').submit();      
    }
</script>
<script>
	$("#country").on('change', function(){
		$("#status1").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		 var id = $(this).val();
         var dataString = 'id=' + id;
		jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax_country_state", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response){
				$("#state").find('option').remove().end().append(response);
				$('#state').trigger('chosen:updated');
				$("#status1").html('');		
			},			
		});		
	});
	$("#state").on('change', function(){
		$("#status2").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		var id = $(this).val();
        var cnt_id = $("#country").val();
        var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
		jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax_country_state", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response){
				$("#city").find('option').remove().end().append(response);
				$('#city').trigger('chosen:updated');
				$("#status2").html('');		
			},			
		});		
	});
</script>

 