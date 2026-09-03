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
      <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                      </div>
                    </div>
                    <?php  } ?>
    
      <div class="row">
        <div class="col-md-12">
          <div class="e-page-title">
            <h3>Application Status</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <label>Welcome,
                <?php 
			$reg_id=$regdata->reg_id;	
			$regid_enc=$this->encryptcode->encrypt($reg_id,ENC_KEY_PASS);
			$reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){  $reg_name.=" ".$regdata->reg_middlename; }
if($regdata->reg_lastname!=""){  $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name; ?>
              </label>
            </div>
            <div class="panel-body regpre">
              <div class="row">
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Application No. </label>
                  <p><?php echo $regdata->reg_id; ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Name </label>
                  <p><?php echo $reg_name; ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Father's Name </label>
                  <p><?php echo $regdata->reg_fathername; ?></p>
                </div>
              </div>
              <div class="row">
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Gender </label>
                  <p><?php echo $regdata->reg_gender; ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Mobile Number </label>
                  <p><?php echo $regdata->reg_mobileno; ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Email Id </label>
                  <p><?php echo $regdata->reg_email; ?></p>
                </div>
              </div>
              <div class="row">
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Date of Birth </label>
                  <p><?php echo  date('d-m-Y',strtotime($regdata->reg_dob)); ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Course Applying For </label>
                  <p><?php echo $regdata->course_name; ?></p>
                </div>
                <div class=" col-md-4 col-sm-12 col-xs-12">
                  <label>Pool </label>
                  <p><?php echo $regdata->reg_pool; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if($regdata->reg_paystatus==1 && $regdata->reg_rollno!="" && $regdata->reg_examcenter!="" && $regdata->reg_rollno!="Not Eligible"){ ?>
      <div class="col-md-4 apgreen">
          <div class="apstatus_box" >
        	<a href="<?php echo site_url("student/admit-card/$regid_enc"); ?>" style="background:#F05A00;">Admit Card</a>
        </div>
        </div>
        <?php } ?>
        
      
        <?php if($regdata->reg_confirm_step1==0){ ?>
        <div class="col-md-4">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-step1/edit"); ?>">Click here to Change General Profile</a> </div>
        </div>
        <?php }?>
        <?php if($regdata->reg_confirm_step1==1){ ?>
        <div class="col-md-4">
          <div class="apstatus_box apgreen"> <a href="<?php echo site_url("student/registration-step1/preview"); ?>">Click here to View General Profile</a> </div>
        </div>
        <?php  } ?>
        <?php if($regdata->reg_step2==0){ ?>
        <div class="col-md-4">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-step2"); ?>">Click here to Change Educational Qualification</a> </div>
        </div>
        <?php  } ?>
        <?php if($regdata->reg_step2==1 && $regdata->reg_confirm_step2==0){ ?>
        <div class="col-md-4">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-step2/edit"); ?>">Click here to Change Educational Qualification</a> </div>
        </div>
        <?php  } ?>
        <?php if($regdata->reg_step2==1 && $regdata->reg_confirm_step2==1){ ?>
        <div class="col-md-4 apgreen">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-step2/preview"); ?>">Click here to View Educational Qualification</a> </div>
        </div>
        <?php  } ?>
        <?php if($regdata->reg_confirm_step3==0){ ?>
        <div class="col-md-4">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-step3"); ?>">Click here to Change Documents</a> </div>
        </div>
        <?php } ?>
        <?php if($regdata->reg_confirm_step3==1){ ?>
        <div class="col-md-4">
          <div class="apstatus_box apgreen"> <a href="<?php echo site_url("student/document-preview"); ?>">Click here to View Uploaded Documents</a> </div>
        </div>
        <?php } ?>
        <?php if($regdata->reg_confirm_step3==1 && $regdata->reg_paystatus==0){ ?>
        <div class="col-md-4">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/registration-payment"); ?>">Click here to Make  Payment</a> </div>
        </div>
        <?php } ?>
        
          <?php if($regdata->reg_confirm_step3==1 && $regdata->reg_paystatus==1){ 
		  $reg_id=$regdata->reg_id;
		  $reg_id_enc=$this->encryptcode->encrypt($reg_id,ENC_KEY_PASS);
		   ?>
        <div class="col-md-4 apgreen">
          <div class="apstatus_box"> <a href="<?php echo site_url("student/payment-overview/$reg_id_enc"); ?>">Click here to View  Payment Status</a> </div>
        </div>
        <?php } ?>
       
        
        
        
      </div>
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
