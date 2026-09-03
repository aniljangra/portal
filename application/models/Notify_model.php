<?php
class Notify_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 
 	/*********** Donation ************/
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
	/*********** Chola ***************/
	public function getCholaBookingByOrder($cb_orderno){
		$this->db->where("cb_orderno",$cb_orderno) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
 	}	
	public function upCholaBookingStatus($dataup,$cb_id){
		$dataUpdate=array('cb_transstatus'=>$dataup['cb_transstatus'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_transdate'=>$dataup['cb_transdate'],'cb_paymode'=>$dataup['cb_paymode'],'cb_bankrefno'=>$dataup['cb_bankrefno'],'cb_statusdesc'=>$dataup['cb_statusdesc'],'cb_up'=>1);
		$this->db->where('cb_id',$cb_id);
		return $this->db->update('tb_cholabooking',$dataUpdate); 
	}
	/************** Hawan ***************/
	public function getHawanBookingByOrder($hw_orderno){
		$this->db->where("hw_orderno",$hw_orderno) ;
		$query=$this->db->get('tb_hawanbooking');
		return $query->row();
 	}
	public function upHawanBookingStatus($dataup,$hw_id){
		$dataUpdate=array('hw_transstatus'=>$dataup['hw_transstatus'],'hw_statusdesc'=>$dataup['hw_statusdesc'],'hw_transdate'=>$dataup['hw_transdate'],'hw_paymode'=>$dataup['hw_paymode'],'hw_bankrefno'=>$dataup['hw_bankrefno'],'hw_statusdesc'=>$dataup['hw_statusdesc'],'hw_up'=>1,'hw_dateup'=>$dataup['hw_dateup']);
		$this->db->where('hw_id',$hw_id);
		return $this->db->update('tb_hawanbooking',$dataUpdate); 
	}
	/* Room Booking ****/
	public function getRoomBookingByOrder($rb_orderno){
		$this->db->where("rb_orderno",$rb_orderno) ;
		$query=$this->db->get('tb_roomreservation');
		return $query->row();
 	}
	public function upRoomBookingStatus($dataup,$rb_id){
		$dataUpdate=array('rb_transstatus'=>$dataup['rb_transstatus'],'rb_statusdesc'=>$dataup['rb_statusdesc'],'rb_transdate'=>$dataup['rb_transdate'],'rb_paymode'=>$dataup['rb_paymode'],'rb_bankrefno'=>$dataup['rb_bankrefno'],'rb_statusdesc'=>$dataup['rb_statusdesc'],'rb_up'=>1,'rb_dateup'=>$dataup['rb_dateup']);
		$this->db->where('rb_id',$rb_id);
		return $this->db->update('tb_roomreservation',$dataUpdate); 
	}
	
}
?>