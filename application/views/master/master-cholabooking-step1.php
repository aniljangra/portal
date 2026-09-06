<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/master/css/jquery-ui.css">

</head>

<body id="page-top">
<div id="wrapper">
  <?php include("includes/sidebar.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include("includes/top-nav.php"); ?>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url("master/dashboard");  ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chola Booking</li>
          </ol>
        </nav>
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Chola Booking Step 1-1</h1>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12 mb-4">
            <div class="inner-section">
              <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="col-md-12">
                <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
              </div>
              <?php  } ?>
              <?php 
$attributes=array('class' => 'formAdmin form-horizontal','method'=>'post','autocomplete'=>'off');
echo form_open_multipart("master/chola-booking",$attributes);
echo form_hidden('temple_id',$templedata->temple_id);

			 ?>
              <div class="panel panel-info">
            <div class="panel-heading">
              <label><font size="1" color="red" face="Arial, Helvetica, sans-serif">Note - (*) Fields are mandatory.</font></label>
            </div>
            <div class="panel-body">
            	<div class="row">
                	<div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <label>Temple <span class="req">*</span> </label>
                  <?php echo  form_input(array(
    'name'  => 'cb_templename',
    'id'    => 'cb_templename',
    'type'  => 'text',
    'readonly'=>'true',
    'class' => "form-control",
    'value' =>set_value('cb_templename',$templedata->temple_name)));
    ?>
	<?php echo form_error('cb_templename'); ?>
                    </div>
                </div>	
              <div class="row">
              
              <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Date <span class="req">*</span></label>
                  <?php echo  form_input(array(
    'name'  => 'cb_bookfordate',
    'id'    => 'cb_bookfordate',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('cb_bookfordate')));
    ?> <?php echo form_error('cb_bookfordate'); ?> </div>
                  
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>Name as per Aadhaar Card <span class="req">*</span></label>
                  <?php echo form_input(array(
    'name'  => 'cb_name',
    'id'    => 'cb_name',
    'type'  => 'text',
    'placeholder'=>'',
    'class' => "form-control",
    'value' =>set_value('cb_name')));
    ?> <?php echo form_error('cb_name'); ?> </div>
                
               <div class="form-group col-md-6 col-sm-12 sol-xs-12">
               <label>Aadhaar  No.<span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_aadhaar',
                  'type'  => 'text',
                  'placeholder'=>'',
				          'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_aadhaar')));
                  ?> <?php echo form_error('cb_aadhaar'); ?>
               </div>
               <div class="form-group col-md-6 col-sm-12 sol-xs-12">
               <label>Mobile Number  <span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_mobile',
                  'type'  => 'text',
                  'placeholder'=>'',
				   'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_mobile')));
                  ?> <?php echo form_error('cb_mobile'); ?>
               </div>
                <div class="form-group col-md-6 col-sm-12 sol-xs-12">
               <label>Devotee Passport Size Photograph <span class="note">[Less than 500kb]</span> <span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_proof',
                  'type'  => 'file',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_proof')));
                  ?> <?php echo form_error('cb_proof'); ?>
                
                <?php if(isset($error3)){?>
					<span class="error"><?php echo $error3; ?></span>	
				<?php }?>
               </div>

               <div class="form-group col-md-6 col-sm-12 sol-xs-12">
               <label>Have Other Member? <span class="req">*</span></label>
               <select class="form-control cb_othermember" name="cb_othermember">
                    <option value="No" <?php echo set_select('cb_othermember',"No"); ?>>No</option>
                   <option value="Yes" <?php echo set_select('cb_othermember',"Yes"); ?>>Yes</option>

                </select>
                <?php echo form_error('cb_othermember'); ?>
               </div>
               
               </div>
               <div class="row othermember">
               	<div class="col-md-12">
                	<div class="rowhead">Other Member Details</div>
                </div>
               </div>
               
                 
                  <div class="row othermember">
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>1. Member Name <span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_name1',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_member_name1')));
                  ?> <?php echo form_error('cb_member_name1'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label> Member Mobile <span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_mobile1',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_mobile1')));
                  ?> <?php echo form_error('cb_member_mobile1'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>Member Aadhaar  No. <span class="req">*</span></label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_aadhaar1',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_aadhaar1')));
                  ?> <?php echo form_error('cb_member_aadhaar1'); ?>
               </div>
               
              </div>
              
               <div class="row othermember">
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>2. Member Name </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_name2',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_member_name2')));
                  ?> <?php echo form_error('cb_member_name2'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>Member Mobile </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_mobile2',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_mobile2')));
                  ?> <?php echo form_error('cb_member_mobile2'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>Member Aadhaar  No. </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_aadhaar2',
                  'type'  => 'text',
                  'placeholder'=>'',
				           'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_aadhaar2')));
                  ?> <?php echo form_error('cb_member_aadhaar2'); ?>
               </div>
               
               </div>
               
                 <div class="row othermember">
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>3. Member Name </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_name3',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_member_name3')));
                  ?> <?php echo form_error('cb_member_name3');?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label> Member Mobile </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_mobile3',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_mobile3')));
                  ?> <?php echo form_error('cb_member_mobile3'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label> Member Aadhaar  No. </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_aadhaar3',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_aadhaar3')));
                  ?> <?php echo form_error('cb_member_aadhaar3'); ?>
               </div>
               </div>
               
                 <div class="row othermember">
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>4. Member Name </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_name4',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_member_name4')));
                  ?> <?php echo form_error('cb_member_name4'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label> Member Mobile </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_mobile4',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_mobile4')));
                  ?> <?php echo form_error('cb_member_mobile4'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>Member Aadhaar  No. </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_aadhaar4',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_aadhaar4')));
                  ?> <?php echo form_error('cb_member_aadhaar4'); ?>
               </div>
               
              </div>
              <div class="row othermember">
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>5. Member Name </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_name5',
                  'type'  => 'text',
                  'placeholder'=>'',
                  'class' => "form-control",
                  'value' =>set_value('cb_member_name5')));
                  ?> <?php echo form_error('cb_member_name5'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label> Member Mobile </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_mobile5',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>10,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_mobile5')));
                  ?> <?php echo form_error('cb_member_mobile5'); ?>
               </div>
               <div class="form-group col-md-4 col-sm-12 sol-xs-12">
               <label>Member Aadhaar  No. </label>
               <?php echo form_input(array(
                  'name'  => 'cb_member_aadhaar5',
                  'type'  => 'text',
                  'placeholder'=>'',
				  'maxlength'=>12,
                  'class' => "form-control",
                  'value' =>set_value('cb_member_aadhaar5')));
                  ?> <?php echo form_error('cb_member_aadhaar5'); ?>
               </div>
               
              </div>
              <div class="row">
              <div class="form-group col-md-12"> <?php echo form_button(array( 'name'=>'regsubmit','id'=> 'regsubmit','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Proceed Now')); ?> </div>
              </div>
              <div class="row">
                <div class="col-md-12">
<!--                  <p class="notetext">Note: On click proceed now you will get payment overview and payment link</p>
-->                </div>
              </div>
            </div>
          </div>
              <?php echo form_close();?> </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </div>
</div>
<?php include("includes/common-footer.php"); ?>
<?php include("includes/style-footer.php"); ?>
<script src="<?php echo base_url(); ?>assets/master/js/jquery-ui.js"></script> 
<script type="text/javascript">
$('#cb_bookfordate').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: true,
	changeMonth: true,
	yearRange: "-50:+1",
});
</script>


<script type="text/javascript">
$(document).ready(function() {
toggleFields();
$(".cb_othermember").change(function() { toggleFields(); });
});

 function toggleFields(){
 if($(".cb_othermember").val()=="Yes"){
                $('.othermember').show();
        }else{
                $('.othermember').hide();

         }

 }
</script> 

</body>
</html>
