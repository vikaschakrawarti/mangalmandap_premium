<div class="modal fade" id="editPhoto2Modal" tabindex="-1" role="dialog" aria-labelledby="editPhoto1Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
       	<div class="col-12">
        	<h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['Edit Photo']; ?> 2
         	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
        	</h5>
        </div>
      </div>
      <div class="modal-body">
       	<form action="" method="post" enctype="multipart/form-data" class="editPhotoModal">
       		<p class="text-center"><?php echo $lang['Select image and then click on submit button to upload image']; ?></p>
        	<div class="col-xxl-10 col-xxl-offset-3">
				<center>
   				<?php if($Row->photo2 != '' && file_exists('my_photos/'.$Row->photo2)){?>
   					<img src="my_photos/<?php echo $Row->photo2; ?>" class="img-fluid img-thumbnail" id="photo2_prev">
   				<?php }else{?>
   					<?php if($Row->gender =='Female'){ ?>
   						<img src="img/female.jpg" class="img-fluid img-thumbnail" id="photo2_prev">
					<?php }else{ ?>
 						<img src="img/male.jpg" class="img-fluid img-thumbnail" id="photo2_prev">
  					<?php } ?>
   				<?php }?>
   				<input type="file" name="photo2" id="photo2" onchange="readURL2(this);">
   				<label for="photo2" class="btn gt-btn-orange btn-block gt-margin-top-20">
					<?php echo $lang['Select Image']; ?>
				</label>
				<div class="form-group text-center mt-3">
					<input type="submit" name="editPhoto2" value="<?php echo $lang['SUBMIT']; ?>" class="btn gt-btn-green btn-block gt-margin-top-20">
				</div>
				</center>
       		</div>
        </form>
		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>