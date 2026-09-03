<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
          <h1 class="h3 mb-0 text-gray-800 mb-2">Manage Chola Date Setting</h1>
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
              <table class="table table-bordered" id="dataTbDonation" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="7%" valign="top" class="column-title">Sr.</th>
                      <th width="67%" valign="top" class="column-title">Temple</th>
                    <th width="17%" valign="top" class="column-title">Date</th>
                    <th width="9%"  align="center" class="column-title no-sort">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					$count=0;
					foreach($datesetdata as $datesetrow){
					$dset_id=$datesetrow->dset_id;
					$enc_dset_id=$this->encryptcode->encrypt($dset_id,ENC_KEY_PASS);
					?>
                  <tr class="even pointer">
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $datesetrow->temple_name; ?></td>
                    <td><?php $dset_date=$datesetrow->dset_date;
					if($dset_date!="" && $dset_date!="0000-00-00"){
						echo date('d-m-Y',strtotime($dset_date));	
					}
					 ?></td>
                    <td width="9%" align="center"><a href="<?php echo site_url("master/chola-datemgmt/remove/$enc_dset_id"); ?>"  title="Remove" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i> </a></td>
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

} );

</script>
</body>
</html>
