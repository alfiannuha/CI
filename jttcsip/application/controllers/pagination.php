<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pagination extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('m_pagination');
	}
 
	public function index(){
		$this->load->database();
		$jumlah_data = $this->m_pagination->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/index.php/pagination/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 5;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['isi'] = $this->m_pagination->data($config['per_page'],$from);
		$this->load->view('layout/wrapper',$data);
	}
}