<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
  <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
            <div class="row">
              <div class="col-md-12">
                <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
              </div>
            </div>
            <?php  } ?>
  
    <div class="row">
      <div class="col-md-12">
      <?php if($regdata->reg_confirm_step1==0){ ?>
        <div class="confirmaion-step1">
<?php	
$attributes=array('class'=>'regform','method'=>'post','id'=>'constep1','name'=>'constep1','autocomplete'=>'off');   
echo form_open_multipart('student/registration-step1/preview',$attributes);
 ?>
  <div class="row">
    <div class="col-md-12">
      <p class="noteinfo">Before submission of Step 1 please check the below detail to avoid mistake. Please note that the information  below will not available for editing once you click on submit button.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12"> <?php echo form_checkbox('reg_step1_confirm','1',set_checkbox('reg_step1_confirm',"1")); ?> I have verified all the details entered by me in Registration Step 1 form and wish to submit the same. </div>
    <div class="col-md-12  form-group">
    <?php echo form_error('reg_step1_confirm'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 form-group"> <?php echo form_button(array( 'name'=>'substep1','id'=> 'substep1','value'=> 'true','class'=>'btn btn_custom_step1 btn-primary','type'=> 'submit','content' => 'Submit')); ?> <?php echo form_button(array( 'name'=>'editstep1','id'=> 'editstep1','value'=> 'true','class'=>'btn btn_custom_step1 btn-primary','type'=> 'submit','content' => 'Edit Data')); ?> </div>
  </div>
<?php echo form_close(); ?>
        </div>
       <?php  } ?> 
        <div class="row">
          <div class="col-md-12">
            <div class="reg-pre-head">General Information</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table  style="width:100%" class="table table-bordered table-reg-custom">
              <tr>
                <th width="34%">Course  Applying For</th>
                <td width="66%"><?php echo $regdata->course_name; ?></td>
              </tr>
              <tr>
                <th>Pool</th>
                <td><?php echo $regdata->reg_pool; ?></td>
              </tr>
              <tr>
                <th>University Name <span class="td_small">(If you already registered with any University)</span></th>
                <td><?php echo $regdata->reg_aluniversity; ?></td>
              </tr>
              <tr>
                <th>Registration No. of University</th>
                <td><?php echo $regdata->reg_alregno; ?></td>
              </tr>
              <tr>
                <th>Category</th>
                <td><?php echo $regdata->reg_category; ?></td>
              </tr>
              <tr>
                <th>Whether NSS Volunteer of Chandigarh?</th>
                <td><?php echo $regdata->reg_nssvolunteer; ?></td>
              </tr>
              <tr>
                <th>Gradation of NSS Certificate</th>
                <td><?php echo $regdata->reg_nssgrade; ?></td>
              </tr>
              <tr>
                <th>Name of Applicant</th>
                <td><?php $reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){ $reg_name.=" ".$regdata->reg_middlename; }elseif($regdata->reg_lastname!=""){ $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name; ?></td>
              </tr>
              <tr>
                <th>Applicant's Mobile No</th>
                <td><?php echo $regdata->reg_mobileno; ?></td>
              </tr>
              <tr>
                <th>Applicant's Email Id</th>
                <td><?php echo $regdata->reg_email; ?></td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td><?php echo $regdata->reg_dob; ?></td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo $regdata->reg_gender; ?></td>
              </tr>
              <tr>
                <th>Mother's Name</th>
                <td><?php echo $regdata->reg_mothername; ?></td>
              </tr>
              <tr>
                <th>Father's Name</th>
                <td><?php echo $regdata->reg_fathername; ?></td>
              </tr>
              <tr>
                <th>Father/Mother Mobile No</th>
                <td><?php echo $regdata->reg_parentmobile; ?></td>
              </tr>
              <tr>
                <th>Guardian's Name &amp; Address <span class="td_small">(if father deceased)</span></th>
                <td><?php echo $regdata->reg_guardianname; ?></td>
              </tr>
              <tr>
                <th>Relationship of Guardian to applicant</th>
                <td><?php echo $regdata->reg_guardian_relation; ?></td>
              </tr>
              <tr>
                <th>School/College Last attended</th>
                <td><?php echo $regdata->reg_lastsc; ?></td>
              </tr>
              <tr>
                <th>Date of Leaving</th>
                <td><?php echo $regdata->reg_leavingdate; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="reg-pre-head">Permanent Address</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table  style="width:100%" class="table table-bordered table-reg-custom">
              <tr>
                <th width="34%">Address</th>
                <td width="66%"><?php echo $regdata->reg_perma_address1; if($regdata->reg_perma_address2!=""){ echo ", ".$regdata->reg_perma_address2;} ?></td>
              </tr>
              <tr>
                <th width="34%">City</th>
                <td width="66%"><?php echo $regdata->reg_perma_city;  ?></td>
              </tr>
              <tr>
                <th width="34%">State</th>
                <td width="66%"><?php echo $regdata->reg_perma_state;  ?></td>
              </tr>
              <tr>
                <th width="34%">Country</th>
                <td width="66%"><?php echo $regdata->reg_perma_country;  ?></td>
              </tr>
              <tr>
                <th width="34%">Pincode</th>
                <td width="66%"><?php echo $regdata->reg_perma_pincode;  ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="reg-pre-head">Correspondence Address</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table  style="width:100%" class="table table-bordered table-reg-custom">
              <tr>
                <th width="34%">Address</th>
                <td width="66%"><?php echo $regdata->reg_corres_address1; if($regdata->reg_corres_address2!=""){ echo ", ".$regdata->reg_corres_address2;} ?></td>
              </tr>
              <tr>
                <th width="34%">City</th>
                <td width="66%"><?php echo $regdata->reg_corres_city;  ?></td>
              </tr>
              <tr>
                <th width="34%">State</th>
                <td width="66%"><?php echo $regdata->reg_corres_state;  ?></td>
              </tr>
              <tr>
                <th width="34%">Country</th>
                <td width="66%"><?php echo $regdata->reg_corres_country;  ?></td>
              </tr>
              <tr>
                <th width="34%">Pincode</th>
                <td width="66%"><?php echo $regdata->reg_corres_pincode;  ?></td>
              </tr>
            </table>
          </div>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
</body>
</html>
