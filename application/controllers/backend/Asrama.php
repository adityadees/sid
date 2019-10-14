<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Asrama extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('asrama_m');
		$this->load->model('penghuni_asrama_m');


		$this->data['token'] = $this->session->userdata('token');
		if (!isset($this->data['token']))
		{
			$this->session->sess_destroy();
			$this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
			redirect('login');
			exit;
		}else {
			if ($this->data['token']['role']=='mahasiswa') {
				$this->session->sess_destroy();
				$this->flashmsg('Wrong Auth', 'warning');
				redirect('login');
				exit;
			}
		}
	}

	public function apartemen(){
		$kd = 'A';
		$mArray = [];
		$apar   = $this->asrama_m->get();
		foreach ($apar as $key => $value) {
			if((substr($value->asrama_id, 0,1) == $kd)){
				$mArray[] = [
					'asrama_id'	=> $value->asrama_id,
					'asrama_fasilitas' => $value->asrama_fasilitas,
					'asrama_keterangan' => $value->asrama_keterangan,
					'asrama_status' => $value->asrama_status,
				];
			}
		}

		$this->data['apartemen_grab'] = json_encode($mArray);
		$this->data['title']    = 'Apartemen';
		$this->data['content']  = 'asrama/apartemen';
		$this->template($this->data, $this->module);
	}

	public function rusunawa(){
		$kd = 'B';
		$mArray = [];
		$apar   = $this->asrama_m->get();
		foreach ($apar as $key => $value) {
			if((substr($value->asrama_id, 0,1) == $kd)){
				$mArray[] = [
					'asrama_id'	=> $value->asrama_id,
					'asrama_fasilitas' => $value->asrama_fasilitas,
					'asrama_keterangan' => $value->asrama_keterangan,
					'asrama_status' => $value->asrama_status,
				];
			}
		}

		$this->data['rusunawa_grab'] = json_encode($mArray);
		$this->data['title']    = 'Rusunawa';
		$this->data['content']  = 'asrama/rusunawa';
		$this->template($this->data, $this->module);
	}

	public function asrama_pemda(){
		$kd = 'C';
		$mArray = [];
		$apar   = $this->asrama_m->get();
		foreach ($apar as $key => $value) {
			if((substr($value->asrama_id, 0,1) == $kd)){
				$mArray[] = [
					'asrama_id'	=> $value->asrama_id,
					'asrama_fasilitas' => $value->asrama_fasilitas,
					'asrama_keterangan' => $value->asrama_keterangan,
					'asrama_status' => $value->asrama_status,
				];
			}
		}

		$this->data['asrama_pemda_grab'] = json_encode($mArray);
		$this->data['title']    = 'Asrama Pemda';
		$this->data['content']  = 'asrama/asrama_pemda';
		$this->template($this->data, $this->module);
	}

	public function detail_kamar(){
		$id = $this->post('id');

		$data    = $this->penghuni_asrama_m->getDataJoin(['registrasi','penghuni'],['penghuni_asrama.registrasi_id = registrasi.registrasi_id','registrasi.penghuni_kpm=penghuni.penghuni_kpm'],"penghuni_asrama.asrama_id='$id'");

		echo json_encode($data);
	}

	public function changestatus(){
		$id = $this->post('id');
		$status = $this->post('status');
		$uriseg = $this->post('uriseg');
		$data = $this->asrama_m->get(['asrama_id'=>$id]);
		if(count($data) > 0){
			$statuscek = $data[0]->asrama_status;
			if($statuscek != 'isi'){
				$this->db->trans_begin();
				$ck = $this->asrama_m->update($id,['asrama_status' => $status]);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$this->flashmsg('Gagal mengganti status', 'danger');
					redirect($uriseg);
				}else{
					$this->db->trans_commit();
					$this->flashmsg('Berhasil mengganti status', 'success');
					redirect($uriseg);
				}
			}  else {
				$this->flashmsg('Gagal mengganti status', 'danger');
				redirect($uriseg);
			}
		} else {
			$this->flashmsg('Gagal mengganti status', 'danger');
			redirect($uriseg);
		}
	}

}
?>