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
            <li class="breadcrumb-item active" aria-current="page">Search</li>
          </ol>
        </nav>
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Search</h1>
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
			  	$attributes = array('class' => 'formAdmin form-horizontal','name'=>'chpassform','id'=>'formuser','method'=>'post','autocomplete'=>'off');
				echo form_open_multipart("master/chola-booking/search",$attributes);
 			 ?>
              
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>From Date <span class="req">*</span></label>
                  <?php echo form_input(array(
				'name'  => 'from_date',
				'id'    => 'from_date',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('from_date')));
				?> <?php echo form_error('from_date'); ?> </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label>To Date </label>
                  <?php echo form_input(array(
				'name'  => 'to_date',
				'id'    => 'to_date',
				'type'  => 'text',
				'class' => "form-control",
				'value' =>set_value('to_date')));
				?> <?php echo form_error('to_date'); ?> </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-sm-12 col-xs-12 mtop20">
                  <button name="addStaffFilter" class="btn btn-primary" type="submit">Next</button>
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
$('#from_date').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: false,
	changeMonth: false,
});
</script> 
<script type="text/javascript">
$('#to_date').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: false,
	changeMonth: false,
});
</script>

</body>
</html>
