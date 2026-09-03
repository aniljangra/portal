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
<link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="welcome_heading">Room Booking Detail</div>
        </div>
        <div class="col-md-6"> <a href="<?php echo site_url('transactions/room-booking'); ?>" class="back_trans">&raquo; Back to Room Booking Transactions</a> </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table  style="width:100%" class="table table-bordered table-striped table-trans">
                  <tr>
                      <td width="21%"><strong>Order No.</strong></td>
                      <td width="79%"><?php echo $rbrow->rb_orderno;  ?></td>
                    </tr>
                  	<tr>
                      <td><strong>Check-in Date</strong></td>
                      <td><?php echo date('d-m-Y',strtotime($rbrow->rb_bookfordate)); ?></td>
                    </tr>
                     <tr>
                      <td><strong>No. of Days</strong></td>
                      <td><?php echo $rbrow->rb_nodays;  ?></td>
                    </tr>
                     <tr>
                      <td><strong>No. of Rooms</strong></td>
                      <td><?php echo $rbrow->rb_norooms;  ?></td>
                    </tr>
                      <tr>
                      <td><strong>Adult+Child</strong></td>
                      <td><?php echo $rbrow->rb_noadult; ?>+<?php echo $rbrow->rb_nochild; ?> </td>
                    </tr>
                      <tr>
                      <td><strong>Booked Name</strong></td>
                      <td><?php echo $rbrow->rb_name;  ?></td>
                    </tr>
                      <tr>
                      <td><strong>ID Proof Type</strong></td>
                      <td><?php echo $rbrow->rb_idtype;  ?></td>
                    </tr>
                      <tr>
                      <td><strong>ID Proof Number</strong></td>
                      <td><?php echo $rbrow->rb_idproofno;  ?></td>
                    </tr>
                    
                    
                   
                    <tr>
                      <td><strong>Email Id</strong></td>
                      <td><?php echo $rbrow->rb_email;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Mobile Number</strong></td>
                      <td><?php echo $rbrow->rb_mobile;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Address</strong></td>
                      <td><?php echo $rbrow->rb_address1;  if($rbrow->rb_address2!=""){ echo $rbrow->rb_address2; } ?></td>
                    </tr>
                    <tr>
                      <td><strong>City</strong></td>
                      <td><?php echo $rbrow->rb_city;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>State</strong></td>
                      <td><?php echo $rbrow->rb_state;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Pincode</strong></td>
                      <td><?php echo $rbrow->rb_pincode;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Amount</strong></td>
                      <td><?php echo $rbrow->rb_amount;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Transaction Status</strong></td>
                      <td><?php echo $rbrow->rb_transstatus;  ?></td>
                    </tr>
                   
                    <tr>
                      <td><strong>Payment Date</strong></td>
                      <td><?php if($rbrow->rb_transdate){
						 echo date('d-m-Y h:i a',strtotime($rbrow->rb_transdate));
					  }?></td>
                    </tr>
                    <tr>
                      <td><strong>Bank Ref. Number</strong></td>
                      <td><?php echo $rbrow->rb_bankrefno;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Status Description</strong></td>
                      <td><?php echo $rbrow->rb_paymessage;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Date</strong></td>
                      <td><?php echo date('d-m-Y',strtotime($rbrow->rb_subdatetime)); ?></td>
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
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/datatables-demo.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTbDonation').DataTable({
                    "language": {
                        "searchPlaceholder": "Search",
                    },
                    "ordering": true,
                    columnDefs: [{
                        orderable: false,
                        targets: "no-sort"
                    }]
                });

});
</script>
</body>
</html>
