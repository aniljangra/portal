<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_Cron extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent','CryptAES'));
		$this->load->model('Webcron_model','webcronmod');
		$this->load->database();

	}
	
	public function manage_chola_paymenthold(){
		//webcronmod
		
		$this->load->library('email');
			/* Send Email to Admin Email */
				$this->email->from('info@mansadevi.org.in', 'Cron Job');
				$this->email->to('inkbidhi@gmail.com');
				$this->email->bcc('bidhi.saklani@gmail.com');
				$this->email->set_mailtype("html");
				$this->email->subject("Cron Job Mata Mansa devi Ji");
				$this->email->message("Test Message");
				$this->email->send();
				echo "yes";
				exit;
		
	}	
}
?>