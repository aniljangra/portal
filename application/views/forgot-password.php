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
        <div class="col">
          <div class="featured-boxes">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="featured-box featured-box-primary text-left mt-2">
                  <div class="box-content">
                    <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Forgot Password</h4>
                    <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                      </div>
                    </div>
                    <?php  } ?>
                    <?php	
$attributes=array('class' => 'loginform','method'=>'post','id'=>'loginStudent','name'=>'loginStudent','autocomplete'=>'off');   
echo form_open('forgot-password',$attributes);
 ?>
                    <div class="form-row">
                      <div class="form-group col">
                        <label>Enter Registered Email Id <span class="req">*</span></label>
      <?php echo form_input(array(
    'name'=>'cust_email',
    'id'=>'cust_email',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('cust_email')));
    ?> <?php echo form_error('cust_email'); ?> </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="col-lg-12 form-group"> <?php echo form_button(array( 'name'=>'regforgot','id'=> 'regforgot','value'=> 'true','class'=>'btn btn-primary btn-login','type'=> 'submit','content' => 'Submit')); ?> </div>
                    
                    
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	<p><a href="<?php echo site_url("login"); ?>" class="linkback">&raquo; Back to Login Page</a></p>
                        </div>
                    </div>
                    
                    <?php echo form_close(); ?> </div>
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

<!-- Vendor --> 

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/popper/umd/popper.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.init.js"></script>
</body>
</html>
