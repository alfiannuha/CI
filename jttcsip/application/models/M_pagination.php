<?php
class M_pagination extends CI_Model{
	function data($number,$offset){
		return $query = $this->db->get('registrasi',$number,$offset)->result();		
	}
 
	function jumlah_data(){
		return $this->db->get('registrasi')->num_rows();
	}
}