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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.min.css">
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
            <h3>Registration Step 3:  Upload Photograph & Signature / Documents</h3>
          </div>
        </div>
      </div>
      <?php  if($this->session->flashdata('feedback') && $this->session->flashdata('feedbackerr')){ ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert <?php echo $this->session->flashdata('feedbackerr'); ?>  alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo $this->session->flashdata('feedback'); ?></div>
        </div>
      </div>
      <?php  } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="note_box">
            <p class="attention">Attention</p>
            <ul class="note_list">
              <li>Please upload all document separately  by using upload button against each field. </li>
              <li>Please do not upload photograph in place of signature and signature in place of photograph</li>
              <li>Please upload photograph and signature file(s) in JPG, PNG format only. The documents can be uploaded in JPG/PNG format.</li>
              <li>Please ensure that uploaded photograph is not hazy/blured/unclear</li>
              <li>The file size of Photograph/Signature should be less then  50KB</li>
              <li>Please ensure that the file size of all other documents less then 500KB</li>
            </ul>
          </div>
        </div>
      </div>
      <?php	
	$attributes=array('class' => 'regform','method'=>'post','id'=>'instAddForm','name'=>'instAddForm','autocomplete'=>'off');   
	echo form_open_multipart('student/registration-step3',$attributes);
	echo form_hidden('old_regno',$regdata->reg_id);
	?>
      <div class="row">
        <div class="col-md-12">
          <div class="confirm-doc-box">
            <div class="row">
              <div class="col-md-12">
                <p class="noteinfo">Before submission of <strong>Step 3 (Upload Document)</strong> please check the  all the document by clicking preview  to avoid mistake. Please note that the document  below will not available for editing once you click on submit button.</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"> <?php echo form_checkbox('reg_confirm_step3','1',set_checkbox('reg_confirm_step3',"1")); ?> I have verified all the details entered by me in Registration Step 3 form and wish to submit the same. </div>
              <div class="col-md-12  form-group"> <?php echo form_error('reg_confirm_step3'); ?> </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group"> <?php echo form_button(array( 'name'=>'substep3','id'=> 'substep3','value'=> 'true','class'=>'btn btn_custom_step1 btn-primary','type'=> 'submit','content' => 'Submit All Document')); ?> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info docup">
            <div class="panel-heading">
              <label>Welcome: <span>
                <?php 

				$reg_name=$regdata->reg_firstname; if($regdata->reg_middlename!=""){  $reg_name.=" ".$regdata->reg_middlename; }

				if($regdata->reg_lastname!=""){  $reg_name.=" ".$regdata->reg_lastname; } echo $reg_name; ?>
                </span><br>
                Application No. :<span> <?php echo $regdata->reg_id; ?> </span></label>
            </div>
            <div class="panel-body regpre">
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Student Passport Photo <span class="note">(JPG or PNG, Max. 50KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(
                    'name'  => 'reg_passphoto',
                    'id'    => 'reg_passphoto',
                    'type'  => 'file',
                    'class' => "form-control",
                    'value' =>set_value('reg_passphoto')));
                    ?> <span class="error">
                            <?php if(isset($error1)){ echo $error1; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit1','id'=> 'submit1','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                        	
                          <?php if($regdata->reg_passphoto!=""){ $reg_passphoto=$regdata->reg_passphoto;   ?>
                          <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_passphoto; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Photograph Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
            <label>Student Signature <span class="note">(JPG or PNG, Max. 50KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(
                    'name'  => 'reg_stusign',
                    'id'    => 'reg_stusign',
                    'type'  => 'file',
                    'class' => "form-control",
                    'value' =>set_value('reg_stusign')));
                    ?> <span class="error">
                            <?php if(isset($error2)){ echo $error2; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit2','id'=> 'submit2','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                       
                          <?php if($regdata->reg_stusign!=""){ $reg_stusign=$regdata->reg_stusign;   ?>
                           <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_stusign; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Signature Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Father Signature <span class="note">(JPG or PNG, Max. 50KB)</span> <span class="req">*</span></label>
                  <?php echo form_input(array(
                    'name'  => 'reg_fathersign',
                    'id'    => 'reg_fathersign',
                    'type'  => 'file',
                    'class' => "form-control",
                    'value' =>set_value('reg_fathersign')));
                    ?> <span class="error">
                            <?php if(isset($error3)){ echo $error3; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit3','id'=> 'submit3','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                        
                          <?php if($regdata->reg_fathersign!=""){ $reg_fathersign=$regdata->reg_fathersign;   ?>
                          <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_fathersign; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Father's Signature Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Marks Sheet of 10th <span class="note">(JPG or PNG, Max. 500KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(
                    'name'  => 'reg_matriccerti',

                    'id'    => 'reg_matriccerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_matriccerti')));

                    ?> <span class="error">
                            <?php if(isset($error4)){ echo $error4; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit4','id'=> 'submit4','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                       
                          <?php if($regdata->reg_matriccerti!=""){ $reg_matriccerti=$regdata->reg_matriccerti;   ?>
                           <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_matriccerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">10th Certificate Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($regdata->reg_course==1){ ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Marks Sheet of 10+2 <span class="note">(JPG or PNG, Max. 500KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_twelvecerti',

                    'id'    => 'reg_twelvecerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_twelvecerti')));

                    ?> <span class="error">
                            <?php if(isset($error5)){ echo $error5; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit5','id'=> 'submit5','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                       
                          <?php if($regdata->reg_twelvecerti!=""){ $reg_twelvecerti=$regdata->reg_twelvecerti;   ?> <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_twelvecerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">10+2 Certificate Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Date of Birth Certificate <span class="note">(Matric Marksheet or Other, JPG or PNG, Max. 500KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_dobcerti',

                    'id'    => 'reg_dobcerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_dobcerti')));

                    ?> <span class="error">
                            <?php if(isset($error6)){ echo $error6; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit6','id'=> 'submit6','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                        
                          <?php if($regdata->reg_dobcerti!=""){ $reg_dobcerti=$regdata->reg_dobcerti;   ?>
                          <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_dobcerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Date of Birth Certificate Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Character Certificate from School/College <span class="note">(In case of any gap period, the same must be accounted for by submitting an affidavit attested by the Notary Public/Oath Commissioner, JPG or PNG, Max. 500KB)</span> <span class="req">*</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_charactercerti',

                    'id'    => 'reg_charactercerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_charactercerti')));

                    ?> <span class="error">
                            <?php if(isset($error7)){ echo $error7; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit7','id'=> 'submit7','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                        
                          <?php if($regdata->reg_charactercerti!=""){ $reg_charactercerti=$regdata->reg_charactercerti;   ?>
                          <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_charactercerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Character Certificate Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Category Certificate <span class="note">(Documentary Proof in support of reservation claimed under SC/ST or any other reserved category; and , JPG or PNG, Max. 500KB)</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_catcerti',

                    'id'    => 'reg_catcerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_catcerti')));

                    ?> <span class="error">
                            <?php if(isset($error8)){ echo $error8; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit8','id'=> 'submit8','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                       
                          <?php if($regdata->reg_catcerti!=""){ $reg_catcerti=$regdata->reg_catcerti;   ?>
                           <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_catcerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Category Certificate Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Registration Card <span class="note">(In case of only those candidates who are already registered with any University , JPG or PNG, Max. 500KB)</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_regcardcerti',

                    'id'    => 'reg_regcardcerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_regcardcerti')));

                    ?> <span class="error">
                            <?php if(isset($error9)){ echo $error9; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit9','id'=> 'submit9','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                        
                          <?php if($regdata->reg_regcardcerti!=""){ $reg_regcardcerti=$regdata->reg_regcardcerti;   ?>
                          <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <a href="<?php echo base_url().$reg_regcardcerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Registration Certificate  Preview</a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="doxbox">
                    <div class="row">
                      <div  class="col-md-7">
                        <div class="row">
                          <div class="col-md-12 form-group">
                            <label>Disabilities Certificate
                              <?php if($regdata->reg_course==2){?>
                              <span class="req">*</span>
                              <?php  }?>
                              <span class="note">(Certificate issued by Principal Medical Officer /Civil Surgeon of Chandigarh or his/her concerned district indicating percentage of disability in respect of Persons with Disabilities for 'DFAD' courses and other reserved seats for Persons with Disabilities students , JPG or PNG, Max. 500KB)</span></label>
                            <?php echo form_input(array(

                    'name'  => 'reg_disabcerti',

                    'id'    => 'reg_disabcerti',

                    'type'  => 'file',

                    'class' => "form-control",

                    'value' =>set_value('reg_disabcerti')));

                    ?> <span class="error">
                            <?php if(isset($error10)){ echo $error10; } ?>
                            </span> </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12"> <?php echo form_button(array( 'name'=>'submit10','id'=> 'submit10','value'=> 'true','class'=>'btn btn_upload btn-primary','type'=> 'submit','content' => 'Upload')); ?> </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="doc_preview">
                       
                          <?php if($regdata->reg_disabcerti!=""){ $reg_disabcerti=$regdata->reg_disabcerti;   ?>
                          <a href="<?php echo base_url().$reg_disabcerti; ?>" class="lightbox" data-plugin-options="{'type':'image'}">Disabilities Certificate   Preview</a>
                           <div class="docpg"><i class="fas fa-check-circle"></i></div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> </div>
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
<script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
</body>
</html>
