<?php
class Cholaweb_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 

public function insertCholaBookingTemp($data,$cb_regid){
	$cb_subdatetime=date("Y-m-d H:i:s");
    $dataInsert=array('cb_regid'=>$cb_regid,'cb_bookfordate'=>$data['cb_bookfordate'],'cb_temple'=>$data['cb_temple'],'cb_name'=>$data['cb_name'],'cb_mobile'=>$data['cb_mobile'],'cb_aadhaar'=>$data['cb_aadhaar'],'cb_proof'=>$data['proof'],'cb_othermember'=>$data['cb_othermember'],'cb_member_name1'=>$data['cb_member_name1'],'cb_member_mobile1'=>$data['cb_member_mobile1'],'cb_member_aadhaar1'=>$data['cb_member_aadhaar1'],'cb_member_name2'=>$data['cb_member_name2'],'cb_member_mobile2'=>$data['cb_member_mobile2'],'cb_member_aadhaar2'=>$data['cb_member_aadhaar2'],'cb_member_name3'=>$data['cb_member_name3'],'cb_member_mobile3'=>$data['cb_member_mobile3'],'cb_member_aadhaar3'=>$data['cb_member_aadhaar3'],'cb_member_name4'=>$data['cb_member_name4'],'cb_member_mobile4'=>$data['cb_member_mobile4'],'cb_member_aadhaar4'=>$data['cb_member_aadhaar4'],'cb_member_name5'=>$data['cb_member_name5'],'cb_member_mobile5'=>$data['cb_member_mobile5'],'cb_member_aadhaar5'=>$data['cb_member_aadhaar5'],'cb_subdatetime'=>$cb_subdatetime,'cb_chola_otp'=>$data['cb_chola_otp'],'cb_chola_otpexpiry'=>$data['cb_chola_otpexpiry'],'cb_ipaddress'=>$data['cb_ipaddress']);
	// print_r($dataInsert); die();
	$this->db->insert('tb_cholabooking_temp',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}

// 

public function insertCholaBooking($data){
	$cb_ipdate=date("Y-m-d");
	$cb_subdatetime=date("Y-m-d H:i:s");
	$cb_oldsystem=0;
	$dataInsert=array('cb_orderno'=>$data['cb_orderno'],'cb_regid'=>$data['cb_regid'],'cb_bookfordate'=>$data['cb_bookfordate'],'cb_name'=>$data['cb_name'],'cb_mobile'=>$data['cb_mobile'],'cb_email'=>$data['cb_email'],'cb_address'=>$data['cb_address'],'cb_city'=>$data['cb_city'],'cb_paymethod'=>$data['cb_paymethod'],'cb_state'=>$data['cb_state'],'cb_pincode'=>$data['cb_pincode'],'cb_amount'=>$data['cb_amount'],'cb_subdatetime'=>$cb_subdatetime,'cb_temple'=>$data['cb_temple'],'cb_templename'=>$data['cb_templename'],'cb_aadhar'=>$data['cb_aadhar'],'cb_othermember'=>$data['cb_othermember'],'cb_devotee_name1'=>$data['cb_devotee_name1'],'cb_devotee_mobile1'=>$data['cb_devotee_mobile1'],'cb_devotee_aadhar1'=>$data['cb_devotee_aadhar1'],'cb_devotee_name2'=>$data['cb_devotee_name2'],'cb_devotee_mobile2'=>$data['cb_devotee_mobile2'],'cb_devotee_aadhar2'=>$data['cb_devotee_aadhar2'],'cb_devotee_name3'=>$data['cb_devotee_name3'],'cb_devotee_mobile3'=>$data['cb_devotee_mobile3'],'cb_devotee_aadhar3'=>$data['cb_devotee_aadhar3'],'cb_devotee_name4'=>$data['cb_devotee_name4'],'cb_devotee_mobile4'=>$data['cb_devotee_mobile4'],'cb_devotee_aadhar4'=>$data['cb_devotee_aadhar4'],'cb_devotee_name5'=>$data['cb_devotee_name5'],'cb_devotee_mobile5'=>$data['cb_devotee_mobile5'],'cb_devotee_aadhar5'=>$data['cb_devotee_aadhar5'],'cb_proof'=>$data['cb_proof'],'cb_oldsystem'=>$cb_oldsystem,'cb_ipdate'=>$cb_ipdate,'cb_ipaddress'=>$data['cb_ipaddress']);
	$this->db->insert('tb_cholabooking',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}

	public function getPerCholaBookingTemp($cb_id){
		$this->db->where("cb_id",$cb_id) ;
		$this->db->from('tb_cholabooking_temp');
		$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking_temp.cb_temple','left');
		$query=$this->db->get();
		return $query->row();
 	}
	/**************** OTP Code *********************************/
	public function getPerOtp($cb_id,$cb_chola_otp){
		$this->db->where("cb_id",$cb_id);
		$this->db->where("cb_chola_otp",$cb_chola_otp);
		$query=$this->db->get('tb_cholabooking_temp');
		return $query->row();
 	}
	 public function updateOtpResend($dataup,$cb_id){
		$dataUpdate=array('cb_chola_otp'=>$dataup['cb_chola_otp'],'cb_chola_otpexpiry'=>$dataup['cb_chola_otpexpiry']);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking_temp',$dataUpdate); 
	}
	 public function upOtpVerSuccess($cb_id){
		$cb_chola_otp="";
		$cb_chola_otpexpiry=NULL;
		$cb_chola_otpverification=1;
		$dataUpdate=array('cb_chola_otp'=>$cb_chola_otp,'cb_chola_otpexpiry'=>$cb_chola_otpexpiry,'cb_chola_otpverification'=>$cb_chola_otpverification);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking_temp',$dataUpdate); 
	}
	
	/**************** OTP Code *********************************/
	/******** Temple *********/
	public function getAllTemple(){
		$this->db->where("temple_status",1) ;
		$query=$this->db->get('tb_temple');
		return $query->result();
 	}
	
	 public function getPerTemple($temple_id){
		$this->db->where("temple_id",$temple_id) ;
		$query=$this->db->get('tb_temple');
		return $query->row();
 	}
	/********Temple ***********/
	public function getPerCholaBooking($cb_id){
		$this->db->where("cb_id",$cb_id) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
 	}	
	public function getAllCholaDateBooked($temple_id){
	    $this->db->group_start();
		$this->db->where("cb_temple",$temple_id) ;
		$this->db->group_end();
		   $this->db->group_start();
		$this->db->where("cb_transstatus","SUCCESS");
	$this->db->or_where("cb_transstatus","success");
		$this->db->group_end();
		$query=$this->db->get('tb_cholabooking');
		return $query->result();
 	}
	/*public function getAllProcessDateChola($temple_id){
		$this->db->where("cb_dateup",0) ;
		$this->db->where("cb_temple",$temple_id) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->result();
 	}		
*/

public function getAllProcessDateChola($temple_id){
		$this->db->where("cb_up",0) ;
		$this->db->where("cb_temple",$temple_id) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->result();
 	}


	 public function checkBookingFordate($temple_id,$bookfordate){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_bookfordate",$bookfordate);
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_up",$temple_id);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	
	 public function checknumber_row($cb_number){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_mobile",$cb_number);
// 		$this->db->or_where("cb_devotee_mobile2",$cb_number);
// 		$this->db->or_where("cb_devotee_mobile3",$cb_number);
// 		$this->db->or_where("cb_devotee_mobile4",$cb_number);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	public function checkdatenum($cb_number){
	    
		$table=$this->db->from('tb_cholabooking');
		$query=$table->where("cb_mobile",$cb_number);
// 		$query=$table->where("cb_bookfordate",$month[0]);
// 		$this->db->where_in('username', $names);
        $query=$table->get();
		return $query->num_rows();
 	}
	public function count_choladate($cb_bookfordate,$temple_id){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_bookfordate",$cb_bookfordate);
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function count_processing($cb_bookfordate,$temple_id){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_bookfordate",$cb_bookfordate);
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_up",0);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	/* public function updatetempchbook($cb_regid,$dataup){
		
		$dataUpdate=array('cb_chola_price'=>$dataup['cholaprice'],'cb_chola_from_board'=>$dataup['cb_chola_from_board']);
		$this->db->where('cb_id',$cb_regid);
		return $this->db->update('tb_cholabooking_temp',$dataUpdate); 
	}*/
	
	
	public function upTxnByRefNo($dataup,$cb_orderno){
		$dataUpdate=array('cb_transstatus'=>$dataup['cb_transstatus'],'cb_transdate'=>$dataup['cb_transdate'],'cb_bankrefno'=>$dataup['cb_bankrefno'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_txnrefno'=>$dataup['cb_txnrefno'],'cb_up'=>$dataup['cb_up'],'cb_dateup'=>$dataup['cb_dateup'],'cb_statuscode'=>$dataup['cb_statuscode']);
		$this->db->where('cb_orderno',$cb_orderno);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	public function getCholaBookingByOrder($cb_orderno){
		$this->db->where("cb_orderno",$cb_orderno) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
 	}	
	public function upCholaBookingStatus($dataup,$cb_id){
		$dataUpdate=array('cb_transstatus'=>$dataup['cb_transstatus'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_transdate'=>$dataup['cb_transdate'],'cb_paymode'=>$dataup['cb_paymode'],'cb_bankrefno'=>$dataup['cb_bankrefno'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_up'=>1,'cb_dateup'=>$dataup['cb_dateup']);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	public function delPerTempCholaBooking($cb_id){
		$this->db->where('cb_id',$cb_id);
		$query=$this->db->delete('tb_cholabooking_temp');	
		return $query;
	}
	
	
	/************* Inactivate Date Setting */
	public function count_inactivedate($cb_bookfordate,$temple_id){
		$this->db->from('tb_choladatesetting');
		$this->db->where("dset_templeid",$temple_id);
		$this->db->where("dset_date",$cb_bookfordate);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function getAllInactiveDateChola($temple_id){
		$current_date=date("Y-m-d");
		$this->db->from('tb_choladatesetting');
		$this->db->where("dset_templeid",$temple_id);
		//$this->db->where("dset_date >=",$current_date);
		$query=$this->db->get();
		return $query->result();
 	}
	/***** Check For Mobile Six Month*****/
	public function chkforcholamob($cb_mobile,$temple_id){
		//$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_cholabooking');
			$this->db->order_by("cb_id", "DESC");
		$this->db->where("cb_temple",$temple_id);
		$this->db->group_start();
		$this->db->where("cb_mobile",$cb_mobile);
		$this->db->or_where("cb_devotee_mobile1",$cb_mobile);
		$this->db->or_where("cb_devotee_mobile2",$cb_mobile);
		$this->db->or_where("cb_devotee_mobile3",$cb_mobile);
		$this->db->or_where("cb_devotee_mobile4",$cb_mobile);
		$this->db->or_where("cb_devotee_mobile5",$cb_mobile);
		$this->db->group_end();
		//$this->db->group_start();
		//$this->db->where("cb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("cb_transstatus",'SUCCESS');
		$this->db->group_end();
	
		$query=$this->db->get();
		return $query->row();
 	}
	/******* Check For Main Account for six month *****/
	public function chkforcholatemple($cb_temple,$custsesid){
	    //echo $custsesid;
	  //  echo "<br/>";
		//$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_temple",$cb_temple);
		$this->db->group_start();
		$this->db->where("cb_regid",$custsesid);
		$this->db->group_end();
	//	$this->db->group_start();
		//$this->db->where("cb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("cb_transstatus",'SUCCESS');
		$this->db->group_end();
		$this->db->order_by("cb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	/********** Aadhar Card Check ********/
	public function chkforcholaaadhaar($cb_aadhaar,$temple_id){
	//	$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_temple",$temple_id);
		$this->db->group_start();
		$this->db->where("cb_aadhar",$cb_aadhaar);
		$this->db->or_where("cb_devotee_aadhar1",$cb_aadhaar);
		$this->db->or_where("cb_devotee_aadhar2",$cb_aadhaar);
		$this->db->or_where("cb_devotee_aadhar3",$cb_aadhaar);
		$this->db->or_where("cb_devotee_aadhar4",$cb_aadhaar);
		$this->db->or_where("cb_devotee_aadhar5",$cb_aadhaar);
		$this->db->group_end();
	//	$this->db->group_start();
		//$this->db->where("cb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("cb_transstatus",'SUCCESS');
		$this->db->group_end();
		$this->db->order_by("cb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function getLastBookFromThisIp($temple_id,$ip){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_ipaddress",$ip);
		$this->db->where("cb_transstatus",'SUCCESS');
		$this->db->order_by("cb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function getLastBookFromThisAccount($temple_id,$cb_regid){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_regid",$cb_regid);
		$this->db->where("cb_transstatus",'SUCCESS');
		$this->db->order_by("cb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function upPerCholaParms($datapayser,$cb_id){
		$dataUpdate=array('cb_payparam'=>$datapayser);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	public function getAllPendingTxn(){
	
		$this->db->where("cb_paymethod",3);
		$this->db->where("cb_up",0);
		$current_time=date('Y-m-d H:i:s');
    	$time_limit=date('Y-m-d H:i:s', strtotime('-20 minutes', strtotime($current_time)));
        $this->db->where('cb_subdatetime <=', $time_limit);
        //$this->db->where("cb_statuscode !=",0300);
		$this->db->order_by("cb_id", "DESC");
	//	$this->db->order_by("cb_paymethod", "DESC");
		$query=$this->db->get('tb_cholabooking');
		return $query->result();
 	}		
	
}
?>