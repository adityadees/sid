<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Validasi_unsri extends MY_Controller{

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
		$gdate = date('Y-m-d');
		$apar = $this->db->query("SELECT * FROM registrasi inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm where registrasi.registrasi_validasi='no' && registrasi.registrasi_tgl_end >= '$gdate'")->result();
		$this->data['fakultas_grab'] = $this->fakultas_m->get();
		$this->data['prodi_grab'] = $this->prodi_m->get();
		$this->data['jurusan_grab'] = $this->jurusan_m->get();
		$this->data['registrasi_grab'] = $apar;
		$this->data['title']    = 'Validasi Mahasiswa Unsri';
		$this->data['content']  = 'penghuni/validasi/validasi_unsri';
		$this->template($this->data, $this->module);
	}


	public function detail(){

		$idreg = $this->uri->segment(5);
		$apar = $this->db->query("SELECT * FROM registrasi inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm where registrasi.registrasi_id='$idreg'")->result();

		if($apar[0]->registrasi_validasi == 'yes'){
			$this->flashmsg('Akun ini sudah melakukan validasi', 'success');
			redirect('dash/pa/v/unsri/');
		}

		$pa    = $this->penghuni_asrama_m->get(['registrasi_id' => $idreg]);
		$arrpa = [];
		foreach ($pa as $key => $value) {
			$arrpa[] = [
				'pa_id' =>  $value->pa_id,
				'tgl_keluar' =>  $value->pa_tgl_keluar,
				'registrasi_id' =>  $value->registrasi_id,
			];
		}



		

		$this->data['registrasi_grab'] = $apar;
		$this->data['pa_grab'] = $arrpa;
		$this->data['fakultas_grab'] = $this->fakultas_m->get();
		$this->data['struk_grab'] = $this->struk_m->get(['user_id' => $apar[0]->user_id]);
		$this->data['jurusan_grab'] = $this->jurusan_m->get(['fakultas_id' =>$apar[0]->penghuni_fakultas]);
		$this->data['prodi_grab'] = $this->prodi_m->get(['jurusan_id' =>$apar[0]->penghuni_jurusan]);
		$this->data['title']    = 'Validasi Mahasiswa Unsri';
		$this->data['content']  = 'penghuni/validasi/validasi_unsri_detail';
		$this->template($this->data, $this->module);
	}


	public function ajax_init(){
		$mArray = [];
		$aparx    = $this->db->query("SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,fakultas_nama,prodi_nama,pa_tgl_masuk,pa_tgl_keluar,pa_status_bayar  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id left join prodi on penghuni.penghuni_prodi=prodi.prodi_id where asrama.asrama_id LIKE 'AA1%'")->result();
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
		} else if($gedung_type == 'CA'){
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

		$tglmask='';
		$tglkeluar='';	
		$fak='';
		$prod='';
		$mArray = [];
		$aparx    = $this->db->query("SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,fakultas_nama,prodi_nama,pa_tgl_masuk,pa_tgl_keluar,pa_status_bayar  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id left join prodi on penghuni.penghuni_prodi=prodi.prodi_id  where asrama.asrama_id LIKE '$comb'")->result();


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
		if($this->post('validasibtn')){

			$createdby = $this->data['token']['user_id'];


			$idn = $this->post('idn');
			$kpm = $this->post('kpm');
			$pa_id = $this->post('pa_id');
			$asramaid = $this->post('asramaid');

			if($idn=='' || $kpm == '' || $pa_id == '' || $asramaid == ''){
				$this->flashmsg('Data tidak boleh kosong', 'danger');
				redirect('dash/pa/v/unsri/'.$idn);
			} else {

				$cek_asrama = $this->penghuni_asrama_m->get(['asrama_id' => $asramaid,'pa_status_sewa' => 'masuk']);

				if(count($cek_asrama) >0){
					$this->flashmsg('Kamar ini sudah terpakai', 'danger');
					redirect('dash/pa/v/unsri/');
				} else {

					$apar = $this->registrasi_m->get(['registrasi_id' => $idn]);
					if($apar[0]->registrasi_validasi == 'yes'){
						$this->flashmsg('Akun ini sudah melakukan validasi', 'warning');
						redirect('dash/pa/v/unsri/');
					} else {

						$data = [
							'asrama_id'	=> $asramaid,
							'pa_tgl_masuk'	=> date('Y-m-d'),
							'pa_status_sewa'	=> 'masuk',
							'pa_status_mhs'	=> 'aktif',
							'pa_created_by' => $createdby
						];

						$this->db->trans_begin();
						$ck = $this->registrasi_m->update($idn,['registrasi_validasi' => 'yes']);
						$this->db->trans_complete();
						if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();
							$this->flashmsg('Gagal memesan kamar', 'danger');
							redirect('dash/pa/v/unsri/'.$idn);
						}else{
							$this->db->trans_commit();
							$xx = $this->penghuni_asrama_m->update($pa_id,$data);
							$xy = $this->asrama_m->update($asramaid,['asrama_status' => 'isi']);

							$this->flashmsg('Berhasil memesan kamar', 'success');
							redirect('dash/pa/v/unsri/'.$idn);
						}
					}
				}
			}
		} else {
			$this->flashmsg('Gagal', 'danger');
			redirect('dash/pa/v/unsri/'.$idn);
		}
	}

	public function update_val_mahasiswa(){
		$nama = $this->post('nama');
		$email = $this->post('email');
		$tel = $this->post('tel');
		$jk = $this->post('jk');
		$alamat = $this->post('alamat');
		$kpm = $this->post('kpm');
		$fakultas = $this->post('fakultas');
		$jurusan = $this->post('jurusan');
		$prodi = $this->post('prodi');
		$jm = $this->post('jm');
		$nama_ortu = $this->post('nama_ortu');
		$tel_ortu = $this->post('tel_ortu');
		$alamat_ortu = $this->post('alamat_ortu');
		$userid = $this->post('userid');
		$idregs = $this->post('idregs');

		if($email == '' || $kpm=='' || $userid == '' || $idregs == ''){
			$this->flashmsg('Data tidak boleh kosong', 'danger');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-1");
		}

		$cekemail = $this->penghuni_m->get(['penghuni_email' => $email,'user_id !='=>$userid]);
		if(count($cekemail) == 0){
			$email=$email;
		} else {
			$this->flashmsg('Email telah terpakai', 'danger');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-1");
		}
		$cekkpm = $this->penghuni_m->get(['penghuni_kpm' => $kpm,'user_id !='=>$userid]);
		if(count($cekkpm) == 0){
			$kpm=$kpm;
		} else {
			$this->flashmsg('NIM telah terpakai', 'danger');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-1");
		}

		$data = [
			'penghuni_nama'	=> $nama,
			'penghuni_email'	=> $email,
			'penghuni_tel'	=> $tel,
			'penghuni_jk'	=> $jk,
			'penghuni_alamat'	=> $alamat,
			'penghuni_kpm'	=> $kpm,
			'penghuni_fakultas'	=> $fakultas,
			'penghuni_jurusan'	=> $jurusan,
			'penghuni_prodi'	=> $prodi,
			'penghuni_jm'	=> $jm,
			'penghuni_nama_ortu'	=> $nama_ortu,
			'penghuni_tel_ortu'	=> $tel_ortu,
			'penghuni_alamat_ortu'	=> $alamat_ortu,
		];


		$this->db->trans_begin();
		$ck = $this->penghuni_m->update_where(['user_id' => $userid], $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal merubah data', 'danger');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-1");
		} else {
			$this->flashmsg('Berhasil merubah data', 'success');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-1");
		}

	}


	public function update_val_lampiran(){
		if ($this->POST('uploadlampiran')) {
			$userid = $this->post('userid');
			$idregs = $this->post('idregs');
			$this->data['struk_grab'] = $this->struk_m->get(['user_id' => $userid]);

			if($_FILES['fileukt']['name'] != '' && $_FILES['filesewa']['name'] != ''){

				$upukt = $this->go_upload('fileukt', 'uploads/asrama/struk/fileukt/'.$userid, 'jpeg|jpg|png|pdf', TRUE);
				$upsewa = $this->go_upload('filesewa', 'uploads/asrama/struk/filesewa/'.$userid, 'jpeg|jpg|png|pdf', TRUE);

				if($upukt['status'] == 'OK' && $upsewa['status'] == 'OK'){
					$fnameukt = $upukt['filename'];
					$fnamesewa = $upsewa['filename'];

					if(count($this->data['struk_grab']) == 0){
						$ck = $this->struk_m->insert(['struk_ukt' => $fnameukt,'struk_sewa' => $fnamesewa, 'user_id'=>$userid]);
					} else {
						$ck = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_ukt' => $fnameukt,'struk_sewa' => $fnamesewa]);
					}

				} else {
					$this->flashmsg('Gagal mengupload file', 'danger');
					redirect('dash/pa/v/unsri/'.$userid."#tab-2");
				}
			} else if($_FILES['fileukt']['name'] != ''){
				$upukt = $this->go_upload('fileukt', 'uploads/asrama/struk/fileukt/'.$userid, 'jpeg|jpg|png|pdf', TRUE);
				if($upukt['status'] == 'OK'){
					$fnameukt = $upukt['filename'];

					if(count($this->data['struk_grab']) == 0){
						$ck = $this->struk_m->insert(['struk_ukt' => $fnameukt, 'user_id'=>$userid]);
					} else {
						$ck = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_ukt' => $fnameukt]);
					}

				} else {
					$this->flashmsg('Gagal mengupload file UKT / Bidikmisi', 'danger');
					redirect('dash/pa/v/unsri/'.$userid."#tab-2");
				}
			} else if($_FILES['filesewa']['name'] != ''){

				$upsewa = $this->go_upload('filesewa', 'uploads/asrama/struk/filesewa/'.$userid, 'jpeg|jpg|png|pdf', TRUE);
				if($upsewa['status'] == 'OK'){
					$fnamesewa = $upsewa['filename'];
					if(count($this->data['struk_grab']) == 0){
						$cek = $this->struk_m->insert(['struk_sewa' => $fnamesewa, 'user_id'=>$userid]);
					} else {
						$cek = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_sewa' => $fnamesewa]);
					}
				} else {
					$this->flashmsg('Gagal mengupload file Sewa', 'danger');
					redirect('dash/pa/v/unsri/'.$idregs."#tab-2");
				}
			} 

			if ($this->post('jum_bulan') > 0) {
				$date = new DateTime('now');
				$date->modify('+'.$this->post("jum_bulan").' month'); 
				$date = $date->format('Y-m-d');

				$up = $this->penghuni_asrama_m->update_where(['registrasi_id' => $idregs],['pa_tgl_keluar' => $date]);
			}
			$this->flashmsg('Berhasil mengirim data', 'success');
			redirect('dash/pa/v/unsri/'.$idregs."#tab-2");
		}
	}


	public function get_jur(){
		$fakultas = $this->get('fakultas');
		$gt = $this->jurusan_m->get(['fakultas_id' => $fakultas]);
		echo "<option value=''>--Pilih Jurusan--</option>";
		foreach ($gt as $key => $gg) {
			echo "<option value=$gg->jurusan_id>$gg->jurusan_nama</option>";
		}
	}
	public function get_prodi(){
		$jurusan = $this->get('jurusan');
		$gt = $this->prodi_m->get(['jurusan_id' => $jurusan]);
		echo "<option value=''>--Pilih Prodi--</option>";
		foreach ($gt as $key => $gg) {
			echo "<option value=$gg->prodi_id>$gg->prodi_nama</option>";
		}
	}
}
?>