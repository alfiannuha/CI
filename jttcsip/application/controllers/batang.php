<?php
class Batang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_batang');
	}
	function index(){
		$x['merchant']=$this->m_batang->get_data_merchant();
		$x['brilling']=$this->m_batang->get_data_brilling();
		$x['uko']=$this->m_batang->get_data_uko();
		$x['isi']='batang';
		$this->load->view('layout/wrapper',$x);
	}
}