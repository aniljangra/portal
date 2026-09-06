<?php
class Webcron_model extends CI_Model {
 public function __construct(){
 	parent::__construct(); 
 } 
public function getCholaBookingByOrder($cb_orderno){
		$this->db->where("cb_orderno",$cb_orderno) ;
		$query=$this->db->get('tb_cholabooking');
		return $query->row();
 	}	
	
}
?>