<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bhogpage_Controller extends CI_Controller {

	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Bhogweb_model','bhogmod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}

	public function bhog_booking_step(){
		$arr['siteTitle']="Bhog Booking";	
		$custsesid=$this->session->userdata('custsesid');

		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		} 

		$current_time=date("Y-m-d H:i:s");

		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_accept','Accept Condition','required|trim|xss_clean',array(
	    	'required'=>'Accept Terms & Condition field is required',
	    ));

		if($this->form_validation->run()==true){
			redirect("online-bhog-booking/step1");
		}else{
			$this->load->view('online-bhog-booking',$arr);
		}
	}

	public function bhog_booking_step1(){
		$arr['siteTitle']="Bhog Booking";	
		$custsesid=$this->session->userdata('custsesid');

		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		}

		$arr['templedata']=$this->bhogmod->getAllTemple();

		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_temple','Name', 'trim|required|xss_clean|callback_chkfortemple',array(
			'required'=>'Please select Temple',
		));

		if($this->form_validation->run()==true){
			$data=$this->input->post('cb_temple');
			$enc_cb_id=$this->encryptcode->encrypt($data,ENC_KEY_PASS);
			redirect("online-bhog-booking/step2/$enc_cb_id");
		}

		$this->load->view('online-bhog-booking-step1',$arr);
	}

	public function chkfortemple($cb_temple){
		$custsesid=$this->session->userdata('custsesid');

		if($cb_temple!="" && $custsesid!=""){
			$lastrow=$this->bhogmod->chkforbhogtemple($cb_temple,$custsesid);

			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");

			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
		        	$this->form_validation->set_message(
		        		'chkfortemple',
		        		"You can book bhog after $newdate_display using this account"
		        	);	
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

	public function bhog_booking_step2($enc_templeid){
		$arr['siteTitle']="Bhog Booking";	
		$custsesid=$this->session->userdata('custsesid');

		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		} 

        $temple_id=$this->encryptcode->decrypt($enc_templeid,ENC_KEY_PASS);
	
		/****** IP Based Check ********/
		$ip=$_SERVER['REMOTE_ADDR'];
		$ipbookingrow=$this->bhogmod->getLastBookFromThisIp($temple_id,$ip);
		
		if($ipbookingrow){
			$cb_ipdate=$ipbookingrow->cb_ipdate;
			$new_dateip=date('Y-m-d H:i:s', strtotime($cb_ipdate. ' + 45 days'));
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
		$abbbookingrow=$this->bhogmod->getLastBookFromThisAccount($temple_id,$custsesid);
		
		if($abbbookingrow){
			$cb_abdate=$abbbookingrow->cb_ipdate;

			if($cb_abdate!=""){
				$new_dateabb=date('Y-m-d H:i:s', strtotime($cb_abdate. ' + 45 days'));
				$current_datetimeabb=date("Y-m-d H:i:s");

				if($current_datetimeabb > $new_dateabb){
				   
				}else{
					$this->session->set_flashdata('feedback',"Something wrong please check terms and conditions");
					$this->session->set_flashdata('feedbackerr',"alert-danger");
					redirect("online-bhog-booking/step1");
				}	
			}
		}
		
		$arr['templedata']=$this->bhogmod->getPerTemple($temple_id);
	       
		$arr['bh_datebooked']=$this->bhogmod->getAllBhogDateBooked($temple_id);
		$arr['bh_inactivedate']=$this->bhogmod->getAllInactiveDateBhog($temple_id);
		$arr['bh_processdate']=$this->bhogmod->getAllProcessDateBhog($temple_id);
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');

		$this->form_validation->set_rules(
			'cb_bookfordate',
			'Booking Date',
			'trim|required|callback_chkbhogdate|xss_clean',
			array('required'=>'Booking Date field is required')
		);

		$this->form_validation->set_rules('cb_name','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
		));

		$this->form_validation->set_rules(
			'cb_aadhaar',
			'Aadhaar',
			'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaareligible|xss_clean',
			array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			)
		);

		$this->form_validation->set_rules(
			'cb_mobile',
			'Mobile',
			'numeric|trim|required|min_length[10]|max_length[10]|callback_chkmobeligible|xss_clean',
			array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
			)
		);
		
		if($this->input->post('cb_othermember')=="Yes"){
			
			$this->form_validation->set_rules('cb_member_name1','Name', 'trim|required|xss_clean',array(
				'required'=>'Name field is required',
			));

			$this->form_validation->set_rules(
				'cb_member_aadhaar1',
				'Aadhaar',
				'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup1|callback_chkaadhaareligible1|xss_clean',
				array(
					'required'=>'Aadhaar Number required',
					'min_length'=>'Enter 12 digit aadhaar no',
					'max_length'=>'Enter 12 digit aadhaar no',
				)
			);

			$this->form_validation->set_rules(
				'cb_member_mobile1',
				'Mobile',
				'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob1|callback_chkmobeligible1|xss_clean',
				array('required'=>'Mobile field is required')
			);
			
			if(
				$this->input->post('cb_member_name2')!="" ||
				$this->input->post('cb_member_aadhaar2')!="" ||
				$this->input->post('cb_member_mobile2')!=""
			){
				$this->form_validation->set_rules('cb_member_name2','Name', 'trim|required|xss_clean',array(
					'required'=>'Name field is required',
				));

				$this->form_validation->set_rules(
					'cb_member_aadhaar2',
					'Aadhaar',
					'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup2|callback_chkaadhaareligible2|xss_clean',
					array(
						'required'=>'Aadhaar Number required',
						'min_length'=>'Enter 12 digit aadhaar no',
						'max_length'=>'Enter 12 digit aadhaar no',
					)
				);

				$this->form_validation->set_rules(
					'cb_member_mobile2',
					'Mobile',
					'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob2|callback_chkmobeligible2|xss_clean',
					array('required'=>'Mobile field is required')
				);
			}

			if(
				$this->input->post('cb_member_name3')!="" ||
				$this->input->post('cb_member_aadhaar3')!="" ||
				$this->input->post('cb_member_mobile3')!=""
			){
				$this->form_validation->set_rules('cb_member_name3','Name', 'trim|required|xss_clean',array(
					'required'=>'Name field is required',
				));	

				$this->form_validation->set_rules(
					'cb_member_aadhaar3',
					'Aadhaar',
					'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup3|callback_chkaadhaareligible3|xss_clean',
					array(
						'required'=>'Aadhaar Number required',
						'min_length'=>'Enter 12 digit aadhaar no',
						'max_length'=>'Enter 12 digit aadhaar no',
					)
				);

				$this->form_validation->set_rules(
					'cb_member_mobile3',
					'Mobile',
					'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob3|callback_chkmobeligible3|xss_clean',
					array('required'=>'Mobile field is required')
				);
			}

			if(
				$this->input->post('cb_member_name4')!="" ||
				$this->input->post('cb_member_aadhaar4')!="" ||
				$this->input->post('cb_member_mobile4')!=""
			){
				$this->form_validation->set_rules('cb_member_name4','Name', 'trim|required|xss_clean',array(
					'required'=>'Name field is required',
				));

				$this->form_validation->set_rules(
					'cb_member_aadhaar4',
					'Aadhaar',
					'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup4|callback_chkaadhaareligible4|xss_clean',
					array(
						'required'=>'Aadhaar Number required',
						'min_length'=>'Enter 12 digit aadhaar no',
						'max_length'=>'Enter 12 digit aadhaar no',
					)
				);

				$this->form_validation->set_rules(
					'cb_member_mobile4',
					'Mobile',
					'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob4|callback_chkmobeligible4|xss_clean',
					array('required'=>'Mobile field is required')
				);
			}

			if(
				$this->input->post('cb_member_name5')!="" ||
				$this->input->post('cb_member_aadhaar5')!="" ||
				$this->input->post('cb_member_mobile5')!=""
			){
				$this->form_validation->set_rules('cb_member_name5','Name', 'trim|required|xss_clean',array(
					'required'=>'Name field is required',
				));		

				$this->form_validation->set_rules(
					'cb_member_aadhaar5',
					'Aadhaar',
					'numeric|trim|required|min_length[12]|max_length[12]|callback_chkaadhaardup5|callback_chkaadhaareligible5|xss_clean',
					array(
						'required'=>'Aadhaar Number required',
						'min_length'=>'Enter 12 digit aadhaar no',
						'max_length'=>'Enter 12 digit aadhaar no',
					)
				);

				$this->form_validation->set_rules(
					'cb_member_mobile5',
					'Mobile',
					'numeric|trim|required|min_length[10]|max_length[10]|callback_chkdupmob5|callback_chkmobeligible5|xss_clean',
					array('required'=>'Mobile field is required')
				);
			}
		}

		$cb_proof="";	

		if(empty($_FILES['cb_proof']['name'])){
			$this->form_validation->set_rules(
				'cb_proof',
				'Passport size photograph',
				'trim|required|xss_clean',
				array('required'=>'Passport size photograph required')
			);
		}

		if(isset($_FILES['cb_proof']['name'])){
			$cb_proof=$_FILES['cb_proof']['name'];
		}

		$config=array(
			'upload_path'=>'./media/document/',
			'allowed_types'=>'jpeg|gif|jpg|png',
			'max_size'=>500,
			'overwrite'=>TRUE,
			'file_name'=>time().'_'.$cb_proof
		);

		$this->load->library('upload',$config);

		if($this->form_validation->run()==true && $this->upload->do_upload('cb_proof')){

			$data=$this->input->post();
			$cb_mobile=$data['cb_mobile'];

			$docup3=$this->upload->data();
			$proof="media/document/".$docup3['raw_name'].$docup3['file_ext'];

			$cb_bookfordate=$data['cb_bookfordate'];

			if($cb_bookfordate!=""){
				$data['cb_bookfordate']=date('Y-m-d',strtotime($cb_bookfordate));
			}
			
			$cb_bhog_otp=random_string('nozero',6);
			$data['cb_bhog_otp']=$cb_bhog_otp;

			$expiretime=date('Y-m-d H:i:s', strtotime("+5 min"));
			$data['cb_bhog_otpexpiry']=$expiretime;
			
			$data['proof']=$proof;
			$data['cb_temple']=$temple_id;
			$data['cb_ipaddress']=$ip;

			$cb_id=$this->bhogmod->insertBhogBookingTemp($data,$custsesid);

			if($cb_id){

				$cb_mobile_sms="91".$cb_mobile;
				$sms_username=SMSIN_USERNAME;
				$sms_password=SMSIN_PASSWORD;
				$sms_senderid=SMSIN_SENDER_ID;		
				$sms_channel=SMSIN_CHANNEL;		
				$sms_route=SMSIN_ROUTE;	
				$sms_generated=date("d-m-Y");
				$sms_generated_time=date("h:i:a");
					
				$sms_content="$cb_bhog_otp is your OTP for Bhog booking system. Please keep it safe for next 5 minutes. SMS generated on $sms_generated $sms_generated_time SMMDSB-PKL";

				$sms_text_final=urlencode($sms_content);

				$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile_sms."&text=".$sms_text_final."&route=".$sms_route."&peid=1701161788461996254";

				$ch=curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$response=curl_exec($ch);
				curl_close($ch);
			
				$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);

				$this->session->set_flashdata(
					'feedback',
					"Success: Please enter 6 digit One Time Password (OTP) send on your mobile $cb_mobile and valid for next 5 minute"
				);

				$this->session->set_flashdata('feedbackerr',"alert-success");
				
				redirect("online-bhog-booking/verify-otp/$enc_cb_id");

			}else{
				$this->session->set_flashdata('feedback',"Something wrong please try again");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("online-bhog-booking");
			}

		}else{
		    $arr['error3']=$this->upload->display_errors();	
		    $this->load->view('online-bhog-booking-step2',$arr);
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
			foreach(array($cb_mobile,$cb_member_mobile2,$cb_member_mobile3,$cb_member_mobile4,$cb_member_mobile5) as $mobile){
				if($mobile!="" && $cb_member_mobile1==$mobile){
					$countmob_error1[]=$msg_show;
				}
			}

			if(count($countmob_error1)>0){
				$this->form_validation->set_message('chkdupmob1',$msg_show);
				return false;
			}
		}

		return true;
	}

	public function chkdupmob2($cb_member_mobile2){
		$mobiles=array(
			$this->input->post('cb_mobile'),
			$this->input->post('cb_member_mobile1'),
			$this->input->post('cb_member_mobile3'),
			$this->input->post('cb_member_mobile4'),
			$this->input->post('cb_member_mobile5')
		);

		foreach($mobiles as $mobile){
			if($cb_member_mobile2!="" && $mobile!="" && $cb_member_mobile2==$mobile){
				$this->form_validation->set_message('chkdupmob2',"Please enter unique mobile number");
				return false;
			}
		}

		return true;
	}

	public function chkdupmob3($cb_member_mobile3){
		$mobiles=array(
			$this->input->post('cb_mobile'),
			$this->input->post('cb_member_mobile1'),
			$this->input->post('cb_member_mobile2'),
			$this->input->post('cb_member_mobile4'),
			$this->input->post('cb_member_mobile5')
		);

		foreach($mobiles as $mobile){
			if($cb_member_mobile3!="" && $mobile!="" && $cb_member_mobile3==$mobile){
				$this->form_validation->set_message('chkdupmob3',"Please enter unique mobile number");
				return false;
			}
		}

		return true;
	}

	public function chkdupmob4($cb_member_mobile4){
		$mobiles=array(
			$this->input->post('cb_mobile'),
			$this->input->post('cb_member_mobile1'),
			$this->input->post('cb_member_mobile2'),
			$this->input->post('cb_member_mobile3'),
			$this->input->post('cb_member_mobile5')
		);

		foreach($mobiles as $mobile){
			if($cb_member_mobile4!="" && $mobile!="" && $cb_member_mobile4==$mobile){
				$this->form_validation->set_message('chkdupmob4',"Please enter unique mobile number");
				return false;
			}
		}

		return true;
	}

	public function chkdupmob5($cb_member_mobile5){
		$mobiles=array(
			$this->input->post('cb_mobile'),
			$this->input->post('cb_member_mobile1'),
			$this->input->post('cb_member_mobile2'),
			$this->input->post('cb_member_mobile3'),
			$this->input->post('cb_member_mobile4')
		);

		foreach($mobiles as $mobile){
			if($cb_member_mobile5!="" && $mobile!="" && $cb_member_mobile5==$mobile){
				$this->form_validation->set_message('chkdupmob5',"Please enter unique mobile number");
				return false;
			}
		}

		return true;
	}

	/****** Check Duplicate Aadhaar Card ***/
	public function chkaadhaardup1($cb_member_aadhaar1){
		return $this->checkDuplicateAadhaar(
			$cb_member_aadhaar1,
			array(
				$this->input->post('cb_aadhaar'),
				$this->input->post('cb_member_aadhaar2'),
				$this->input->post('cb_member_aadhaar3'),
				$this->input->post('cb_member_aadhaar4'),
				$this->input->post('cb_member_aadhaar5')
			),
			'chkaadhaardup1'
		);
	}

	public function chkaadhaardup2($cb_member_aadhaar2){
		return $this->checkDuplicateAadhaar(
			$cb_member_aadhaar2,
			array(
				$this->input->post('cb_aadhaar'),
				$this->input->post('cb_member_aadhaar1'),
				$this->input->post('cb_member_aadhaar3'),
				$this->input->post('cb_member_aadhaar4'),
				$this->input->post('cb_member_aadhaar5')
			),
			'chkaadhaardup2'
		);
	}

	public function chkaadhaardup3($cb_member_aadhaar3){
		return $this->checkDuplicateAadhaar(
			$cb_member_aadhaar3,
			array(
				$this->input->post('cb_aadhaar'),
				$this->input->post('cb_member_aadhaar1'),
				$this->input->post('cb_member_aadhaar2'),
				$this->input->post('cb_member_aadhaar4'),
				$this->input->post('cb_member_aadhaar5')
			),
			'chkaadhaardup3'
		);
	}

	public function chkaadhaardup4($cb_member_aadhaar4){
		return $this->checkDuplicateAadhaar(
			$cb_member_aadhaar4,
			array(
				$this->input->post('cb_aadhaar'),
				$this->input->post('cb_member_aadhaar1'),
				$this->input->post('cb_member_aadhaar2'),
				$this->input->post('cb_member_aadhaar3'),
				$this->input->post('cb_member_aadhaar5')
			),
			'chkaadhaardup4'
		);
	}

	public function chkaadhaardup5($cb_member_aadhaar5){
		return $this->checkDuplicateAadhaar(
			$cb_member_aadhaar5,
			array(
				$this->input->post('cb_aadhaar'),
				$this->input->post('cb_member_aadhaar1'),
				$this->input->post('cb_member_aadhaar2'),
				$this->input->post('cb_member_aadhaar3'),
				$this->input->post('cb_member_aadhaar4')
			),
			'chkaadhaardup5'
		);
	}

	private function checkDuplicateAadhaar($aadhaar,$others,$callback){
		foreach($others as $value){
			if($aadhaar!="" && $value!="" && $aadhaar==$value){
				$this->form_validation->set_message($callback,"Please enter unique Aadhaar No.");
				return false;
			}
		}

		return true;
	}

	/******* Mobile Eligibility Check *****/
	public function chkmobeligible($cb_mobile){
		return $this->checkMobileEligibility($cb_mobile,'chkmobeligible');
	}

	public function chkmobeligible1($cb_member_mobile1){
		return $this->checkMobileEligibility($cb_member_mobile1,'chkmobeligible1');
	}

	public function chkmobeligible2($cb_member_mobile2){
		return $this->checkMobileEligibility($cb_member_mobile2,'chkmobeligible2');
	}

	public function chkmobeligible3($cb_member_mobile3){
		return $this->checkMobileEligibility($cb_member_mobile3,'chkmobeligible3');
	}

	public function chkmobeligible4($cb_member_mobile4){
		return $this->checkMobileEligibility($cb_member_mobile4,'chkmobeligible4');
	}

	public function chkmobeligible5($cb_member_mobile5){
		return $this->checkMobileEligibility($cb_member_mobile5,'chkmobeligible5');
	}

	private function checkMobileEligibility($mobile,$callback){
		$cb_temple=$this->input->post('temple_id');

		if($mobile!=""){
			$lastrow=$this->bhogmod->chkforbhogmob($mobile,$cb_temple);

			if($lastrow){
			    $subdate=$lastrow->cb_subdatetime;
			    $new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
			    $newdate_display=date('d-m-Y',strtotime($new_date));
			    $current_datetime=date("Y-m-d H:i:s");

			    if(($current_datetime >= $subdate) && ($current_datetime <= $new_date)){
		        	$this->form_validation->set_message(
		        		$callback,
		        		"You can book bhog after $newdate_display using this account"
		        	);

				    return false;	
			    }
			}
		}

		return true;
	}

	/*********** Aadhaar Eligibility Check **********/
	public function chkaadhaareligible($cb_aadhaar){
		return $this->checkAadhaarEligibility($cb_aadhaar,'chkaadhaareligible');
	}

	public function chkaadhaareligible1($cb_member_aadhaar1){
		return $this->checkAadhaarEligibility($cb_member_aadhaar1,'chkaadhaareligible1');
	}

	public function chkaadhaareligible2($cb_member_aadhaar2){
		return $this->checkAadhaarEligibility($cb_member_aadhaar2,'chkaadhaareligible2');
	}

	public function chkaadhaareligible3($cb_member_aadhaar3){
		return $this->checkAadhaarEligibility($cb_member_aadhaar3,'chkaadhaareligible3');
	}

	public function chkaadhaareligible4($cb_member_aadhaar4){
		return $this->checkAadhaarEligibility($cb_member_aadhaar4,'chkaadhaareligible4');
	}

	public function chkaadhaareligible5($cb_member_aadhaar5){
		return $this->checkAadhaarEligibility($cb_member_aadhaar5,'chkaadhaareligible5');
	}

	private function checkAadhaarEligibility($aadhaar,$callback){
		$cb_temple=$this->input->post('temple_id');

		if($aadhaar!="" && $cb_temple!=""){
			$lastrow=$this->bhogmod->chkforbhogaadhaar($aadhaar,$cb_temple);

			if($lastrow){
				$subdate=$lastrow->cb_subdatetime;
				$new_date=date('Y-m-d H:i:s', strtotime($subdate. ' + 45 days'));
				$newdate_display=date('d-m-Y',strtotime($new_date));
				$current_datetime=date("Y-m-d H:i:s");

				if($current_datetime > $new_date){
					return true;	
				}else{
					$this->form_validation->set_message(
						$callback,
						"You can book bhog after date $newdate_display"
					);

					return false;
				}
			}
		}

		return true;
	}

	public function bhog_booking_verifyotp($enc_cb_id){
		$arr['siteTitle']="Bhog Booking";		
		$custsesid=$this->session->userdata('custsesid');
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);

		$arr['bhogtemp']=$this->bhogmod->getPerBhogBookingTemp($cb_id);
		$cb_mobile=$arr['bhogtemp']->cb_mobile;
		
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		}

		if(isset($_POST['resendotp'])){
			$dataup=array();

			$cb_bhog_otp=random_string('nozero',6);
			$dataup['cb_bhog_otp']=$cb_bhog_otp;

			$expiretime=date('Y-m-d H:i:s', strtotime("+5 min"));
			$dataup['cb_bhog_otpexpiry']=$expiretime;

			$upotp=$this->bhogmod->updateOtpResend($dataup,$cb_id);

			if($upotp){
				$cb_mobile_sms="91".$cb_mobile;
				$sms_username=SMSIN_USERNAME;
				$sms_password=SMSIN_PASSWORD;
				$sms_senderid=SMSIN_SENDER_ID;		
				$sms_channel=SMSIN_CHANNEL;		
				$sms_route=SMSIN_ROUTE;	
				$sms_generated=date("d-m-Y");
				$sms_generated_time=date("h:i:a");

				$sms_content="$cb_bhog_otp is your OTP for Bhog booking system. Please keep it safe for next 5 minutes. SMS generated on $sms_generated $sms_generated_time SMMDSB-PKL";

				$sms_text_final=urlencode($sms_content);

				$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile_sms."&text=".$sms_text_final."&route=".$sms_route."&peid=1701161788461996254";

				$ch=curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$response=curl_exec($ch);
				curl_close($ch);
				
				$this->session->set_flashdata(
					'feedback',
					"Success: Please enter 6 digit One Time Password (OTP) send on your mobile $cb_mobile and valid for next 5 minute"
				);

				$this->session->set_flashdata('feedbackerr',"alert-success");

				redirect("online-bhog-booking/verify-otp/$enc_cb_id");
			}
		}

		if(isset($_POST['verifyotp_btn'])){
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');

			$this->form_validation->set_rules(
				'cb_bhog_otp',
				'OTP',
				'trim|required|xss_clean|callback_chkotp',
				array('required'=>'Please enter OTP')
			);
			
			if($this->form_validation->run()==true){
				$upotpvs=$this->bhogmod->upOtpVerSuccess($cb_id);

				if($upotpvs){
					redirect("online-bhog-booking/overview/$enc_cb_id");
				}
			}
		}

		$this->load->view('online-bhog-booking-verifyotp',$arr);	
	}

	public function chkotp($cb_bhog_otp){
		$encbid=$this->input->post('encbid'); 

		if($encbid!="" && $cb_bhog_otp!=""){
			$cb_id=$this->encryptcode->decrypt($encbid,ENC_KEY_PASS);
			$rowbook=$this->bhogmod->getPerOtp($cb_id,$cb_bhog_otp);

			if($rowbook){
				$cb_bhog_otpexpiry=$rowbook->cb_bhog_otpexpiry;
				$current_time=date("Y-m-d H:i:s");
				
				if($cb_bhog_otpexpiry>=$current_time){
					return true;
				}else{
					$this->form_validation->set_message(
						'chkotp',
						'OTP expired. Click resend OTP button again'
					);

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

	public function bhog_booking_payment($enc_cb_id){
		$ip=$_SERVER['REMOTE_ADDR'];

		$arr['siteTitle']="Bhog Booking Details";

		$custsesid=$this->session->userdata('custsesid');

		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		} 
		
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);

		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);

		$arr['bhogtemp']=$this->bhogmod->getPerBhogBookingTemp($cb_id);

		$amount=$arr['bhogtemp']->temple_fee;	
		
		/***** Check For Verification *******/
		$cb_bhog_otpverification=$arr['bhogtemp']->cb_bhog_otpverification;

		if($cb_bhog_otpverification==0){
			$this->session->set_flashdata('feedback',"OTP Verificaton not completed");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
			redirect("online-bhog-booking/verify-otp/$enc_cb_id");
		}
		
		$temple_id=$arr['bhogtemp']->cb_temple;

		$arr['templedata']=$this->bhogmod->getPerTemple($temple_id);

		$temple_name=$arr['templedata']->temple_name;
		$temple_shortcode=$arr['templedata']->temple_shortcode;

		if($arr['bhogtemp']){
		
			if(isset($_POST['bookBhog'])){

				$this->form_validation->set_error_delimiters('<span class="error">','</span>');

				$this->form_validation->set_rules(
					'cb_bookfordate',
					'Booking Date',
					'trim|required|callback_chkbhogdate|xss_clean',
					array('required'=>'Booking Date field is required')
				);

				if($this->form_validation->run()==true){
					
					$ipbookingrow=$this->bhogmod->getLastBookFromThisIp($temple_id,$ip);

					if($ipbookingrow){
						$cb_ipdate=$ipbookingrow->cb_ipdate;
						$new_dateip=date('Y-m-d H:i:s', strtotime($cb_ipdate. ' + 45 days'));
						$current_datetimeip=date("Y-m-d H:i:s");

						if($current_datetimeip > $new_dateip){
							return true;	
						}else{
							$this->session->set_flashdata(
								'feedback',
								"Something wrong please check terms and conditions"
							);

							$this->session->set_flashdata('feedbackerr',"alert-danger");
							redirect("online-bhog-booking/overview/$enc_cb_id");
						}	
					}

					/******** Account Based Check *******/
					$abbbookingrow=$this->bhogmod->getLastBookFromThisAccount($temple_id,$custsesid);

					if($abbbookingrow){
						$cb_abdate=$abbbookingrow->cb_ipdate;

						if($cb_abdate!=""){
							$new_dateabb=date('Y-m-d H:i:s', strtotime($cb_abdate. ' + 45 days'));
							$current_datetimeabb=date("Y-m-d H:i:s");

							if($current_datetimeabb > $new_dateabb){
								return true;	
							}else{
								$this->session->set_flashdata(
									'feedback',
									"Something wrong please check terms and conditions"
								);

								$this->session->set_flashdata('feedbackerr',"alert-danger");
								redirect("online-bhog-booking/overview/$enc_cb_id");
							}	
						}
					}

					$time=date("dmyHis");

					$txnid=$temple_shortcode."-".
						substr(hash('sha256', mt_rand() . microtime()),0,4).
						$time;

					$datach=array();

					$datach['cb_orderno']=$txnid;
					$datach['cb_regid']=$custsesid;
					$datach['cb_bookfordate']=$arr['bhogtemp']->cb_bookfordate;

					$datach['cb_name']=$arr['bhogtemp']->cb_name;
					$datach['cb_mobile']=$arr['bhogtemp']->cb_mobile;

					$reg_email=$arr['regdata']->reg_email;
					$datach['cb_email']=$reg_email;

					$address=$arr['regdata']->reg_address_line1;

					if($arr['regdata']->reg_address_line2!=""){
						$address=$address." ".$arr['regdata']->reg_address_line2;
					}

					$datach['cb_address']=$address;
					$datach['cb_city']=$arr['regdata']->reg_city;
					$datach['cb_state']=$arr['regdata']->reg_state;
					$datach['cb_pincode']=$arr['regdata']->reg_pincode;

					$datach['cb_paymethod']=3;
					$datach['cb_proof']=$arr['bhogtemp']->cb_proof;
					$datach['cb_temple']=$arr['bhogtemp']->cb_temple;
					$datach['cb_templename']=$temple_name;
					$datach['cb_aadhar']=$arr['bhogtemp']->cb_aadhaar;
					$datach['cb_othermember']=$arr['bhogtemp']->cb_othermember;

					for($i=1;$i<=5;$i++){
						$datach['cb_devotee_name'.$i]=$arr['bhogtemp']->{'cb_member_name'.$i};
						$datach['cb_devotee_mobile'.$i]=$arr['bhogtemp']->{'cb_member_mobile'.$i};
						$datach['cb_devotee_aadhar'.$i]=$arr['bhogtemp']->{'cb_member_aadhaar'.$i};
					}

					$datach['cb_amount']=$amount;
					$datach['cb_ipaddress']=$ip;

					$bhog_bid=$this->bhogmod->insertBhogBooking($datach);

					if($bhog_bid){

						$this->load->library('paynimo/TransactionRequestBean');

						$transactionRequestBean=new TransactionRequestBean();

						$bhrow=$this->bhogmod->getPerBhogBooking($bhog_bid);

						$cb_orderno=$bhrow->cb_orderno;
						$cb_name=$bhrow->cb_name;
						$cb_amount=$bhrow->cb_amount;
						$cb_mobile=$bhrow->cb_mobile;

						$itc=$bhog_bid;		
						$amount_final=number_format($amount,1,'.','');

						$scheme_code="FIRST_".$amount_final."_0.0";	 
	
						$return_url=site_url("online-bhog-booking/worldline/response");

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

						$datapay=array(
							'merchantCode'=>$transactionRequestBean->merchantCode,
							'ITC'=>$transactionRequestBean->ITC,
							'customerName'=>$transactionRequestBean->customerName,
							'requestType'=>$transactionRequestBean->requestType,
							'merchantTxnRefNumber'=>$transactionRequestBean->merchantTxnRefNumber,
							'amount'=>$transactionRequestBean->amount,
							'currencyCode'=>$transactionRequestBean->currencyCode,
							'returnURL'=>$transactionRequestBean->returnURL,
							'shoppingCartDetails'=>$transactionRequestBean->shoppingCartDetails,
							'TPSLTxnID'=>$transactionRequestBean->TPSLTxnID,
							'mobileNumber'=>$transactionRequestBean->mobileNumber,
							'txnDate'=>$transactionRequestBean->txnDate,
							'bankCode'=>$transactionRequestBean->bankCode,
							'custId'=>$transactionRequestBean->custId,
							'key'=>$transactionRequestBean->key,
							'iv'=>$transactionRequestBean->iv,
							'accountNo'=>$transactionRequestBean->accountNo,
							'webServiceLocator'=>$transactionRequestBean->webServiceLocator,
							'timeOut'=>$transactionRequestBean->timeOut
						);

						$datapayser=serialize($datapay);		

						$this->bhogmod->upPerBhogParms($datapayser,$bhog_bid);	

						$responseDetails=$transactionRequestBean->getTransactionToken();
					    $responseDetails=(array)$responseDetails;
					    $response=$responseDetails[0];

						$this->bhogmod->delPerTempBhogBooking($cb_id);

					    echo "<script>window.location = '" . $response . "'</script>";
					    ob_flush();
					}
				}
			}
		}else{
			redirect("online-bhog-booking");
		}

		$this->load->view('online-bhog-booking-overview',$arr);
	}

	public function chkbhogdate($cb_bookfordate){
		$temple_id=$this->input->post('temple_id');

		if($cb_bookfordate!="" && $temple_id!=""){

			$cb_bookfordate=date('Y-m-d',strtotime($cb_bookfordate));

			$count_date=$this->bhogmod->count_bhogdate($cb_bookfordate,$temple_id);

			if($count_date==0){

				$count_inactive=$this->bhogmod->count_inactivedate($cb_bookfordate,$temple_id);

				if($count_inactive==0){

					$count_processing=$this->bhogmod->count_processing($cb_bookfordate,$temple_id);

					if($count_processing==0){

						$book_datetime=strtotime($cb_bookfordate);
						$current_datetime=strtotime(date('Y-m-d'));

						if($book_datetime<$current_datetime){

							$this->form_validation->set_message(
								'chkbhogdate',
								'Please enter valid date'
							);

							return FALSE;	

						}else{

							$three_month=date('Y-m-d', strtotime('+ 45 days'));
							$threem_time=strtotime($three_month);

							if($book_datetime>$threem_time){

								$this->form_validation->set_message(
									'chkbhogdate',
									'Please select date between 45 days from current date'
								);

								return FALSE;

							}else{

								if($cb_bookfordate==$three_month){

									$time_check="10:00";
									$current_time=date("H:i");

									if($current_time<$time_check){

										$this->form_validation->set_message(
											'chkbhogdate',
											'Booking start 10:00am for this date'
										);

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
						$this->form_validation->set_message(
							'chkbhogdate',
							'Booking is processing for this date'
						);

						return FALSE;	
					}

				}else{

					$this->form_validation->set_message(
						'chkbhogdate',
						'Booking is off for this date'
					);

					return FALSE;	 									                
				}

			}else{

				$this->form_validation->set_message(
					'chkbhogdate',
					'This date is unavailable at this time'
				);

				return FALSE;
			}
			
		}else{

			$this->form_validation->set_message(
				'chkbhogdate',
				'Date Invalid. Please try again'
			);

			return FALSE;	
		}		
	}

	public function bhog_status_preview($enc_cb_id){
		$arr['siteTitle']="Payment Status detail";

		$custsesid=$this->session->userdata('custsesid');

		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-bhog-booking");
			redirect('login');
		} 

		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);

		$arr['cbdata']=$this->bhogmod->getPerBhogBooking($cb_id);	

		$this->load->view('bhogbooking-success-status',$arr);
	}

	public function bhogpayment_status($enc_cb_id){
		$arr['siteTitle']="Payment Status Detail";

		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);

		$arr['cbdata']=$this->bhogmod->getPerBhogBooking($cb_id);	

		$this->load->view('bhogbooking-status',$arr);
	}
	
	public function worldline_bhog_response(){

		$this->load->library('paynimo/TransactionResponseBean');

		if($_POST){

			if(isset($_POST['msg'])){

		        $response=$_POST;

		        if(is_array($response)){
		            $str=$response['msg'];

		        }else if(is_string($response) && strstr($response,'msg=')){

		            $outputstr=str_replace('msg=','',$response);
		            $outputArr=explode('&',$outputstr);
		            $str=$outputArr[0];

		        }else{
		            $str=$response;
		        }

		        $transactionResponseBean=new TransactionResponseBean();

		        $transactionResponseBean->setResponsePayload($str);
		        $transactionResponseBean->key=WL_KEY;
		        $transactionResponseBean->iv=WL_IV;

		        $response=$transactionResponseBean->getResponsePayload();

		        $response_n=explode("|",$response);

		        $dataar=array();

		        foreach($response_n as $val){

				    $response1=explode("=", $val, 2);

				    if(count($response1)==2){
				    	$key=$response1[0];
				    	$dataar[$key]=$response1[1];
				    }
				}

				if(isset($dataar['clnt_txn_ref']) && $dataar['clnt_txn_ref']){

					$order_id=$dataar['clnt_txn_ref'];

					$txndata=$this->bhogmod->getBhogBookingByOrder($order_id);

					$id=$txndata->cb_id;
					$name=$txndata->cb_name;
					$mobile=$txndata->cb_mobile;
					$amount=$txndata->cb_amount;

					$book_fordate=date(
						'd-m-Y',
						strtotime($txndata->cb_bookfordate)
					);

					$txn_msg=strtolower($dataar['txn_msg']);

					$dataup=array();

					$txn_msg=$dataar['txn_msg'];
					$txn_status=$dataar['txn_status'];
					$tpsl_txn_time=$dataar['tpsl_txn_time'];
					$tpsl_txn_id=$dataar['tpsl_txn_id'];
					$rqst_token=$dataar['rqst_token'];
					
					$txn_date=date(
						'Y-m-d H:i:s',
						strtotime($tpsl_txn_time)
					);

					$dataup['cb_transstatus']=$txn_msg;
					$dataup['cb_statuscode']=$txn_status;
					$dataup['cb_transdate']=$txn_date;
					$dataup['cb_bankrefno']=$tpsl_txn_id;
					$dataup['cb_statusdesc']=$txn_status;
					$dataup['cb_txnrefno']=$rqst_token;
					$dataup['cb_up']=1;

					if($dataar['txn_status']=="0300" && strtolower($dataar['txn_msg'])=="success"){

						$dataup['cb_dateup']=1;

						$uptxn=$this->bhogmod->upTxnByRefNo(
							$dataup,
							$order_id
						);

						if($uptxn){

							$sms_username=SMSIN_USERNAME;
							$sms_password=SMSIN_PASSWORD;
							$sms_senderid=SMSIN_SENDER_ID;
							$sms_channel=SMSIN_CHANNEL;
							$sms_route=SMSIN_ROUTE;
							$sms_peid="1701161788461996254";

							$sms_content="Dear Mr/Ms ".$name.
								", Bhog booked for date ".$book_fordate.
								". Txn Id ".$order_id.
								", SMMDSB,PKL";

							$sms_text_final=urlencode($sms_content);

							$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username.
								"&password=".$sms_password.
								"&senderid=".$sms_senderid.
								"&channel=".$sms_channel.
								"&DCS=0&flashsms=0&number=".$mobile.
								"&text=".$sms_text_final.
								"&route=".$sms_route.
								"&peid=".$sms_peid;

							$ch=curl_init();
							curl_setopt($ch,CURLOPT_URL,$url);
							curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
							$response=curl_exec($ch);
							curl_close($ch);

							$enc_id=$this->encryptcode->encrypt(
								$id,
								ENC_KEY_PASS
							);

							redirect("online-bhog-booking/status/$enc_id");
						}

					}else{

						$dataup['cb_dateup']=0;

						$uptxn=$this->bhogmod->upTxnByRefNo(
							$dataup,
							$order_id
						);

						if($uptxn){

							$enc_id=$this->encryptcode->encrypt(
								$id,
								ENC_KEY_PASS
							);

							redirect("online-bhog-booking/status/$enc_id");
						}
					}
				}

			}else{
				redirect("online-bhog-booking/no-response");
			}

		}else{
			redirect("online-bhog-booking/no-response");
    	}
	}

	public function no_response(){
		$arr['siteTitle']="No Response";
		$this->load->view('bhog-no-response',$arr);
	}
}
?>
