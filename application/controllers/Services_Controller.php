<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent','CryptAES'));
		$this->load->model('Cholaweb_model','cholamod');
		//$this->load->model('Services_model','servicemod');
		$this->load->database();

	}
	
	public function services_donation(){
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		$arr['ch_action']=HostedURL;
		$arr['do_EncryptTrans']=$this->session->userdata('do_EncryptTrans');
		$arr['do_MerchantId']=$this->session->userdata('do_MerchantId');
		$this->load->view('online-donation-services',$arr);
	}	
	
	public function services_cholabooking(){
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-chola-booking");
			redirect('login');
		} 
		$arr['ch_action']=HostedURL;
		$arr['ch_EncryptTrans']=$this->session->userdata('ch_EncryptTrans');
		$arr['ch_MerchantId']=$this->session->userdata('ch_MerchantId');
		$this->session->unset_userdata('ch_EncryptTrans');
		$this->session->unset_userdata('ch_MerchantId');
		$this->load->view('online-chola-services',$arr);
	}
	
	public function services_hawanbooking(){
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"hawan-booking");
			redirect('login');
		} 
		$arr['hb_action']=HostedURL;
		$arr['hb_EncryptTrans']=$this->session->userdata('hb_EncryptTrans');
		$arr['hb_MerchantId']=$this->session->userdata('hb_MerchantId');
		$this->load->view('online-hawan-services',$arr);
		$this->session->unset_userdata('hb_EncryptTrans');
		$this->session->unset_userdata('hb_MerchantId');
	}
	public function services_roombooking(){
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"room-booking");
			redirect('login');
		} 
		$arr['rb_action']=HostedURL;
		$arr['rb_EncryptTrans']=$this->session->userdata('rb_EncryptTrans');
		$arr['rb_MerchantId']=$this->session->userdata('rb_MerchantId');
		$this->session->unset_userdata('rb_EncryptTrans');
		$this->session->unset_userdata('rb_MerchantId');
		$this->load->view('online-roombooking-services',$arr);
	}
	
	
	
	
}
?>