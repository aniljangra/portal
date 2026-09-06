<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admit Card</title>
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
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js"></script>
<style type="text/css">
			.venue_test{line-height:18px; margin-top:0px;}
			.list_note li{line-height:18px;}
			.rollno{font-size:16px;font-weight:600;}
			#main-container ol li{margin-bottom:4px;}
                #main-container p{color:#000; margin-bottom:0px!important;}
                #main-container{
                    margin:0px auto;
                    text-align:center;
                    width:780px;
                    border:1px solid #ccc;
					color:#000!important;
					 font-size:15px;
					 font-family:Arial, Helvetica, sans-serif!important;
					  
                    padding:0px;
					
                }
                #main-container h3 {
                    font-size:15px;
                    line-height:2px;
					font-weight:600;
					margin-bottom:13px;
                    margin-left:-60px
                }
				#main-container h4 {
                    font-size:15px;
                    line-height:2px;
					font-weight:600;
					margin-bottom:0px;
                    margin-left:-60px
                }
                #office-use {
                    position:absolute;
                    margin-left:543px;
                   
                    width:216px;
                    font-size:14px;
					padding:10px;
					text-align:left;
                    line-height: 160%;
                }
                table.main-data {
                    font-size:14px;
                    text-align:left;
                    vertical-align:top;
                    line-height:23px
                }
                table.main-data td{vertical-align:top;}
                .small {
                    font-size:0.8em
                }
                #logo {
                    position:absolute;
                    margin-left:40px;
                    margin-top:10px;
                }
                @media all
                {
                    .pagebreak  { height:3px }
                }

                @media print
                {
                    .pagebreak  { display:block; page-break-before:always; }
                }
            </style>
            <script>
$(document).ready(function(){
    $("#printButton").click(function(){
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.printableArea").printArea( options );
    });
});
</script>
</head>

<body>
<div class="body">
  <?php include("includes/header.php"); ?>
  <div role="main" class="main">
    <div class="container">
      <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
                      </div>
                    </div>
                    <?php  } ?>
    <?php 
      $reg_id=$regdata->reg_id;	
			$regid_enc=$this->encryptcode->encrypt($reg_id,ENC_KEY_PASS);
			?>
      <div class="row">
        <div class="col-md-12">
          	<div id="main-container" class="printableArea">
                <div id="logo"><img src="<?php echo base_url().$regdata->reg_passphoto;   ?>" width="120" height="144" border="1"/></div>
                <div id="office-use">
                   <strong>Regd. No.</strong> <?php echo $regdata->reg_id; ?><br/>
           </div>
                    
                <br/><h3 style="text-align:center; text-transform:uppercase;">
                	<img src="<?php echo base_url();   ?>assets/print/print_logo.png" style="margin-bottom:10px;"/><br/>
                Government College of Art </h3>
              <h3 style="text-transform:uppercase;">Chandigarh<br/><br/><br/></h3>
              <h4 style="margin-top:15px;"><br/>Common Aptitude Test, 2019 - Admit Card</h4>
              <!--  <h3><br/>Admit Card</h3>-->
                
                <br/>
                <table class="main-data" align="center" style="width:750px" border="0" cellpadding="4px">
              
   	  <tr>
                        <td width="330" style="width:300px"> <strong>Roll No.</strong></td>
                        <td width="18" style="width:10px">:</td>
                        <td width="370" style="width:370px"><span class="rollno"><?php echo $regdata->reg_rollno; ?></span></td>
                    </tr>
                	<tr>
                        <td width="330" style="width:300px"> <strong>Course</strong></td>
                        <td width="18" style="width:10px">:</td>
                        <td width="370" style="width:370px"><?php echo $regdata->course_name; ?></td>
                    </tr>
                    <tr>
                        <td width="330" style="width:300px"> <strong>Pool</strong></td>
                        <td width="18" style="width:10px">:</td>
                        <td width="370" style="width:370px"><?php echo $regdata->reg_pool; ?></td>
                    </tr>
                
                    
                <tr>
                        <td style="width:300px"><strong>Name of Applicant</strong></td>
                        <td style="width:10px">:</td>
                        <td style="width:370px"><strong>
                        <?php $reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){  $reg_name.=" ".$regdata->reg_middlename; }
				if($regdata->reg_lastname!=""){  $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name;  ?>
                    </strong></td>
                    </tr>
                    <tr>
                        <td width="330" style="width:300px"> <strong>Father's Name</strong></td>
                        <td width="18" style="width:10px">:</td>
                        <td width="370" style="width:370px"><?php echo $regdata->reg_fathername; ?></td>
                    </tr>
                    <tr>
                        <td><strong> Venue</strong></td>
                        <td>:</td>
                        <td><p class="venue_test">Govt. College of Art, Sector 10 C, Near Government Museum and Art Gallery, U.T. Chandigarh, 160011</p></td>
                    </tr>
                     <tr>
                        <td><strong>Date of Aptitude Test</strong></td>
                        <td>:</td>
                        <td><strong><?php echo date('d-m-Y',strtotime($regdata->center_date));  ?>, Time 09:00 AM</strong></td>
                    </tr>
                  <?php if($regdata->reg_course==1){ ?>
                   <?php }if($regdata->reg_course==2){ ?>
                   <?php } ?>
                </table>
              <hr/>
                <table class="main-data" align="center" style="width:750px" border="0" cellpadding="4px">
                   
                  
                    <tr>
              <td valign="top" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24%"><img src="<?php echo base_url().$regdata->reg_stusign; ?>" border="0" width="160" height="60" /></td>
                    <td width="45%" style="text-align:center;"><img src="<?php echo base_url(); ?>assets/print/chairmain_signature.png" border="0" width="160" height="60" /></td>
                    <td width="31%" align="center"><img src="<?php echo base_url(); ?>assets/print/principal_signature.png" border="0" width="160" height="60" /></td>
                  </tr>
                  <tr>
                    <td width="24%" style="font-size:14px;"><strong>Sign. of Applicant</strong></td>
                    <td width="45%" align="center"><span style="font-size:14px;"><strong>Chairman, Scrutiny Committee</strong></span></td>
                    <td width="31%" align="center" style="font-size:14px;"><strong>Principal Signature</strong></td>
                  </tr>
                </table></td>
            </tr>
              <tr><td colspan="2" style="text-align:justify">
                            <p><strong>Note*</strong></p>
                           
                <ol style="margin-left:14px; padding:0px;" class="list_note">
<li>This card  is to be preserved by the candidate and shown on demand on the day of aptitude test.</li>
                                <li>The medium of instruction will be English only for the aptitude test.</li>
                                <li>One good quality white drawing sheet of 1/2 imperial size will be provided by the College. All other material like Drawing Board (1/2 imperial size), colours, fevicol, scissors, scale & rubber should be brought by the candidates of their own while coming for the aptitude test.</li>
                                <li>Candidates are advised to report at 08:30AM</li>
							</ol>
                        </td>
                    </tr>
                </table>
                 <hr/>
               
                
 			
                
			
                
                
                
            </div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12 text-center"><a href="<?php echo site_url("student/print-admitcard/$regid_enc"); ?>" style="background:#A64110; color:#fff; padding:6px 10px; border:1px solid #D84D08;">Print Page</a>  </div>
      <!--	<div class="col-md-12"><a href="javascript:void(0);" id="printButton">Print</a>  </div>-->
      </div>
      
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>
</div>

<!-- Vendor --> 



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
