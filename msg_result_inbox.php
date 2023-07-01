<?php
    include_once 'databaseConn.php';
    include_once './lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();
    include_once './class/Config.class.php';
    $configObj = new Config();
?>
<?php
    if(isset($_POST['msg_status']) && $_POST['msg_status']=='replay_msg'){
        echo "<script>window.location='composeMessages?msg_id=".$_POST['msg_id']."&inb=1'</script>";	
    }
    if(isset($_POST['msg_status']) && $_POST['msg_status']=='forward_msg'){
        echo "<script>window.location='composeMessages?msg_id=".$_POST['msg_id']."&frwd=1'</script>";	
    }
    if(isset($_POST['msg_status']) && $_POST['msg_status']=='trash')	{
        $msg_id=explode(",",$_POST['msg_id']);
        foreach($msg_id as $key=>$value){
            $DatabaseCo->dbLink->query("UPDATE messages SET msg_status='trash' AND trash_receiver='Yes' WHERE mes_id='".$value."'");
        }
        echo "<script>alert('Your messages trash action complete successfully.');</script>";
        echo "<script>window.location='inboxMessages';</script>";
    }
    if(isset($_POST['msg_status']) && $_POST['msg_status']=='important'){
        $msg_id=explode(",",$_POST['msg_id']);
        foreach($msg_id as $key=>$value){
            $DatabaseCo->dbLink->query("UPDATE messages SET msg_important_status='Yes' WHERE mes_id='".$value."'");
        }
        echo "<script>alert('Your messages important action complete successfully.');</script>";
    }
    if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='No'){
        $DatabaseCo->dbLink->query("UPDATE messages SET msg_important_status='No' WHERE mes_id='".$_POST['msg_id']."'");
        echo "<script>alert('Your messages important action complete successfully.');</script>";
    }
    if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='Yes'){
        $DatabaseCo->dbLink->query("UPDATE messages SET msg_important_status='Yes' WHERE mes_id='".$_POST['msg_id']."'");
        echo "<script>alert('Your messages important action complete successfully.');</script>";
    }
    if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read'){
        $get_msg=$DatabaseCo->dbLink->query("SELECT * FROM messages WHERE to_id='".$_SESSION['user_id']."' AND msg_read_status='Yes' AND msg_status='sent' and trash_receiver='No' ORDER BY mes_id DESC");
    }else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='unread'){
        $get_msg=$DatabaseCo->dbLink->query("SELECT * FROM messages WHERE to_id='".$_SESSION['user_id']."' AND msg_read_status='No' AND msg_status='sent' and trash_receiver='No' ORDER BY mes_id DESC");
    }else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read_all'){
        $get_msg=$DatabaseCo->dbLink->query("SELECT * FROM messages WHERE to_id='".$_SESSION['user_id']."' AND msg_status='sent' AND trash_receiver='No' ORDER BY mes_id DESC");	
    }else{
        $get_msg=$DatabaseCo->dbLink->query("SELECT * FROM messages WHERE to_id='".$_SESSION['user_id']."' AND msg_status='sent' AND trash_receiver='No' ORDER BY mes_id DESC");	
    }
    if(mysqli_num_rows($get_msg)>0){									
?>
<form method="post" action="" id="msg_data_form">
    <ul class="list">
        <?php 
            while($DatabaseCo->dbRow = mysqli_fetch_object($get_msg)){
                include "parts/main_msg_inbox.php" ; 
            } 
        ?>
    </ul>
</form>
<?php }else{ ?>
<form method="post" action="" id="msg_data_form">
    <ul class="list">
        <div class="thumbnail">
            <img src="img/nodata-available.jpg">
        </div>
    </ul>  
</form>
<?php } ?>                       
