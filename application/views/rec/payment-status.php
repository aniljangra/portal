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
          <div class="e-page-title">
            <h3>Payment Status</h3>
          </div>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-8 offset-md-2">
        	<div class="application_success_box">
            		<div class="icon-success"><i class="far fa-check-circle"></i></div>
            		<div class="success_content">Dear Applicant, You application submitted successfully. You will Notified for Further by SMS or Email Id.</div>
            </div>
        </div>
      </div>
      <div class="row">
      
      	<div class="col-md-8 offset-md-2">
        <table  style="width:100%" class="table table-bordered table-paystatus">
          <tr>
            <th width="36%"><strong>Application No.</strong></th>
            <td width="64%"><?php echo $paydata->reg_id; ?></td>
          </tr>
          <tr>
            <th><strong>Applicant Name</strong></th>
            <td><?php 
$reg_name=$paydata->reg_firstname; if($paydata->reg_middlename!=""){  $reg_name.=" ".$paydata->reg_middlename; }
if($paydata->reg_lastname!=""){  $reg_name.=" ".$paydata->reg_lastname; } echo $reg_name; ?></td>
          </tr>
          <tr>
            <th><strong>Father's Name</strong></th>
            <td><?php echo $paydata->reg_fathername; ?></td>
          </tr>
          <tr>
            <th><strong>Course Name</strong></th>
            <td><?php echo $paydata->course_name; ?></td>
          </tr>
          <tr>
            <th><strong>Payment Ref. Number</strong></th>
            <td><?php echo $paydata->pay_refno; ?></td>
          </tr>
          <tr>
            <th   style="background:#CCDFB9;"><strong>Payment Status</strong></th>
            <td   style="background:#CCDFB9;">Payment Success ( <?php echo $paydata->pay_responsecode; ?>)</td>
          </tr>
          <tr>
          
          </tr>
        </table>
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
