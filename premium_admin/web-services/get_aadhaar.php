<?php
    include_once '../../databaseConn.php';
    include_once '../../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();	


    $from_id = isset($_GET['frmid']) ? mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['frmid']):0;
    $get=$DatabaseCo->dbLink->query("SELECT aadhaar_card,username FROM register WHERE matri_id='$from_id'");
    $row=mysqli_fetch_object($get);
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Aadhaar Card of <?php echo $row->username;?></h4>
        </div>
        <div class="modal-body">                 
            <div class="form-group"> 
                <img src="../documents/<?php echo $row->aadhaar_card;?>" class="img-responsive" style="width:100%;max-height :400px;">          
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>