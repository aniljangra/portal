<?php
class User_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllUser(){
			$this->db->from('tb_registration');
			$this->db->order_by("reg_id","desc"); 
			$query=$this->db->get();
			return $query->result();	
	}
	public function getPerUser($reg_id){
		$this->db->from('tb_registration');
		$this->db->where('reg_id',$reg_id);
		$query=$this->db->get();
		return  $query->row();	
	}
	/*public function delPerUser($reg_id){
		$this->db->where('reg_id',$reg_id);
		$query=$this->db->delete('tb_donation');
		return $query;
	}*/
	
	
	
}
?>