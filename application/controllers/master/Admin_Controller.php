<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends CI_Controller{
	 function __construct() { 
		 parent::__construct(); 
		 $this->load->helper(array('form', 'url','security')); 
		$this->load->library(array('form_validation','session'));
		$this->load->model('master/admin_model','admod');
		

	 }
	 public function admin_profile(){
		$arr['siteTitle']="Dashboard"; 
	 	$this->load->database(); 
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['admdata']=$this->admod->getAdminProfile($masterId); 
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('first_name','First Name', 'trim|required');
		$this->form_validation->set_rules('last_name','Last Name', 'trim|required');
		$this->form_validation->set_rules('email','Email ID', 'required|valid_email|callback_checkuserEmail');
		$this->form_validation->set_rules('phone','Mobile Number','trim|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','Password', 'min_length[8]|max_length[12]');
		if($this->form_validation->run()==true){
				$data=$this->input->post();
				$user_created=$this->admod->updateAccount($data,$masterId);
				if($user_created){
					$this->session->set_flashdata('feedback',"Thank You. Admin account updated successfully.");
					$this->session->set_flashdata('feedbackerr',"alert-success");
					redirect("master/profile");	
				}else{
					$this->session->set_flashdata('feedback',"Something wrong please try again.");
					$this->session->set_flashdata('feedbackerr',"alert-danger");
					redirect("master/profile");	
				}
		}else{
			$this->load->view('master/master-profile',$arr);
		}
	 }
	 public function checkuserEmail($email){
		$oldemail=$this->input->post('oldemail');
		if($email==$oldemail){
			return true;
		}else{
			$this->load->database(); 
			$return=$this->admod->checkuserEmail($email);
			if($return>0){
				$this->form_validation->set_message('checkuserEmail', 'The  {field} already exist');
             		return FALSE;
				}else{
					 return TRUE; 
				}	
		}
	}
	 public function admin_dashboard(){
		$arr['siteTitle']="Dashboard";
		$this->load->database(); 
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['admdata']=$this->admod->getAdminProfile($masterId); 
		$this->load->view('master/master-dashboard',$arr);
	} 
	
	 
	 public function ad_login(){
		$arr['siteTitle']="Admin Login";
		if($this->session->userdata('masterId')){
			 redirect('master/dashboard');
		} 
		$this->form_validation->set_error_delimiters('<span class="error-form">','</span>');
		$this->form_validation->set_rules('loginid','Login Id','trim|required|xss_clean'); 
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
		 if($this->form_validation->run()==TRUE){
			$this->load->database(); 
			$data=$this->input->post();
			unset($data['submit_login']);
			$userId=$this->admod->adminLogin($data); 
			if($userId){
				// print_r($userId->ad_panel_permission); die();
					$this->session->set_userdata('masterId',$userId->ad_userid);
					//$this->session->set_userdata('masteraccess',$userId->ad_panel_permission);
					//$this->session->set_userdata('cholaaccess',$userId->ad_chola_per);
					redirect("master/dashboard");	
					
			}else{
					$arr['error']='Login failed wrong  user credential';
					$this->load->view('master/admin-login',$arr);
			}
		}else{
			$this->load->view('master/admin-login',$arr);
		}
	}
	public function admin_logout(){
		$this->session->unset_userdata('masterId');
		redirect('master/login');	
	}
}
?>















