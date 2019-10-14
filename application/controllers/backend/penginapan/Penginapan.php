<?php
defined('BASEPATH') or exit('No direct script allowed');

class Penginapan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->module = 'backend';


		$this->data['token'] = $this->session->userdata('token');
		if (!isset($this->data['token'])) {
			$this->session->sess_destroy();
			$this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
			redirect('login');
			exit;
		} else {
			if ($this->data['token']['role'] == 'mahasiswa') {
				$this->session->sess_destroy();
				$this->flashmsg('Wrong Auth', 'warning');
				redirect('login');
				exit;
			}
		}


		$this->load->model('penginapan_m');
		$this->load->model('penginap_m');
		$this->load->model('penginapan_detail_m');
		$this->load->model('penginapan_bayar_m');
		$this->load->model('penginapan_ref_m');
	}

	public function index()
	{
		$this->data['penginapan_sc_grab'] = $this->penginapan_m->get(['penginapan_jenis' => 'sc']);
		$this->data['penginapan_wisma_grab'] = $this->penginapan_m->get(['penginapan_jenis' => 'wisma']);
		$this->data['title']    = 'Kamar';
		$this->data['content']  = 'penginapan/kamar';
		$this->template($this->data, $this->module);
	}
	public function penghuni()
	{
		$this->data['penghuni_grab'] = $this->db->query("SELECT * FROM `penginapan_detail` inner JOIN penginapan_bayar on penginapan_detail.pd_id=penginapan_bayar.pr_kode inner join penginapan on penginapan_detail.penginapan_kode=penginapan.penginapan_kode WHERE penginapan_detail.pd_status='booking'")->result();
		$this->data['title']    = 'Penghuni Penginapan';
		$this->data['content']  = 'penginapan/penghuni';
		$this->template($this->data, $this->module);
	}



	public function gepeng()
	{
		$kd = $this->post('kd');
		$sts = $this->post('sts');
		$apar= $this->db->query("SELECT * FROM penginapan_ref INNER JOIN penginap on penginapan_ref.penginap_id=penginap.penginap_id where penginapan_ref.pr_status = '$sts' && penginapan_ref.pr_jenis = '$kd'")->result();
		echo json_encode($apar);
	}

	public function gepeng_by_kamar()
	{
		$kd = $this->post('kd');
		$sts = $this->post('sts');
		$apar= $this->db->query("SELECT *,penginapan_detail.pr_kode as pkod FROM `penginapan_detail`  LEFT JOIN penginapan_bayar on penginapan_detail.pr_kode=penginapan_bayar.pr_kode WHERE penginapan_detail.pd_status='$sts' AND penginapan_detail.penginapan_kode LIKE '$kd%'")->result();
		echo json_encode($apar);
	}
	public function gepeng_by_detail_id()
	{
		$id = $this->get('id');
		$apar = $this->penginapan_detail_m->get(['pd_id' => $id]);
	/*	$x = [];
		if(count($apar) > 0){
			$x = [
				'pdid' => decrypt_url($apar[0]->pd_id),
			];
		} else {
			$x = [];
		}*/
		echo json_encode($apar);
	}


	public function gepeng_by_id()
	{
		$id = $this->get('id');
		$ginvoice = $this->penginapan_bayar_m->get(['pr_kode' => $id]);
		$apar= $this->db->query("SELECT * FROM penginapan_ref INNER JOIN penginap on penginapan_ref.penginap_id=penginap.penginap_id where penginapan_ref.pr_kode = '$id'")->result();

		if (count($ginvoice) > 0) {
			if ($ginvoice[0]->pb_bukti != null || $ginvoice[0]->pb_bukti != '') {
				$bukti = $ginvoice[0]->pb_bukti;
				$pbid = $ginvoice[0]->pb_id;
				$b_trf = $bukti;
			} else {
				$bukti = '-';
				$pbid = '-';
				$b_trf = 'dt_kosong';
			}
			$dx = [
				'bukti' => $ginvoice[0]->pb_bukti,
				'pbid' => $ginvoice[0]->pb_id,
				'b_trf' => $b_trf
			];
		} else {
			$dx = [
				'bukti' => '-',
				'pbid' => '-',
				'b_trf' => 'dt_kosong',
			];
		}

		if (count($apar) > 0) {
			$dy = [
				'status' => 'sukses',
				'nama' => $apar[0]->penginap_nama,
				'pident' => $apar[0]->penginap_identitas,
				'refid' => encrypt_url($apar[0]->pr_kode),
				'ids' => $apar[0]->pr_kode,
			];
		}

		$data = array_merge($dx,$dy);

		echo json_encode(
			['alldata' => $data]
		);
	}

	public function gepeng_by_invoice() {
		$id = $this->get('id');
		$apar = $this->penginapan_detail_m->get(['pr_kode' => $id]);
		$data = [];
		if (count($apar) > 0) {
			$status = 'sukses';
			$jumlah = count($apar);
			foreach ($apar as $key => $value) {
				$data[] = [
					'pkode' => $value->penginapan_kode,
					'pcheckin' => date('d-m-Y',strtotime($value->pd_checkin)),
					'pcheckout' => date('d-m-Y',strtotime($value->pd_checkout)),
				];
			}
		} else {
			$status = 'error';
		}
		echo json_encode(
			[
				'status' => $status,
				'jumlah' => $jumlah,
				'alldata' => $data
			]
		);
	}



	public function changestatus()
	{
		$id = decrypt_url($this->post('id'));
		$status = $this->post('status');
		$uriseg = decrypt_url($this->post('uriseg'));
		$data = $this->penginapan_m->get(['penginapan_kode' => $id]);
		if (count($data) > 0) {
			$statuscek = $data[0]->penginapan_status;
			if ($statuscek != 'isi') {
				$this->db->trans_begin();
				$ck = $this->penginapan_m->update($id, ['penginapan_status' => $status]);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->flashmsg('Gagal mengganti status', 'danger');
					redirect($uriseg);
				} else {
					$this->db->trans_commit();
					$this->flashmsg('Berhasil mengganti status', 'success');
					redirect($uriseg);
				}
			} else {
				$this->flashmsg('Gagal mengganti status', 'danger');
				redirect($uriseg);
			}
		} else {
			$this->flashmsg('Gagal mengganti status', 'danger');
			redirect($uriseg);
		}
	}

	public function upload_bukti()
	{
		$setbukti = $this->post('setbukti');
		$uid = $this->data['token']['user_id'];
		$id = decrypt_url($this->post('refid'));

		$apar    = $this->penginapan_bayar_m->get(['pr_kode' => $id]);

		if ($_FILES['filestruk']['name'] == '') {
			$this->flashmsg('Silahkan lampirkan file terlebih dahulu', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
		} else {
			$upukt = $this->go_upload('filestruk', 'uploads/penginapan/struk/filestruk/' . $id, 'jpeg|jpg|png|pdf', TRUE);
			if ($upukt['status'] == 'OK') {
				$ffile = $upukt['filename'];
			} else {
				$this->flashmsg('Gagal mengupload file', 'danger');
				redirect('dash/penginapan/daftar-penghuni');
			}
		}

		if (count($apar) > 0) {
			$pbayar  = $this->penginapan_bayar_m->update($apar[0]->pb_id, ['pb_status' => 'bayar', 'pb_bukti' => $ffile, 'user_id' => $uid,'update_at' => date('Y-m-d H:i:s')]);
		} else {
			$pbayar  = $this->penginapan_bayar_m->insert(['pr_kode' => $id,'pb_status' => 'bayar', 'pb_bukti' => $ffile, 'user_id' => $uid,'update_at' => date('Y-m-d H:i:s'),'pb_tanggal' => date('Y-m-d H:i:s')]);
		}

		if($pbayar > 0){
			$this->flashmsg('Berhasil mengirim data', 'success');
			redirect('dash/penginapan/daftar-penghuni');
		} else {
			$this->flashmsg('Gagal mengirim data', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
		}
	}


	public function konfirmasi_pembayaran()
	{
		$setbukti = $this->post('setbukti');
		$uid = $this->data['token']['user_id'];
		$id = decrypt_url($this->post('refid'));

		$apar    = $this->db->query("SELECT * FROM penginapan_ref INNER JOIN penginapan_detail on penginapan_ref.pr_kode=penginapan_detail.pr_kode where penginapan_ref.pr_kode = '$id'")->result();
		$peng_bayar    = $this->penginapan_bayar_m->get(['pr_kode' => $id]);

		if (count($apar) > 0) {

			if ($setbukti == 'ya') {

				if ($_FILES['filestruk']['name'] == '') {
					$this->flashmsg('Silahkan lampirkan file terlebih dahulu', 'danger');
					redirect('dash/penginapan/daftar-penghuni');
				} else {
					$upukt = $this->go_upload('filestruk', 'uploads/penginapan/struk/filestruk/' . $id, 'jpeg|jpg|png|pdf', TRUE);
					if ($upukt['status'] == 'OK') {
						$ffile = $upukt['filename'];
					} else {
						$this->flashmsg('Gagal mengupload file', 'danger');
						redirect('dash/penginapan/daftar-penghuni');
					}
				}

				$pbayar  = $this->penginapan_bayar_m->insert(['pr_kode' => $id,'pb_status' => 'bayar', 'pb_bukti' => $ffile, 'user_id' => $uid,'update_at' => date('Y-m-d H:i:s'),'pb_tanggal' => date('Y-m-d H:i:s')]);
			} else {
				if(count($peng_bayar) > 0){
					$ffile = $peng_bayar[0]->pb_bukti;
					$pbayar  = $this->penginapan_bayar_m->update($peng_bayar[0]->pb_id, ['pb_status' => 'bayar', 'pb_bukti' => $ffile, 'user_id' => $uid,'update_at' => date('Y-m-d H:i:s')]);
				}
			}

			foreach ($apar as $key => $vk) {
				$pinap  = $this->penginapan_m->update($vk->penginapan_kode, ['penginapan_status' => 'terisi']);
				$pdetail  = $this->penginapan_detail_m->update($vk->pd_id, ['pd_status' => 'checkin']);
			}
			$pref  = $this->penginapan_ref_m->update($id, ['pr_status' => 'selesai']);
			if ($pref == 1) {
				$this->flashmsg('Sukses menyimpan data', 'success');
				redirect('dash/penginapan/daftar-penghuni');
				
			} else {
				$this->flashmsg('Gagal menyimpan data', 'danger');
				redirect('dash/penginapan/daftar-penghuni');
			}

		} else {
			$this->flashmsg('Gagal mendapatkan data', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
		}
	}

	public function checkout()
	{
		$uid = $this->data['token']['user_id'];
		$id = $this->post('pdid');
		$apar = $this->penginapan_detail_m->get(['pd_id' => $id]);

		if (count($apar) > 0) {
			$pdd = $this->penginapan_detail_m->update($id, ['pd_status' => 'checkout']);
			if ($pdd > 0) {
				$pdx = $this->penginapan_m->update($apar[0]->penginapan_kode, ['penginapan_status' => 'tersedia']);
				if ($pdx > 0) {
					$this->flashmsg('Berhasil mengirimkan data', 'success');
					redirect('dash/penginapan/daftar-penghuni');
				} else {
					$this->flashmsg('Gagal menyimpan data', 'danger');
					redirect('dash/penginapan/daftar-penghuni');
				}
			} else {

				$this->flashmsg('Gagal menyimpan data', 'danger');
				redirect('dash/penginapan/daftar-penghuni');
			}
		} else {
			$this->flashmsg('Gagal mendapatkan data', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
		}
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
				'aksi' => '<input type="checkbox" class="boxkamar" name="dtbox[]" value="' . encrypt_url($hfe) . '">',
			];
		}

		echo json_encode($alldata);
	}


	public function add_penghuni()
	{
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

		$ttl = 300000 * (count($dtbox) * (int)$ddif);
		
		if($ttl == 0){
			$this->flashmsg('Minimal penginapan 1 Hari', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
		}
		
		if($tgl_awal < date('Y-m-d')){
			$this->flashmsg('Tanggal telah lewat', 'danger');
			redirect('dash/penginapan/daftar-penghuni');
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
			redirect('dash/penginapan/daftar-penghuni');
		} else {
			$this->db->trans_commit();
			$this->flashmsg('Berhasil mengirimkan data', 'success');
			redirect('dash/penginapan/daftar-penghuni');
		}
	}
}
