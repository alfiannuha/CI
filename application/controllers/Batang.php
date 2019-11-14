<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batang extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_batang');
    }
    public function index()
	{
        $x['merchant']=$this->m_batang->get_data_merchant();
        $x['brilling']=$this->m_batang->get_data_brilling();
        $x['uko']=$this->m_batang->get_data_uko();
        $x['judul']="Grafik Transaksi Barang";
        $x['isi']="batang";
        $this->load->view("layout/wrapper",$x);
	}
}
