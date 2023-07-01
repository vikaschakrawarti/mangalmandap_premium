<?php
$selected_i_a='2';
$SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
?>
<option value="<?php echo $DatabaseCo->dbRow->id; ?>" <?php if(isset($selected_i_a) != '' ){ if($selected_i_a == $DatabaseCo->dbRow->id ){ echo 'selected'; }} ?>><?php echo $DatabaseCo->dbRow->income; ?></option>
<?php } ?>