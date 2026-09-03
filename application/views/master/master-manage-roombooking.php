<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
<?php if(isset($siteTitle)){ echo $siteTitle; } ?>
</title>
<?php include("includes/style-header.php"); ?>
<link href="<?php echo base_url(); ?>assets/master/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include("includes/sidebar.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include("includes/top-nav.php"); ?>
      <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Manage Room Booking All</h1>
        </div>
        
        <!-- Content Row -->
        
        <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
          </div>
        </div>
        <?php  } ?>
        <div class="row">
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="inner-section">
              <table class="table table-bordered" id="dataTbChola" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="3%" valign="top" class="column-title">Sr.</th>
                    <!--<th width="22%" valign="top" class="column-title">Order No</th>-->
                    <th width="12%" valign="top" class="column-title no-sort">Adult+Child</th>
                    <th width="17%" valign="top" class="column-title">Check-in Date</th>
                     <th width="12%" valign="top" class="column-title no-sort">No. Days</th>
                    <th width="13%" valign="top" class="column-title no-sort">No. Rooms</th>

                    <th width="10%" valign="top" class="column-title no-sort">Amount</th>
                    <th width="13%" valign="top" class="column-title">Status</th>
                    <th width="12%" valign="top" class="column-title">Date</th>
                     <th width="8%" valign="top" class="column-title no-sort">View</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				$count=0;
					foreach($rbdata as $rbrow){
					$rb_id=$rbrow->rb_id;
					$rb_regid=$rbrow->rb_regid;
					?>
                  <tr class="even pointer">
                    <td><?php echo ++$count; ?></td>
<!--                    <td><a href="<?php //echo site_url("master/room-booking/view/$rb_id"); ?>"  title="View" target="_blank"><?php //echo $rbrow->rb_orderno; ?></a></td>
-->                     <td><?php echo $rbrow->rb_noadult; ?>+<?php echo $rbrow->rb_nochild; ?></td>
                   <!-- <td><a href="<?php //echo site_url("master/user/view/$rb_regid");  ?>" target="_blank"><?php //echo $rbrow->rb_name; ?></a></td>-->
                    <td><?php echo date('d-m-Y',strtotime($rbrow->rb_bookfordate)); ?></td>
                    <td><?php echo $rbrow->rb_nodays; ?></td>
                    <td><?php echo $rbrow->rb_norooms; ?></td>

                     <td><?php echo $rbrow->rb_amount; ?></td>
                    <td><?php echo $rbrow->rb_transstatus; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($rbrow->rb_subdatetime)); ?></td>
                    <td><a href="<?php echo site_url("master/room-booking/view/$rb_id"); ?>"  title="View" target="_blank">View</a></td>
                  
                  </tr>
                  <?php }  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </div>
</div>
<?php include("includes/common-footer.php"); ?>
<?php include("includes/style-footer.php"); ?>
<script src="<?php echo base_url(); ?>assets/master/vendor/datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/master/vendor/datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/master/js/demo/datatables-demo.js"></script> 
<script type="text/javascript">

$(document).ready(function() {

    $('#dataTbChola').DataTable({

                    "language": {

                        "searchPlaceholder": "Search",

                    },

                    "ordering": true,

                    columnDefs: [{

                        orderable: false,

                        targets: "no-sort"

                    }]

                });

} );

</script>
</body>
</html>
