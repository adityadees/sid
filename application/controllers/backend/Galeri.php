<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Galeri extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('galeri_m');
		$this->data['token'] = $this->session->userdata('token');
		if (!isset($this->data['token']))
		{
			$this->session->sess_destroy();
			$this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
			redirect('login');
			exit;
		} else {
			if ($this->data['token']['role']=='mahasiswa') {
				$this->session->sess_destroy();
				$this->flashmsg('Wrong Auth', 'warning');
				redirect('login');
				exit;
			}
		}
	}

	public function index(){
		$this->data['galeri'] = $this->galeri_m->get();
		$this->data['title']    = 'Galeri';
		$this->data['content']  = 'galeri/galeri';
		$this->template($this->data, $this->module);
	}


	public function create(){

		$upspp = $this->go_upload('filefoto', 'uploads/galeri', 'jpeg|jpg|png', TRUE);
		if($upspp['status'] != 'OK'){
			$this->flashmsg($upspp['response'], 'error');
			redirect('dash/galeri');
		}

		$dslide = [ 
			'galeri_foto'	=> $upspp['filename'],
		];

		$this->db->trans_begin();
		$ck = $this->galeri_m->insert($dslide);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal menambah data', 'error');
			redirect('dash/galeri');
		} else {
			$this->flashmsg('Berhasil menambah data', 'success');
			redirect('dash/galeri');
		}
	}

}
?>