<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roomres_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Roomres_model','roommod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function room_booking(){
		$arr['siteTitle']="Online Rooms Booking";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"room-booking");
			redirect('login');
		}/*else{
		   $this->session->set_flashdata('feedback',"Room booking temporarily closed");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
		    redirect("dashboard");
		}*/
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
$this->form_validation->set_rules('rb_tc','Room Booking', 'trim|required|xss_clean',array(
		'required'=>'Please accept room booking terms and conditions',
		));	
		if($this->form_validation->run()==true){
			redirect("room-booking/step1");
		}else{
			$this->load->view('online-room-booking',$arr);
		}
	}
	public function room_booking_step1(){
		$arr['siteTitle']="Online Rooms Booking";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		}/*else{
		    $this->session->set_flashdata('feedback',"Room booking temporarily closed");
			$this->session->set_flashdata('feedbackerr',"alert-danger");
		    redirect("dashboard");
		} */
		$arr['roomtdata']=$this->roommod->getAllRoomType();		
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
$this->form_validation->set_rules('rb_roomcat','No. of Rooms', 'trim|required|xss_clean',array(
		'required'=>'No. of Rooms field is required',
		));	
		$this->form_validation->set_rules('rb_noadult','No. of Pilgrims ', 'trim|required|xss_clean',array(
		'required'=>'No. of Pilgrims  field is required',
		));	
		
		$this->form_validation->set_rules('rb_nochild','No. of Children', 'trim|required|xss_clean',array(
		'required'=>'No. of Children  field is required',
		));	
		$this->form_validation->set_rules('rb_nodays','No. of Days', 'trim|required|xss_clean',array(
		'required'=>'No. of Days  field is required',
		));	
		
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			unset($data['submit']);	
			/*$rb_roomcat=$data['rb_roomcat'];
			$rb_norooms=$data['rb_norooms'];
			$rb_noadult=$data['rb_noadult'];
			$rb_nochild=$data['rb_nochild'];
			$rb_nodays=$data['rb_nodays'];*/
				
			//$book_cond=$roomt_id."|".$rb_norooms."|".$rb_noadult."|".$rb_nochild."|".$rb_nodays;
			//$enc_book_cond=$this->encryptcode->encrypt($book_cond,ENC_KEY_PASS);
			$rb_id=$this->roommod->insertRoomBookingTemp($data,$custsesid);
			$enc_rbid=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
			redirect("room-booking/step2/$enc_rbid");
		}
		$this->load->view('online-room-booking-step1',$arr);
	}
	
	public function room_book_step2($enc_rbid){
		$arr['siteTitle']="Online Rooms Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
	
			
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$arr['doctypedata']=$this->roommod->getAllDocumentType();
		$rb_id=$this->encryptcode->decrypt($enc_rbid,ENC_KEY_PASS);
		$arr['rbtempdata']=$this->roommod->getPerRoomBookingTemp($rb_id);
		//$book_cond_ar=explode("|",$book_cond);
		$rb_roomcat=$arr['rbtempdata']->rb_roomcat;
		$roomdata=$this->roommod->getPerRoomType($rb_roomcat);
		$arr['roomdata']=$roomdata;
		$room_cat=$roomdata->roomt_id;
		$rb_norooms=$arr['rbtempdata']->rb_norooms;
		$rb_noadult=$arr['rbtempdata']->rb_noadult;
		$rb_nochild=$arr['rbtempdata']->rb_nochild;
		$rb_nodays=$arr['rbtempdata']->rb_nodays;
		
		$roomt_price=$roomdata->roomt_price*$rb_nodays;
		$adult_child=$rb_noadult+$rb_nochild;
		$extra_chargeperroom=0;
		if($adult_child>=3){
			$extra_chargeperroom=$roomt_price*25/100;	
		}
		
		$rental_amt=$rb_norooms*$roomt_price;
		$extraperson_charges=$rb_norooms*$extra_chargeperroom;
		
		
		$arr['rental_amt']=$rental_amt;
		$arr['rb_nodays']=$rb_nodays;
		$arr['extraperson_charges']=$extraperson_charges;
		$arr['total_amt']=$rental_amt+$extraperson_charges;
		
		$arr['rb_norooms']=$rb_norooms;
		$arr['roomdata']=$roomdata;
		$arr['statedata']=$this->webmod->getAllState();
		$arr['rb_inactivedate']=$this->roommod->getAllInactiveDateRoom();
		$arr['rb_datedata']=$this->roommod->getAllDateRoom();
		
		
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('rb_date','Date', 'trim|required|callback_chkrbdate|xss_clean',array(
		'required'=>'Check-in Date field is required',
		
		));	
		$this->form_validation->set_rules('rb_name','Name', 'trim|required|xss_clean',array(
			'required'=>'Name field is required',
		));	
		$this->form_validation->set_rules('rb_mobile','Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]|xss_clean',array(
		'required'=>'Mobile Number field is required',
		'min_length'=>'Enter your 10 digit mobile number',
		'max_length'=>'Enter your 10 digit mobile number'
		));
	$this->form_validation->set_rules('rb_email','Email Id', 'trim|valid_email|max_length[50]|xss_clean',array(
		'required'=>'Email Id field is required',
		'valid_email'=>'Please enter valid email id',
		'is_unique'=>'Email id already registered with us'
		));
		$this->form_validation->set_rules('rb_idtype','ID Type', 'trim|required|xss_clean',array(
			'required'=>'ID Type field is required',
		));	
		$this->form_validation->set_rules('rb_idproofno','ID Number', 'trim|required|xss_clean',array(
			'required'=>'ID Number field is required',
		));	
		
		$this->form_validation->set_rules('rb_address_line1','Address Line', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rb_address_line1','Address Line', 'trim|required|xss_clean');

		$this->form_validation->set_rules('rb_city','City Name', 'trim|required|xss_clean',array(
		'required'=>'City Name field is required'
		));
		$this->form_validation->set_rules('rb_state','State Name', 'trim|required|xss_clean',array(
		'required'=>'State Name field is required'
		));
		$this->form_validation->set_rules('rb_pincode','Pincode', 'trim|required|numeric|min_length[6]|max_length[6]|xss_clean',array(
		'required'=>'Pincode field is required',
		'min_length'=>'Enter  Pincode 6 digit only',
		'max_length'=>'Enter  Pincode 6 digit only'
		));
		if($this->form_validation->run()==true){
			$this->load->library('paynimo/TransactionRequestBean');
			$transactionRequestBean=new TransactionRequestBean();
			
			
			$data=$this->input->post();
			$data['rb_bookfordate']="";
			$rb_date=$this->input->post('rb_date');
			if($rb_date!=""){
				$data['rb_bookfordate']=date('Y-m-d',strtotime($rb_date));
			}
			$checkin_date=$data['rb_bookfordate'];
			$time=date("dmyHis");
			$txnid="RB-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;
			$data['rb_orderno']=$txnid;
			$data['rb_roomcat']=$room_cat;
			$data['rb_norooms']=$rb_norooms;
			$data['rb_rentalamt']=$rental_amt;
			$data['rb_extracharge']=$extraperson_charges;
			$data['rb_noadult']=$rb_noadult;
			$data['rb_nochild']=$rb_nochild;
			$data['rb_paymenthod']=3;
			$final_totalamt=$rental_amt+$extraperson_charges;
			$data['rb_amount']=$final_totalamt;
			if($rb_nodays>1){
				$data['rb_bookfordate2']=date('Y-m-d', strtotime($checkin_date.' + 1 days'));
			}else{
				$data['rb_bookfordate2']=NULL;	
			}
			
			
			$rb_id=$this->roommod->insertRoomBooking($data,$custsesid);
			
			if($rb_id){
	$bookdata=$this->roommod->getPerRoomBooking($rb_id);
	
	$book_orderid=$bookdata->rb_orderno;
	$book_regid=$bookdata->rb_regid;
	$book_roomcat=$bookdata->rb_roomcat;
	$book_name=$bookdata->rb_name;
	$book_mobile=$bookdata->rb_mobile;
	$book_email=$bookdata->rb_email;
	$book_state=$bookdata->rb_state;
	$book_amt=$bookdata->rb_amount;
	
	
	
	
	$itc=$book_orderid;		
			$amount_final=number_format($book_amt,1,'.','');

	//$amount_final=number_format($book_amt,1);
	$scheme_code="FIRST_".$amount_final."_0.0";	 
	$return_url=site_url("room-booking/worldline/response");
	$transactionRequestBean->merchantCode=WL_MERCHANTCODE_LIVE;
    $transactionRequestBean->ITC=$itc;
    $transactionRequestBean->customerName=$book_name;
    $transactionRequestBean->requestType=WL_REQTYPE1;
    $transactionRequestBean->merchantTxnRefNumber=$book_orderid;
    $transactionRequestBean->amount=$amount_final;
    $transactionRequestBean->currencyCode=WL_CURRENCYCODE;
    $transactionRequestBean->returnURL=$return_url;
    $transactionRequestBean->shoppingCartDetails=$scheme_code;
    $transactionRequestBean->TPSLTxnID="";
    $transactionRequestBean->mobileNumber=$book_mobile;
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
		
	$this->roommod->upPerRoombookParms($datapayser,$rb_id);	
			
	 //Writing in Request Log
  	$log="Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;

	
    //Saving string to log by using "FILE_APPEND" to append.
    file_put_contents('logs/paynimo/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	$responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response=$responseDetails[0];
	
   	echo "<script>window.location = '" . $response . "'</script>";
    ob_flush();
	

			}
		}
		$this->load->view('online-room-booking-step2',$arr);
	}
	
	
	

	public function chkrbdate($checkin_date){
		if($checkin_date!=""){
		$enc_rbid=$this->input->post('enc_rbid');
		$rb_id=$this->encryptcode->decrypt($enc_rbid,ENC_KEY_PASS);
		$arr['rbtempdata']=$this->roommod->getPerRoomBookingTemp($rb_id);
		$rb_norooms=$arr['rbtempdata']->rb_norooms;
		$rb_roomcat=$arr['rbtempdata']->rb_roomcat;
		$roomt_total=$arr['rbtempdata']->roomt_total;
		$rb_nodays=$arr['rbtempdata']->rb_nodays;
			$checkin_dateymd=date('Y-m-d',strtotime($checkin_date));
				$count_inactive=$this->roommod->check_inactiveDate($checkin_dateymd);
				if($count_inactive==0){
					$total_count=0;
					$count_success=$this->roommod->total_rbsuccess($checkin_dateymd);
					$count_processing=$this->roommod->total_rbprocess($checkin_dateymd);
					$total_count=$count_success+$count_processing;
					if($total_count<$rb_norooms){
						/* Previous Date */
						$book_datetime=strtotime($checkin_dateymd);
						$current_datetime=strtotime(date('Y-m-d'));
						if($book_datetime<$current_datetime){
							$this->form_validation->set_message('chkrbdate', 'Please enter valid date');					
							return FALSE;	
						}else{
							$one_month=date('Y-m-d', strtotime('+ 3 days'));
							$onemonth_time=strtotime($one_month);
							if($book_datetime>$onemonth_time){
							  
								$this->form_validation->set_message('chkrbdate', 'Please select date between 3 days from current date');
									return FALSE;
							}else{
								$room_left=$roomt_total-$total_count;
								//echo $total_count;
								//exit;
								if($room_left>=$rb_norooms){
									if($rb_nodays==2){
											$checkintwodis=date('d-m-Y', strtotime($checkin_dateymd. ' + 1 days'));
											$checkintwo=date('Y-m-d', strtotime($checkin_dateymd. ' + 1 days'));
											$count_inactive2=$this->roommod->check_inactiveDate($checkintwo);
											if($count_inactive2==0){
												$total_count2=0;
												$count_success2=$this->roommod->total_rbsuccess($checkintwo);
												$count_processing2=$this->roommod->total_rbprocess($checkintwo);
												$total_count2=$count_success2+$count_processing2;
												if($total_count2<$rb_norooms){
													$room_left2=$roomt_total-$total_count2;
													if($room_left2>=$rb_norooms){
														return TRUE;	
													}else{
														$this->form_validation->set_message('chkrbdate',"Total $rb_norooms left in $checkintwodis");									
														return FALSE;
													}
													
												}else{
													$this->form_validation->set_message('chkrbdate', "Booking is full for  date $checkintwodis");					
													return FALSE;		
												}
											}else{
												$this->form_validation->set_message('chkrbdate', "Booking is off for  date $checkintwodis");				
												return FALSE;	 	
											}
										
											
									}else{
										return TRUE;	
									}
								}else{
									$this->form_validation->set_message('chkrbdate',"Total $rb_norooms left in $rb_date");									
									return FALSE;
								}
									 
							}
						}
						
					}else{
						$this->form_validation->set_message('chkrbdate', "Booking is full for  date $rb_date");					
						return FALSE;	 
					}
				}else{
					$this->form_validation->set_message('chkrbdate', "Booking is off for  date $rb_date");
					return FALSE;	 	
				}
		
		}else{
			return true;
		}
	}
	public function worldline_booking_response(){
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
        file_put_contents('logs/paynimo/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
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
				$txndata=$this->roommod->getTxnByRefNo($order_id);
				$id=$txndata->rb_id;
			  	$name=$txndata->rb_name;
			    $mobile=$txndata->rb_mobile;
				$no_rooms=$txndata->rb_norooms;
				$amount=$txndata->rb_amount;
				$book_fordate=date('d-m-Y',strtotime($txndata->rb_bookfordate));
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
						$dataup['rb_transstatus']=$txn_msg;
						$dataup['rb_statuscode']=$txn_status;
						$dataup['rb_transdate']=$txn_date;
						$dataup['rb_bankrefno']=$tpsl_txn_id;
						$dataup['rb_paymessage']=$txn_status;
						$dataup['rb_payrefno']=$rqst_token;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$id);
						if($uptxn){
				$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$sms_channel=SMS_CHANNEL;
				$sms_route=SMS_ROUTE;
				$sms_peid="1701161788461996254";
				$rb_mobile="91".$mobile;
				//$sms_content="Dear Mr/Ms ".$rb_name.", Room booked  for date  ".$rb_bookfordate.". Txn Id ".$order_id.", Total Rooms: ".$rb_norooms." - Jai Mata Di";
				
					$sms_content="Dear Mr/Ms ".$name." Room booked for date ".$book_fordate.". Txn Id ".$order_id." Total Rooms: ".$no_rooms.", SMMDSB,PKL";
				
				$sms_text_final=urlencode($sms_content);
				$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$rb_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;
				
				//$url="http://trans.masssms.tk/api.php?username=".$sms_username."&password=".$sms_password."&sender=".$sms_senderid."&sendto=".$cb_mobile."&message=$sms_text_final";
				
                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $response=curl_exec($ch);
                curl_close($ch);
						
						$enc_id=$this->encryptcode->encrypt($id,ENC_KEY_PASS);
							redirect("room-booking/status/$enc_id");	
				
				
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
						$dataup['rb_transstatus']=$txn_msg;
						$dataup['rb_statuscode']=$txn_status;
						$dataup['rb_transdate']=$txn_date;
						$dataup['rb_bankrefno']=$tpsl_txn_id;
						$dataup['rb_paymessage']=$txn_status;
						$dataup['rb_payrefno']=$rqst_token;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$id);
						if($uptxn){
							$enc_id=$this->encryptcode->encrypt($id,ENC_KEY_PASS);
							redirect("room-booking/status/$enc_id");	
				
						}
					
					}
		 		  }
			}else{ redirect("online-chola-booking/no-response"); }
		}else{
			redirect("online-chola-booking/no-response");
    	}
		
		
	}
		
	
	
	public function roombook_status($enc_rb_id){
		$arr['siteTitle']="Payment Status detail";
	
		$rb_id=$this->encryptcode->decrypt($enc_rb_id,ENC_KEY_PASS);
		$arr['rbdata']=$this->roommod->getPerRoomBooking($rb_id);
		$this->load->view('roombook-success-preview',$arr);
	}
	
}
?>