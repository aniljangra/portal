<?php
class Transaction_model extends CI_Model {
	 public function __construct(){
		parent::__construct(); 
	 } 
	 public function getAllDonations($donation_regid){
		$this->db->from('tb_donation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_donation.donation_regid','left');
		$this->db->where("donation_regid",$donation_regid); 
		$this->db->order_by("donation_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	public function getPerDonation($donation_id){
		$this->db->from('tb_donation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_donation.donation_regid','left');
		$this->db->where("donation_id",$donation_id); 
		$query=$this->db->get();
		return $query->row();	
	}
	public function getAllCholaBookings($cb_regid){
		$this->db->from('tb_cholabooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
		$this->db->where("cb_regid",$cb_regid); 
		$this->db->order_by("cb_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	public function getPerCholaBooking($cb_id){
		$this->db->from('tb_cholabooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
		$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
		$this->db->where("cb_id",$cb_id); 
		$query=$this->db->get();
		return $query->row();	
	}
	public function getAllRoomBookings($rb_regid){
		$this->db->from('tb_roomreservation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_roomreservation.rb_regid','left');
		$this->db->where("rb_regid",$rb_regid); 
		$this->db->order_by("rb_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	public function getPerRoomBooking($rb_id){
		$this->db->from('tb_roomreservation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_roomreservation.rb_regid','left');
		$this->db->where("rb_id",$rb_id); 
		$query=$this->db->get();
		return $query->row();	
	}
	
	
	public function getAllHawanBookings($hw_regid){
		$this->db->from('tb_hawanbooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_hawanbooking.hw_regid','left');
		$this->db->where("hw_regid",$hw_regid); 
		$this->db->order_by("hw_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	
	public function getPerHawanBooking($hw_id){
		$this->db->from('tb_hawanbooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_hawanbooking.hw_regid','left');
		$this->db->where("hw_id",$hw_id); 
		$query=$this->db->get();
		return $query->row();	
	}
	
}
?>