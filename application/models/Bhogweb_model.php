<?php
class Bhogweb_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 

public function insertBhogBookingTemp($data,$bb_regid){
	$bb_subdatetime=date("Y-m-d H:i:s");
    $dataInsert=array('bb_regid'=>$bb_regid,'bb_bookfordate'=>$data['bb_bookfordate'],'bb_temple'=>$data['bb_temple'],'bb_name'=>$data['bb_name'],'bb_mobile'=>$data['bb_mobile'],'bb_aadhaar'=>$data['bb_aadhaar'],'bb_proof'=>$data['proof'],'bb_othermember'=>$data['bb_othermember'],'bb_member_name1'=>$data['bb_member_name1'],'bb_member_mobile1'=>$data['bb_member_mobile1'],'bb_member_aadhaar1'=>$data['bb_member_aadhaar1'],'bb_member_name2'=>$data['bb_member_name2'],'bb_member_mobile2'=>$data['bb_member_mobile2'],'bb_member_aadhaar2'=>$data['bb_member_aadhaar2'],'bb_member_name3'=>$data['bb_member_name3'],'bb_member_mobile3'=>$data['bb_member_mobile3'],'bb_member_aadhaar3'=>$data['bb_member_aadhaar3'],'bb_member_name4'=>$data['bb_member_name4'],'bb_member_mobile4'=>$data['bb_member_mobile4'],'bb_member_aadhaar4'=>$data['bb_member_aadhaar4'],'bb_member_name5'=>$data['bb_member_name5'],'bb_member_mobile5'=>$data['bb_member_mobile5'],'bb_member_aadhaar5'=>$data['bb_member_aadhaar5'],'bb_subdatetime'=>$bb_subdatetime,'bb_bhog_otp'=>$data['bb_bhog_otp'],'bb_bhog_otpexpiry'=>$data['bb_bhog_otpexpiry'],'bb_ipaddress'=>$data['bb_ipaddress']);
	// print_r($dataInsert); die();
	$this->db->insert('tb_bhogbooking_temp',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}

// 

public function insertBhogBooking($data){
	$bb_ipdate=date("Y-m-d");
	$bb_subdatetime=date("Y-m-d H:i:s");
	$bb_oldsystem=0;
	$dataInsert=array('bb_orderno'=>$data['bb_orderno'],'bb_regid'=>$data['bb_regid'],'bb_bookfordate'=>$data['bb_bookfordate'],'bb_name'=>$data['bb_name'],'bb_mobile'=>$data['bb_mobile'],'bb_email'=>$data['bb_email'],'bb_address'=>$data['bb_address'],'bb_city'=>$data['bb_city'],'bb_paymethod'=>$data['bb_paymethod'],'bb_state'=>$data['bb_state'],'bb_pincode'=>$data['bb_pincode'],'bb_amount'=>$data['bb_amount'],'bb_subdatetime'=>$bb_subdatetime,'bb_temple'=>$data['bb_temple'],'bb_templename'=>$data['bb_templename'],'bb_aadhar'=>$data['bb_aadhar'],'bb_othermember'=>$data['bb_othermember'],'bb_devotee_name1'=>$data['bb_devotee_name1'],'bb_devotee_mobile1'=>$data['bb_devotee_mobile1'],'bb_devotee_aadhar1'=>$data['bb_devotee_aadhar1'],'bb_devotee_name2'=>$data['bb_devotee_name2'],'bb_devotee_mobile2'=>$data['bb_devotee_mobile2'],'bb_devotee_aadhar2'=>$data['bb_devotee_aadhar2'],'bb_devotee_name3'=>$data['bb_devotee_name3'],'bb_devotee_mobile3'=>$data['bb_devotee_mobile3'],'bb_devotee_aadhar3'=>$data['bb_devotee_aadhar3'],'bb_devotee_name4'=>$data['bb_devotee_name4'],'bb_devotee_mobile4'=>$data['bb_devotee_mobile4'],'bb_devotee_aadhar4'=>$data['bb_devotee_aadhar4'],'bb_devotee_name5'=>$data['bb_devotee_name5'],'bb_devotee_mobile5'=>$data['bb_devotee_mobile5'],'bb_devotee_aadhar5'=>$data['bb_devotee_aadhar5'],'bb_proof'=>$data['bb_proof'],'bb_oldsystem'=>$bb_oldsystem,'bb_ipdate'=>$bb_ipdate,'bb_ipaddress'=>$data['bb_ipaddress']);
	$this->db->insert('tb_bhogbooking',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}

	public function getPerBhogBookingTemp($bb_id){
		$this->db->where("bb_id",$bb_id) ;
		$this->db->from('tb_bhogbooking_temp');
		$this->db->join('tb_temple','tb_temple.temple_id=tb_bhogbooking_temp.bb_temple','left');
		$query=$this->db->get();
		return $query->row();
 	}
	/**************** OTP Code *********************************/
	public function getPerOtp($bb_id,$bb_bhog_otp){
		$this->db->where("bb_id",$bb_id);
		$this->db->where("bb_bhog_otp",$bb_bhog_otp);
		$query=$this->db->get('tb_bhogbooking_temp');
		return $query->row();
 	}
	 public function updateOtpResend($dataup,$bb_id){
		$dataUpdate=array('bb_bhog_otp'=>$dataup['bb_bhog_otp'],'bb_bhog_otpexpiry'=>$dataup['bb_bhog_otpexpiry']);
		$this->db->where('bb_id',$bb_id);
		return $this->db->update('tb_bhogbooking_temp',$dataUpdate); 
	}
	 public function upOtpVerSuccess($bb_id){
		$bb_bhog_otp="";
		$bb_bhog_otpexpiry=NULL;
		$bb_bhog_otpverification=1;
		$dataUpdate=array('bb_bhog_otp'=>$bb_bhog_otp,'bb_bhog_otpexpiry'=>$bb_bhog_otpexpiry,'bb_bhog_otpverification'=>$bb_bhog_otpverification);
		$this->db->where('bb_id',$bb_id);
		return $this->db->update('tb_bhogbooking_temp',$dataUpdate); 
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
	public function getPerBhogBooking($bb_id){
		$this->db->where("bb_id",$bb_id) ;
		$query=$this->db->get('tb_bhogbooking');
		return $query->row();
 	}	
	public function getAllBhogDateBooked($temple_id){
	    $this->db->group_start();
		$this->db->where("bb_temple",$temple_id) ;
		$this->db->group_end();
		   $this->db->group_start();
		$this->db->where("bb_transstatus","SUCCESS");
	$this->db->or_where("bb_transstatus","success");
		$this->db->group_end();
		$query=$this->db->get('tb_bhogbooking');
		return $query->result();
 	}
	/*public function getAllProcessDateBhog($temple_id){
		$this->db->where("bb_dateup",0) ;
		$this->db->where("bb_temple",$temple_id) ;
		$query=$this->db->get('tb_bhogbooking');
		return $query->result();
 	}		
*/

public function getAllProcessDateBhog($temple_id){
		$this->db->where("bb_up",0) ;
		$this->db->where("bb_temple",$temple_id) ;
		$query=$this->db->get('tb_bhogbooking');
		return $query->result();
 	}


	 public function checkBookingFordate($temple_id,$bookfordate){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_bookfordate",$bookfordate);
		$this->db->where("bb_temple",$temple_id);
		$this->db->where("bb_up",$temple_id);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	
	 public function checknumber_row($bb_number){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_mobile",$bb_number);
// 		$this->db->or_where("bb_devotee_mobile2",$bb_number);
// 		$this->db->or_where("bb_devotee_mobile3",$bb_number);
// 		$this->db->or_where("bb_devotee_mobile4",$bb_number);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	public function checkdatenum($bb_number){
	    
		$table=$this->db->from('tb_bhogbooking');
		$query=$table->where("bb_mobile",$bb_number);
// 		$query=$table->where("bb_bookfordate",$month[0]);
// 		$this->db->where_in('username', $names);
        $query=$table->get();
		return $query->num_rows();
 	}
	public function count_bhogdate($bb_bookfordate,$temple_id){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_bookfordate",$bb_bookfordate);
		$this->db->where("bb_temple",$temple_id);
		$this->db->where("bb_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function count_processing($bb_bookfordate,$temple_id){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_bookfordate",$bb_bookfordate);
		$this->db->where("bb_temple",$temple_id);
		$this->db->where("bb_up",0);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	/* public function updatetempchbook($bb_regid,$dataup){
		
		$dataUpdate=array('bb_bhog_price'=>$dataup['bhogprice'],'bb_bhog_from_board'=>$dataup['bb_bhog_from_board']);
		$this->db->where('bb_id',$bb_regid);
		return $this->db->update('tb_bhogbooking_temp',$dataUpdate); 
	}*/
	
	
	public function upTxnByRefNo($dataup,$bb_orderno){
		$dataUpdate=array('bb_transstatus'=>$dataup['bb_transstatus'],'bb_transdate'=>$dataup['bb_transdate'],'bb_bankrefno'=>$dataup['bb_bankrefno'],'bb_statusdesc'=>$dataup['bb_statusdesc'],'bb_txnrefno'=>$dataup['bb_txnrefno'],'bb_up'=>$dataup['bb_up'],'bb_dateup'=>$dataup['bb_dateup'],'bb_statuscode'=>$dataup['bb_statuscode']);
		$this->db->where('bb_orderno',$bb_orderno);
		return $this->db->update('tb_bhogbooking',$dataUpdate); 
	}
	public function getBhogBookingByOrder($bb_orderno){
		$this->db->where("bb_orderno",$bb_orderno) ;
		$query=$this->db->get('tb_bhogbooking');
		return $query->row();
 	}	
	public function upBhogBookingStatus($dataup,$bb_id){
		$dataUpdate=array('bb_transstatus'=>$dataup['bb_transstatus'],'bb_statusdesc'=>$dataup['bb_statusdesc'],'bb_transdate'=>$dataup['bb_transdate'],'bb_paymode'=>$dataup['bb_paymode'],'bb_bankrefno'=>$dataup['bb_bankrefno'],'bb_statusdesc'=>$dataup['bb_statusdesc'],'bb_up'=>1,'bb_dateup'=>$dataup['bb_dateup']);
		$this->db->where('bb_id',$bb_id);
		return $this->db->update('tb_bhogbooking',$dataUpdate); 
	}
	public function delPerTempBhogBooking($bb_id){
		$this->db->where('bb_id',$bb_id);
		$query=$this->db->delete('tb_bhogbooking_temp');	
		return $query;
	}
	
	
	/************* Inactivate Date Setting */
	public function count_inactivedate($bb_bookfordate,$temple_id){
		$this->db->from('tb_bhogdatesetting');
		$this->db->where("dset_templeid",$temple_id);
		$this->db->where("dset_date",$bb_bookfordate);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function getAllInactiveDateBhog($temple_id){
		$current_date=date("Y-m-d");
		$this->db->from('tb_bhogdatesetting');
		$this->db->where("dset_templeid",$temple_id);
		//$this->db->where("dset_date >=",$current_date);
		$query=$this->db->get();
		return $query->result();
 	}
	/***** Check For Mobile Six Month*****/
	public function chkforbhogmob($bb_mobile,$temple_id){
		//$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_bhogbooking');
			$this->db->order_by("bb_id", "DESC");
		$this->db->where("bb_temple",$temple_id);
		$this->db->group_start();
		$this->db->where("bb_mobile",$bb_mobile);
		$this->db->or_where("bb_devotee_mobile1",$bb_mobile);
		$this->db->or_where("bb_devotee_mobile2",$bb_mobile);
		$this->db->or_where("bb_devotee_mobile3",$bb_mobile);
		$this->db->or_where("bb_devotee_mobile4",$bb_mobile);
		$this->db->or_where("bb_devotee_mobile5",$bb_mobile);
		$this->db->group_end();
		//$this->db->group_start();
		//$this->db->where("bb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("bb_transstatus",'SUCCESS');
		$this->db->group_end();
	
		$query=$this->db->get();
		return $query->row();
 	}
	/******* Check For Main Account for six month *****/
	public function chkforbhogtemple($bb_temple,$custsesid){
	    //echo $custsesid;
	  //  echo "<br/>";
		//$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_temple",$bb_temple);
		$this->db->group_start();
		$this->db->where("bb_regid",$custsesid);
		$this->db->group_end();
	//	$this->db->group_start();
		//$this->db->where("bb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("bb_transstatus",'SUCCESS');
		$this->db->group_end();
		$this->db->order_by("bb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	/********** Aadhar Card Check ********/
	public function chkforbhogaadhaar($bb_aadhaar,$temple_id){
	//	$current_date=date("Y-m-d");
		//$previous_date=date('Y-m-d', strtotime($current_date. ' + 180 days'));
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_temple",$temple_id);
		$this->db->group_start();
		$this->db->where("bb_aadhar",$bb_aadhaar);
		$this->db->or_where("bb_devotee_aadhar1",$bb_aadhaar);
		$this->db->or_where("bb_devotee_aadhar2",$bb_aadhaar);
		$this->db->or_where("bb_devotee_aadhar3",$bb_aadhaar);
		$this->db->or_where("bb_devotee_aadhar4",$bb_aadhaar);
		$this->db->or_where("bb_devotee_aadhar5",$bb_aadhaar);
		$this->db->group_end();
	//	$this->db->group_start();
		//$this->db->where("bb_subdatetime >=",$previous_date);
	//	$this->db->group_end();
		$this->db->group_start();
		$this->db->where("bb_transstatus",'SUCCESS');
		$this->db->group_end();
		$this->db->order_by("bb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function getLastBookFromThisIp($temple_id,$ip){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_temple",$temple_id);
		$this->db->where("bb_ipaddress",$ip);
		$this->db->where("bb_transstatus",'SUCCESS');
		$this->db->order_by("bb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function getLastBookFromThisAccount($temple_id,$bb_regid){
		$this->db->from('tb_bhogbooking');
		$this->db->where("bb_temple",$temple_id);
		$this->db->where("bb_regid",$bb_regid);
		$this->db->where("bb_transstatus",'SUCCESS');
		$this->db->order_by("bb_id", "DESC");
		$query=$this->db->get();
		return $query->row();
 	}
	public function upPerBhogParms($datapayser,$bb_id){
		$dataUpdate=array('bb_payparam'=>$datapayser);
		$this->db->where('bb_id',$bb_id);
		return $this->db->update('tb_bhogbooking',$dataUpdate); 
	}
	public function getAllPendingTxn(){
	
		$this->db->where("bb_paymethod",3);
		$this->db->where("bb_up",0);
		$current_time=date('Y-m-d H:i:s');
    	$time_limit=date('Y-m-d H:i:s', strtotime('-20 minutes', strtotime($current_time)));
        $this->db->where('bb_subdatetime <=', $time_limit);
        //$this->db->where("bb_statuscode !=",0300);
		$this->db->order_by("bb_id", "DESC");
	//	$this->db->order_by("bb_paymethod", "DESC");
		$query=$this->db->get('tb_bhogbooking');
		return $query->result();
 	}		
	
}
?>