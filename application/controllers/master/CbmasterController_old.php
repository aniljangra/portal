<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CbmasterController extends CI_Controller{
	 function __construct() { 
        parent::__construct(); 
		$this->load->helper(array('form','url','security')); 
		$this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('master/CholadatesetModel','dsetmod');
		$this->load->model('master/Admin_model','admod');
		$this->load->model('master/CbmasterModel','cbmod');
		$this->load->database(); 
	} 
	public function chola_book_step1(){
		$arr['siteTitle']='Manage Date Seeting';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$adminrow=$this->admod->getAdminProfile($masterId);
		$temple_id=$adminrow->ad_temple;
		$arr['templedata']=$this->cbmod->getPerTemple($temple_id);
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|callback_chkcholadate|xss_clean',array(
		'required'=>'Booking Date field is required',
		));	
		$this->form_validation->set_rules('cb_name','Name', 'trim|required|xss_clean',array(
		'required'=>'Name field is required',
		));
	$this->form_validation->set_rules('cb_aadhaar','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
			'required'=>'Aadhaar Number required',
			'min_length'=>'Enter 12 digit aadhaar no',
			'max_length'=>'Enter 12 digit aadhaar no',
		));
		$this->form_validation->set_rules('cb_mobile','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
			'required'=>'Mobile field is required',
			'cb_mobile'=>'Enter 10 digit mobile no',
			'cb_mobile'=>'Enter 10 digit mobile no',
		));
		
		if($this->input->post('cb_othermember')=="Yes"){
			
			$this->form_validation->set_rules('cb_member_name1','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar1','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile1','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			
			
			
			if($this->input->post('cb_member_name2')!="" || $this->input->post('cb_member_aadhaar2')!="" || $this->input->post('cb_member_mobile2')!=""){
			$this->form_validation->set_rules('cb_member_name2','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar2','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile2','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			if($this->input->post('cb_member_name3')!="" || $this->input->post('cb_member_aadhaar3')!="" || $this->input->post('cb_member_mobile3')!=""){
				
			$this->form_validation->set_rules('cb_member_name3','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));	
				
			$this->form_validation->set_rules('cb_member_aadhaar3','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]||xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile3','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			if($this->input->post('cb_member_name4')!="" || $this->input->post('cb_member_aadhaar4')!="" || $this->input->post('cb_member_mobile4')!=""){
			$this->form_validation->set_rules('cb_member_name4','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar4','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile4','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			
			if($this->input->post('cb_member_name5')!="" || $this->input->post('cb_member_aadhaar5')!="" || $this->input->post('cb_member_mobile5')!=""){
			$this->form_validation->set_rules('cb_member_name5','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));		
			$this->form_validation->set_rules('cb_member_aadhaar5','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile5','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean',array(
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
			$data['proof']=$proof;
			$data['cb_temple']=$temple_id;
			$cb_id=$this->cbmod->insertCholaBookingTemp($data);
			if($cb_id){
				$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
				//$this->session->set_flashdata('feedbackerr',"alert-success");
				redirect("master/chola-booking/overview/$enc_cb_id");
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please try again");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("master/chola-booking");
			}
		}else{
		    $arr['error3']=$this->upload->display_errors();	
		    $this->load->view("master/master-cholabooking-step1",$arr);	
		}
	}
	public function chola_book_step2($enc_cb_id){
		$arr['siteTitle']='Chola Booking Step 2';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$adminrow=$this->admod->getAdminProfile($masterId);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		
		$arr['cholatemp']=$this->cbmod->getPerCholaBookingTemp($cb_id);
		$temple_id=$arr['cholatemp']->cb_temple;
		$arr['templedata']=$this->cbmod->getPerTemple($temple_id);

		$success_url="https://www.mansadevi.org.in/portal/master/chola-booking/success";
		$fail_url="https://www.mansadevi.org.in/portal/master/chola-booking/failure";
		$response_url="https://www.mansadevi.org.in/portal/master/chola-booking/worldline/response";
		
		
		//$success_url="https://www.mansadevi.org.in/portal/online-chola-booking/success";
		//$fail_url="https://www.mansadevi.org.in/portal/online-chola-booking/failure";
		//$response_url="https://www.mansadevi.org.in/portal/online-chola-booking/worldline/response";
		
		
	
		$amount=$arr['cholatemp']->temple_fee;	
		// $arr['tempdata']=($arr['cholatemp']->cb_data);
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
			
				$data=$this->input->post();
				//echo "yes";
		$data=$this->input->post();
		$time=date("dmyHis");
		$txnid=$temple_shortcode."-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;
		$datach['cb_orderno']=$txnid;
		$datach['cb_adminid']=$masterId;
		$datach['cb_bookfordate']=$arr['cholatemp']->cb_bookfordate;
		$name=$arr['cholatemp']->cb_name;
		$datach['cb_name']=$arr['cholatemp']->cb_name;
		$datach['cb_mobile']=$arr['cholatemp']->cb_mobile;
		//$reg_email=$arr['regdata']->reg_email;
		$datach['cb_email']=NULL;
		
		$datach['cb_address']=NULL;
		$datach['cb_city']=NULL;
		$datach['cb_state']=NULL;
		$datach['cb_pincode']=NULL;
		$datach['cb_paymethod']=2;
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
	  $chola_bid=$this->cbmod->insertCholaBooking($datach);
				if($chola_bid){
					
				
					$mid=WORLDLINE_MID;
					$enckey=WORLDLINE_ENCKEY;
					$cbrow=$this->cbmod->getPerCholaBooking($chola_bid);
					$cb_orderno=$cbrow->cb_orderno;
					$cb_amount=$cbrow->cb_amount;
					$cb_bookfordate=$cbrow->cb_bookfordate;
					$cb_name=$cbrow->cb_name;
					$cb_mobile=$cbrow->cb_mobile;
					$cb_email=$cbrow->cb_email;
					$cb_state=$cbrow->cb_state;
					$cb_regid=$cbrow->cb_regid;
					$addField8="";
					$recurPeriod="";
					$recurDay="";
					$numberRecurring="";
					$amount_final=$cb_amount*100;
					$this->load->library('worldline/AWLMEAPI');
					$obj=new AWLMEAPI();
					$reqMsgDTO=new ReqMsgDTO();
		$obj=new AWLMEAPI();
		//create an object of Request Message
		$reqMsgDTO = new ReqMsgDTO();
		/* Populate the above DTO Object On the Basis Of The Received Values */
		// PG MID
		$reqMsgDTO->setMid($mid);
		// Merchant Unique order id
		$reqMsgDTO->setOrderId($cb_orderno);
		//Transaction amount in paisa format
		$reqMsgDTO->setTrnAmt($amount_final);
		//Transaction remarks
		$reqMsgDTO->setTrnRemarks($mid);
		// Merchant transaction type (S/P/R)
		$reqMsgDTO->setMeTransReqType('S');
		// Merchant encryption key
		$reqMsgDTO->setEnckey($enckey);
		// Merchant transaction currency
		$reqMsgDTO->setTrnCurrency('INR');
		// Recurring period, if merchant transaction type is R
		$reqMsgDTO->setRecurrPeriod($recurPeriod);
		// Recurring day, if merchant transaction type is R
		$reqMsgDTO->setRecurrDay($recurDay);
		// No of recurring, if merchant transaction type is R
		$reqMsgDTO->setNoOfRecurring($numberRecurring);
		// Merchant response URl
		$reqMsgDTO->setResponseUrl($response_url);
		// Optional additional fields for merchant
		$reqMsgDTO->setAddField1($chola_bid);
		$reqMsgDTO->setAddField2($cb_bookfordate);
		$reqMsgDTO->setAddField3($cb_name);
		$reqMsgDTO->setAddField4($cb_mobile);
		$reqMsgDTO->setAddField5($cb_email);
		$reqMsgDTO->setAddField6($cb_state);
		$reqMsgDTO->setAddField7($cb_regid);
		$reqMsgDTO->setAddField8($addField8);
		/* 
		 * After Making Request Message Send It To Generate Request 
		 * The variable `$urlParameter` contains encrypted request message
		 */
		 //Generate transaction request message
		$merchantRequest = "";
		$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
		if ($reqMsgDTO->getStatusDesc() == "Success"){
			$merchantRequest = $reqMsgDTO->getReqMsg();
		}
		 $this->cbmod->delPerTempCholaBooking($cb_id);
	?>
	
	
	<form action="https://ipg.in.worldline.com/doMEPayRequest" method="post" name="txnSubmitFrm">
		<h4 align="center">Redirecting To Payment Please Wait..</h4>
		<h4 align="center">Please Do Not Press Back Button OR Refresh Page</h4>
	<input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="<?php echo $merchantRequest; ?>"  />
		<input type="hidden" name="MID" id="MID" value="<?php echo $reqMsgDTO->getMid(); ?>"/>
	</form>
	<script  type="text/javascript">
		//submit the form to the worldline
		document.txnSubmitFrm.submit();
	</script>
					
					
			<?php	}
				
				}
			}
		}else{
				
			redirect("master/chola-booking/overview/$enc_cb_id");
		}
		 $this->load->view("master/master-cholabooking-step2",$arr);	
	}
	public function chkcholadate($cb_bookfordate){
		$temple_id=$this->input->post('temple_id');
		if($cb_bookfordate!="" && $temple_id!=""){
			$cb_bookfordate=date('Y-m-d',strtotime($cb_bookfordate));
			$count_date=$this->cbmod->count_choladate($cb_bookfordate,$temple_id);
			if($count_date==0){
					$count_processing=$this->cbmod->count_processing($cb_bookfordate,$temple_id);
					if($count_processing==0){
						/* Check Previous Date */
						$book_datetime=strtotime($cb_bookfordate);
						$current_datetime=strtotime(date('Y-m-d'));
						if($book_datetime<$current_datetime){
							$this->form_validation->set_message('chkcholadate', 'Please enter valid date');					
							return FALSE;	
						}else{
							//$three_month=date('Y-m-d', strtotime('+3 months'));
							$three_month=date('Y-m-d', strtotime('+ 180 days'));
							$threem_time=strtotime($three_month);
							if($book_datetime>$threem_time){
								$this->form_validation->set_message('chkcholadate', 'Please select date between three month from current date');					
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
									$count_inactive=$this->cbmod->count_inactivedate($cb_bookfordate,$temple_id);	
									if($count_inactive==0){
										$this->form_validation->set_message('chkcholadate', 'Date is not managed by admin');					
										return FALSE;	
									}else{
										return true;	
									}
									
								}
							}
						}
					}else{
					$this->form_validation->set_message('chkcholadate', 'Booking is processing for this date');					
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
	
	public function chola_book_status($enc_cb_id){
		$arr['siteTitle']='Bank Response';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$adminrow=$this->admod->getAdminProfile($masterId);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cbdata']=$this->cbmod->getPerCholaBooking($cb_id);
		 $this->load->view("master/master-cholabooking-status",$arr);
	}
		 
	public function worldline_chola_response(){
		$arr['siteTitle']='Bank Response';	
				
		$enckey=WORLDLINE_ENCKEY;
		$this->load->library('worldline/AWLMEAPI');
		$obj=new AWLMEAPI();
		$resMsgDTO=new ResMsgDTO();
		$reqMsgDTO=new ReqMsgDTO();
		$enc_key=$enckey;
		$responseMerchant = $_REQUEST['merchantResponse'];
		$response=$obj->parseTrnResMsg( $responseMerchant,$enc_key );
		
		
		

		
		
		if($response){
			$order_id=$response->getOrderId();
			$masterId=$this->session->userdata('masterId');
			if(empty($masterId)){
				//redirect('master/login');
				$orderdata=$this->cbmod->getCholaBookingByOrder($order_id);
				$cb_adminid=$orderdata->cb_adminid;
				
				$this->session->set_userdata('masterId',$cb_adminid);
			}
			$adminrow=$this->admod->getAdminProfile($masterId);
			
			
			if($response->getStatusCode()=="S"){
				$txn_status="SUCCESS";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->cbmod->getCholaBookingByOrder($order_id);
				if($txndata){
						$cb_id=$txndata->cb_id;
						if($txndata->cb_up==0){
						$cb_name=$txndata->cb_name;
						$cb_templename=$txndata->cb_templename;
                        $cb_name=$txndata->cb_name;
                        $cb_orderno=$txndata->cb_orderno;
                        $cb_mobile=$txndata->cb_mobile;
                        $cb_bookfordate=date('d-m-Y',strtotime($txndata->cb_bookfordate));
						$amount=$response->getTrnAmt();
						//$txn_status=$response->getStatusCode();
						$txn_status_desc=$response->getStatusDesc();
						$txn_reqdate=$response->getTrnReqDate();
						$txn_resdate=$response->getResponseCode();
						$txn_bankrefno=$response->getRrn();
						$auth_code=$response->getAuthZCode();
						$donation_id=$response->getAddField6();
						$donation_regid=$response->getAddField7();
						$dataup=array();
						$dataup['cb_transstatus']=$txn_status;
						$dataup['cb_transdate']=$txn_reqdate;
						$dataup['cb_bankrefno']=$txn_bankrefno;
						$dataup['cb_statusdesc']=$txn_status_desc;
						$dataup['cb_txnrefno']=$txn_refno;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=1;
						$uptxn=$this->cbmod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						    /* SMS */
				
						$don_amt_final="Rs. ".number_format($donation_amount);
						$sms_username=SMSIN_USERNAME;
						$sms_password=SMSIN_PASSWORD;
						$sms_senderid=SMSIN_SENDER_ID;
						$sms_channel=SMSIN_CHANNEL;
						$sms_route=SMSIN_ROUTE;
						$sms_peid="1701161788461996254";
						$cb_mobile="91".$cb_mobile;
					$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked for date ".$cb_bookfordate.". Txn Id ".$cb_orderno.", SMMDSB,PKL";	
					//$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked for date ".$cb_bookfordate.". Txn Id ".$cb_orderno.", SMMDSB,PKL";	
					$sms_text_final=urlencode($sms_content);
			    	$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;   
		
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$response=curl_exec($ch);
						curl_close($ch);
						
						$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
						redirect("master/chola-booking/status/$enc_cb_id");		
						}
					}else{
						$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
						redirect("master/chola-booking/status/$enc_cb_id");	
					}
				}
			}else{
				$txn_status="FAILED";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->cbmod->getCholaBookingByOrder($order_id);
				if($txndata){
					$cb_id=$txndata->cb_id;
						if($txndata->cb_up==0){
						$amount=$response->getTrnAmt();
						//$txn_status=$response->getStatusCode();
						$txn_status_desc=$response->getStatusDesc();
						$txn_reqdate=$response->getTrnReqDate();
						$txn_resdate=$response->getResponseCode();
						$txn_bankrefno=$response->getRrn();
						$auth_code=$response->getAuthZCode();
						$donation_id=$response->getAddField6();
						$donation_regid=$response->getAddField7();
						$dataup=array();
						$dataup['cb_transstatus']=$txn_status;
						$dataup['cb_transdate']=$txn_reqdate;
						$dataup['cb_bankrefno']=$txn_bankrefno;
						$dataup['cb_statusdesc']=$txn_status_desc;
						$dataup['cb_txnrefno']=$txn_refno;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=0;
						$uptxn=$this->cbmod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
							$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
							redirect("master/chola-booking/status/$enc_cb_id");		
						}
					}else{
						$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
						redirect("master/chola-booking/status/$enc_cb_id");		
					}
				}	
				
			}
		}
	}
}