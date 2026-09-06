<?php
class Custom_model extends CI_Model {
	public function __construct(){
       parent::__construct();
 	}
	public function getPerRegistration($reg_id){
			$this->db->where('reg_id',$reg_id);
			$query=$this->db->get('tb_registration');
			return $query->row();
	}
	public function getAdminProfile($reg_id){
		$this->db->where('ad_userid',$reg_id);
		$this->db->join('tb_temple','tb_temple.temple_id=tb_masterusers.ad_temple','left');
		  $query=$this->db->get('tb_masterusers');
		  return  $query->row();
	}
	public function getTotPerDateSlotSuccess($date,$slot){
		$this->db->where('hw_bookfordate',$date);
		$this->db->where('hw_bookslot',$slot);
		$this->db->where('hw_transstatus',"SUCCESS");
		$query=$this->db->get('tb_hawanbooking');
		return $query->num_rows();
	}

	public function getTotPerDateSlotProcess($date,$slot){
		$this->db->where('hw_bookfordate',$date);
		$this->db->where('hw_bookslot',$slot);
		$this->db->where('hw_dateup',0);
		$query=$this->db->get('tb_hawanbooking');
		return $query->num_rows();
	}
/*	public function getAllSuccessRoomBooking($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->where("rb_transstatus","COMPLETED");
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
	public function getAllInProcessRoomBooking($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->where("rb_transstatus","NOTREC");
		$this->db->where("rb_updbstatus",0);
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
	*/
public function getAllSuccessRoomBooking($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->or_where("rb_bookfordate2",$rb_bookfordate);
		$this->db->where("rb_transstatus","COMPLETED");
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
	public function getAllInProcessRoomBooking($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->or_where("rb_bookfordate2",$rb_bookfordate);
		$this->db->where("rb_transstatus","NOTREC");
		$this->db->where("rb_updbstatus",0);
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
	

	

}

?>



