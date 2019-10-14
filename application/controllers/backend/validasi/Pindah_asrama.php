<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Pindah_asrama extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('penghuni_asrama_m');
		$this->load->model('penghuni_m');
		$this->load->model('asrama_m');
		$this->load->model('fakultas_m');
		$this->load->model('prodi_m');
		$this->load->model('jurusan_m');
		$this->load->model('registrasi_m');
		$this->load->model('struk_m');
		$this->load->model('user_m');


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

	public function index(){
		$uri = $this->uri->segment('5');
		$cek = $this->db->query("SELECT penghuni_asrama.pa_id,penghuni_asrama.asrama_id,penghuni.penghuni_nama,penghuni.penghuni_kpm,penghuni.penghuni_jk FROM penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm where penghuni_asrama.pa_id='$uri'")->result();
		$ar = [];
		if (count($cek)==0) {
			$this->flashmsg('Tidak ada data', 'danger');
			redirect('dash/pa/daftar-penghuni');
		}else {
			$ar= [
				'nama' => $cek[0]->penghuni_nama,
				'kpm' => $cek[0]->penghuni_kpm,
				'jeniskel' => $cek[0]->penghuni_jk,
				'idpa' => $cek[0]->pa_id,
				'oldasram' => $cek[0]->asrama_id,
			];
		}

		$this->data['getdt'] = $ar;
		$this->data['title']    = 'Pindah Asrama';
		$this->data['content']  = 'penghuni/validasi/pindah_asrama';
		$this->template($this->data, $this->module);
	}



	public function ajax_init(){
		$mArray = [];
		$aparx    = $this->db->query("SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,fakultas_nama,prodi_nama,pa_tgl_masuk,pa_tgl_keluar,pa_status_bayar  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id left join prodi on penghuni.penghuni_prodi=prodi.prodi_id  where asrama.asrama_id LIKE 'AA1%'")->result();

		$tglmask='';
		$tglkeluar='';	
		$fak='';
		$prod='';

		foreach ($aparx as $key => $value) {
			if((substr($value->asrama_id, 0,2) == 'AA') && (substr($value->asrama_id, 2,1) == '1')){

				if($value->pa_tgl_masuk != null || $value->pa_tgl_masuk != ''){
					$tglmask = date('d-m-Y',strtotime($value->pa_tgl_masuk));
				} else {
					$tglmask = '-';
				}
				if($value->pa_tgl_keluar != null || $value->pa_tgl_keluar != ''){
					$tglkeluar = date('d-m-Y',strtotime($value->pa_tgl_keluar));
				} else {
					$tglkeluar = '-';
				}

				if($value->fakultas_nama != null || $value->fakultas_nama != ''){
					$fak = $value->fakultas_nama;
				} else {
					$fak = 'Fakultas tidak tersedia';
				}
				if($value->prodi_nama != null || $value->prodi_nama != ''){
					$prod = $value->prodi_nama;
				} else {
					$prod = 'Prodi tidak tersedia';
				}



				$mArray[] = [
					'id'	=> $value->asrama_id,
					'lantai'	=> '1',
					'status_asrama'	=> $value->asrama_status,
					'kpmmhs'	=> $value->penghuni_kpm,
					'namamhs'	=> $value->penghuni_nama,
					'fotomhs'	=> $value->penghuni_foto,
					'fakultasmhs'	=> $fak,
					'prodimhs'	=> $prod,
					'masukmhs'	=> $tglmask,
					'keluarmhs'	=> $tglkeluar,
					'sewastatus'	=> $value->pa_status_bayar,
					'idval'	=> 'rect'.substr($value->asrama_id,3,2).'_child'.substr($value->asrama_id, 6,1),
				];
			}
		}


		echo json_encode(
			[
				'lantaix'=> '1', 
				'svgfile'=> 'apartemen.svg', 
				'tipex' => 'A (Putri)',
				'alldata' => $mArray,
			]
		);

		//echo  json_encode([['svg_init'=>'apartemen.svg'],$mArray]);
	}



	public function ajax_change(){
		$gedung_type = $this->post('gdgtyp');
		$lantai = $this->post('lantaiid');
		$comb = $gedung_type.$lantai.'%';
		$svgfile = null;
		
		if($gedung_type == 'BA'){
			if($lantai == 1){
				$svgfile = 'rusunawa_lama_1.svg';
			} else {
				$svgfile = 'rusunawa_lama_2.svg';
			}
			$nama_tipe = 'RUSUNAWA LAMA PUTRA';
		} else if ($gedung_type == 'BB') {
			if($lantai == 1){
				$svgfile = 'rusunawa_lama_1.svg';
			} else {
				$svgfile = 'rusunawa_lama_2.svg';
			}
			$nama_tipe = 'RUSUNAWA LAMA PUTRI';
		} else if ($gedung_type == 'BC') {
			if($lantai == 1){
				$svgfile = 'rusunawa_baru_1.svg';
			} else {
				$svgfile = 'rusunawa_baru_2.svg';
			}
			$nama_tipe = 'RUSUNAWA BARU PUTRI';
		} else if($gedung_type == 'AA') {
			$svgfile = 'apartemen.svg';
			$nama_tipe = 'A (Putri)';
		} else if($gedung_type == 'AB') {
			$svgfile = 'apartemen.svg';
			$nama_tipe = 'B (Putra)';
		}  else if($gedung_type == 'CA'){
			if($lantai == 1){
				$svgfile = 'asrama_lahat_1.svg';
			} else {
				$svgfile = 'asrama_lahat_2.svg';
			}
			$nama_tipe = 'ASRAMA LAHAT PUTRI';
		} else if ($gedung_type == 'CB') {
			if($lantai == 1){
				$svgfile = 'asrama_muara_enim_1.svg';
			} else {
				$svgfile = 'asrama_muara_enim_2.svg';
			}
			$nama_tipe = 'ASRAMA MUARA ENIM PUTRI';
		} else if ($gedung_type == 'CC') {
			if($lantai == 1){
				$svgfile = 'asrama_muba_1.svg';
			} else {
				$svgfile = 'asrama_muba_2.svg';
			}
			$nama_tipe = 'ASRAMA MUBA PUTRI';
		}else if ($gedung_type == 'CD') {
			if($lantai == 1){
				$svgfile = 'asrama_musi_rawas_1.svg';
			} else {
				$svgfile = 'asrama_musi_rawas_2.svg';
			}
			$nama_tipe = 'ASRAMA MUSI RAWAS PUTRA';
		}else if ($gedung_type == 'CE') {
			if($lantai == 1){
				$svgfile = 'asrama_oki_1.svg';
			} else {
				$svgfile = 'asrama_oki_2.svg';
			}
			$nama_tipe = 'ASRAMA OKI PUTRA';
		}else if ($gedung_type == 'CF') {
			if($lantai == 1){
				$svgfile = 'asrama_oku_1.svg';
			} else {
				$svgfile = 'asrama_oku_2.svg';
			}
			$nama_tipe = 'ASRAMA OKU PUTRA';
		}else if ($gedung_type == 'CG') {
			if($lantai == 1){
				$svgfile = 'asrama_palembang_1.svg';
			} else {
				$svgfile = 'asrama_palembang_2.svg';
			}
			$nama_tipe = 'ASRAMA PALEMBANG PUTRI';
		} else {
			$nama_tipe = '';
		}


		$mArray = [];
		$aparx    = $this->db->query("SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,fakultas_nama,prodi_nama,pa_tgl_masuk,pa_tgl_keluar,pa_status_bayar  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id left join prodi on penghuni.penghuni_prodi=prodi.prodi_id  where asrama.asrama_id LIKE '$comb'")->result();

		$tglmask='';
		$tglkeluar='';	
		$fak='';
		$prod='';

		foreach ($aparx as $key => $value) {

			
			if($value->pa_tgl_masuk != null || $value->pa_tgl_masuk != ''){
				$tglmask = date('d-m-Y',strtotime($value->pa_tgl_masuk));
			} else {
				$tglmask = '-';
			}
			if($value->pa_tgl_keluar != null || $value->pa_tgl_keluar != ''){
				$tglkeluar = date('d-m-Y',strtotime($value->pa_tgl_keluar));
			} else {
				$tglkeluar = '-';
			}

			if($value->fakultas_nama != null || $value->fakultas_nama != ''){
				$fak = $value->fakultas_nama;
			} else {
				$fak = 'Fakultas tidak tersedia';
			}
			if($value->prodi_nama != null || $value->prodi_nama != ''){
				$prod = $value->prodi_nama;
			} else {
				$prod = 'Prodi tidak tersedia';
			}


			$mArray[] = [
				'id'	=> $value->asrama_id,
				'lantai'	=> $lantai,
				'status_asrama'	=> $value->asrama_status,
				'kpmmhs'	=> $value->penghuni_kpm,
				'namamhs'	=> $value->penghuni_nama,
				'fotomhs'	=> $value->penghuni_foto,
				'fakultasmhs'	=> $fak,
				'prodimhs'	=> $prod,
				'masukmhs'	=> $tglmask,
				'keluarmhs'	=> $tglkeluar,
				'sewastatus'	=> $value->pa_status_bayar,
				'idval'	=> 'rect'.substr($value->asrama_id,3,2).'_child'.substr($value->asrama_id, 6,1),
			];
		}

		echo json_encode(
			[
				'lantaix'=> $lantai, 
				'svgfile'=> $svgfile, 
				'tipex' => $nama_tipe,
				'alldata' => $mArray,
			]
		);
	}


	public function save_kamar(){

		if($this->post('pindah_kamar')){
			$updatedby = $this->data['token']['user_id'];

			$paid = $this->post('paid');
			$asramaid = $this->post('asramaid');
			$oldasrama = $this->post('oldasrama');

			if($paid =='' || $asramaid=='' || $oldasrama==''){
				$this->flashmsg('Tidak ada data', 'danger');
				redirect('dash/pa/daftar-penghuni');
			} else {
				$this->db->trans_begin();
				$ck = $this->penghuni_asrama_m->update($paid,['asrama_id' => $asramaid,'pa_updated_by' => $updatedby]);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$this->flashmsg('Gagal mengirim data', 'danger');
					redirect('dash/pa/daftar-penghuni');
				}else{
					$ckd = $this->asrama_m->update($oldasrama,['asrama_status' => 'tersedia']);
					$cke = $this->asrama_m->update($asramaid,['asrama_status' => 'isi']);
					$this->db->trans_commit();
					$this->flashmsg('Berhasil pindah kamar', 'success');
					redirect('dash/pa/daftar-penghuni');
				}
			}
		} else {

			$this->flashmsg('Tidak ada data', 'danger');
			redirect('dash/pa/daftar-penghuni');
		}
	}


}
?>