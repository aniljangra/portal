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
		$arr['temple_name']=$this->cholamod->getAlltemplename();
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_temple','Name', 'trim|required|xss_clean',array(
			'required'=>'Temple field is required',
		));
		if($this->form_validation->run()==true){
			$data=$this->input->post('cb_temple');
			$enc_cb_id=$this->encryptcode->encrypt($data,ENC_KEY_PASS);
			redirect("online-chola-booking/step2/$enc_cb_id");
		}
		$this->load->view('online-chola-booking-step',$arr);
	}


	public function chola_booking_step1($enc_cb_id){
		//redirect('/');
		$arr['siteTitle']="Chola Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		// print_r($enc_cb_id); die()
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		
		$arr['templedata']=$this->cholamod->getPerTemple($cb_id);
		//$arr['temple_name']=$this->cholamod->getAlltemplename();
		$arr['ch_datebooked']=$this->cholamod->getAllCholaDateBooked($cb_id);
		$arr['ch_inactivedate']=$this->cholamod->getAllInactiveDateChola();
		$arr['ch_processdate']=$this->cholamod->getAllProcessDateChola();
	    

		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|xss_clean',array(
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
		$this->form_validation->set_rules('cb_mobile','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean|callback_chkmobeligible',array(
			'required'=>'Mobile field is required',
			'cb_mobile'=>'Enter 10 digit mobile no',
			'cb_mobile'=>'Enter 10 digit mobile no',
		));
		
		if($this->input->post('cb_othermember')=="Yes"){
			$this->form_validation->set_rules('cb_member_name2','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
			));
			$this->form_validation->set_rules('cb_member_aadhaar2','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile2','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean|callback_chkmobeligible1',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			if($this->input->post('cb_member_name3')!=""){
			
			$this->form_validation->set_rules('cb_member_aadhaar3','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile3','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean|callback_chkmobeligible2',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			if($this->input->post('cb_member_name4')!=""){
			
			$this->form_validation->set_rules('cb_member_aadhaar4','Aadhaar', 'numeric|trim|required|min_length[12]|max_length[12]|xss_clean',array(
				'required'=>'Aadhaar Number required',
				'min_length'=>'Enter 12 digit aadhaar no',
				'max_length'=>'Enter 12 digit aadhaar no',
			));
			$this->form_validation->set_rules('cb_member_mobile4','Mobile', 'numeric|trim|required|min_length[10]|max_length[10]|xss_clean|callback_chkmobeligible3',array(
				'required'=>'Mobile field is required',
				'cb_mobile'=>'Enter 10 digit mobile no',
				'cb_mobile'=>'Enter 10 digit mobile no',
			));
			}
			
		}
		
		
	$cb_proof="";	
	if(empty($_FILES['cb_proof']['name'])){
		$this->form_validation->set_rules('cb_proof','Primary Concern Image', 'trim|required|xss_clean',array(
	'required'=>'Primary Member ID Proof  required',
		));
	}
		if(isset($_FILES['cb_proof']['name'])){
			$cb_proof=$_FILES['cb_proof']['name'];
		}
		$config=array(
			'upload_path'	=>'./media/document/',
			'allowed_types' => 'gif|jpg|png',
			//'min_size' =>50,
			//'max_size' =>1024,
			'overwrite' => TRUE,
			'file_name' =>time().'_'.$cb_proof
			);
		// $this->load->library('upload',$config);

		$cb_photograph="";
		if(empty($_FILES['cb_photograph']['name'])){
			$this->form_validation->set_rules('cb_photograph','Primary Concern Image', 'trim|required|xss_clean',array(
		'required'=>'Primary Member Photograh  required',
			));
		}
			if(isset($_FILES['cb_photograph']['name'])){
				$photograph=$_FILES['cb_photograph']['name'];
			}
			$config2=array(
				'upload_path'	=>'./media/document/',
				'allowed_types' => 'gif|jpg|png',
				//'min_size' =>50,
				//'max_size' =>1024,
				'overwrite' => TRUE,
				'file_name' =>time().'_'.$cb_photograph
				);
			$this->load->library('upload',$config2);
			

		if($this->form_validation->run()==true){
			$this->upload->do_upload('cb_proof');
			$this->upload->do_upload('cb_photograph');
			$data=$this->input->post();
		   	 $docup3=$this->upload->data();
			$proof="media/document/".$docup3['raw_name'].$docup3['file_ext'];
			// $photograph="media/document/".$docup4;
			
		 	$cb_bookfordate=$data['cb_bookfordate'];
			if($cb_bookfordate!=""){
				$data['cb_bookfordate']=date('Y-m-d',strtotime($cb_bookfordate));
				
					
			}
			$tempdata=$this->cholamod->insertCholaBookingTemp($data,$custsesid,$proof,$photograph);
			$enc_cb_id=$this->encryptcode->encrypt($tempdata,ENC_KEY_PASS);
			redirect("online-chola-booking/step3/$enc_cb_id");
		
	
		}else{
		    $arr['error3']=$this->upload->display_errors();	
		     $this->load->view('online-chola-booking-step1',$arr);
		}
	}
	public function chkmobeligible($cb_mobile){
		$cb_temple=$this->input->post('cb_temple');
		if($cb_mobile!=""){
			$count_book=$this->cholamod->chkforcholamob($cb_mobile,$cb_temple);
			if($count_book==0){
				return true;
			}else{
				$this->form_validation->set_message('chkmobeligible',"You can book chola only once in six month");	
				return false;	
			}
		}else{
			return true;	
		}
	}
	
	
	public function chkmobeligible1($cb_member_mobile2){
		$cb_temple=$this->input->post('cb_temple');
		if($cb_member_mobile2!=""){
			$count_book=$this->cholamod->chkforcholamob($cb_member_mobile2,$cb_temple);
			if($count_book==0){
				return true;
			}else{
				$this->form_validation->set_message('chkmobeligible1',"You can book chola only once in six month");	
				return false;	
			}
		}else{
			return true;	
		}
	}
	public function chkmobeligible2($cb_member_mobile3){
		$cb_temple=$this->input->post('cb_temple');
		if($cb_member_mobile3!=""){
			$count_book=$this->cholamod->chkforcholamob($cb_member_mobile3,$cb_temple);
			if($count_book==0){
				return true;
			}else{
				$this->form_validation->set_message('chkmobeligible2',"You can book chola only once in six month");	
				return false;	
			}
		}else{
			return true;	
		}
	}
	public function chkmobeligible3($cb_member_mobile4){
		$cb_temple=$this->input->post('cb_temple');
		if($cb_member_mobile4!=""){
			$count_book=$this->cholamod->chkforcholamob($cb_member_mobile4,$cb_temple);
			if($count_book==0){
				return true;
			}else{
				$this->form_validation->set_message('chkmobeligible3',"You can book chola only once in six month");	
				return false;	
			}
		}else{
			return true;	
		}
	}
	
	public function chola_booking_step1_1($enc_cb_id){
		
		$arr['siteTitle']="Chola Booking";		
		$custsesid=$this->session->userdata('custsesid');
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		// $arr['templedata']=$this->cholamod->getPerTemple($cb_id);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
		$tempid=$arr['cholatemp']->cb_temple;
		$arr['cholaprice']=$this->cholamod->gettemplecholaprice($tempid);
			// print_r($cb_id); die();
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
				//  print_r("yes"); die();
				// $enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
				redirect("online-chola-booking/overview/$enc_cb_id");
			}
		}
		$this->load->view('online-chola-booking-step1_1',$arr);
	}
	public function chola_booking_step2($enc_cb_id){
		$arr['siteTitle']="Chola Booking Details";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		
		
		// $amount=CHB_AMT;
		$amount=
		$success_url="https://www.mansadevi.org.in/portal/online-chola-booking/success";
		$fail_url="https://www.mansadevi.org.in/portal/online-chola-booking/failure";
		$response_url="https://www.mansadevi.org.in/portal/online-chola-booking/worldline/response";
		$arr['amount']=$amount;
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
		$amount=$arr['cholatemp']->temp_ser_amount;
		// $arr['tempdata']=($arr['cholatemp']->cb_data);
		$tempid=$arr['cholatemp']->cb_temple;
		// $arr['cholaprice']=$this->cholamod->gettemplecholaprice($tempid);
		if($arr['cholatemp']){
		if(isset($_POST['backPage'])){
			$this->cholamod->delPerTempCholaBooking($cb_id);
			redirect("online-chola-booking");
		}
		if(isset($_POST['bookChola'])){
			$this->form_validation->set_error_delimiters('<span class="error">','</span>');
			$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|callback_chkcholadate|xss_clean',array(
			'required'=>'Booking Date field is required'
			));
			if($this->form_validation->run()==true){
				$data=$this->input->post();
				$bookfordate=$arr['cholatemp']->cb_bookfordate;
				$checkbookfordate=$this->cholamod->checkbookfordate($bookfordate);
				// print_r($checkbookfordate); die();
				if($checkbookfordate=="0"){
		$data=$this->input->post();
		$time=date("dmyHis");
		$txnid="CH-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;
		$datach['cb_orderno']=$txnid;
		$datach['cb_regid']=$custsesid;
		$datach['cb_bookfordate']=$arr['cholatemp']->cb_bookfordate;
		$name=$arr['cholatemp']->cb_name;
		$datach['cb_name']=$arr['cholatemp']->cb_name;
		$reg_mobileno=$arr['regdata']->reg_mobileno;
		$datach['cb_mobile']=$reg_mobileno;
		$reg_email=$arr['regdata']->reg_email;
		$datach['cb_email']=$reg_email;
		$address=$arr['regdata']->reg_address_line1;
		if($arr['regdata']->reg_address_line2!=""){
			$address==$address." ".$arr['regdata']->reg_address_line2;
		}
		$datach['cb_address']=$address;
		$datach['cb_address']=$address;
		$reg_city=$arr['regdata']->reg_city;
		$datach['cb_city']=$reg_city;
		$reg_state=$arr['regdata']->reg_state;
		$datach['cb_state']=$reg_state;
		$reg_pincode=$arr['regdata']->reg_pincode;
		$datach['cb_pincode']=$arr['regdata']->reg_pincode;
		$datach['cb_paymethod']=2;
		$datach['cholaprice']=$arr['cholatemp']->cb_chola_price;
		$datach['cb_photo']=$arr['cholatemp']->cb_proof;
		$datach['cb_temple']=$arr['cholatemp']->cb_temple;
		$datach['cb_aadhar']=$arr['cholatemp']->cb_aadhaar;
		$datach['cb_othermember']=$arr['cholatemp']->cb_othermember;

		$datach['cb_devotee_name2']=$arr['cholatemp']->cb_member_name2;
		$datach['cb_devotee_mobile2']=$arr['cholatemp']->cb_member_mobile2;
		$datach['cb_devotee_aadhar2']=$arr['cholatemp']->cb_member_aadhaar2;
		$datach['cb_devotee_name3']=$arr['cholatemp']->cb_member_name3;
		$datach['cb_devotee_mobile3']=$arr['cholatemp']->cb_member_mobile3;
		$datach['cb_devotee_aadhar3']=$arr['cholatemp']->cb_member_aadhaar3;
		$datach['cb_devotee_name4']=$arr['cholatemp']->cb_member_name4;
		$datach['cb_devotee_mobile4']=$arr['cholatemp']->cb_member_mobile4;
		$datach['cb_devotee_aadhar4']=$arr['cholatemp']->cb_member_aadhaar4;

		$datach['cb_amount']=$arr['cholatemp']->templecholatype_amount+$amount;
		// print_r($datach); 
	   
	
		
		
			$chola_bid=$this->cholamod->insertCholaBooking($datach);
			exit;	
			if($chola_bid){
				$mid=WORLDLINE_MID;
				$enckey=WORLDLINE_ENCKEY;
			
				$cbrow=$this->cholamod->getPerCholaBooking($chola_bid);
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
	 $this->cholamod->delPerTempCholaBooking($cb_id);
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
				
				
		<?php		
				
				
	
			}}else{
				$this->session->set_flashdata('datealtaken', '<div class="alert alert-danger" role="alert">This Chola Booking Date Is Already Taken Please Choose Another One !!</div>');
				
			}}
		}
		
		}else{
			redirect("online-chola-booking");
		}
		
	$this->load->view('online-chola-booking-step2',$arr);

	}
	
	
	
	public function chkcholadate($cb_bookfordate){
		if($cb_bookfordate!=""){
		/* Encrypt Password */
			$cb_bookfordate=date('Y-m-d',strtotime($cb_bookfordate));
			$count_date=$this->cholamod->count_choladate($cb_bookfordate);
			if($count_date==0){
				$count_inactive=$this->cholamod->count_inactivedate($cb_bookfordate);
				if($count_inactive==0){
					$count_processing=$this->cholamod->count_processing($cb_bookfordate);
					if($count_processing==0){
						/* Check Previous Date */
						$book_datetime=strtotime($cb_bookfordate);
						$current_datetime=strtotime(date('Y-m-d'));
						
						if($book_datetime<$current_datetime){
$this->form_validation->set_message('chkcholadate', 'Please enter valid date');					
return FALSE;	
						}else{
							$three_month=date('Y-m-d', strtotime('+3 months'));
							$threem_time=strtotime($three_month);
							if($book_datetime>$threem_time){
								$this->form_validation->set_message('chkcholadate', 'Pleas select date between three month from current date');					
								return FALSE;
							}else{
								return true;	 
							}
						}
						
						
					}else{
$this->form_validation->set_message('chkcholadate', 'Booking is processing for this date');					return FALSE;	
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
			return true;	
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
		$enckey=WORLDLINE_ENCKEY;
		$this->load->library('worldline/AWLMEAPI');
		$obj=new AWLMEAPI();
		$resMsgDTO=new ResMsgDTO();
		$reqMsgDTO=new ReqMsgDTO();
		$enc_key=$enckey;
		$responseMerchant = $_REQUEST['merchantResponse'];
		$response=$obj->parseTrnResMsg( $responseMerchant,$enc_key );
		if($response){
			if($response->getStatusCode()=="S"){
				$txn_status="SUCCESS";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->cholamod->getCholaBookingByOrder($order_id);
				if($txndata){
						$cb_id=$txndata->cb_id;
						if($txndata->cb_up==0){
						   $cb_name=$txndata->cb_name;
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
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						    /* SMS */
				
				$don_amt_final="Rs. ".number_format($donation_amount);
				$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$sms_channel=SMS_CHANNEL;
				$sms_route=SMS_ROUTE;
				$sms_peid="1701161788461996254";
				$cb_mobile="91".$cb_mobile;
				
				//$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked  for date  ".$cb_bookfordate.". Txn Id ".$cb_orderno.", Jai Mata Di";
				
				$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked for date ".$cb_bookfordate.". Txn Id ".$cb_orderno.", SMMDSB,PKL";	
				$sms_text_final=urlencode($sms_content);
			     $url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$cb_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;   
			        
			        
				//$url="http://trans.masssms.tk/api.php?username=".$sms_username."&password=".$sms_password."&sender=".$sms_senderid."&sendto=".$cb_mobile."&message=$sms_text_final";
					
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$response=curl_exec($ch);
						curl_close($ch);
				
						    
						    
							$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
							redirect("online-chola-booking/status/$enc_cb_id");		
						}
					}else{
						$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
						redirect("online-chola-booking/status/$enc_cb_id");	
					}
				}
			}else{
				$txn_status="FAILED";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->cholamod->getCholaBookingByOrder($order_id);
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
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
							$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
							redirect("online-chola-booking/status/$enc_cb_id");		
						}
					}else{
						$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
						redirect("online-chola-booking/status/$enc_cb_id");		
					}
				}	
				
			}
		}
	}
	
}
?>