<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>

<html>

<head>



<!-- Basic -->

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>

<?php if(isset($siteTitle)){ echo $siteTitle; } ?>

</title>

<meta name="keywords" content="" />

<meta name="description" content="">

<meta name="author" content="">



<!-- Favicon -->

<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

<link rel="apple-touch-icon" href="img/apple-touch-icon.png">



<!-- Mobile Metas -->

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">



<!-- Web Fonts  -->

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">



<!-- Vendor CSS -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css">



<!-- Theme CSS -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-elements.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-shop.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">



<!-- Demo CSS -->



<!-- Skin CSS -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css">



<!-- Theme Custom CSS -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">



<!-- Head Libs -->

<script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.min.js"></script>

</head>

<body>

<div class="body">

  <?php include("includes/header.php"); ?>

<div role="main" class="main">

  <div class="container">

  <div class="row">

  	<div class="col-md-12">

    	<div class="note_box">

    	<p><strong>Note:</strong> The candidate name should be filled as available on 10th/12th Examination Marksheet<br/> Please do not use any prefix suc as Mr. or Shri or Prof. or Dr. etc. in Father's Name and Mother's Name<br/>Course Name, Pool, Applicant Name, Father's Name, Mother's Name, Date of Birth, Email Id, Mobile Number once submitted cannot be changed</p>

   	</div>

    </div>

  </div>

    <div class="row">

      <div class="col-md-12">

        <?php	

$attributes=array('class' => 'regform','method'=>'post','id'=>'instAddForm','name'=>'instAddForm','autocomplete'=>'off');   

