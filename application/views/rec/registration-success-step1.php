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
<div role="main" class="main registration-page">
  <div class="container">
  <div class="row">
  	<div class="col-md-12">
    	<div class="page-title">
    	<h2>Registration Confirmation</h2>
    	</div>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-12">
    	<div class="reg_success_box">
    	<p class="text-center">An email has been sent to your registered E-mail ID with your unique application number. Please login with your Application No. as mentioned in the mail and Password entered by you to complete the remaining registration process. <br /><br />Your Application Number : <?php echo $regdata->reg_id; ?> </p><p class="text-center">Click on the link below to login</p> <p class="text-center"><a href="<?php echo site_url("student/login"); ?>" class="reglogin_back">&raquo; Click here to  login</a></p>
   	</div>
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
