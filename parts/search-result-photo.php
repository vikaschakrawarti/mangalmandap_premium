<?php
	$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
	if(isset($Row)){
?>
<?php 
		if($Row->photo1_approve == 'UNAPPROVED' && $Row->photo1 !='' ){
			if($Row->gender=="Female"){
?>
				<img src="img/app_img/female-photo-pending-approval.jpg" class="img-responsive gtFullWidth">
<?php }else{ ?>
    			<img src="img/app_img/male-photo-pending-approval.jpg" class="img-responsive gtFullWidth">
    <?php } 
		} else {?>
	<?php 
		if(($Row->photo1 != "" && $Row->photo1_approve == 'APPROVED' && file_exists('my_photos/'.$Row->photo1)) && (($Row->photo_view_status=='1') || ($Row->photo_view_status=='2' && isset($_SESSION['mem_status']) =='Paid')) && (($Row->photo_protect=='No') || ($Row->photo_protect=="Yes" && $Row->photo_pswd==''))){ 		   
	?>
				<img src="my_photos/watermark.php?image=<?php echo $Row->photo1; ?>&watermark=watermark.png" class="img-responsive gtFullWidth" title="<?php echo $Row->username; ?>" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>">             
		<?php 
			}elseif($Row->photo_protect=="Yes" && $Row->photo_pswd !=''){
				if($Row->gender=='Male'){
		?>
    				<img src="./img/app_img/male-photo-protected.jpg" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">	                                        
				<?php } else { ?>
					<img src="./img/app_img/female-photo-protected.jpg" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">   
				<?php 	} } else {  if($Row->gender=='Male'){ ?> 
				<img src="./img/app_img/male-no-photo.jpg" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">         
				<?php } else { ?>  
				<img src="./img/app_img/female-no-photo.jpg" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">               
				<?php   } } ?>
      <?php }}?>                    						  

