<?php
class Donationweb_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 

public function insertDonation($data){
	$donation_date=date("Y-m-d H:i:s");
	$dataInsert=array('donation_orderno'=>$data['donation_orderno'],'donation_regid'=>$data['donation_regid'],'donation_name'=>$data['donation_name'],'donation_mobile'=>$data['donation_mobile'],'donation_email'=>$data['donation_email'],'donation_address'=>$data['donation_address'],'donation_city'=>$data['donation_city'],'donation_state'=>$data['donation_state'],'donation_paymethod'=>$data['donation_paymethod'],'donation_pincode'=>$data['donation_pincode'],'donation_amount'=>$data['donation_amount'],'donation_date'=>$donation_date);
	$this->db->insert('tb_donation',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}
public function getAllPendingTxn(){
		$this->db->where("donation_up",0);
		$this->db->where("donation_paymethod",3);
	//	$this->db->where("donation_transstatus","");
		$this->db->order_by("donation_id", "DESC");
		//$this->db->where("donation_date","");
		$query=$this->db->get('tb_donation');
		return $query->result();
 	}	


public function upPerDonationParms($dataser,$donation_id){
		$dataUpdate=array('donation_payparam'=>$dataser);
		$this->db->where('donation_id',$donation_id);
		return $this->db->update('tb_donation',$dataUpdate); 
	}
 /********************** Donation ******************/
 public function insertDonationTemp($data){
	$dotemp_date=date("Y-m-d");
	$reg_password=md5($data['reg_password']);
	$dataInsert=array('dotemp_name'=>$data['donation_name'],'dotemp_amount'=>$data['donation_amount'],'dotemp_date'=>$dotemp_date);
	$this->db->insert('tb_donation_temp',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;		
	}
	public function getPerDonTempData($dotemp_id){
		$this->db->where("dotemp_id",$dotemp_id) ;
		$query=$this->db->get('tb_donation_temp');
		return $query->row();
 	}	
	public function getDonationByOrder($donation_orderno){
		$this->db->where("donation_orderno",$donation_orderno) ;
		$query=$this->db->get('tb_donation');
		return $query->row();
 	}	
	public function upDonationStatus($dataup,$donation_id){
		$dataUpdate=array('donation_transstatus'=>$dataup['donation_transstatus'],'donation_paymode'=>$dataup['donation_paymode'],'donation_transdate'=>$dataup['donation_transdate'],'donation_bankrefno'=>$dataup['donation_bankrefno'],'donation_statusdesc'=>$dataup['donation_statusdesc'],'donation_up'=>1);
		$this->db->where('donation_id',$donation_id);
		return $this->db->update('tb_donation',$dataUpdate); 
	}
	public function getPerDonation($donation_id){
		$this->db->where("donation_id",$donation_id) ;
		$query=$this->db->get('tb_donation');
		return $query->row();
 	}	
	/* Txn Data */
	public function getTxnByRefNo($donation_orderno){
		$this->db->where("donation_orderno",$donation_orderno) ;
		$query=$this->db->get('tb_donation');
		return $query->row();
 	}	
	public function upTxnByRefNo($dataup,$donation_orderno){
		$dataUpdate=array('donation_transstatus'=>$dataup['donation_transstatus'],'donation_transdate'=>$dataup['donation_transdate'],'donation_bankrefno'=>$dataup['donation_bankrefno'],'donation_txnrefno'=>$dataup['donation_txnrefno'],'donation_statusdesc'=>$dataup['donation_statusdesc'],'donation_up'=>$dataup['donation_up']);
		
		
		
		$this->db->where('donation_orderno',$donation_orderno);
		return $this->db->update('tb_donation',$dataUpdate); 
	}
}
?>