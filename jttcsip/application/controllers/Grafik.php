<?php
class Grafik extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_grafik');
	}
	function index(){
		$x['data']=$this->m_grafik->get_data_stok();
		$x['isi']='grafik';
		$this->load->view('layout/wrapper',$x);
	}
}