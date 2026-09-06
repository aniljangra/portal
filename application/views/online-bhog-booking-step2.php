<?php defined('BASEPATH') OR exit('No direct script access allowed');

$segment3 = $this->uri->segment(3);

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

.rowhead{
    background:#a3070a;
    color:#fff;
    padding:5px 10px;
    margin-bottom:10px;
    margin-top:5px;
    text-transform:uppercase;
    font-weight:600;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */

input[type=number] {
    -moz-appearance: textfield;
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

<h3>Bhog Booking</h3>

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

echo form_open_multipart(
    "online-bhog-booking/step2/$segment3",
    $attributes
);

echo form_hidden('temple_id', $templedata->temple_id);

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

<div class="form-group col-md-12 col-sm-12 col-xs-12">

<label>
Temple <span class="req">*</span>

<a href="<?php echo site_url("online-bhog-booking/step1"); ?>"
style="font-size:12px; text-decoration:underline;">
Change Temple </a>

</label>

<?php echo form_input(array(

    'name'  => 'cb_templename',

    'id'    => 'cb_templename',

    'type'  => 'text',

    'readonly' => 'true',

    'class' => "form-control",

    'value' => set_value(
        'cb_templename',
        $templedata->temple_name
    )

));

?>

<?php echo form_error('cb_templename'); ?>

</div>

</div>

<div class="row">

<div class="form-group col-md-6 col-sm-12 col-xs-12">

<label>
Date <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name'  => 'cb_bookfordate',

    'id'    => 'cb_bookfordate',

    'type'  => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_bookfordate')

));

?>

<?php echo form_error('cb_bookfordate'); ?>

</div>

<div class="form-group col-md-6 col-sm-12 col-xs-12">

<label>
Name as per Aadhaar Card <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name'  => 'cb_name',

    'id'    => 'cb_name',

    'type'  => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_name')

));

?>

<?php echo form_error('cb_name'); ?>

</div>

<div class="form-group col-md-6 col-sm-12 sol-xs-12">

<label>
Aadhaar No. <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_aadhaar',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_aadhaar')

));

?>

<?php echo form_error('cb_aadhaar'); ?>

</div>

<div class="form-group col-md-6 col-sm-12 sol-xs-12">

<label>
Mobile Number
<span class="note">[OTP will be sent to this number]</span>
<span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_mobile',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_mobile')

));

?>

<?php echo form_error('cb_mobile'); ?>

</div>

<div class="form-group col-md-6 col-sm-12 sol-xs-12">

<label>
Devotee Passport Size Photograph
<span class="note">[Less than 500kb]</span>
<span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_proof',

    'type' => 'file',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_proof')

));

?>

<?php echo form_error('cb_proof'); ?>

<?php if(isset($error3)){ ?>

<span class="error">
<?php echo $error3; ?>
</span>

<?php } ?>

</div>

<div class="form-group col-md-6 col-sm-12 sol-xs-12">

<label>
Have Other Member? <span class="req">*</span>
</label>

<select class="form-control cb_othermember" name="cb_othermember">

<option value="No"
<?php echo set_select('cb_othermember', "No"); ?>>
No
</option>

<option value="Yes"
<?php echo set_select('cb_othermember', "Yes"); ?>>
Yes
</option>

</select>

<?php echo form_error('cb_othermember'); ?>

</div>

</div>

<div class="row othermember">

<div class="col-md-12">

<div class="rowhead">
Other Member Details
</div>

</div>

</div>

<div class="row othermember">

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>
1. Member Name <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_member_name1',

    'type' => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_member_name1')

));

?>

<?php echo form_error('cb_member_name1'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>
Member Mobile <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_member_mobile1',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_member_mobile1')

));

?>

