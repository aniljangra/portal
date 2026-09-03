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

          <h3>Online Donation</h3>

        </div>

      </div>

    </div>

    

    <div class="row">

      <div class="col-md-12">

<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('online-donation',$attributes);

 ?>

        <div class="panel panel-info">

          <div class="panel-heading">

            <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>

          </div>
         
          <div class="panel-body">

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Donation in the Name of <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'donation_name',

    'id'    => 'donation_name',

    'type'  => 'text',

    'placeholder'=>'',

    'class' => "form-control",

    'value' =>set_value('donation_name')));

    ?> <?php echo form_error('donation_name'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Amount <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'donation_amount',

    'id'    => 'donation_amount',

    'type'  => 'text',

    'placeholder'=>'',

    'class' => "form-control",

    'value' =>set_value('donation_amount')));

    ?> <?php echo form_error('donation_amount'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'regsubmit','id'=> 'regsubmit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Proceed Now')); ?> </div>

            </div>

            <div class="row">

            	<div class="col-md-12">

                	<p class="notetext">Note: On click proceed now you will get payment overview and payment link</p>

                </div>

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

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 

<script type="text/javascript">

$('#reg_dob').datepicker({

    dateFormat:'dd-mm-yy',

	changeYear: true,

	changeMonth: true,

	yearRange: "-50:+0",

});

</script>





</body>

</html>

