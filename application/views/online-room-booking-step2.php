<?php defined('BASEPATH') OR exit('No direct script access allowed');
$segment3=$this->uri->segment(3);
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php if(isset($siteTitle)){ echo $siteTitle; } ?></title>

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
            <h3>Online Room Booking Step <span>2/2</span></h3>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
		<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart("room-booking/step2/$segment3",$attributes);
echo form_hidden('enc_rbid',$segment3);
 ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
              	<div class="col-md-12">
               	 	<div class="totamt_overview"><span><strong>Rental Amount:</strong></span> Rs. <?php echo number_format($rental_amt,2); ?>  </div>
                </div>
                <div class="col-md-12">
               	 	<div class="totamt_overview"><span><strong>Extra Person Charges:</strong></span> Rs. <?php echo number_format($extraperson_charges,2); ?>  </div>
                </div>
                <div class="col-md-12">
               	 	<div class="totamt_overview"><span><strong>Total Amount:</strong></span> Rs. <?php echo number_format($total_amt,2); ?>  </div>
                </div>
              </div>
              
              <div class="row">
            	<div class="col-md-12"><div class="haddress">Booking Detail</div></div>
            </div>
            
            <div class="row">
            	<div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <label>Room Type <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_roomtype',
    'id'    => 'rb_roomtype',
    'type'  => 'text',
    'readonly'=>true,
    'class' => "form-control",
    'value' =>set_value('rb_roomtype',$roomdata->roomt_title)));
    ?> <?php echo form_error('rb_roomtype'); ?> </div>
    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                 <label>No. of Rooms <span class="req">*</span></label>
      <?php echo form_input(array(
    'name'  => 'rb_norooms',
    'id'    => 'rb_norooms',
    'type'  => 'text',
    'readonly'=>true,
    'class' => "form-control",
    'value' =>set_value('rb_norooms',$rb_norooms)));
    ?> <?php echo form_error('rb_norooms'); ?>
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                 <label>No. of Days <span class="req">*</span></label>
      <?php echo form_input(array(
    'name'  => 'rb_nodays',
    'id'    => 'rb_nodays',
    'type'  => 'text',
    'readonly'=>true,
    'class' => "form-control",
    'value' =>set_value('rb_nodays',$rb_nodays)));
    ?> <?php echo form_error('rb_nodays'); ?>
                </div>
            </div>
            
             <div class="row">
            	<div class="col-md-12"><div class="haddress">General Information</div></div>
            </div>
            
            <div class="row">
            	<div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Check-in Date (dd-mm-yyyy) <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_date',
    'id'    => 'rb_date',
    'type'  => 'text',
    'maxlength'  => 10,
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_date')));
    ?> <?php echo form_error('rb_date'); ?> </div>
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                 <label>Full Name <span class="req">*</span></label>
      <?php
	  $name="";
	  if($regdata->reg_lastname!=""){
		$name=$regdata->reg_firstname." ".$regdata->reg_lastname;
	  }else{
		  $name=$regdata->reg_firstname;
	  }
	  
	   echo form_input(array(
    'name'  => 'rb_name',
    'id'    => 'rb_name',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_name',$name)));
    ?> <?php echo form_error('rb_name'); ?>
                </div>
            </div>
            <div class="row">
            	<div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Mobile Number <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_mobile',
    'id'    => 'rb_mobile',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_mobile',$regdata->reg_mobileno)));
    ?> <?php echo form_error('rb_mobile'); ?> </div>
    
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Email Id <span class="note">(optional)</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_email',
    'id'    => 'rb_email',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_email',$regdata->reg_email)));
    ?> <?php echo form_error('rb_email'); ?> </div>
            
            </div>	
              
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>ID Type <span class="req">*</span></label>
                  <select class="form-control" name="rb_idtype">
                  	<option value="">--Select--</option>
                    <?php foreach($doctypedata as $doctyperow){ ?>
<option value="<?php echo $doctyperow->rbdocument_id; ?>" <?php echo set_select('rb_idtype',$doctyperow->rbdocument_id); ?>><?php echo $doctyperow->rbdocument_title; ?></option>
					<?php } ?>

                  </select>
                 <?php echo form_error('rb_idtype'); ?> </div>
                 
                 
                 <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>ID Proof Number <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_idproofno',
    'id'    => 'rb_idproofno',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_idproofno')));
    ?>
                 <?php echo form_error('rb_idproofno'); ?> </div>
            
            
            </div>
            <div class="row">
            	<div class="col-md-12"><div class="haddress">Address</div></div>
            </div>
            
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>Address Line 1 <span class="req">*</span> </label>
            <?php echo form_input(array(
            
            'name'=>'rb_address_line1',
            
            'id'=>'rb_address_line1',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('rb_address_line1',$regdata->reg_address_line1)));
            
            ?> <?php echo form_error('rb_address_line1'); ?> </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>Address Line 2 </label>
            <?php echo form_input(array(
            
            'name'  => 'rb_address_line2',
            
            'id'    => 'rb_address_line2',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('rb_address_line2',$regdata->reg_address_line2)));
            
            ?> <?php echo form_error('rb_address_line2'); ?> </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>City <span class="req">*</span></label>
            <?php echo form_input(array(
            
            'name'  => 'rb_city',
            
            'id'    => 'rb_city',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('rb_city',$regdata->reg_city)));
            
            ?> <?php echo form_error('rb_city'); ?> </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>State <span class="req">*</span></label>
            <select class="form-control" name="rb_state">
            <option value="">--Select--</option>
            <?php foreach($statedata as $staterow){ ?>
            <option value="<?php echo $staterow->state_name; ?>" <?php echo set_select('rb_state',$staterow->state_name,$regdata->reg_state==$staterow->state_name); ?>><?php echo $staterow->state_name; ?></option>
            <?php } ?>
            </select>
            <?php echo form_error('rb_state'); ?> </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>Pincode <span class="req">*</span></label>
            <?php echo form_input(array(
            
            'name'  => 'rb_pincode',
            
            'id'    => 'rb_pincode',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('rb_pincode',$regdata->reg_pincode)));
            
            ?> <?php echo form_error('rb_pincode'); ?> </div>
            </div>
            
              <div class="row">
                <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'hwsubmit','id'=> 'submit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Continue')); ?> </div>
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
<?php
$roomt_total=$roomdata->roomt_total;
$date_booked=""; 
if(count($rb_datedata)>0){
foreach($rb_datedata as $rb_daterow){
	$success=0;
	$inprocess=0;
	$total_booked=0;
	$date_book='"'.$rb_daterow->rb_bookfordate.'"';
	$success=$this->customcode->getAllSuccessRoomBooking($rb_daterow->rb_bookfordate);
	$inprocess=$this->customcode->getAllInProcessRoomBooking($rb_daterow->rb_bookfordate);
	$total_booked=$success+$inprocess;
	if($total_booked>=$roomt_total){
		if(empty($date_booked)){
				$date_booked=$date_book;
		}else{
				$date_booked=$date_booked.",".$date_book;
		}
		
	}
}
}





$count_inactive=count($rb_inactivedate);
if($count_inactive>0){
	$in_sr=1;
	foreach($rb_inactivedate as $rb_inactiverow){
		$date_book='"'.$rb_inactiverow->dset_date.'"';
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
<!-- Vendor --> 
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/popper/umd/popper.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/theme.init.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script> 
<script type="text/javascript">

var array = [<?php echo $date_booked; ?>]
$('#rb_date').datepicker({
	minDate: 1,
	maxDate: "+3D",
	dateFormat:'dd-mm-yy',
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
</script>
</body>
</html>
