<?php
class Roomres_model extends CI_Model {
	 public function __construct(){
		parent::__construct(); 
	 } 
	 
	public function getAllRoomType(){
		$this->db->from('tb_roomtype');
		$this->db->where("roomt_status",1);
		$query=$this->db->get();
		return $query->result();
 	}
	public function getPerRoomType($roomt_id){
		$this->db->from('tb_roomtype');
		$this->db->where("roomt_id",$roomt_id);
		$query=$this->db->get();
		return $query->row();
 	}
	
 	public function getAllInactiveDateRoom(){
		$this->db->from('tb_datesetting');
		$this->db->where("dset_roombooking",1);
		$query=$this->db->get();
		return $query->result();
 	}
	public function check_inactiveDate($rb_bookfordate){
		$this->db->from('tb_datesetting');
		$this->db->where("dset_date",$rb_bookfordate);
		$this->db->where("dset_roombooking",1);
		$query=$this->db->get();
		return $query->num_rows();
 	}
	
	
	
	public function getAllProcessDateRoom(){
		$current_date=date("Y-m-d");
		$end_date=date('Y-m-d', strtotime('+3 month', strtotime($current_date)));
		$this->db->select('SUM(rb_norooms) AS roomssum, rb_bookfordate', FALSE);
		$this->db->where('rb_bookfordate >=', $current_date);
		$this->db->where('rb_bookfordate <=', $end_date);
		$this->db->where('rb_transstatus','SUCCESS');
		//$this->db->where('rb_transstatus!=','SUCCESS');
		$this->db->or_where('rb_dateup',0);
		$this->db->group_by("rb_bookfordate");
		$query=$this->db->get('tb_roomreservation');
		return $query->result();

		
 	}
	
	
 	public function total_rbsuccess($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->where("rb_transstatus","SUCCESS");
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
	public function total_rbprocess($rb_bookfordate){
		$this->db->select_sum('rb_norooms');
		$this->db->from('tb_roomreservation');
		$this->db->where("rb_bookfordate",$rb_bookfordate);
		$this->db->where("rb_dateup",0);
		$query=$this->db->get();
		return $query->row()->rb_norooms;
 	}
 	public function insertRoomBookingTemp($data,$custsesid){
		$rb_subdatetime=date("Y-m-d H:i:s");
		$dataInsert=array('rb_regid'=>$custsesid,'rb_name'=>$data['rb_name'],'rb_date'=>$data['rb_date'],'rb_norooms'=>$data['rb_norooms'],'rb_idtype'=>$data['rb_idtype'],'rb_idproofno'=>$data['rb_idproofno'],'rb_subdatetime'=>$rb_subdatetime);
		$this->db->insert('tb_temp_roomreservation',$dataInsert);
		$insert_id=$this->db->insert_id();
		return  $insert_id;			
	}
	public function getPerTempBooking($rb_id){
		$this->db->where("rb_id",$rb_id) ;
		$query=$this->db->get('tb_temp_roomreservation');
		return $query->row();
 	}
	public function delPerTempBooking($rb_id){
		$this->db->where('rb_id',$rb_id);
		$query=$this->db->delete('tb_temp_roomreservation');	
		return $query;
	}
	public function insertRoomBooking($data,$custsesid){
		$rb_subdatetime=date("Y-m-d H:i:s");
		$dataInsert=array('rb_regid'=>$custsesid,'rb_orderno'=>$data['rb_orderno'],'rb_bookfordate'=>$data['rb_bookfordate'],'rb_norooms'=>$data['rb_norooms'],'rb_name'=>$data['rb_name'],'rb_idtype'=>$data['rb_idtype'],'rb_idproofno'=>$data['rb_idproofno'],'rb_mobile'=>$data['rb_mobile'],'rb_email'=>$data['rb_email'],'rb_address'=>$data['rb_address'],'rb_city'=>$data['rb_city'],'rb_state'=>$data['rb_state'],'rb_pincode'=>$data['rb_pincode'],'rb_amtperroom'=>$data['rb_amtperroom'],'rb_amount'=>$data['rb_amount'],'rb_subdatetime'=>$rb_subdatetime,'rb_transstatus'=>$data['rb_transstatus']);
		$this->db->insert('tb_roomreservation',$dataInsert);
		$insert_id=$this->db->insert_id();
		return  $insert_id;			
	}
	public function getPerRoomBooking($rb_id){
		$this->db->where("rb_id",$rb_id) ;
		$query=$this->db->get('tb_roomreservation');
		return $query->row();
 	}
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
	
	/*public function getAllHawanSlot(){
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
*/
}
?>