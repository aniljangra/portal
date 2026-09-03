<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Room_Controller extends CI_Controller{
	 function __construct() { 
         parent::__construct(); 
			$this->load->helper(array('form','url','security')); 
			$this->load->library(array('form_validation','session','user_agent'));
			$this->load->model('master/Room_model','roommod');
			$this->load->database(); 
	} 
	public function manage_room_booking(){
		$arr['siteTitle']='Manage Room Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['rbdata']=$this->roommod->getAllRoomBooking();
		$this->load->view("master/master-manage-roombooking",$arr);	
	}
	public function view_room_booking($rb_id){
		$arr['siteTitle']='View Room Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['rbrow']=$this->roommod->getPerRoomBooking($rb_id);
		$this->load->view("master/master-view-roombooking",$arr);	
	}
	
}