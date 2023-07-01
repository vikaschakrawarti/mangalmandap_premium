<?php
    include_once '../databaseConn.php';
    $DatabaseCo = new DatabaseConn();
    $mid = $_SESSION['user_id'];
    $Row1 = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT photo1_approve,photo1,gender FROM register WHERE matri_id='".$mid."'"));
?>
<?php if($Row1->photo1_approve == 'UNAPPROVED'){ ?>
    <?php if($_SESSION['gender123']=="Female"){ ?>
        <img src="img/female-pending-approval.jpg" class="img-responsive gtFullWidth gtMaxH80">
    <?php }else{ ?>
        <img src="img/male-pending-approval.jpg" class="img-responsive gtFullWidth gtMaxH80">
    <?php } ?>
<?php } else {?>
<?php
    if ($Row1->photo1 != '' && file_exists('../my_photos/' . $Row1->photo1)) {
?> 
<a class="ripplelink">
    <img src="my_photos/<?php echo $Row1->photo1; ?>" class="img-thumbnail gt-header-logo gtMaxH80">
</a>
<?php } else { ?> 
<?php if($_SESSION['gender123'] == 'Female'){ ?>
	<img src="img/female.jpg"  class="img-responsive gtMaxH80">
<?php }else{ ?>
	<img src="img/male.jpg"  class="img-responsive gtMaxH80">
<?php } } } ?>
