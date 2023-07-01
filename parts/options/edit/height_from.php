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