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
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="e-page-title">
              <h3>Preview Uploaded Documents</h3>
            </div>
          </div>
        </div>
        <?php if($regdata->reg_course==1){ ?>
        <div class="row">
          <div class="col-md-12">
            <table style="width:100%" class="table table-bordered">
              <?php $reg_matriccerti=$regdata->reg_matriccerti;

			if($reg_matriccerti!=""){

			 ?>
              <tr>
                <td width="29%"><strong>10th Marksheet</strong></td>
                <td width="71%"><a href="<?php echo base_url().$reg_matriccerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_twelvecerti=$regdata->reg_twelvecerti;

			if($reg_twelvecerti!=""){

				?>
              <tr>
                <td><strong>10+2 Marksheet</strong></td>
                <td><a href="<?php echo base_url().$reg_twelvecerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_dobcerti=$regdata->reg_dobcerti;

			if($reg_dobcerti!=""){?>
              <tr>
                <td><strong>Date of Birth Proof Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_dobcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_charactercerti=$regdata->reg_charactercerti;

			if($reg_charactercerti!=""){?>
              <tr>
                <td><strong>Character Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_charactercerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_catcerti=$regdata->reg_catcerti;

			if($reg_catcerti!=""){?>
              <tr>
                <td><strong>Category Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_catcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_regcardcerti=$regdata->reg_regcardcerti;

			if($reg_regcardcerti!=""){?>
              <tr>
                <td><strong>University Registration Card </strong></td>
                <td><a href="<?php echo base_url().$reg_regcardcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_disabcerti=$regdata->reg_disabcerti;

			if($reg_disabcerti!=""){?>
              <tr>
                <td><strong>Disability   Certificate </strong></td>
                <td><a href="<?php echo base_url().$reg_disabcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_passphoto=$regdata->reg_passphoto;

			if($reg_passphoto!=""){?>
              <tr>
                <td><strong>Applicant Passport photo </strong></td>
                <td><a href="<?php echo base_url().$reg_passphoto; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_stusign=$regdata->reg_stusign;

			if($reg_stusign!=""){?>
              <tr>
                <td><strong>Applicant Signature </strong></td>
                <td><a href="<?php echo base_url().$reg_stusign; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_fathersign=$regdata->reg_fathersign;

			if($reg_fathersign!=""){?>
              <tr>
                <td><strong>Father's Signature </strong></td>
                <td><a href="<?php echo base_url().$reg_fathersign; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <?php }elseif($regdata->reg_course==2){ ?>
        <div class="row">
          <div class="col-md-12">
            <table style="width:100%" class="table table-bordered">
              <?php $reg_matriccerti=$regdata->reg_matriccerti;

			if($reg_matriccerti!=""){

			 ?>
              <tr>
                <td width="29%"><strong>10th Marksheet</strong></td>
                <td width="71%"><a href="<?php echo base_url().$reg_matriccerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_twelvecerti=$regdata->reg_twelvecerti;

			if($reg_twelvecerti!=""){

				?>
              <tr>
                <td><strong>10+2 Marksheet</strong></td>
                <td><a href="<?php echo base_url().$reg_twelvecerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_dobcerti=$regdata->reg_dobcerti;

			if($reg_dobcerti!=""){?>
              <tr>
                <td><strong>Date of Birth Proof Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_dobcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_charactercerti=$regdata->reg_charactercerti;

			if($reg_charactercerti!=""){?>
              <tr>
                <td><strong>Character Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_charactercerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_catcerti=$regdata->reg_catcerti;

			if($reg_catcerti!=""){?>
              <tr>
                <td><strong>Category Certificate</strong></td>
                <td><a href="<?php echo base_url().$reg_catcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_regcardcerti=$regdata->reg_regcardcerti;

			if($reg_regcardcerti!=""){?>
              <tr>
                <td><strong>University Registration Card </strong></td>
                <td><a href="<?php echo base_url().$reg_regcardcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_disabcerti=$regdata->reg_disabcerti;

			if($reg_disabcerti!=""){?>
              <tr>
                <td><strong>Disability   Certificate </strong></td>
                <td><a href="<?php echo base_url().$reg_disabcerti; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_passphoto=$regdata->reg_passphoto;

			if($reg_passphoto!=""){?>
              <tr>
                <td><strong>Applicant Passport photo </strong></td>
                <td><a href="<?php echo base_url().$reg_passphoto; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_stusign=$regdata->reg_stusign;

			if($reg_stusign!=""){?>
              <tr>
                <td><strong>Applicant Signature </strong></td>
                <td><a href="<?php echo base_url().$reg_stusign; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
              <?php $reg_fathersign=$regdata->reg_fathersign;

			if($reg_fathersign!=""){?>
              <tr>
                <td><strong>Father's Signature </strong></td>
                <td><a href="<?php echo base_url().$reg_fathersign; ?>" target="_blank">Click Here</a></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
        <?php }?>
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
