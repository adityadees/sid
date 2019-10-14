<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Laporan extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';


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

		$this->load->library('Pdf');
		$this->load->model('asrama_m');
		$this->load->model('struk_m');
	}

	public function index() {
		$this->data['title']    = 'Laporan';
		$this->data['content']  = 'laporan/laporan_pemondokan';
		$this->template($this->data, $this->module);
	}

	public function ajax_getlap(){
		$mulai = $this->post('mulai');
		$selesai = $this->post('selesai');

		$mformat = date('Y-m-d',strtotime($mulai));
		$sformat = date('Y-m-d',strtotime($selesai));
		$vbasedon = $this->post('vbasedon');
		$vtipe = $this->post('vtipe');
		$dt_arr = [];
		$d1='';
		$d2='';
		$jbulan='';
		$jumlah='';
		$tgl_pembayaran = '-';
		$tgl_keluar_frmt = '';
		$x_pembayaran = $this->struk_m->get();
		if($vbasedon=='all'){
			$dt = $this->db->query("SELECT penghuni.penghuni_nama,penghuni.user_id,fakultas.fakultas_nama,penghuni.penghuni_tel,penghuni.penghuni_kpm,penghuni_asrama.pa_tgl_masuk,penghuni_asrama.asrama_id,penghuni_asrama.pa_tgl_keluar FROM penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id where registrasi_validasi='yes' && (penghuni_asrama.pa_tgl_masuk>='$mformat' && penghuni_asrama.pa_tgl_masuk<='$sformat')")->result();
			$no=0;
			foreach ($dt as $v) :

				foreach ($x_pembayaran as $kpemb) {
					if($kpemb->user_id == $v->user_id){
						$tgl_pembayaran = $kpemb->struk_tanggal;
					}
				}

				if($tgl_pembayaran == null || $tgl_pembayaran=='') {
					$tgl_pembayaran = '-';
				} else {
					$tgl_pembayaran = date('d-M-Y',strtotime($tgl_pembayaran));
				}


				$no++;
				if($v->pa_tgl_keluar == null || $v->pa_tgl_masuk == null ){
					$jbulan = '-';
					$jumlah = 0;
					$tgl_keluar_frmt = '-';
				} else {
					$d1 = new DateTime($v->pa_tgl_masuk);
					$d2 = new DateTime($v->pa_tgl_keluar);
					$interval = $d2->diff($d1);
					$jbulan = $interval->m + 12*$interval->y;


					
					if(substr($v->asrama_id, 0,1) == 'A'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*300000;
						} else {
							$jumlah = $jbulan*300000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'B'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'C'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					}

					$tgl_keluar_frmt = date('d-M-Y',strtotime($v->pa_tgl_keluar));
				}
				$dt_arr[] = [
					'NO' => $no,
					'NAMA' => $v->penghuni_nama,
					'FAKULTAS' => $v->fakultas_nama,
					'NIM' => (string)$v->penghuni_kpm,
					'TELEPON' => $v->penghuni_tel,
					'TANGGAL BAYAR' => $tgl_pembayaran,
					'NO_KAMAR' => $v->asrama_id,
					'MASA TINGGAL' => date('d-M-Y',strtotime($v->pa_tgl_masuk)),
					'KELUAR' => $tgl_keluar_frmt,
					'BULAN' => $jbulan,
					'JUMLAH' => $jumlah,
				];

			endforeach;

		} else {
			$dt = $this->db->query("SELECT penghuni.penghuni_nama,penghuni.user_id,fakultas.fakultas_nama,penghuni.penghuni_tel,penghuni.penghuni_kpm,penghuni_asrama.pa_tgl_masuk,penghuni_asrama.asrama_id,penghuni_asrama.pa_tgl_keluar FROM penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id where registrasi_validasi='yes' && (penghuni_asrama.pa_tgl_masuk>='$mformat' && penghuni_asrama.pa_tgl_masuk<='$sformat')  && penghuni_asrama.asrama_id like '$vtipe%' ")->result();

			$no=0;
			foreach ($dt as $v) :

				foreach ($x_pembayaran as $kpemb) {
					if($kpemb->user_id == $v->user_id){
						$tgl_pembayaran = $kpemb->struk_tanggal;
					}
				}

				if($tgl_pembayaran == null || $tgl_pembayaran=='') {
					$tgl_pembayaran = '-';
				} else {
					$tgl_pembayaran = date('d-M-Y',strtotime($tgl_pembayaran));
				}


				$no++;
				if($v->pa_tgl_keluar == null || $v->pa_tgl_masuk == null ){
					$jbulan = '-';
					$tgl_keluar_frmt = '-';
					$jumlah = 0;
				} else {
					$d1 = new DateTime($v->pa_tgl_masuk);
					$d2 = new DateTime($v->pa_tgl_keluar);
					$interval = $d2->diff($d1);
					$jbulan = $interval->m + 12*$interval->y;



					if(substr($v->asrama_id, 0,1) == 'A'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*300000;
						} else {
							$jumlah = $jbulan*300000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'B'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'C'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					}

					$tgl_keluar_frmt = date('d-M-Y',strtotime($v->pa_tgl_keluar));
				}
				$dt_arr[] = [
					'NO' => $no,
					'NAMA' => $v->penghuni_nama,
					'FAKULTAS' => $v->fakultas_nama,
					'NIM' => (string)$v->penghuni_kpm,
					'TELEPON' => $v->penghuni_tel,
					'TANGGAL BAYAR' => $tgl_pembayaran,
					'NO_KAMAR' => $v->asrama_id,
					'MASA TINGGAL' => date('d-M-Y',strtotime($v->pa_tgl_masuk)),
					'KELUAR' => $tgl_keluar_frmt,
					'BULAN' => $jbulan,
					'JUMLAH' => $jumlah,
				];


			endforeach;

		}

		$dtitle = '';
		if($vbasedon == 'apartemen' || $vbasedon == 'asrama' || $vbasedon == 'rusunawa'){
			$dtitle = 'Laporan '.ucfirst($vbasedon);
		} else {
			$dtitle = 'Laporan Pemondokan';
		}


		$alldata = [
			'dt_judul' => $dtitle,
			'dt_periode' => date('Y',strtotime($selesai)),
			'dt_all' => $dt_arr,
		];

		echo json_encode($alldata);

	}


	public function export_to(){

		$vbasedon = $this->get('based');
		$mulai = $this->get('ms');
		$selesai = $this->get('ss');
		$vtipe = $this->get('vt');
		$jexport = $this->get('jexport');

		$mformat = date('Y-m-d',strtotime($mulai));
		$sformat = date('Y-m-d',strtotime($selesai));
		$dt_arr = [];
		$d1='';
		$d2='';
		$jbulan='';
		$jumlah='';
		$tgl_keluar_frmt = '';
		$tgl_pembayaran = '-';
		$x_pembayaran = $this->struk_m->get();
		if($vbasedon=='all'){
			$dt = $this->db->query("SELECT penghuni.penghuni_nama,penghuni.user_id,fakultas.fakultas_nama,penghuni.penghuni_tel,penghuni.penghuni_kpm,penghuni_asrama.pa_tgl_masuk,penghuni_asrama.asrama_id,penghuni_asrama.pa_tgl_keluar FROM penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id where registrasi_validasi='yes' && (penghuni_asrama.pa_tgl_masuk>='$mformat' && penghuni_asrama.pa_tgl_masuk<='$sformat')")->result();
			$no=0;
			foreach ($dt as $v) :

				foreach ($x_pembayaran as $kpemb) {
					if($kpemb->user_id == $v->user_id){
						$tgl_pembayaran = $kpemb->struk_tanggal;
					}
				}

				if($tgl_pembayaran == null || $tgl_pembayaran=='') {
					$tgl_pembayaran = '-';
				} else {
					$tgl_pembayaran = date('d-M-Y',strtotime($tgl_pembayaran));
				}

				$no++;
				if($v->pa_tgl_keluar == null || $v->pa_tgl_masuk == null ){
					$jbulan = '-';
					$jumlah = 0;
					$tgl_keluar_frmt = '-';
				} else {
					$d1 = new DateTime($v->pa_tgl_masuk);
					$d2 = new DateTime($v->pa_tgl_keluar);
					$interval = $d2->diff($d1);
					$jbulan = $interval->m + 12*$interval->y;

					
					if(substr($v->asrama_id, 0,1) == 'A'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*300000;
						} else {
							$jumlah = $jbulan*300000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'B'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'C'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					}

					$tgl_keluar_frmt = date('d-M-Y',strtotime($v->pa_tgl_keluar));
				}
				$dt_arr[] = [
					'NO' => $no,
					'NAMA' => $v->penghuni_nama,
					'FAKULTAS' => $v->fakultas_nama,
					'NIM' => (string)$v->penghuni_kpm,
					'TELEPON' => $v->penghuni_tel,
					'TANGGAL_BAYAR' => $tgl_pembayaran,
					'NO_KAMAR' => $v->asrama_id,
					'MASA_TINGGAL' => date('d-M-Y',strtotime($v->pa_tgl_masuk)),
					'KELUAR' => $tgl_keluar_frmt,
					'BULAN' => $jbulan,
					'JUMLAH' => $jumlah,
				];

			endforeach;

		} else {
			$dt = $this->db->query("SELECT penghuni.penghuni_nama,fakultas.fakultas_nama,penghuni.user_id,penghuni.penghuni_tel,penghuni.penghuni_kpm,penghuni_asrama.pa_tgl_masuk,penghuni_asrama.asrama_id,penghuni_asrama.pa_tgl_keluar FROM penghuni_asrama inner join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm left join fakultas on penghuni.penghuni_fakultas=fakultas.fakultas_id where registrasi_validasi='yes' && (penghuni_asrama.pa_tgl_masuk>='$mformat' && penghuni_asrama.pa_tgl_masuk<='$sformat')  && penghuni_asrama.asrama_id like '$vtipe%' ")->result();

			$no=0;
			foreach ($dt as $v) :
				$no++;


				foreach ($x_pembayaran as $kpemb) {
					if($kpemb->user_id == $v->user_id){
						$tgl_pembayaran = $kpemb->struk_tanggal;
					}
				}

				if($tgl_pembayaran == null || $tgl_pembayaran=='') {
					$tgl_pembayaran = '-';
				} else {
					$tgl_pembayaran = date('d-M-Y',strtotime($tgl_pembayaran));
				}


				if($v->pa_tgl_keluar == null || $v->pa_tgl_masuk == null ){
					$jbulan = '-';
					$jumlah = 0;
					$tgl_keluar_frmt = '-';
				} else {
					$d1 = new DateTime($v->pa_tgl_masuk);
					$d2 = new DateTime($v->pa_tgl_keluar);
					$interval = $d2->diff($d1);
					$jbulan = $interval->m + 12*$interval->y;

					
					if(substr($v->asrama_id, 0,1) == 'A'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*300000;
						} else {
							$jumlah = $jbulan*300000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'B'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					} else if(substr($v->asrama_id, 0,1) == 'C'){
						if($d1>$d2){
							$jumlah = "-".$jbulan*150000;
						} else {
							$jumlah = $jbulan*150000;
						}
					}

					$tgl_keluar_frmt = date('d-M-Y',strtotime($v->pa_tgl_keluar));
				}
				$dt_arr[] = [
					'NO' => $no,
					'NAMA' => $v->penghuni_nama,
					'FAKULTAS' => $v->fakultas_nama,
					'NIM' => (string)$v->penghuni_kpm,
					'TELEPON' => $v->penghuni_tel,
					'TANGGAL_BAYAR' => $tgl_pembayaran,
					'NO_KAMAR' => $v->asrama_id,
					'MASA_TINGGAL' => date('d-M-Y',strtotime($v->pa_tgl_masuk)),
					'KELUAR' => $tgl_keluar_frmt,
					'BULAN' => $jbulan,
					'JUMLAH' => $jumlah,
				];


			endforeach;

		}

		$dtitle = '';
		if($vbasedon == 'all'){
			$dtitle = 'Seluruh Pemondokan';
		} else {
			if($vtipe == 'A'){
				$dtitle = 'Seluruh Apartemen';
			} else if($vtipe == 'AA'){
				$dtitle = 'Apartemen Putri';
			} else if($vtipe == 'AB'){
				$dtitle = 'Apartemen Putra';
			} else if($vtipe == 'B'){
				$dtitle = 'Seluruh Rusunawa';
			} else if($vtipe == 'BA'){
				$dtitle = 'Rusunawa Putra';
			} else if($vtipe == 'BB'){
				$dtitle = 'Rusunawa Lama Putri';
			} else if($vtipe == 'BC'){
				$dtitle = 'Rusunawa Baru Putri';
			} else if($vtipe == 'C'){
				$dtitle = 'Seluruh Asrama';
			} else if($vtipe == 'CA'){
				$dtitle = 'Asrama Lahat Putri';
			} else if($vtipe == 'CB'){
				$dtitle = 'Asrama Muara Enim Putri';
			} else if($vtipe == 'CC'){
				$dtitle = 'Asrama Muba Putri';
			} else if($vtipe == 'CD'){
				$dtitle = 'Asrama Musi Rawas Putra';
			} else if($vtipe == 'CE'){
				$dtitle = 'Asrama OKI Putra';
			} else if($vtipe == 'CF'){
				$dtitle = 'Asrama OKU Putra';
			} else if($vtipe == 'CG'){
				$dtitle = 'Asrama Palembang Putri';
			} else {}
		}

		$alldata = [
			'dt_judul' => $dtitle,
			'dt_periode' => date('Y',strtotime($selesai)),
			'dt_all' => $dt_arr,
		];

		if($jexport=='excel'){

			$this->data['title']    = 'Laporan';
			$this->data['recivedt']    = $alldata;
			$this->load->view('backend/laporan/laporan_excel',$this->data);
		} else if($jexport == 'pdf'){
			$this->data['title'] = 'Laporan';
			$this->data['recivedt']    = $alldata;
			$this->load->library('pdf');
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->filename = "Laporan.pdf";
			$this->pdf->load_view('backend/laporan/laporan_pdf',$this->data);

			$this->pdf->set_option('defaultMediaType', 'all');
			$this->pdf->set_option('isFontSubsettingEnabled', true);
			$this->pdf->render();
			$this->pdf->stream();
		}


	}

}
?>