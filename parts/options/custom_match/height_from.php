<?php

$SQL_STATEMENT_match = "select part_height from matches where matri_id='$s_id'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
if($DatabaseCo->dbRow->part_height != ''){
	$selected_h_a=$DatabaseCo->dbRow->part_height;
}else{
	$selected_h_a='2';
}



$SQL_STATEMENT_HEIGHT =  $DatabaseCo->dbLink->query("SELECT * FROM height");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_HEIGHT)){
?>
<option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_h_a) != '' ){ if($selected_h_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->height; ?></option>
<?php } ?>