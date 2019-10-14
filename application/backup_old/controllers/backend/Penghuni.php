<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Penghuni extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('penghuni_asrama_m');
		$this->load->model('penghuni_m');
		$this->load->model('asrama_m');
		$this->load->model('registrasi_m');


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
		$apar    = $this->db->query("select * from penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on penghuni.penghuni_kpm=registrasi.penghuni_kpm where registrasi.registrasi_validasi='yes'")->result();
		$this->data['pa_grab'] = $apar;
		$this->data['title']    = 'Penghuni';
		$this->data['content']  = 'penghuni/penghuni_asrama';
		$this->template($this->data, $this->module);
	}

	public function validasi(){


		$lt = 1;
		$kd = 'BA';
		$isi = 0;
		$tersedia = 0;
		$rusak = 0;

		$mArray = [];
		$apars    = $this->db->query('select asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,penghuni_fakultas,penghuni_prodi  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm')->result();


		foreach ($apars as $key => $value) {
			if((substr($value->asrama_id, 0,2) == $kd) && (substr($value->asrama_id, 2,1) == $lt)){

				if($value->asrama_status=='tersedia'){
					$tersedia += 1;
				} else if ($value->asrama_status == 'rusak'){
					$rusak +=1;
				}  else if ($value->asrama_status == 'isi'){
					$isi +=1;
				} else {}

				$mArray[] = [
					'id'	=> $value->asrama_id,
					'lantai'	=> $lt,
					'status_asrama'	=> $value->asrama_status,
					'penghuni_kpm'	=> $value->penghuni_kpm,
					'penghuni_nama'	=> $value->penghuni_nama,
					'penghuni_foto'	=> $value->penghuni_foto,
					'penghuni_prodi'	=> $value->penghuni_prodi,
					'penghuni_fakultas'	=> $value->penghuni_fakultas,
					'idval'	=> 'rect'.substr($value->asrama_id,3,2).'_child'.substr($value->asrama_id, 6,1),
				];
			}
		}
		$this->data['box'] = [
			'tersedia' => number_format(((120-$isi-$rusak)/120)*100,2),
			'terisi' => number_format(($isi/120)*100,2),
			'rusak' => number_format(($rusak/120)*100,2),
		];

		$this->data['ar'] = json_encode($mArray);


		$apar    = $this->registrasi_m->GetDataJoinNW(['registrasi' => 'penghuni_kpm', 'penghuni' => 'penghuni_kpm'],'inner');
		$pa    = $this->penghuni_asrama_m->get();
		$this->data['registrasi_grab'] = $apar;
		$arrpa = [];
		foreach ($pa as $key => $value) {
			$arrpa[] = [
				'pa_id' =>  $value->pa_id,
				'registrasi_id' =>  $value->registrasi_id,
				'file_spp' =>  $value->pa_filespp,
				'file_struk' =>  $value->pa_filestruk,
			];
		}
		$this->data['pa_grab'] = $arrpa;
		$this->data['title']    = 'Validasi';
		$this->data['content']  = 'penghuni/validasi';
		$this->template($this->data, $this->module);
	}

	public function ajaxapar(){
		$lt = $this->post('lantaiid');
		$kd = $this->post('gdgtyp');
		$isi = 0;
		$tersedia = 0;
		$rusak = 0;

		if($kd == 'BA'){
			if($lt == 1){
				$svgfile = 'rusunawa_lama_1.svg';
			} else {
				$svgfile = 'rusunawa_lama_2.svg';
			}
			$nama_tipe = 'RUSUNAWA LAMA PUTRA';
		} else if ($kd == 'BB') {
			if($lt == 1){
				$svgfile = 'rusunawa_lama_1.svg';
			} else {
				$svgfile = 'rusunawa_lama_2.svg';
			}
			$nama_tipe = 'RUSUNAWA LAMA PUTRI';
		} else if ($kd == 'BC') {
			if($lt == 1){
				$svgfile = 'rusunawa_baru_1.svg';
			} else {
				$svgfile = 'rusunawa_baru_2.svg';
			}
			$nama_tipe = 'RUSUNAWA BARU PUTRI';
		} else if($kd == 'AA') {
			$svgfile = 'apartemen.svg';
			$nama_tipe = 'APARTEMEN PUTRA';
		} else if($kd == 'AB') {
			$svgfile = 'apartemen.svg';
			$nama_tipe = 'APARTEMEN PUTRI';
		} else {
			$nama_tipe = '';
		}

		$mArray = [];
		$apar    = $this->db->query('select asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,penghuni_fakultas,penghuni_prodi  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm')->result();

		foreach ($apar as $key => $value) {
			if((substr($value->asrama_id, 0,2) == $kd) && (substr($value->asrama_id, 2,1) == $lt)){
				if($value->asrama_status=='tersedia'){
					$tersedia += 1;
				} else if ($value->asrama_status == 'rusak'){
					$rusak +=1;
				}  else if ($value->asrama_status == 'isi'){
					$isi +=1;
				} else {}

				$mArray[] = [
					'id'	=> $value->asrama_id,
					'lantai'	=> $lt,
					'status_asrama'	=> $value->asrama_status,
					'penghuni_kpm'	=> $value->penghuni_kpm,
					'penghuni_nama'	=> $value->penghuni_nama,
					'penghuni_foto'	=> $value->penghuni_foto,
					'penghuni_prodi'	=> $value->penghuni_prodi,
					'penghuni_fakultas'	=> $value->penghuni_fakultas,
					'idval'	=> 'rect'.substr($value->asrama_id,3,2).'_child'.substr($value->asrama_id, 6,1),
				];
			}
		}

		echo json_encode([
			'alldata' => $mArray, 
			'lantaix'=> $lt, 
			'svgfile'=> $svgfile, 
			'tipex' => $nama_tipe,
			'tersedia' => number_format(((120-$isi-$rusak)/120)*100,2),
			'terisi' => number_format(($isi/120)*100,2),
			'rusak' => number_format(($rusak/120)*100,2),
			'isstatus' => 'success',
		]);
	}

	

	/*public function ajaxapar(){
		$lt = $this->post('lantaiid');
		$kd = $this->post('gdgtyp');
		$isi = 0;
		$tersedia = 0;
		$rusak = 0;

		$mArray = [];
		$apar    = $this->db->query('select asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,penghuni_fakultas,penghuni_prodi  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm')->result();

		foreach ($apar as $key => $value) {
			if((substr($value->asrama_id, 0,2) == $kd) && (substr($value->asrama_id, 2,1) == $lt)){
				if($value->asrama_status=='tersedia'){
					$tersedia += 1;
				} else if ($value->asrama_status == 'rusak'){
					$rusak +=1;
				}  else if ($value->asrama_status == 'isi'){
					$isi +=1;
				} else {}

				$mArray[] = [
					'id'	=> $value->asrama_id,
					'lantai'	=> $lt,
					'status_asrama'	=> $value->asrama_status,
					'penghuni_kpm'	=> $value->penghuni_kpm,
					'penghuni_nama'	=> $value->penghuni_nama,
					'penghuni_foto'	=> $value->penghuni_foto,
					'penghuni_prodi'	=> $value->penghuni_prodi,
					'penghuni_fakultas'	=> $value->penghuni_fakultas,
					'idval'	=> 'rect'.substr($value->asrama_id,3,2).'_child'.substr($value->asrama_id, 6,1),
				];
			}
		}

		echo json_encode([
			'alldata' => $mArray, 
			'lantaix'=> $lt, 
			'tipex' => substr($kd, 1,1),
			'tersedia' => number_format(((120-$isi-$rusak)/120)*100,2),
			'terisi' => number_format(($isi/120)*100,2),
			'rusak' => number_format(($rusak/120)*100,2),
			'isstatus' => 'success',
		]);
	}*/



	public function konfirmasi(){
		$idn = $this->post('idn');
		$kpm = $this->post('kpm');
		$pa_id = $this->post('pa_id');
		$asramaid = $this->post('asramaid');



		$this->db->trans_begin();
		$ck = $this->registrasi_m->update($idn,['registrasi_validasi' => 'yes']);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal memesan kamar', 'danger');
			redirect('dash/pa/validasi');
		}else{
			$this->db->trans_commit();
			$xx = $this->penghuni_asrama_m->update($pa_id,['asrama_id' => $asramaid,'pa_tgl_masuk'=> date('Y-m-d'),'pa_status_mhs' => 'aktif','pa_status_bayar' => 'bayar']);
			$xy = $this->asrama_m->update($asramaid,['asrama_status' => 'isi']);

			$this->flashmsg('Berhasil memesan kamar', 'success');
			redirect('dash/pa/validasi');
		}
	}


	public function surat_pengantar(){
		$id = $this->uri->segment(4);
		$this->data['user_info'] = $this->db->query("SELECT * FROM registrasi inner join penghuni_asrama on registrasi.registrasi_id=penghuni_asrama.registrasi_id INNER JOIN penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm WHERE registrasi.registrasi_id = '$id' && registrasi.registrasi_validasi='yes'")->result();

		$this->data['title'] = 'Surat Pengantar';
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "surat_pengantar.pdf";
		$this->pdf->load_view('backend/penghuni/surat_pengantar',$this->data);
		$this->pdf->set_option('defaultMediaType', 'all');
		$this->pdf->set_option('isFontSubsettingEnabled', true);
		$this->pdf->render();
		$this->pdf->stream();
	}
}
?>