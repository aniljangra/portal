<?php
class CbmasterModel extends CI_Model {
	public function __construct(){
          parent::__construct();
 	}
	
	public function getPerTemple($temple_id){
			$this->db->from('tb_temple');
			$this->db->where("temple_id",$temple_id); 
			$query=$this->db->get();
			return $query->row();	
	}
	public function count_choladate($cb_bookfordate,$temple_id){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_bookfordate",$cb_bookfordate);
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function count_inactivedate($cb_bookfordate,$temple_id){
		$this->db->from('tb_choladatesetting');
		$this->db->where("dset_templeid",$temple_id);
		$this->db->where("dset_date",$cb_bookfordate);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function count_processing($cb_bookfordate,$temple_id){
		$this->db->from('tb_cholabooking');
		$this->db->where("cb_bookfordate",$cb_bookfordate);
		$this->db->where("cb_temple",$temple_id);
		$this->db->where("cb_dateup",0);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function insertCholaBookingTemp($data){
	$cb_subdatetime=date("Y-m-d H:i:s");
    $dataInsert=array('cb_regid'=>NULL,'cb_bookfordate'=>$data['cb_bookfordate'],'cb_temple'=>$data['cb_temple'],'cb_name'=>$data['cb_name'],'cb_mobile'=>$data['cb_mobile'],'cb_aadhaar'=>$data['cb_aadhaar'],'cb_proof'=>$data['proof'],'cb_othermember'=>$data['cb_othermember'],'cb_member_name1'=>$data['cb_member_name1'],'cb_member_mobile1'=>$data['cb_member_mobile1'],'cb_member_aadhaar1'=>$data['cb_member_aadhaar1'],'cb_member_name2'=>$data['cb_member_name2'],'cb_member_mobile2'=>$data['cb_member_mobile2'],'cb_member_aadhaar2'=>$data['cb_member_aadhaar2'],'cb_member_name3'=>$data['cb_member_name3'],'cb_member_mobile3'=>$data['cb_member_mobile3'],'cb_member_aadhaar3'=>$data['cb_member_aadhaar3'],'cb_member_name4'=>$data['cb_member_name4'],'cb_member_mobile4'=>$data['cb_member_mobile4'],'cb_member_aadhaar4'=>$data['cb_member_aadhaar4'],'cb_member_name5'=>$data['cb_member_name5'],'cb_member_mobile5'=>$data['cb_member_mobile5'],'cb_member_aadhaar5'=>$data['cb_member_aadhaar5'],'cb_subdatetime'=>$cb_subdatetime);
	// print_r($dataInsert); die();
	$this->db->insert('tb_cholabooking_temp',$dataInsert);
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
	public function insertCholaBooking($data){
	$cb_subdatetime=date("Y-m-d H:i:s");
	$cb_oldsystem=0;
	$dataInsert=array('cb_orderno'=>$data['cb_orderno'],'cb_adminid'=>$data['cb_adminid'],'cb_bookfordate'=>$data['cb_bookfordate'],'cb_name'=>$data['cb_name'],'cb_mobile'=>$data['cb_mobile'],'cb_email'=>$data['cb_email'],'cb_address'=>$data['cb_address'],'cb_city'=>$data['cb_city'],'cb_paymethod'=>$data['cb_paymethod'],'cb_state'=>$data['cb_state'],'cb_pincode'=>$data['cb_pincode'],'cb_amount'=>$data['cb_amount'],'cb_subdatetime'=>$cb_subdatetime,'cb_temple'=>$data['cb_temple'],'cb_templename'=>$data['cb_templename'],'cb_aadhar'=>$data['cb_aadhar'],'cb_othermember'=>$data['cb_othermember'],'cb_devotee_name1'=>$data['cb_devotee_name1'],'cb_devotee_mobile1'=>$data['cb_devotee_mobile1'],'cb_devotee_aadhar1'=>$data['cb_devotee_aadhar1'],'cb_devotee_name2'=>$data['cb_devotee_name2'],'cb_devotee_mobile2'=>$data['cb_devotee_mobile2'],'cb_devotee_aadhar2'=>$data['cb_devotee_aadhar2'],'cb_devotee_name3'=>$data['cb_devotee_name3'],'cb_devotee_mobile3'=>$data['cb_devotee_mobile3'],'cb_devotee_aadhar3'=>$data['cb_devotee_aadhar3'],'cb_devotee_name4'=>$data['cb_devotee_name4'],'cb_devotee_mobile4'=>$data['cb_devotee_mobile4'],'cb_devotee_aadhar4'=>$data['cb_devotee_aadhar4'],'cb_devotee_name5'=>$data['cb_devotee_name5'],'cb_devotee_mobile5'=>$data['cb_devotee_mobile5'],'cb_devotee_aadhar5'=>$data['cb_devotee_aadhar5'],'cb_proof'=>$data['cb_proof'],'cb_oldsystem'=>$cb_oldsystem,'cb_ipaddress'=>$data['cb_ipaddress']);
	$this->db->insert('tb_cholabooking',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}

public function delPerTempCholaBooking($cb_id){
	$this->db->where('cb_id',$cb_id);
	$query=$this->db->delete('tb_cholabooking_temp');	
	return $query;
}
	
	public function getPerCholaBooking($cb_id){
		$this->db->where("cb_id",$cb_id) ;
		$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
 	}	
	public function getPerOrderNo($cb_orderno){
		$this->db->where("cb_orderno",$cb_orderno) ;
		
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
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
	public function upTxnByRefNo($dataup,$cb_orderno){
		$dataUpdate=array('cb_transstatus'=>$dataup['cb_transstatus'],'cb_transdate'=>$dataup['cb_transdate'],'cb_bankrefno'=>$dataup['cb_bankrefno'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_txnrefno'=>$dataup['cb_txnrefno'],'cb_up'=>$dataup['cb_up'],'cb_dateup'=>$dataup['cb_dateup'],'cb_statuscode'=>$dataup['cb_statuscode']);
		$this->db->where('cb_orderno',$cb_orderno);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	public function upPerCholaParms($datapayser,$cb_id){
		$dataUpdate=array('cb_payparam'=>$datapayser);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	
}
?>