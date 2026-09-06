<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <style type="text/css">
			.venue_test{line-height:18px; margin-top:0px;}
			.list_note li{line-height:18px;}
			.rollno{font-size:16px;font-weight:600;}
                body {
                    margin:0px;
                    padding:0px;
                    font-family:Arial, Helvetica, sans-serif;
					font-weight:400;
                    font-size:15px
                }
                #main-container {
                    margin:auto;
                    text-align:center;
                    width:780px;
                    border:1px solid #ccc;
                }
                h3 {
                    font-size:15px;
                    line-height:2px;
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
        </head>

        <body>
            <div id="main-container">
                <div id="logo"><img src="<?php echo base_url().$regdata->reg_passphoto;   ?>" width="120" height="144" border="1"/></div>
                <div id="office-use">
                   <strong>Regd. No.</strong> <?php echo $regdata->reg_id; ?><br/>
           </div>
                    
                <br/><h3 style="text-align:center; text-transform:uppercase;">
                	<img src="<?php echo base_url();   ?>assets/print/print_logo.png" style="margin-bottom:10px;"/><br/>
                Government College of Art </h3>
              <h3 style="text-transform:uppercase;">Chandigarh<br/><br/><br/></h3>
              <h3 style="margin-top:10px;"><br/>Common Aptitude Test, 2019 - Admit Card</h3>
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
                        <td><strong><?php echo date('d-m-Y',strtotime($regdata->center_date));  ?>,  Time 09:00 AM</strong></td>
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
        </body>
    </html>

