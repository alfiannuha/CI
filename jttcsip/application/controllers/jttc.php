<?php
defined('BASEPATH') or exit ('File tidak dapat diakses');
class Jttc extends CI_Controller {

	public function index() 
	{
		$data=array('judul'=>'Sistem Informasi Bank BRI','isi'=>'home');
		$this->load->view('layout/wrapper',$data);
	}
/*	
	public function kontak()
	{
		$data=array('judul'=>'Sistem Informasi JTTC','isi'=>'kontak');
		$this->load->view('layout/wrapper',$data);
	}
	
	public function daftar()
	{
		$data=array('judul'=>'Pendaftararan Online','isi'=>'tampil');
		$this->load->view('layout/wrapper',$data);
	}
*/		
}
