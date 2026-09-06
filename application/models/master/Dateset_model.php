<?php
class Dateset_model extends CI_Model {
	public function __construct(){
                parent::__construct();
 	}
	public function getAllDateSetting(){
			$this->db->from('tb_datesetting');
			//$this->db->join('tb_usercat','tb_usercat.usercat_id=tb_user.user_type','left');
			//$this->db->where("donation_transstatus",'Success'); 
			$this->db->order_by("dset_date","desc"); 
			$query=$this->db->get();
			return $query->result();	
	}
	
	public function getPerDateSetting($dset_id){
		$this->db->from('tb_datesetting');
		$this->db->where('dset_id',$dset_id);
		$query=$this->db->get();
		return  $query->row();	
	}
	public function delPerDateSetting($dset_id){
		$this->db->where('dset_id',$dset_id);
		$query=$this->db->delete('tb_datesetting');
		return $query;
	}
	
	public function addDateSetting($data){
		$dataInsert=array('dset_date'=>$data['dset_date'],'dset_hawanbooking'=>$data['dset_hawanbooking'],'dset_roombooking'=>$data['dset_roombooking']);
		return $this->db->insert('tb_datesetting',$dataInsert);		
	}
	public function upDateSetting($data,$dset_id){
		$dataUpdate=array('dset_date'=>$dataup['dset_date'],'dset_hawanbooking'=>$dataup['dset_hawanbooking'],'dset_roombooking'=>$dataup['dset_roombooking']);
		$this->db->where('dset_id',$dset_id);
		return $this->db->update('tb_datesetting',$dataUpdate); 
	}
}
?>