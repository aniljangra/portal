<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$segment3=$this->uri->segment(3);
// print_r($tempdata); 
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
      <div class="row">
        <div class="col-md-12">
          <div class="e-page-title">
            <h3>Bhog Booking Details: </h3>
          </div>
        </div>
      </div>
      <?php if(form_error('cb_bookfordate')){ ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo form_error('cb_bookfordate'); ?></div>
        </div>
      </div>
    <?php }?>
    <div class="row">
      <div class="col-md-12">
        <?php echo $this->session->flashdata('datealtaken');;?>
      </div>
    </div>
      <div class="row">
        <div class="col-md-12">
<?php
 $attributes = array('class' => 'create_account verify-ac','method'=>'post','autocomplete'=>'off');               
echo form_open_multipart("online-bhog-booking/overview/$segment3",$attributes);
echo form_hidden('cb_bookfordate',$bhogtemp->cb_bookfordate); 
echo form_hidden('temple_id',$templedata->temple_id);
 
 ?>
          <div class="row">
            <div class="col-md-12">
       
              <table width="100%" class="table table-bordered table-striped table-pro">
              
              <tr>
                  <td width="42%"><strong>Temple</strong></td>
                  <td width="41%"><?php echo  $bhogtemp->temple_name; ?></td>
                 <td rowspan="7" align="center"><img src="<?php echo base_url();?><?php echo  $bhogtemp->cb_proof  ; ?>" width="100px"></td>

                </tr>
              <tr>
                  <td width="42%"><strong>Bhog Booking For</strong></td>
                  <td width="41%"><?php echo  date('d-m-Y',strtotime($bhogtemp->cb_bookfordate)); ?></td>
                  </tr>
                
                <tr>
                  <td width="42%"><strong>Service Charge</strong></td>
                  <td width="41%">Rs. <?php echo $bhogtemp->temple_fee; ?>/- </td>
                  </tr>
               
                
                <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo $bhogtemp->cb_name;  ?></td>
                  
                  </tr>
                <tr>
                  <td><strong>Mobile Number</strong></td>
                  <td><?php echo $bhogtemp->cb_mobile; ?></td>
                  </tr>
                <tr>
                  <td><strong>Aadhaar No.</strong></td>
                  <td><?php echo $bhogtemp->cb_aadhaar; ?></td>
                  </tr>
              <!--  <tr>
                  <td><strong>Email Id</strong></td>
                  <td><?php //echo $bhogtemp->reg_email; ?></td>
                  </tr>-->
               
               
                  
                
              </table>
              
              <?php  if($bhogtemp->cb_othermember=="Yes"){ ?>
           <table width="100%" class="table table-bordered table-striped table-pro">
                      <thead>
                          <tr>
                                <th>Name </th>
                                <th>Mobile Number </th>
                                 <th>Aadhaar Number </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($bhogtemp->cb_member_name1!=""){ ?>
                <tr>
                                <td><?php echo $bhogtemp->cb_member_name1; ?></td>
                                <td><?php echo $bhogtemp->cb_member_mobile1; ?></td>
                                 <td><?php echo $bhogtemp->cb_member_aadhaar1; ?></td>
                             </tr>
            <?php }  ?> 
                        <?php if($bhogtemp->cb_member_name2!=""){ ?>
                <tr>
                                <td><?php echo $bhogtemp->cb_member_name2; ?></td>
                                <td><?php echo $bhogtemp->cb_member_mobile2; ?></td>
                                 <td><?php echo $bhogtemp->cb_member_aadhaar2; ?></td>
                             </tr>
            <?php }  ?> 
                        <?php if($bhogtemp->cb_member_name3!=""){ ?>
                <tr>
                                <td><?php echo $bhogtemp->cb_member_name3; ?></td>
                                <td><?php echo $bhogtemp->cb_member_mobile3; ?></td>
                                 <td><?php echo $bhogtemp->cb_member_aadhaar3; ?></td>
                             </tr>
            <?php }  ?> 
                        <?php if($bhogtemp->cb_member_name4!=""){ ?>
                <tr>
                                <td><?php echo $bhogtemp->cb_member_name4; ?></td>
                                <td><?php echo $bhogtemp->cb_member_mobile4; ?></td>
                                 <td><?php echo $bhogtemp->cb_member_aadhaar4; ?></td>
                             </tr>
            <?php }  ?> 
                           <?php if($bhogtemp->cb_member_name5!=""){ ?>
                <tr>
                                <td><?php echo $bhogtemp->cb_member_name5; ?></td>
                                <td><?php echo $bhogtemp->cb_member_mobile5; ?></td>
                                 <td><?php echo $bhogtemp->cb_member_aadhaar5; ?></td>
                             </tr>
            <?php }  ?> 
                        </tbody>
                      </table>
        <?php } ?>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
            <?php echo form_button(array( 'name'=>'bookBhog','id'=> 'bookBhog','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Pay Now')); ?>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
             <p style="color:#ff0000; margin-top:15px;">On Click Pay Now Button You Will Redirect To Payment Gateway Website</p>
            </div>
          </div>
          </form>
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
</body>
</html>