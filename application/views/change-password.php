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
          <div class="welcome_heading">Change Password</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          	<div class="change_pass_box">
                    
         	<?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable alert-custom"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                </div>
              </div>
              <?php  } ?> 
               <?php $attributes = array('class' => 'create_account style2 accountdash','method'=>'post','autocomplete'=>'off');   
				echo form_open_multipart('change-password',$attributes);
				?>
              <?php //echo validation_errors(); ?>
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label class="labelaccount">Old Password <span class="req">*</span></label>
                  <?php echo form_input(array(
            'name'=>'oldPassword',
            'id'=>'oldPassword',
            'type'=>'password',
            'maxlength'=>20,
            'class'=> "form-control",
            'value'=>set_value('oldPassword')));
            ?> 
			<?php echo form_error('oldPassword'); ?> </div>
            
              </div>
              <div class="row">
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label class="labelaccount"> New Password <span class="req">*</span></label>
                  <?php echo form_input(array(
            'name'=> 'newPassword',
            'id'=>'newPassword',
            'type'=> 'password',
            'class' => "form-control",
            'value' =>set_value('newPassword')));
            ?> <?php echo form_error('newPassword'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label class="labelaccount"> Confirm New Password <span class="req">*</span></label>
                  <?php echo form_input(array(
            'name'=> 'conPassword',
            'id'=>'conPassword',
            'type'=> 'password',
            'class' => "form-control",
            'value' =>set_value('conPassword')));
            ?> <?php echo form_error('conPassword'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12"> <?php echo form_button(array( 'name'=>'changepass','id'=> 'submitpass','value'=> 'true','class'=>'btn btn-primary btn-dash','type'=> 'submit','content' => 'Submit')); ?> </div>
              </div>
              <?php form_close(); ?>	
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
