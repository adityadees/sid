<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Slider extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('slider_m');
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
		$this->data['slider_grab'] = $this->slider_m->get();
		$this->data['title']    = 'Slider';
		$this->data['content']  = 'slider/slider';
		$this->template($this->data, $this->module);
	}

	public function create(){
		$judul = $this->post('judul');
		$link = $this->post('link');
		$upspp = $this->go_upload('filefoto', 'assets/images/slider', 'jpeg|jpg|png', TRUE);
		if($upspp['status'] != 'OK'){
			$this->flashmsg($upspp['response'], 'error');
			redirect('dash/slider');
		}

		$dslide = [ 
			'slider_judul'	=> $judul,
			'slider_link'	=> $link,
			'slider_img'	=> $upspp['filename'],
		];

		$this->db->trans_begin();
		$ck = $this->slider_m->insert($dslide);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal menambah data', 'error');
			redirect('dash/slider');
		} else {
			$this->flashmsg('Berhasil menambah data', 'success');
			redirect('dash/slider');
		}
	}


	public function edit(){
		$id = $this->post('id');
		$judul = $this->post('judul');
		$link = $this->post('link');
		$oldimg = $this->post('oldimg');

		if ($_FILES['filefoto']['name'] == '') {
			$dslide = [ 
				'slider_judul'	=> $judul,
				'slider_link'	=> $link,
			];
		} else {
			if(file_exists('assets/images/slider/'.$oldimg)) {
				unlink('assets/images/slider/'.$oldimg);
			}

			$upspp = $this->go_upload('filefoto', 'assets/images/slider', 'jpeg|jpg|png', TRUE);
			if($upspp['status'] != 'OK'){
				$this->flashmsg($upspp['response'], 'error');
				redirect('dash/slider');
			}

			$dslide = [ 
				'slider_judul'	=> $judul,
				'slider_link'	=> $link,
				'slider_img'	=> $upspp['filename'],
			];
		}


		$this->db->trans_begin();
		$ck = $this->slider_m->update($id,$dslide);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal merubah data', 'error');
			redirect('dash/slider');
		} else {
			$this->flashmsg('Berhasil merubah data', 'success');
			redirect('dash/slider');
		}
	}



	public function delete(){
		$id = $this->post('id');
		$oldimg = $this->post('oldimg');

		if(file_exists('assets/images/slider/'.$oldimg)) {
			unlink('assets/images/slider/'.$oldimg);
		}

		$this->db->trans_begin();
		$ck = $this->slider_m->delete($id);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal menghapus data', 'error');
			redirect('dash/slider');
		} else {
			$this->flashmsg('Berhasil menghapus data', 'success');
			redirect('dash/slider');
		}
	}

}
?>