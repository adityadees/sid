<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Produk extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('produk_m');
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
		$this->data['produk_grab'] = $this->produk_m->get_by_order('produk_id','desc');
		$this->data['title']    = 'Produk';
		$this->data['content']  = 'produk/produk';
		$this->template($this->data, $this->module);
	}
	public function create(){
		$this->data['title']    = 'Tambah Produk';
		$this->data['content']  = 'produk/create';
		$this->template($this->data, $this->module);
	}
	public function detail(){
		$uri = $this->uri->segment(4);
		$this->data['produk_grab'] = $this->produk_m->get(['produk_id'=>$uri]);
		$this->data['title']    = 'Tambah Produk';
		$this->data['content']  = 'produk/detail';
		$this->template($this->data, $this->module);
	}

	public function add(){
		$nama = $this->post('nama');
		$kategori = $this->post('kategori');
		$warna = $this->post('warna');
		$bahan = $this->post('bahan');
		$ukuran = $this->post('ukuran');
		$isi = $this->post('isi');
		$upspp = $this->go_upload('filefoto', 'uploads/produk', 'jpeg|jpg|png', TRUE);
		if($upspp['status'] != 'OK'){
			$this->flashmsg($upspp['response'], 'error');
			redirect('dash/produk');
		}

		$dslide = [ 
			'produk_nama'	=> $nama,
			'produk_kategori'	=> $kategori,
			'produk_warna'	=> $warna,
			'produk_bahan'	=> $bahan,
			'produk_ukuran'	=> $ukuran,
			'produk_desc'	=> $isi,
			'produk_cover'	=> $upspp['filename'],
		];

		$this->db->trans_begin();
		$ck = $this->produk_m->insert($dslide);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal menambah data', 'error');
			redirect('dash/produk');
		} else {
			$this->flashmsg('Berhasil menambah data', 'success');
			redirect('dash/produk');
		}
	}


	public function edit(){
		$id = $this->post('id');
		$judul = $this->post('judul');
		$desk = $this->post('desk');
		$oldimg = $this->post('oldimg');

		if ($_FILES['filefoto']['name'] == '') {
			$dslide = [ 
				'produk_judul'	=> $judul,
				'produk_deskripsi'	=> $desk,
			];
		} else {
			if(file_exists('assets/images/produk/'.$oldimg)) {
				unlink('assets/images/produk/'.$oldimg);
			}

			$upspp = $this->go_upload('filefoto', 'assets/images/produk', 'jpeg|jpg|png', TRUE);
			if($upspp['status'] != 'OK'){
				$this->flashmsg($upspp['response'], 'error');
				redirect('dash/produk');
			}

			$dslide = [ 
				'produk_judul'	=> $judul,
				'produk_deskripsi'	=> $desk,
				'produk_img'	=> $upspp['filename'],
			];
		}


		$this->db->trans_begin();
		$ck = $this->produk_m->update($id,$dslide);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal merubah data', 'error');
			redirect('dash/produk');
		} else {
			$this->flashmsg('Berhasil merubah data', 'success');
			redirect('dash/produk');
		}
	}



	public function delete(){
		$id = $this->post('id');
		$oldimg = $this->post('oldimg');

		if(file_exists('assets/images/produk/'.$oldimg)) {
			unlink('assets/images/produk/'.$oldimg);
		}

		$this->db->trans_begin();
		$ck = $this->produk_m->delete($id);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal menghapus data', 'error');
			redirect('dash/produk');
		} else {
			$this->flashmsg('Berhasil menghapus data', 'success');
			redirect('dash/produk');
		}
	}

}
?>