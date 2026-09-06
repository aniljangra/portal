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

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161805118-1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

  gtag('config', 'UA-161805118-1');

</script>

</head>

<body>

<div class="body">

  <?php include("includes/header.php"); ?>

  <div role="main" class="main">

<div class="container">

  <div class="row">

    <div class="col-md-12">

      <div class="e-page-title">

        <h3>Bhog Booking</h3>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-lg-12">

      <div class="contact-info">

        <table border="0" width="100%" cellspacing="0" cellpadding="0" align="left" class="table table-bordered table-striped">

          <tr>

            <th><strong><u>ITEMS</u></strong></th>

            <th><strong><u>QUANTITY</u></strong></th>

          </tr>

          <tr>

            <td colspan="2" class="text-center bg-light"><strong>सामान्य दिनों के लिए भोग सामग्री (General Days)</strong></td>

          </tr>

          <tr>

            <td>DESI GHEE</td>

            <td>1 kg</td>

          </tr>

          <tr>

            <td>AATA</td>

            <td>1 kg</td>

          </tr>

          <tr>

            <td>SOOJI</td>

            <td>200 gm</td>

          </tr>

          <tr>

            <td>SUGAR</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>RICE</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>KISHMISH</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>ALMOND (BADAM)</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>CASHEW (KAJU)</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>DAL / CHANA (WHITE/BLACK) / RAJMA</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>SEASONAL VEGETABLE</td>

            <td>1 kg</td>

          </tr>

          <tr>

            <td>PANEER (Optional)</td>

            <td>250 gm</td>

          </tr>

          <tr>

            <td>MATAR DANA (Optional)</td>

            <td>250 gm</td>

          </tr>

          <tr>

            <td>TOMATO</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>GINGER</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>GREEN CHILLI</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>TURMERIC (HALDI)</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>DEGI MIRCH</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>SALT</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>CUMIN (JEERA)</td>

            <td>50 gm</td>

          </tr>

          <tr>

            <td>CORIANDER LEAVES (HARA DHANIYA)</td>

            <td>1 Bunch</td>

          </tr>

          <tr>

            <td>MILK</td>

            <td>2 kg</td>

          </tr>

          <tr>

            <td>MIX DRY FRUIT</td>

            <td>1/2 kg</td>

          </tr>

          <tr>

            <td>CLOVE & CARDAMOM (LONG, ELAICHI)</td>

            <td>10 gm</td>

          </tr>

          <tr>

            <td>SABUDANA</td>

            <td>200 gm</td>

          </tr>

          <tr>

            <td colspan="2" class="text-center bg-light"><strong>एकादशी वाले दिन के लिए भोग सामग्री (Ekadashi Day)</strong></td>

          </tr>

          <tr>

            <td>MIX FRUIT</td>

            <td>5 kg</td>

          </tr>

          <tr>

            <td colspan="2" class="text-center bg-light"><strong>नवरात्रों के लिए भोग सामग्री (Navratri Days)</strong></td>

          </tr>

          <tr>

            <td>DRY FRUIT (PANCHMEWA)</td>

            <td>1/2 kg / Per Day</td>

          </tr>

          <tr>

            <td>MIX FRUIT</td>

            <td>5 kg / Per Day</td>

          </tr>

        </table>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">

      <?php 

      $attributes = array(
          'class' => 'regform',
          'method' => 'post',
          'id' => '',
          'name' => 'instAddForm',
          'autocomplete' => 'off'
      );   

      echo form_open_multipart('online-bhog-booking/step1', $attributes);

      ?>

      <div class="panel panel-info">

        <div class="panel-heading">

          <label>
            <font size="1" color="red" face="Arial, Helvetica, sans-serif">
              Note - (*) Fields are mandatory.
            </font>
          </label>

        </div>

        <div class="panel-body">

          <div class="row">

            <div class="form-group col-md-12 col-sm-12 sol-xs-12">

              <label>
                Select Temple 
                <span class="req">*</span>
              </label>

              <select class="form-control" name="cb_temple" aria-label="Default select example">

                <option selected value="">--Select--</option>

                <?php foreach($templedata as $templerow){ ?>

                  <option 
                    value="<?php echo $templerow->temple_id; ?>" 
                    <?php echo set_select('cb_temple', $templerow->temple_id); ?>
                  >

                    <?php 
                    echo $templerow->temple_name;

                    $temple_fee = $templerow->temple_fee;

                    if($temple_fee > 0){
                        echo " - Service Charge Rs. $temple_fee";
                    } 
                    ?>

                  </option>

                <?php } ?>

              </select>

              <?php echo form_error('cb_temple'); ?>

            </div>

          </div>

          <div class="row">

            <div class="form-group col-md-12">

              <?php 
              echo form_button(array(
                  'name' => 'regsubmit',
                  'id' => 'regsubmit',
                  'value' => 'true',
                  'class' => 'btn btn_custom_yl btn-primary',
                  'type' => 'submit',
                  'content' => 'Proceed Now'
              )); 
              ?>

            </div>

          </div>

        </div>

      </div>

    </div>

    <?php echo form_close(); ?>

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

</body>

</html>