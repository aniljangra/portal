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
          <div class="welcome_heading">Welcome to Online Services</div>
        </div>
      </div>
      
      
       <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable alert-custom"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                </div>
              </div>
              <?php  } ?> 
      <div class="row">
        <div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("online-donation")  ?>">Online Donation</a> </div>
        </div>
        <div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("my-profile") ?>">User Profile</a> </div>
        </div>
        
        <!--<div class="col-md-4">
          <div class="dash_box"> <a href="">Online Hawan Booking</a> </div>
        </div>-->
      </div>
      <div class="row">
       <div class="col-md-4">
          <div class="dash_box"> <a href="<?php echo site_url("room-booking")  ?>">Room Booking</a> </div>
        </div>
        
        <div class="col-md-6">
          <div class="dash_box"> <a href="<?php echo site_url("logout") ?>">Logout</a> </div>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-12">
        	<h5>श्री माता मनसा देवी पूजास्थल बोर्ड में मुंडन,चौला आनलईन बुक कराने के लिये जरूरी नियम और शर्तें </h5>
        <p>
        
<strong>मुंडन:</strong>
सभी श्रद्धालुओं/यात्रियों को सूचित किआ जाता है कि,मुंडन उसी तारीख को होगा जिस तारीख के लिये मुंडन आनलईन बुक किआ जायेगा । अगर कोई श्रद्धालु , बुकिंग वाली तारीख को मुंडन कराने नही आता है और दूसरी तारीख को आता है तो उसका मुंडन नही होगा और न ही बुकिंग का पैसा वापिस होगा । अत: आप सबको बुकिंग वाली तारीख को मुंडन कराने आना अनिवार्य है । मुंडन का समय गर्मियो मे सुबह 07:00 बजे से शाम 07:00 बजे तक व सर्दियों मे सुबह 07:00 बजे से शाम 06:00 बजे तक होता है। <br>
<p>
  <p>
<strong>माता मनसा देवी जी का चौला:</strong>
सभी श्रद्धालुओं/यात्रियों को सूचित किआ जाता है कि,माता मनसा देवी जी का चौला उसी तारीख को पहनाया जायेगा होगा जिस तारीख के लिये माता मनसा देवी जी का चौला आनलईन बुक किआ जायेगा । अगर कोई श्रद्धालु , बुकिंग वाली तारीख को माता मनसा देवी जी का चौला चढ़ाने नही आता है और किसी अन्य तारीख को आता है तो चौला नही चढ़ाया जायेगा और न ही बुकिंग का पैसा वापिस होगा । अत: आप सबको माता मनसा देवी जी का चौला बुकिंग वाली तारीख को प्रातः मंदिर खुलने से या उससे एक दिन पहले मुख्य पुजारी को देना अनिवार्य है । मंदिर खुलने का समय गर्मियो मे सुबह 04:00 बजे व सर्दियों मे सुबह 05:00 बजे होता है।</p>
<p> 
<strong>जरुरी सूचना: </strong>माता मनसा देवी जी के चौले का रंग हरा, काला , नीला, जामुनी नही होना चाहिये ।
</p>
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
