<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-blog.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-shop.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.min.js"></script>
</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main shop">
    <div class="container">
    <div class="row">
    	<div class="col-md-12" style="color:#ff0000; text-align:center;">Please login with your Registration Number  and Password to View Admit Card</div>
    </div>
    
      <div class="row">
        <div class="col">
          <div class="featured-boxes">
          <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                      </div>
                    </div>
                    <?php  } ?>
          
            <div class="row">
              <div class="col-md-6">
                <div class="featured-box featured-box-primary text-left mt-2">
                  <div class="box-content">
                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Only Registered Candidates Sign In</h4> <?php	
$attributes=array('class' => 'loginform','method'=>'post','id'=>'loginStudent','name'=>'loginStudent','autocomplete'=>'off');   
echo form_open('student/login',$attributes)
 ?>
                    <div class="form-row">
                      <div class="form-group col">
                        <label>Application No. <span class="req">*</span></label>
    <?php echo form_input(array(
    'name'=>'reg_loginid',
    'id'=>'reg_loginid',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_loginid')));
    ?> <?php echo form_error('reg_loginid'); ?> </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <label>Password <span class="req">*</span></label>
                        <?php echo form_input(array(
    'name'=>'reg_password',
    'id'=>'reg_password',
    'type'  => 'password',
    'class' => "form-control",
    'value' =>set_value('reg_password')));
    ?> <?php echo form_error('reg_password'); ?> </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-3"> <?php echo form_button(array( 'name'=>'reglogin','id'=> 'reglogin','value'=> 'true','class'=>'btn btn-primary btn-login','type'=> 'submit','content' => 'Login')); ?> </div>
                      <div class=" col-lg-9">
                        <p style="margin-top:15px;"><a href="<?php echo site_url("forgot-password"); ?>" class="forgot_link" title="Forgot Password or Application No.">Forgot Password?</a></p>
                      </div>
                    </div>
                    <?php echo form_close(); ?> </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="featured-box featured-box-primary text-left mt-2">
                  <div class="box-content">
                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">New Candidate Registration Steps</h4>
                    <ul class="list list-icons list-custom">
                    
                      <li><i class="fas fa-check"></i> Fill Personal Information</li>
                      <li><i class="fas fa-check"></i> Fill Educational Information</li>
                      <li><i class="fas fa-check"></i> Upload Scanned Documents</li>
                      <li><i class="fas fa-check"></i> Pay Examination Fee</li>
                    </ul>
                    <div class="row">
                      <div class="col-md-12"><a href="<?php echo site_url("registration-step1"); ?>" class="btn btn-primary btn-apply">New Applicant Register Here</a></div>
                    </div>
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
</body>
</html>
