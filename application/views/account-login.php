<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
<?php if(isset($siteTitle)){ echo $siteTitle; } ?>
</title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-elements.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-shop.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.min.js"></script>
</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-8 offset-md-2">
            <div class="signup-box">
              <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                </div>
              </div>
              <?php  } ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="heading mb-4">
                    <h2 class="title">Devotee Login Details</h2>
                    <p>If you have an account with SMMDSB, please log in.</p>
                  </div>
                </div>
              </div>
              <?php 
		$attributes = array('class' => 'create_account style2 ','method'=>'post','autocomplete'=>'off');   						echo form_open_multipart('login',$attributes);
		?>
              <?php //echo validation_errors(); ?>
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label> Login Id <span class="req">*</span></label>
                  <?php echo form_input(array(
            'name'=>'reg_loginid',
            'id'=>'reg_loginid',
            'type'=>'text',
            'maxlength'=>20,
            'class'=> "form-control",
            'value'=>set_value('reg_loginid')));
            ?> <?php echo form_error('reg_loginid'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label>Password <span class="req">*</span></label>
                  <?php echo form_input(array(
            'name'=> 'reg_password',
            'id'=> 'reg_password',
            'type'=> 'password',
            'maxlength'=>20,
            'class'=> "form-control",
            'value'=>set_value('reg_password')));
            ?> <?php echo form_error('reg_password'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12"> <?php echo form_button(array( 'name'=>'loginAccount','id'=> 'submit_servicemen','value'=> 'true','class'=>'btn btn-primary btn-custom-create','type'=> 'submit','content' => 'Login')); ?> </div>
              </div>
              <?php form_close(); ?>
              <div class="row">
                <div class="col-md-12">
                  <p> <a href="<?php echo site_url("create-account"); ?>" class="linka" title="Sign Up"> <strong>New User? Sign Up</strong></a><br/>
                    <a href="<?php echo site_url("forgot-password"); ?>" class="linka" title="Forgot password">Forgot password? Retrieve password</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/popper/umd/popper.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.init.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
</body>
</html>
