<?php
class Webpage_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 
public function checkUserAuth($data){
		$reg_loginid=$data['reg_loginid'];
		$reg_password=md5($data['reg_password']);
		$query=$this->db->where('reg_loginid',$reg_loginid);
		$this->db->where('reg_password',$reg_password);
		$this->db->where('reg_status',1);
		$query=$this->db->get('tb_registration');
		if($query->num_rows()>0){
			$row=$query->row();
			return $query->row();
		}else{
			return false;	
		}
	} 
public function getPerRegistration($reg_id){
	$this->db->where("reg_id",$reg_id) ;
	$query=$this->db->get('tb_registration');
	return $query->row();
 }	
public function insertRegistration($data){
		$reg_date=date("Y-m-d");
		$reg_password=md5($data['reg_password']);
		$dataInsert=array('reg_firstname'=>$data['reg_firstname'],'reg_lastname'=>$data['reg_lastname'],'reg_mobileno'=>$data['reg_mobileno'],'reg_email'=>$data['reg_email'],'reg_dob'=>$data['reg_dob'],'reg_gender'=>$data['reg_gender'],'reg_address_line1'=>$data['reg_address_line1'],'reg_address_line2'=>$data['reg_address_line2'],'reg_city'=>$data['reg_city'],'reg_state'=>$data['reg_state'],'reg_pincode'=>$data['reg_pincode'],'reg_loginid'=>$data['reg_loginid'],'reg_password'=>$reg_password,'reg_status'=>1,'reg_date'=>$reg_date);
	$this->db->insert('tb_registration',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;		
	}
public function insertDonation($data){
	$donation_date=date("Y-m-d");
	$dataInsert=array('donation_orderno'=>$data['donation_orderno'],'donation_regid'=>$data['donation_regid'],'donation_name'=>$data['donation_name'],'donation_mobile'=>$data['donation_mobile'],'donation_email'=>$data['donation_email'],'donation_address'=>$data['donation_address'],'donation_city'=>$data['donation_city'],'donation_state'=>$data['donation_state'],'donation_pincode'=>$data['donation_pincode'],'donation_amount'=>$data['donation_amount'],'donation_date'=>$donation_date);
	$this->db->insert('tb_donation',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;			
}


 public function getAllCountry(){
	$this->db->order_by("country_name", "asc") ;
	$query=$this->db->get('tb_country');
	return $query->result();
 }
 public function getCustomerByEmail($reg_email){
	$this->db->where('reg_email',$reg_email);
	$query=$this->db->get('tb_registration');
	return $query->row();
 }
 public function getAllState(){
	$this->db->order_by("state_name", "asc") ;
	$query=$this->db->get('tb_state');
	return $query->result();
 }
 
 public function chkOldPassword($pass,$reg_id){
		$this->db->where('reg_id',$reg_id);
		$this->db->where('reg_password',md5($pass));
		$query=$this->db->get('tb_registration');
		return $query->num_rows();	
}
public function changePassword($data,$reg_id){
	$dataUpdate=array('reg_password'=>md5($data['newPassword']));
	$this->db->where('reg_id',$reg_id);
	$query=$this->db->update('tb_registration',$dataUpdate); 
	return $query;	
}
public function updateUserForgotPass($passnew,$reg_email){
	$dataUpdate=array('reg_password'=>md5($passnew));
	$this->db->where('reg_email',$reg_email);
	$query=$this->db->update('tb_registration',$dataUpdate); 
	return $query;	
}	
	
 public function countRegEmail($email){
		$this->db->where('reg_email',$email);
		$query=$this->db->get('tb_registration');
		return $query->num_rows();	
}	
	
	
 /********************** Donation ******************/
 /*public function insertDonationTemp($data){
	$dotemp_date=date("Y-m-d");
	$reg_password=md5($data['reg_password']);
	$dataInsert=array('dotemp_name'=>$data['donation_name'],'dotemp_amount'=>$data['donation_amount'],'dotemp_date'=>$dotemp_date);
	$this->db->insert('tb_donation_temp',$dataInsert);
	$insert_id=$this->db->insert_id();
	return  $insert_id;		
	}
	public function getPerDonTempData($dotemp_id){
		$this->db->where("dotemp_id",$dotemp_id) ;
		$query=$this->db->get('tb_donation_temp');
		return $query->row();
 	}	
	public function getDonationByOrder($donation_orderno){
		$this->db->where("donation_orderno",$donation_orderno) ;
		$query=$this->db->get('tb_donation');
		return $query->row();
 	}	
	public function upDonationStatus($dataup,$donation_id){
		$dataUpdate=array('donation_transstatus'=>$dataup['donation_transstatus'],'donation_paymode'=>$dataup['donation_paymode'],'donation_transdate'=>$dataup['donation_transdate'],'donation_bankrefno'=>$dataup['donation_bankrefno'],'donation_statusdesc'=>$dataup['donation_statusdesc'],'donation_up'=>1);
		$this->db->where('donation_id',$donation_id);
		return $this->db->update('tb_donation',$dataUpdate); 
	}
	public function getPerDonation($donation_id){
		$this->db->where("donation_id",$donation_id) ;
		$query=$this->db->get('tb_donation');
		return $query->row();
 	}	*/
}
?>