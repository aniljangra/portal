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
    	<div class="e-page-title"><h3>Registration Step 2: Educational Qualification</h3></div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-12">
      
      <div class="panel panel-info">
          <div class="panel-heading">
            <label>Personal Detail </label>
          </div>
          <div class="panel-body regpre">
            <div class="row">
              <div class=" col-md-6 col-sm-12 col-xs-12">
                <label>Application No. </label>
                <p><?php echo $regdata->reg_id; ?></p>
                
                </div>
              <div class=" col-md-6 col-sm-12 col-xs-12">
                <label>Name </label>
                <p><?php 
				
				$reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){  $reg_name.=" ".$regdata->reg_middlename; }
				if($regdata->reg_lastname!=""){  $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name; ?></p>
                 </div>
            </div>
            <div class="row">
              <div class=" col-md-6 col-sm-12 col-xs-12">
                <label>Course Applying For </label>
                <p><?php echo $regdata->course_name; ?></p>
                
                </div>
              <div class=" col-md-6 col-sm-12 col-xs-12">
                <label>Pool </label>
                 <p><?php echo $regdata->reg_pool; ?></p>
                </div>
            </div>
            </div>
        </div>
<?php	
$attributes=array('class' => 'regform','method'=>'post','id'=>'instAddForm','name'=>'instAddForm','autocomplete'=>'off');   
echo form_open_multipart('student/registration-step2',$attributes);
 ?>
 		<?php if($regdata->reg_course==1){ ?>
        
        <div class="panel panel-info">
          <div class="panel-heading">
            <label>10+2 Educational Qualification <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
          </div>
          <div class="panel-body">
          <div class="row">
          	<div class="col-md-12"><p class="note"><strong>Note:</strong> Best 5 subjects including at least 1 language</p></div>
          </div>
            <div class="row">
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>10+2 Year of Passing <span class="req">*</span> </label>
                <?php echo form_input(array(
    'name'=>'reg_twe_yearpassing',
    'id'=>'reg_twe_yearpassing',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_yearpassing')));
    ?> <?php echo form_error('reg_twe_yearpassing'); ?> </div>
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Name of Board <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_twe_boardname',
    'id'    => 'reg_twe_boardname',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_boardname')));
    ?> <?php echo form_error('reg_twe_boardname'); ?> </div>
    
    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Subjects <span class="note">(Comma Separated) </span><span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_twe_subjects',
    'id'    => 'reg_twe_subjects',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_subjects')));
    ?> <?php echo form_error('reg_twe_subjects'); ?> </div>
    
            </div>
            <div class="row">
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Total Marks <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_twe_totalmarks',
    'id'    => 'reg_twe_totalmarks',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_totalmarks')));
    ?> <?php echo form_error('reg_twe_totalmarks'); ?> </div>
    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Marks Obtained <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_twe_marksobtained',
    'id'    => 'reg_twe_marksobtained',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_marksobtained')));
    ?> <?php echo form_error('reg_twe_marksobtained'); ?> </div>
            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Percentage <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_twe_percentage',
    'id'    => 'reg_twe_percentage',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_twe_percentage')));
    ?> <?php echo form_error('reg_twe_percentage'); ?> </div>  
              
            </div>
            <div class="row">
              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'edusubmit1','id'=> 'edusubmit1','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Submit')); ?> </div>
            </div>
          </div>
        </div>
        <?php }elseif($regdata->reg_course==2){ ?>
		
        <div class="panel panel-info">
          <div class="panel-heading">
            <label>10th Educational Qualification <font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
          </div>
          <div class="panel-body">
          <div class="row">
          	<div class="col-md-12"><p class="note"><strong>Note:</strong> Best 5 subjects including at least 1 language</p></div>
          </div>
            <div class="row">
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Matric Year of Passing <span class="req">*</span> </label>
                <?php echo form_input(array(
    'name'=>'reg_mat_yearpassing',
    'id'=>'reg_mat_yearpassing',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_yearpassing')));
    ?> <?php echo form_error('reg_mat_yearpassing'); ?> </div>
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Name of Board <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_mat_boardname',
    'id'    => 'reg_mat_boardname',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_boardname')));
    ?> <?php echo form_error('reg_mat_boardname'); ?> </div>
    
    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Subjects <span class="note">(Comma Separated) </span><span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_mat_subjects',
    'id'    => 'reg_mat_subjects',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_subjects')));
    ?> <?php echo form_error('reg_mat_subjects'); ?> </div>
    
            </div>
            <div class="row">
              <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Total Marks <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_mat_totalmarks',
    'id'    => 'reg_mat_totalmarks',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_totalmarks')));
    ?> <?php echo form_error('reg_mat_totalmarks'); ?> </div>
    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Marks Obtained <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_mat_marksobtained',
    'id'    => 'reg_mat_marksobtained',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_marksobtained')));
    ?> <?php echo form_error('reg_mat_marksobtained'); ?> </div>
            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                <label>Percentage <span class="req">*</span></label>
                <?php echo form_input(array(
    'name'  => 'reg_mat_percentage',
    'id'    => 'reg_mat_percentage',
    'type'  => 'text',
    'class' => "form-control",
    'value' =>set_value('reg_mat_percentage')));
    ?> <?php echo form_error('reg_mat_percentage'); ?> </div>  
              
            </div>
            <div class="row">
              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'edusubmit2','id'=> 'edusubmit2','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Submit')); ?> </div>
            </div>
          </div>
        </div>
			
		<?php }?>
         <?php echo form_close(); ?>
       </div>
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
