<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Webpage extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('webpage_model','webmod');
		$this->load->database();
	}
	public function frontpage(){
		$arr['siteTitle']="";
		$this->load->view('frontpage',$arr);
	}
	public function terms_conditions(){
		$arr['siteTitle']="Terms and Conditions";
		$this->load->view('terms-conditions',$arr);
	}
	
	
	
	
	public function create_account_status($enc_reg_id){
		$arr['siteTitle']="Create Account Status";
		$reg_id=$this->encryptcode->encrypt($enc_reg_id,ENC_KEY_PASS);
		$arr['regdata']=$this->webmod->getPerRegistration($reg_id);
		$this->load->view('create-account-success',$arr);
	}
	public function create_account(){
		$arr['siteTitle']="Create Account";
		$custsesid=$this->session->userdata('custsesid');
		if(!empty($custsesid)){
			redirect('dashboard');
		} 
		$arr['statedata']=$this->webmod->getAllState();
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('reg_firstname','First Name', 'trim|required|xss_clean',array(
		'required'=>'First Name field is required'
		));
		
		$this->form_validation->set_rules('reg_lastname','Last Name', 'trim|required|xss_clean',array(
		'required'=>'Last Name field is required'
		));
		
		$this->form_validation->set_rules('reg_mobileno','Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]|xss_clean',array(
		'required'=>'Mobile Number field is required',
		'min_length'=>'Enter your 10 digit mobile number',
		'max_length'=>'Enter your 10 digit mobile number'
		));
		$this->form_validation->set_rules('reg_email','Email Id', 'trim|required|valid_email|is_unique[tb_registration.reg_email]|max_length[50]|xss_clean',array(
		'required'=>'Email Id field is required',
		'valid_email'=>'Please enter valid email id',
		'is_unique'=>'Email id already registered with us'
		));
		
		$this->form_validation->set_rules('reg_dob','Date of Birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reg_gender','Gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reg_address_line1','Address Line', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reg_address_line1','Address Line', 'trim|required|xss_clean');

		$this->form_validation->set_rules('reg_city','City Name', 'trim|required|xss_clean',array(
		'required'=>'City Name field is required'
		));
		$this->form_validation->set_rules('reg_state','State Name', 'trim|required|xss_clean',array(
		'required'=>'State Name field is required'
		));
		$this->form_validation->set_rules('reg_pincode','Pincode', 'trim|required|numeric|min_length[6]|max_length[6]|xss_clean',array(
		'required'=>'Pincode field is required',
		'min_length'=>'Enter  Pincode 6 digit only',
		'max_length'=>'Enter  Pincode 6 digit only'
		));
		$this->form_validation->set_rules('reg_loginid','Login Id', 'trim|required|min_length[2]|is_unique[tb_registration.reg_loginid]|xss_clean',array(
		'required'=>'Login Id is required',
		'is_unique'=>'Login Id already exist'
		));
		
		$this->form_validation->set_rules('reg_password','Password','required|trim|min_length[6]',
		array(
		'required'=>'Password field is required',
		'min_length'=>'Use 6 characters or more for your password'
		));
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			$reg_dob=$data['reg_dob'];
			if($reg_dob!=""){
				$data['reg_dob']=date('Y-m-d',strtotime($reg_dob));
			}
			$reg_id=$this->webmod->insertRegistration($data);
			if($reg_id){
			$regdata=$this->webmod->getPerRegistration($reg_id);
			$reg_loginid=$regdata->reg_loginid;
			$reg_email=$regdata->reg_email;
			$reg_password=$data['reg_password'];
			
				
				/* Send Email */
			$this->load->library('email');
			$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
			$this->email->to($reg_email);
			$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
			$this->email->set_mailtype("html");
			$this->email->subject("Devotee Registration Details");
			$message="<p><strong>Jai Mata Di !</strong><br/><br/>We thank you for registering with http://mansadevi.org.in. Your login credentials are as follows:</p>
			<p>
			<strong>Login Id:</strong> $reg_loginid <br/>
			<strong>Password:</strong> $reg_password
			</p><p>Thanks & regards,<br/><strong>Shri Mata Mansa Devi Shrine Board</strong></p>";
			$this->email->message($message);
			$this->email->send();	
				$enc_reg_id=$this->encryptcode->encrypt($reg_id,ENC_KEY_PASS);
				redirect("create-account/success/$enc_reg_id");
			}
		
		}
		$this->load->view('create-account',$arr);
	}
	public function my_profile(){
		$arr['siteTitle']="My Profile";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$this->load->view('my-profile',$arr);
	}
	public function login_account(){
		$arr['siteTitle']="Login";	
		$custsesid=$this->session->userdata('custsesid');
		if(!empty($custsesid)){
			redirect('dashboard');
		} 
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('reg_loginid','Login Id','required|trim|xss_clean');
		$this->form_validation->set_rules('reg_password','Password','required|trim|xss_clean');
		if($this->form_validation->run()==true){
				$data=$this->input->post();	
				$userdata=$this->webmod->checkUserAuth($data);
				if($userdata){
					$reg_id=$userdata->reg_id;
					$this->session->set_userdata('custsesid',$reg_id);
					$redirecturl=$this->session->userdata('redirecturl');
					if($redirecturl=="online-donation"){
						$this->session->unset_userdata('redirecturl');
						redirect("online-donation");	
					}elseif($redirecturl=="online-chola-booking"){
						$this->session->unset_userdata('redirecturl');
						redirect("online-chola-booking");
					}
					redirect("dashboard");	
				}else{
					$this->session->set_flashdata('feedback',"Either Login Id and/or password wrong.");
					$this->session->set_flashdata('feedbackerr',"alert-danger");
		 			redirect("user/login");	
				}		
			}
		$this->load->view('account-login',$arr);
	}
	
	public function account_dashboard(){
		$arr['siteTitle']="Dashboard";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			redirect('login');
		} 
		$this->load->view('dashboard',$arr);
	}
	public function account_logout(){
		$arr['sitetitle']='User Logout';
		$this->session->unset_userdata('custsesid');
		redirect('login');
	}
	
}
?>