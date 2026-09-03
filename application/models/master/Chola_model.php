<?php
class Chola_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllCholaBooking(){
			$this->db->from('tb_cholabooking');
			$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
			//$this->db->where("donation_transstatus",'Success'); 
			$this->db->order_by("cb_id","desc"); 
			$query=$this->db->get();
			return $query->result();	
	}
	public function getAllBookingChola($temple_id){
		$this->db->from('tb_cholabooking');
			$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
			$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
			$this->db->where("cb_temple",$temple_id); 
			$this->db->order_by("cb_id","desc"); 
			$query=$this->db->get();
			return $query->result();
	}
	public function getAllCholaBookingSuccess(){
			$this->db->from('tb_cholabooking');
			$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
			$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
			$this->db->where("cb_transstatus",'Success'); 
			$this->db->order_by("cb_id","desc"); 
			$query=$this->db->get();
			return $query->result();	
	}
	public function getPerCholaBooking($cb_id){
		$this->db->from('tb_cholabooking');
		$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
		$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
		$this->db->where('cb_id',$cb_id);
		$query=$this->db->get();
		return  $query->row();	
	}
	/******** Export *******/
	public function getAllCholaBookingSearch($ad_temple,$from_date,$to_date){
			$this->db->from('tb_cholabooking');
			$this->db->join('tb_registration','tb_registration.reg_id=tb_cholabooking.cb_regid','left');
			$this->db->join('tb_temple','tb_temple.temple_id=tb_cholabooking.cb_temple','left');
			$this->db->where('cb_temple',$ad_temple);
			$this->db->where("cb_transstatus",'Success'); 
			$this->db->where('cb_bookfordate >=', $from_date);
			$this->db->where('cb_bookfordate <=', $to_date);
			$this->db->order_by("cb_id","desc"); 
			$query=$this->db->get();
			return $query->result();	
	}
	
		public function getAllTemple(){
		$this->db->where("temple_status",1) ;
		$query=$this->db->get('tb_temple');
		return $query->result();
 	}
	 public function getPerTemple($temple_id){
		$this->db->where("temple_id",$temple_id) ;
		$query=$this->db->get('tb_temple');
		return $query->row();
 	}
}
?>