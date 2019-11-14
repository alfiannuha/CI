<?php 
 
class M_data extends CI_Model{
	function data($number,$offset){
		return $query = $this->db->get('user',$number,$offset)->result();		
	}
 
	function jumlah_data(){
		return $this->db->get('user')->num_rows();
	}
}