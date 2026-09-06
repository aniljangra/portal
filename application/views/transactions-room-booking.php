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
          <div class="welcome_heading">Room  Booking History</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-trans table-striped" id="dataTbDonation" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="4%" valign="top" class="column-title">Sr.</th>
                  <th width="11%" valign="top" class="column-title">Adult+Child</th>
                  <th width="13%" valign="top" class="column-title">Check-in Date </th>
                   <th width="13%" valign="top" class="column-title">No. Days</th>
                   <th width="11%" valign="top" class="column-title">No. Rooms</th>
                  <th width="10%" valign="top" class="column-title">Amount</th>
                  <th width="20%" valign="top" class="column-title">Status</th>
                  <th width="11%" valign="top" class="column-title">Txn Date</th>
                  <th width="7%" valign="top" class="column-title no-sort">Details</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				$count=0;
					foreach($rbdata as $rbrow){
					$rb_id=$rbrow->rb_id;
					 $rb_transstatus=$rbrow->rb_transstatus;
					$enc_rb_id=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
					?>
                <tr class="even pointer">
                  <td><?php echo ++$count; ?></td>
                  <td><?php echo $rbrow->rb_noadult; ?>+<?php echo $rbrow->rb_nochild; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($rbrow->rb_bookfordate)); ?></td>
                    <td><?php echo $rbrow->rb_nodays; ?></td>
                    <td><?php echo $rbrow->rb_norooms; ?></td>
                  <td>Rs. <?php echo $rbrow->rb_amount; ?>/-</td>
                  <td><?php if($rb_transstatus=="COMPLETED"){ echo "SUCCESS";}elseif($rb_transstatus=="NOTREC"){ echo "PENDING"; }else{ echo $rb_transstatus; } ?></td>
                  
                   <td><?php echo date('d-m-Y',strtotime($rbrow->rb_subdatetime)); ?></td>
                  <td width="7%" align="center"><a href="<?php echo site_url("transactions/room-booking/$enc_rb_id"); ?>"  title="View" class="view_trans">View </a></td>
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