<?php echo form_error('cb_member_mobile1'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>
Member Aadhaar No. <span class="req">*</span>
</label>

<?php echo form_input(array(

    'name' => 'cb_member_aadhaar1',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_member_aadhaar1')

));

?>

<?php echo form_error('cb_member_aadhaar1'); ?>

</div>

</div>

<div class="row othermember">

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>2. Member Name</label>

<?php echo form_input(array(

    'name' => 'cb_member_name2',

    'type' => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_member_name2')

));

?>

<?php echo form_error('cb_member_name2'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Mobile</label>

<?php echo form_input(array(

    'name' => 'cb_member_mobile2',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_member_mobile2')

));

?>

<?php echo form_error('cb_member_mobile2'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Aadhaar No.</label>

<?php echo form_input(array(

    'name' => 'cb_member_aadhaar2',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_member_aadhaar2')

));

?>

<?php echo form_error('cb_member_aadhaar2'); ?>

</div>

</div>

<div class="row othermember">

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>3. Member Name</label>

<?php echo form_input(array(

    'name' => 'cb_member_name3',

    'type' => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_member_name3')

));

?>

<?php echo form_error('cb_member_name3'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Mobile</label>

<?php echo form_input(array(

    'name' => 'cb_member_mobile3',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_member_mobile3')

));

?>

<?php echo form_error('cb_member_mobile3'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Aadhaar No.</label>

<?php echo form_input(array(

    'name' => 'cb_member_aadhaar3',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_member_aadhaar3')

));

?>

<?php echo form_error('cb_member_aadhaar3'); ?>

</div>

</div>

<div class="row othermember">

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>4. Member Name</label>

<?php echo form_input(array(

    'name' => 'cb_member_name4',

    'type' => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_member_name4')

));

?>

<?php echo form_error('cb_member_name4'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Mobile</label>

<?php echo form_input(array(

    'name' => 'cb_member_mobile4',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_member_mobile4')

));

?>

<?php echo form_error('cb_member_mobile4'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Aadhaar No.</label>

<?php echo form_input(array(

    'name' => 'cb_member_aadhaar4',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_member_aadhaar4')

));

?>

<?php echo form_error('cb_member_aadhaar4'); ?>

</div>

</div>

<div class="row othermember">

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>5. Member Name</label>

<?php echo form_input(array(

    'name' => 'cb_member_name5',

    'type' => 'text',

    'placeholder' => '',

    'class' => "form-control",

    'value' => set_value('cb_member_name5')

));

?>

<?php echo form_error('cb_member_name5'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Mobile</label>

<?php echo form_input(array(

    'name' => 'cb_member_mobile5',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 10,

    'class' => "form-control",

    'value' => set_value('cb_member_mobile5')

));

?>

<?php echo form_error('cb_member_mobile5'); ?>

</div>

<div class="form-group col-md-4 col-sm-12 sol-xs-12">

<label>Member Aadhaar No.</label>

<?php echo form_input(array(

    'name' => 'cb_member_aadhaar5',

    'type' => 'text',

    'placeholder' => '',

    'maxlength' => 12,

    'class' => "form-control",

    'value' => set_value('cb_member_aadhaar5')

));

?>

<?php echo form_error('cb_member_aadhaar5'); ?>

</div>

</div>

<div class="row">

<div class="form-group col-md-12">

<?php echo form_button(array(

    'name' => 'regsubmit',

    'id' => 'regsubmit',

    'value' => 'true',

    'class' => 'btn btn_custom_yl btn-primary',

    'type' => 'submit',

    'content' => 'Proceed Now'

)); ?>

</div>

</div>

<div class="row">

<div class="col-md-12">

<!--
<p class="notetext">
Note: On click proceed now you will get payment overview and payment link
</p>
-->

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

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    toggleFields();

    $(".cb_othermember").change(function() {

        toggleFields();

    });

});


function toggleFields(){

    if($(".cb_othermember").val() == "Yes"){

        $('.othermember').show();

    }else{

        $('.othermember').hide();

    }

}

</script>

<script type="text/javascript">

<?php

$date_booked = "";

$count_booked = count($bh_datebooked);

if($count_booked > 0){

    $sr = 1;

    foreach($bh_datebooked as $bhogrow){

        $date_book = '"' . $bhogrow->cb_bookfordate . '"';

        if($sr == 1){

            $date_booked = $date_book;

        }else{

            $date_booked = $date_booked . "," . $date_book;

        }

        $sr++;

    }

}


$count_inactive = count($bh_inactivedate);

if($count_inactive > 0){

    $in_sr = 1;

    foreach($bh_inactivedate as $bh_inactiverow){

        $date_book = '"' . $bh_inactiverow->dset_date . '"';

        if($in_sr == 1){

            if(empty($date_booked)){

                $date_booked = $date_book;

            }else{

                $date_booked = $date_booked . "," . $date_book;

            }

        }else{

            $date_booked = $date_booked . "," . $date_book;

        }

        $in_sr++;

    }

}


$count_process = count($bh_processdate);

if($count_process > 0){

    $cp_sr = 1;

    foreach($bh_processdate as $bh_processrow){

        $date_book = '"' . $bh_processrow->cb_bookfordate . '"';

        if($cp_sr == 1){

            if(empty($date_booked)){

                $date_booked = $date_book;

            }else{

                $date_booked = $date_booked . "," . $date_book;

            }

        }else{

            $date_booked = $date_booked . "," . $date_book;

        }

        $cp_sr++;

    }

}

?>

var array = [<?php echo $date_booked; ?>];

$('#cb_bookfordate').datepicker({

    minDate: 1,

    //maxDate: "+6M",

    maxDate: 45,

    dateFormat: 'dd-mm-yy',

    beforeShowDay: function(date){

        var d = new Date();

        console.log(date);

        var string = jQuery.datepicker.formatDate(
            'yy-mm-dd',
            date
        );

        return [array.indexOf(string) == -1];

    }

});

</script>

</body>

</html>
