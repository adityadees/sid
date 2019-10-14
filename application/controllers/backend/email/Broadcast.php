<?php
defined('BASEPATH') OR exit('No direct script allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
class Broadcast extends MY_Controller{

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
	}

	public function index(){

		$kk = $this->db->query("SELECT * FROM registrasi inner join penghuni on registrasi.penghuni_kpm=penghuni.penghuni_kpm where registrasi.registrasi_validasi='no' order by registrasi.registrasi_tgl asc")->result();

		$no = 0;
		foreach ($kk as $key => $value) {
			$no++;
			echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
		}
		exit();

		$date = "2019-07-29";
		$no = 0;
		foreach ($kk as $key => $value) {
			if($key< 100){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			} if($key >= 100 && $key < 200){
				
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			} if($key >= 200 && $key < 300){
				
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			} if($key >= 300 && $key < 400){
				
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			} if($key >= 400 && $key < 500){
				
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			} if($key >= 500 && $key < 600){
				
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
			}
		}

		/*
		$date = "2019-07-29";
		$no = 0;
		foreach ($kk as $key => $value) {
			if($key >= 500 && $key < 600){
				//$no = $key+1;
				//echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";
				$datex = strtotime("+5 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465, 
					'smtp_user' => 'unsri.bpu@gmail.com',
					'smtp_pass' => 'fasilkomunsri11',
					'mailtype'  => 'html',
					'charset'   => 'iso-8859-1'
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('no-reply@bpuunsri.ac.id', 'BPU UNSRI ');
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				//$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				//$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}

			} */
			/*else if($key >= 100 && $key < 200){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";


				$datex = strtotime("+1 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}

			} else if($key >= 200 && $key < 300){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";


				$datex = strtotime("+2 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}

			} else if($key >= 300 && $key < 400){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";


				$datex = strtotime("+3 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			} else if($key >= 400 && $key < 500){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";


				$datex = strtotime("+4 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			} else if($key >= 500 && $key < 600){
				$no = $key+1;
				echo $no.". ".ucwords($value->penghuni_nama). " - ". $value->penghuni_kpm."<br>";


				$datex = strtotime("+5 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = ucwords($value->penghuni_nama);
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value->penghuni_email); 
				$this->email->subject('Jadwal Validasi Pemondokan Mahasiswa');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/bpu/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			}
		}
*/

	/*	exit();

		$kk = ['adityads@ymail.com','adityadees@gmail.com','cintakubertepuksebelahtangan@gmail.com','rizalterrisel@gmail.com','teknologihot@gmail.com','amel_olwezh@yahoo.com'];
*/

		/*$ndate = date("Y-m-d", $date);
		$date = date('d-m-Y', $date);*/
		/*foreach ($kk as $key => $value) {

			if($key < 1){
				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = date("d-m-Y", strtotime($date));
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}

			} else if($key > 0 && $key < 2){
				$datex = strtotime("+1 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);

				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}

			} else if($key > 1 && $key <3){
				$datex = strtotime("+2 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				echo $value."-".$ndate."<br>";

				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			} else if($key > 2 && $key <4){
				$datex = strtotime("+3 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);
				echo $value."-".$ndate."<br>";

				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			} else if($key > 3 && $key <5){
				$datex = strtotime("+4 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);

				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			} else if($key > 4 && $key <6){
				$datex = strtotime("+5 day", strtotime($date));
				$ndate = date("d-m-Y", $datex);

				$template = file_get_contents(APPPATH."views/frontend/email/broadcast.php");
				$variables = array();
				$variables['name'] = $value;
				$variables['gettanggal'] = $ndate;
				foreach($variables as $keyx => $valuex)
				{
					$template = str_replace('{{ '.$keyx.' }}', $valuex, $template);
				}



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
				$this->email->to($value); 
				$this->email->subject('Syarat Pengajuan Penyewaan Asrama');
				$this->email->message($template);
				$attched_file= $_SERVER["DOCUMENT_ROOT"]."/uploads/attach/surat_pernyataan.pdf";
				$this->email->attach($attched_file);
				if (!$this->email->send())
				{
					echo $this->email->print_debugger();
				}
			}


		}


		
*/

		/*$this->data['title']    = 'Dashboard';
		$this->data['content']  = 'home';
		$this->template($this->data, $this->module);*/
	}

}
?>