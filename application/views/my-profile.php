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
        			<div class="welcome_heading">My Profile</div>	
        </div>
     </div>
     <div class="row">
     	<div class="col-md-12">
        <table  style="width:100%" class="table table-bordered table-pro">
          <tr class="table-pro-head">
            <td colspan="2">General Detail</td>
          </tr>
          <tr>
          	<td width="26%"><strong>Name</strong></td>
            <td width="74%"><?php $name=$regdata->reg_firstname; if($regdata->reg_lastname!=""){ 
			$name=$name." ".$regdata->reg_lastname;
			
			echo $name; } ?></td>
          </tr>
          <tr>
          	<td><strong>Mobile Number</strong></td>
            <td><?php echo $regdata->reg_mobileno; ?></td>
          </tr>
           <tr>
          	<td><strong>Email Id</strong></td>
            <td><?php echo $regdata->reg_email; ?></td>
          </tr>
           <tr>
          	<td><strong>Date of Birth</strong></td>
            <td><?php echo $regdata->reg_dob; ?></td>
          </tr>
            <tr>
          	<td><strong>Gender</strong></td>
            <td><?php echo $regdata->reg_gender; ?></td>
          </tr>
        </table>
		</div>
        <div class="col-md-12">
        <table  style="width:100%" class="table table-bordered table-pro">
          <tr class="table-pro-head">
            <td colspan="2">Residential Address</td>
          </tr>
        
          <tr>
          	<td width="26%"><strong>Address</strong></td>
            <td width="74%"><?php echo $regdata->reg_address_line1; if($regdata->reg_address_line2!=""){ echo ", ".$regdata->reg_address_line2;  } echo ", ".$regdata->reg_city; ?><br/><?php echo $regdata->reg_state; ?> - <?php echo $regdata->reg_pincode; ?></td>
          </tr>
          
        </table>
		</div>
        <div class="col-md-12">
        <table  style="width:100%" class="table table-bordered table-pro">
          <tr class="table-pro-head">
            <td colspan="2">Login Detail</td>
          </tr>
        
          <tr>
          	<td width="26%"><strong>Login Id</strong></td>
            <td width="74%"><?php echo $regdata->reg_loginid; ?></td>
          </tr>
          
        </table>
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
