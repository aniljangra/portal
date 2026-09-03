<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$cholaaccess=$this->session->userdata('cholaaccess');

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
<link href="<?php echo base_url(); ?>assets/master/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include("includes/sidebar.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include("includes/top-nav.php"); ?>
      <div class="conatiner-fluid">
        <div class="container">
        <div class="row">
            <?php if($cholaaccess==0){?>
            <div class="col-md-4 text-center  ">  
            <div class="card" style="width: 18rem; height:100px;">
            <a href="<?php echo site_url();?>master/manage/mata-mansa-devi/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/mansa_pic3.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Shri Mata Mansa Devi Mandir</h5>                    
                </div>
                </a>
                </div> 
            </div>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/patiala-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/kaali-mandir.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Patiala Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/sati-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/sati-mata-mandir.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Sati Mata Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <div class="col-md-4 text-center mt-5 ">
            <div class="card" style="width: 18rem;height:100px;margin-top: 40%;">
            <a href="<?php echo site_url();?>master/manage/kali-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/kalimata-kalka.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Shri Kali Mata Mandir Kalka</h5>                    
                </div></a>
                </div>
            </div>
            <div class="col-md-4 text-center mt-5 ">
            <div class="card" style="width: 18rem;height:100px;margin-top: 40%;">
            <a href="<?php echo site_url();?>master/manage/chandi-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/chandi-mandir-chandigarh.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Chandi Mata Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <?php }?>
            <?php if($cholaaccess==1){?>
            <div class="col-md-4 text-center  ">  
            <div class="card" style="width: 18rem; height:100px;">
            <a href="<?php echo site_url();?>master/manage/mata-mansa-devi/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/mansa_pic3.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Shri Mata Mansa Devi Mandir</h5>                    
                </div>
                </a>
                </div> 
            </div>
            <?php }
            elseif($cholaaccess==2){?>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/patiala-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/kaali-mandir.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Patiala Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <?php }
            elseif($cholaaccess==3){?>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/sati-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/sati-mata-mandir.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Sati Mata Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <?php }
           elseif($cholaaccess==4){?>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/kali-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/kalimata-kalka.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Shri Kali Mata Mandir Kalka</h5>                    
                </div></a>
                </div>
            </div>
            <?php }elseif($cholaaccess==5){?>
            <div class="col-md-4 text-center  ">
            <div class="card" style="width: 18rem;height:100px;">
            <a href="<?php echo site_url();?>master/manage/chandi-mata-mandir/chola_booking">
                <img class="card-img-top" src="<?=site_url();?>assets/img/chandi-mandir-chandigarh.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Chandi Mata Mandir</h5>                    
                </div></a>
                </div>
            </div>
            <?php }?>
        </div>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </div>
</div>
<?php include("includes/common-footer.php"); ?>
<?php include("includes/style-footer.php"); ?>
<script src="<?php echo base_url(); ?>assets/master/vendor/datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/master/vendor/datatables/dataTables.bootstrap4.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/master/js/demo/datatables-demo.js"></script> 
<script type="text/javascript">

$(document).ready(function() {

    $('#dataTbChola').DataTable({

                    "language": {

                        "searchPlaceholder": "Search",

                    },

                    "ordering": true,

                    columnDefs: [{

                        orderable: false,

                        targets: "no-sort"

                    }]

                });

} );

</script>
</body>
</html>
