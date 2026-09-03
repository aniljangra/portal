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
      <?php if($regdata->reg_confirm_step2==0){ ?>
        <div class="confirmaion-step1">
<?php	
$attributes=array('class'=>'regform','method'=>'post','id'=>'constep1','name'=>'constep1','autocomplete'=>'off');   
echo form_open_multipart('student/registration-step2/preview',$attributes);
 ?>
  <div class="row">
    <div class="col-md-12">
      <p class="noteinfo">Before submission of Step 2 (Educational Qualification) please check the below detail to avoid mistake. Please note that the information  below will not available for editing once you click on submit button.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12"> <?php echo form_checkbox('reg_confirm_step2','1',set_checkbox('reg_confirm_step2',"1")); ?> I have verified all the details entered by me in Registration Step 2 form and wish to submit the same. </div>
    <div class="col-md-12  form-group">
    <?php echo form_error('reg_confirm_step2'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 form-group"> <?php echo form_button(array( 'name'=>'substep2','id'=> 'substep2','value'=> 'true','class'=>'btn btn_custom_step1 btn-primary','type'=> 'submit','content' => 'Submit')); ?> <?php echo form_button(array( 'name'=>'editstep2','id'=> 'editstep2','value'=> 'true','class'=>'btn btn_custom_step1 btn-primary','type'=> 'submit','content' => 'Edit Data')); ?> </div>
  </div>
<?php echo form_close(); ?>
        </div>
       <?php } ?> 
       <?php if($regdata->reg_course==1){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="reg-pre-head">10+2 Educational Qualification </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
        <table  style="width:100%" class="table table-bordered custom-qtable">
          <tr>
            <th width="12%">Year of Passing</th>
            <th width="18%">Name of Board</th>
            <th width="40%">Subjects</th>
            <th width="11%">Total Marks</th>
            <th width="13%">Marks Obtained</th>
            <th width="6%">%age</th>
          </tr>
          <tr>
            <td><?php echo $regdata->reg_twe_yearpassing; ?></td>
            <td><?php echo $regdata->reg_twe_boardname; ?></td>
            <td><?php echo $regdata->reg_twe_subjects; ?></td>
            <td><?php echo $regdata->reg_twe_totalmarks; ?></td>
            <td><?php echo $regdata->reg_twe_marksobtained; ?></td>
            <td><?php echo $regdata->reg_twe_percentage; ?></td>
          </tr>
        </table>
		</div>
        </div>
        <?php }elseif($regdata->reg_course==2){ ?>
		<div class="row">
          <div class="col-md-12">
            <div class="reg-pre-head">10th Educational Qualification </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
        <table  style="width:100%" class="table table-bordered custom-qtable">
          <tr>
            <th width="12%">Year of Passing</th>
            <th width="18%">Name of Board</th>
            <th width="40%">Subjects</th>
            <th width="11%">Total Marks</th>
            <th width="13%">Marks Obtained</th>
            <th width="6%">%age</th>
          </tr>
          <tr>
            <td><?php echo $regdata->reg_mat_yearpassing ; ?></td>
            <td><?php echo $regdata->reg_mat_boardname; ?></td>
            <td><?php echo $regdata->reg_mat_subjects; ?></td>
            <td><?php echo $regdata->reg_mat_totalmarks; ?></td>
            <td><?php echo $regdata->reg_mat_marksobtained; ?></td>
            <td><?php echo $regdata->reg_mat_percentage; ?></td>
          </tr>
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
