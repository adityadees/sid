<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Home extends MY_Controller{

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
		$this->data['title']    = 'Dashboard';
		$this->data['content']  = 'home';
		$this->template($this->data, $this->module);
	}

}
?>