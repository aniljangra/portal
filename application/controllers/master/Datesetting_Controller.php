<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Datesetting_Controller extends CI_Controller{
	 function __construct() { 
        parent::__construct(); 
		$this->load->helper(array('form','url','security')); 
		$this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('master/Dateset_model','dsmod');
		$this->load->database(); 
	} 
	public function manage_datesetting(){
		$arr['siteTitle']='Manage Date Seeting';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['datesetdata']=$this->dsmod->getAllDateSetting();
		$this->load->view("master/master-manage-date-setting",$arr);	
	}
	

	/*public function view_donation($donation_id){
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

	}*/

	public function add_datesetting(){
		$arr['siteTitle']='Add Date Setting';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$this->form_validation->set_error_delimiters('<span class="error1">','</span>');
		$this->form_validation->set_rules('dset_date','Date', 'trim|required|xss_clean|is_unique[tb_datesetting.dset_date]');
		$this->form_validation->set_rules('dset_hawanbooking','Hawan Booking Status','trim|required|xss_clean');
		$this->form_validation->set_rules('dset_roombooking','Room Booking Status','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			unset($data['submit_page']);
			$dset_date=$data['dset_date'];
			$data['dset_date']=date('Y-m-d',strtotime($dset_date));
			
			if($this->dsmod->addDateSetting($data)){
				$this->session->set_flashdata('feedback',"Date Setting  added successfully.");
				$this->session->set_flashdata('feedbackerr',"alert-success");
				redirect("master/date-setting/manage");	
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please try again.");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("master/date-setting/manage");	
			}

		}else{
			$this->load->view('master/master-datesetting-add',$arr);	
		}
		
	}
	public function edit_datesetting($dset_id){
		$arr['siteTitle']='Edit Date Setting';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['datesetdata']=$this->dsmod->getPerDateSetting($dset_id);
		$this->form_validation->set_error_delimiters('<span class="error1">','</span>');
		$this->form_validation->set_rules('dset_date','Date', 'trim|required|xss_clean|is_unique[tb_datesetting.dset_date]');
		$this->form_validation->set_rules('dset_hawanbooking','Hawan Booking Status','trim|required|xss_clean');
		$this->form_validation->set_rules('dset_roombooking','Room Booking Status','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			unset($data['submit_page']);
			$dset_date=$data['dset_date'];
			$data['dset_date']=date('Y-m-d',strtotime($dset_date));
			
			if($this->dsmod->addDateSetting($data)){
				$this->session->set_flashdata('feedback',"Date Setting  updated successfully.");
				$this->session->set_flashdata('feedbackerr',"alert-success");
				redirect("master/date-setting/manage");	
			}else{
				$this->session->set_flashdata('feedback',"Something wrong please try again.");
				$this->session->set_flashdata('feedbackerr',"alert-danger");
				redirect("master/date-setting/manage");	
			}

		}else{
			$this->load->view('master/master-datesetting-edit',$arr);	
		}
		
	}
}