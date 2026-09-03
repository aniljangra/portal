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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/master/css/jquery-ui.css">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include("includes/sidebar.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include("includes/top-nav.php"); ?>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url("master/dashboard");  ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo site_url("master/hawan-booking/manage");  ?>">Manage Hawan Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Hawan Booking Detail</li>
          </ol>
        </nav>
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">View Hawan Booking Detail</h1>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="inner-section">
              <div class="row">
                <div class="col-md-12">
                  <table  style="width:100%" class="table table-bordered">
                  	<tr>
                      <td><strong>Booked Date</strong></td>
                      <td><?php echo date('d-m-Y',strtotime($hwrow->hw_bookfordate)); ?></td>
                    </tr>
                     <tr>
                      <td><strong>Slot</strong></td>
                      <td><?php echo $hwrow->hw_bookslotname;  ?></td>
                    </tr>
                    
                    
                    <tr>
                      <td width="21%"><strong>Order No.</strong></td>
                      <td width="79%"><?php echo $hwrow->hw_orderno;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Name</strong></td>
                      <td><?php echo $hwrow->hw_name;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Email Id</strong></td>
                      <td><?php echo $hwrow->hw_email;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Mobile Number</strong></td>
                      <td><?php echo $hwrow->hw_mobile;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Address</strong></td>
                      <td><?php echo $hwrow->hw_address;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>City</strong></td>
                      <td><?php echo $hwrow->hw_city;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>State</strong></td>
                      <td><?php echo $hwrow->hw_state;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Pincode</strong></td>
                      <td><?php echo $hwrow->hw_pincode;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Amount</strong></td>
                      <td><?php echo $hwrow->hw_amount ;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Transaction Status</strong></td>
                      <td><?php echo $hwrow->hw_transstatus;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Payment Mode</strong></td>
                      <td><?php echo $hwrow->hw_paymode;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Payment Date</strong></td>
                      <td><?php echo $hwrow->hw_transdate;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Bank Ref. Number</strong></td>
                      <td><?php echo $hwrow->hw_bankrefno;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Status Description</strong></td>
                      <td><?php echo $hwrow->hw_statusdesc;  ?></td>
                    </tr>
                    <tr>
                      <td><strong>Date</strong></td>
                      <td><?php echo $hwrow->hw_subdatetime;  ?></td>
                    </tr>
                  </table>
                </div>
              </div>
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
<script src="<?php echo base_url(); ?>assets/master/js/jquery-ui.js"></script> 
<script type="text/javascript">

$(document).ready(function() {

toggleFields2();

$(".emp_address_sameperma").change(function() { toggleFields2(); });

});



function toggleFields2(){

 	if($(".emp_address_sameperma").val()=="No"){ 

           $('.corres-address').show(); 

        }else if($(".emp_address_sameperma").val()=="Yes"){

           $('.corres-address').hide(); 

        }else{

			$('.corres-address').show(); 

		}



}

</script> 
<script type="text/javascript">

$('#datepicker').datepicker({

    dateFormat:'dd-mm-yy',

	changeYear: true,

	changeMonth: true,

	yearRange: "-50:+0",

});

$('#datepicker1').datepicker({

    dateFormat:'dd-mm-yy',

	changeYear: true,

	changeMonth: true,

	yearRange: "-100:+0",

});

</script>
</body>
</html>