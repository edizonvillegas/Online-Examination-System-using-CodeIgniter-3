<div class="container" id="userLogin">
  <div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading text-uppercase text-center h3"><a href="/">LOGO</a></div>
        <div class="panel-body">
          <?php echo form_open('users/signup_validation'); ?>
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter Firstname" required>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Lastname" required>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LdWMVIUAAAAABQesB7lf1-HY4o7bnzKu0V5EIbQ" data-callback="enableUserBtn"></div>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-info btn-lg" id="enableUserBtn">Sign Up</button>
            </div>
            <div class="form-group">
              <?php if($this->session->flashdata('failed') ): ?>
                  <p class="error text-danger"><?php echo $this->session->flashdata('failed'); ?></p>
              <?php endif; ?>
              <?php if($this->session->flashdata('success') ): ?>
                  <p class="error text-success"><?php echo $this->session->flashdata('success'); ?></p>
              <?php endif; ?>
            </div>
          <?php echo form_close(); ?>
        </div>
        <div class="panel-footer">
          <p id="signupHere">Already have an account?<a href="<?php echo base_url().'users/login' ?>">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById("enableUserBtn").disabled = true;

function enableUserBtn(){
    document.getElementById("enableUserBtn").disabled = false;
}

</script>