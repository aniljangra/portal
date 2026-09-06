<?php
class Donation_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllDonationSuccess(){
			$this->db->from('tb_donation');
			$this->db->join('tb_registration','tb_registration.reg_id=tb_donation.donation_regid','left');
			$this->db->order_by("donation_id","desc"); 
			$this->db->where('donation_transstatus ','SUCCESS');
			$query=$this->db->get();
			return $query->result();	
	}
	public function getPerDonation($donation_id){
		$this->db->from('tb_donation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_donation.donation_regid','left');
		$this->db->where('donation_id',$donation_id);
		$query=$this->db->get();
		return  $query->row();	
	}
}
?>