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
		
		$enc_master=$this->encryptcode->encrypt($masterId,ENC_KEY_PASS);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		
		$arr['cholatemp']=$this->cbmod->getPerCholaBookingTemp($cb_id);
		$temple_id=$arr['cholatemp']->cb_temple;
		$arr['templedata']=$this->cbmod->getPerTemple($temple_id);

		//$success_url="https://www.mansadevi.org.in/portal/master/chola-booking/success";
		//$fail_url="https://www.mansadevi.org.in/portal/master/chola-booking/failure";
		//$response_url="https://www.mansadevi.org.in/portal/master/chola-booking/worldline/response";
		
		
		//$success_url="https://www.mansadevi.org.in/portal/online-chola-booking/success";
		//$fail_url="https://www.mansadevi.org.in/portal/online-chola-booking/failure";
		//$response_url="https://www.mansadevi.org.in/portal/online-chola-booking/worldline/response";
		
		
	
		$amount=$arr['templedata']->temple_fee;	
		$temple_name=$arr['templedata']->temple_name;
		$temple_shortcode=$arr['templedata']->temple_shortcode;
			//echo "<pre>"; 
		//print_r($arr['cholatemp']);
			//echo "</pre>"; 
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
		$datach['cb_ipaddress']=NULL;
		
			//echo "<pre>"; 
		//print_r($datach);
		//echo "</pre>"; 
		
	  	$chola_bid=$this->cbmod->insertCholaBooking($datach);
				if($chola_bid){
					$this->load->library('paynimo/TransactionRequestBean');
			$transactionRequestBean=new TransactionRequestBean();
		 	$cbrow=$this->cbmod->getPerCholaBooking($chola_bid);
			
			
			//echo "<pre>"; 
			//print_r($cbrow);
				//echo "</pre>"; 
				//exit;
			
			$cb_orderno=$cbrow->cb_orderno;
			$cb_name=$cbrow->cb_name;
			$cb_amount=$cbrow->cb_amount;
			$cb_mobile=$cbrow->cb_mobile;
			$cb_regid=$cbrow->cb_regid;
			
	$itc=$chola_bid;		
	$amount_final=number_format($amount,1,'.','');
	
	$scheme_code="FIRST_".$amount_final."_0.0";	 
	$return_url=site_url("master/chola-booking/worldline/response/$enc_master");
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
    $transactionRequestBean->custId=$cb_regid;
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
	$this->cbmod->upPerCholaParms($datapayser,$chola_bid);	
			
	 //Writing in Request Log
  //	$log="Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
    
	
    //Saving string to log by using "FILE_APPEND" to append.
   // file_put_contents(base_url().'/application/logs/paynimo/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	$responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];
	 $this->cbmod->delPerTempCholaBooking($cb_id);
   	echo "<script>window.location = '" . $response . "'</script>";
    ob_flush();
					
			}
				
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
		 
	public function worldline_chola_response($enc_master){
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			$master_id=$this->encryptcode->decrypt($enc_master,ENC_KEY_PASS);
			$this->session->set_userdata('masterId',$master_id);
		}
		
		$arr['siteTitle']='Bank Response';	
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
				$txndata=$this->cbmod->getCholaBookingByOrder($order_id);
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
						$uptxn=$this->cbmod->upTxnByRefNo($dataup,$order_id);
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
						redirect("master/chola-booking/status/$enc_id");		
				
				
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
						$uptxn=$this->cbmod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						
						$enc_id=$this->encryptcode->encrypt($id,ENC_KEY_PASS);
						redirect("master/chola-booking/status/$enc_id");		
				
					}
					
					}
		 		  }
			}else{ redirect("master/chola-booking/no-response"); }
		}else{
			redirect("master/chola-booking/no-response");
    	}
	
		
	}
}