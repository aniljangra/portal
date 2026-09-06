<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hawan_Controller extends CI_Controller{
	 function __construct() { 
         parent::__construct(); 
			$this->load->helper(array('form','url','security')); 
			$this->load->library(array('form_validation','session','user_agent'));
			$this->load->model('master/Hawan_model','hawanmod');
			$this->load->database(); 
	} 
	public function manage_hawan_booking(){
		$arr['siteTitle']='Manage Hawan Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['hwdata']=$this->hawanmod->getAllHawanBooking();
		$this->load->view("master/master-manage-hawan",$arr);	
	}
	public function view_hawan_booking($hw_id){
		$arr['siteTitle']='View Hawan Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['hwrow']=$this->hawanmod->getPerHawanBooking($hw_id);
		$this->load->view("master/master-view-hawan",$arr);	
	}
	
}