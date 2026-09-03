<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customcode{
	 public function __construct($params = array()) {
        $this->CI=& get_instance();
		$this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->database();
		$this->CI->load->model('custom_model','custommod');
	 }
	 function getAdminProfile($ad_userid){
		$this->CI->load->database();
		$this->CI->load->model('Custommodel','custommod');	
		$sidemuserdata=$this->CI->custommod->getAdminProfile($ad_userid); 
		return $sidemuserdata;
	}
	public function getUserAccount($reg_id){
		$this->CI->load->database();
		$userdata=$this->CI->custommod->getPerRegistration($reg_id); 
		return $userdata;
	} 
	public function getPerDateSlotSuccess($date,$slot){
		$this->CI->load->database();
		$countrec=$this->CI->custommod->getTotPerDateSlotSuccess($date,$slot); 
		return $countrec;
	}  
	public function getPerDateSlotProcess($date,$slot){
		$this->CI->load->database();
		$countrec=$this->CI->custommod->getTotPerDateSlotProcess($date,$slot); 
		return $countrec;
	}
	public function getAllSuccessRoomBooking($date){
		$this->CI->load->database();
		$rb_totsuc=$this->CI->custommod->getAllSuccessRoomBooking($date); 
		return $rb_totsuc;
	}
	public function getAllInProcessRoomBooking($date){
		$this->CI->load->database();
		$rb_totinpro=$this->CI->custommod->getAllInProcessRoomBooking($date); 
		return $rb_totinpro;
	} 
	
	 
}