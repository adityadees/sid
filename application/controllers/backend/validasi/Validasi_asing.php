<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Validasi_asing extends MY_Controller{

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
		$this->data['title']    = 'Validasi Mahasiswa Asing';
		$this->data['content']  = 'penghuni/validasi/validasi_asing';
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


	public function save_validasi(){

		if($this->post('save_validasi')){

			$jk = $this->post('jk');
			$nama = $this->post('nama');
			$passport = $this->post('passport');
			$spengantar = $_FILES['spengantar']['name'];
			$tgl_keluar = $this->post('tgl_keluar');
			$asramaid = $this->post('asramaid');
			$asrama_jenis = '';
			$createdby = $this->data['token']['user_id'];

			$cek_asrama = $this->penghuni_asrama_m->get(['asrama_id' => $asramaid,'pa_status_sewa' => 'masuk']);

			if(count($cek_asrama) >0){
				$this->flashmsg('Kamar ini sudah terpakai', 'danger');
				redirect('dash/pa/v/unsri/');
			} else {

				if(substr($asramaid, 0,1) == 'A'){
					$asrama_jenis = 'apartemen';
				} else if(substr($asramaid, 0,1) == 'B'){
					$asrama_jenis = 'rusunawa';
				} else {
					$asrama_jenis = '';
				}
				$data = [
					'passport'	=> $passport,
					'jk'	=> $jk,
					'nama'	=> $nama,
					'spengantar'	=> $spengantar,
					'tgl_keluar'	=> $tgl_keluar,
					'asramaid'	=> $asramaid,
				];

				if($passport == '' || $passport==null){
					$this->flashmsg('No. Passport tidak boleh kosong', 'danger');
					redirect('dash/pa/v/asing');
				}

				if($jk == ''){
					$jk == 'L';
				}

				if($nama == '' || $nama==null){
					$this->flashmsg('Nama tidak boleh kosong', 'danger');
					redirect('dash/pa/v/asing');
				}

				if($_FILES['spengantar']['name'] == ''){
					$this->flashmsg('Surat Pengantar tidak boleh kosong', 'danger');
					redirect('dash/pa/v/asing');
				}

				if($tgl_keluar == ''){
					$this->flashmsg('Tanggal Keluar tidak boleh kosong', 'danger');
					redirect('dash/pa/v/asing');
				}

				$cekuser = $this->user_m->get(['user_username' => $passport]);
				if(count($cekuser) > 0){
					$this->flashmsg('Akun dengan passport ini telah terdaftar', 'danger');
					redirect('dash/pa/v/asing');
				} else {
					$db = $this->user_m->insert(['user_username' => $passport, 'user_password' => md5($passport), 'user_role' => 'mahasiswa']);

					if($db["sts"] == 1){
						$reuid = $db['id'];
						$db_penghuni = $this->penghuni_m->insert(['penghuni_kpm' => $passport,'user_id'=>$reuid,'penghuni_nama'=> $nama, 'penghuni_jk'=> $jk]);

						if($db_penghuni["sts"] == 1){
							$rekpm = $db_penghuni['id'];
							$db_reg = $this->registrasi_m->insert(['registrasi_id' => $rekpm,'penghuni_kpm'=>$passport,'registrasi_tgl'=> date('Y-m-d'),'registrasi_asrama'=> $asrama_jenis, 'registrasi_validasi'=> 'yes']);

							if($db_reg["sts"] == 1){
								$regid = $db_reg['id'];

								$db_penga = $this->penghuni_asrama_m->insert(['asrama_id' => $asramaid,'registrasi_id'=>$regid,'pa_tgl_masuk'=> date('Y-m-d'),'pa_tgl_keluar'=> $tgl_keluar, 'pa_status_sewa'=> 'masuk', 'pa_status_mhs'=>'aktif','pa_status_bayar'=> 'belum','pa_created_by' => $createdby]);

								if($db_penga["sts"] == 1){
									$reuid = $db['id'];

									if($_FILES['spengantar']['name'] != ''){
										$this->data['struk_grab'] = $this->struk_m->get(['user_id' => $reuid]);
										$upsewa = $this->go_upload('spengantar', 'uploads/asrama/struk/filesewa/'.$reuid, 'jpeg|jpg|png|pdf', TRUE);

										if($upsewa['status'] == 'OK'){
											$fnamesewa = $upsewa['filename'];

											if(count($this->data['struk_grab']) == 0){
												$ck = $this->struk_m->insert(['struk_sewa' => $fnamesewa, 'user_id'=>$reuid]);
											} else {
												$ck = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_sewa' => $fnamesewa]);
											}

											$xy = $this->asrama_m->update($asramaid,['asrama_status' => 'isi']);

											if(count($xy) == 1){
												$this->flashmsg('Berhasil memesan kamar', 'success');
												redirect('dash/pa/v/asing');
											}

										} else {
											$this->flashmsg('Gagal mengupload surat pengantar', 'danger');
											redirect('dash/pa/v/asing');
										}
									}


								} else {
									$this->flashmsg('Gagal mengirim data', 'danger');
									redirect('dash/pa/v/asing');
								}
							} else {
								$this->flashmsg('Gagal mengirim data', 'danger');
								redirect('dash/pa/v/asing');
							}
						} else {
							$this->flashmsg('Gagal mengirim data', 'danger');
							redirect('dash/pa/v/asing');
						}
					} else {
						$this->flashmsg('Gagal mengirim data', 'danger');
						redirect('dash/pa/v/asing');
					}
				}
			}
		} else {
			$this->flashmsg('Error', 'danger');
			redirect('dash/pa/v/asing');
		}
	}


}
?>