echo form_open_multipart('registration-step1',$attributes);

 ?>

        <div class="panel panel-info">

          <div class="panel-heading">

            <label>Personal Detail <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>

          </div>

          <div class="panel-body">

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Choose Course <span class="req">*</span></label>

                <select class="form-control" name="reg_course">

                  <option value="">--Select--</option>

                  <?php foreach($coursedata as $courserow){ ?>

                  <option value="<?php echo $courserow->course_id; ?>" <?php echo set_select('reg_course',$courserow->course_id); ?>><?php echo $courserow->course_name; ?> <?php if($courserow->course_duration!=""){ ?>(<?php echo $courserow->course_duration; ?>) <?php } ?></option>

                  <?php } ?>

                  

                </select>

                <?php echo form_error('reg_course'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Choose Pool <span class="req">*</span></label>

                <select class="form-control" name="reg_pool">

                  <option value="">--Select--</option>

                  <option value="UT Pool" <?php echo set_select('reg_pool',"UT Pool"); ?>>UT Pool</option>

                  <option value="All India Pool" <?php echo set_select('reg_pool',"All India Pool"); ?>>All India Pool</option>

                </select>

                <?php echo form_error('reg_pool'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>University Name <span class="note">(If you already registered with any University)</span> </label>

                <?php echo form_input(array(

    'name'=>'reg_aluniversity',

    'id'=>'reg_aluniversity',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_aluniversity')));

    ?> <?php echo form_error('reg_aluniversity'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Registration No. of University </label>

                <?php echo form_input(array(

    'name'  => 'reg_alregno',

    'id'    => 'reg_alregno',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_alregno')));

    ?> <?php echo form_error('reg_alregno'); ?> </div>

            </div>

            <div class="row">

              <div class="col-12">

                <label>Choose Category <span class="req">*</span></label>

              </div>

              <div class="col-md-12 form-group">

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','SC',set_checkbox('reg_category[]',"SC")); ?>

                  SC</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','ST',set_checkbox('reg_category[]',"ST")); ?>

                  ST</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Defence',set_checkbox('reg_category[]',"Defence")); ?>

                  Defence</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Persons with Disabilities',set_checkbox('reg_category[]',"Persons with Disabilities")); ?>

                  Persons with Disabilities</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Freedom Fighter',set_checkbox('reg_category[]',"Freedom Fighter")); ?>

                  Freedom Fighter</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Sports',set_checkbox('reg_category[]',"Sports")); ?>

                  Sports</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','NRI',set_checkbox('reg_category[]',"NRI")); ?>

                  NRI</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Kargil Martyrs',set_checkbox('reg_category[]',"Kargil Martyrs")); ?>

                  Kargil Martyrs</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Tuition Fee Waiver Scheme',set_checkbox('reg_category[]',"Tuition Fee Waiver Scheme")); ?>

                  Tuition Fee Waiver Scheme</label>

                <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','EWS (General)',set_checkbox('reg_category[]',"EWS (General)")); ?>

                  EWS (General)</label>
                  
                  <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','Kashmiri Migrant',set_checkbox('reg_category[]',"Kashmiri Migrant")); ?>

                  Kashmiri Migrant</label>
                  
                  
                   <label class="checklabel">

                  <?php  echo form_checkbox('reg_category[]','General',set_checkbox('reg_category[]',"General")); ?>

                  General</label>
                  
                  
                  	<br/>

                <?php echo form_error('reg_category[]'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Whether NSS Volunteer of Chandigarh? <span class="req">*</span></label>

                <select class="form-control" name="reg_nssvolunteer">

                  <option value="">--Select--</option>

                  <option value="No" <?php echo set_select('reg_nssvolunteer',"No"); ?>>No</option>

                  <option value="Yes" <?php echo set_select('reg_nssvolunteer',"Yes"); ?>>Yes</option>

                </select>

                <?php echo form_error('reg_nssvolunteer'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Gradation of NSS Certificate </label>

                <select class="form-control" name="reg_nssgrade">

                  <option value="">--Select--</option>

                  <option value="A" <?php echo set_select('reg_nssgrade',"A"); ?>>A</option>

                  <option value="B" <?php echo set_select('reg_nssgrade',"B"); ?>>B</option>

                  <option value="C" <?php echo set_select('reg_nssgrade',"C"); ?>>C</option>

                  <option value="Other" <?php echo set_select('reg_nssgrade',"Other"); ?>>Other</option>

                </select>

                <?php echo form_error('reg_nssgrade'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label>Name of Applicant <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_firstname',

    'id'    => 'reg_firstname',

    'type'  => 'text',

    'placeholder'=>'First Name',

    

    'class' => "form-control",

    'value' =>set_value('reg_firstname')));

    ?> <?php echo form_error('reg_firstname'); ?> </div>

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label>&nbsp;</label>

                <?php echo form_input(array(

    'name'  => 'reg_middlename',

    'id'    => 'reg_middlename',

    'type'  => 'text',

    'placeholder'=>'Middle Name',

    'class' => "form-control",

    'value' =>set_value('reg_middlename')));

    ?> <?php echo form_error('reg_middlename'); ?> </div>

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label> &nbsp;</label>

                <?php echo form_input(array(

    'name'  => 'reg_lastname',

    'id'    => 'reg_lastname',

    'type'  => 'text',

    'placeholder'=>'Last Name',

    'class' => "form-control",

    'value' =>set_value('reg_lastname')));

    ?> <?php echo form_error('reg_lastname'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Applicant's Mobile No <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_mobileno',

    'id'    => 'reg_mobileno',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_mobileno')));

    ?> <?php echo form_error('reg_mobileno'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Applicant's Email Id <span class="req">*</span></label>

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

                <label>Date of Birth <span class="req">*</span></label>

                <?php 

			

	echo form_input(array(

    'name'  => 'reg_dob',

    'id'    => 'reg_dob',

    'type'  => 'text',

    'class' => "form-control datepicker1",

    'value' =>set_value('reg_dob')));

    ?> <?php echo form_error('reg_dob'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Gender <span class="req">*</span></label>

                <select class="form-control" name="reg_gender">

                  <option value="">--Select--</option>

                  <option value="Male" <?php echo set_select('reg_gender',"Male"); ?>>Male</option>

                  <option value="Female" <?php echo set_select('reg_gender',"Female"); ?>>Female</option>

                  <option value="Transgender" <?php echo set_select('reg_gender',"Transgender"); ?>>Transgender</option>

                </select>

                <?php echo form_error('reg_gender'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label>Mother's Name <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_mothername',

    'id'    => 'reg_mothername',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_mothername')));

    ?> <?php echo form_error('reg_mothername'); ?> </div>

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label>Father's Name <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_fathername',

    'id'    => 'reg_fathername',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_fathername')));

    ?> <?php echo form_error('reg_fathername'); ?> </div>

              <div class="form-group col-md-4 col-sm-12 col-xs-12">

                <label>Father/Mother Mobile No <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_parentmobile',

    'id'    => 'reg_parentmobile',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_parentmobile')));

    ?> <?php echo form_error('reg_parentmobile'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Guardian's Name & Address <span class="note">(if father deceased)</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_guardianname',

    'id'    => 'reg_guardianname',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_guardianname')));

    ?> <?php echo form_error('reg_guardianname'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Relationship of Guardian to applicant </label>

                <?php echo form_input(array(

    'name'  => 'reg_guardian_relation',

    'id'    => 'reg_guardian_relation',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_guardian_relation')));

    ?> <?php echo form_error('reg_guardian_relation'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>School/College Last attended <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_lastsc',

    'id'    => 'reg_lastsc',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_lastsc')));

    ?> <?php echo form_error('reg_lastsc'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Date of Leaving <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_leavingdate',

    'id'    => 'datepicker',

    'type'  => 'text',

    'class' => "form-control datepicker",

    'value' =>set_value('reg_leavingdate')));

    ?> <?php echo form_error('reg_leavingdate'); ?> </div>

            </div>

          </div>

        </div>

        <div class="panel panel-info">

          <div class="panel-heading">

            <label>Permanent Address </label>

          </div>

          <div class="panel-body">

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Address Line 1 <span class="req">*</span> </label>

                <?php echo form_input(array(

    'name'=>'reg_perma_address1',

    'id'=>'reg_perma_address1',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_perma_address1')));

    ?> <?php echo form_error('reg_perma_address1'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Address Line 2 </label>

                <?php echo form_input(array(

    'name'  => 'reg_perma_address2',

    'id'    => 'reg_perma_address2',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_perma_address2')));

    ?> <?php echo form_error('reg_perma_address2'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Country <span class="req">*</span></label>

                <select class="form-control reg_perma_country" name="reg_perma_country">

                  <option value="">--Select--</option>

                  <?php foreach($countrydata as $countryrow){ ?>

                  <option value="<?php echo $countryrow->country_name; ?>" <?php echo set_select('reg_perma_country',$countryrow->country_name); ?>><?php echo $countryrow->country_name; ?></option>

                  <?php } ?>

                </select>

                <?php echo form_error('reg_perma_country'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12 perma_stateindia">

                <label>State <span class="req">*</span></label>

                <select class="form-control" name="reg_perma_state">

                  <option value="">--Select--</option>

                  <?php foreach($statedata as $staterow){ ?>

                  <option value="<?php echo $staterow->state_name; ?>" <?php echo set_select('reg_perma_state',$staterow->state_name); ?>><?php echo $staterow->state_name; ?></option>

                  <?php } ?>

                </select>

                <?php echo form_error('reg_perma_state'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12 perma_stateother">

                <label>State <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_perma_stateother',

    'id'    => 'reg_perma_stateother',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_perma_stateother')));

    ?> <?php echo form_error('reg_perma_stateother'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>City <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_perma_city',

    'id'    => 'reg_perma_city',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_perma_city')));

    ?> <?php echo form_error('reg_perma_city'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Pincode <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_perma_pincode',

    'id'    => 'reg_perma_pincode',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_perma_pincode')));

    ?> <?php echo form_error('reg_perma_pincode'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Correspondence Address Same As Permanent <span class="req">*</span></label>

                <select class="form-control reg_addresssame" name="reg_addresssame">

                  <option value="No" <?php echo set_select('reg_addresssame',"No"); ?>>No</option>

                  <option value="Yes" <?php echo set_select('reg_addresssame',"Yes"); ?>>Yes</option>

                </select>

                <?php echo form_error('reg_addresssame'); ?> </div>

            </div>

          </div>

        </div>

        <div class="panel panel-info corres-address">

          <div class="panel-heading">

            <label>Correspondence  Address </label>

          </div>

          <div class="panel-body">

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Address Line 1 <span class="req">*</span> </label>

                <?php echo form_input(array(

    'name'=>'reg_corres_address1',

    'id'=>'reg_corres_address1',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_corres_address1')));

    ?> <?php echo form_error('reg_corres_address1'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Address Line 2 </label>

                <?php echo form_input(array(

    'name'  => 'reg_corres_address2',

    'id'    => 'reg_corres_address2',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_corres_address2')));

    ?> <?php echo form_error('reg_corres_address2'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Country <span class="req">*</span></label>

                <select class="form-control reg_corres_country" name="reg_corres_country">

                  <option value="">--Select--</option>

                  <?php foreach($countrydata as $countryrow){ ?>

                  <option value="<?php echo $countryrow->country_name; ?>" <?php echo set_select('reg_corres_country',$countryrow->country_name); ?>><?php echo $countryrow->country_name; ?></option>

                  <?php } ?>

                </select>

                <?php echo form_error('reg_corres_country'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12 corres_stateindia">

                <label>State <span class="req">*</span></label>

                <select class="form-control" name="reg_corres_state">

                  <option value="">--Select--</option>

                  <?php foreach($statedata as $staterow){ ?>

                  <option value="<?php echo $staterow->state_name; ?>" <?php echo set_select('reg_corres_state',$staterow->state_name); ?>><?php echo $staterow->state_name; ?></option>

                  <?php } ?>

                </select>

                <?php echo form_error('reg_corres_state'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12 corres_stateother">

                <label>State <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_corres_stateother',

    'id'    => 'reg_corres_stateother',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_corres_stateother')));

    ?> <?php echo form_error('reg_corres_stateother'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>City <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_corres_city',

    'id'    => 'reg_corres_city',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_corres_city')));

    ?> <?php echo form_error('reg_corres_city'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Pincode <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_corres_pincode',

    'id'    => 'reg_corres_pincode',

    'type'  => 'text',

    'class' => "form-control",

    'value' =>set_value('reg_corres_pincode')));

    ?> <?php echo form_error('reg_corres_pincode'); ?> </div>

            </div>

          </div>

        </div>

        <div class="panel panel-info">

          <div class="panel-heading">

            <label>Login Detail </label>

          </div>

          <div class="panel-body">

            <div class="row">

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Password <span class="note">(This password will used for all future login)</span> <span class="req">*</span> </label>

                <?php echo form_input(array(

    'name'=>'reg_password',

    'id'=>'reg_password',

    'type'  => 'password',

    'class' => "form-control",

    'value' =>set_value('reg_password')));

    ?> <?php echo form_error('reg_password'); ?> </div>

              <div class="form-group col-md-6 col-sm-12 col-xs-12">

                <label>Confirm Password <span class="req">*</span></label>

                <?php echo form_input(array(

    'name'  => 'reg_conpassword',

    'id'    => 'reg_conpassword',

    'type'  => 'password',

    'class' => "form-control",

    'value' =>set_value('reg_conpassword')));

    ?> <?php echo form_error('reg_conpassword'); ?> </div>

            </div>

            <div class="row">

              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'regsubmit','id'=> 'regsubmit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Submit')); ?> </div>

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

toggleFields1();

toggleFields2();

$(".reg_perma_country").change(function() { toggleFields(); });

$(".reg_corres_country").change(function() { toggleFields1(); });

$(".reg_addresssame").change(function() { toggleFields2(); });

});



function toggleFields(){

 if($(".reg_perma_country").val()=="India"){ 

               $('.perma_stateother').hide(); 

                $('.perma_stateindia').show(); 

        }else{

                $('.perma_stateother').show(); 

                $('.perma_stateindia').hide(); 



         }

}

function toggleFields1(){

 if($(".reg_corres_country").val()=="India"){ 

               $('.corres_stateother').hide(); 

                $('.corres_stateindia').show(); 

        }else{

                $('.corres_stateother').show(); 

                $('.corres_stateindia').hide(); 



         }

}

function toggleFields2(){

 	if($(".reg_addresssame").val()=="No"){ 

           $('.corres-address').show(); 

        }else if($(".reg_addresssame").val()=="Yes"){

           $('.corres-address').hide(); 

        }else{

			$('.corres-address').show(); 

		}

}

</script> 

<script type="text/javascript">

$('.datepicker').datepicker({

    dateFormat:'dd-mm-yy',

	changeYear: true,

	changeMonth: true,

	yearRange: "-50:+0",

});



$('.datepicker1').datepicker({

    dateFormat:'dd-mm-yy',

	changeYear: true,

	changeMonth: true,

	yearRange: "-50:+0",

});

</script>

</body>

</html>

