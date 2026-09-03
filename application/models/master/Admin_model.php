<?php
class Admin_model extends CI_Model {
	public function __construct(){
        parent::__construct();
 	}
	public function adminLogin($data){
		$loginid=$data['loginid'];
		$password=md5($data['password']);
		$q=$this->db->where('ad_username',$loginid)->where('ad_password',$password)->get('tb_masterusers');
		if($q->num_rows()==1){
			$row=$q->row();
 				return $q->row();}
			else{
				return false;
			}
		
	}
	public function updateAccount($data,$adminId){
		if($data['password']!=""){
			$password=md5($data['password']);	
		}else{
			$password=$data['oldpass'];
		}
		$accountUp=date("Y-m-d h:i:s");
		$dataUpdate=array('ad_firstName'=>$data['first_name'],'ad_lastName'=>$data['last_name'],'ad_mobileNumber'=>$data['phone'],'ad_password'=>$password,'account_updated'=>$accountUp);
		$this->db->where('ad_userid',$adminId);
		$query=$this->db->update('tb_masterusers',$dataUpdate); 
		return $query;
	}
	public function getAdminProfile($ad_userid){
		$this->db->where('ad_userid',$ad_userid);
		$this->db->join('tb_temple','tb_temple.temple_id=tb_masterusers.ad_temple','left');
		$query=$this->db->get('tb_masterusers');
		return  $query->row();
	}
	public function getPerTemple($temple_id){
		  $this->db->where('temple_id',$temple_id);
		  $query=$this->db->get('tb_temple');
		  return  $query->row();
	}
	
	public function checkuserEmail($email){
		$this->db->where('ad_email',$email);
		$query=$this->db->get('tb_masterusers');
		return $query->num_rows();
	}
	
	
}
?>