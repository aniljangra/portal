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
        
          <div class="row">
            <div class="col-md-12">
       
              <table  style="width:100%" class="table table-bordered table-striped">
            	 <tr>
                <td width="25%"><strong>Booked For Date</strong></td>
                <td width="60%"><?php echo date('d-m-Y',strtotime($cbdata->cb_bookfordate)); ?></td>
                  <td width="15%" rowspan="6" align="center" valign="middle">
                      <?php $cb_proof=$cbdata->cb_proof;
					  if($cb_proof!=""){ ?>
                        <img src="<?php echo base_url().$cb_proof ?>" style="width:120px;"/>    
                      <?php    } ?>
                      
                      </td>
              </tr>
               <tr>
                <td width="25%"><strong>Temple Name</strong></td>
                <td width="60%"><?php echo $cbdata->temple_name;  ?></td>
              </tr>
              <tr>
                <td width="25%"><strong>Name</strong></td>
                <td width="60%"><?php echo $cbdata->cb_name; ?></td>
              </tr>
              <tr>
                <td><strong>Mobile</strong></td>
                <td><?php echo $cbdata->cb_mobile; ?></td>
              </tr>
              <tr>
                <td><strong>Email Id</strong></td>
                <td><?php echo $cbdata->cb_email; ?></td>
              </tr>
               <tr>
                <td><strong><strong>Service Charge</strong></strong></td>
                <td>Rs. <?php echo $cbdata->cb_amount; ?></td>
              </tr>
              <tr>
                <td><strong>Transaction Status</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_transstatus; ?></td>
              </tr>
               
               <tr>
                <td><strong>Bank Ref. Number</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_bankrefno; ?></td>
              </tr>
              <tr>
                <td><strong>Status Detail</strong></td>
                <td  colspan="2"><?php echo $cbdata->cb_statusdesc ; ?></td>
              </tr>
               <tr>
                <td><strong>Transaction Date</strong></td>
                <td colspan="2"><?php echo $cbdata->cb_transdate; ?></td>
              </tr>
            </table>
  				<?php if($cbdata->cb_othermember=="Yes"){?>
                  <table style="width:100%" class="table table-bordered table-striped table-trans">
                    <thead>
               
                    <tr>
                      <th width="28%"><strong> Member Name</strong></th>
                      <th width="31%"><strong> Member Mobile</strong></th>
                      <th width="41%"><strong> Member Aadhaar No.</strong></th>
                   </tr>
                    </thead>
                    <tbody>
                    <?php if($cbdata->cb_devotee_name1!=""){?>
                    <tr>
                    <td><?php echo $cbdata->cb_devotee_name1;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_mobile1;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_aadhar1;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cbdata->cb_devotee_name2!=""){?>
                    <tr>
                    <td><?php echo $cbdata->cb_devotee_name2;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_mobile2;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_aadhar2;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cbdata->cb_devotee_name3!=""){?>
                    <tr>
                      
                      <td><?php echo $cbdata->cb_devotee_name3;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_mobile3;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_aadhar3;  ?></td>
                    </tr>
                    <?php }?>
                    <?php if($cbdata->cb_devotee_name4!=""){?>
                    <tr>
                      
                      <td><?php echo $cbdata->cb_devotee_name4;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_mobile4;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_aadhar4;  ?></td>
                    </tr>
                    <?php }?>
                   <?php if($cbdata->cb_devotee_name5!=""){?>
                    <tr>
                      
                      <td><?php echo $cbdata->cb_devotee_name5;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_mobile5;  ?></td>
                      <td><?php echo $cbdata->cb_devotee_aadhar5;  ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                  </table>
                   <?php } ?>
              
             
             
            </div>
          </div>
          
          
       
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
