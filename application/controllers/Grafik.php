<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_grafik');
    }
    public function index()
	{
        $x['data']=$this->m_grafik->baca_data();
        $x['judul']="Grafik Transaksi Barang";
        $x['isi']="grafik";
        $this->load->view("layout/wrapper",$x);
	}
}
