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
			
			$final_totalamt=$rental_amt+$extraperson_charges;
			$data['rb_amount']=$final_totalamt;
			if($rb_nodays>1){
				$data['rb_bookfordate2']=date('Y-m-d', strtotime($checkin_date.' + 1 days'));
			}else{
				$data['rb_bookfordate2']=NULL;	
			}
			
			
			$rb_id=$this->roommod->insertRoomBooking($data,$custsesid);
			
			if($rb_id){
	$response_url="https://www.mansadevi.org.in/portal/room-booking/worldline/response";
	$bookdata=$this->roommod->getPerRoomBooking($rb_id);
	$this->load->library('worldline/AWLMEAPI');
	$obj=new AWLMEAPI();
	$reqMsgDTO=new ReqMsgDTO();
	
	$book_orderid=$bookdata->rb_orderno;
	$book_regid=$bookdata->rb_regid;
	$book_roomcat=$bookdata->rb_roomcat;
	$book_name=$bookdata->rb_name;
	$book_mobile=$bookdata->rb_mobile;
	$book_email=$bookdata->rb_email;
	$book_state=$bookdata->rb_state;
	$book_amt=$bookdata->rb_amount;
	$book_amt_final=$book_amt*100;
	$book_norooms=$bookdata->rb_norooms;
	$book_nodays=$bookdata->rb_nodays;
	$rb_bookfordate=$bookdata->rb_bookfordate;
	$book_date=date('Y-m-d', strtotime($rb_bookfordate));
	$book_date2="";
	if($bookdata->rb_bookfordate2!=""){
		
		$book_date2=date('Y-m-d', strtotime($bookdata->rb_bookfordate2));	
	}
	
	
	$recurPeriod="";
	$recurDay="";
	$numberRecurring="";
	$addField7=$book_norooms;
	$addField8=$book_nodays;
	$addField9=$book_date;
	$addField10=$book_date2;
	$mid=WORLDLINE_MID;
	$enckey=WORLDLINE_ENCKEY;		
	$obj=new AWLMEAPI();
	//create an object of Request Message
	$reqMsgDTO = new ReqMsgDTO();
	/* Populate the above DTO Object On the Basis Of The Received Values */
	// PG MID
	$reqMsgDTO->setMid($mid);
	// Merchant Unique order id
	$reqMsgDTO->setOrderId($book_orderid);
	//Transaction amount in paisa format
	$reqMsgDTO->setTrnAmt($book_amt_final);
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
	$reqMsgDTO->setAddField1($book_name);
	$reqMsgDTO->setAddField2($book_mobile);
	$reqMsgDTO->setAddField3($book_email);
	$reqMsgDTO->setAddField4($book_regid);
	$reqMsgDTO->setAddField5($book_amt_final);
	$reqMsgDTO->setAddField6($book_roomcat);
	$reqMsgDTO->setAddField7($addField7);
	$reqMsgDTO->setAddField8($addField8);
	$reqMsgDTO->setAddField9($addField9);
	$reqMsgDTO->setAddField10($addField10);
	
	$merchantRequest = "";
	$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
	if ($reqMsgDTO->getStatusDesc() == "Success"){
		$merchantRequest = $reqMsgDTO->getReqMsg();
	}
				
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
		
		$enckey=WORLDLINE_ENCKEY;
		$this->load->library('worldline/AWLMEAPI');
		$obj=new AWLMEAPI();
		$resMsgDTO=new ResMsgDTO();
		$reqMsgDTO=new ReqMsgDTO();
		$enc_key=$enckey;
		$responseMerchant=$_REQUEST['merchantResponse'];
		$response=$obj->parseTrnResMsg( $responseMerchant,$enc_key);
		if($response){
			if($response->getStatusCode()=="S"){
				$txn_status="SUCCESS";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->roommod->getTxnByRefNo($order_id);
				if($txndata){
						$rb_id=$txndata->rb_id;
						$rb_updbstatus=$txndata->rb_updbstatus;
						
							$rb_updbstatus=$txndata->rb_updbstatus;
							$rb_updbstatus=$txndata->rb_updbstatus;
							$rb_name=$txndata->rb_name;
							$rb_mobile=$txndata->rb_mobile;
							$rb_idtype=$txndata->rb_idtype;
							$rb_amount=$txndata->rb_amount;
							$amt_final="Rs. ".number_format($rb_amount);
							$rb_idproofno=$txndata->rb_idproofno;
							$rb_email=$txndata->rb_email;
							$rb_bookfordate=date('d-m-Y',strtotime($txndata->rb_bookfordate));
							$rb_norooms=$txndata->rb_norooms;
							
							
							
							
						
						if($rb_updbstatus==0){
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
						$dataup['rb_transstatus']=$txn_status;
						$dataup['rb_transdate']=$txn_reqdate;
						$dataup['rb_bankrefno']=$txn_bankrefno;
						$dataup['rb_paymessage']=$txn_status_desc;
						$dataup['rb_payrefno']=$txn_refno;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$rb_id);
						if($uptxn){
						    /* SEND SMS */
				$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$sms_channel=SMS_CHANNEL;
				$sms_route=SMS_ROUTE;
				$sms_peid="1701161788461996254";
					$rb_mobile="91".$rb_mobile;
				//$sms_content="Dear Mr/Ms ".$rb_name.", Room booked  for date  ".$rb_bookfordate.". Txn Id ".$order_id.", Total Rooms: ".$rb_norooms." - Jai Mata Di";
				
					$sms_content="Dear Mr/Ms ".$rb_name." Room booked for date ".$rb_bookfordate.". Txn Id ".$order_id." Total Rooms: ".$rb_norooms.", SMMDSB,PKL";
				
				$sms_text_final=urlencode($sms_content);
				$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$rb_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;
				
				//$url="http://trans.masssms.tk/api.php?username=".$sms_username."&password=".$sms_password."&sender=".$sms_senderid."&sendto=".$cb_mobile."&message=$sms_text_final";
				
                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $response=curl_exec($ch);
                curl_close($ch);
						
			/* SEND EMAIL */
		    if($rb_email!=""){
			 $this->load->library('email');
			$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
			$this->email->to($rb_email);
			$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
			$this->email->set_mailtype("html");
			$this->email->subject("Room Booking Details");
    			$message="<table rules='all' style='border-color:#666' width='700px;' cellpadding='10'>
  <tbody>
    <tr style='background:#DF3538'>
      <td colspan='2' style='color:#fff' align='center'><strong>Room Booking Detail</strong></td>
    </tr>
	 <tr>
      <td style='background:#dddee7;color:#333' width='298'><strong>Txn Id</strong></td>
      <td style='background:#f7f7f7;color:#333' width='354'>".$order_id."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333' width='298'><strong>Name</strong></td>
      <td style='background:#f7f7f7;color:#333' width='354'>".$rb_name."</td>
    </tr>
  <tr>
      <td style='background:#dddee7;color:#333'><strong>Mobile</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$rb_mobile."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333'><strong>ID Type</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$rb_idtype." - ".$rb_idproofno."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333'><strong>Booked For Date</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$rb_bookfordate."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333'><strong>Total Rooms</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$rb_norooms."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333'><strong>Amount Paid</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$amt_final."</td>
    </tr>
    <tr>
      <td style='background:#dddee7;color:#333'><strong>Status</strong></td>
      <td style='background:#f7f7f7;color:#333'>".$txn_status."</td>
    </tr>
    <tr>
      <td colspan='2' style='background:#f7f7f7;color:#333' align='center'><span style='font-size:17px'>Jai Mata Di !</span><br><a href='http://www.swrnarajhanscharitabletrust.org' target='_blank'>www.mansadevi.org.in</a>
      
      <p>Shri Mata Mansa Devi Shrine Board</p></td>
    </tr>
    
    
  </tbody>
</table>";
			$this->email->message($message);
			$this->email->send();	
		    }			    
						    
							$enc_rb_id=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
							redirect("room-booking/status/$enc_rb_id");		
						}
					}else{
						$enc_donation_id=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
							redirect("room-booking/status/$enc_rb_id");		
					}
				}
			}else{
				$txn_status="FAILED";
				$txn_refno=$response->getPgMeTrnRefNo();
				$order_id=$response->getOrderId();
				$txndata=$this->roommod->getTxnByRefNo($order_id);
				if($txndata){
						$rb_id=$txndata->rb_id;
						$rb_updbstatus=$txndata->rb_updbstatus;
						if($rb_updbstatus==0){
						
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
						$dataup['rb_transstatus']=$txn_status;
						$dataup['rb_transdate']=$txn_reqdate;
						$dataup['rb_bankrefno']=$txn_bankrefno;
						$dataup['rb_paymessage']=$txn_status_desc;
						$dataup['rb_payrefno']=$txn_refno;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$rb_id);
						if($uptxn){
							$enc_rb_id=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
							redirect("room-booking/status/$enc_rb_id");		
						}
					}else{
						$enc_rb_id=$this->encryptcode->encrypt($rb_id,ENC_KEY_PASS);
						redirect("room-booking/status/$enc_rb_id");	
					}
				}	
				
			}
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