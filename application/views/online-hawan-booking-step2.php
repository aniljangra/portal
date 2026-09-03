<?php defined('BASEPATH') OR exit('No direct script access allowed');
$hw_date=$this->session->userdata['hw_date'];
if(empty($hw_date)){
		
}
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
            <h3>Online Hawan Booking <span>Step 2/3</span></h3>
          </div>
        </div>
      </div>
      <div class="col-md-row">
      	<div class="page_date_title">Your are booking hawan for  Date: <?php  echo $hw_date; ?> </div>
      </div>
      <div class="row">
        <div class="col-md-12">
		<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('hawan-booking/time-slots',$attributes);
 ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label>Choose Time Slot <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
            <?php 
			$hw_date_ymd=date('Y-m-d',strtotime($hw_date));
			foreach($hawanslotdata as $hawanslotrow){
					$slot_id=$hawanslotrow->hs_id;
					$total_book_slot=0;
					$success_total=0;
					$process_total=0;
					$success_total=$this->customcode->getPerDateSlotSuccess($hw_date_ymd,$slot_id);
					$process_total=$this->customcode->getPerDateSlotProcess($hw_date_ymd,$slot_id);
					$total_book_slot=$success_total+$process_total;
					if($total_book_slot==0){
						
					
				  ?>	
              <div class="row">
             	   	<div class="col-md-12">
                    <label class="slot-label">
                    	<input type="radio" name="hw_bookslot" class="" value="<?php echo $hawanslotrow->hs_id;  ?>" <?php if(set_value('hw_bookslot')==$hawanslotrow->hs_id){ echo "checked";}; ?>/> <?php echo $hawanslotrow->hs_title;  ?></label>
                    </div>
              </div>
             <?php  }else{ ?>
				  <div class="row">
             	   	<div class="col-md-12">
                    <label class="slot-label slot-disable"> <?php echo $hawanslotrow->hs_title;  ?></label>
                    </div>
              </div>
				 
			 <?php }
			 }
			 ?>
             <div class="row">
             	<div class="col-md-12"><?php echo form_error('hw_bookslot'); ?></div>
             </div>
              <div class="row">
                <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'hwsubmit','id'=> 'submit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Proceed')); ?>  <?php echo form_button(array( 'name'=>'hw_back','id'=> 'hw_back','value'=> 'true','class'=>'btn btn_back btn-primary','type'=> 'submit','content' => 'Back')); ?> </div>
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
/*$count_booked=count($hw_datebooked);
if($count_booked>0){
	$sr=1;
	foreach($hw_datebooked as $dbrow){
			$date_book='"'.$dbrow->hw_bookfordate.'"';
			if($sr==1){
				$date_booked=$date_book;	
			}else{
				$date_booked=$date_booked.",".$date_book;
			}
		
	$sr++;
	}
}*/
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
