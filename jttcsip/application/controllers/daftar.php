<?php

if (!defined('BASEPATH')) exit('File tidak dapat diakses');

class Daftar extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model('mdaftar');
        $this->load->helper('form','url');
    }


    // awal tampil index
    public function index() {
        $data['judul']='Informasi Kontak';
		$data['isi']='tampil';
		$data['qdaftar']=$this->mdaftar->get_semua();

        $this->load->view('layout/wrapper', $data);
    }

    // function form
    public function form() {
        // ambil variable url
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        // ambil variabel dari form
        $id = addslashes($this->input->post('txtid'));
        $email = addslashes($this->input->post('txtemail'));
        $nama = addslashes($this->input->post('txtnama'));
        $jenis = addslashes($this->input->post('txtjenis'));
        $kerja = addslashes($this->input->post('txtkerja'));

        // mengarahkan fungsi form sesuai dengan uri segmentnya
        if ($mau_ke == "add") {
            $data['title'] = 'Tambah Pendaftar';
            $data['aksi'] = 'aksi_add';
			$data['isi']='formulir';
            $this->load->view('layout/wrapper', $data);
        } 
        elseif ($mau_ke == "edit") {
            $data['qdata'] = $this->mdaftar->get_daftar_byid($idu);
            $data['title'] = 'Edit Pendaftar';
            $data['aksi']  = 'aksi_edit';
			$data['isi']='formulir';
            $this->load->view('layout/wrapper', $data);
        } 
        elseif ($mau_ke == "aksi_add") {
            // jika uri segmentasinya AKSI_ADD sebagai fungsi untuk insert data
            $tanggal=date('Y-m-d');
			$data = array(
                'nourut'    => $id,
                'nama'   => $nama,
                'email'  => $email,
                'jenis' => $jenis,
                'kerja'     => $kerja,
                'tanggal'  => $tanggal
            );

            $this->mdaftar->get_insert($data);
            $this->session->set_flashdata("Pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di Simpan</div>");
            redirect('daftar');
        } elseif ($mau_ke == "aksi_edit") {
            // jika uri segmentnya aksi_edit sebagai fungsi untuk update
            $tanggal=date("Y-m-d");
			$data = array(
                'nourut'    => $id,
                'nama'   => $nama,
                'email'  => $email,
                'jenis' => $jenis,
                'kerja'     => $kerja,
                'tanggal'  => $tanggal
            );

            $this->mdaftar->get_update($id, $data);
            $this->session->set_flashdata("Pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di Update</div>");
            redirect('index.php/daftar/tampil');
        }
    }

    // fungsi detail daftar
    public function detail($id) {
        $data['title'] = 'Detail Member';
        $data['qdaftar'] = $this->mdaftar->get_daftar_byid($id);
		$data['isi']='detail';

        $this->load->view('layout/wrapper', $data);
    }

    // fungsi hapus daftar
    public function hapus($gid) {
        $this->mdaftar->del_daftar($gid);
        $this->session->set_flashdata("Pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di Hapus</div>");
        redirect('daftar');
    }

}