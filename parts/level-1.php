<?php
    //include 'databaseConn.php';
    $DatabaseCo = new DatabaseConn();

    $get_adv_l1 = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM advertisement WHERE adv_level='level-1' AND status='APPROVED' ORDER BY rand() limit 0,1"));
?>

<a href="<?php echo $get_adv_l1->adv_link; ?>" class="col-xs-16" target="_blank">
    <div class="row" style="max-width:160px !important;">
        <img src="advertise/<?php echo $get_adv_l1->adv_img; ?>" class="img-responsive" style="width:100%;max-height:600px !important;">
    </div>
</a>

