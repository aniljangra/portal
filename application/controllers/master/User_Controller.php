<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_Controller extends CI_Controller{
	 function __construct() { 
         parent::__construct(); 
			$this->load->helper(array('form','url','security')); 
			$this->load->library(array('form_validation','session','user_agent'));
			$this->load->model('master/User_model','usermod');
			$this->load->database(); 
	} 
	
	public function manage_user(){
		$arr['siteTitle']='Manage User';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['userdata']=$this->usermod->getAllUser();
		$this->load->view("master/master-manage-user",$arr);	
	}
	public function view_user($reg_id){
		$arr['siteTitle']='View User';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['userrow']=$this->usermod->getPerUser($reg_id);
		$this->load->view("master/master-view-user",$arr);	
	}
	
	
}