<?php
//Make 18 From & 30 To Year Selected for Search
//$selected_a='1';

$SQL_STATEMENT_match = "select part_to_age from matches where matri_id='$s_id'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
if($DatabaseCo->dbRow->part_to_age != ''){
	$selected_b=$DatabaseCo->dbRow->part_to_age;
}else{
	$selected_b='1';
}

$SQL_STATEMENT_TO_AGE = $DatabaseCo->dbLink->query("SELECT * FROM age");
while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_TO_AGE)) {
?>
  <option value="<?php echo $DatabaseCo->dbRow->id; ?>" 
		  <?php if($DatabaseCo->dbRow->id <= $selected_a ){ 
					echo 'disabled'; 
				}if($selected_b == $DatabaseCo->dbRow->id ){
					echo 'selected';	
				} 
		  ?>>
	  <?php echo $DatabaseCo->dbRow->age; ?> Year</option>
<?php } ?>  
