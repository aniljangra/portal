<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$segment4=$this->uri->segment(4);

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
            <li class="breadcrumb-item"><a href="<?php echo site_url("master/date-setting/manage");  ?>">Manage Date Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Date Setting</li>
          </ol>
        </nav>
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Edit Date Setting</h1>
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
echo form_open_multipart("master/date-setting/edit/$segment4",$attributes);

 			 ?>
             <?php
			 $date="";
			 if($datesetdata->dset_date!=""){
				$date=date('d-m-Y',strtotime($datesetdata->dset_date));	 
			 }
			
			 ?>
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label>Date <span class="req">*</span></label>
                    <?php echo form_input(array(
				'name'  => 'dset_date',
				'id'    => 'datepicker',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('dset_date',$date)));
				?> <?php echo form_error('dset_date'); ?> </div>
                  
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Hawan Booking <span class="req">*</span></label>
                      <select name="dset_hawanbooking" class="form-control">
                        <option value="0"  <?php echo set_select('dset_hawanbooking',0,$datesetdata->dset_hawanbooking==0); ?>>On</option>
                        <option value="1"  <?php echo set_select('dset_hawanbooking',1,$datesetdata->dset_hawanbooking==1); ?>>Off</option>
                      </select>
                      <?php echo form_error('dset_hawanbooking'); ?> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Room Booking <span class="req">*</span></label>
                      <select name="dset_roombooking" class="form-control">
                        <option value="0"  <?php echo set_select('dset_roombooking',0,$datesetdata->dset_roombooking==0); ?>>On</option>
                        <option value="1"  <?php echo set_select('dset_roombooking',1,$datesetdata->dset_roombooking==1); ?>>Off</option>
                      </select>
                      <?php echo form_error('dset_roombooking'); ?> </div>
                  </div>
                </div>
                
                
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12 col-xs-12 mtop20"> <?php echo form_button(array( 'name'=>'addDateSetting','id'=> 'addDateSetting','value'=> 'true','class'=>'btn btn-primary','type'=> 'submit','content' => 'Submit')); ?> </div>
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
$('#datepicker').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: true,
	changeMonth: true,
	yearRange: "-50:+1",
});
</script>

</body>
</html>
