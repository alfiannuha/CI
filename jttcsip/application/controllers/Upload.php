<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {


	public function index()
	{
		$list_file=array();
		$dir = "uploaded_file/";

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
		$data['title']='Upload dan Download File';
		$data['isi']='upload';
		$this->load->view('layout/wrapper',$data);
	}
	
	
	public function form(){
		$data['page']='form_upload';
		$data['isi']='upload';
		$this->load->view('layout/wrapper',$data);
	}
	
	public function do_upload(){
		$config['upload_path']   = './uploaded_file/'; 
		$config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|zip|rar'; 
		$this->load->library('upload', $config);
				
				 if ( ! $this->upload->do_upload('file_nya')) {
					$data['error_upload'] = array('error' => $this->upload->display_errors()); 
					$this->session->set_userdata('status_upload',
					'<div class="alert alert-warning alert-dismissible" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
					$data['error_upload']['error'].'</div>');
				 }
					
				 else { 
					$this->session->set_userdata('status_upload','<div class="alert alert-success alert-dismissible" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															File berhasil diupload
															</div>');
															
				} 
	
			redirect(base_url().'index.php/upload');
		}
		
	public function hapus($filenya){
		$dir   = './uploaded_file/'; 
		if(unlink($dir.$filenya)){
		$this->session->set_userdata('status_hapus','<div class="alert alert-success alert-dismissible" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															File berhasil dihapus</div>');

		}	
		redirect(base_url().'index.php/upload');
	}	
}
