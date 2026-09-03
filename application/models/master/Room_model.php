<?php
class Room_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllRoomBooking(){
		$this->db->from('tb_roomreservation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_roomreservation.rb_regid','left');
		$this->db->order_by("rb_id","desc"); 
		$query=$this->db->get();
		return $query->result();	
	}
	
	
	public function getPerRoomBooking($rb_id){
		$this->db->from('tb_roomreservation');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_roomreservation.rb_regid','left');
		$this->db->where('rb_id',$rb_id);
		$query=$this->db->get();
		return  $query->row();	
	}
	
}
?>