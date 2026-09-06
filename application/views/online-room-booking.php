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
</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="e-page-title">
            <h3 style="text-align:left;">Terms and Conditions for booking accommodation of Lajwanti Guest House and Laxmi Bhawan Dharamshala.</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="ul_list">
            <li>For booking  identity proof i.e. Aadhar card, voter card, PAN  card, Passport,  etc. needs to be uploaded, which will also be required to be shown in original, at the time of admission for verification.</li>
  <li>Check out time is 11 am and Check in time is 12 noon.</li>
  <li>Right of admission is reserved.</li>
  <li>The security amount of AC room is Rs. 1000/- and that of Non-AC is Rs. 500/- which will be required to be deposited at the time of Check-in. The security amount will be refunded at time of vacation of room, subject to the certification by the attendant.</li>
  <li>The reservation will be done on first come first serve basis and is non-transferrable.</li>
  <li>Booking once confirmed will not be cancelled.</li>
  <li>Tariff of A.C. room is Rs. 600/- per day and Non-AC room is Rs. 300/- per day.</li>
  <li>For booking confirmation 100% advance deposit is required to be deposited online.</li>
  <li>Booking can be done one room at a time for maximum upto 2 days.</li>
  <li>Only two adults can stay in a room, two children below 12 years of age can also stay with their parents by paying 25% extra charges.</li>
  <li>Booking will not be valid for marriage and political programmes.</li>
  <li>Cooking of food and washing of clothes is not allowed in Dharamshala/Guest House premises.</li>
    <li>Entry of any kind of pets etc. is prohibited and in such cases booking will be cancelled and deposited amount will be forfeited.</li>
    <li>Any Dispute arisen will be under the jurisdiction of District Court Panchkula.</li>
    <li>Occupants are required to take care of their belongings themselves. Board will not be responsible/answerable for any theft or so.</li>
    <li>Confirmed booking can be cancelled and accommodation can be got vacated in exceptional circumstances. In such circumstances, full amount deposited will be refunded.</li>
    <li>Board Management reserves the right to make any amendment/change in the terms and conditions, any time without assigning any reason.</li>
    <li>Loss or damage to the property of the Board will be borne by the occupant. Board management reserves the right to cancel advance booking in case of any exceptions and unavoidable circumstances.</li>
          </ul>
        </div>
      </div>
       <?php $attributes = array('class'=>'common-form-inner','method'=>'post','autocomplete'=>'off');  
          		echo form_open_multipart("room-booking",$attributes);
				?>
      <div class="row">
      	<div class="col-md-12 form-group"> <?php  echo form_checkbox('rb_tc',1,set_checkbox('rb_tc',1)); ?>  <strong>I have read and agree to the Terms and Conditions</strong>
        
        <br>
<?php echo form_error('rb_tc'); ?>
        </div>
        
      </div>
     
      <div class="row">
      	<div class="col-md-12 form-group">
        	 <div class="btn-row"> <?php echo form_button(array( 'name'=>'submit','id'=> 'submit','value'=> 'true','class'=>'btn btn btn-room','type'=> 'submit','content' => 'Proceed Now')); ?> </div>
        </div>
        
      </div>
      <?php echo form_close(); ?>
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
</body>
</html>
