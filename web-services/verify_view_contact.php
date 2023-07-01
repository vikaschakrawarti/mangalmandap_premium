<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();	
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';
$from_id = isset($_REQUEST['toid']) ? $_REQUEST['toid']:0;   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=$DatabaseCo->dbLink->query($select);
$fetch=mysqli_fetch_array($exe);
$total_cnt=$fetch['p_no_contacts'];
$used_cnt=$fetch['r_cnt'];
$checker=mysqli_num_rows($DatabaseCo->dbLink->query("select * from contact_checker where my_id='$mid' and viewed_id='$from_id'"));
if($_SESSION['user_id']!='')
{
if($total_cnt-$used_cnt>0)
{
?>
<div class="modal-dialog modal-sm">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel"><?php echo $lang['Your Contact Balance']; ?></h4>
    </div> 
    <div class="modal-body">     
    	<form name="MatriForm" id="MatriForm" action="" method="post">
          <div class="row">
            <div class="col-xs-16">
                <h4 class="text-center"><?php if($checker!=0){ echo "Contact details have been already seen."; ?></h4>
                <h4 class="text-center gt-margin-bottom-5"><?php echo $lang['Remaining Contacts']; ?> </h4>
                <h3 class="text-center text-danger gt-margin-top-0"><?php echo $total_cnt-$used_cnt;?> / <?php echo $total_cnt;?></h3> 
                <?php } else {?>
                <h4 class="text-center gt-margin-bottom-5"><?php echo $lang['Remaining Contacts']; ?></h4>  
                <h3 class="text-center text-danger gt-margin-top-0"><?php echo $total_cnt-$used_cnt;?> / <?php echo $total_cnt;?></h3>
                <?php } ?>
              
            </div>
          </div>                                                   
          <h4 class="text-center gt-margin-bottom-20"><?php echo $lang['You want to see contact Details?']; ?></h4>
          <div class="row">
            <div class="col-xs-8">                
              <a class="btn  gt-btn-green btn-block" onClick="getContactDetail('<?php echo $from_id; ?>')"><?php echo $lang['Yes']; ?></a>
            </div>
            <div class="col-xs-8">                
              <a class="btn gt-btn-orange  btn-block" data-dismiss="modal" aria-hidden="true"><?php echo $lang['No']; ?></a>
            </div>
          </div>
    </form>
    </div>      
  </div>
</div>
<?php }else{  ?>		
<div class="modal-dialog modal-lg">		  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel"><?php echo $lang['Upgrade Your Membership']; ?></h4>
    </div>	
    <div class="modal-body">		  
   		 <form name="MatriForm" id="MatriForm" action="membershipplans.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>&nbsp;&nbsp;<?php echo $lang['Please get the contact view balance by upgrading your membership.']; ?>
          </h4>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button class="btn gt-btn-orange" formaction="membershipplans.php"><?php echo $lang['Upgrade Now']; ?>
          </button>
        </div>
      </div>
    </form>			  
    </div>
  </div>
</div>
<?php	}    }else{   ?>
<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;"><?php echo $lang['Please Login']; ?> !!!
      </h4>
    </div>      
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="membershipplans.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>&nbsp;&nbsp;<?php echo $lang['Please Login to access this feature.']; ?>
          </h4>
        </div>
      </div>                                                   
      <div class="row">
        <div class="col-sm-offset-4 col-sm-10">                
          <button class="btn gt-btn-orange" formaction="login.php"><?php echo $lang['Login Now']; ?>
          </button>
        </div>
      </div>
    </form>      
  </div>
</div>
<?php    }    ?>