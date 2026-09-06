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

            <li class="breadcrumb-item">
              <a href="<?php echo site_url("master/dashboard"); ?>">
                Home
              </a>
            </li>

            <li class="breadcrumb-item">
              <a href="<?php echo site_url("master/bhog-datemgmt/manage"); ?>">
                Manage Bhog Date Setting
              </a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
              Add New Date
            </li>

          </ol>
        </nav>

        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">
            Add New Bhog Date
          </h1>
        </div>

        <div class="row">

          <div class="col-xl-12 col-md-12 mb-4">

            <div class="inner-section">

              <?php if(
                $this->session->flashdata('feedback') &&
                $this->session->flashdata('feedbackerr')
              ){ ?>

              <div class="col-md-12">

                <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?> alert-dismissable">

                  <a href="#" class="close" data-dismiss="alert" aria-label="close">
                    &times;
                  </a>

                  <?php echo $this->session->flashdata('feedback'); ?>

                </div>

              </div>

              <?php } ?>

              <?php

              $attributes = array(
                  'class' => 'formAdmin form-horizontal',
                  'method' => 'post',
                  'autocomplete' => 'off'
              );

              echo form_open_multipart(
                  'master/bhog-datemgmt/add',
                  $attributes
              );

              ?>

              <div class="col-md-12">

                <div class="row">

                  <div class="form-group col-md-6 col-sm-12 col-xs-12">

                    <label>
                      Temple <span class="req">*</span>
                    </label>

                    <?php echo form_input(array(
                        'name'     => 'dset_templename',
                        'id'       => 'dset_templename',
                        'type'     => 'text',
                        'readonly' => true,
                        'class'    => 'form-control',
                        'value'    => set_value(
                            'dset_templename',
                            $templedata->temple_name
                        )
                    )); ?>

                    <?php echo form_error('dset_templename'); ?>

                  </div>


                  <div class="form-group col-md-6 col-sm-12 col-xs-12">

                    <label>
                      Date <span class="req">*</span>
                    </label>

                    <?php echo form_input(array(
                        'name'  => 'dset_date',
                        'id'    => 'datepicker',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => set_value('dset_date')
                    )); ?>

                    <?php echo form_error('dset_date'); ?>

                  </div>

                </div>


                <div class="row">

                  <div class="form-group col-md-6 col-sm-12 col-xs-12 mtop20">

                    <?php echo form_button(array(
                        'name'    => 'addBhogDateSetting',
                        'id'      => 'addBhogDateSetting',
                        'value'   => 'true',
                        'class'   => 'btn btn-primary',
                        'type'    => 'submit',
                        'content' => 'Submit'
                    )); ?>

                  </div>

                </div>

              </div>

              <?php echo form_close(); ?>

            </div>

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
    dateFormat: 'yy-mm-dd',
    changeYear: true,
    changeMonth: true,
    yearRange: "-50:+0"
});

</script>

</body>
</html>