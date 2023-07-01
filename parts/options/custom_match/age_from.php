<?php
//Make 18 Year Selected for Search

$SQL_STATEMENT_match = "select part_frm_age from matches where matri_id='$s_id'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
if($DatabaseCo->dbRow->part_frm_age != ''){
	$selected_a=$DatabaseCo->dbRow->part_frm_age;
}else{
	$selected_a='1';
}
$SQL_STATEMENT_FROM_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_FROM_AGE)) {
?>
  <option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_a) != '' ){ if($selected_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->age; ?> Year</option>
<?php } ?>