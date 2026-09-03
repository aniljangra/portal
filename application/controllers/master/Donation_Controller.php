<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Donation_Controller extends CI_Controller{
	 function __construct() { 
         parent::__construct(); 
			$this->load->helper(array('form','url','security')); 
			$this->load->library(array('form_validation','session','user_agent'));
			$this->load->model('master/Donation_model','donmod');
			$this->load->database(); 
	} 
	
	public function manage_donation(){
		$arr['siteTitle']='Manage Donation';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['dondata']=$this->donmod->getAllDonationSuccess();
		$this->load->view("master/master-manage-donation",$arr);	
	}
	public function view_donation($donation_id){
		$arr['siteTitle']='View Donation';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['donationrow']=$this->donmod->getPerDonation($donation_id);
		$this->load->view("master/master-view-donation",$arr);	
	}
	
	public function manage_donation_pending($emp_id){
		$arr['siteTitle']='View Employee';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['emprow']=$this->donmod->getPerEmployee($emp_id);
		$this->load->view("master/master-view-employee",$arr);	
	}
	
	
	
	
}