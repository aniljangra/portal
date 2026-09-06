<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
<?php if(isset($siteTitle)){ echo $siteTitle; } ?>
</title>
<?php include("includes/style-header.php"); ?>
</head>
<body id="page-top">
<div id="wrapper">
  <?php include("includes/sidebar.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
    <?php include("includes/top-nav.php"); ?>
  
      
      <div class="container-fluid"> 
        
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Edit Admin Profile</h1>
          <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--> 
        </div>
        <!-- Content Row -->
       <div class="row"> 
          
          <div class="col-xl-12 col-md-12 mb-4">
          	<div class="form-page">
            <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="col-md-12">
                <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
              </div>
              <?php  } ?>
            
          <?php 
		  $attributes = array('class' =>'ad-profile form-horizontal','method'=>'post','autocomplete'=>'off');   
          	echo form_open_multipart('master/profile',$attributes);
			echo form_hidden('oldemail',$admdata->ad_email);
			echo form_hidden('oldpass',$admdata->ad_password);
 			 ?>
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>First Name</label>
                    <?php echo form_input(array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('first_name',$admdata->ad_firstName,FALSE)));
				?> <?php echo form_error('first_name'); ?> </div>
                  <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>Last Name</label>
                    <?php echo form_input(array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('last_name',$admdata->ad_lastName,FALSE)));
				?> <?php echo form_error('last_name'); ?> </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>Email ID</label>
                    <?php echo form_input(array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('email',$admdata->ad_email,FALSE)));
				?> <?php echo form_error('email'); ?> </div>
                  <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>Mobile Number</label>
                    <?php echo form_input(array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('phone',$admdata->ad_mobileNumber,FALSE)));
				?> <?php echo form_error('phone'); ?></div>
                </div>
                <div class="row">
                 <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>Username</label>
                    <?php echo form_input(array(
				'name'  => 'username',
				'id'    => 'username',
				'type'  => 'text',
				'readonly'  => true,
				'class' => "form-control",
				'value' =>set_value('username',$admdata->ad_username)));
				?> <?php echo form_error('phone'); ?></div>
            
                  <div class="form-group col-md-6 col-sm-12 col-xs-12">
                    <label>Password <span class="note">(Leave blank if not changing password)</span></label>
                 <?php echo form_input(array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'class' => "form-control",
				'value' =>set_value('password')));
				?>
               <?php 
				echo form_hidden('oldpassword');
				?>
                    <?php echo form_error('password'); ?> </div>
                </div>
                
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12 col-xs-12"> <?php echo form_button(array( 'name'=>'submit_admin','id'=> 'submit_admin','value'=> 'true','class'=>'btn btn-primary','type'=> 'submit',
        'content' => 'Submit')); ?> </div>
                </div>
              </div>
              <?php echo form_close();?>
              </div>
     
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </div>
</div>
	</div>
<?php include("includes/common-footer.php"); ?>
<?php include("includes/style-footer.php"); ?>
</body>
</html>
