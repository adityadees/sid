<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Asrama extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('asrama_m');
		$this->load->model('penghuni_m');
		$this->load->model('Penghuni_asrama_m');
		$this->load->model('registrasi_m');
		$this->data['token_mhs'] = $this->session->userdata('token_mhs');
	}

	public function index(){
		$this->data['title']    = 'Fasilitas Pemondokan Mahasiswa';
		$this->data['content']  = 'asrama/asrama';
		$this->template($this->data, $this->module);
	}/*


	public function apartemen(){
		$userid = $this->data['token_mhs']['user_id'];
		$q = $this->penghuni_m->get(['user_id'=> $userid]);
		$kpm = $q[0]->penghuni_kpm;
		$this->data['regcur'] = $this->db->query("SELECT * FROM registrasi where registrasi_tgl_end>=CURDATE() and registrasi_validasi='no' and penghuni_kpm='$kpm'")->result();


		$lt = 1;
		$kd = 'AA';
		$isi = 0;
		$tersedia = 0;
		$rusak = 0;
		$booking = 0;

		$mArray = [];
		$apar    = $this->db->query('SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,penghuni_fakultas,penghuni_prodi  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm')->result();

		$date = strtotime("+3 day", strtotime(date('Y-m-d')));
		$ndate = date("Y-m-d", $date);

		$axz = $this->db->query("SELECT * from registrasi where registrasi_validasi ='no'")->result();
		if(isset($axz)){
			$booking = count($axz);
		} else {
			$booking = 0;
		}
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
		$this->data['box'] = [
			'tersedia' => number_format(((120-$isi-$rusak)/120)*100,2),
			'terisi' => number_format(($isi/120)*100,2),
			'rusak' => number_format(($rusak/120)*100,2),
			'booking' => number_format(($booking/120)*100,2),
		];

		$this->data['ar'] = json_encode($mArray);
		$this->data['title']    = 'Apartemen';
		$this->data['content']  = 'asrama/apartemen';
		$this->template($this->data, $this->module);
	}


	public function ajaxapar(){
		$lt = $this->post('lantaiid');
		$kd = $this->post('gdgtyp');
		$isi = 0;
		$tersedia = 0;
		$rusak = 0;
		$booking = 0;

		$mArray = [];
		$apar    = $this->db->query('SELECT asrama.asrama_status, asrama.asrama_id,penghuni.penghuni_kpm,penghuni_nama,penghuni_foto,penghuni_fakultas,penghuni_prodi  from asrama left join penghuni_asrama on asrama.asrama_id=penghuni_asrama.asrama_id left join registrasi on penghuni_asrama.registrasi_id=registrasi.registrasi_id left join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm')->result();

		$date = strtotime("+3 day", strtotime(date('Y-m-d')));
		$ndate = date("Y-m-d", $date);

		$axz = $this->db->query("SELECT * from registrasi where registrasi_validasi ='no'")->result();
		if(isset($axz)){
			$booking = count($axz);
		} else {
			$booking = 0;
		}

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
			'booking' => number_format(($booking/120)*100,2),
			'isstatus' => 'success',
		]);
	}


	public function booking_kamar(){
		$userid = $this->data['token_mhs']['user_id'];
		$date = strtotime("+3 day", strtotime(date('Y-m-d')));

		$q = $this->penghuni_m->get(['user_id'=> $userid]);
		$id = $this->post('ids');
		$kpm = $q[0]->penghuni_kpm;
		$kpnama = $q[0]->penghuni_nama;
		$kpemail = $q[0]->penghuni_email;

		
		if($this->post('filespp') == '' || $this->post('filestruk') == '' ){
			$this->session->set_flashdata('error', 'Lampiran tidak boleh kosong');
			redirect('asrama/apartemen');
		} else {

			$dregistrasi = [ 
				'penghuni_kpm'	=> $kpm,
				'registrasi_tgl'	=> date('Y-m-d'),
				'registrasi_tgl_end'	=> date("Y-m-d", $date),
				'registrasi_asrama'	=> $this->post('asrama_jenis')
			];



			$this->db->trans_begin();
			$ck = $this->registrasi_m->insert($dregistrasi);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Gagal memesan kamar');
				redirect('asrama/apartemen');
			} else {

				$idreg = $ck['id'];


				$upspp = $this->go_upload('filespp', 'uploads/asrama/apartemen/'.$kpm, 'jpeg|jpg|png|pdf', TRUE);
				if($upspp['status'] != 'OK'){
					$this->session->set_flashdata('error', $upspp['response']);
					redirect('asrama/apartemen');
				}

				$upstruk = $this->go_upload('filestruk', 'uploads/asrama/apartemen/'.$kpm, 'jpeg|jpg|png|pdf', TRUE);
				if($upstruk['status'] != 'OK'){
					$this->session->set_flashdata('error', $upstruk['response']);
					redirect('asrama/apartemen');
				}

				$template = file_get_contents(APPPATH."views/frontend/email/template.php");
				$variables = array();
				$variables['name'] = $kpnama;
				$variables['gettanggal'] = date("d-m-Y", $date);
				foreach($variables as $key => $value)
				{
					$template = str_replace('{{ '.$key.' }}', $value, $template);
				}


				$duser = [ 
					'registrasi_id'	=> $idreg,
					'pa_filespp'	=> $upspp['filename'],
					'pa_filestruk'	=> $upstruk['filename'],
				];

				$this->db->trans_begin();
				$ck = $this->Penghuni_asrama_m->insert($duser);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Gagal memesan kamar');
					redirect('asrama/apartemen');
				} else {


					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465, 
						'smtp_user' => 'unsribpu@gmail.com',
						'smtp_pass' => 'fasilkomunsri11',
						'mailtype'  => 'html',
						'charset'   => 'iso-8859-1'
					);
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from('no-reply@bpuunsri.ac.id', 'BPU UNSRI ');
					$this->email->to($kpemail); 
					$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
					$this->email->message($template);
					$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
					$this->email->attach($attched_file);
					if (!$this->email->send())
					{
						echo $this->email->print_debugger();
					}

					$this->session->set_flashdata('success', 'Data anda sedang diproses, silahkan cek email untuk melihat syarat - syarat yang dibutuhkan');
					redirect('asrama/apartemen');
				}
			}
		}
	}*/
}
?> 