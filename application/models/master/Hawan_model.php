<?php
class Hawan_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllHawanBooking(){
		$this->db->from('tb_hawanbooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_hawanbooking.hw_regid','left');
		$this->db->order_by("hw_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	
	
	public function getPerHawanBooking($hw_id){
		$this->db->from('tb_hawanbooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_hawanbooking.hw_regid','left');
		$this->db->where('hw_id',$hw_id);
		$query=$this->db->get();
		return  $query->row();	
	}
	
}
?>