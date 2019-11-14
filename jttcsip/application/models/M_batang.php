<?php
class M_batang extends CI_Model{

	function get_data_merchant(){
        $query = $this->db->query("SELECT kanwil,jenis,jumlah FROM stok where jenis='Merchant' order by kanwil");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

	function get_data_brilling(){
        $query = $this->db->query("SELECT kanwil,jenis,jumlah FROM stok where jenis='Brilling' order by kanwil");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

		function get_data_uko(){
        $query = $this->db->query("SELECT kanwil,jenis,jumlah FROM stok where jenis='UKO' order by kanwil");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

}