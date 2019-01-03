<?php $this->load->view('layouts/header'); ?>
<div class="container">
	<div class="row">
		<?php if($this->session->userdata('userSessId') ): ?>

		
			<div class="col-md-3">
				<div class="list-group">
					<p class="menu">MAIN NAVIGATION</p>
					<?php if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
						<a href="/" class="list-group-item <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'questions' && $this->uri->segment(1) != "questions"): ?>active<?php endif; ?>"><i class="fa fa-bar-chart"></i> Dashboard</a>
						<a href="/questions/all" class="list-group-item <?php if($this->uri->segment(1) == 'questions' || $this->uri->segment(2) == 'results' || $this->uri->segment(2) == 'manage' || $this->uri->segment(2) == 'edit'): ?>active<?php endif; ?>"><i class="fa fa-bookmark"></i> Questionnaires</a>
					<?php else: ?>
						<a href="/" class="list-group-item <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'questions' && $this->uri->segment(2) != "all" &&  $this->uri->segment(2) != 'takenow' &&  $this->uri->segment(2) != 'instructions'  &&  $this->uri->segment(2) != 'view'): ?>active<?php endif; ?>"><i class="fa fa-user"></i> My Profile</a>
						<a href="/questions/all" class="list-group-item <?php if($this->uri->segment(2) == 'all' || $this->uri->segment(2) == 'results' || $this->uri->segment(2) == 'manage' || $this->uri->segment(2) == 'edit'|| $this->uri->segment(2) == 'takenow'  ||  $this->uri->segment(2) == 'instructions'  ||  $this->uri->segment(2) == 'view'): ?>active<?php endif; ?>"><i class="fa fa-bookmark"></i> Questionnaires</a>
					<?php endif; ?>
					<?php if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
						<a href="/reports" class="list-group-item <?php if($this->uri->segment(1) == 'reports'): ?>active<?php endif; ?>"><i class="fa fa-folder"></i> Reports</a>
					<?php endif; ?>
					<?php if(!$this->session->userdata('gmailSessId') ): ?>
						<a href="/users/changepassword" class="list-group-item <?php if($this->uri->segment(2) == 'changepassword'): ?>active<?php endif; ?>"><i class="fa fa-lock"></i> Change Password</a>
					<?php endif; ?>
					<a href="/users/logout" onclick="signOut();" class="list-group-item"><i class="fa fa-power-off"></i> Logout</a>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-9">
	    	<div id="contents"><?php echo $contents ?></div>
	  	</div>
	</div>
</div>
<?php $this->load->view('layouts/footer'); ?>