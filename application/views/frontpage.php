<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php if(isset($siteTitle)){ echo $siteTitle; } ?></title>
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
          <div class="welcome_heading">Welcome to Online Services</div>
        </div>
      </div>
      <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable alert-custom"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                </div>
              </div>
              <?php  } ?> 
              
              
      <div class="row">
      	<div class="col-md-12">
       <p> <strong>Note:</strong> Online Donation and Online Chola Booking will work best on <strong>Mozilla Firefox Browser</strong> if you don't have Mozilla Firefox kindly <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank" class="downloadhere">download from here</a></p>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("online-donation")  ?>">Online Donation</a> </div>
        </div>
        <div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("online-chola-booking")  ?>">Chola Booking</a> </div>
        </div>
       </div>
<div class="row">
      
      	<div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("room-booking")  ?>">Online Room Booking</a> </div>
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
