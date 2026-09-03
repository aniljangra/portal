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
            <h3>Online Hawan Booking <span>Step 3/3</span></h3>
          </div>
        </div>
      </div>
      <?php if(form_error('cb_bookfordate')){ ?>
		  <div class="row">
                      <div class="col-md-12">
                        <div class="alert alert-danger  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo form_error('cb_bookfordate'); ?></div>
                      </div>
                    </div>
	  <?php }?>
     
      <div class="row">
      	<div class="col-md-12">
       	 <?php echo form_error('hw_timeslot'); ?><br/>
          <?php echo form_error('hw_bookfordate'); ?>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
<form method="post" action="<?php echo "https://www.mansadevi.org.in/portal/hawan-booking/overview/$segment3";  ?>">
<?php	 echo form_hidden('hw_bookfordate',$hawanbooktemp->hw_bookfordate); ?>
<?php	 echo form_hidden('hw_timeslot',$hawanbooktemp->hw_timeslot); ?>


          <div class="row">
            <div class="col-md-12">
              <table width="100%" class="table table-bordered table-pro">
              <tr>
                  <td width="42%"><strong>Hawan Book For Date</strong></td>
                  <td width="58%"><?php echo  date('d-m-Y',strtotime($hawanbooktemp->hw_bookfordate)); ?></td>
                </tr>
                <tr>
                  <td width="42%"><strong>Time Slot</strong></td>
                  <td width="58%"><?php echo  $timeslotdata->hs_title; ?></td>
                </tr>
                
                <tr>
                  <td width="42%"><strong>Amount</strong></td>
                  <td width="58%">Rs <?php echo number_format($amount,2);  ?>  </td>
                </tr>
                <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo $regdata->reg_firstname;  if($regdata->reg_lastname!=""){ echo " ".$regdata->reg_lastname; }  ?></td>
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
<?php echo form_button(array( 'name'=>'bookHawanBook','id'=> 'bookHawanBook','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Pay Now')); ?>

<?php echo form_button(array( 'name'=>'backPage','id'=> 'backPage','value'=> 'true','class'=>'btn btn_custom_back btn-primary','type'=> 'submit','content' => 'Back')); ?>
 </td>
                </tr>
              </table>
            </div>
          </div>
         </form>
          </div>
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
</body>
</html>
