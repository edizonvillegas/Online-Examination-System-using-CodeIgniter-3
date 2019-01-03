<div class="panel panel-primary">
	<div class="panel-heading text-uppercase"><strong>Change Password</strong></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<?php if($this->session->flashdata('passwordChanged') ): ?>
					<?php echo $this->session->flashdata('passwordChanged'); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<form action="<?php echo base_url().'users/newpassword' ?>" method="POST">
					<div class="form-group">
						<label for="oldPassword">Old password</label>
						<input type="password" class="form-control" name="oldPassword" id="oldPassword" required>
					</div>
					<div class="form-group">
						<label for="newPassword">New password</label>
						<input type="password" class="form-control"  name="newPassword" id="newPassword" required>
					</div>
					<div class="form-group">
						<label for="confirmNewPassword">Confirm new password</label>
						<input type="password" class="form-control" n name="confirmNewPassword" id="confirmNewPassword" required>
					</div>
					<div class="form-group">
						<button type="reset" class="btn">Clear</button>
						<button class="btn btn-danger" onclick="return confirm('Would you like to Continue?')">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>