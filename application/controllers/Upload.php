<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$list_file=array();
		$dir = "upload_file/";

		// buka directory, dan baca isinya
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				$list_file[]=$file;
			}
			closedir($dh);
		  }
		}

		$data['daftar_file']=$list_file;
		$data['judul']='Upload dan Download File';
		$data['isi']='daftar_file';
		$this->load->view('layout/wrapper',$data);
	}
	
	
	public function form_upload(){
		$data['page']='form_upload';
		$data['isi']='form_upload';
		$this->load->view('layout/wrapper',$data);
	}
	
	public function do_upload()
        {
                $config['upload_path']          = './upload_file/';
                $config['allowed_types']        = 'gif|jpg|png|doc|rar|zip|docx|sql|php|html';
                $config['max_size']             = 2048;
                $config['max_width']            = 4084;
                $config['max_height']           = 4084;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_file' => $this->upload->data());

						// $this->load->view('upload_success', $data);
						redirect(base_url().'index.php/upload');
				}
        }
	public function hapus($filenya){
		$dir   = './upload_file/'; 
		if(unlink($dir.$filenya)){
		$this->session->set_userdata('status_hapus');

		}	
		redirect(base_url().'index.php/upload');
	}	
}
