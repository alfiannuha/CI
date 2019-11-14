<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_posting extends CI_Model 
{
    var $tabel ="berita";
    
    function __construct(){
        parent::__construct();
    }

    function get_semua(){
        $this->db->from($this->tabel);
        $data = $this->db->get();

        if($data->num_rows() > 0)
        {
            return $data->result();
        }
    }
    function get_daftar_byid($id)
    {
        $this->db->from($this->tabel);
        $this->db->where('id',$id);
        $data = $this->db->get();
        if($data->num_rows() == 1)
        {
            return $data->result();
        }
    }
    function tambah_berita($data)
    {
        $this->db->insert($this->tabel,$data);
        return true;
    }
    function ubah_berita($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update($this->tabel,$data);
        return true;
    }
    function hapus_berita($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->tabel);
        if($this->db->affected_rows()==1)
        {
            return true;
        }
        return false;
    }
}

?>