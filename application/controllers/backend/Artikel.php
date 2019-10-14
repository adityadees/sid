<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Artikel extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('artikel_m');
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
		$this->data['artikel_grab'] = $this->artikel_m->get_by_order('artikel_tanggal','desc');
		$this->data['title']    = 'Artikel';
		$this->data['content']  = 'artikel/artikel';
		$this->template($this->data, $this->module);
	}
	public function uploader_ajax(){
//		move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);

//		$image = $_FILES['image']['name'];

		$temp = explode(".", $_FILES["image"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);

		$uploaddir = 'uploads/summernote/';
		$uploadfile = $uploaddir . basename($newfilename);
		if( move_uploaded_file($_FILES['image']['tmp_name'],$uploadfile)) {
			echo $uploadfile;
		} else {
			echo "fail"; 
		}
	}

	public function create(){
		$this->data['title']    = 'Artikel';
		$this->data['content']  = 'artikel/create';

		if(isset($_POST['save_artikel'])){
			$judul=$this->input->post('judul');
			$isi=$this->input->post('isi');
			$jenis=$this->input->post('jenis');

			if(!empty($_FILES['filefoto']['name'])){
				$config['upload_path'] = 'uploads/artikel';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['filefoto']['name'];
				$config['width'] = 1920;
				$config['height'] = 1080;
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('filefoto')){
					$uploadData = $this->upload->data();
					$coverimage = $uploadData['file_name'];
				}else{
					$coverimage='notfound';
				}
			}else{
				$coverimage='none';
			}

			$data =[ 
				'artikel_judul'		=> $judul,
				'artikel_isi'		=> $isi,
				'artikel_jenis'		=> $jenis,
				'artikel_cover' 	=> $coverimage,
				'artikel_slug'		=> slug($judul)."-".rand(0,99),
			];

			$result = $this->artikel_m->insert($data);

			if($result['sts']==1){
				$this->flashmsg('Sukses Menambah Data', 'success');
				redirect('dash/artikel');
			} else{
				$this->flashmsg('Gagal Menambah Data', 'danger');
				redirect('dash/artikel');
			}
		}
		$this->template($this->data, $this->module);
	}


	public function edit(){
		$this->data['title']    = 'Artikel';
		$this->data['content']  = 'artikel/edit';
		if(isset($_POST['edit_artikel'])){


			$artikel_id=$this->input->post('artikel_id');
			$judul=$this->input->post('judul');
			$isi=$this->input->post('isi');
			$jenis=$this->input->post('jenis');
			$oldimg=$this->input->post('cover_image');

			if(!empty($_FILES['filefoto']['name'])){
				$config['upload_path'] = 'uploads/artikel';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $_FILES['filefoto']['name'];
				$config['width'] = 1920;
				$config['height'] = 1080;
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('filefoto')){
					$uploadData = $this->upload->data();
					$coverimage = $uploadData['file_name'];

					if(file_exists('uploads/artikel/'.$oldimg)) {
						unlink('uploads/artikel/'.$oldimg);
					}
				}else{
					$this->flashmsg('Foto Gagal Diupload', 'success');
					redirect('index.php/dash/artikel');
				}
			}else{
				$coverimage=$oldimg;
			}

			$data =[ 
				'artikel_judul'	=> $judul,
				'artikel_isi'	=> $isi,
				'artikel_jenis'	=> $jenis,
				'artikel_cover'	=> $coverimage,
				'artikel_slug'	=> slug($judul)."-".rand(0,99),
			];

			$result = $this->artikel_m->update($artikel_id,$data);
			if($result==1){
				$this->flashmsg('Berhasil merubah data', 'success');
				redirect('dash/artikel');
			} else{
				$this->flashmsg('Gagal Merubah data', 'danger');
			}

		}
		else{
			$param = array('id' => $this->uri->segment(4));
			$this->data['artikel_grab']	= $this->artikel_m->get(['artikel_id' => $param['id']]);
			$this->template($this->data, $this->module);
		}
	}

	public function delete(){
		if(isset($_POST['artikel_delete'])){

			$artikel_id=$this->input->post('artikel_id');
			$artikel_cover=$this->input->post('artikel_cover');
			$result = $this->artikel_m->delete($artikel_id);
			if($result == 1){
				if(file_exists('uploads/artikel/'.$artikel_cover)) {
					unlink('uploads/artikel/'.$artikel_cover);
				}
				$this->flashmsg('Berhasil menghapus Data', 'success');
				redirect('dash/artikel');
			} else{
				$this->flashmsg('Gagal Menghapus Data', 'danger');
				redirect('dash/artikel');
			}
		}
	}

	public function detail(){
		$param = array('id' => $this->uri->segment(4));
		$this->data['artikel_grab']	= $this->artikel_m->get(['artikel_id' => $param['id']]);
		$this->data['title']    = 'Artikel';
		$this->data['content']  = 'artikel/detail';
		$this->template($this->data, $this->module);
	}

}
?>