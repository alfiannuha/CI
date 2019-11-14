<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alfabank extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data = array('judul'=>"Aplikasi Data Siswa",'isi'=>'home');
        $this->load->view('layout/wrapper',$data);
        
	}
	function kontak()
  	{
		$data = array('judul'=>"Kontak Sekolah",'isi'=>'kontak');
        $this->load->view('layout/wrapper',$data);
	}
	function profile()
  	{
		$data = array('judul'=>"Profile Tetangga",'isi'=>'profile');
        $this->load->view('layout/wrapper',$data);
	}
	function registrasi()
  	{
		$data = array('judul'=>"Registrasi",'isi'=>'registrasi');
        $this->load->view('layout/wrapper',$data);
	}
}
