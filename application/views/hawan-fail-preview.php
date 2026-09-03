<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$segment3=$this->uri->segment(3);
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
            <h3>Hawan Booking  Status </h3>
          </div>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-12">
        	<div class="table-responsive">
            <table  style="width:100%" class="table table-bordered table-striped">
             <tr style="background:#94EDC2;">
                <td width="29%"><strong>Hawan Booking Date</strong></td>
                <td width="71%"><?php echo date('d-m-Y',strtotime($hwdata->hw_bookfordate)); ?></td>
              </tr>
              <tr>
                <td width="29%"><strong>Time Slot </strong></td>
                <td width="71%"><?php echo $hwdata->hs_title; ?></td>
              </tr>
              <tr>
                <td><strong>Mobile</strong></td>
                <td><?php echo $hwdata->hw_mobile; ?></td>
              </tr>
              <tr>
                <td><strong>Email Id</strong></td>
                <td><?php echo $hwdata->hw_email; ?></td>
              </tr>
               <tr>
                <td><strong>Donation Amount</strong></td>
                <td>Rs. <?php echo $hwdata->hw_amount; ?></td>
              </tr>
              <tr>
                <td><strong>Transaction Status</strong></td>
                <td><?php echo $hwdata->hw_transstatus; ?></td>
              </tr>
                <tr>
                <td><strong>Payment Mode</strong></td>
                <td><?php echo $hwdata->hw_paymode; ?></td>
              </tr>
               <tr>
                <td><strong>Bank Refrence Number</strong></td>
                <td><?php echo $hwdata->hw_bankrefno; ?></td>
              </tr>
              <tr>
                <td><strong>Status Detail</strong></td>
                <td><?php echo $hwdata->hw_statusdesc ; ?></td>
              </tr>
               <tr>
                <td><strong>Transaction Date</strong></td>
                <td><?php echo $hwdata->hw_transdate; ?></td>
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
