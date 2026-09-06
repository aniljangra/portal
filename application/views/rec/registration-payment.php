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
            <h3>Regsitration Step 4: Payment Information</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <table style="width:100%" class="table table-bordered table-payment">
            <tr>
              <th width="34%">Application No.</th>
              <td width="66%"><?php echo $regdata->reg_id; ?></td>
            </tr>
            <tr>
              <th>Name of the Applicant</th>
              <td><?php 

				$reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){  $reg_name.=" ".$regdata->reg_middlename; }

				if($regdata->reg_lastname!=""){  $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name; ?></td>
            </tr>
            <tr>
              <th>Father's Name</th>
              <td><?php echo $regdata->reg_fathername; ?></td>
            </tr>
            <tr>
              <th>Date of Birth</th>
              <td><?php echo  date('d-m-Y',strtotime($regdata->reg_dob)); ?></td>
            </tr>
            <tr>
              <th>Gender</th>
              <td><?php echo $regdata->reg_gender; ?></td>
            </tr>
            <tr>
              <th>Mobile Number</th>
              <td><?php echo $regdata->reg_mobileno; ?></td>
            </tr>
            <tr>
              <th>Email Id</th>
              <td><?php echo $regdata->reg_email; ?></td>
            </tr>
            <tr>
              <th>Course Applying For</th>
              <td><?php echo $regdata->course_name; ?></td>
            </tr>
            <tr>
              <th>Application Fee Payable</th>
              <td>Rs. 500.00</td>
            </tr>
          </table>
        </div>
        <div class="col-md-12 text-center">
          <?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'instAddForm','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('student/registration-payment',$attributes);
echo form_button(array( 'name'=>'paysubmit','id'=> 'paysubmit','value'=> 'true','class'=>'btn btn_payment btn-primary','type'=> 'submit','content' => 'Click Here to Make Online Payment'));
echo form_close();
 ?>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
</body>
</html>
