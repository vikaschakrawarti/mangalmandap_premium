<?php
//Make 18 From & 30 To Year Selected for Search
//$selected_a='1';
$selected_b='13';

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
