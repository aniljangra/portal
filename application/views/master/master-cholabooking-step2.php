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
            <li class="breadcrumb-item active" aria-current="page">Chola Booking</li>
          </ol>
        </nav>
        <div class="d-sm-flex align-items-center justify-content-between">
          <h1 class="h3 mb-0 text-gray-800 mb-2">Chola Booking Step 2-2</h1>
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
 $attributes = array('class' => 'create_account verify-ac','method'=>'post','autocomplete'=>'off');   						
echo form_open_multipart("master/chola-booking/overview/$segment4",$attributes);
echo form_hidden('cb_bookfordate',$cholatemp->cb_bookfordate); 
echo form_hidden('temple_id',$templedata->temple_id);
 
 ?>
          <div class="row">
            <div class="col-md-12">
       
              <table width="100%" class="table table-bordered table-striped table-pro">
              
              <tr>
                  <td width="42%"><strong>Temple</strong></td>
                  <td width="41%"><?php echo  $cholatemp->temple_name; ?></td>
                 <td rowspan="7" align="center"><img src="<?php echo base_url();?><?php echo  $cholatemp->cb_proof  ; ?>" width="100px"></td>

                </tr>
              <tr>
                  <td width="42%"><strong>Chola Booking For</strong></td>
                  <td width="41%"><?php echo  date('d-m-Y',strtotime($cholatemp->cb_bookfordate)); ?></td>
                  </tr>
                
                <tr>
                  <td width="42%"><strong>Service Charge</strong></td>
                  <td width="41%">Rs. <?php echo $cholatemp->temple_fee; ?>/- </td>
                  </tr>
               
                
                <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo $cholatemp->cb_name;  ?></td>
                  
                  </tr>
                <tr>
                  <td><strong>Mobile Number</strong></td>
                  <td><?php echo $cholatemp->cb_mobile; ?></td>
                  </tr>
                <tr>
                  <td><strong>Aadhaar No.</strong></td>
                  <td><?php echo $cholatemp->cb_aadhaar; ?></td>
                  </tr>
              <!--  <tr>
                  <td><strong>Email Id</strong></td>
                  <td><?php //echo $cholatemp->reg_email; ?></td>
                  </tr>-->
               
               
                  
                
              </table>
              
              <?php  if($cholatemp->cb_othermember=="Yes"){ ?>
					 <table width="100%" class="table table-bordered table-striped table-pro">
                     	<thead>
                        	<tr>
                                <th>Name </th>
                                <th>Mobile Number </th>
                                 <th>Aadhaar Number </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($cholatemp->cb_member_name1!=""){ ?>
								<tr>
                                <td><?php echo $cholatemp->cb_member_name1; ?></td>
                                <td><?php echo $cholatemp->cb_member_mobile1; ?></td>
                                 <td><?php echo $cholatemp->cb_member_aadhaar1; ?></td>
                           	 </tr>
						<?php }  ?>	
                        <?php if($cholatemp->cb_member_name2!=""){ ?>
								<tr>
                                <td><?php echo $cholatemp->cb_member_name2; ?></td>
                                <td><?php echo $cholatemp->cb_member_mobile2; ?></td>
                                 <td><?php echo $cholatemp->cb_member_aadhaar2; ?></td>
                           	 </tr>
						<?php }  ?>	
                        <?php if($cholatemp->cb_member_name3!=""){ ?>
								<tr>
                                <td><?php echo $cholatemp->cb_member_name3; ?></td>
                                <td><?php echo $cholatemp->cb_member_mobile3; ?></td>
                                 <td><?php echo $cholatemp->cb_member_aadhaar3; ?></td>
                           	 </tr>
						<?php }  ?>	
                        <?php if($cholatemp->cb_member_name4!=""){ ?>
								<tr>
                                <td><?php echo $cholatemp->cb_member_name4; ?></td>
                                <td><?php echo $cholatemp->cb_member_mobile4; ?></td>
                                 <td><?php echo $cholatemp->cb_member_aadhaar4; ?></td>
                           	 </tr>
						<?php }  ?>	
                           <?php if($cholatemp->cb_member_name5!=""){ ?>
								<tr>
                                <td><?php echo $cholatemp->cb_member_name5; ?></td>
                                <td><?php echo $cholatemp->cb_member_mobile5; ?></td>
                                 <td><?php echo $cholatemp->cb_member_aadhaar5; ?></td>
                           	 </tr>
						<?php }  ?>	
                        </tbody>
                      </table>
				<?php } ?>
             
            </div>
          </div>
          <div class="row">
          	<div class="col-md-12">
            <?php echo form_button(array( 'name'=>'bookChola','id'=> 'bookChola','value'=> 'true','class'=>'btn btn_custom_yl btn-primary','type'=> 'submit','content' => 'Pay Now')); ?>

            </div>
          </div>
          <div class="row">
          	<div class="col-md-12">
             <p style="color:#ff0000; margin-top:15px;">On Click Pay Now Button You Will Redirect To Payment Gateway Website</p>
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
$('#cb_bookfordate').datepicker({
    dateFormat:'dd-mm-yy',
	changeYear: true,
	changeMonth: true,
	yearRange: "-50:+0",
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
