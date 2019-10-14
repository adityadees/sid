<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Penginapan extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('penginapan_m');
		$this->load->model('penginap_m');
		$this->load->model('penginapan_detail_m');
		$this->load->model('penginapan_bayar_m');
	}

	public function index(){
		
		$this->data['title']    = 'Penginapan Sriwijaya';
		$this->data['content']  = 'penginapan/penginapan';
		$this->template($this->data, $this->module);
	}

	public function ajax_ketersediaan()
	{
		$loc = $this->post('lok');
		$inc = date('Y-m-d', strtotime($this->post('inc'))); // 5
		$ouc = date('Y-m-d', strtotime($this->post('ouc'))); // 5
		$xpenginapan = $this->penginapan_m->get(['penginapan_status !=' => 'rusak', 'penginapan_jenis' => $loc]);
		//$w = $this->db->query("SELECT * FROM `penginapan_detail` WHERE  (pd_checkin NOT BETWEEN '$inc'  AND '$ouc')  AND  ( pd_checkout NOT BETWEEN '$inc'  AND '$ouc')")->result();
		$w = $this->db->query("SELECT * FROM  penginapan_detail right join penginapan on penginapan_detail.penginapan_kode=penginapan.penginapan_kode WHERE penginapan.penginapan_status!='rusak' && penginapan.penginapan_jenis='$loc'")->result();

		$elim = [];
		foreach ($w as $key => $value) {
			if ($value->pd_status != 'checkout') {
				if ((($inc >= $value->pd_checkin && $inc <= $value->pd_checkout) || ($ouc >= $value->pd_checkin && $ouc <= $value->pd_checkout)) || (($value->pd_checkin >= $inc && $value->pd_checkin <= $ouc))) {
					$elim[] = $value->penginapan_kode;
				} else { }
			}
		}

		$dtar = [];
		foreach ($xpenginapan as $raza) {
			$dtar[] = $raza->penginapan_kode;
		}

		$dtar = array_diff($dtar, $elim);

		$alldata = [];
		foreach ($dtar as $vkey => $hfe) {

			$jns = substr($hfe, 0, 3);

			if ($jns == 'SCA') {
				$inap = 'Student Center';
			} else if ($jns == 'WSM') {
				$inap = 'Wisma';
			} else {
				$inap = '-';
			}
			$alldata[] = [
				'kode' => $hfe,
				'kamar' => substr($hfe, 3, 2),
				'jenis' => $inap,
				'aksi' => '<input type="checkbox" class="boxkamar" name="dtbox[]" value="' . encrypt_url($hfe) . '#@#' .$hfe . '">',
			];
		}
 
		echo json_encode($alldata);
	}


	public function add_penghuni() {
		$noident = $this->post('noident');
		$jident = $this->post('jident');
		$nama = $this->post('nama');
		$email = $this->post('email');
		$tel = $this->post('tel');
		$pr_id = 'RS' . mt_Rand() . date('d') . rand(0, 999);
		$dtbox = $this->post('dtbox');
		$nloc = $this->post('nloc');

		$tgl_awal = date('Y-m-d', strtotime($this->post('tgl_awal')));
		$tgl_akhir = date('Y-m-d', strtotime($this->post('tgl_akhir')));
		$datenow = date('Y-m-d');
		if ($datenow == $tgl_awal) {
			$sts = 'checkin';
		} else {
			$sts = 'booking';
		}

		$date1 = new DateTime($tgl_awal);
		$date2 = new DateTime($tgl_akhir);
		$interval = $date1->diff($date2);
		$diff=date_diff(date_create($tgl_awal),date_create($tgl_akhir));
		$ddif = $diff->format("%a");

		$ttl = 150000 * (count($dtbox) * (int)$ddif);
		
		if($ttl == 0){
			$this->flashmsg('Minimal penginapan 1 Hari', 'danger');
			redirect('penginapan');
		}
		
		if($tgl_awal < date('Y-m-d')){
			$this->flashmsg('Tanggal telah lewat', 'danger');
			redirect('penginapan');
		}
		$duser = [
			'penginap_identitas' => $noident,
			'penginap_nama' => $nama,
			'penginap_email' => $email,
			'penginap_tel' => $tel,
			'penginap_jenis_ident' => $jident,
		];


		$this->db->trans_begin();
		$x = $this->db->insert('penginap', $duser);
		$ids = $this->db->insert_id();

		$dref = [
			'pr_kode' => $pr_id,
			'pr_total' => $ttl,
			'pr_jenis' => $nloc,
			'penginap_id' => $ids,
			'pr_tanggal' => date('Y-m-d H:i:s'),
		];

		$w = $this->db->insert('penginapan_ref', $dref);

		for ($i = 0; $i < count($dtbox); $i++) {
			$ww = $this->db->insert('penginapan_detail', [
				'pd_id' => mt_Rand() . date('d') . rand(0, 999),
				'penginapan_kode' => decrypt_url($dtbox[$i]),
				'pr_kode' => $pr_id,
				'pd_status' => 'booking',
				'pd_checkin' => $tgl_awal,
				'pd_checkout' => $tgl_akhir,
			]);

			$this->db->update('penginapan', ['penginapan_status' => 'booking'], ['penginapan_kode' => decrypt_url($dtbox[$i])]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->flashmsg('Gagal mengirimkan data', 'danger');
			redirect('penginapan');
		} else {
			$this->db->trans_commit();
			$this->flashmsg('Berhasil mengirimkan data', 'success');
			redirect('penginapan');
		}
	}
	/*
	public function registrasi_penginapan(){
		if ($this->post('save_inap')) {
			$noident = $this->post('noident');
			$jident = $this->post('jident');
			$nama = $this->post('nama');
			$email = $this->post('email');
			$tel = $this->post('tel');
			$pr_id = 'RS' . mt_Rand() . date('d') . rand(0, 999);
			$dtbox = $this->post('xzs');
			$nloc = $this->post('nloc');

			$tgl_awal = date('Y-m-d', strtotime(decrypt_url($this->post('masuk'))));
			$tgl_akhir = date('Y-m-d', strtotime(decrypt_url($this->post('keluar'))));
			$datenow = date('Y-m-d');
			if ($datenow == $tgl_awal) {
				$sts = 'checkin';
			} else {
				$sts = 'booking';
			}

			$diff=date_diff(date_create($tgl_awal),date_create($tgl_akhir));
			$ddif = $diff->format("%a");

			$ttl =(300000 *  (int)$ddif);

			if($ttl == 0){
				$this->flashmsg('Minimal penginapan 1 Hari', 'danger');
				redirect('penginapan');
			}

			if($tgl_awal < date('Y-m-d')){
				$this->flashmsg('Tanggal telah lewat', 'danger');
				redirect('penginapan');
			}
			$duser = [
				'penginap_identitas' => $noident,
				'penginap_nama' => $nama,
				'penginap_email' => $email,
				'penginap_tel' => $tel,
				'penginap_jenis_ident' => $jident,
			];


			$this->db->trans_begin();
			$x = $this->db->insert('penginap', $duser);
			$ids = $this->db->insert_id();

			$dref = [
				'pr_kode' => $pr_id,
				'pr_total' => $ttl,
				'pr_jenis' => $nloc,
				'penginap_id' => $ids,
				'pr_tanggal' => date('Y-m-d H:i:s'),
			];

			$w = $this->db->insert('penginapan_ref', $dref);

			$ww = $this->db->insert('penginapan_detail', [
				'pd_id' => mt_Rand() . date('d') . rand(0, 999),
				'penginapan_kode' => decrypt_url($dtbox),
				'pr_kode' => $pr_id,
				'pd_status' => 'booking',
				'pd_checkin' => $tgl_awal,
				'pd_checkout' => $tgl_akhir,
			]);

			$this->db->update('penginapan', ['penginapan_status' => 'booking'], ['penginapan_kode' => decrypt_url($dtbox)]);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->flashmsg('Gagal mengirimkan data', 'danger');
				redirect('penginapan');
			} else {
				$this->db->trans_commit();
				$this->flashmsg('Berhasil mengirimkan data', 'success');
				redirect('penginapan');
			}

		} else {
			$this->flashmsg('No auth', 'danger');
			redirect('penginapan');
		}
	}*/
}
