<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cholapage_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Cholaweb_model','cholamod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function chola_booking_step(){
		$arr['siteTitle']="Chola Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		}
		$current_time=date("Y-m-d H:i:s");
		/*if($current_time<CHOLA_LAUNCH_DATE){
			$this->session->set_flashdata('feedback',"Online Chola Booking stopped  temporarily please check after some time");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("dashboard");
		}*/
			/*if($custsesid!=523){
				redirect('dashboard');
			}*/
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');
			$this->form_validation->set_rules('cb_accept','Accept Condition','required|trim|xss_clean',array(
		    	'required'=>'Accept Terms & Condition field is required',
		    ));
		if($this->form_validation->run()==true){
			redirect("online-chola-booking/step1");
		}else{
			$this->load->view('online-chola-booking',$arr);
		}
	}
	public function chola_booking_step1(){
		$arr['siteTitle']="Chola Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		}
		$current_time=date("Y-m-d H:i:s");
		/*if($current_time<CHOLA_LAUNCH_DATE){
			$this->session->set_flashdata('feedback',"Online Chola Booking stopped  temporarily please check after some time");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("dashboard");
		}
		*/
		
		$arr['templedata']=$this->cholamod->getAllTemple();
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_temple','Name', 'trim|required|xss_clean|callback_chkfortemple',array(
			'required'=>'Please select Temple',
		));
		
		if($this->form_validation->run()==true){
			$data=$this->input->post('cb_temple');
			$enc_cb_id=$this->encryptcode->encrypt($data,ENC_KEY_PASS);
			redirect("online-chola-booking/step2/$enc_cb_id");
		}
		$this->load->view('online-chola-booking-step1',$arr);
	}
	public function chkfortemple($cb_temple){
		$custsesid=$this->session->userdata('custsesid');
		if($cb_temple!="" && $custsesid!=""){
			$lastrow=$this->cholamod->chkforcholatemple($cb_temple,$custsesid);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkfortemple',"You can book chola  after $newdate_display using this account");	
				        return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	public function chola_booking_step2($enc_templeid){
		$arr['siteTitle']="Chola Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
    	$current_time=date("Y-m-d H:i:s");
		/*if($current_time<CHOLA_LAUNCH_DATE){
			$this->session->set_flashdata('feedback',"Online Chola Booking stopped  temporarily please check after some time");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("dashboard");
		}*/
        $temple_id=$this->encryptcode->decrypt($enc_templeid,ENC_KEY_PASS);
	
		/****** IP Based Check ********/
		$ip=$_SERVER['REMOTE_ADDR'];
		$ipbookingrow=$this->cholamod->getLastBookFromThisIp($temple_id,$ip);
		
		if($ipbookingrow){
			$cb_ipdate=$ipbookingrow->cb_ipdate;
			$new_dateip=date('Y-m-d H:i:s', strtotime($cb_ipdate. ' + 45 days'));
			$newdate_displayip=date('d-m-Y',strtotime($new_dateip));
			$current_datetimeip=date("Y-m-d H:i:s");
			if($current_datetimeip > $new_dateip){
					return true;	
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please check terms and conditions");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("/");
			}	
		}
		/******** Account Based Check *******/
		$abbbookingrow=$this->cholamod->getLastBookFromThisAccount($temple_id,$custsesid);
		
		if($abbbookingrow){
			$cb_abdate=$abbbookingrow->cb_ipdate;
			if($cb_abdate!=""){
			$new_dateabb=date('Y-m-d H:i:s', strtotime($cb_abdate. ' + 45 days'));
			$newdate_displayabb=date('d-m-Y',strtotime($new_dateabb));
			$current_datetimeabb=date("Y-m-d H:i:s");
    			if($current_datetimeabb > $new_dateabb){
    			   
    			}else{
    			   
    				$this->session->set_flashdata('feedback',"Something wrong please check terms and conditions");
    				$this->session->set_flashdata('feedbackerr',"alert-danger");
    				redirect("online-chola-booking/step1");
    			}	
			}
		}
		
		
		$arr['templedata']=$this->cholamod->getPerTemple($temple_id);
	       
		$arr['ch_datebooked']=$this->cholamod->getAllCholaDateBooked($temple_id);
		$arr['ch_inactivedate']=$this->cholamod->getAllInactiveDateChola($temple_id);
		
		$arr['ch_processdate']=$this->cholamod->getAllProcessDateChola($temple_id);
		
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|callback_chkcholadate|xss_clean',array(
		'required'=>'Booking Date field is required',
		));	
		$this->form_validation->set_rules('cb_name','Name', 'trim|required|xss_clean',array(
		'required'=>'Name field is required',
		));
	$this->form_validation->set_rules('cb_aadhaar','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaareligible|xss_clean',array(
			'required'=>'Aadhaar Number required',
			'min_length'=>'Enter 12 digit aadhaar no',
			'max_length'=>'Enter 12 digit aadhaar no',
		));
		$this->form_validation->set_rules('cb_mobile','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkmobeligible|xss_clean',array(
			'required'=>'Mobile field is required',
			'cb_mobile'=>'Enter 10 digit mobile no',
			'cb_mobile'=>'Enter 10 digit mobile no',
		));
		
		if($this->input->post('cb_othermember')=="Yes"){
			
			$this->form_validation->set_rules('cb_member_name1','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar1','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup1|callback_chkaadhaareligible1|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile1','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob1|callback_chkmobeligible1|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			
			
			
			if($this->input->post('cb_member_name2')!="" || $this->input->post('cb_member_aadhaar2')!="" || $this->input->post('cb_member_mobile2')!=""){
			$this->form_validation->set_rules('cb_member_name2','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar2','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup2|callback_chkaadhaareligible2|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile2','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob2|callback_chkmobeligible2|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			if($this->input->post('cb_member_name3')!="" || $this->input->post('cb_member_aadhaar3')!="" || $this->input->post('cb_member_mobile3')!=""){
				
			$this->form_validation->set_rules('cb_member_name3','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));	
				
			$this->form_validation->set_rules('cb_member_aadhaar3','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup3|callback_chkaadhaareligible3|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile3','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob3|callback_chkmobeligible3|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			if($this->input->post('cb_member_name4')!="" || $this->input->post('cb_member_aadhaar4')!="" || $this->input->post('cb_member_mobile4')!=""){
			$this->form_validation->set_rules('cb_member_name4','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar4','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup4|callback_chkaadhaareligible4|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile4','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob4|callback_chkmobeligible4|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			
			if($this->input->post('cb_member_name5')!="" || $this->input->post('cb_member_aadhaar5')!="" || $this->input->post('cb_member_mobile5')!=""){
			$this->form_validation->set_rules('cb_member_name5','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));		
			$this->form_validation->set_rules('cb_member_aadhaar5','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup5|callback_chkaadhaareligible5|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile5','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob5|callback_chkmobeligible5|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			
		}
		$cb_proof="";	
		if(empty($_FILES['cb_proof']['name'])){
			$this->form_validation->set_rules('cb_proof','Passport size photograph', 'trim|required|xss_clean',array(
		'required'=>'Passport size photograph  required',
			));
		}
		if(isset($_FILES['cb_proof']['name'])){
				$cb_proof=$_FILES['cb_proof']['name'];
		}
		$config=array(
			'upload_path'	=>'./media/document/',
			'allowed_types' => 'jpeg|gif|jpg|png',
			//'min_size' =>50,
			'max_size' =>500,
			'overwrite' => TRUE,
			'file_name' =>time().'_'.$cb_proof
		);
		$this->load->library('upload',$config);
		if($this->form_validation->run()==true &&   $this->upload->do_upload('cb_proof')){
			$data=$this->input->post();
			$cb_mobile=$data['cb_mobile'];
			$docup3=$this->upload->data();
			$proof="media/document/".$docup3['raw_name'].$docup3['file_ext'];
			$cb_bookfordate=$data['cb_bookfordate'];
			if($cb_bookfordate!=""){
				$data['cb_bookfordate']=date('Y-m-d',strtotime($cb_bookfordate));
			}
			
			$cb_chola_otp=random_string('nozero',6);
			$data['cb_chola_otp']=$cb_chola_otp;
			$expiretime=date('Y-m-d H:i:s', strtotime("+5 min"));
			$data['cb_chola_otpexpiry']=$expiretime;
			
			$data['proof']=$proof;
			$data['cb_temple']=$temple_id;
			
			$data['cb_ipaddress']=$ip;
			$cb_id=$this->cholamod->insertCholaBookingTemp($data,$custsesid);
			if($cb_id){
				$cb_mobile_sms="91".$cb_mobile;
				$sms_username=SMSIN_USERNAME;
				$sms_password=SMSIN_PASSWORD;
				$sms_senderid=SMSIN_SENDER_ID;		
				$sms_channel=SMSIN_CHANNEL;		
				$sms_route=SMSIN_ROUTE;	
				$sms_generated=date("d-m-Y");
				$sms_generated_time=date("h:i:a");
					
				$sms_content="$cb_chola_otp is your OTP for Chola booking system. Please keep it safe for next 5 minutes. SMS generated on $sms_generated $sms_generated_time SMMDSB-PKL";
              	$sms_text_final=urlencode($sms_content);
             	$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile_sms."&text=".$sms_text_final."&route=".$sms_route."&peid=1701161788461996254";
				$ch=curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$response=curl_exec($ch);
				curl_close($ch);
			
			
			$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
			$this->session->set_flashdata('feedback',"Success: Please enter 6 digit One Time Password (OTP) send on your mobile  $cb_mobile and valid for next 5 minute");
			$this->session->set_flashdata('feedbackerr',"alert-success");
				
			redirect("online-chola-booking/verify-otp/$enc_cb_id");
			}else{
					$this->session->set_flashdata('feedback',"Something wrong please try again");
					$this->session->set_flashdata('feedbackerr',"alert-danger");
					redirect("online-chola-booking");
			}
		}else{
		    $arr['error3']=$this->upload->display_errors();	
		     $this->load->view('online-chola-booking-step2',$arr);
		}
	}
	/******* Check Duplicate Mobile ****/
	public function chkdupmob1($cb_member_mobile1){
		$countmob_error1=array();
		$cb_mobile=$this->input->post('cb_mobile');
		$cb_member_mobile2=$this->input->post('cb_member_mobile2');
		$cb_member_mobile3=$this->input->post('cb_member_mobile3');
		$cb_member_mobile4=$this->input->post('cb_member_mobile4');
		$cb_member_mobile5=$this->input->post('cb_member_mobile5');
				$msg_show="Please enter unique mobile number";
				if($cb_member_mobile1!=""){
						if($cb_mobile!=""){
							if($cb_member_mobile1==$cb_mobile){
								$countmob_error1[]=$msg_show;
							}
						}
						if($cb_member_mobile2!=""){
							if($cb_member_mobile1==$cb_member_mobile2){
								$countmob_error1[]=$msg_show;
							}
						}
						if($cb_member_mobile3!=""){
							if($cb_member_mobile1==$cb_member_mobile3){
								$countmob_error1[]=$msg_show;
							}
						}
						if($cb_member_mobile4!=""){
							if($cb_member_mobile1==$cb_member_mobile4){
								$countmob_error1[]=$msg_show;
							}
						}
						if($cb_member_mobile5!=""){
							if($cb_member_mobile1==$cb_member_mobile5){
								$countmob_error1[]=$msg_show;
							}
						}
						if(count($countmob_error1)>0){
							$this->form_validation->set_message('chkdupmob1',$msg_show);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkdupmob2($cb_member_mobile2){
		$countmob_error2=array();
		$cb_mobile=$this->input->post('cb_mobile');
		$cb_member_mobile1=$this->input->post('cb_member_mobile1');
		$cb_member_mobile3=$this->input->post('cb_member_mobile3');
		$cb_member_mobile4=$this->input->post('cb_member_mobile4');
		$cb_member_mobile5=$this->input->post('cb_member_mobile5');
				$msg_show="Please enter unique mobile number";
				if($cb_member_mobile2!=""){
						if($cb_mobile!=""){
							if($cb_member_mobile2==$cb_mobile){
								$countmob_error2[]=$msg_show;
							}
						}
						if($cb_member_mobile1!=""){
							if($cb_member_mobile2==$cb_member_mobile1){
								$countmob_error2[]=$msg_show;
							}
						}
						if($cb_member_mobile3!=""){
							if($cb_member_mobile2==$cb_member_mobile3){
								$countmob_error2[]=$msg_show;
							}
						}
						if($cb_member_mobile4!=""){
							if($cb_member_mobile2==$cb_member_mobile4){
								$countmob_error2[]=$msg_show;
							}
						}
						if($cb_member_mobile5!=""){
							if($cb_member_mobile2==$cb_member_mobile5){
								$countmob_error2[]=$msg_show;
							}
						}
						if(count($countmob_error2)>0){
							$this->form_validation->set_message('chkdupmob2',$msg_show);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkdupmob3($cb_member_mobile3){
		$countmob_error3=array();
		$cb_mobile=$this->input->post('cb_mobile');
		$cb_member_mobile1=$this->input->post('cb_member_mobile1');
		$cb_member_mobile2=$this->input->post('cb_member_mobile2');
		$cb_member_mobile3;
		$cb_member_mobile4=$this->input->post('cb_member_mobile4');
		$cb_member_mobile5=$this->input->post('cb_member_mobile5');
				$msg_show="Please enter unique mobile number";
				if($cb_member_mobile3!=""){
						if($cb_mobile!=""){
							if($cb_member_mobile3==$cb_mobile){
								$countmob_error3[]=$msg_show;
							}
						}
						if($cb_member_mobile1!=""){
							if($cb_member_mobile3==$cb_member_mobile1){
								$countmob_error3[]=$msg_show;
							}
						}
						if($cb_member_mobile2!=""){
							if($cb_member_mobile3==$cb_member_mobile2){
								$countmob_error3[]=$msg_show;
							}
						}
						if($cb_member_mobile4!=""){
							
							if($cb_member_mobile3==$cb_member_mobile4){
								$countmob_error3[]=$msg_show;
							}
						}
						if($cb_member_mobile5!=""){
							if($cb_member_mobile3==$cb_member_mobile5){
								$countmob_error3[]=$msg_show;
							}
						}
						if(count($countmob_error3)>0){
							$this->form_validation->set_message('chkdupmob3',$msg_show);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkdupmob4($cb_member_mobile4){
		$countmob_error4=array();
		$cb_mobile=$this->input->post('cb_mobile');
		$cb_member_mobile1=$this->input->post('cb_member_mobile1');
		$cb_member_mobile2=$this->input->post('cb_member_mobile2');
		$cb_member_mobile3=$this->input->post('cb_member_mobile3');
		$cb_member_mobile5=$this->input->post('cb_member_mobile5');
				$msg_show="Please enter unique mobile number";
				if($cb_member_mobile4!=""){
						if($cb_mobile!=""){
							if($cb_member_mobile4==$cb_mobile){
								$countmob_error4[]=$msg_show;
							}
						}
						if($cb_member_mobile1!=""){
							if($cb_member_mobile4==$cb_member_mobile1){
								$countmob_error4[]=$msg_show;
							}
						}
						if($cb_member_mobile2!=""){
							if($cb_member_mobile4==$cb_member_mobile2){
								$countmob_error4[]=$msg_show;
							}
						}
						if($cb_member_mobile3!=""){
							if($cb_member_mobile4==$cb_member_mobile3){
								$countmob_error4[]=$msg_show;
							}
						}
						if($cb_member_mobile5!=""){
							if($cb_member_mobile4==$cb_member_mobile5){
								$countmob_error4[]=$msg_show;
							}
						}
						if(count($countmob_error4)>0){
							$this->form_validation->set_message('chkdupmob4',$msg_show);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkdupmob5($cb_member_mobile5){
		$countmob_error5=array();
		$cb_mobile=$this->input->post('cb_mobile');
		$cb_member_mobile1=$this->input->post('cb_member_mobile1');
		$cb_member_mobile2=$this->input->post('cb_member_mobile2');
		$cb_member_mobile3=$this->input->post('cb_member_mobile3');
		$cb_member_mobile4=$this->input->post('cb_member_mobile4');
				$msg_show="Please enter unique mobile number";
				if($cb_member_mobile5!=""){
						if($cb_mobile!=""){
							if($cb_member_mobile5==$cb_mobile){
								$countmob_error5[]=$msg_show;
							}
						}
						if($cb_member_mobile1!=""){
							if($cb_member_mobile5==$cb_member_mobile1){
								$countmob_error5[]=$msg_show;
							}
						}
						if($cb_member_mobile2!=""){
							if($cb_member_mobile5==$cb_member_mobile2){
								$countmob_error5[]=$msg_show;
							}
						}
						if($cb_member_mobile3!=""){
							if($cb_member_mobile5==$cb_member_mobile3){
								$countmob_error5[]=$msg_show;
							}
						}
						if($cb_member_mobile4!=""){
							if($cb_member_mobile5==$cb_member_mobile4){
								$countmob_error5[]=$msg_show;
							}
						}
						if(count($countmob_error5)>0){
							$this->form_validation->set_message('chkdupmob5',$msg_show);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	
	/****** Check Duplicate Aadhar Card ***/
	public function chkaadhaardup1($cb_member_aadhaar1){
		$counta_error1=array();
		$cb_aadhaar=$this->input->post('cb_aadhaar');
		$cb_member_aadhaar2=$this->input->post('cb_member_aadhaar2');
		$cb_member_aadhaar3=$this->input->post('cb_member_aadhaar3');
		$cb_member_aadhaar4=$this->input->post('cb_member_aadhaar4');
		$cb_member_aadhaar5=$this->input->post('cb_member_aadhaar5');
				$msg_showad="Please enter unique Aadhaar No.";
				if($cb_member_aadhaar1!=""){
						if($cb_aadhaar!=""){
							if($cb_member_aadhaar1==$cb_aadhaar){
								$counta_error1[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar2!=""){
							if($cb_member_aadhaar1==$cb_member_aadhaar2){
								$counta_error1[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar3!=""){
							if($cb_member_aadhaar1==$cb_member_aadhaar3){
								$counta_error1[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar4!=""){
							if($cb_member_aadhaar1==$cb_member_aadhaar4){
								$counta_error1[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar5!=""){
							if($cb_member_aadhaar1==$cb_member_aadhaar5){
								$counta_error1[]=$msg_showad;
							}
						}
						if(count($counta_error1)>0){
							$this->form_validation->set_message('chkaadhaardup1',$msg_showad);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkaadhaardup2($cb_member_aadhaar2){
		$counta_error2=array();
		$cb_aadhaar=$this->input->post('cb_aadhaar');
		$cb_member_aadhaar1=$this->input->post('cb_member_aadhaar1');
		$cb_member_aadhaar3=$this->input->post('cb_member_aadhaar3');
		$cb_member_aadhaar4=$this->input->post('cb_member_aadhaar4');
		$cb_member_aadhaar5=$this->input->post('cb_member_aadhaar5');
				$msg_showad="Please enter unique Aadhaar No.";
				if($cb_member_aadhaar2!=""){
						if($cb_aadhaar!=""){
							if($cb_member_aadhaar2==$cb_aadhaar){
								$counta_error2[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar1!=""){
							if($cb_member_aadhaar2==$cb_member_aadhaar1){
								$counta_error2[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar3!=""){
							if($cb_member_aadhaar2==$cb_member_aadhaar3){
								$counta_error2[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar4!=""){
							if($cb_member_aadhaar2==$cb_member_aadhaar4){
								$counta_error2[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar5!=""){
							if($cb_member_aadhaar2==$cb_member_aadhaar5){
								$counta_error2[]=$msg_showad;
							}
						}
						if(count($counta_error2)>0){
							$this->form_validation->set_message('chkaadhaardup2',$msg_showad);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkaadhaardup3($cb_member_aadhaar3){
		$counta_error3=array();
		$cb_aadhaar=$this->input->post('cb_aadhaar');
		$cb_member_aadhaar1=$this->input->post('cb_member_aadhaar1');
		$cb_member_aadhaar2=$this->input->post('cb_member_aadhaar2');
		$cb_member_aadhaar4=$this->input->post('cb_member_aadhaar4');
		$cb_member_aadhaar5=$this->input->post('cb_member_aadhaar5');
				$msg_showad="Please enter unique Aadhaar No.";
				if($cb_member_aadhaar3!=""){
						if($cb_aadhaar!=""){
							if($cb_member_aadhaar3==$cb_aadhaar){
								$counta_error3[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar1!=""){
							if($cb_member_aadhaar3==$cb_member_aadhaar1){
								$counta_error3[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar2!=""){
							if($cb_member_aadhaar3==$cb_member_aadhaar2){
								$counta_error3[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar4!=""){
							if($cb_member_aadhaar3==$cb_member_aadhaar4){
								$counta_error3[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar5!=""){
							if($cb_member_aadhaar3==$cb_member_aadhaar5){
								$counta_error3[]=$msg_showad;
							}
						}
						if(count($counta_error3)>0){
							$this->form_validation->set_message('chkaadhaardup3',$msg_showad);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkaadhaardup4($cb_member_aadhaar4){
		$counta_error4=array();
		$cb_aadhaar=$this->input->post('cb_aadhaar');
		$cb_member_aadhaar1=$this->input->post('cb_member_aadhaar1');
		$cb_member_aadhaar2=$this->input->post('cb_member_aadhaar2');
		$cb_member_aadhaar3=$this->input->post('cb_member_aadhaar3');
		$cb_member_aadhaar5=$this->input->post('cb_member_aadhaar5');
				$msg_showad="Please enter unique Aadhaar No.";
				if($cb_member_aadhaar4!=""){
						if($cb_aadhaar!=""){
							if($cb_member_aadhaar4==$cb_aadhaar){
								$counta_error4[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar1!=""){
							if($cb_member_aadhaar4==$cb_member_aadhaar1){
								$counta_error4[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar2!=""){
							if($cb_member_aadhaar4==$cb_member_aadhaar2){
								$counta_error4[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar3!=""){
							if($cb_member_aadhaar4==$cb_member_aadhaar3){
								$counta_error4[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar5!=""){
							if($cb_member_aadhaar4==$cb_member_aadhaar5){
								$counta_error4[]=$msg_showad;
							}
						}
						if(count($counta_error4)>0){
							$this->form_validation->set_message('chkaadhaardup4',$msg_showad);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	public function chkaadhaardup5($cb_member_aadhaar5){
		$counta_error5=array();
		$cb_aadhaar=$this->input->post('cb_aadhaar');
		$cb_member_aadhaar1=$this->input->post('cb_member_aadhaar1');
		$cb_member_aadhaar2=$this->input->post('cb_member_aadhaar2');
		$cb_member_aadhaar3=$this->input->post('cb_member_aadhaar3');
		$cb_member_aadhaar4=$this->input->post('cb_member_aadhaar4');
				$msg_showad="Please enter unique Aadhaar No.";
				if($cb_member_aadhaar5!=""){
						if($cb_aadhaar!=""){
							if($cb_member_aadhaar5==$cb_aadhaar){
								$counta_error5[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar1!=""){
							if($cb_member_aadhaar5==$cb_member_aadhaar1){
								$counta_error5[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar2!=""){
							if($cb_member_aadhaar5==$cb_member_aadhaar2){
								$counta_error5[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar3!=""){
							if($cb_member_aadhaar5==$cb_member_aadhaar3){
								$counta_error5[]=$msg_showad;
							}
						}
						if($cb_member_aadhaar4!=""){
							if($cb_member_aadhaar5==$cb_member_aadhaar4){
								$counta_error5[]=$msg_showad;
							}
						}
						if(count($counta_error5)>0){
							$this->form_validation->set_message('chkaadhaardup5',$msg_showad);
							return false;
						}else{
							return true;	
						}
		}else{
			return true;	
		}
	}
	/******* Mobile Six Month Eligibility Check *****/
	public function chkmobeligible($cb_mobile){
		$cb_temple=$this->input->post('temple_id');
		if($cb_mobile!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_mobile,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible',"You can book chola  after $newdate_display using this account");	
				    return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	public function chkmobeligible1($cb_member_mobile1){
	$cb_temple=$this->input->post('temple_id');
		if($cb_member_mobile1!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_member_mobile1,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible1',"You can book chola  after $newdate_display using this account");	
				    return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	public function chkmobeligible2($cb_member_mobile3){
		$cb_temple=$this->input->post('temple_id');
		if($cb_member_mobile3!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_member_mobile3,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible2',"You can book chola  after $newdate_display using this account");	
				    return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	public function chkmobeligible3($cb_member_mobile3){
		$cb_temple=$this->input->post('temple_id');
		if($cb_member_mobile3!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_member_mobile3,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible3',"You can book chola  after $newdate_display using this account");	
				    return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	public function chkmobeligible4($cb_member_mobile4){
		$cb_temple=$this->input->post('temple_id');
		if($cb_member_mobile4!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_member_mobile4,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible4',"You can book chola  after $newdate_display using this account");	
				   		 return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	public function chkmobeligible5($cb_member_mobile5){
		$cb_temple=$this->input->post('temple_id');
		if($cb_member_mobile5!=""){
			$lastrow=$this->cholamod->chkforcholamob($cb_member_mobile5,$cb_temple);
			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");
			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
			        	$this->form_validation->set_message('chkmobeligible5',"You can book chola  after $newdate_display using this account");	
				    return false;	
			    }else{
			        return true;
			    }
			}else{
				return true;
			}
		}else{
			return true;	
		}
	}
	
	
	
	/************ Mobile Six Month eligibility check end *******/
	/*********** Aadhaar Six Month eligibility check **********/
public function chkaadhaareligible($cb_aadhaar){
	
	$cb_temple=$this->input->post('temple_id');
	if($cb_aadhaar!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_aadhaar,$cb_temple);
		
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
			if($current_datetime > $new_date){
					return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible',"You can book chola after date $newdate_display");	
				return false;
				
			}
			
		}else{
			
			return true;
		}
	}else{
		return true;	
	}
}
public function chkaadhaareligible1($cb_member_aadhaar1){
	$cb_temple=$this->input->post('temple_id');
	if($cb_member_aadhaar1!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_member_aadhaar1,$cb_temple);
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			if($current_datetime > $new_date){
				return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible1',"You can book chola after date $newdate_display");	
				return false;
			}
			
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible1',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
		}else{
			return true;
		}
	}else{
		return true;	
	}
}
public function chkaadhaareligible2($cb_member_aadhaar2){
	$cb_temple=$this->input->post('temple_id');
	if($cb_member_aadhaar2!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_member_aadhaar2,$cb_temple);
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible2',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
			if($current_datetime > $new_date){
					return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible2',"You can book chola after date $newdate_display");	
				return false;
				
			}
		}else{
			return true;
		}
	}else{
		return true;	
	}
}
	public function chkaadhaareligible3($cb_member_aadhaar3){
	$cb_temple=$this->input->post('temple_id');
	if($cb_member_aadhaar3!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_member_aadhaar3,$cb_temple);
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			if($current_datetime > $new_date){
					return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible3',"You can book chola after date $newdate_display");	
				return false;
				
			}
			
			
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible3',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
		}else{
			return true;
		}
	}else{
		return true;	
	}
}
public function chkaadhaareligible4($cb_member_aadhaar4){
	$cb_temple=$this->input->post('temple_id');
	if($cb_member_aadhaar4!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_member_aadhaar4,$cb_temple);
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			if($current_datetime > $new_date){
					return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible4',"You can book chola after date $newdate_display");	
				return false;
				
			}
			
			
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible4',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
		}else{
			return true;
		}
	}else{
		return true;	
	}
}
public function chkaadhaareligible5($cb_member_aadhaar5){
	$cb_temple=$this->input->post('temple_id');
	if($cb_member_aadhaar5!="" && $cb_temple!=""){
		$lastrow=$this->cholamod->chkforcholaaadhaar($cb_member_aadhaar5,$cb_temple);
		if($lastrow){
			$subdate=$lastrow->cb_subdatetime;
			$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			$newdate_display=date('d-m-Y',strtotime($new_date));
			$current_datetime=date("Y-m-d H:i:s");
			/*if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
					$this->form_validation->set_message('chkaadhaareligible5',"You can book chola after date $newdate_display");	
					return true;	
			}else{
				return true;
			}*/
			
			if($current_datetime > $new_date){
					return true;	
			}else{
				$this->form_validation->set_message('chkaadhaareligible5',"You can book chola after date $newdate_display");	
				return false;
				
			}
			
			
		}else{
			return true;
		}
	}else{
		return true;	
	}
}
	
	/*public function chola_booking_step1_1($enc_cb_id){
		$arr['siteTitle']="Chola Booking";		
		$custsesid=$this->session->userdata('custsesid');
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
		$tempid=$arr['cholatemp']->cb_temple;
		$arr['cholaprice']=$this->cholamod->gettemplecholaprice($tempid);
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		}
		
		if($this->input->post('cb_chola_from_board')=="Yes"){
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cholaprice','cholaprice', 'trim|required|xss_clean',array(
				'required'=>'Please Choose One Option '
				));
			}elseif($this->input->post('cb_chola_from_board')=="No"){
				redirect("online-chola-booking/overview/$enc_cb_id");
			}
		if($this->form_validation->run()==true){
			
			$data['cholaprice']=$this->input->post('cholaprice'); 
			$data['cb_chola_from_board']=$this->input->post('cb_chola_from_board'); 
			$update_id=$this->cholamod->updatetempchbook($cb_id,$data);
			if($update_id){
				
				redirect("online-chola-booking/overview/$enc_cb_id");
			}
		}
		$this->load->view('online-chola-booking-step1_1',$arr);
	}*/
	public function chola_booking_verifyotp($enc_cb_id){
		$arr['siteTitle']="Chola Booking";		
		$custsesid=$this->session->userdata('custsesid');
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		// $arr['templedata']=$this->cholamod->getPerTemple($cb_id);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
		$cb_mobile=$arr['cholatemp']->cb_mobile;
		
		//$tempid=$arr['cholatemp']->cb_temple;
		//$arr['cholaprice']=$this->cholamod->gettemplecholaprice($tempid);
			// print_r($cb_id); die();
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		}
		if(isset($_POST['resendotp'])){
			$dataup=array();
			$cb_chola_otp=random_string('nozero',6);
			$dataup['cb_chola_otp']=$cb_chola_otp;
			$expiretime=date('Y-m-d H:i:s', strtotime("+5 min"));
			$dataup['cb_chola_otpexpiry']=$expiretime;
			$upotp=$this->cholamod->updateOtpResend($dataup,$cb_id);
			if($upotp){
				/******** SMS Code *********/
				$cb_mobile_sms="91".$cb_mobile;
				$sms_username=SMSIN_USERNAME;
				$sms_password=SMSIN_PASSWORD;
				$sms_senderid=SMSIN_SENDER_ID;		
				$sms_channel=SMSIN_CHANNEL;		
				$sms_route=SMSIN_ROUTE;	
				$sms_generated=date("d-m-Y");
				$sms_generated_time=date("h:i:a");
				$sms_content="$cb_chola_otp is your OTP for Chola booking system. Please keep it safe for next 5 minutes. SMS generated on $sms_generated $sms_generated_time SMMDSB-PKL";
				
				
              	 $sms_text_final=urlencode($sms_content);
             	$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile_sms."&text=".$sms_text_final."&route=".$sms_route."&peid=1701161788461996254";
				$ch=curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$response=curl_exec($ch);
				curl_close($ch);
				
				$this->session->set_flashdata('feedback',"Success: Please enter 6 digit One Time Password (OTP) send on your mobile  $cb_mobile and valid for next 5 minute");
				$this->session->set_flashdata('feedbackerr',"alert-success");
				redirect("online-chola-booking/verify-otp/$enc_cb_id");
			}
		}
		if(isset($_POST['verifyotp_btn'])){
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
				$this->form_validation->set_rules('cb_chola_otp','OTP', 'trim|required|xss_clean|callback_chkotp',array(
				'required'=>'Please enter OTP'
		));
			
			if($this->form_validation->run()==true){
			$upotpvs=$this->cholamod->upOtpVerSuccess($cb_id);
				if($upotpvs){
					redirect("online-chola-booking/overview/$enc_cb_id");
				}
			}
		}
		$this->load->view('online-chola-booking-verifyotp',$arr);	
	}
	public function chkotp($cb_chola_otp){
		$encbid=$this->input->post('encbid'); 
		if($encbid!="" && $cb_chola_otp!=""){
				$cb_id=$this->encryptcode->decrypt($encbid,ENC_KEY_PASS);
				$rowbook=$this->cholamod->getPerOtp($cb_id,$cb_chola_otp);
				if($rowbook){
					$cb_chola_otpexpiry=$rowbook->cb_chola_otpexpiry;
					 $current_time=date("Y-m-d H:i:s");
					
					if($cb_chola_otpexpiry>=$current_time){
						return true;
					}else{
						$this->form_validation->set_message('chkotp','OTP expired. Click resend OTP button again');
						return false;	
						
					}
					
				}else{
					$this->form_validation->set_message('chkotp','Please enter valid OTP');
					return false;	
				}		
		}else{
			$this->form_validation->set_message('chkotp','Please enter OTP');
			return false;	
		}
	}
	
	
	public function chola_booking_payment($enc_cb_id){
		$ip=$_SERVER['REMOTE_ADDR'];
		$arr['siteTitle']="Chola Booking Details";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		/****** Comment this if condition to Open Same for all *******/
	/*	$current_time=date("Y-m-d H:i:s");
		if($current_time<CHOLA_LAUNCH_DATE){
			$this->session->set_flashdata('feedback',"Chola Booking will start from 16-07-2022 at 10 AM.");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("dashboard");
		}*/
		
		
		
		
		
		//$success_url="https://www.mansadevi.org.in/portal/online-chola-booking/success";
		//$fail_url="https://www.mansadevi.org.in/portal/online-chola-booking/failure";
		//$response_url="https://www.mansadevi.org.in/portal/online-chola-booking/worldline/response";
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
		$amount=$arr['cholatemp']->temple_fee;	
		
		/***** Check For Verification *******/
		$cb_chola_otpverification=$arr['cholatemp']->cb_chola_otpverification;
		if($cb_chola_otpverification==0){
			$this->session->set_flashdata('feedback',"OTP Verificaton not completed");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("online-chola-booking/verify-otp/$enc_cb_id");
		}
		
		// $arr['tempdata']=($arr['cholatemp']->cb_data);
		$temple_id=$arr['cholatemp']->cb_temple;
		$arr['templedata']=$this->cholamod->getPerTemple($temple_id);
		$temple_name=$arr['templedata']->temple_name;
		$temple_shortcode=$arr['templedata']->temple_shortcode;
		// $arr['cholaprice']=$this->cholamod->gettemplecholaprice($tempid);
		if($arr['cholatemp']){
		
		if(isset($_POST['bookChola'])){
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');
			$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|callback_chkcholadate|xss_clean',array(
			'required'=>'Booking Date field is required'
			));
			if($this->form_validation->run()==true){
				
		$ipbookingrow=$this->cholamod->getLastBookFromThisIp($temple_id,$ip);
		if($ipbookingrow){
			$cb_ipdate=$ipbookingrow->cb_ipdate;
			$new_dateip=date('Y-m-d H:i:s', strtotime($cb_ipdate. ' + 45 days'));
			$newdate_displayip=date('d-m-Y',strtotime($new_dateip));
			$current_datetimeip=date("Y-m-d H:i:s");
			if($current_datetimeip > $new_dateip){
					return true;	
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please check terms and conditions");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("online-chola-booking/overview/$enc_cb_id");
			}	
		}
		/******** Account Based Check *******/
		$abbbookingrow=$this->cholamod->getLastBookFromThisAccount($temple_id,$custsesid);
		if($abbbookingrow){
			$cb_abdate=$abbbookingrow->cb_ipdate;
			if($cb_abdate!=""){
			$new_dateabb=date('Y-m-d H:i:s', strtotime($cb_abdate. ' + 45 days'));
			$newdate_displayabb=date('d-m-Y',strtotime($new_dateabb));
			$current_datetimeabb=date("Y-m-d H:i:s");
			if($current_datetimeabb > $new_dateabb){
					return true;	
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please check terms and conditions");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("online-chola-booking/overview/$enc_cb_id");
			}	
			}
		}
		$data=$this->input->post();
		//$bookfordate=$arr['cholatemp']->cb_bookfordate;
		// print_r($checkbookfordate); die();
		$data=$this->input->post();
		$time=date("dmyHis");
		$txnid=$temple_shortcode."-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;
		$datach['cb_orderno']=$txnid;
		$datach['cb_regid']=$custsesid;
		$datach['cb_bookfordate']=$arr['cholatemp']->cb_bookfordate;
		$name=$arr['cholatemp']->cb_name;
		$datach['cb_name']=$arr['cholatemp']->cb_name;
		$datach['cb_mobile']=$arr['cholatemp']->cb_mobile;
		$reg_email=$arr['regdata']->reg_email;
		$datach['cb_email']=$reg_email;
		$address=$arr['regdata']->reg_address_line1;
		if($arr['regdata']->reg_address_line2!=""){
			$address==$address." ".$arr['regdata']->reg_address_line2;
		}
		$datach['cb_address']=$address;
		$reg_city=$arr['regdata']->reg_city;
		$datach['cb_city']=$reg_city;
		$reg_state=$arr['regdata']->reg_state;
		$datach['cb_state']=$reg_state;
		$reg_pincode=$arr['regdata']->reg_pincode;
		$datach['cb_pincode']=$arr['regdata']->reg_pincode;
		$datach['cb_paymethod']=3;
		$datach['cb_proof']=$arr['cholatemp']->cb_proof;
		$datach['cb_temple']=$arr['cholatemp']->cb_temple;
		$datach['cb_templename']=$temple_name;
		$datach['cb_aadhar']=$arr['cholatemp']->cb_aadhaar;
		$datach['cb_othermember']=$arr['cholatemp']->cb_othermember;
		$datach['cb_devotee_name1']=$arr['cholatemp']->cb_member_name1;
		$datach['cb_devotee_mobile1']=$arr['cholatemp']->cb_member_mobile1;
		$datach['cb_devotee_aadhar1']=$arr['cholatemp']->cb_member_aadhaar1;
		$datach['cb_devotee_name2']=$arr['cholatemp']->cb_member_name2;
		$datach['cb_devotee_mobile2']=$arr['cholatemp']->cb_member_mobile2;
		$datach['cb_devotee_aadhar2']=$arr['cholatemp']->cb_member_aadhaar2;
		$datach['cb_devotee_name3']=$arr['cholatemp']->cb_member_name3;
		$datach['cb_devotee_mobile3']=$arr['cholatemp']->cb_member_mobile3;
		$datach['cb_devotee_aadhar3']=$arr['cholatemp']->cb_member_aadhaar3;
		$datach['cb_devotee_name4']=$arr['cholatemp']->cb_member_name4;
		$datach['cb_devotee_mobile4']=$arr['cholatemp']->cb_member_mobile4;
		$datach['cb_devotee_aadhar4']=$arr['cholatemp']->cb_member_aadhaar4;
		$datach['cb_devotee_name5']=$arr['cholatemp']->cb_member_name5;
		$datach['cb_devotee_mobile5']=$arr['cholatemp']->cb_member_mobile5;
		$datach['cb_devotee_aadhar5']=$arr['cholatemp']->cb_member_aadhaar5;
		$datach['cb_amount']=$amount;
		$datach['cb_ipaddress']=$ip;
		$chola_bid=$this->cholamod->insertCholaBooking($datach);
		if($chola_bid){
			$this->load->library('paynimo/TransactionRequestBean');
			$transactionRequestBean=new TransactionRequestBean();
		 		//$mid=WORLDLINE_MID;
				//$enckey=WORLDLINE_ENCKEY;
				$cbrow=$this->cholamod->getPerCholaBooking($chola_bid);
				
				$cb_orderno=$cbrow->cb_orderno;
				$cb_name=$cbrow->cb_name;
				$cb_amount=$cbrow->cb_amount;
				$cb_mobile=$cbrow->cb_mobile;
	
	$itc=$chola_bid;		
		$amount_final=number_format($amount,1,'.','');


	$scheme_code="FIRST_".$amount_final."_0.0";	 
	
	$return_url=site_url("online-chola-booking/worldline/response");
	$transactionRequestBean->merchantCode=WL_MERCHANTCODE_LIVE;
    $transactionRequestBean->ITC=$itc;
    $transactionRequestBean->customerName=$cb_name;
    $transactionRequestBean->requestType=WL_REQTYPE1;
    $transactionRequestBean->merchantTxnRefNumber=$cb_orderno;
    $transactionRequestBean->amount=$amount_final;
    $transactionRequestBean->currencyCode=WL_CURRENCYCODE;
    $transactionRequestBean->returnURL=$return_url;
    $transactionRequestBean->shoppingCartDetails=$scheme_code;
    $transactionRequestBean->TPSLTxnID="";
    $transactionRequestBean->mobileNumber=$cb_mobile;
    $transactionRequestBean->txnDate=date("Y-m-d");
    $transactionRequestBean->bankCode=WL_BANKCODE;
    $transactionRequestBean->custId=$custsesid;
    $transactionRequestBean->key=WL_KEY;
    $transactionRequestBean->iv=WL_IV;
    $transactionRequestBean->accountNo="";
    $transactionRequestBean->webServiceLocator=WL_LOCATORURL;
    $transactionRequestBean->timeOut=30;
	
	$datapay['merchantCode']=$transactionRequestBean->merchantCode;
	$datapay['ITC']=$transactionRequestBean->ITC;
	$datapay['customerName']=$transactionRequestBean->customerName;
	$datapay['requestType']=$transactionRequestBean->requestType;
	$datapay['merchantTxnRefNumber']=$transactionRequestBean->merchantTxnRefNumber;
	$datapay['amount']=$transactionRequestBean->amount;
	$datapay['currencyCode']=$transactionRequestBean->currencyCode;
	$datapay['returnURL']=$transactionRequestBean->returnURL;
	$datapay['shoppingCartDetails']=$transactionRequestBean->shoppingCartDetails;
	$datapay['TPSLTxnID']=$transactionRequestBean->TPSLTxnID;
	$datapay['mobileNumber']=$transactionRequestBean->mobileNumber;
	$datapay['txnDate']=$transactionRequestBean->txnDate;
	$datapay['bankCode']=$transactionRequestBean->bankCode;
	$datapay['custId']=$transactionRequestBean->custId;
	$datapay['key']=$transactionRequestBean->key;
	$datapay['iv']=$transactionRequestBean->iv;
	$datapay['accountNo']=$transactionRequestBean->accountNo;
	$datapay['webServiceLocator']=$transactionRequestBean->webServiceLocator;
	$datapay['timeOut']=$transactionRequestBean->timeOut;
	$datapayser=serialize($datapay);		
	$this->cholamod->upPerCholaParms($datapayser,$chola_bid);	
			
	 //Writing in Request Log
  //	$log="Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
    
	
    //Saving string to log by using "FILE_APPEND" to append.
   // file_put_contents(base_url().'/application/logs/paynimo/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	$responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];
	 $this->cholamod->delPerTempCholaBooking($cb_id);
   	echo "<script>window.location = '" . $response . "'</script>";
    ob_flush();
				
				}
			
			}
		}
		}else{
			redirect("online-chola-booking");
		}
	$this->load->view('online-chola-booking-overview',$arr);
	}
	public function chkcholadate($cb_bookfordate){
		$temple_id=$this->input->post('temple_id');
		if($cb_bookfordate!="" && $temple_id!=""){
			$cb_bookfordate=date('Y-m-d',strtotime($cb_bookfordate));
			$count_date=$this->cholamod->count_choladate($cb_bookfordate,$temple_id);
			if($count_date==0){
				$count_inactive=$this->cholamod->count_inactivedate($cb_bookfordate,$temple_id);
				if($count_inactive==0){
					$count_processing=$this->cholamod->count_processing($cb_bookfordate,$temple_id);
					if($count_processing==0){
						/* Check Previous Date */
						$book_datetime=strtotime($cb_bookfordate);
						$current_datetime=strtotime(date('Y-m-d'));
						if($book_datetime<$current_datetime){
							$this->form_validation->set_message('chkcholadate', 'Please enter valid date');					
							return FALSE;	
						}else{
							//$three_month=date('Y-m-d', strtotime('+3 months'));
							$three_month=date('Y-m-d', strtotime('+ 45 days'));
							$threem_time=strtotime($three_month);
							if($book_datetime>$threem_time){
								$this->form_validation->set_message('chkcholadate', 'Please select date between 45 days from current date');					
								return FALSE;
							}else{
								if($cb_bookfordate==$three_month){
									$time_check="10:00";
									$current_time=date("H:i");
									if($current_time<$time_check){
										$this->form_validation->set_message('chkcholadate', 'Booking start 10:00am for this date');					
										return FALSE;	
									}else{
										return true;	
									}
								}else{
									return true;
								}
							}
						}
					}else{
					$this->form_validation->set_message('chkcholadate', 'Booking is processing for this date');					
					return FALSE;	
					}
				}else{
					$this->form_validation->set_message('chkcholadate', 'Booking is off for this date');
					return FALSE;	 									                
					}				
			}else{
				$this->form_validation->set_message('chkcholadate', 'This date is unavailable at this time');
				return FALSE;
			}
			
		}else{
			$this->form_validation->set_message('chkcholadate', 'Date Invalid. Please try again');
			return FALSE;	
		}		
	}
	public function chola_status_preview($enc_cb_id){
		$arr['siteTitle']="Payment Status detail";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cbdata']=$this->cholamod->getPerCholaBooking($cb_id);	
		$this->load->view('cholabooking-success-status',$arr);
	}
	public function cholapayment_status($enc_cb_id){
		$arr['siteTitle']="Payment Status Detail";
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cbdata']=$this->cholamod->getPerCholaBooking($cb_id);	
		$this->load->view('cholabooking-status',$arr);
	}
	
	public function worldline_chola_response(){
		$this->load->library('paynimo/TransactionResponseBean');
		if($_POST){
   			if(isset($_POST['msg'])){
        $response = $_POST;
        if (is_array($response)) {
            $str = $response['msg'];
        } else if (is_string($response) && strstr($response, 'msg=')) {
            $outputstr = str_replace('msg=', '', $response);
            $outputArr = explode('&', $outputstr);
            $str = $outputArr[0];
        } else {
            $str = $response;
        }
        $transactionResponseBean = new TransactionResponseBean();
        $transactionResponseBean->setResponsePayload($str);
        $transactionResponseBean->key=WL_KEY;
        $transactionResponseBean->iv=WL_IV;
        $response = $transactionResponseBean->getResponsePayload();

        //Writing in Response Log
        $log="Date : ".date("F j, Y, g:i a")."; Response Data : ".$response.PHP_EOL;
		 //Saving string to log by using "FILE_APPEND" to append.
        file_put_contents(base_url().'/application/logs/paynimo/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
		$response_n = explode("|", $response);
		
        //display_response($response_n,$data);
		
			//echo WL_SHOWALLRESPONSE;
		 	//$parameters['showAllResponse']=WL_SHOWALLRESPONSE;
			//print_r($parameters);
		 	$dataar=array();
		   foreach($response_n as $val) {
			    $response1=explode("=", $val);
				/*echo "<pre>";
				print_r($response1);
				echo "<pre>";*/
				$key=$response1[0];
				$dataar[$key]=$response1[1];
				
				  //$data=$this->getdetails($response1[0], $parameters);
				 	//print_r($data);
		   }
		   if($dataar['clnt_txn_ref']){
			  	$order_id=$dataar['clnt_txn_ref'];
				$txndata=$this->cholamod->getCholaBookingByOrder($order_id);
				$id=$txndata->cb_id;
			  	$name=$txndata->cb_name;
			    $mobile=$txndata->cb_mobile;
				$amount=$txndata->cb_amount;
				$book_fordate=date('d-m-Y',strtotime($txndata->cb_bookfordate));
				$txn_msg=strtolower($dataar['txn_msg']);

				if($dataar['txn_status']=="0300" && $txn_msg=="success"){
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
					
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['cb_transstatus']=$txn_msg;
						$dataup['cb_statuscode']=$txn_status;
						$dataup['cb_transdate']=$txn_date;
						$dataup['cb_bankrefno']=$tpsl_txn_id;
						$dataup['cb_statusdesc']=$txn_status;
						$dataup['cb_txnrefno']=$rqst_token;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=1;
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						$don_amt_final="Rs. ".number_format($amount);
						$sms_username=SMSIN_USERNAME;
						$sms_password=SMSIN_PASSWORD;
						$sms_senderid=SMSIN_SENDER_ID;
						$sms_channel=SMSIN_CHANNEL;
						$sms_route=SMSIN_ROUTE;
						$sms_peid="1701161788461996254";
						$cb_mobile="91".$cb_mobile;
					$sms_content="Dear Mr/Ms ".$name.", Chola booked for date ".$book_fordate.". Txn Id ".$order_id.", SMMDSB,PKL";	
					//$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked for date ".$cb_bookfordate.". Txn Id ".$cb_orderno.", SMMDSB,PKL";	
					$sms_text_final=urlencode($sms_content);
			    	$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;   
		
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$response=curl_exec($ch);
						curl_close($ch);
						
						$enc_id=$this->encryptcode->encrypt($id,ENC_KEY_PASS);
						redirect("online-chola-booking/status/$enc_id");	
				
				
					}
					}else{
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
					
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['cb_transstatus']=$txn_msg;
						$dataup['cb_statuscode']=$txn_status;
						$dataup['cb_transdate']=$txn_date;
						$dataup['cb_bankrefno']=$tpsl_txn_id;
						$dataup['cb_statusdesc']=$txn_status;
						$dataup['cb_txnrefno']=$rqst_token;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=0;
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						
						$enc_id=$this->encryptcode->encrypt($id,ENC_KEY_PASS);
						redirect("online-chola-booking/status/$enc_id");	
				
					}
					
					}
		 		  }
			}else{ redirect("online-chola-booking/no-response"); }
		}else{
			redirect("online-chola-booking/no-response");
    	}
		
	}
	public function no_response(){
		$arr['siteTitle']="No Response";
		$this->load->view('chola-no-response',$arr);
	}
	
	
}
?>