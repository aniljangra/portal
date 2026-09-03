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
            <h3>Online Hawan Booking Step <span>1/3</span></h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3">
		<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('hawan-booking',$attributes);
 ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label>Date <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'hw_date',
    'id'    => 'hw_date',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('hw_date')));
    ?> <?php echo form_error('hw_date'); ?> </div>
                
              </div>
              <div class="row">
                <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'hwsubmit','id'=> 'submit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Find Time Slots')); ?> </div>
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
<?php
$date_booked=""; 
$count_booked=count($hw_datebook);
if($count_booked>0){
	$sr=1;
	foreach($hw_datebook as $hw_bookrow){
			$date_book='"'.$hw_bookrow->hw_bookfordate.'"';
			$no_slot=$hw_bookrow->total_slotbook;
			if($no_slot>=3){
				if($sr==1){
					$date_booked=$date_book;	
				}else{
					$date_booked=$date_booked.",".$date_book;
				}
				$sr++;
			}
		
	
	}
}
$count_inactive=count($hw_inactivedate);
if($count_inactive>0){
	$in_sr=1;
	foreach($hw_inactivedate as $hw_inactiverow){
		$date_book='"'.$hw_inactiverow->dset_date.'"';
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
/*$count_process=count($hw_processdate);
if($count_process>0){
	$cp_sr=1;
	foreach($hw_processdate as $hw_processrow){
		$date_book='"'.$hw_processrow->hw_bookfordate.'"';
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
}*/
 ?>
 
var array = [<?php echo $date_booked; ?>]
$('#hw_date').datepicker({
	minDate: 0,
	maxDate: "+3M",
	dateFormat:'dd-mm-yy',
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
</script>

</body>
</html>
