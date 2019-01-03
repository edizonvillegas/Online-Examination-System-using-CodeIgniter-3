<div class="container" id="userLogin">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-uppercase text-center h3"><a href="/">LOGO</a></div>
                <div class="panel-body">
                    <?php echo form_open('users/login_validation'); ?>
                        <div class="form-group">
                            <!-- HTML for render Google Sign-In button -->
                            <div id="gSignIn"></div>
                            <!-- HTML for displaying user details -->
                            <div class="userContent"></div>
                        </div>
                        <div class="form-group">
                            <label for="userId">Username</label>
                            <input type="text" name="userId" autocomplete="off" id="userId" class="form-control" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="userPass">Password</label>
                            <input type="password" name="userPass" id="userPass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdWMVIUAAAAABQesB7lf1-HY4o7bnzKu0V5EIbQ" data-callback="enableUserBtn"></div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-info btn-lg" id="enableUserBtn">Login</button>
                        </div>
                        <div class="form-group">
                            <?php if($this->session->flashdata('msg') ): ?>
                                <p class="error text-danger"><?php echo $this->session->flashdata('msg'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group" id="googleloginError"></div>
                    <?php echo form_close(); ?>
                </div>
                <div class="panel-footer">
                    <p id="signupHere">Don't have an account?<a href="<?php echo base_url().'users/signup' ?>">Sign up here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// document.getElementById("enableUserBtn").disabled = true;

// function enableUserBtn(){
//     document.getElementById("enableUserBtn").disabled = false;
// }

</script>