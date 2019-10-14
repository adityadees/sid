<?php
defined('BASEPATH') OR exit('No direct script allowed');

class User extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('user_m');
		$this->load->model('penghuni_m');
		$this->load->model('registrasi_m');
		$this->load->model('fakultas_m');
		$this->load->model('prodi_m');
		$this->load->model('jurusan_m');
		$this->load->model('struk_m');
		$this->load->library('Pdf');
		if(isset($_SESSION['token_mhs'])){
			$this->data['token_mhs'] = $this->session->userdata('token_mhs');
			$this->data['idmhs'] = $this->data['token_mhs']['user_id'];
		}
	}

	public function index(){
		if(isset($_SESSION['token_mhs'])){
			
			$this->data['data_user'] = $this->user_m->GetDataJoinArr(['user' =>'user_id','penghuni' => 'user_id'],['t1.user_id' => $this->data['idmhs']]);

			$this->data['data_registrasi'] = $this->registrasi_m->GetDataJoinArr(['registrasi' =>'registrasi_id','penghuni_asrama' => 'registrasi_id'],['t1.penghuni_kpm' => $this->data['data_user'][0]->penghuni_kpm , 't1.registrasi_validasi' => 'yes']);

			$this->data['fakultas_grab'] = $this->fakultas_m->get();
			$this->data['jurusan_grab'] = $this->jurusan_m->get();
			$this->data['prodi_grab'] = $this->prodi_m->get();
			$this->data['struk_grab'] = $this->struk_m->get(['user_id' => $this->data['idmhs']]);
			$this->data['title']    = 'My Account';
			$this->data['content']  = 'user/myaccount';
			$this->template($this->data, $this->module);
			if ($this->POST('uploadukt')) {
				if($_FILES['fileukt']['name'] == ''){
					redirect('account');
				} else {
					$upukt = $this->go_upload('fileukt', 'uploads/asrama/struk/fileukt/'.$this->data['idmhs'], 'jpeg|jpg|png|pdf', TRUE);
					if($upukt['status'] == 'OK'){
						$fnameukt = $upukt['filename'];
						$this->db->trans_begin();
						if(count($this->data['struk_grab']) == 0){
							$ck = $this->struk_m->insert(['struk_ukt' => $fnameukt, 'user_id'=>$this->data['idmhs']]);
						} else {
							$ck = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_ukt' => $fnameukt]);
						}

						$this->db->trans_complete();
						if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();
							$this->flashmsg('Gagal mengirim data', 'danger');
							redirect('account');
						}else{
							$this->db->trans_commit();
							$this->session->set_flashdata('success', 'Berhasil mengirim data');
							redirect('account');
						}

					} else {
						$this->flashmsg('Gagal mengupload file', 'danger');
						redirect('account');
					}
				}
			}
			if ($this->POST('uploadsewa')) {
				if($_FILES['filesewa']['name'] == ''){
					redirect('account');
				} else {
					$upsewa = $this->go_upload('filesewa', 'uploads/asrama/struk/filesewa/'.$this->data['idmhs'], 'jpeg|jpg|png|pdf', TRUE);
					if($upsewa['status'] == 'OK'){
						$fnamesewa = $upsewa['filename'];
						$this->db->trans_begin();
						if(count($this->data['struk_grab']) == 0){
							$ck = $this->struk_m->insert(['struk_sewa' => $fnamesewa, 'user_id'=>$this->data['idmhs']]);
						} else {
							$ck = $this->struk_m->update($this->data['struk_grab'][0]->struk_id,['struk_sewa' => $fnamesewa]);
						}

						$this->db->trans_complete();
						if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();
							$this->flashmsg('Gagal mengirim data', 'danger');
							redirect('account');
						}else{
							$this->db->trans_commit();
							$this->session->set_flashdata('success', 'Berhasil mengirim data');
							redirect('account');
						}

					} else {
						$this->flashmsg('Gagal mengupload file', 'danger');
						redirect('account');
					}
				}
			}


		}
	}

	public function register(){
		if(isset($_SESSION['token_mhs'])){
			redirect('account');
		}
		$this->data['title']    = 'Register';
		$this->data['content']  = 'user/register';
		$this->data['gfak'] = $this->fakultas_m->get();
		$this->template($this->data, $this->module);

	}
	public function cetak_kartu(){
		if(isset($_SESSION['token_mhs'])){
			$datauser = $this->user_m->GetDataJoinArr(['user' =>'user_id','penghuni' => 'user_id'],['t1.user_id' => $this->data['idmhs']]);

			$data_registrasi= $this->registrasi_m->GetDataJoinArr(['registrasi' =>'registrasi_id','penghuni_asrama' => 'registrasi_id'],['t1.penghuni_kpm' => $datauser[0]->penghuni_kpm , 't1.registrasi_validasi' => 'yes']);

			/*$this->dump($datauser);
			exit();	*/

			$this->data['alldata'] = [
				'nama'	=> $datauser[0]->penghuni_nama,
				'kpm'	=> $datauser[0]->penghuni_kpm,
				'jk'	=> $datauser[0]->penghuni_jk,
				'fakultas'	=> $datauser[0]->penghuni_fakultas,
				'jurusan'	=> $datauser[0]->penghuni_jurusan,
				'prodi'	=> $datauser[0]->penghuni_prodi,
				'asramaid'	=> $data_registrasi[0]->asrama_id,
				'foto'	=> $datauser[0]->penghuni_foto,
			];


/*		$this->data['title']    = 'Register';
		$this->data['content']  = 'user/register';
		$this->template($this->data, $this->module);*/

/*		$this->data['title'] = 'Kartu Sewa';
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "Kartu Sewa.pdf";
		$this->pdf->load_view('frontend/user/cetak_kartu',$this->data);

		$this->pdf->set_option('defaultMediaType', 'all');
		$this->pdf->set_option('isFontSubsettingEnabled', true);
		$this->pdf->render();
		$this->pdf->stream();*/
		
		$this->data['fakultas_grab'] = $this->fakultas_m->get();
		$this->data['jurusan_grab'] = $this->jurusan_m->get();
		$this->data['prodi_grab'] = $this->prodi_m->get();
		$this->load->view('frontend/user/cetak_kartu',$this->data);
	} else {
		$this->session->set_flashdata('error', 'Oopsss anda tidak memiliki akses ');
		redirect();
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

public function logout(){
	$this->session->sess_destroy();
	redirect();
}

public function login(){
	if ($this->POST('login')) {
		$uriseg = $this->input->post('uriseg');
		$username = $this->input->post('username');

		if($username == '' || $this->post('password') == ''){
			redirect();
		}

		$cek_user = $this->user_m->get(['user_username' => $username,'user_role' => 'mahasiswa']);

		if(count($cek_user) == 0){
			$this->session->set_flashdata('error', 'Tidak ada data');
			redirect();
		} else {
			if($cek_user[0]->user_role == 'mahasiswa'){

				$data = [
					'user_username'	=>	$username,
					'user_password'	=>	md5($this->post('password')),
				];

				$user = $this->user_m->get_row($data);

				if(isset($user)){
					$resource = [
						'user_id'	=> $user->user_id,
						'username'	=> $user->user_username,
						'role' 		=> $user->user_role,
					];

					$this->data['resess'] 	= $resource;
					$this->data['message'] 	= 'Auth success';
					$this->data['info'] 	= [
						'status' 	=> 'ok',
						'response'	=> 200
					];
					$update = $this->user_m->update($user->user_id,['last_login' => date("Y-m-d H:i:s")]);
				} else {
					$this->data['message'] 	= 'Wrong username or password';
					$this->data['info'] 	= [
						'status'	=> 'fail',
						'response'	=> 502
					];
				}

				if($this->data['info']['status'] === 'ok'){
					$this->session->set_flashdata('success', $this->data['message']);
					$this->session->set_userdata(['token_mhs' => $this->data['resess']]);
					redirect($uriseg);
				} else {
					$this->session->set_flashdata('error', $this->data['message']);
					redirect($uriseg);
				}	
			} else {
				$this->session->set_flashdata('error', 'Forbidden Access');
				redirect($uriseg);
			}
		}
	} else{
		$this->session->set_flashdata('error', 'Oopsss coba terus h3h3 :p ');
		redirect('');
	}
}

public function create(){

	if(isset($_POST['register'])){
		$username	= $this->post('username');
		$password	= $this->post('password');
		$nim		= $this->post('nim');
		$nama		= $this->post('nama');
		$fakultas	= $this->post('fakultas');
		$jurusan	= $this->post('jurusan');
		$jk			= $this->post('jk');
		$jm			= $this->post('jm');
		$prodi		= $this->post('prodi');
		$email		= $this->post('email');
		$alamat		= $this->post('alamat');
		$telepon	= $this->post('telepon');
		$nama_ortu	= $this->post('nama_ortu');
		$tel_ortu	= $this->post('tel_ortu');
		$alamat_ortu= $this->post('alamat_ortu');

		$cekuname = $this->user_m->get(['user_username' => $username]);
		$cekemail = $this->penghuni_m->get(['penghuni_email' => $email]);
		$ceknim = $this->penghuni_m->get(['penghuni_kpm' => $nim]);
		if(count($cekuname) == 0){
			$username = $username;
		} else {
			$this->flashmsg('Username telah terpakai', 'danger');
			redirect('register');
		}
		if(count($cekemail) == 0){
			$email = $email;
		} else {
			$this->flashmsg('Email telah terpakai', 'danger');
			redirect('register');
		}
		if(count($ceknim) == 0){
			$nim = $nim;
		} else {
			$this->flashmsg('Nim telah terpakai', 'danger');
			redirect('register');
		}

		if(!empty($_FILES['filefoto']['name'])){
			$config['upload_path'] = './uploads/user';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			while (true) {
				$new_name = rand().$_FILES["filefoto"]['name'];
				if (!file_exists(sys_get_temp_dir() . $new_name)) break;
			}
			$config['file_name'] = $new_name;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$this->upload->do_upload('filefoto');
			if($this->upload->do_upload('filefoto')){
				$uploadData = $this->upload->data();
				$foto = $uploadData['file_name'];
				if(isset($_POST['imagebase64'])){
					$data = $_POST['imagebase64'];
					list($type, $data) = explode(';', $data);
					list(, $data)      = explode(',', $data);
					$data = base64_decode($data);
					file_put_contents('uploads/user/thumb/'.$new_name, $data);
				}
			}else{
				$this->flashmsg('foto gagal di upload', 'danger');
				redirect('register');
			}

		} else {
			$this->flashmsg('Silahkan masukan foto', 'danger');
			redirect('register');
		}

		$duser = [ 
			'user_username'	=> $username,
			'user_password'	=> md5($password),
			'user_role'		=> 'mahasiswa',
		];



		$this->db->trans_begin();
		$ck = $this->user_m->insert($duser);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->flashmsg('Gagal mengirim data', 'danger');
			redirect('register');
		}else{
			$this->db->trans_commit();

			$dpenghuni = [
				'user_id'				=> $ck['id'],
				'penghuni_kpm'			=> $nim,
				'penghuni_nama'			=> $nama,
				'penghuni_fakultas'		=> $fakultas,
				'penghuni_jurusan'		=> $jurusan,
				'penghuni_jk'			=> $jk,
				'penghuni_fakultas'		=> $fakultas,
				'penghuni_prodi'		=> $prodi,
				'penghuni_jm'			=> $jm,
				'penghuni_email'		=> $email,
				'penghuni_alamat'		=> $alamat,
				'penghuni_tel'			=> $telepon,
				'penghuni_nama_ortu'	=> $nama_ortu,
				'penghuni_tel_ortu'		=> $tel_ortu,
				'penghuni_alamat_ortu'	=> $alamat_ortu,
				'penghuni_foto' 		=> $foto,
			];
			$this->db->trans_begin();
			$ck = $this->penghuni_m->insert($dpenghuni);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->flashmsg('Gagal mengirim data', 'danger');
				redirect('register');
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Berhasil Mendaftar, Silahkan Login Kembali');
				redirect();
			}
		}
	}

}



