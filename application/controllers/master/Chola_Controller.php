<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chola_Controller extends CI_Controller{
	 function __construct() { 
         parent::__construct(); 
			$this->load->helper(array('form','url','security','string')); 
			$this->load->library(array('form_validation','session','user_agent'));
			$this->load->model('master/Chola_model','cholamod');
			$this->load->model('master/admin_model','admod');
			$this->load->database(); 
	} 
	
	public function manage_chola_booking(){
		$arr['siteTitle']='Manage Chola Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['admdata']=$this->admod->getAdminProfile($masterId); 
		$temple_id=$arr['admdata']->ad_temple;
		
		$arr['choladata']=$this->cholamod->getAllBookingChola($temple_id);
		$this->load->view("master/master-chola-booking-manage",$arr);
	}
	
	public function view_cholabooking($enc_cb_id){
		$arr['siteTitle']='View Chola';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$cb_id=$this->encryptcode->decrypt($enc_cb_id,ENC_KEY_PASS);
		$arr['cholarow']=$this->cholamod->getPerCholaBooking($cb_id);
		$this->load->view("master/master-chola-booking-view",$arr);	
	}
	public function manage_chola_success(){
		$arr['siteTitle']='Manage Chola Booking';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$arr['choladata']=$this->cholamod->getAllCholaBookingSuccess();
		$this->load->view("master/master-manage-chola-success",$arr);
	}
	
	public function search_chola(){
		$arr['siteTitle']='Search Chola';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$adminrow=$this->admod->getAdminProfile($masterId);
		$this->form_validation->set_error_delimiters('<span class="error1">','</span>');
		$this->form_validation->set_rules('from_date','From Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('to_date','To Date', 'trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			unset($data['submit_page']);
			$from_date=$data['from_date'];
			$to_date=$data['to_date'];
			if($from_date!=""){
				$from_date=date('Y-m-d',strtotime($from_date));
			}
			if($to_date!=""){
				$to_date=date('Y-m-d',strtotime($to_date));
			}
			$search_date=$from_date."|".$to_date;
			$enc_search_date=$this->encryptcode->encrypt($search_date,ENC_KEY_PASS);
			redirect("master/chola-booking/searchlist/$enc_search_date");
		}else{
		$this->load->view('master/master-chola-search',$arr);
		}
	}
	public function search_cholalist($enc_dates){
		$arr['siteTitle']='Search Chola';	
		$masterId=$this->session->userdata('masterId');
		if(empty($masterId)){
			redirect('master/login');
		}
		$adminrow=$this->admod->getAdminProfile($masterId);
		$ad_temple=$adminrow->ad_temple;
		$this->form_validation->set_error_delimiters('<span class="error1">','</span>');
		$this->form_validation->set_rules('from_date','From Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('to_date','To Date', 'trim|required|xss_clean');
		$datedata=$this->encryptcode->decrypt($enc_dates,ENC_KEY_PASS);
		$date_ar=explode("|",$datedata);
		$from_date=$date_ar[0];
		$to_date=$date_ar[1];
		
		$arr['choladata']=$this->cholamod->getAllCholaBookingSearch($ad_temple,$from_date,$to_date);

			if(isset($_POST['submit_export'])){
			$this->form_validation->set_error_delimiters('<span class="error1">','</span>');
			$this->form_validation->set_rules('exportfield','Export Form','trim|required');
			
				
					$data=$this->input->post();
					$cbid=$data['cbid'];
					
					if($cbid!=""){
					$datatoexcel=array();
					if(count($cbid)>0){
						$sr=1;
						foreach($cbid as $cb_id){
							$cbdata=$this->cholamod->getPerCholaBooking($cb_id);
							$temple_name=$cbdata->temple_name;
							$cb_orderno=$cbdata->cb_orderno;
							$cb_bookfordate=$cbdata->cb_bookfordate;
							$cb_name=$cbdata->cb_name;
							$cb_mobile=$cbdata->cb_mobile;
							$cb_amount=$cbdata->cb_amount;
							$cb_transstatus=$cbdata->cb_transstatus;
							$cb_bankrefno=$cbdata->cb_bankrefno;
							$cb_aadhar=$cbdata->cb_aadhar;
							
							$cb_devotee_name1=$cbdata->cb_devotee_name1;
							$cb_devotee_mobile1=$cbdata->cb_devotee_mobile1;
							$cb_devotee_aadhar1=$cbdata->cb_devotee_aadhar1;
							$cb_devotee_name2=$cbdata->cb_devotee_name2;
							$cb_devotee_mobile2=$cbdata->cb_devotee_mobile2;
							$cb_devotee_aadhar2=$cbdata->cb_devotee_aadhar2;
							$cb_devotee_name3=$cbdata->cb_devotee_name3;
							$cb_devotee_mobile3=$cbdata->cb_devotee_mobile3;
							$cb_devotee_aadhar3=$cbdata->cb_devotee_aadhar3;
							$cb_devotee_name4=$cbdata->cb_devotee_name4;
							$cb_devotee_mobile4=$cbdata->cb_devotee_mobile4;
							$cb_devotee_aadhar4=$cbdata->cb_devotee_aadhar4;
							$cb_devotee_name5=$cbdata->cb_devotee_name5;
							$cb_devotee_mobile5=$cbdata->cb_devotee_mobile5;
							$cb_devotee_aadhar5=$cbdata->cb_devotee_aadhar5;
							$cb_proof=$cbdata->cb_proof;
							$proof_final=base_url().$cb_proof;
							$cb_subdatetime=$cbdata->cb_subdatetime;
							$datatoexcel[$cb_id]['sr_no']=$sr;
							$datatoexcel[$cb_id]['cb_orderno']=$cb_orderno;
							$datatoexcel[$cb_id]['temple_name']=$temple_name;
							$datatoexcel[$cb_id]['cb_bookfordate']=$cb_bookfordate;
							$datatoexcel[$cb_id]['cb_name']=$cb_name;
							$datatoexcel[$cb_id]['cb_mobile']=$cb_mobile;
							$datatoexcel[$cb_id]['cb_aadhar']=$cb_aadhar;
							$datatoexcel[$cb_id]['cb_devotee_name1']=$cb_devotee_name1;
							$datatoexcel[$cb_id]['cb_devotee_mobile1']=$cb_devotee_mobile1;
							$datatoexcel[$cb_id]['cb_devotee_aadhar1']=$cb_devotee_aadhar1;
							$datatoexcel[$cb_id]['cb_devotee_name2']=$cb_devotee_name2;
							$datatoexcel[$cb_id]['cb_devotee_mobile2']=$cb_devotee_mobile2;
							$datatoexcel[$cb_id]['cb_devotee_aadhar2']=$cb_devotee_aadhar2;
							$datatoexcel[$cb_id]['cb_devotee_name3']=$cb_devotee_name3;
							$datatoexcel[$cb_id]['cb_devotee_mobile3']=$cb_devotee_mobile3;
							$datatoexcel[$cb_id]['cb_devotee_aadhar3']=$cb_devotee_aadhar3;
							$datatoexcel[$cb_id]['cb_devotee_name4']=$cb_devotee_name4;
							$datatoexcel[$cb_id]['cb_devotee_mobile4']=$cb_devotee_mobile4;
							$datatoexcel[$cb_id]['cb_devotee_aadhar4']=$cb_devotee_aadhar4;
							$datatoexcel[$cb_id]['cb_devotee_name5']=$cb_devotee_name5;
							$datatoexcel[$cb_id]['cb_devotee_mobile5']=$cb_devotee_mobile5;
							$datatoexcel[$cb_id]['cb_devotee_aadhar5']=$cb_devotee_aadhar5;
							$datatoexcel[$cb_id]['cb_amount']=$cb_amount;
							$datatoexcel[$cb_id]['cb_transstatus']=$cb_transstatus;
							$datatoexcel[$cb_id]['cb_bankrefno']=$cb_bankrefno;
							$datatoexcel[$cb_id]['cb_proof']=$proof_final;
							$datatoexcel[$cb_id]['cb_subdatetime']=$cb_subdatetime;
							$sr++;
						}
						$filename='chola_booking'.date('d').date('m').date('y').date('h').date('i').date('s').'.csv';					
						header('Content-type: text/csv');
						header("Content-Disposition: attachment; filename=$filename");
						header('Pragma: no-cache');
						header('Expires: 0');
						$file = fopen('php://output', 'w');
						fputcsv($file,array('Sr No.','Order Number','Temple Name','Booking For Date','Name','Mobile Number','Aadhaar Card','Member Name 1','Member Mobile 1','Member Aadhaar Card 1','Member Name 2','Member Mobile 2','Member Aadhaar Card 2','Member Name 3','Member Mobile 3','Member Aadhaar Card 3','Member Name 4','Member Mobile 4','Member Aadhaar Card 4','Member Name 5','Member Mobile 5','Member Aadhaar Card 5','Amount','Payment Status','Bank Ref. Number','Passport Photo','Date'));
							foreach ($datatoexcel as $datatoexcelval){
								fputcsv($file,$datatoexcelval);
							}
							exit;
								}
					}else{
						$this->session->set_flashdata('feedback',"Please select record to export 1");
						$this->session->set_flashdata('feedbackerr',"alert-danger");
						redirect("master/chola-booking/searchlist/$enc_dates");	
						}
			
			}
		$this->load->view('master/master-chola-searchlist',$arr);
		}
	}
?>