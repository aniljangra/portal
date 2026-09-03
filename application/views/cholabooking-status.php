<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$segment3=$this->uri->segment(3);

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

<style type="text/css">

@media print {

	.hidden_print{display:none;}

	a[href]:after {

        content: none !important;

    }

*{text-shadow:none!important;

	background:transparent!important;

	box-shadow:none!important;

	font-size:15px!important;

	line-height:20px!important;

	color:#000;

	letter-spacing:0px;

	font-family:Arial, Helvetica, sans-serif!important;

}









a, a:visited {

	color:#0000FF!important;

	text-decoration:none!important;

}

a[href]:after {

	content:" (" attr(href) ")"

}

abbr[title]:after {

	content:" (" attr(title) ")"

}

.ir a:after, a[href^="javascript:"]:after, a[href^="#"]:after {

content:""

}

pre, blockquote {

	border:1px solid #999;

	page-break-inside:avoid

}

thead {

	display:table-header-group

}

tr, img {

	page-break-inside:avoid

}

img {

	max-width:100%!important

}

@page {

margin:2cm 1.5cm 3cm 2.5cm; }

p, h2, h3 {

	orphans:3;

	widows:3

}

h2, h3 {

	page-break-after:avoid

}

.navbar {

	display:none

}

.table td, .table th {

	background-color:#fff!important

}

.btn>.caret, .dropup>.btn>.caret {

	border-top-color:#000!important

}

.label {

	border:1px solid #000

}

.table {

	border-collapse:collapse!important

}

.table-bordered th, .table-bordered td {

	border:1px solid #ddd!important

}

 

	 

}

</style>

</head>



<body>

<div class="body">

  <?php include("includes/header.php"); ?>

  <div role="main" class="main">

    <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="e-page-title">

            <h3>Chola Booking Registration Receipt</h3>

          </div>

        </div>

      </div>

      

      <div class="row">

      	<div class="col-md-12">

        	<div class="table-responsive">

               <table  style="width:100%" class="table table-bordered table-striped">

            	 <tr>

                <td width="25%"><strong>Chola Booked For Date</strong></td>

                <td width="60%"  colspan="2"><?php echo date('d-m-Y',strtotime($cbdata->cb_bookfordate)); ?></td>

                

              </tr>

               <tr>

                <td width="25%"><strong>Temple Name</strong></td>

                <td width="60%"  colspan="2"><?php echo $cbdata->cb_templename;  ?></td>

              </tr>

              <tr>

                <td width="25%"><strong>Name</strong></td>

                <td width="60%"><?php echo $cbdata->cb_name; ?></td>

                  <td width="15%" rowspan="4" align="center" valign="middle">

                      <?php $cb_proof=$cbdata->cb_proof;

					  if($cb_proof!=""){ ?>

                        <img src="<?php echo base_url().$cb_proof ?>" style="width:120px;"/>    

                      <?php    } ?>

                      

                      </td>

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

                <td><strong>Service Charge</strong></td>

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

                <td colspan="2">

                

                <?php $cb_transdate=$cbdata->cb_transdate; 

					  		if($cb_transdate!="" && $cb_transdate!="0000-00-00 00:00:00"){

						  		echo date('d-m-Y h:i a',strtotime($cb_transdate));

						  	} 

						   ?>

                

                </td>

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

