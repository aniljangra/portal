<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notify_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent','CryptAES'));
		$this->load->model('Notify_model','notimod');
		$this->load->database();
	}
	
	public function payment_notify(){
		$responseParameter1=$_REQUEST['encData'];
		$key=Key;
		$this->load->library('CryptAES');
		$aes = new CryptAES();
		$aes->set_key(base64_decode($key));
		$aes->require_pkcs5();
		$responseParameter2=$aes->decrypt($responseParameter1);
		/*
		$responseParameter2="CH-4ee0251119134833|NA|FAIL|501|INR|NB|Chola|User Cancel Transaction|NA|NA|2019-11-25 19:18:35|IN|00|1000269|0.00^0.00|||||||||";*/
		
		$final_response=explode("|", $responseParameter2);
		if(count($final_response)>0){
			
			$orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_type=$final_response[6];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			
			if($trans_type=="Donation"){
			$dataup['donation_transstatus']=$trans_status;
			$dataup['donation_paymode']=$pay_mode;
			$dataup['donation_transdate']=$trans_date;
			$dataup['donation_bankrefno']=$bank_ref_no;
			$dataup['donation_statusdesc']=$status_description;
				$donationdata=$this->notimod->getDonationByOrder($orderno);
				if($donationdata){
					$donation_id=$donationdata->donation_id;
					$donation_email=$donationdata->donation_email;
					
					$uppay=$this->notimod->upDonationStatus($dataup,$donation_id);	
					/* Send Email Here */
						$this->load->library('email');
						$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
						$this->email->to($donation_email);
						$this->email->bcc('info@mansadevi.org.in');
						$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
						$this->email->set_mailtype("html");
						$this->email->subject("Online Donation Status");
						$message="<strong>Donation Detail:</strong><br/>
						Order No: $orderno<br/>
						Transaction Status: $trans_status<br/>
						Amount Paid: $amount_paid<br/>
						Payment Mode: $pay_mode<br/>
						Transaction Date: $trans_date<br/>
						Bank Ref. Number: $bank_ref_no<br/>
						";
						$this->email->message($message);
						$this->email->send();	
				}
			}elseif($trans_type=="Chola"){
				
			$dataup['cb_transstatus']=$trans_status;
			$dataup['cb_paymode']=$pay_mode;
			$dataup['cb_transdate']=$trans_date;
			$dataup['cb_bankrefno']=$bank_ref_no;
			$dataup['cb_statusdesc']=$status_description;
				$cbdata=$this->notimod->getCholaBookingByOrder($orderno);
				$cb_bookfordate=$cbdata->cb_bookfordate;
				$book_date=date('d-m-Y',strtotime($cb_bookfordate));
				$cb_email=$cbdata->cb_email;
			
				if($cbdata){
				$cb_id=$cbdata->cb_id;
				$uppay=$this->notimod->upCholaBookingStatus($dataup,$cb_id);	
					/* Send Email Here */
						$this->load->library('email');
						$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
						$this->email->to($cb_email);
						$this->email->bcc('info@mansadevi.org.in');
						$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
						$this->email->set_mailtype("html");
						$this->email->subject("Chola Booking  Status");
						$message="<strong>Donation Detail:</strong><br/>
						Order No: $orderno<br/>
						Chola Book for Date: $book_date<br/>
						Transaction Status: $trans_status<br/>
						Amount Paid: $amount_paid<br/>
						Payment Mode: $pay_mode<br/>
						Transaction Date: $trans_date<br/>
						Bank Ref. Number: $bank_ref_no<br/>
						";
						$this->email->message($message);
						$this->email->send();	
				}
			}elseif($trans_type=="Rooms"){
			$dataup['rb_transstatus']=$trans_status;
			$dataup['rb_paymode']=$pay_mode;
			$dataup['rb_transdate']=$trans_date;
			$dataup['rb_bankrefno']=$bank_ref_no;
			$dataup['rb_statusdesc']=$status_description;
			$dataup['rb_dateup']=1;
			
				$rbdata=$this->notimod->getRoomBookingByOrder($orderno);
				$rb_bookfordate=$rbdata->rb_bookfordate;
				$rb_norooms=$rbdata->rb_norooms;
				$book_date=date('d-m-Y',strtotime($rb_bookfordate));
				$rb_email=$rbdata->rb_email;
				if($rbdata){
				$rb_id=$rbdata->rb_id;
				
				
				$uppay=$this->notimod->upRoomBookingStatus($dataup,$rb_id);	
					/* Send Email Here */
						$this->load->library('email');
						$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
						$this->email->to($rb_email);
						$this->email->bcc('info@mansadevi.org.in');
						$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
						$this->email->set_mailtype("html");
						$this->email->subject("Room Booking  Status");
						$message="<strong>Room Booking Detail:</strong><br/>
						Order No: $orderno<br/>
						Reservation Date: $book_date<br/>
						No. of Rooms: $rb_norooms<br/>
						Transaction Status: $trans_status<br/>
						Amount Paid: $amount_paid<br/>
						Payment Mode: $pay_mode<br/>
						Transaction Date: $trans_date<br/>
						Bank Ref. Number: $bank_ref_no<br/>
						";
						$this->email->message($message);
						$this->email->send();	
				}
			}elseif($trans_type=="Hawan"){
			$dataup['hw_transstatus']=$trans_status;
			$dataup['hw_paymode']=$pay_mode;
			$dataup['hw_transdate']=$trans_date;
			$dataup['hw_bankrefno']=$bank_ref_no;
			$dataup['hw_statusdesc']=$status_description;
			$dataup['hw_dateup']=1;
			
				$hwdata=$this->notimod->getHawanBookingByOrder($orderno);
				$hw_bookfordate=$hwdata->hw_bookfordate;
				$book_date=date('d-m-Y',strtotime($hw_bookfordate));
				$hw_email=$hwdata->hw_email;
				if($hwdata){
				$hw_id=$hwdata->hw_id;
				$hw_bookslotname=$hwdata->hw_bookslotname;
				
				
				$uppay=$this->notimod->upHawanBookingStatus($dataup,$hw_id);	
					/* Send Email Here */
						$this->load->library('email');
						$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
						$this->email->to($hw_email);
						$this->email->bcc('info@mansadevi.org.in');
						$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
						$this->email->set_mailtype("html");
						$this->email->subject("Hawan Booking  Status");
						$message="<strong>Hawan Booking Detail:</strong><br/>
						Order No: $orderno<br/>
						Hawan Book for Date: $book_date<br/>
						Time Slot: $hw_bookslotname<br/>
						Transaction Status: $trans_status<br/>
						Amount Paid: $amount_paid<br/>
						Payment Mode: $pay_mode<br/>
						Transaction Date: $trans_date<br/>
						Bank Ref. Number: $bank_ref_no<br/>
						";
						$this->email->message($message);
						$this->email->send();	
				}
			}
			
		}
	}
		
		
}
?>