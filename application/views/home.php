<div class="panel panel-primary">
	<div class="panel-heading text-uppercase"><strong>Dashboard</strong></div>
	<div class="panel-body">
		<?php if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<div class="media">
					  <div class="media-left">
					    <i class="fa fa-users"></i>
					  </div>
					  <div class="media-body">	
					    <h4 class="media-heading">All Users</h4>
					    <p class="mediaText"><?php echo $users; ?></p>
					  </div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="media">
					  <div class="media-left">
					    <i class="fa fa-envelope"></i>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">Registered Users</h4>
					    <p class="mediaText"><?php echo $registered; ?></p>
					  </div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="media">
					  <div class="media-left">
					    <i class="fa fa-google"></i>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">Gmail Login</h4>
					    <p class="mediaText"><?php echo $google; ?></p>
					  </div>
					</div>
				</div>
				
			</div>
		<?php else: ?>
			my profile...
		<?php endif; ?>
	</div>
</div>