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
<style type="text/css">
.rowhead{background:#a3070a; color:#fff; padding:5px 10px; margin-bottom:10px; margin-top:5px; text-transform:uppercase; font-weight:600;}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.mb30{margin-bottom:30px;}
.otp_msg{background:#deefd8; padding:10px; margin-bottom:20px;}
.otp_msg p{color:#329144; margin:0px; }
</style>

</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="e-page-title">
            <h3>Bhog Booking</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-2">
    <?php 
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart("online-bhog-booking/verify-otp/$segment3",$attributes);
echo form_hidden('encbid',$segment3);
 ?>     
          <div class="panel panel-info">
          
            
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-12"><h4 class="text-center">For Security, Please Identify Yourself</h4> </div>
                </div>
              <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
            <div class="row">
              <div class="col-md-12">
                <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
              </div>
            </div>
            <?php  } ?>
                
                
                
                <div class="row">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <label>Mobile Number <span class="req">*</span></label>
                  <?php echo  form_input(array(
    'name'  => 'cb_otpmobile',
    'id'    => 'cb_otpmobile',
    'type'  => 'text',
    'readonly'=>true,
    'class' => "form-control",
    'value' =>set_value('cb_otpmobile',$bhogtemp->cb_mobile)));
    ?> 
  
  
  
  <?php echo form_error('cb_otpmobile'); ?>
                    </div>
                </div>
              <div class="row">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <label>Enter OTP <span class="req">*</span></label>
                  <?php echo  form_input(array(
    'name'  => 'cb_bhog_otp',
    'id'    => 'cb_bhog_otp',
    'type'  => 'text',
    'maxlength'=>6,
    'class' => "form-control",
    'value' =>set_value('cb_bhog_otp')));
    ?> 
  
  
  
  <?php echo form_error('cb_bhog_otp'); ?>
                    </div>
                </div>  
                  
              <div class="row">
              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'verifyotp_btn','id'=> 'verifyotp_btn','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Submit')); ?> 
              
              
              <?php echo form_button(array( 'name'=>'resendotp','id'=> 'resendotp','value'=> 'true','class'=>'btn btn_custom_y2 btn-secondary','type'=> 'submit','content' => 'Resend OTP')); ?> 
              
              </div>
              </div>
              <div class="row">
                <div class="col-md-12">
<!--                  <p class="notetext">Note: On click proceed now you will get payment overview and payment link</p>
-->                </div>
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
$(document).ready(function() {
toggleFields();
$(".cb_othermember").change(function() { toggleFields(); });
});

 function toggleFields(){
 if($(".cb_othermember").val()=="Yes"){
                $('.othermember').show();
        }else{
                $('.othermember').hide();

         }

 }
</script> 
<script type="text/javascript">
<?php
$date_booked=""; 
$count_booked=count($bhog_datebooked);

if($count_booked>0){
  $sr=1;
  foreach($bhog_datebooked as $bhogrow){
      $date_book='"'.$bhogrow->cb_bookfordate.'"';
      if($sr==1){
        $date_booked=$date_book;  
      }else{
        $date_booked=$date_booked.",".$date_book;
      }
    
  $sr++;
  }
}

$count_inactive=count($bhog_inactivedate);
if($count_inactive>0){
  $in_sr=1;
  foreach($bhog_inactivedate as $bhog_inactiverow){
    $date_book='"'.$bhog_inactiverow->dset_date.'"';
    if($in_sr==1){
      if(empty($date_booked)){
        $date_booked=$date_book;
      }else{
        $date_booked=$date_booked.",".$date_book;
      }
    }else{
      $date_booked=$date_booked.",".$date_book;   
    }
    $in_sr++; 
  }
}
$count_process=count($bhog_processdate);
if($count_process>0){
  $cp_sr=1;
  foreach($bhog_processdate as $bhog_processrow){
    $date_book='"'.$bhog_processrow->cb_bookfordate.'"';
    if($cp_sr==1){
      if(empty($date_booked)){
        $date_booked=$date_book;
      }else{
        $date_booked=$date_booked.",".$date_book;
      }
    }else{
      $date_booked=$date_booked.",".$date_book;   
    }
    $cp_sr++; 
  } 
}
 ?>
 
var array = [<?php echo $date_booked; ?>]
$('#cb_bookfordate').datepicker({
  minDate: 0,  
  maxDate: "+3M",
  dateFormat:'dd-mm-yy',
    beforeShowDay: function(date){
      var d = new Date();
      console.log(date);
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});

</script>

</body>
</html>