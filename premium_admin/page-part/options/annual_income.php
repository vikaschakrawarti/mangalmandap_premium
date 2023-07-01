<?php
$SQL_STATEMENT_INCOME =  $DatabaseCo->dbLink->query("SELECT * FROM income WHERE status='APPROVED'");
while($row_income = mysqli_fetch_object($SQL_STATEMENT_INCOME)){
?>
<option value="<?php echo $row_income->id; ?>" <?php if($row_income->id == $row['income']){ echo "selected"; } ?>><?php echo $row_income->income; ?></option>
<?php } ?>