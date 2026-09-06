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
            <h3>Online Room Booking Step <span>1/2</span></h3>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <?php	foreach($roomtdata as $roomtrow){ 
$attributes=array('class' => 'regform','method'=>'post','id'=>'','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('room-booking/step1',$attributes);
echo form_hidden('rb_roomcat',$roomtrow->roomt_id);
?>
          <div class="row">
            <div class="col-md-12">
              <div class="room_box">
                <div class="row">
                  <div class="col-md-4">
                    <div class="img_room"><img src="<?php echo base_url().$roomtrow->roomt_img; ?>" class="img-responsive"/></div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="roomtype_title"><?php echo $roomtrow->roomt_title; ?> </div>
                        <div class="room_price">Rs. <?php echo $roomtrow->roomt_price ?>/- <span>(per room)</span></div>
                        <div class="room_desc"><?php echo $roomtrow->roomt_desc; ?></div>
                      </div>
                    </div>
                    
                    
                    <div class="row mbot15">
                      <div class="col-md-12 form-group">
                        <label>No. of Rooms Required <span class="req">*</span></label>
                        <select class="form-control" name="rb_norooms">
                         <!-- <option value="">--Select No. of Rooms--</option>-->
                          <?php for($room=1;$room<=1;$room++){ ?>
                          <option value="<?php echo $room; ?>" <?php echo set_select('rb_norooms',$room); ?>><?php echo $room; ?></option>
                          <?php } ?>
                        </select>
                        <?php echo form_error('rb_norooms'); ?> </div>
                    </div>
                    
                    <div class="row mbot15">
                      <div class="col-md-12 form-group">
                        <label>No. Of Pilgrims <span class="req">*</span></label>
                        <select class="form-control" name="rb_noadult">
                         
                          <?php for($adult=1;$adult<=2;$adult++){ ?>
                          <option value="<?php echo $adult; ?>" <?php echo set_select('rb_noadult',$adult); ?>><?php echo $adult; ?></option>
                          <?php } ?>
                        </select>
                        <?php echo form_error('rb_noadult'); ?> </div>
                    </div>
                    <div class="row mbot15">
                      <div class="col-md-12 form-group">
                        <label>No. of Children <span class="note">(Below 12 Years of age)</span> <span class="req">*</span></label>
                        <select class="form-control" name="rb_nochild">
                         
                          <?php for($child=0;$child<=2;$child++){ ?>
                          <option value="<?php echo $child; ?>" <?php echo set_select('rb_nochild',$child); ?>><?php echo $child; ?></option>
                          <?php } ?>
                        </select>
                        <?php echo form_error('rb_nochild'); ?> </div>
                    </div>
                    
                    <div class="row mbot15">
                      <div class="col-md-12 form-group">
                        <label>Number of Days  <span class="req">*</span></label>
                        <select class="form-control" name="rb_nodays">
                         
                          <?php for($nodays=1;$nodays<=2;$nodays++){ ?>
                          <option value="<?php echo $nodays; ?>" <?php echo set_select('rb_nodays',$nodays); ?>><?php echo $nodays; ?></option>
                          <?php } ?>
                        </select>
                        <?php echo form_error('rb_nodays'); ?> </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="btn-row"> <?php echo form_button(array( 'name'=>'submit','id'=> 'submit','value'=> 'true','class'=>'btn btn btn-room','type'=> 'submit','content' => 'Save & Next')); ?> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
          <?php } ?>
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
</body>
</html>
