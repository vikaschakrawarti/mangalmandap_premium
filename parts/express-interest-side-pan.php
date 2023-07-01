	<div class="col-xxl-4 col-xl-4 gt-left-exp">
		<a class="btn gt-btn-orange btn-block gt-margin-bottom-15 visible-xs visible-sm visible-md btn-md" role="button" data-toggle="collapse" href="#collapseLeftPanel" aria-expanded="false" aria-controls="collapseLeftPanel">
    		Options &nbsp;&nbsp;<i class="fa fa-angle-down"></i>
		</a>
		<div class="collapse mobile-collapse gt-padding-bottom-15" id="collapseLeftPanel">
    		<a href="exp-interest.php" class="btn gt-btn-orange gt-btn-xl mb-20 btn-block"><i class="fa fa-star gt-margin-right-10 fa-spin"></i><?php echo $lang['']; ?>All Express Interest</a>
        	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
 				<div class="panel panel-default">
    				<div class="panel-heading" role="tab" id="headingOne">
      					<h4 class="panel-title ">
        					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
          						<?php echo $lang['Express Interest Received']; ?>
        					</a>
      					</h4>
    				</div>
    				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      					<div class="panel-body">
       						<a class="gt-exp-opt gt-cursor" id="exp-link-7">
                            	<?php echo $lang['Interest Received Pending']; ?><i class="fa fa-chevron-right gt-margin-left-10 pull-right"></i>
                            </a>
                            <a class="gt-exp-opt gt-cursor" id="exp-link-5">
                            	<?php echo $lang['Interest Received Accepted']; ?><i class="fa fa-chevron-right gt-margin-left-10  pull-right"></i>
                           	</a>
                            <a class="gt-exp-opt gt-cursor" id="exp-link-6">
                            	<?php echo $lang['Interest Received Rejected']; ?><i class="fa fa-chevron-right gt-margin-left-10  pull-right"></i>
                            </a>
      					</div>
   					</div>
  				</div>
  				<div class="panel panel-default">
    				<div class="panel-heading" role="tab" id="headingTwo">
      					<h4 class="panel-title">
        					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         						<?php echo $lang['Express Interest Sent']; ?>
       						</a>
      					</h4>
    				</div>
    				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      					<div class="panel-body">
       						<a class="gt-exp-opt gt-cursor" id="exp-link-2">
								<?php echo $lang['Interest Sent Accepted']; ?><i class="fa fa-chevron-right gt-margin-left-10 pull-right"></i>
                           	</a>
                            <a class="gt-exp-opt gt-cursor" id="exp-link-3">
                            	<?php echo $lang['Interest Sent Rejected']; ?> <i class="fa fa-chevron-right gt-margin-left-10  pull-right"></i>
                           	</a>
                            <a class="gt-exp-opt gt-cursor" id="exp-link-4">
                               	<?php echo $lang['Interest Sent Pending']; ?> <i class="fa fa-chevron-right gt-margin-left-10  pull-right"></i>
                            </a>
      					</div>
    				</div>
  				</div>
  			</div>
            <?php include "parts/level-2.php"; ?>
		</div>
	</div>