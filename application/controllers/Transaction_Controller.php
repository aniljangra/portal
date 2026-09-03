<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Transaction_model','transmod');
		$this->load->database();
	}
	
	public function manage_donations(){
		$arr['siteTitle']="Donation Transactions";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$arr['donationdata']=$this->transmod->getAllDonations($custsesid);
		$this->load->view('transactions-donation',$arr);
	}
	public function view_donation($enc_donation_id){
		$arr['siteTitle']="View Donation Detail";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$donation_id=$this->encryptcode->decrypt($enc_donation_id,ENC_KEY_PASS);

		$arr['donationrow']=$this->transmod->getPerDonation($donation_id);
		$this->load->view('transactions-donation-view',$arr);
	}
	
	
	
	
	public function manage_cholabooking(){
		$arr['siteTitle']="Chola Booking Transactions";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$arr['choladata']=$this->transmod->getAllCholaBookings($custsesid);
		$this->load->view('transactions-cholabooking',$arr);
	}
	public function view_cholabooking($enc_cb_id){
		$arr['siteTitle']="View Chola Booking Detail";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);

		$arr['cholarow']=$this->transmod->getPerCholaBooking($cb_id);
		$this->load->view('transactions-chola-view',$arr);
	}
	
	
	
	public function manage_roombooking(){
		$arr['siteTitle']="Room Booking Transactions";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$arr['rbdata']=$this->transmod->getAllRoomBookings($custsesid);
		$this->load->view('transactions-room-booking',$arr);
	}
	public function view_roombooking($enc_rb_id){
		$arr['siteTitle']="View Room  Booking Detail";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$rb_id=$this->encryptcode->decrypt($enc_rb_id,ENC_KEY_PASS);

		$arr['rbrow']=$this->transmod->getPerRoomBooking($rb_id);
		$this->load->view('transactions-room-view',$arr);
	}
	
	
	public function manage_hawanbooking(){
		$arr['siteTitle']="Hawan Booking Transactions";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$arr['hwdata']=$this->transmod->getAllHawanBookings($custsesid);
		$this->load->view('transactions-hawan-booking',$arr);
	}
	public function view_hawanbooking($enc_hw_id){
		$arr['siteTitle']="View Hawan  Booking Detail";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$hw_id=$this->encryptcode->decrypt($enc_hw_id,ENC_KEY_PASS);

		$arr['hwrow']=$this->transmod->getPerHawanBooking($hw_id);
		$this->load->view('transactions-hawan-view',$arr);
	}
	
	
	

	
}
?>