<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grafik extends CI_Model 
{
    function baca_data()
    {
        $query = $this->db->query("SELECT merk,sum(stok) as stok from barang group by merk");
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