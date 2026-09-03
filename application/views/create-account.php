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
<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.min.js"></script><!-- Global site tag (gtag.js) - Google Analytics -->
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
            <h3>Devotee Registration</h3>
            <p><a href="<?php echo site_url("login");  ?>" class="back_login1">&raquo; Back to Login Page</a></p>	
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'instAddForm','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('create-account',$attributes);
 ?>  <div class="panel panel-info">
            <div class="panel-heading">
              <label>Personal Detail <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>First Name <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'reg_firstname',
    'id'    => 'reg_firstname',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('reg_firstname')));
    ?> <?php echo form_error('reg_firstname'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Last Name <span class="req">*</span></label>
    <?php echo form_input(array(
    'name'  => 'reg_lastname',
    'id'    => 'reg_lastname',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('reg_lastname')));
    ?> <?php echo form_error('reg_lastname'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Mobile No <span class="req">*</span></label>
                  <?php echo form_input(array(

    'name'  => 'reg_mobileno',

    'id'    => 'reg_mobileno',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_mobileno')));

    ?> <?php echo form_error('reg_mobileno'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Email Id <span class="req">*</span></label>
                  <?php echo form_input(array(

    'name'  => 'reg_email',

    'id'    => 'reg_email',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_email')));

    ?> <?php echo form_error('reg_email'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Date of Birth <span class="note">(dd/mm/yyyy)</span><span class="req">*</span></label>
                  <?php echo form_input(array(

    'name'  => 'reg_dob',

    'id'    => 'reg_dob',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_dob')));

    ?> <?php echo form_error('reg_dob'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Gender <span class="req">*</span></label>
                  <select class="form-control" name="reg_gender">
                    <option value="">--Select--</option>
                    <option value="Male" <?php echo set_select('reg_gender',"Male"); ?>>Male</option>
                    <option value="Female" <?php echo set_select('reg_gender',"Female"); ?>>Female</option>
                  </select>
                  <?php echo form_error('reg_gender'); ?> </div>
              </div>
            </div>
          </div>
          <div class="panel panel-info corres-address">
            <div class="panel-heading">
              <label>Residential Address </label>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Address Line 1 <span class="req">*</span> </label>
                  <?php echo form_input(array(

    'name'=>'reg_address_line1',

    'id'=>'reg_address_line1',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_address_line1')));

    ?> <?php echo form_error('reg_address_line1'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Address Line 2 </label>
                  <?php echo form_input(array(

    'name'  => 'reg_address_line2',

    'id'    => 'reg_address_line2',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_address_line2')));

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

    'value' =>set_value('reg_city')));

    ?> <?php echo form_error('reg_city'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>State <span class="req">*</span></label>
                  <select class="form-control" name="reg_state">
                    <option value="">--Select--</option>
                    <?php foreach($statedata as $staterow){ ?>
                    <option value="<?php echo $staterow->state_name; ?>" <?php echo set_select('reg_state',$staterow->state_name); ?>><?php echo $staterow->state_name; ?></option>
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

    'value' =>set_value('reg_pincode')));

    ?> <?php echo form_error('reg_pincode'); ?> </div>
              </div>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <label>Login Detail <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Create Login Id <span class="req">*</span></label>
                  <?php echo form_input(array(

    'name'  => 'reg_loginid',

    'id'    => 'reg_loginid',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_loginid')));

    ?> <?php echo form_error('reg_loginid'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Create Password <span class="req">*</span></label>
                  <?php echo form_input(array(

    'name'  => 'reg_password',

    'id'    => 'reg_password',

    'type'  => 'password',

    'class' => "form-control",

    'value' =>set_value('reg_password')));

    ?> <?php echo form_error('reg_password'); ?> </div>
              </div>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-body">
              <div class="row">
                <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'regsubmit','id'=> 'regsubmit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Register')); ?> </div>
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
	yearRange: "-100:+0",

});

</script>
</body>
</html>
