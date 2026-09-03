<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$segment3=$this->uri->segment(3)
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
            <h3>Devotee Donation Details : </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart("online-donation/overview/$segment3",$attributes);
echo form_hidden('donation_amount',$donationtemp->dotemp_amount); 
?>
          <div class="row">
         
            <div class="col-md-12">
              <table width="100%" class="table table-bordered table-pro">
                <tr>
                  <td width="27%"><strong>Donation Amount</strong></td>
                  <td width="73%">Rs. <?php echo number_format($donationtemp->dotemp_amount,2);  ?></td>
                </tr>
                <tr>
                  <td><strong>Devotee Full Name</strong></td>
                  <td><?php echo $donationtemp->dotemp_name;  ?></td>
                </tr>
                <tr>
                  <td><strong>Address</strong></td>
                  <td><?php echo $regdata->reg_address_line1; if($regdata->reg_lastname!=""){ echo ", ".$regdata->reg_address_line2; }  ?></td>
                </tr>
                <tr>
                  <td><strong>City</strong></td>
                  <td><?php echo $regdata->reg_city; ?></td>
                </tr>
                <tr>
                  <td><strong>State</strong></td>
                  <td><?php echo $regdata->reg_state; ?></td>
                </tr>
                <tr>
                  <td><strong>Pincode</strong></td>
                  <td><?php echo $regdata->reg_pincode; ?></td>
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
                  <td colspan="2">
<?php echo form_button(array( 'name'=>'paynow','id'=> 'paynow','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Pay Now')); ?> <?php echo form_close(); ?></td>
                </tr>
              </table>
            </div>
          </div>
          <?php echo form_close(); ?> </div>
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
<script type="text/javascript">
$('#reg_dob').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: true,
	changeMonth: true,
	yearRange: "-50:+0",
});
</script>
</body>
</html>
