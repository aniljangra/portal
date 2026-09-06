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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161805118-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-161805118-1');
</script>

</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <div class="e-page-title">
            <h3>Chola Booking</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
		<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('online-chola-booking',$attributes);
 ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
              <div class="form-group col-md-12 col-sm-12 sol-xs-12">
               <label>Select Temple <span class="req">*</span></label>
               <select class="form-control" name="cb_temple" aria-label="Default select example">
                  <option selected value="">--Select--</option>
                  <?php 
                  foreach($templedata as $templerow){ ?>
                  <option value="<?php echo $templerow->temple_id; ?>" <?php echo set_select('cb_temple',$templerow->temple_id); ?>><?php echo $templerow->temple_name; $temple_fee=$templerow->temple_fee;  if($temple_fee>0){?>  <?php echo " - Service Charge Rs. $temple_fee"; } ?> </option>

                  <?php } ?>
                </select>
                <?php echo form_error('cb_temple'); ?>
               </div>
              </div>
               <div class="row">
              <div class="col-md-12 form-group"><?php echo form_checkbox('cb_accept',1,set_checkbox('cb_accept',1)); ?>  I have read and I agree with the    <a href="<?php echo base_url('media/tc/chola_booking_tc.pdf'); ?>" target="_blank" class="tc-link">terms and conditions</a>. <br/>
              
                <?php echo form_error('cb_accept'); ?> </div>
            </div>
              
             <div class="row">
              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'regsubmit','id'=> 'regsubmit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Submit')); ?> </div>
              </div>
              
            </div>
          </div>
        </div>
        <?php echo form_close(); ?> </div>
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



</body>
</html>