public function update(){


	if(isset($_POST['update_personal'])){

		$aka = $this->penghuni_m->get(['user_id' => $this->data['idmhs']]);

		$nama		= $this->post('nama');
		$email		= $this->post('email');
		$telepon	= $this->post('telepon');
		$jk	= $this->post('jk');
		$alamat	= $this->post('alamat');
		$oldimg	= $aka[0]->penghuni_foto;

		$cekemail = $this->penghuni_m->get(['user_id !=' => $this->data['idmhs'], 'penghuni_email' => $email]);

		if(count($cekemail) == 0){


			if($_FILES['filefoto']['name'] == ''){

				$duser = [ 
					'penghuni_nama'		=> $nama,
					'penghuni_email'	=> $email,
					'penghuni_tel'		=> $telepon,
					'penghuni_jk'		=> $jk,
					'penghuni_alamat'	=> $alamat,
				];

			} else {


				$dir = 'uploads/user';
				if(file_exists($dir.'/'.$oldimg)) {
					unlink($dir.'/'.$oldimg);
				}
				if (!is_dir($dir)) {
					mkdir($dir, 0777, TRUE);
				}

				$config['upload_path'] = $dir;
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['file_name'] = $_FILES['filefoto']['name'];
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('filefoto')){
					$uploadData = $this->upload->data();
					$response['filename'] = $uploadData['file_name'];
					$response['response'] = 'File berhasil diupload';
					$response['status'] = 'OK';
				} else {
					$response['response'] = 'File gagal diupload, Format harus (jpg,jpeg,png)';
					$response['status'] = 'Failure ';
				}

				$duser = [ 
					'penghuni_nama'		=> $nama,
					'penghuni_email'	=> $email,
					'penghuni_tel'		=> $telepon,
					'penghuni_jk'		=> $jk,
					'penghuni_alamat'	=> $alamat,
					'penghuni_foto'		=> $response['filename'],
				];


			}

			$this->db->trans_begin();
			$ck = $this->penghuni_m->update($aka[0]->penghuni_kpm,$duser);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Gagal merubah data pribadi');
				redirect('account');
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Berhasil merubah data pribadi');
				redirect('account');
			}

		} else {
			$this->session->set_flashdata('error', 'Email telah terpakai');
			redirect('account');
		}
	} else if (isset($_POST['update_password'])){
		$oldpassword = md5($this->post('oldpassword'));
		$password = md5($this->post('password'));
		$newpassword = md5($this->post('newpassword'));
		$ceka = $this->user_m->get(['user_id' => $this->data['idmhs']]);

		if($oldpassword == $ceka[0]->user_password){

			if($password == $newpassword){

				$npw = [
					'user_password' => $password
				];

				$this->db->trans_begin();
				$ck = $this->user_m->update($this->data['idmhs'],$npw);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Gagal merubah password');
					redirect('account');
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('success', 'Berhasil merubah password');
					redirect('account');
				}
			} else {
				$this->session->set_flashdata('error', 'Password baru anda tidak sama');
			}
		} else {
			$this->session->set_flashdata('error', 'Password lama anda salah');
		}
	} else if (isset($_POST['update_ortu'])){
		$az = $this->penghuni_m->get(['user_id' => $this->data['idmhs']]);

		$nama = $this->post('nama_ortu');
		$tel = $this->post('tel_ortu');
		$alm = $this->post('alamat_ortu');
		$nort = [
			'penghuni_nama_ortu' => $nama,
			'penghuni_tel_ortu' => $tel,
			'penghuni_alamat_ortu' => $alm,
		];

		$this->db->trans_begin();
		$ck = $this->penghuni_m->update($az[0]->penghuni_kpm,$nort);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Gagal merubah password');
			redirect('account');
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success', 'Berhasil merubah password');
			redirect('account');
		}
	}
}
}
?> 