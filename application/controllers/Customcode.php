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
}