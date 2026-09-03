<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hawanpage_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent','CryptAES'));
		$this->load->model('Hawanweb_model','hawanmod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function hawan_booking_step1(){
		$arr['siteTitle']="Hawan Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		$arr['hawanslotdata']=$this->hawanmod->getAllHawanSlot();
		
		//$arr['hw_datebooked']=$this->hawanmod->getAllHawanDateBooked();
		$arr['hw_inactivedate']=$this->hawanmod->getAllInactiveDateHawan();
		$arr['hw_datebook']=$this->hawanmod->getAllBookProcessHawan();
		/*echo "<pre>";
		print_r($arr['hw_datebook']);
		echo "</pre>";*/

		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('hw_date','Date', 'trim|required|callback_chkhawandate|xss_clean',array(
		'required'=>'Date field is required',
		));	
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			$hw_date=$data['hw_date'];
			$this->session->set_userdata('hw_date',$hw_date);
			/*$hw_id=$this->hawanmod->insertHawanBookingTemp($data,$custsesid);
			if($hw_id){
				$enc_hw_id=$this->encryptcode->encrypt($hw_id,ENC_KEY_PASS);*/
			redirect("hawan-booking/time-slots");
			/*}*/
		}
		$this->load->view('online-hawan-booking-step1',$arr);
	}
	
	public function hawan_booking_step2(){
		$arr['siteTitle']="Hawan Booking";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		$hw_date=$this->session->userdata('hw_date');
		if(empty($hw_date)){
			redirect("hawan-booking");
		}
		
	
			
			
		$arr['hawanslotdata']=$this->hawanmod->getAllHawanSlot();
		if(isset($_POST['hw_back'])){
			$this->session->unset_userdata('hw_date');
			redirect("hawan-booking");
		}
		
	if(isset($_POST['hwsubmit'])){
	$this->form_validation->set_error_delimiters('<span class="error">','</span>');
	$this->form_validation->set_rules('hw_bookslot','Time Slot', 'trim|required|callback_chktimeslot2|xss_clean',array('required'=>'Hawan booking time slot field is required',
		));	
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			$data['hw_date']=date('Y-m-d',strtotime($hw_date));
			$temp_hb_insid=$this->hawanmod->insertHawanBookingTemp($data,$custsesid);
			if($temp_hb_insid){
				$this->session->unset_userdata('hw_date');
				$enc_hwid=$this->encryptcode->encrypt($temp_hb_insid,ENC_KEY_PASS);
				redirect("hawan-booking/overview/$enc_hwid");
			}
			
		}
	}
	$this->load->view('online-hawan-booking-step2',$arr);	
			
	}
	public function chktimeslot2($hw_bookslot){
		$hw_date=$this->session->userdata('hw_date');
		if($hw_date!="" && $hw_bookslot!=""){
			$hw_date=date('Y-m-d',strtotime($hw_date));
			
		
			/* Check Hawan Slot in Success */
			$count_success_slot=$this->hawanmod->getNoHawanTimeSlotSuccess($hw_date,$hw_bookslot);
			if($count_success_slot==0){
				$count_porcess_slot=$this->hawanmod->getNoHawanTimeSlotProcess($hw_date,$hw_bookslot);
				if($count_porcess_slot==0){
					return TRUE;
				}else{
					$this->form_validation->set_message('chktimeslot', 'Another user processed  same time slot');
					return FALSE;
				}
			}else{
				$this->form_validation->set_message('chktimeslot', 'Hawan already booked for same slot');
				return FALSE;	
			}
			/* Check Hawan Slot in Processing */
				
		}
	}
	public function chktimeslot($hw_timeslot){
		$hw_bookfordate=$this->input->post('hw_bookfordate');
		if($hw_bookfordate!="" && $hw_timeslot!=""){
			$hw_date=date('Y-m-d',strtotime($hw_date));
			$hw_slot;
		
			/* Check Hawan Slot in Success */
			$count_success_slot=$this->hawanmod->getNoHawanTimeSlotSuccess($hw_date,$hw_slot);
			if($count_success_slot==0){
				$count_porcess_slot=$this->hawanmod->getNoHawanTimeSlotProcess($hw_date,$hw_slot);
				if($count_porcess_slot==0){
					return TRUE;
				}else{
					$this->form_validation->set_message('chktimeslot', 'Another user processed  same time slot');
					return FALSE;
				}
			}else{
				$this->form_validation->set_message('chktimeslot', 'Hawan already booked for same slot');
				return FALSE;	
			}
			/* Check Hawan Slot in Processing */
				
		}
	}
	public function chkhawandate($hw_bookfordate){
		if($hw_bookfordate!=""){
		$hw_bookfordate=date('Y-m-d',strtotime($hw_bookfordate));
		$count_inactive=$this->hawanmod->count_inactivedate($hw_bookfordate);
				if($count_inactive==0){
					$total_count=0;
					$count_date=$this->hawanmod->count_hawansuccess_date($hw_bookfordate);
					$count_processing=$this->hawanmod->count_hawanprocess_date($hw_bookfordate);
					$total_count=$count_date+$count_processing;
					if($total_count<3){
						/* Previous Date */
						$book_datetime=strtotime($hw_bookfordate);
						$current_datetime=strtotime(date('Y-m-d'));
						if($book_datetime<$current_datetime){
$this->form_validation->set_message('chkhawandate', 'Please enter valid date');					
return FALSE;	
						}else{
							$three_month=date('Y-m-d', strtotime('+3 months'));
							$threem_time=strtotime($three_month);
							if($book_datetime>$threem_time){
								$this->form_validation->set_message('chkhawandate', 'Pleas select date between three month from current date');					
								return FALSE;
							}else{
								return TRUE;	 
							}
						}
						
					}else{
$this->form_validation->set_message('chkhawandate', 'Booking is full for this date');					return FALSE;	 
						
					}
				}else{
					$this->form_validation->set_message('chkhawandate', 'Booking is off for this date');
					return FALSE;	 	
				}
		
		}else{
			return true;
		}
	}
	public function hawan_booking_step3($enc_hw_id){
		$arr['siteTitle']="Hawan Booking Overview";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		
		$amount=HWB_AMT;
		$success_url="https://www.mansadevi.org.in/portal/hawan-booking/success";
		$fail_url="https://www.mansadevi.org.in/portal/hawan-booking/failure";
		$arr['amount']=$amount;
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$hw_id=$this->encryptcode->decrypt($enc_hw_id,ENC_KEY_PASS);
		$arr['hawanbooktemp']=$this->hawanmod->getPerHawanBookingTemp($hw_id);
		$hs_id=$arr['hawanbooktemp']->hw_timeslot;
		$arr['timeslotdata']=$this->hawanmod->getPerTimeSlot($hs_id);
		
		
		
		if($arr['hawanbooktemp']){
		if(isset($_POST['backPage'])){
			$this->hawanmod->delPerTempHawanBooking($hw_id);
			redirect("hawan-booking/time-slots");
		}
		
		if(isset($_POST['bookHawanBook'])){
			$this->form_validation->set_error_delimiters('<span class="error_step">','</span>');
			$this->form_validation->set_rules('hw_bookfordate','Booking Date', 'trim|required|xss_clean',array(
			'required'=>'Booking Date field is required'
			));
			
			$this->form_validation->set_rules('hw_timeslot','Booking Time Slot', 'trim|required|callback_chktimeslot|xss_clean',array(
			'required'=>'Booking Time Slot Date field is required'
			));
			
			
		if($this->form_validation->run()==true){
		$data=$this->input->post();
		
		
		$time=date("dmyHis");
		$txnid="HB-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;
		$datahb['hw_orderno']=$txnid;
		$datahb['hw_regid']=$custsesid;
		/*$name=$arr['regdata']->reg_firstname;
		if($arr['regdata']->reg_lastname!=""){
			$name=$name." ".$arr['regdata']->reg_lastname;	
		}*/
		$hs_id=$arr['hawanbooktemp']->hw_timeslot;
		$arr['slotdata']=$this->hawanmod->getPerTimeSlot($hs_id);
		
		$datahb['hw_bookfordate']=$arr['hawanbooktemp']->hw_bookfordate;
		$datahb['hw_bookslot']=$arr['hawanbooktemp']->hw_timeslot;
		
		
		$name="";
		$reg_firstname=$arr['regdata']->reg_firstname;
		$reg_lastname=$arr['regdata']->reg_lastname;
		
		if($arr['regdata']->reg_lastname!=""){
			$name=$reg_firstname." ".$reg_lastname;
		}else{
			$name=$reg_firstname;	
		}
		
		$datahb['hw_name']=$name;
		$reg_mobileno=$arr['regdata']->reg_mobileno;
		$datahb['hw_mobile']=$reg_mobileno;
		
		$reg_email=$arr['regdata']->reg_email;
		$datahb['hw_email']=$reg_email;
		
		$address=$arr['regdata']->reg_address_line1;
		if($arr['regdata']->reg_address_line2!=""){
			$address==$address." ".$arr['regdata']->reg_address_line2;
		}
		$datahb['hw_address']=$address;
		
		$reg_city=$arr['regdata']->reg_city;
		$datahb['hw_city']=$reg_city;
		
		$reg_state=$arr['regdata']->reg_state;
		$datahb['hw_state']=$reg_state;
		
		$reg_pincode=$arr['regdata']->reg_pincode;
		$datahb['hw_pincode']=$arr['regdata']->reg_pincode;
		
		$datahb['hw_amount']=$amount;
		$datahb['hw_bookslotname']=$arr['slotdata']->hs_title;
		$hw_insid=$this->hawanmod->insertHawanBooking($datahb);
				if($hw_insid){
					$hb=$this->hawanmod->getPerHawanBooking($hw_insid);
			$MerchantOrderNo=$hb->hw_orderno;	
					
/* Gateway Setting */
$MerchantId=MerchantId;
$OperatingMode=OperatingMode;
$MerchantCountry=MerchantCountry;
$MerchantCurrency=MerchantCurrency;
$key=Key;
//requestparameter
$transaction_type="Hawan";
$requestParameter="$MerchantId|$OperatingMode|$MerchantCountry|$MerchantCurrency|$amount|$transaction_type|$success_url|$fail_url|SBIEPAY|$MerchantOrderNo|$custsesid|NB|ONLINE|ONLINE";

//echo '<b>Requestparameter:-</b> '.$requestParameter.'<br/><br/>';
//$billingDtls ="$name|$reg_city|$reg_state|$reg_pincode|||||$reg_mobileno|$reg_email|N";
//echo '<b>Billingdetails:-</b> '.$billingDtls.'<br/><br/>';

//$shippingDtls ="||||||||";
//echo '<b>Shippingdetails:-</b> '.$shippingDtls.'<br/><br/>';

//$PaymentDtls="aggGtwmapID| | | | | | |";
//echo '<b>Paymentdetails:-</b> '.$PaymentDtls.'<br/><br/>';
$aesnew=new CryptAES();
$aesnew->set_key(base64_decode($key));
$aesnew->require_pkcs5();
$EncryptTrans=$aesnew->encrypt($requestParameter);
//$EncryptbillingDetails  = $aes->encrypt($billingDtls);
//$EncryptshippingDetais  = $aes->encrypt($shippingDtls);
//$EncryptpaymentDetails  = $aes->encrypt($PaymentDtls);

//echo '<b>Encrypted EncryptTrans:-</b>'.$EncryptTrans.'<br/><br/>';
//echo '<b>Encrypted EncryptbillingDetails:-</b> '.$EncryptbillingDetails.'<br/><br/>';
//echo '<b>Encrypted EncryptshippingDetais:-</b>'.$EncryptshippingDetais.'<br/><br/>';
//echo '<b>Encrypted EncryptpaymentDetails:-</b>'.$EncryptpaymentDetails.'<br/><br/>';
//echo "<br/>Action URL:https://www.sbiepay.com/secure/AggregatorHostedListener ";
?>
<!--<form method="post" name="redirectnew" id="redirectnew" action="https://www.sbiepay.com/secure/AggregatorHostedListener">
<input type="text" name="EncryptTrans" value="<?php //echo $EncryptTrans; ?>">
<input type="text" name="merchIdVal" value ="<?php //echo $MerchantId; ?>"/>
<input type="submit" name="submit" value="Submit">
 </form>-->
 
 <!--<script language='javascript'>
 document.getElementById("redirectnew").submit();</script>-->

<?php
$this->session->set_userdata('hb_EncryptTrans',$EncryptTrans);
$this->session->set_userdata('hb_MerchantId',$MerchantId);
$this->hawanmod->delPerTempHawanBooking($hw_id);
redirect('online-services/hawan-booking');

		}
		}
		}
		}else{
			redirect("hawan-booking");
		}
		
	$this->load->view('online-hawan-booking-step3',$arr);

	}
	public function payment_status_hawan(){
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
			
			$hw_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['hw_transstatus']=$trans_status;
			$dataup['hw_paymode']=$pay_mode;
			$dataup['hw_transdate']=$trans_date;
			$dataup['hw_bankrefno']=$bank_ref_no;
			$dataup['hw_statusdesc']=$status_description;
			$dataup['hw_dateup']=1;
			
			$hwdata=$this->hawanmod->getHawanBookingByOrder($hw_orderno);
			if($hwdata){
				$hw_id=$hwdata->hw_id;
				$uppay=$this->hawanmod->upHawanBookingStatus($dataup,$hw_id);	
				if($uppay){
					$enc_hw_id=$this->encryptcode->encrypt($hw_id,ENC_KEY_PASS);
					redirect("hawan-booking/success/$enc_hw_id");		
				}
			}
		}
	}
	public function hawanpayment_failure(){
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
			
			$hw_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['hw_transstatus']=$trans_status;
			$dataup['hw_paymode']=$pay_mode;
			$dataup['hw_transdate']=$trans_date;
			$dataup['hw_bankrefno']=$bank_ref_no;
			$dataup['hw_statusdesc']=$status_description;
			$dataup['hw_dateup']=1;
			
			$hwdata=$this->hawanmod->getHawanBookingByOrder($hw_orderno);
			if($hwdata){
				$hw_id=$hwdata->hw_id;
				$uppay=$this->hawanmod->upHawanBookingStatus($dataup,$hw_id);	
				if($uppay){
					$enc_hw_id=$this->encryptcode->encrypt($hw_id,ENC_KEY_PASS);
					redirect("hawan-booking/status/$enc_hw_id");		
				}
			}
		}
	}
	public function hawan_success_preview($enc_hw_id){
		$arr['siteTitle']="Payment Status detail";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		$hw_id=$this->encryptcode->decrypt($enc_hw_id,ENC_KEY_PASS);
		$arr['hwdata']=$this->hawanmod->getPerHawanBooking($hw_id);	
		$this->load->view('hawan-success-preview',$arr);
	}
	public function hawan_fail_preview($enc_hw_id){
		$arr['siteTitle']="Payment Status detail";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		$hw_id=$this->encryptcode->decrypt($enc_hw_id,ENC_KEY_PASS);
		$arr['hwdata']=$this->hawanmod->getPerHawanBooking($hw_id);	
		$this->load->view('hawan-fail-preview',$arr);
	}
	
	
	
}
?>