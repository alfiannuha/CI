<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_posting');
        $this->load->helper('form','url');
    }
	public function index()
	{
		$data['judul'] = "Data Posting Berita";
		$data['isi'] = 'berita';
		$data['qberita'] = $this->m_posting->get_semua();
		$this->load->view("layout/wrapper",$data);
	}
	public function form()
	{
		//ambil variabel url
		$mau_ke=$this->uri->segment(3);
		$idu=$this->uri->segment(4);

		//ambil variabel input dri form
		$id=addslashes($this->input->post('id'));
		$judul=addslashes($this->input->post('judul'));
		$isi=addslashes($this->input->post('isi'));
		$tag=addslashes($this->input->post('tag'));

		//mengarahkan fungsi form sesuai uri segmentnya
		if($mau_ke=="add")
		{
			$data['judul'] = "Tambah Berita";
			$data['aksi'] = "aksi_add";
			$data['isi'] = "formulir";
			$this->load->view("layout/wrapper",$data);
		}
		else if($mau_ke=="edit")
		{
			$data['qberita'] = $this->m_posting->get_daftar_byid($idu);
			$data['judul'] = "Edit Berita";
			$data['aksi'] = "aksi_edit";
			$data['isi'] = "formulir";
			$this->load->view("layout/wrapper",$data);
		}

		else if($mau_ke=="aksi_add")
		{
			//jika uri segmentasinya aksi_add sebagai fungsi untuk insert data
			$tanggal = date("Y-m-d");
			$data = array(
				'id'=>$id,
				'judul'=>$judul,
				'isi'=>$isi,
				'tag'=>$tag,
				'tanggal'=>$tanggal,
			);
			$this->m_posting->tambah_berita($data);
			redirect('Berita');
		}
		elseif($mau_ke=="aksi_edit")
		{
			$tanggal = date("Y-m-d");
			$data = array(
				'id'=>$id,
				'judul'=>$judul,
				'isi'=>$isi,
				'tag'=>$tag,
				'tanggal'=>$tanggal,
			);
			$this->m_posting->ubah_berita($id,$data);
			redirect("berita");
		}
	}
	public function hapus($gid)
	{
		$this->m_posting->hapus_berita($gid);
		redirect("berita");
	}
}
?>