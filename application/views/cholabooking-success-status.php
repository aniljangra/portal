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
            <h3>Chola Booking  Registration Receipt</h3>
          </div>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-12">
        	<div class="table-responsive">
            <table  style="width:100%" class="table table-bordered table-striped">
            	 <tr>
                <td width="25%"><strong>Booked For Date</strong></td>
                <td width="60%"><?php echo date('d-m-Y',strtotime($cbdata->cb_bookfordate)); ?></td>
                  <td width="15%" rowspan="6" align="center" valign="middle">
                      <?php $cb_proof=$cbdata->cb_proof;
					  if($cb_proof!=""){ ?>
                        <img src="<?php echo base_url().$cb_proof ?>" style="width:120px;"/>    
                      <?php    } ?>
                      
                      </td>
              </tr>
               <tr>
                <td width="25%"><strong>Temple Name</strong></td>
                <td width="60%"><?php echo $cbdata->temple_name;  ?></td>
              </tr>
              <tr>
                <td width="25%"><strong>Name</strong></td>
                <td width="60%"><?php echo $cbdata->cb_name; ?></td>
              </tr>
              <tr>
                <td><strong>Mobile</strong></td>
                <td><?php echo $cbdata->cb_mobile; ?></td>
              </tr>
              <tr>
                <td><strong>Email Id</strong></td>
                <td><?php echo $cbdata->cb_email; ?></td>
              </tr>
               <tr>
                <td><strong><strong>Service Charge</strong></strong></td>
                <td>Rs. <?php echo $cbdata->cb_amount; ?></td>
              </tr>
              <tr>
                <td><strong>Transaction Status</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_transstatus; ?></td>
              </tr>
               
               <tr>
                <td><strong>Bank Ref. Number</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_bankrefno; ?></td>
              </tr>
              <tr>
                <td><strong>Status Detail</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_statusdesc ; ?></td>
              </tr>
               <tr>
                <td><strong>Transaction Date</strong></td>
                <td colspan="2"><?php echo $cbdata->cb_transdate; ?></td>
              </tr>
            </table>
  				<?php if($cholarow->cb_othermember=="Yes"){?>
                  <table style="width:100%" class="table table-bordered table-striped table-trans">
                    <thead>
               
                    <tr>
                      <th width="28%"><strong> Member Name</strong></th>
                      <th width="31%"><strong> Member Mobile</strong></th>
                      <th width="41%"><strong> Member Aadhaar No.</strong></th>
                   </tr>
                    </thead>
                    <tbody>
                    <?php if($cholarow->cb_devotee_name1!=""){?>
                    <tr>
                    <td><?php echo $cholarow->cb_devotee_name1;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_mobile1;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_aadhar1;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cholarow->cb_devotee_name2!=""){?>
                    <tr>
                    <td><?php echo $cholarow->cb_devotee_name2;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_mobile2;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_aadhar2;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cholarow->cb_devotee_name3!=""){?>
                    <tr>
                      
                      <td><?php echo $cholarow->cb_devotee_name3;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_mobile3;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_aadhar3;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cholarow->cb_devotee_name4!=""){?>
                    <tr>
                      
                      <td><?php echo $cholarow->cb_devotee_name4;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_mobile4;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_aadhar4;  ?></td>
                    </tr>
                    <?php }?>
                   <?php if($cholarow->cb_devotee_name5!=""){?>
                    <tr>
                      
                      <td><?php echo $cholarow->cb_devotee_name5;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_mobile5;  ?></td>
                      <td><?php echo $cholarow->cb_devotee_aadhar5;  ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                  </table>
                   <?php } ?>
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
