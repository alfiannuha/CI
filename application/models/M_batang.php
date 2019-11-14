<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_batang extends CI_Model 
{
    function get_data_merchant()
    {
        $query = $this->db->query("SELECT kanwil,jenis,sum(jumlah) as total FROM stok WHERE jenis='Merchant' GROUP BY kanwil");
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $data)
            {
                $hasil[]=$data;
            }
            return $hasil;
        }
    }
    function get_data_brilling()
    {
        $query = $this->db->query("SELECT kanwil,jenis,sum(jumlah) as total FROM stok WHERE jenis='Brilling' GROUP BY kanwil");
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $data)
            {
                $hasil[]=$data;
            }
            return $hasil;
        }
    }
    function get_data_uko()
    {
        $query = $this->db->query("SELECT kanwil,jenis,sum(jumlah) as total FROM stok WHERE jenis='UKO' GROUP BY kanwil");
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $data)
            {
                $hasil[]=$data;
            }
            return $hasil;
        }
    }
}

?>