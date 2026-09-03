<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cholapage_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent','CryptAES'));
		$this->load->model('Cholaweb_model','cholamod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function chola_booking_step1(){
		$arr['siteTitle']="Chola Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		$arr['ch_datebooked']=$this->cholamod->getAllCholaDateBooked();
		$arr['ch_inactivedate']=$this->cholamod->getAllInactiveDateChola();
		$arr['ch_processdate']=$this->cholamod->getAllProcessDateChola();


		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('cb_bookfordate','Booking Date', 'trim|required|callback_chkcholadate|xss_clean',array(
		'required'=>'Booking Date field is required',
		));	
		$this->form_validation->set_rules('cb_name','Name', 'trim|required|xss_clean',array(
		'required'=>'Name field is required',
		));
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			$cb_bookfordate=$data['cb_bookfordate'];
			if($cb_bookfordate!=""){
				$data['cb_bookfordate']=date('Y-m-d',strtotime($cb_bookfordate));
			}
			$cb_id=$this->cholamod->insertCholaBookingTemp($data,$custsesid);
			if($cb_id){
				$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
				redirect("online-chola-booking/overview/$enc_cb_id");
			}
		}
		$this->load->view('online-chola-booking-step1',$arr);
	}
	
	public function chola_booking_step2($enc_cb_id){
		$arr['siteTitle']="Chola Booking Details";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		
		$amount=CHB_AMT;
		
		//$success_url="https://www.mansadevi.org.in/portal/online-chola-booking/success";
		//$fail_url="https://www.mansadevi.org.in/portal/online-chola-booking/failure";
		$response_url="https://www.mansadevi.org.in/portal/online-chola-booking/worldline/response";
		$arr['amount']=$amount;
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cholatemp']=$this->cholamod->getPerCholaBookingTemp($cb_id);
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
		$reg_city=$arr['regdata']->reg_city;
		$datach['cb_city']=$reg_city;
		$reg_state=$arr['regdata']->reg_state;
		$datach['cb_state']=$reg_state;
		$reg_pincode=$arr['regdata']->reg_pincode;
		$datach['cb_pincode']=$arr['regdata']->reg_pincode;
		$datach['cb_paymethod']=2;
		$datach['cb_amount']=$amount;
			$chola_bid=$this->cholamod->insertCholaBooking($datach);
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
				
				
	
			}
		}
		}
		}else{
			redirect("online-chola-booking");
		}
		
	$this->load->view('online-chola-booking-step2',$arr);

	}
	
	
	public function cholapayment_failure(){
		/*$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} */
		$responseParameter1=$_REQUEST['encData'];
		$key=Key;
		$this->load->library('CryptAES');
		$aes = new CryptAES();
		$aes->set_key(base64_decode($key));
		$aes->require_pkcs5();
		$responseParameter2=$aes->decrypt($responseParameter1);
		
		$final_response=explode("|", $responseParameter2);
		if(count($final_response)>0){
			
			$donation_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['cb_transstatus']=$trans_status;
			$dataup['cb_paymode']=$pay_mode;
			$dataup['cb_transdate']=$trans_date;
			$dataup['cb_bankrefno']=$bank_ref_no;
			$dataup['cb_statusdesc']=$status_description;
			$dataup['cb_dateup']=1;
			
			$cbdata=$this->cholamod->getCholaBookingByOrder($donation_orderno);
			if($cbdata){
				$cb_id=$cbdata->cb_id;
				$uppay=$this->cholamod->upCholaBookingStatus($dataup,$cb_id);	
				if($uppay){
					$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
					redirect("online-chola-booking/status/$enc_cb_id");		
				}
			}
		}
	}
	public function payment_status_chola(){
		/*$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} */
		$responseParameter1=$_REQUEST['encData'];
		$key=Key;
		$this->load->library('CryptAES');
		$aes = new CryptAES();
		$aes->set_key(base64_decode($key));
		$aes->require_pkcs5();
		$responseParameter2=$aes->decrypt($responseParameter1);
		
		$final_response=explode("|", $responseParameter2);
		if(count($final_response)>0){
			
			$donation_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['cb_transstatus']=$trans_status;
			$dataup['cb_paymode']=$pay_mode;
			$dataup['cb_transdate']=$trans_date;
			$dataup['cb_bankrefno']=$bank_ref_no;
			$dataup['cb_statusdesc']=$status_description;
			$dataup['cb_dateup']=1;
			
			$cbdata=$this->cholamod->getCholaBookingByOrder($donation_orderno);
			if($cbdata){
				$cb_id=$cbdata->cb_id;
				$uppay=$this->cholamod->upCholaBookingStatus($dataup,$cb_id);	
				if($uppay){
					$enc_cb_id=$this->encryptcode->encrypt($cb_id,ENC_KEY_PASS);
					redirect("online-chola-booking/success/$enc_cb_id");		
				}
			}
		}
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
					$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$don_amt_final="Rs. ".number_format($donation_amount);
				
				$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked  for date  ".$cb_bookfordate.". Txn Id ".$cb_orderno.", Jai Mata Di";
				$sms_text_final=urlencode($sms_content);
				$url="http://trans.masssms.tk/api.php?username=".$sms_username."&password=".$sms_password."&sender=".$sms_senderid."&sendto=".$cb_mobile."&message=$sms_text_final";
					
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