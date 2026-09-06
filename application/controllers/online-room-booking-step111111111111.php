<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
            <h3>Online Room Booking Step <span>1/2</span></h3>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
		<?php	
		print_r($regdata);
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('room-booking',$attributes);
 ?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
            	<div class="col-md-12"><div class="haddress">Booking Detail</div></div>
            </div>
            <div class="row">
            	<div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Room Type <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_roomtype',
    'id'    => 'rb_roomtype',
    'type'  => 'text',
    'readonly'=>true,
    'class' => "form-control",
    'value' =>set_value('rb_roomtype',$roomdata->roomt_title)));
    ?> <?php echo form_error('rb_roomtype'); ?> </div>
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
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
            </div>
            
             <div class="row">
            	<div class="col-md-12"><div class="haddress">General Information</div></div>
            </div>
            
            <div class="row">
            	<div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Reservation Date <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_date',
    'id'    => 'rb_date',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_date')));
    ?> <?php echo form_error('rb_date'); ?> </div>
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                 <label>Full Name <span class="req">*</span></label>
      <?php echo form_input(array(
    'name'  => 'rb_name',
    'id'    => 'rb_name',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_name',$regdata->rb_name)));
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
    'value' =>set_value('rb_mobile',$regdata->rb_mobile)));
    ?> <?php echo form_error('rb_mobile'); ?> </div>
    
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Email Id <span class="note">(optional)</span></label>
                  <?php echo form_input(array(
    'name'  => 'rb_email',
    'id'    => 'rb_email',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('rb_email',$regdata->rb_email)));
    ?> <?php echo form_error('rb_email'); ?> </div>
            
            </div>	
              
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>ID Type <span class="req">*</span></label>
                  <select class="form-control" name="rb_idtype">
                  	<option value="">--Select--</option>
<option value="Aadhaar Card" <?php echo set_select('rb_idtype',"Aadhaar Card"); ?>>Aadhaar Card</option>
<option value="Voter ID Card" <?php echo set_select('rb_idtype',"Voter ID Card"); ?>>Voter ID Card</option>
<option value="Ration Card" <?php echo set_select('rb_idtype',"Ration Card"); ?>>Ration Card</option>
<option value="Driving Licence" <?php echo set_select('rb_idtype',"Driving Licence"); ?>>Driving Licence</option>
<option value="Passport" <?php echo set_select('rb_idtype',"Passport"); ?>>Passport</option>

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
            
            'name'=>'reg_address_line1',
            
            'id'=>'reg_address_line1',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('reg_address_line1',$regdata->reg_address_line1)));
            
            ?> <?php echo form_error('reg_address_line1'); ?> </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>Address Line 2 </label>
            <?php echo form_input(array(
            
            'name'  => 'reg_address_line2',
            
            'id'    => 'reg_address_line2',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('reg_address_line2',$regdata->reg_address_line2)));
            
            ?> <?php echo form_error('reg_address_line2'); ?> </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>City <span class="req">*</span></label>
            <?php echo form_input(array(
            
            'name'  => 'reg_city',
            
            'id'    => 'reg_city',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('reg_city',$regdata->reg_city)));
            
            ?> <?php echo form_error('reg_city'); ?> </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>State <span class="req">*</span></label>
            <select class="form-control" name="reg_state">
            <option value="">--Select--</option>
            <?php foreach($statedata as $staterow){ ?>
            <option value="<?php echo $staterow->state_name; ?>" <?php echo set_select('reg_state',$staterow->state_name,$regdata->reg_state==$staterow->state_name); ?>><?php echo $staterow->state_name; ?></option>
            <?php } ?>
            </select>
            <?php echo form_error('reg_state'); ?> </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <label>Pincode <span class="req">*</span></label>
            <?php echo form_input(array(
            
            'name'  => 'reg_pincode',
            
            'id'    => 'reg_pincode',
            
            'type'  => 'text',
            
            'class' => "form-control",
            
            'value' =>set_value('reg_pincode',$regdata->reg_pincode)));
            
            ?> <?php echo form_error('reg_pincode'); ?> </div>
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
$count_booked=count($rb_datebook);
if($count_booked>0){
	$sr=1;
	foreach($rb_datebook as $rb_daterow){
			$date_book='"'.$rb_daterow->rb_bookfordate.'"';
			$no_rooms=$rb_daterow->roomssum;
			
			if($no_rooms>=15){
				if($sr==1){
					$date_booked=$date_book;	
				}else{
					$date_booked=$date_booked.",".$date_book;
				}
				$sr++;
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
var array = [<?php echo $date_booked; ?>]
$('#rb_date').datepicker({
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
