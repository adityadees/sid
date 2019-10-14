<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Informasi extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('artikel_m');
		$this->data['token_mhs'] = $this->session->userdata('token_mhs');
	}

	public function vmts(){
		$this->data['title']    = 'Visi, Misi, Tujuan & Strategi';
		$this->data['content']  = 'informasi/vmts';
		$this->template($this->data, $this->module);
	}
	public function kepakaran(){
		$this->data['title']    = 'Kepakaran';
		$this->data['content']  = 'informasi/kepakaran';
		$this->template($this->data, $this->module);
	}
	public function organisasi(){
		$this->data['title']    = 'Organisasi';
		$this->data['content']  = 'informasi/organisasi';
		$this->template($this->data, $this->module);
	}
	public function faq(){
		$this->data['title']    = 'FAQ';
		$this->data['content']  = 'informasi/faq';
		$this->template($this->data, $this->module);
	}
}
?> 