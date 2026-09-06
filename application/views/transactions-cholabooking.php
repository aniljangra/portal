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
        <div class="col-md-12">
          <div class="welcome_heading">Chola Booking History</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-trans table-striped" id="dataTbDonation" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="4%" valign="top" class="column-title">Sr.</th>
                   <th width="18%" valign="top" class="column-title">Transaction ID</th>
                  <th width="18%" valign="top" class="column-title">Temple</th>
                  <th width="14%" valign="top" class="column-title">Booked For  Date</th>
                  <th width="10%" valign="top" class="column-title"> Amount</th>
                  <th width="12%" valign="top" class="column-title">Status</th>
                  <th width="14%" valign="top" class="column-title">Txn Date</th>
                  <th width="10%" valign="top" class="column-title no-sort">Details</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				$count=0;
					foreach($choladata as $cholarow){
					$cb_id=$cholarow->cb_id;
					$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
					?>
                	<tr class="even pointer">
                  <td><?php echo ++$count; ?></td>
                  <td><?php echo $cholarow->cb_orderno; ?></td>
                  <td><?php echo $cholarow->cb_name; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($cholarow->cb_bookfordate)); ?></td>
                  <td>Rs. <?php echo $cholarow->cb_amount; ?>/-</td>
                  <td><?php $cb_transstatus=$cholarow->cb_transstatus; if(empty($cb_transstatus)){ echo "Pending";}else{ echo $cb_transstatus; } ?></td>
                   <td><?php echo date('d-m-Y',strtotime($cholarow->cb_subdatetime)); ?></td>
                  <td width="10%" align="center"><a href="<?php echo site_url("transactions/chola-booking/$enc_cb_id"); ?>"  title="View" class="view_trans">View </a></td>
                </tr>
                <?php }  ?>
              </tbody>
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
