<?php
class Hawanweb_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 
	public function getAllHawanSlot(){
		$this->db->from("tb_hawanslot");
		$this->db->where("hs_status",1);
		$this->db->order_by("hs_order", "asc");
		$query=$this->db->get();
		return $query->result();
 	}
	public function count_hawansuccess_date($hw_bookfordate){
		$this->db->from('tb_hawanbooking');
		$this->db->where("hw_bookfordate",$hw_bookfordate);
		$this->db->where("hw_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function count_inactivedate($hw_bookfordate){
		$this->db->from('tb_datesetting');
		$this->db->where("dset_date",$hw_bookfordate);
		$this->db->where("dset_hawanbooking",1);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	public function count_hawanprocess_date($hw_bookfordate){
		$this->db->from('tb_hawanbooking');
		$this->db->where("hw_bookfordate",$hw_bookfordate);
		$this->db->where("hw_dateup",0);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function getNoHawanTimeSlotSuccess($hw_date,$hw_slot){
		$this->db->from('tb_hawanbooking');
		$this->db->where("hw_bookfordate",$hw_date);
		$this->db->where("hw_bookslot",$hw_slot);
		$this->db->where("hw_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->num_rows();
 	}
	public function getNoHawanTimeSlotProcess($hw_date,$hw_slot){
		$this->db->from('tb_hawanbooking');
		$this->db->where("hw_bookfordate",$hw_date);
		$this->db->where("hw_bookslot",$hw_slot);
		$this->db->where("hw_dateup",0);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	public function getHawanBookingByOrder($hw_orderno){
		$this->db->where("hw_orderno",$hw_orderno) ;
		$query=$this->db->get('tb_hawanbooking');
		return $query->row();
 	}
	
	public function insertHawanBookingTemp($data,$custsesid){
		$hw_subtime=date("Y-m-d H:i:s");
		$dataInsert=array('hw_regid'=>$custsesid,'hw_bookfordate'=>$data['hw_date'],'hw_timeslot'=>$data['hw_bookslot'],'hw_subtime'=>$hw_subtime);
		
		$this->db->insert('tb_hawanbook_temp',$dataInsert);
		$insert_id=$this->db->insert_id();
		return  $insert_id;			
	}
	public function getPerHawanBookingTemp($hw_id){
		$this->db->where("hw_id",$hw_id);
		$query=$this->db->get('tb_hawanbook_temp');
		return $query->row();
 	}
	public function delPerTempHawanBooking($hw_id){
		$this->db->where('hw_id',$hw_id);
		$query=$this->db->delete('tb_hawanbook_temp');	
		return $query;
	}
	
	public function insertHawanBooking($data){
		$hw_subdatetime=date("Y-m-d H:i:s");
		$dataInsert=array('hw_orderno'=>$data['hw_orderno'],'hw_regid'=>$data['hw_regid'],'hw_bookfordate'=>$data['hw_bookfordate'],'hw_bookslot'=>$data['hw_bookslot'],'hw_bookslotname'=>$data['hw_bookslotname'],'hw_name'=>$data['hw_name'],'hw_mobile'=>$data['hw_mobile'],'hw_email'=>$data['hw_email'],'hw_address'=>$data['hw_address'],'hw_city'=>$data['hw_city'],'hw_state'=>$data['hw_state'],'hw_pincode'=>$data['hw_pincode'],'hw_amount'=>$data['hw_amount'],'hw_subdatetime'=>$hw_subdatetime);
		$this->db->insert('tb_hawanbooking',$dataInsert);
		$insert_id=$this->db->insert_id();
		return  $insert_id;			
	}
	public function getPerHawanBooking($hw_id){
		$this->db->from("tb_hawanbooking");
		$this->db->where("hw_id",$hw_id);
		$this->db->join('tb_hawanslot','tb_hawanslot.hs_id=tb_hawanbooking.hw_bookslot','left');
		$query=$this->db->get();
		return $query->row();
 	}	
	
	public function getAllHawanDateBooked(){
		$this->db->where("hw_transstatus","SUCCESS") ;
		$query=$this->db->get('tb_hawanbooking');
		return $query->result();
 	}
	
	public function getAllBookProcessHawan(){
		$current_date=date("Y-m-d");
		$end_date=date('Y-m-d', strtotime('+3 month', strtotime($current_date)));
		 $this->db->select('hw_bookfordate, COUNT(hw_id) as total_slotbook');
		//$this->db->select('SUM(rb_norooms) AS roomssum, rb_bookfordate', FALSE);
		$this->db->where('hw_bookfordate >=', $current_date);
		$this->db->where('hw_bookfordate <=', $end_date);
		$this->db->where('hw_transstatus','SUCCESS');
		//$this->db->where('rb_transstatus!=','SUCCESS');
		$this->db->or_where('hw_dateup',0);
		$this->db->group_by("hw_bookfordate");
		$query=$this->db->get('tb_hawanbooking');
		return $query->result();
	}
	
	
	public function getAllProcessDateHawan(){
		$this->db->where("hw_dateup",0) ;
		$query=$this->db->get('tb_hawanbooking');
		return $query->result();
 	}	


	public function getPerTimeSlot($hs_id){
		$this->db->where("hs_id",$hs_id) ;
		$query=$this->db->get('tb_hawanslot');
		return $query->row();
 	}
	public function upHawanBookingStatus($dataup,$hw_id){
		$dataUpdate=array('hw_transstatus'=>$dataup['hw_transstatus'],'hw_statusdesc'=>$dataup['hw_statusdesc'],'hw_transdate'=>$dataup['hw_transdate'],'hw_paymode'=>$dataup['hw_paymode'],'hw_bankrefno'=>$dataup['hw_bankrefno'],'hw_statusdesc'=>$dataup['hw_statusdesc'],'hw_up'=>1,'hw_dateup'=>$dataup['hw_dateup']);
		$this->db->where('hw_id',$hw_id);
		return $this->db->update('tb_hawanbooking',$dataUpdate); 
	}
	
	public function getAllInactiveDateHawan(){
		$this->db->from('tb_datesetting');
		$this->db->where("dset_hawanbooking",1);
		$query=$this->db->get();
		return $query->result();
 	}

	
	
}
?>