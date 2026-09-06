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
            <h3>Room Booking  Status </h3>
          </div>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-12">
        	<div class="table-responsive">
            <table  style="width:100%" class="table table-bordered table-striped">
             <tr style=" <?php if($rbdata->rb_transstatus=="COMPLETED"){ echo "background:#94EDC2;"; }else{  echo "background:#F3C0C0;"; }?> ">
                <td width="29%"><strong>Check-in   Date</strong></td>
                <td width="71%"><?php echo date('d-m-Y',strtotime($rbdata->rb_bookfordate)); ?></td>
              </tr>
              <tr>
                <td width="29%"><strong>No. or Rooms </strong></td>
                <td width="71%"><?php echo $rbdata->rb_idproofno; ?></td>
              </tr>
              
             <tr>
                  <td><strong>No. of Days</strong></td>
                  <td><?php echo $rbdata->rb_nodays;  ?></td>
                </tr>
                   <tr>
                  <td><strong>Adult+Child</strong></td>
                  <td><?php echo $rbdata->rb_noadult; ?>+<?php echo $rbdata->rb_nochild; ?> </td>
                </tr>
               <tr>
                <td><strong>Name</strong></td>
                <td><?php echo $rbdata->rb_name; ?></td>
              </tr>
              <tr>
                <td><strong>Mobile</strong></td>
                <td><?php echo $rbdata->rb_mobile; ?></td>
              </tr>
              <tr>
                <td><strong>Email Id</strong></td>
                <td><?php echo $rbdata->rb_email; ?></td>
              </tr>
               <tr>
                <td><strong>Order Id</strong></td>
                <td><?php echo $rbdata->rb_orderno; ?></td>
              </tr>
               <tr>
                <td><strong>Amount</strong></td>
                <td>Rs. <?php echo $rbdata->rb_amount; ?></td>
              </tr>
              <tr>
                <td><strong>Transaction Status</strong></td>
                <td><?php echo $rbdata->rb_transstatus; ?></td>
              </tr>
               
               <tr>
                <td><strong>Refrence Number</strong></td>
                <td><?php echo $rbdata->rb_bankrefno; ?></td>
              </tr>
              <tr>
                <td><strong>Payment Message</strong></td>
                <td><?php echo $rbdata->rb_paymessage ; ?></td>
              </tr>
               <tr>
                <td><strong>Transaction Date</strong></td>
                <td><?php if($rbdata->rb_transdate!="" && $rbdata->rb_transdate!="0000-00-00"){ 
				echo date('d-m-Y',strtotime($rbdata->rb_transdate));
				}
				?></td>
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
