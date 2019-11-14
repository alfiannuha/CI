


<?php

if (!defined('BASEPATH')) exit('File tidak dapat diakses');

class Kontak extends CI_Controller {

    // awal tampil index
    public function index() {
        $data=array('judul'=>'Informasi Kontak','isi'=>'kontak');
        $this->load->view('layout/wrapper', $data);
    }
}