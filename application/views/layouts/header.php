<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="google-signin-client_id" content="671546476176-kgp62t1kpb9ljeb2kjijg8cnpf95cl06.apps.googleusercontent.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css' ?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome-4.7.0/css/font-awesome.min.css' ?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css' ?>" />
  <?php if(! $this->session->userData('userSessId') ): ?>
    <style>
      body {background: #d9534f;}
      @media screen and (max-width:767px) {
        body {
          padding-top: 0;
        }
      }
    </style>
  <?php endif; ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="<?php echo base_url().'assets/js/jquery.min.js' ?>"></script><!-- andito kasi need mag run ng jquery ajax sa html content -->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="row">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="col-md-3">
        <div class="navbar-header">
          <?php if($this->uri->segment(1) != 'users' ): ?>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">LOGO</a>
          <?php endif; ?>
        </div>
      </div>
      
      <?php if($this->session->userdata('userSessId') && !$this->session->userdata('start') ): ?>
        <form action="/questions/redirect" method="POST">
          <div class="col-md-5 search">
            <input type="text" name="term" autocomplete="off" id="term" class="form-control autocomplete" placeholder="Search for topics" required>
            <button><i class="fa fa-search"></i></button>
          </div>
        </form>
      <?php endif; ?>
  
      <?php if($this->session->userdata('userSessId') && !$this->session->userdata('start') ): ?>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <?php if($this->session->userdata('userSessId') ): ?>
            <li>
              <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown">Login as <strong id="loginAs"><?php echo $this->session->userdata('userSessId'); ?></strong>
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <?php if(!$this->session->userdata('gmailSessId') ): ?>
                    <li><a href="/users/changepassword"><i class="fa fa-lock"></i> Change Password</a></li>
                    <li><div class="divider"></div></li>
                  <?php endif; ?>
                  <!-- <li><a href="/questions/import"><i class="fa fa-download"></i> Import data from Excel</a></li> -->
                  <li><a href="<?php echo base_url().'users/logout' ?>" onclick="signOut();"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
              </div>
            </li>
          <?php else: ?>
            <?php if($this->uri->segment(1) != "users" && $this->uri->segment(2) != "login"): ?>
              <li><a href="<?php echo base_url().'users/login' ?>" id="mustLogin">Login</a></li>
              <li><a href="<?php echo base_url().'users/signup' ?>" id="mustSignUp">Sign Up</a></li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    <?php endif; ?>
    </div>
  </div><!-- /.container-fluid -->
</nav>